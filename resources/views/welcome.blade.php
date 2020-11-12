@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            {{-- Carousel card, show only in small screen --}}
            <div class="d-block d-sm-none">
                <div id="carouselHomeIndicators" class="carousel slide" data-ride="carousel">
                    {{-- Carousel indicators --}}
                    <ol class="carousel-indicators">
                        <li data-target="#carouselHomeIndicators" data-slide-to="0" class="active"></li>
                    </ol>

                    {{-- Carousel contents --}}
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ asset('assets/images/banner-jdm-2020.png') }}"
                                 alt="Jakarta Diabetes Meeting 2020">
                        </div>
                    </div>

                    {{-- Carousel controllers --}}
                    <a class="carousel-control-prev" href="#carouselHomeIndicators" role="button"
                       data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselHomeIndicators" role="button"
                       data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <hr/>
            </div>

            <div class="card-body">
                <div class="container">
                    {{-- Carousel card --}}
                    <div class="d-none d-sm-block">
                        <div class="card">
                            {{-- Carousel --}}
                            <div id="carouselHomeIndicators" class="carousel slide" data-ride="carousel">
                                {{-- Carousel indicators --}}
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselHomeIndicators" data-slide-to="0" class="active"></li>
                                </ol>

                                {{-- Carousel contents --}}
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100"
                                             src="{{ asset('assets/images/banner-jdm-2020.png') }}"
                                             alt="Jakarta Diabetes Meeting 2020">
                                    </div>
                                </div>

                                {{-- Carousel controllers --}}
                                <a class="carousel-control-prev" href="#carouselHomeIndicators" role="button"
                                   data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselHomeIndicators" role="button"
                                   data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Poster section --}}
                    <section style="margin-top: 0;">
                        {{-- Posters --}}
                        <section>
                            @if(count($posters) != 0)
                                <section>
                                    @for($i = 0; $i < ((count($posters) / 3)); $i++)
                                        <div class="card-deck">
                                            @foreach($posters as $key => $poster)
                                                @if(((int) ($loop->iteration / (3 + 1)) == ($i - 1)))
                                                    <div class="card hvr-grow-shadow shadow">
                                                        <img class="card-img-top"
                                                             src="{{ Storage::url($poster->poster_filename) }}"
                                                             alt="Poster {{ $poster->poster_title }}"/>
                                                        <div class="card-body">
                                                            <a href="{{ route('show.poster', $poster->id) }}"
                                                               class="text-decoration-none text-dark">
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
                                                        <img class="card-img-top"
                                                             src="{{ Storage::url($poster->poster_filename) }}"
                                                             alt="Poster {{ $poster->poster_title }}"/>
                                                        <div class="card-body">
                                                            <a href="{{ route('poster.show', $poster->id) }}"
                                                               class="text-decoration-none text-dark">
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
                                <p class="pt-2">No data available.</p>
                            @endif
                        </section>

                        {{-- Recent comments --}}
                        <section style="margin-top: 24px;">
                            <h6 class="font-weight-bold">Recent comments</h6>

                            @if(count($postersComments) != 0)
                                <ul>
                                    @foreach($postersComments as $comment)
                                        <li>{{ $comment->name }} on <a
                                                href="{{ route('poster.show', $comment->poster_id) }}"
                                                style="color: #0E6177;"
                                                class="text-decoration-none">{{ Poster::where('id', $comment->poster_id)->first()->poster_title }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No data available.</p>
                            @endif
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection
