<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use App\Policies;

use Illuminate\Http\Request;

class ProjectTasksConroller extends Controller
{
    public function store(Project $project){

      $this->authorize('update',$project);

      request()->validate(['body'=>'required']);

      $project->addTask(request('body'));

      return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
      $this->authorize('update',$project);

        $task->update(request()->validate(['body' => 'required']));
        $method = request('completed') ? 'complete' : 'incomplete';
        $task->$method();

        return redirect($project->path());
    }
}
