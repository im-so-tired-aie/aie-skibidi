<div class="package {{ $hidden ? "hidden" : "" }}" id="{{ $package->path }}{{ $optn != null ? $optn : "" }}">
    <p class="title">{{$package->title}}</p>
    <div class="flex-row">
        <div class="sub">
            <p><b>{{ $package->duration }}</b></p>
            <p>{{ $package->cost }}</p>
        </div>
        <button class="star" id="{{ $package->path }} recco" onclick="clickdosmth()"></button>
    </div>

    <img class="cover" alt="{{ $package->title }}" src="{{ Storage::url($package->cover) }}" />

    <p class="highlights">{{ $package->highlights }}</p>

    <a
        href="{{ $package->path }}"
    ><button class="btn">View Package</button></a>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
       if (localStorage.getItem("recommended") === "{{ $package->path }}") {
           document.getElementById("{{ $package->path }} recco").classList.add("selected-star")
       }

       window.addEventListener("storage", function () {
           if (localStorage.getItem("recommended") === "{{ $package->path }}") {
               document.getElementById("{{ $package->path }} recco").classList.add("selected-star")
           } else {
                try {
                    document.getElementById("{{ $package->path }} recco").classList.remove("selected-star")
                } catch {}
           }
       })
    });

    function clickdosmth() {
        document.getElementById("{{$package->path}}recommended").classList.add("hidden");
        if (localStorage.getItem("recommended") == "{{$package->path}}") {
            localStorage.setItem("recommended", null);
        } else {
            localStorage.setItem("recommended", "{{ $package->path }}");
        }
        window.location.reload();
    }
</script>
