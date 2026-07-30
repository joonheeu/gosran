<?php

use App\Enums\ApplicationDeploymentStatus;
use App\Livewire\Dashboard;
use App\Models\Application;
use App\Models\ApplicationDeploymentQueue;
use App\Models\Environment;
use App\Models\Project;
use App\Models\Server;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    Carbon::setTestNow(Carbon::parse('2026-07-30 12:00:00 UTC'));

    $this->team = Team::factory()->create();
    $this->user = User::factory()->create();
    $this->team->members()->attach($this->user->id, ['role' => 'owner']);

    $this->actingAs($this->user);
    session(['currentTeam' => $this->team]);
});

afterEach(function () {
    Carbon::setTestNow();
});

/**
 * @param  array{is_reachable: bool, is_usable: bool, force_disabled: bool}  $settings
 */
function makeDashboardOperationsServer(Team $team, string $name, array $settings): Server
{
    $server = Server::factory()->create([
        'team_id' => $team->id,
        'name' => $name,
    ]);

    $server->settings()->update($settings);

    return $server->fresh();
}

function makeDashboardOperationsApplication(Team $team, string $name): Application
{
    $project = Project::factory()->create(['team_id' => $team->id]);
    $environment = Environment::factory()->create(['project_id' => $project->id]);

    return Application::factory()->create([
        'environment_id' => $environment->id,
        'name' => $name,
    ]);
}

function createDashboardOperationsDeployment(
    Application $application,
    Server $server,
    string $applicationName,
    string $status,
    Carbon $finishedAt,
): ApplicationDeploymentQueue {
    $deployment = ApplicationDeploymentQueue::create([
        'application_id' => $application->id,
        'application_name' => $applicationName,
        'deployment_uuid' => (string) Str::uuid(),
        'deployment_url' => '/deployments/'.$applicationName,
        'server_id' => $server->id,
        'server_name' => $server->name,
        'status' => $status,
    ]);

    $deployment->forceFill([
        'finished_at' => $finishedAt,
    ])->saveQuietly();

    return $deployment->fresh();
}

it('shows distinct server attention signals with server links', function () {
    $unreachableServer = makeDashboardOperationsServer($this->team, 'unreachable-server', [
        'is_reachable' => false,
        'is_usable' => true,
        'force_disabled' => false,
    ]);
    $unusableServer = makeDashboardOperationsServer($this->team, 'unusable-server', [
        'is_reachable' => true,
        'is_usable' => false,
        'force_disabled' => false,
    ]);
    $forceDisabledServer = makeDashboardOperationsServer($this->team, 'force-disabled-server', [
        'is_reachable' => true,
        'is_usable' => true,
        'force_disabled' => true,
    ]);

    Livewire::test(Dashboard::class)
        ->assertSee('Operations')
        ->assertSee('GOSRAN cannot reach this server.')
        ->assertSee('GOSRAN has not marked this server as usable.')
        ->assertSee('This server is force-disabled.')
        ->assertSeeHtml('href="'.route('server.show', ['server_uuid' => $unreachableServer->uuid]).'"')
        ->assertSeeHtml('href="'.route('server.show', ['server_uuid' => $unusableServer->uuid]).'"')
        ->assertSeeHtml('href="'.route('server.show', ['server_uuid' => $forceDisabledServer->uuid]).'"');
});

