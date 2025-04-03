<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset("/dist/css/bootstrap.css") }}"/>
</head>
<body>
<x-navbar />

<div class="p-5">
    <h1>User Management</h1>
    <a href="{{ url("/admin/users/create") }}"><button class="btn btn-success mb-3">Add New User</button></a>

    <table class="table">
        <thead>
            <tr class="table-dark">
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Role</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody id="table-body">

        </tbody>
    </table>

    <script>
        function editUser(id) {
            window.location.href = `{{ url("/admin/user") }}/${id}/user`;
        }

        function deleteUser(id) {
            fetch("{{ url("sanctum/csrf-token") }}").then(() => {
                fetch(`{{ url("/api/user") }}/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Authorization": `Bearer ${sessionStorage.getItem("token")}`
                    }
                }).then((res) => {
                    if (res.ok) {
                        window.location.reload();
                    }
                });
            })
        }

        document.addEventListener("DOMContentLoaded", function () {
            if (!sessionStorage.getItem("token")) {
                window.location.href = "{{ url("/login") }}";
            }

            fetch("{{ url("/sanctum/csrf-cookie") }}").then(() => {
                fetch("{{ url("/api/user/all") }}", {
                    headers: {
                        "Authorization": `Bearer ${sessionStorage.getItem("token")}`
                    }
                }).then((res) => {
                    if (res.ok) {
                        res.json().then((json) => {
                            for (let i = 0; i < json.length; i++) {
                                document.getElementById("table-body").innerHTML += `<tr>
                                        <td>${json[i].id}</td>
                                        <td>${json[i].name}</td>
                                        <td>${json[i].email}</td>
                                        <td>${json[i].role}</td>
                                        <td>
                                            <button onclick="editUser(${json[i].id})" class="btn btn-warning">Edit</button>
                                            <button onclick="deleteUser(${json[i].id})" class="btn btn-danger">Delete</button>
                                        </td>
                                </tr>`;
                            }
                        })
                    }
                })
            })
        });
    </script>
</div>
</body>
</html>
