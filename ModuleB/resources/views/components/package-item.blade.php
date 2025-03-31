@isset($formattedPackage)
    @if($formattedPackage instanceof \App\Http\Controllers\FormattedPackage)
        <a href="{{ $formattedPackage->path }}" class="package" id="package">
            <h3>{{ $formattedPackage->title }}</h3>

            <div class="flex-row">
                <div>
                    <p><strong>{{ $formattedPackage->duration }}</strong></p>
                    <p>{{ $formattedPackage->cost }}</p>
                </div>
                <img class="star" alt="star" id="star" src="{{ asset("/img/star-outline.svg.svg") }}" />
            </div>

            {{--  Cover Image  --}}
            <img class="cover-img" alt="cover image" src="{{ Storage::url($formattedPackage->coverImage) }}" />

            <p>{{ $formattedPackage->highlights }}</p>
            <button>Add Package</button>
        </a>
    @endif
@endisset

{{--<script>--}}
{{--    document.addEventListener("DOMContentLoaded", function() {--}}
{{--        const path = document.getElementById("package").getAttribute('data-package-path');--}}
{{--        if (path) {--}}
{{--            if (path === localStorage.getItem("recommended-package")) {--}}
{{--                document.getElementById("star").src =--}}
{{--            }--}}
{{--        }--}}
{{--    });--}}
{{--    function handleRecommend() {--}}

{{--    }--}}
{{--</script>--}}
