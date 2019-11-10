@extends('layouts.app')
@section('content')
<header class="flex items-center mb-4">
    <div class="flex justify-between items-end w-full">
        <h2 class="text-grey text-sm">My projects</h2>
        <a href="/projects/create" class="button">New projects</a>
    </div>
</header>
<main class="lg:flex lg:flex-wrap -mx-3 py-4">
    @forelse($projects as $project)
      <div class="lg:w-1/4 px-3">
        @include('projects.card')
      </div>
    @empty
    <div>Oh, no no no. Consiela clear</div>
    @endforelse
</main>
@endsection
