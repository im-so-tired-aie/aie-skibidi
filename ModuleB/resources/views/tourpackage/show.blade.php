<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $package->title }}</title>

    <link rel="stylesheet" href="{{ asset("/css/show.css") }}" />
</head>
<body>
@isset($package)
    @if($package instanceof \App\Http\Controllers\FormattedPackage)
        <header>
            <img class="cover-img" src="{{ Storage::url($package->coverImage) }}" alt="Cover Image" />
            <div class="gradient">
                <h1 class="white">{{ $package->title }}</h1>
                <div class="flex-row">
                    <div>
                        <p class="white">Price</p>
                        <p class="white"><strong>SGD {{ $package->cost }}</strong></p>
                    </div>

                    <div>
                        <p class="white">Duration</p>
                        <p class="white"><strong>{{ $package->duration }}</strong></p>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <div class="flex-row">
                <div class="avail-dates">
                    <h2 class="white">Available Dates</h2>
                    @foreach(explode(",", $package->departureDates) as $departureDate)
                        <p class="white">{{ $departureDate }}</p>
                    @endforeach
                </div>
                @isset($package->images)
                    <img class="img" alt="Image 1" src="{{ Storage::url(explode(",", $package->images)[0]) }}">
                @endisset
            </div>

            <h2 class="primary">Highlights</h2>
            <p>{{ $package->highlights }}</p>

            @isset($package->images)
                @php
                    $images = explode(",", $package->images);
                @endphp
                <div class="flex-row">
                    @if(isset($images[1]))
                        <img class="img" alt="Image 2" src="{{ Storage::url($images[1]) }}">
                    @endif
                    @if(isset($images[2]))
                        <img class="img" alt="Image 3" src="{{ Storage::url($images[2]) }}">
                    @endif
                </div>
            @endisset

            {!! $package->content !!}
        </div>
    @endif
@endisset
</body>
</html>
