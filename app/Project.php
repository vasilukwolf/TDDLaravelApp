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


    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => [
                'before'=> array_diff($this->old, $this->getAttributes()),
                'after'=> array_diff($this->getAttributes(),$this->old),
            ]
        ]);
    }

    public function activity(){
        return $this->hasMany(Activity::class)->latest();
    }

}
