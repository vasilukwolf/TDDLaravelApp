@extends('layouts.app')
@section('content')
<header class="flex items-center mb-4">
    <div class="flex justify-between w-full">
        <h2 class="text-grey text-sm">My projects</h2>
        <a href="/projects/create" class="button">New projects</a>
    </div>
</header>
<main class="lg:flex lg:flex-wrap -mx-3 py-4">
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-4 pb-6">
        <div class="bg-white rounded-lg shadow p-5">
            <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-ligth pl-4">
            <a href="{{ $project->path() }}" class="text-black no-underline">  {{ $project->title }}</a>
            </h3>
            <div class="text-grey">{{ Str::limit($project->description,100) }}</div>
        </div>
    </div>
    @empty
    <div>Oh, no no no. Consiela clear</div>
    @endforelse
</main>
@endsection
