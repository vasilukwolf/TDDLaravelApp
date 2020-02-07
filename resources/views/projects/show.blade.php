@extends('layouts.app')
@section('content')
<header class="flex items-center mb-4">
    <div class="flex justify-between items-end w-full">
        <p class="text-grey text-sm">
            <a href="/projects" class="text-grey text-sm font-normal no-underline"> My projects</a> / {{ $project->title }}
        </p>
        <div class="flex items-center">
            @foreach ($project->members as $member)
                <img
                    src="{{ gravatar_url($member->email) }}"
                    alt="{{ $member->name }}'s avatar"
                    class="rounded-full w-8 mr-2">
            @endforeach

            <img
                src="{{ gravatar_url($project->owner->email) }}"
                alt="{{ $project->owner->name }}'s avatar"
                class="rounded-full w-8 mr-2">

            <a href="{{ $project->path().'/edit' }}" class="button ml-4">Edit Project</a>
        </div>
        <a href="{{$project->path().'/edit'}}" class="button">Edit projects</a>
    </div>
</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h2 class="text-grey  font-normal text-lg mb-3">Tasks</h2>
                {{--tasks --}}
                @foreach ($project->tasks as $key => $task)
                <div class="card mb-3">
                    <form method="POST" action="{{ $task->path() }}">
                        @csrf
                        @method('PATCH')
                        <div class="flex">
                            <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-grey' : '' }}" />
                            <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }} />
                        </div>
                </div>
                </form>
                @endforeach
                <div class="card mb-3">
                    <form action="{{ $project->path().'/tasks' }}" method="POST">
                        @csrf
                        <input placeholder="Begin adding task" class="w-full" name="body">
                    </form>
                </div>
            </div>
            <div>
              {{-- general notes --}}
                <h2 class="text-grey  font-normal text-lg">General Notes</h2>
                <form method="POST" action="{{ $project->path() }}">
                  @method('PATCH')
                  @csrf
                <textarea class="card w-full mb-5"
                 style="min-height:200px"
                  placeholder="Enter information what do you need!"
                  name="notes">{{ $project->notes }}</textarea>
                <button type="submit" class="button">Save note</button>
                @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
              @endif
                </form>
            </div>
        </div>
        <div class="lg:w-1/4 px-3">
            @include ('projects.card')
            @include ('projects.activity.card')
        </div>
    </div>
</main>
@endsection
