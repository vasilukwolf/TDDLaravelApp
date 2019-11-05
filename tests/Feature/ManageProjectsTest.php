<?php

namespace Tests\Feature;

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
    $this->actingAs(factory('App\User')->create());
    $this->get('/projects/create')->assertStatus(200);
    $attributes = [
      'title'=> $this->faker->sentence,
      'description'=> $this->faker->paragraph,
    ];

    $this->post('/projects',$attributes);
    $this->assertDatabaseHas('projects', $attributes);
    $this->get('/projects')->assertSee($attributes['title']);

  }
  /** @test */
  public function a_user_can_view_a_their_project(){
    $this->withoutExceptionHandling();
    $this->be(factory('App\User')->create());
    $project = factory('App\Project')->create(['owner_id'=>auth()->id()]);
    $this->get($project->path())
      ->assertSee($project->title)
      ->assertSee($project->descriprion);
  }
  /** @test */
  public function a_authenticated_user_cannot_view_a_projects_of_others(){
    // $this->withoutExceptionHandling();
    $this->be(factory('App\User')->create());
    $project = factory('App\Project')->create();
    $this->get($project->path())->assertstatus(403);
  }
  /** @test */
  public function a_project_requiest_a_title(){
    $this->actingAs(factory('App\User')->create());
    $attributes = factory('App\Project')->raw(['title'=>'']);

    $this->post('/projects',$attributes)->assertSessionHasErrors('title');

  }
  /** @test */
  public function a_project_requiest_a_description(){
    $this->actingAs(factory('App\User')->create());
    $attributes = factory('App\Project')->raw(['description'=>'']);

    $this->post('/projects',$attributes)->assertSessionHasErrors('description');

  }
}
