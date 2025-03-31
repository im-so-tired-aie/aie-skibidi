<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TrevWorld</title>

    <link rel="stylesheet" href="{{ asset("/css/index.css") }}" />
</head>
<body>
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
            <div id="recommended-package"></div>
        </div>

        <div>
            <h2>Tours</h2>
            <div class="grid">
                @foreach($folders as $location => $folder)
                    @if(!request("filter") || request("filter") === $location || request("filter") === "all")
                        @foreach($folder as $package)
                            <x-package-item :formatted-package="$package" />
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div>

{{--    <script>--}}
{{--        function updateRecommendedPackage() {--}}
{{--            const folders = @json($folders);--}}
{{--            const recommendedPackagePath = localStorage.getItem("recommendedPackage");--}}

{{--            Object.values(folders).forEach((folder) => {--}}
{{--                folder.forEach((pack) => {--}}
{{--                    if (pack.path === recommendedPackagePath) {--}}
{{--                        const stringify = JSON.stringify(pack)--}}
{{--                        document.getElementById("recommended-package").innerHTML = `<x-package-item :formatted-package='${stringify}' />`;--}}
{{--                    }--}}
{{--                })--}}
{{--            })--}}
{{--        }--}}
{{--        document.addEventListener("DOMContentLoaded", function () {--}}
{{--            updateRecommendedPackage();--}}

{{--            window.addEventListener("storage", function () {--}}
{{--                updateRecommendedPackage();--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
</body>
</html>
