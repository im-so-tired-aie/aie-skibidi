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
            padding: 20px;
        }
        .add-new-create{
            margin: 10px 0px;
        }
        .table-light{
            font-size:20px;
        }
        .disapear{
            animation: disapear_animation 0.1s linear 2s forwards;
        }
        .alert{
            text-align: center;
            background-color: rgb(0, 0, 0);
            color: white;
            font-weight: bold;
            border-radius: 20px;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50px;
            left: 50%;
             
        }
        @keyframes disapear_animation{
            0%{
                display: block;
            }
            100%{
                display: none;
            }
        }
    </style>
    <title>Console</title>
</head>
<body>
    <x-nav/>
    <div class="main-wrapper">
    <h1>User Management</h1>
    @if(Session::has('flash'))
        <div class="alert disapear">
        {{ Session::get('flash') }}
        </div>
    @endif
    <button onclick="{window.location.href = '/admin/users/create';}" type="button" class="add-new-create btn btn-success">Add New User</button>  
    <table class="table">
        <thead class="table-dark"> <!-- Add <thead> for styling -->
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody class="table-light"> <!-- Add <tbody> for styling -->
            @foreach ($Criteria as $item )
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->role}}</td>
                <td><button onclick="{window.location.href='/admin/users/{{$item->id}}/update'}" type="button" class="btn btn-warning">Edit</button>
                    <button onclick="{window.location.href='/admin/users/{{$item->id}}/delete'}" type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>