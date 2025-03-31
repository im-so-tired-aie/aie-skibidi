<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TrevWorld</title>

    <link rel="stylesheet" href="{{ asset("/css/index.css") }}" />
    <script>

    </script>
</head>
<body>
    <div class="container">
        <div class="flex-row">
            <h1>Explore Our Tours</h1>
        </div>

        <h2>Tours</h2>
        <div class="grid">
            @foreach($folders as $folder)
                @foreach($folder as $package)
                    <x-package-item :formatted-package="$package" />
                @endforeach
            @endforeach
        </div>
    </div>
</body>
</html>
