<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function a_project_can_have_tasks(){
      $this->withoutExceptionHandling();
      $this->signIn();

      $project = factory(Project::class)->create(['owner_id'=> auth()->id()]);

      $this->post($project->path().'/tasks',
      ['body' => 'Lorem diamnium super titanium' ]);

      $this->get($project->path())
      ->assertSee('Lorem diamnium super titanium');
  }
}
