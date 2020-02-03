<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    public $old = [];

    public function path(){

      return  "/projects/{$this->id}";

    }

    public function owner(){

      return $this->belongsTo(User::class);

    }

    public function tasks(){

      return $this->hasMany(Task::class);

    }
    /**
     * Add a task to the project.
     *
     * @param  string $body
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addTask($body)
    {
        return  $this->tasks()->create(compact('body'));
    }

    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => array_except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }
    }


    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges()
        ]);
    }

    public function activity(){
        return $this->hasMany(Activity::class)->latest();
    }

}
