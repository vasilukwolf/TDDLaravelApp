<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ProjectsTest extends TestCase
{
  use WithFaker,RefreshDatabase;
  /** @test */
  public function a_user_can_create_a_project(){

    $this->withoutExceptionHandling();

    $attributes = [
      'title'=> $this->faker->sentence,
      'description'=> $this->faker->paragraph,
    ];

    $this->post('/projects',$attributes);
    $this->assertDatabaseHas('projects', $attributes);
    $this->get('/projects')->assertSee($attributes['title']);

  }
  /** @test */
  public function a_user_can_view_a_project(){
    $this->withoutExceptionHandling();
    $project = factory('App\Project')->create();
    $this->get($project->path())
      ->assertSee($project->title)
      ->assertSee($project->descriprion);
  }
  /** @test */
  public function a_project_requiest_a_title(){
    $attributes = factory('App\Project')->raw(['title'=>'']);

    $this->post('/projects',$attributes)->assertSessionHasErrors('title');

  }
  /** @test */
  public function a_project_requiest_a_description(){
    $attributes = factory('App\Project')->raw(['description'=>'']);

    $this->post('/projects',$attributes)->assertSessionHasErrors('description');

  }

  /** @test */
  public function a_project_requiest_a_owner(){
    $this->withoutExceptionHandling();
    $attributes = factory('App\Project')->raw();

    $this->post('/projects',$attributes)->assertSessionHasErrors('owner');
  }
}
