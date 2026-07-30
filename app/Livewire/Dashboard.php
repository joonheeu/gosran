<?php

namespace App\Livewire;

use App\Enums\ApplicationDeploymentStatus;
use App\Models\ApplicationDeploymentQueue;
use App\Models\PrivateKey;
use App\Models\Project;
use App\Models\Server;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Component;

class Dashboard extends Component
{
    public Collection $projects;

    public Collection $servers;

    public Collection $serverIssues;

    public Collection $failedDeployments;

    public Collection $privateKeys;

    public function mount(): void
    {
        $this->privateKeys = PrivateKey::ownedByCurrentTeamCached();
        $this->servers = Server::ownedByCurrentTeamCached();
        $this->serverIssues = $this->buildServerIssues();
        $this->failedDeployments = $this->recentFailedDeployments();
        $this->projects = Project::ownedByCurrentTeam()->with('environments')->get();
    }

    /**
     * @return Collection<int, array{
     *     key: string,
     *     server_name: string,
     *     server_uuid: string,
     *     status: string,
     *     message: string,
     *     badge_type: string
     * }>
     */
    private function buildServerIssues(): Collection
    {
        return $this->servers->flatMap(function (Server $server): array {
            $issues = [];

            if (! $server->settings->is_reachable) {
                $issues[] = $this->serverIssue(
                    server: $server,
                    type: 'unreachable',
                    status: 'Unreachable',
                    message: 'GOSRAN cannot reach this server.',
                    badgeType: 'error',
                );
            }

            if (! $server->settings->is_usable) {
                $issues[] = $this->serverIssue(
                    server: $server,
                    type: 'unusable',
                    status: 'Not usable',
                    message: 'GOSRAN has not marked this server as usable.',
                    badgeType: 'error',
                );
            }

            if ($server->settings->force_disabled) {
                $issues[] = $this->serverIssue(
                    server: $server,
                    type: 'force-disabled',
                    status: 'Force-disabled',
                    message: 'This server is force-disabled.',
                    badgeType: 'warning',
                );
            }

            return $issues;
        })->values();
    }

    /**
     * @return array{
     *     key: string,
     *     server_name: string,
     *     server_uuid: string,
     *     status: string,
     *     message: string,
     *     badge_type: string
     * }
     */
    private function serverIssue(
        Server $server,
        string $type,
        string $status,
        string $message,
        string $badgeType,
    ): array {
        return [
            'key' => "{$server->id}-{$type}",
            'server_name' => $server->name,
            'server_uuid' => $server->uuid,
            'status' => $status,
            'message' => $message,
            'badge_type' => $badgeType,
        ];
    }

    /**
     * @return Collection<int, array{
     *     id: int,
     *     application_name: ?string,
     *     server_name: ?string,
     *     finished_at: \Illuminate\Support\Carbon
     * }>
     */
    private function recentFailedDeployments(): Collection
    {
        if ($this->servers->isEmpty()) {
            return collect();
        }

        $now = now();

        return ApplicationDeploymentQueue::query()
            ->where('status', ApplicationDeploymentStatus::FAILED->value)
            ->whereIn('server_id', $this->servers->pluck('id'))
            ->whereHas('application.environment.project', function (Builder $query): void {
                $query->where('team_id', currentTeam()->id);
            })
            ->where('finished_at', '>=', $now->copy()->subDay())
            ->where('finished_at', '<=', $now)
            ->orderByDesc('finished_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get([
                'id',
                'application_name',
                'server_name',
                'finished_at',
            ])
            ->map(fn (ApplicationDeploymentQueue $deployment): array => [
                'id' => $deployment->id,
                'application_name' => $deployment->application_name,
                'server_name' => $deployment->server_name,
                'finished_at' => $deployment->finished_at,
            ]);
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
