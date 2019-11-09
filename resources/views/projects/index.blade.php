@extends('layouts.app')
@section('content')
<div class="flex items-center mb-4">
    <a href="/projects/create" class="button">New projects</a>
</div>
<div class="flex flex-wrap -mx-3">
    @forelse($projects as $project)
    <div class="w-1/3 px-4 pb-6">
    <div class="bg-white rounded shadow p-5">
        <h3 class="font-normal text-xl py-4">{{ $project->title }}</h3>
        <div class="text-grey">{{ Str::limit($project->description,100) }}</div>
    </div>
  </div>
    @empty
    <div>Oh, no no no. Consiela clear</div>
    @endforelse
</div>
@endsection
