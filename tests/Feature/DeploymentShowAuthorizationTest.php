<?php

use App\Enums\ApplicationDeploymentStatus;
use App\Models\Application;
use App\Models\ApplicationDeploymentQueue;
use App\Models\Environment;
use App\Models\InstanceSettings;
use App\Models\Project;
use App\Models\Server;
use App\Models\StandaloneDocker;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->team = Team::factory()->create();
    $this->team->members()->attach($this->user->id, ['role' => 'owner']);

    InstanceSettings::unguarded(function () {
        InstanceSettings::query()->create([
            'id' => 0,
            'is_registration_enabled' => true,
        ]);
    });

    $this->actingAs($this->user);
    session(['currentTeam' => $this->team]);

    $this->server = Server::factory()->create(['team_id' => $this->team->id]);
    $this->destination = StandaloneDocker::query()->where('server_id', $this->server->id)->firstOrFail();
    $this->project = Project::factory()->create(['team_id' => $this->team->id]);
    $this->environment = Environment::factory()->create(['project_id' => $this->project->id]);
    $this->application = Application::factory()->create([
        'environment_id' => $this->environment->id,
        'destination_id' => $this->destination->id,
        'destination_type' => $this->destination->getMorphClass(),
        'status' => 'running',
    ]);
});

function createDeploymentShowQueue(
    Application $application,
    Server $server,
    string $deploymentUuid,
    string $logOutput,
): ApplicationDeploymentQueue {
    return ApplicationDeploymentQueue::query()->create([
        'application_id' => $application->id,
        'deployment_uuid' => $deploymentUuid,
        'server_id' => $server->id,
        'status' => ApplicationDeploymentStatus::FINISHED->value,
        'logs' => json_encode([[
            'command' => null,
            'output' => $logOutput,
            'type' => 'stdout',
            'timestamp' => now()->toISOString(),
            'hidden' => false,
            'batch' => 1,
            'order' => 1,
        ]], JSON_THROW_ON_ERROR),
    ]);
}

function deploymentShowUrl(
    Project $project,
    Environment $environment,
    Application $application,
    ApplicationDeploymentQueue $deployment,
): string {
    return route('project.application.deployment.show', [
        'project_uuid' => $project->uuid,
        'environment_uuid' => $environment->uuid,
        'application_uuid' => $application->uuid,
        'deployment_uuid' => $deployment->deployment_uuid,
    ]);
}

function deploymentIndexUrl(
    Project $project,
    Environment $environment,
    Application $application,
): string {
    return route('project.application.deployment.index', [
        'project_uuid' => $project->uuid,
        'environment_uuid' => $environment->uuid,
        'application_uuid' => $application->uuid,
    ]);
}

it('redirects when the deployment belongs to another team', function () {
    $otherTeam = Team::factory()->create();
    $otherServer = Server::factory()->create(['team_id' => $otherTeam->id]);
    $otherDestination = StandaloneDocker::query()->where('server_id', $otherServer->id)->firstOrFail();
    $otherProject = Project::factory()->create(['team_id' => $otherTeam->id]);
    $otherEnvironment = Environment::factory()->create(['project_id' => $otherProject->id]);
    $otherApplication = Application::factory()->create([
        'environment_id' => $otherEnvironment->id,
        'destination_id' => $otherDestination->id,
        'destination_type' => $otherDestination->getMorphClass(),
    ]);
    $otherDeployment = createDeploymentShowQueue(
        $otherApplication,
        $otherServer,
        'other-team-deployment',
        'private deployment output',
    );

    $response = $this->get(deploymentShowUrl(
        $this->project,
        $this->environment,
        $this->application,
        $otherDeployment,
    ));

    $response->assertRedirect(deploymentIndexUrl(
        $this->project,
        $this->environment,
        $this->application,
    ));
    $response->assertDontSee('private deployment output');
});

it('redirects when the deployment belongs to another application in the same team', function () {
    $otherApplication = Application::factory()->create([
        'environment_id' => $this->environment->id,
        'destination_id' => $this->destination->id,
        'destination_type' => $this->destination->getMorphClass(),
    ]);
    $otherDeployment = createDeploymentShowQueue(
        $otherApplication,
        $this->server,
        'same-team-other-application-deployment',
        'other application output',
    );

    $response = $this->get(deploymentShowUrl(
        $this->project,
        $this->environment,
        $this->application,
        $otherDeployment,
    ));

    $response->assertRedirect(deploymentIndexUrl(
        $this->project,
        $this->environment,
        $this->application,
    ));
    $response->assertDontSee('other application output');
});

it('loads a deployment that belongs to the authorized application', function () {
    $deployment = createDeploymentShowQueue(
        $this->application,
        $this->server,
        'authorized-application-deployment',
        'authorized deployment output',
    );

    $response = $this->get(deploymentShowUrl(
        $this->project,
        $this->environment,
        $this->application,
        $deployment,
    ));

    $response->assertSuccessful();
    $response->assertSee('authorized deployment output');
});
