@extends('layouts.app')
@section('content')
<div class="flex items-center mb-4">
    <a href="/projects/create" class="button">New projects</a>
</div>
<div class="flex">
    @forelse($projects as $project)

    <div class="bg-white mr-4 rounded shadow w-1/3 p-5">
        <h3 class="font-normal text-xl py-4">{{ $project->title }}</h3>
        <div class="text-grey">{{ Str::limit($project->description,100) }}</div>
    </div>
    @empty
    <div>Oh, no no no. Consiela clear</div>
    @endforelse
</div>
@endsection
