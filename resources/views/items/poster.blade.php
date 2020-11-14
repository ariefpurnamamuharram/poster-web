<div class="card hvr-grow-shadow shadow">
    <img class="card-img-top"
         src="{{ Storage::url($poster->poster_filename) }}"
         alt="Poster {{ $poster->poster_title }}"/>
    <div class="card-body">
        <a href="{{ route('poster.show', $poster->id) }}"
           class="text-decoration-none text-dark">
            <h6 class="card-title">{{ $poster->poster_title }}</h6>
        </a>

        <span class="badge badge-info mt-2">@switch($poster->poster_category)
                @case(1)
                <span>Diabetes mellitus</span>
                @break
                @case(2)
                <span>Diabetic foot</span>
                @break
                @case(3)
                <span>Metabolic syndrome</span>
                @break
                @case(4)
                <span>Dyslipidemia</span>
                @break
                @case(5)
                <span>Obesity</span>
                @break
            @endswitch
        </span>
    </div>
</div>
