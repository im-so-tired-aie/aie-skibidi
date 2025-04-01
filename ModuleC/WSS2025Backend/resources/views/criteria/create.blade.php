<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>

    </style>
    <title>Create a new table</title>
</head>
<body>
    <h1 class="header">Add new creation</h1>
    <form>
        <div class="mb-3">
          <label for="category" class="form-label">Category</label>
          <input type="text" class="form-control" id="category" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="programme" class="form-label">Programme</label>
          <input type="text" class="form-control" id="programme">
        </div>
        <div class="mb-3">
            <label for="requried_hours" class="form-label">Requried Hours</label>
            <input type="text" class="form-control" id="requried_hours">
          </div>
          <div class="mb-3">
            <label for="required_duration" class="form-label">Required Duration</label>
            <input type="text" class="form-control" id="required_duration">
          </div>
          <div class="mb-3">
            <label for="required_project" class="form-label">Required Project</label>
            <input type="text" class="form-control" id="required_project">
          </div>
        {{-- <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> --}}
        <button type="submit" class="btn btn-primary">Save</button>
        <button onclick="{event.preventDefault();window.location.href = '/admin/criteria'}" class="btn btn-secondary">Close</button>
      </form>
</body>
</html>