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
                    <form id="poster-vote-dislike-form" action="{{ route('vote.poster.dislike') }}" method="post"
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
                    <form id="poster-vote-like-form" action="{{ route('vote.poster.like') }}" method="post"
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

        <br/>

        <hr/>

        {{-- Comment --}}
        @if(count($comments) != 0)
            <h4>{{ count($comments) }} Responses</h4>

            <br/>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ asset('assets/images/avatar.png') }}" height="54px" alt="Avatar">
                                    </div>

                                    <div class="col-md-11">
                                        <span><span
                                                class="font-weight-bold">{{ $comment->name }}</span> says:</span><br/>
                                        <span class="text-secondary">{{ date('F j, Y', strtotime($comment->created_at)) }} at {{ date('H:i', strtotime($comment->created_at)) }}</span>
                                    </div>
                                </div>

                                <br/>

                                <div>
                                    {{ $comment->comment }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Leave a comment --}}
        <section style="margin-top: 32px;">
            <h4>Leave a Comment</h4>

            <br/>

            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('comment.poster') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Poster ID --}}
                        <input type="hidden" name="posterID" value="{{ $poster->id }}">

                        {{-- Name --}}
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="name">Name<span class="text-danger">*</span></label>

                                <input type="text" id="name" name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Your name" value="{{ old('name') }}" required>

                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('name') }}
                                </span>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="email">Email<span class="text-danger">*</span></label>

                                <input type="text" id="email" name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Your email" value="{{ old('email') }}" required>

                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('email') }}
                                </span>
                            </div>
                        </div>

                        {{-- Comment --}}
                        <div class="form-group">
                            <label for="comment">Comment<span class="text-danger">*</span></label>

                            <textarea id="comment" name="comment"
                                      class="form-control @error('comment') is-invalid @enderror" placeholder="Comments"
                                      rows="5" required>{{ old('comment') }}</textarea>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('comment') }}
                            </span>
                        </div>

                        {{-- Post comment button --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Post Comment</button>
                        </div>
                    </form>
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