it('shows only the five newest current-team failures finished in the last 24 hours', function () {
    $currentTeamServer = makeDashboardOperationsServer($this->team, 'current-team-server', [
        'is_reachable' => true,
        'is_usable' => true,
        'force_disabled' => false,
    ]);
    $currentTeamApplication = makeDashboardOperationsApplication($this->team, 'current-team-application');

    $otherTeam = Team::factory()->create();
    $otherTeamServer = makeDashboardOperationsServer($otherTeam, 'other-team-server', [
        'is_reachable' => true,
        'is_usable' => true,
        'force_disabled' => false,
    ]);
    $otherTeamApplication = makeDashboardOperationsApplication($otherTeam, 'other-team-application');

    foreach (range(1, 6) as $minutesAgo) {
        createDashboardOperationsDeployment(
            $currentTeamApplication,
            $currentTeamServer,
            'recent-failure-'.$minutesAgo,
            ApplicationDeploymentStatus::FAILED->value,
            now()->subMinutes($minutesAgo),
        );
    }

    createDashboardOperationsDeployment(
        $currentTeamApplication,
        $currentTeamServer,
        'outside-cutoff',
        ApplicationDeploymentStatus::FAILED->value,
        now()->subDay()->subSecond(),
    );
    createDashboardOperationsDeployment(
        $currentTeamApplication,
        $currentTeamServer,
        'future-failure',
        ApplicationDeploymentStatus::FAILED->value,
        now()->addMinute(),
    );
    createDashboardOperationsDeployment(
        $currentTeamApplication,
        $currentTeamServer,
        'finished-deployment',
        ApplicationDeploymentStatus::FINISHED->value,
        now()->subMinute(),
    );
    createDashboardOperationsDeployment(
        $otherTeamApplication,
        $currentTeamServer,
        'other-application-current-server',
        ApplicationDeploymentStatus::FAILED->value,
        now()->subMinute(),
    );
    createDashboardOperationsDeployment(
        $currentTeamApplication,
        $otherTeamServer,
        'current-application-other-server',
        ApplicationDeploymentStatus::FAILED->value,
        now()->subMinute(),
    );
    createDashboardOperationsDeployment(
        $otherTeamApplication,
        $otherTeamServer,
        'other-team-failure',
        ApplicationDeploymentStatus::FAILED->value,
        now()->subMinute(),
    );

    $component = Livewire::test(Dashboard::class);

    $component
        ->assertCount('failedDeployments', 5)
        ->assertSeeInOrder([
            'recent-failure-1',
            'recent-failure-2',
            'recent-failure-3',
            'recent-failure-4',
            'recent-failure-5',
        ])
        ->assertDontSeeHtml('href="/deployments/recent-failure-1"')
        ->assertDontSee('/deployments/recent-failure-1')
        ->assertDontSee('recent-failure-6')
        ->assertDontSee('outside-cutoff')
        ->assertDontSee('future-failure')
        ->assertDontSee('finished-deployment')
        ->assertDontSee('other-application-current-server')
        ->assertDontSee('current-application-other-server')
        ->assertDontSee('other-team-failure');

    $firstDeployment = $component->get('failedDeployments')->first();

    expect($firstDeployment)->toHaveKeys([
        'id',
        'application_name',
        'server_name',
        'finished_at',
    ]);
    expect($firstDeployment)->not->toHaveKey('deployment_url');
    expect($firstDeployment)->not->toHaveKey('logs');
    expect($firstDeployment)->not->toHaveKey('configuration_snapshot');
    expect($firstDeployment)->not->toHaveKey('configuration_diff');
    expect($firstDeployment)->not->toHaveKey('commit');
});

it('includes a failure finished exactly 24 hours ago', function () {
    $server = makeDashboardOperationsServer($this->team, 'cutoff-server', [
        'is_reachable' => true,
        'is_usable' => true,
        'force_disabled' => false,
    ]);
    $application = makeDashboardOperationsApplication($this->team, 'cutoff-application');

    createDashboardOperationsDeployment(
        $application,
        $server,
        'exact-cutoff',
        ApplicationDeploymentStatus::FAILED->value,
        now()->subDay(),
    );

    Livewire::test(Dashboard::class)
        ->assertSee('exact-cutoff');
});

it('orders failures with the same finished time by newest id first', function () {
    $server = makeDashboardOperationsServer($this->team, 'tie-break-server', [
        'is_reachable' => true,
        'is_usable' => true,
        'force_disabled' => false,
    ]);
    $application = makeDashboardOperationsApplication($this->team, 'tie-break-application');
    $finishedAt = now()->subMinute();

    createDashboardOperationsDeployment(
        $application,
        $server,
        'older-id-failure',
        ApplicationDeploymentStatus::FAILED->value,
        $finishedAt,
    );
    createDashboardOperationsDeployment(
        $application,
        $server,
        'newer-id-failure',
        ApplicationDeploymentStatus::FAILED->value,
        $finishedAt,
    );

    Livewire::test(Dashboard::class)
        ->assertSeeInOrder([
            'newer-id-failure',
            'older-id-failure',
        ]);
});

it('does not describe an empty server inventory as healthy', function () {
    Livewire::test(Dashboard::class)
        ->assertSee('No servers are configured, so there is no server status to report.')
        ->assertDontSee('All servers are healthy.');
});

it('reports the narrow no-signal state when servers exist', function () {
    makeDashboardOperationsServer($this->team, 'healthy-server', [
        'is_reachable' => true,
        'is_usable' => true,
        'force_disabled' => false,
    ]);

    Livewire::test(Dashboard::class)
        ->assertSee('No server issues or deployment failures were recorded in the last 24 hours.')
        ->assertDontSee('No servers are configured, so there is no server status to report.');
});

it('does not mutate server status while rendering operations', function () {
    $server = makeDashboardOperationsServer($this->team, 'read-only-server', [
        'is_reachable' => false,
        'is_usable' => false,
        'force_disabled' => false,
    ]);
    $settingsUpdatedAt = $server->settings->updated_at;

    Livewire::test(Dashboard::class)
        ->assertSee('Operations');

    expect($server->settings()->first()->updated_at->equalTo($settingsUpdatedAt))->toBeTrue();
});
