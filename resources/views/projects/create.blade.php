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
      <button  type="submit" class="button is-primary">Create project</button>
      <a href="/projects">Canel</a>
    </div>
  </form>
@endsection
