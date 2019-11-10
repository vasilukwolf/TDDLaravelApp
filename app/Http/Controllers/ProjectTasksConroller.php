<?php

namespace App\Http\Controllers;

use App\Project;

use Illuminate\Http\Request;

class ProjectTasksConroller extends Controller
{
    public function store(Project $project){

      $project->addTask(request('body'));

      return redirect($project->path());
    }
}
