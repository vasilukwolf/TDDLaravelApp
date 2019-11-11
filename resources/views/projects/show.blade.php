@extends('layouts.app')
@section('content')
<header class="flex items-center mb-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-grey text-sm">
          <a href="/projects" class="text-grey text-sm font-normal no-underline"> My projects</a> / {{ $project->title }}
        </p>
        <a href="/projects/create" class="button">New projects</a>
    </div>
</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
          <div class="mb-8">
            <h2 class="text-grey  font-normal text-lg mb-3">Tasks</h2>
            {{--tasks --}}
            @foreach ($project->tasks as $key => $task)
              <div class="card mb-3">{{ $task->body }}</div>
            @endforeach
          </div>
          <div>
            <h2 class="text-grey  font-normal text-lg">General Notes</h2>

            {{-- general notes --}}
            <textarea class="card w-full" style="min-height:200px">Lorem ipsum.</textarea>
          </div>
          </div>
          <div class="lg:w-1/4 px-3">
            @include ('projects.card')
        </div>
      </div>
</main>
@endsection
