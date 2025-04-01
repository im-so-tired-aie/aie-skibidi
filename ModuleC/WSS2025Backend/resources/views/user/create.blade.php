<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
      .main-wrapper{
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;

      }
      .form-wrapper{
        width: 400px;
      }
      @media only screen and (max-width: 600px){
        .form-wrapper{
        width: 300px;
      } 
      }
    </style>
    <title>Create a new user</title>
</head>
<body>
  <x-nav/>
  <div class="main-wrapper">
  <div class="form-wrapper">
    <h1 class="header">Add New User</h1>
    <form method="post" action="/users/create">
      @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input name="name" type="text" class="form-control" id="name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input name="email" type="text" class="form-control" id="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="password">
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <input name="role" type="text" class="form-control" id="role">
          </div>
        {{-- <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div> --}}
        <button type="submit" class="btn btn-primary">Save</button>
        <button onclick="{event.preventDefault();window.location.href = '/admin/users'}" class="btn btn-secondary">Close</button>
      </form>
    </div>
  </div>
</body>
</html>