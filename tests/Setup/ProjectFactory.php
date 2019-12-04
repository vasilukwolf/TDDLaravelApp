<?php

    namespace Tests\Setup;

    class ProjecFactory
    {
      protected $tasksCount = 0;

      public function withTasks(){
        $this->tasksCount = $count;

        return $this;
      }

      public function create(){
        $project = factory(Project::class)->create([
          'owner_id' => factory(User::class)
        ]);

        factory(Task::class,$this->tasksCount)->create([
          'project_id' => $project->id
        ]);

        return $project;
      }
    }
