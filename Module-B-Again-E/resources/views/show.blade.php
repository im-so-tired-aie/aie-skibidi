<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $package->title }}</title>

    <link rel="stylesheet" href="{{ asset("/css/show.css") }}" />
</head>
<body>
    <header>
        <img src="{{ Storage::url($package->cover) }}" alt="Cover Image" />

        <div class="container">
            <h1>{{ $package->title }}</h1>
            <div class="flex-row">
                <div>
                    <p>Price</p>
                    <h2>{{ $package->cost }}</h2>
                </div>

                <hr />

                <div>
                    <p>Duration</p>
                    <h2>{{ $package->duration }}</h2>
                </div>
            </div>
        </div>
    </header>

    <div class="main">
        <div class="flex-row">
            <div class="avail-dates">
                <p class="heading">Available Dates</p>
                <p>{{ $package->departureDates }}</p>
            </div>

            @isset($package->img1)
                <img class="img" alt="Image 1" src="{{ Storage::url($package->img1) }}" />
            @endisset
        </div>

        <div class="content">
            <h2>Highlights</h2>
            <p>{{ $package->highlights }}</p>
        </div>

        <div class="flex-row">
            @isset($package->img2)
                <img class="img" alt="Image 2" src="{{ Storage::url($package->img2) }}" />
            @endisset
            @isset($package->img3)
                <img class="img" alt="Image 3" src="{{ Storage::url($package->img3) }}" />
            @endisset
        </div>

        <div class="content">
            {!! $package->content !!}
        </div>
    </div>
</body>
</html>
