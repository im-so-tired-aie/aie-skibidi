<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TrevWorld</title>

    <link rel="stylesheet" href="{{ asset("/css/index.css") }}" />
</head>
<body>
    <header class="header">
        <img alt="coverImage" class="header-img" src="{{ asset("/img/heroBannerImage.jpg") }}" />
        <div class="header-container">
            <img class="logo" alt="logo" src="{{ asset("/img/logo.png") }}" />
            <h1 class="header-title">Explore the wonders of the world</h1>
        </div>
    </header>
    <div class="container">
        <div class="flex-row">
            <h1>Explore Our Tours</h1>
            <form method="GET">
                <select name="filter" onchange="this.form.submit()">
                    <option value="all">All Countries</option>
                    @foreach(array_keys($folders) as $folder)
                        <option value="{{$folder}}" {{ request('filter') == $folder ? 'selected' : '' }}>{{$folder}}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div>
            <h2>Recommended For You</h2>
            <div id="recommended-package">
                @foreach($folders as $location => $folder)
                    @foreach($folder as $package)
                        <x-package-item hidden="{{true}}" :formatted-package="$package" />
                    @endforeach
                @endforeach
            </div>
        </div>

        <div>
            <h2>Tours</h2>
            <div class="grid">
                @foreach($folders as $location => $folder)
                    @if(!request("filter") || request("filter") === $location || request("filter") === "all")
                        @foreach($folder as $package)
                            <x-package-item hidden="{{false}}" :formatted-package="$package" />
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (localStorage.getItem("recommendedPackage")) {
                document.getElementById(localStorage.getItem("recommendedPackage")).classList.remove("hidden");
            }

            window.addEventListener("storage" , function () {
                if (localStorage.getItem("recommendedPackage")) {
                    document.getElementById(localStorage.getItem("recommendedPackage")).classList.remove("hidden");
                }
            });
        })
    </script>
</body>
</html>
