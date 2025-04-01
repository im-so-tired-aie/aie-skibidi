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
    </style>
    <title>Console</title>
</head>
<body>
    <div class="main-wrapper">
    <h1>Criteria Management</h1>
    <button onclick="{window.location.href = '/admin/criteria/create';}" type="button" class="add-new-create btn btn-success">Add New Creation</button>  
    <table class="table">
        <thead class="table-dark"> <!-- Add <thead> for styling -->
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Programme</th>
                <th>Required Hours</th>
                <th>Required Duration</th>
                <th>Required Project</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody class="table-light"> <!-- Add <tbody> for styling -->
            @foreach ($Criteria as $item )
            <tr>
                <td>{{$item["id"]}}</td>
                <td>{{$item["category"]}}</td>
                <td>{{$item["programme"]}}</td>
                <td>{{$item["required_hours"]}}</td>
                <td>{{$item["required_duration"]}}</td>
                <td>{{$item["required_project"]}}</td>
                <td><button type="button" class="btn btn-warning">Edit</button>
                    <button type="button" class="btn btn-danger">Delete</button></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>