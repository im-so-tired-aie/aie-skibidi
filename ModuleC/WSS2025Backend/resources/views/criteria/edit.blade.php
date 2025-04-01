<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Edit</title>
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
</head>
<body>
    <x-nav/>
    <div class="main-wrapper">
        <div class='form-wrapper'>
            <h1 class="header">Edit Criterion</h1>
            <form method="post" action="/criteria/{{$criteria['id']}}/edit">
                @csrf
                  <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input value="{{$criteria['category']}}" name="category" type="text" class="form-control" id="category">
                  </div>
                  <div class="mb-3">
                    <label for="programme" class="form-label">Programme</label>
                    <input value="{{$criteria['programme']}}" name="programme" type="text" class="form-control" id="programme">
                  </div>
                  <div class="mb-3">
                      <label for="required_hours" class="form-label">Requried Hours</label>
                      <input value="{{$criteria['required_hours']}}" name="required_hours" type="text" class="form-control" id="required_hours">
                    </div>
                    <div class="mb-3">
                      <label for="required_duration" class="form-label">Required Duration</label>
                      <input value="{{$criteria['required_duration']}}" name="required_duration" type="text" class="form-control" id="required_duration">
                    </div>
                    <div class="mb-3">
                      <label for="required_project" class="form-label">Required Project</label>
                      <input value="{{$criteria['required_project']}}" name="required_project" type="text" class="form-control" id="required_project">
                    </div>
                  {{-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div> --}}
                  <button type="submit" class="btn btn-success">Update</button>
                  <button onclick="{event.preventDefault();window.location.href = '/admin/criteria'}" class="btn btn-secondary">Close</button>
                </form>
        </div>
    </div>
</body>
</html>