<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <h1>Birdboard</h1>
  <ul>
    @forelse($projects as $project)
      <li><a href="{{ $project->path() }}">{{ $project->title }}</a></li>
    @empty
    <li>Oh, no no no. Consiela clear</li>
    @endforelse
  </ul>
</body>
