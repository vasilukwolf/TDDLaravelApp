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

      $project = ProjectFactory::create();


      $this->actingAs($project->owner)->
          post($project->path().'/tasks',
             ['body' => 'Lorem diamnium super titanium' ]);

      $this->get($project->path())
        ->assertSee('Lorem diamnium super titanium');
  }

  /** @test */
  public function a_project_can_be_updated(){

    $project = ProjectFactory::withTasks(1)->create();

    $this->
      actingAs($project->owner)->
      patch($project->tasks[0]->path(),[
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
       $project = ProjectFactory::withTasks(1)->create();
       $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
           ->assertStatus(403);
       $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
   }



  /** @test */
  public function a_task_requires_a_body(){

    $project = ProjectFactory::create();

    $attributes = factory('App\Task')->raw(['body'=>'']);

    $this->actingAs($project->owner)->
      post($project->path().'/tasks',$attributes)->
      assertSessionHasErrors('body');

  }

}
