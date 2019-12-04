<?php

namespace Tests\Feature;

use App\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ManageProjectsTest extends TestCase
{
  use WithFaker,RefreshDatabase;

  /** @test */
  public function guest_cannot_manage_projects(){

    $project = factory('App\Project')->create();

    $this->post('/projects',$project->toArray())->assertRedirect('login');
    $this->get('/projects/create')->assertRedirect('login');
    $this->get('/projects')->assertRedirect('login');
    $this->get($project->path())->assertRedirect('login');
  }

  /** @test */
  public function a_user_can_create_a_project(){

    $this->withoutExceptionHandling();

    $this->signIn();

    $this->get('/projects/create')->assertStatus(200);

    $attributes = [
      'title'=> $this->faker->sentence,
      'description'=> $this->faker->sentence,
      'notes' => 'General notes here.',
    ];

    $response = $this->post('/projects', $attributes);

    $project = Project::where($attributes)->first();


    $response->assertRedirect($project->path());

    $this->assertDatabaseHas('projects', $attributes);
    $this->get($project->path())
           ->assertSee($attributes['title'])
           ->assertSee($attributes['description']);
           //->assertSee($attributes['notes']);

  }

  /** @test */
  public function a_user_can_update_a_project(){

    $this->withoutExceptionHandling();
    $this->signIn();
    $project = factory('App\Project')->create(['owner_id'=>auth()->id()]);

    $this->patch($project->path(),
    [
      'notes'=>'Changed',
    ])->assertRedirect($project->path());

    $this->assertDatabaseHas('projects',['notes'=>'Changed']);
  }

  /** @test */
  public function a_user_can_view_a_their_project(){
    $this->withoutExceptionHandling();
    $this->signIn();
    $project = factory('App\Project')->create(['owner_id'=>auth()->id()]);
    $this->get($project->path())
      ->assertSee($project->title)
      ->assertSee($project->descriprion);
  }
  /** @test */
  public function a_authenticated_user_cannot_view_a_projects_of_others(){
    // $this->withoutExceptionHandling();
    $this->signIn();
    $project = factory('App\Project')->create();
    $this->get($project->path())->assertstatus(403);
  }

  /** @test */
  public function a_authenticated_user_cannot_update_a_projects_of_others(){
    // $this->withoutExceptionHandling();
    $this->signIn();
    $project = factory('App\Project')->create();
    $this->get($project->path(),[])->assertstatus(403);
  }
  /** @test */
  public function a_project_requiest_a_title(){
    $this->signIn();
    $attributes = factory('App\Project')->raw(['title'=>'']);

    $this->post('/projects',$attributes)->assertSessionHasErrors('title');

  }
  /** @test */
  public function a_project_requiest_a_description(){
    $this->signIn();
    $attributes = factory('App\Project')->raw(['description'=>'']);

    $this->post('/projects',$attributes)->assertSessionHasErrors('description');

  }
}
