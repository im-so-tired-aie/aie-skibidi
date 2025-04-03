<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset("/dist/css/bootstrap.css") }}" />
</head>
<body>
    <form id="login-form">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        document.getElementById("login-form").addEventListener("submit", function (e) {
            e.preventDefault();

            fetch('{{ url("/sanctum/csrf-cookie") }}').then(() => {
                fetch('{{ url("api/login") }}', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        "email": document.getElementById('email').value,
                        "password": document.getElementById('password').value
                    })
                }).then((res) => {
                    if (res.ok) {
                        res.json().then((json) => {
                            console.log(json);
                            sessionStorage.setItem("token", json.token);
                        });
                        window.location.href = '{{ url("/admin/criteria") }}'
                    }
                })
            });
        });
    </script>
</body>
</html>
