<!DOCTYPE html>
<html>
<head>
  <title>Create projects</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

</head>
<body>
  <form method="post" action="/projects" class="container" style="padding-top:40px;">
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
          <input class="textarea" name="description" placeholder="description">
        </div>
    </div>
    <div class="control">
      <button  type="submit" class="button is-primary">Create project</button>
    </div>
  </form>
</body>
