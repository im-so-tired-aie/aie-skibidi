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
        <form id="form">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <input type="text" class="form-control" id="role" required>
            </div>
            <div class="flex-row">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="" class="btn btn-secondary">Close</button>
            </div>
        </form>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (!sessionStorage.getItem("token")) {
            window.location.href = "{{ url("/login") }}"
        }
        document.getElementById("form").addEventListener("submit", function (e) {
            e.preventDefault();
            fetch("{{ url("/sanctum/csrf-cookie") }}").then(() => {
                fetch("{{url("/api/register")}}", {
                    method: "POST",
                    body: JSON.stringify({
                        "name": document.getElementById("name").value,
                        "email": document.getElementById("email").value,
                        "password": document.getElementById("password").value,
                        "role": document.getElementById("role").value,
                    }),
                    headers: {
                        "Authorization": `Bearer ${sessionStorage.getItem("token")}`,
                        "Content-Type": "application/json"
                    }
                }).then((res) => {
                    if (res.ok) {
                        window.location.href = "{{ url("/admin/users") }}"
                    }
                })
            })
        })
    });
</script>
</body>
</html>
