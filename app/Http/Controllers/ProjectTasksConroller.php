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

        request()->validate(['body' => 'required']);
        $task->update([
            'body' => request('body'),
            'completed' => request()->has('completed')
        ]);
        return redirect($project->path());
    }
}
