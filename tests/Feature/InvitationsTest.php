<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_public_can_invite()
    {
        $project = ProjectFactory::create();
        $project->invite($newUser = factory(User::class)->create());
        $this->signIn($newUser);
        $this->post(action('ProjectTasksController@store', $project), $task = ['body' => 'Foo task']);
        $this->assertDatabaseHas('tasks', $task);
    }
}
