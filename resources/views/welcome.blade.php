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
                                    {{-- Row 1 --}}
                                    <div class="row mt-4">
                                        @foreach($posters as $key => $poster)
                                            @if($loop->iteration == 1)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif

                                            @if($loop->iteration == 2)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif

                                            @if($loop->iteration == 3)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    {{-- Row 2 --}}
                                    <div class="row mt-4">
                                        @foreach($posters as $key => $poster)
                                            @if($loop->iteration == 4)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif

                                            @if($loop->iteration == 5)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif

                                            @if($loop->iteration == 6)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>

                                    {{-- Row 3 --}}
                                    <div class="row mt-4">
                                        @foreach($posters as $key => $poster)
                                            @if($loop->iteration == 7)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif

                                            @if($loop->iteration == 8)
                                                <div class="col-md-4">
                                                    @include('items.poster')
                                                </div>
                                            @endif

                                            @if($loop->iteration == 9)
                                                <div class="col-md-4">
                                                    @include('items.poster')
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
                                <p class="pt-2">No data available.</p>
                            @endif
                        </section>
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection
