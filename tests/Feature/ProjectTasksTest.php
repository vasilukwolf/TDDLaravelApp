<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function a_project_can_have_tasks(){

      $this->signIn();

      $project = auth()->user()->projects()->create(
        factory(Project::class)->raw()
      );

      $this->post($project->path().'/tasks',
      ['body' => 'Lorem diamnium super titanium' ]);

      $this->get($project->path())
      ->assertSee('Lorem diamnium super titanium');
  }

  /** @test */
  public function a_project_can_be_updated(){

    $this->withoutExceptionHandling();

    $project = app(ProjectFactory::class)->withTasks(1)->create();
    \var_dump($project);
    $this->signIn();

    // $project = auth()->user()->projects()->create(
    //   factory(Project::class)->raw()
    // );
    //
    // $task = $project->addTask('test task');

    $this->patch($project->path().'/tasks/'.$task->id,[
      'body' => 'changed',
      'completed'=> True,
    ]);

    $this->assertDatabaseHas('tasks',[
      'body' => 'changed',
      'completed'=> True,
    ]);

  }

  /** @test */
  public function only_the_owner_of_a_project_may_add_tasks(){
    $this->signIn();

    $project = factory('App\Project')->create();
    $this->post($project->path().'/tasks',
    ['body' => 'Lorem diamnium super titanium'])
    ->assertStatus(403);

    $this->assertDatabaseMissing('tasks',['body' => 'Lorem diamnium super titanium']);

  }

  /** @test */
  function only_the_owner_of_a_project_may_update_a_task()
   {
       $this->signIn();
       $project = factory('App\Project')->create();
       $task = $project->addTask('test task');
       $this->patch($task->path(), ['body' => 'changed'])
           ->assertStatus(403);
       $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
   }



  /** @test */
  public function a_task_requires_a_body(){

    $this->signIn();

    $project = auth()->user()->projects()->create(
      factory(Project::class)->raw()
    );

    $attributes = factory('App\Task')->raw(['body'=>'']);

    $this->post($project->path().'/tasks',$attributes)->
    assertSessionHasErrors('body');

  }

}
