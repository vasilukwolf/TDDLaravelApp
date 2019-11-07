@extends('layouts.app')
@section('content')
  <form method="post" action="/projects">
    @csrf
      <h1 class="heading is-1">Create a projects</h1>
    <div class="field">
      <label class="title">Title</label>
        <div class="control">
          <input class="input" type="text" name="title" placeholder="title">
        </div>
    </div>
    <div class="field">
      <label class="description">Title</label>
        <div class="control">
          <textarea class="textarea" name="description" placeholder="description"></textarea>
        </div>
    </div>
    <div class="control">
      <button  type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 border border-green-700 rounded">Submit project</button>
      <a href="/projects"><button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Canel</button></a>
    </div>
  </form>
@endsection
