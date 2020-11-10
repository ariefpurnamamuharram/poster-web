@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Poster title --}}
        <h3>{{ $poster->poster_title }}</h3>

        {{-- Post information --}}
        <span class="text-secondary">Posted {{ date('F j, Y', strtotime($poster->created_at)) }}
            by {{ $poster->posted_by_email }}</span>

        <hr/>

        {{-- Poster --}}
        <img src="{{ Storage::url($poster->poster_filename) }}" class="img-fluid mt-2"
             alt="Poster {{ $poster->poster_filename }}"/>

        {{-- Authors information --}}
        <section style="margin-top: 42px;">
            <h5 class="font-weight-bold" style="color: #D78670;">Authors</h5>

            <div class="pt-3">
                <p>{{ $poster->poster_authors }}</p>
                <p>{{ $poster->author_affiliations }}</p>
            </div>
        </section>

        {{-- Category --}}
        <section style="margin-top: 32px;">
            <h5 class="font-weight-bold" style="color: #D78670;">Category</h5>

            <div class="pt-3">
                <span class="badge badge-info">
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
        </section>

        {{-- Abstract --}}
        <section style="margin-top: 32px;">
            <h5 class="font-weight-bold" style="color: #D78670;">
                <label for="abstract">Abstract</label>
            </h5>

            <div>
                @if(!empty($poster->poster_abstract))
                    <textarea readonly class="form-control-plaintext" id="abstract"
                              rows="1">{{ $poster->poster_abstract }}</textarea>
                @else
                    <span>-</span>
                @endif
            </div>

            <div class="mt-3">
                <span><span
                        class="font-weight-bold">Keywords:</span> @if(!empty($poster->poster_keywords)) {{ $poster->poster_keywords }} @else
                        - @endif</span>
            </div>

            <div class="d-flex justify-content-end" style="margin-top: 32px;">
                <div class="btn-group" role="group">
                    {{-- Vote dislike --}}
                    <form id="poster-vote-dislike-form" action="{{ route('poster.vote.dislike') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="posterID" value="{{ $poster->id }}">
                    </form>

                    <a href="#" class="btn btn-danger hvr-icon-pulse-grow"
                       onclick="document.getElementById('poster-vote-dislike-form').submit();">
                        <span class="badge badge-light">{{ $poster->total_dislikes }}</span> <span>Dislike</span>
                        <i class="fas fa-thumbs-down hvr-icon"></i>
                    </a>

                    {{-- Vote like --}}
                    <form id="poster-vote-like-form" action="{{ route('poster.vote.like') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="posterID" value="{{ $poster->id }}">
                    </form>

                    <a href="#" class="btn btn-success hvr-icon-pulse-grow"
                       onclick="document.getElementById('poster-vote-like-form').submit();">
                        <span class="badge badge-light">{{ $poster->total_likes }}</span> <span>Like</span>
                        <i class="fas fa-thumbs-up hvr-icon"></i>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        autosize(document.getElementById("abstract"));
    </script>
@endsection