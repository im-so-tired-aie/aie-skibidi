@isset($formattedPackage)
    @if($formattedPackage instanceof \App\Http\Controllers\FormattedPackage)
        <div class="package" id="{{ $formattedPackage->path }}">
            <h3>{{ $formattedPackage->title }}</h3>

            <div class="flex-row">
                <div>
                    <p><strong>{{ $formattedPackage->duration }}</strong></p>
                    <p>{{ $formattedPackage->cost }}</p>
                </div>
                <img class="star" alt="star" id="{{ $formattedPackage->path }} star" src="{{ asset("/img/star-outline.svg") }}" onclick="recommendPackage('{{ $formattedPackage->path }}')" />
            </div>

            {{--  Cover Image  --}}
            <img class="cover-img" alt="cover image" src="{{ Storage::url($formattedPackage->coverImage) }}" />

            <p>{{ $formattedPackage->highlights }}</p>
            <a href="{{ $formattedPackage->path }}"><button>View Package</button></a>
        </div>
    @endif
@endisset

<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (localStorage.getItem(("recommendedPackage")) === "{{ $formattedPackage->path }}") {
{{--            document.getElementById("{{$formattedPackage->path}}").classList.add("hidden")--}}
            document.getElementById("{{$formattedPackage->path}} star").src = "{{ asset("/img/star.svg") }}";
        }
    })

    function recommendPackage(packagePath) {
        document.getElementById(`${localStorage.getItem("recommendedPackage")} star`).src = "{{ asset("/img/star-outline.svg") }}";
        // document.getElementById(localStorage.getItem("recommendedPackage")).classList.remove("hidden")
        localStorage.setItem("recommendedPackage", packagePath);
        document.getElementById(`${packagePath} star`).src = "{{ asset("/img/star.svg") }}";
    }
</script>
