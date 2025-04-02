<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>

    <link rel="stylesheet" href="{{ asset("/css/index.css") }}" />
</head>
<body>
    <header>
        <img class="cover" alt="Cover Image" src="{{ asset("/imgs/heroBannerImage.jpg") }}"/>

        <div class="container">
            <img class="icon" alt="icon" src="{{ asset("/imgs/logo.png") }}" />
            <h1>Explore the wonders of the world</h1>
        </div>
    </header>
    <div class="main">
        <div class="flex-row">
            <h1>Explore Our Tours</h1>
            <form method="GET">
                <select name="filter" onchange="this.form.submit()">
                    <option value="all">All</option>
                    @foreach($locations as $country => $data)
                        <option value="{{ $country }}" {{ request("filter") === $country ? "selected" : "" }}>{{ $country }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div>
            <h2>Recommended For You</h2>
            @foreach($locations as $location)
                @foreach($location as $package)
                    @if(!request("filter") || request("filter") === $location || request("filter") === "all")
                        <x-package hidden="{{true}}" optn="recommended" :package="$package" />
                    @endif
                @endforeach
            @endforeach
        </div>

        <div>
            <h2>Tours</h2>
            <div class="grid">
                @foreach($locations as $location => $folder)
                    @if(!request("filter") || request("filter") === $location || request("filter") === "all")
                        @foreach($folder as $package)
                            <x-package hidden="{{false}}" optn="{{ null }}" :package="$package" />
                        @endforeach
                    @endif
                @endforeach
                <div class="create-new">
                    <p class="plus">+</p>
                    <p>Add New</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (localStorage.getItem("recommended")) {
                document.getElementById(`${localStorage.getItem("recommended")}recommended`).classList.remove("hidden");
            }

            window.addEventListener("storage", function () {
                document.getElementById(`${localStorage.getItem("recommended")}recommended`).classList.remove("hidden");
            })
        });
    </script>
</body>
</html>
