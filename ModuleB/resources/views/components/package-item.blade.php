@isset($formattedPackage)
    @if($formattedPackage instanceof \App\Http\Controllers\FormattedPackage)
        <div class="package">
            <h3>{{ $formattedPackage->title }}</h3>

            <div class="flex-row">
                <div>
                    <p><strong>{{ $formattedPackage->duration }}</strong></p>
                    <p>{{ $formattedPackage->cost }}</p>
                </div>
                <img class="star" alt="star" src="{{ asset("/img/star.svg") }}" />
            </div>

            {{--  Cover Image  --}}
            <img class="cover-img" alt="cover image" src="{{ Storage::url($formattedPackage->coverImage) }}" />

            <p>{{ $formattedPackage->highlights }}</p>
            <button>Add Package</button>
        </div>
    @endif
@endisset
