@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Poster section --}}
        <section>
            <h2 class="text-center">ePoster</h2>


            @if(count($posters) != 0)
                <section>
                    @for($i = 0; $i < ((count($posters) / 3)); $i++)
                        <div class="card-deck">
                            @foreach($posters as $key => $poster)
                                @if(((int) ($loop->iteration / (3 + 1)) == ($i - 1)))
                                    <div class="card hvr-grow-shadow shadow">
                                        <img class="card-img-top" src="{{ Storage::url($poster->poster_filename) }}"
                                             alt="Poster {{ $poster->poster_title }}"/>
                                        <div class="card-body">
                                            <a href="#" class="text-decoration-none text-dark">
                                                <h6 class="card-title">{{ $poster->poster_title }}</h6>
                                            </a>

                                            <span class="badge badge-info mt-2">
                                                @switch($poster->poster_category)
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
                                @endif
                            @endforeach
                        </div>

                        <br/>
                    @endfor

                    <div class="row">
                        @foreach($posters as $key => $poster)
                            @if($loop->iteration > (3 * ((int) (count($posters) / 3))))
                                <div class="col-md-4">
                                    <div class="card hvr-grow-shadow shadow">
                                        <img class="card-img-top" src="{{ Storage::url($poster->poster_filename) }}"
                                             alt="Poster {{ $poster->poster_title }}"/>
                                        <div class="card-body">
                                            <a href="#" class="text-decoration-none text-dark">
                                                <h6 class="card-title">{{ $poster->poster_title }}</h6>
                                            </a>

                                            <span class="badge badge-info mt-2">
                                                @switch($poster->poster_category)
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
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        {{ $posters->links() }}
                    </div>
                </section>
            @else
                <p class="pt-2">Belum ada poster diunggah.</p>
            @endif
        </section>
    </div>
@endsection
