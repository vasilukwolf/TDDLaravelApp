<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
    protected $touches = ['project'];

    public function project(){

      return $this->belongsTo(Project::class);

    }

    public function path(){

      return "/projects/{$this->project->id}/tasks/{$this->id}";

    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($task) {
            Activity::create([
                'project_id' => $task->project->id,
                'description' => 'created_task',
            ]);
        });

        static::updated(function ($task) {
            if(! $task->completed) return;
            Activity::create([
                'project_id' => $task->project->id,
                'description' => 'created_task',
            ]);
        });


    }

}
