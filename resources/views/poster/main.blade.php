@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    {{-- Poster title --}}
                    <h4>{{ $poster->poster_title }}</h4>

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
                                <form id="poster-vote-dislike-form" action="{{ route('poster.vote.dislike') }}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <input type="hidden" name="posterID" value="{{ $poster->id }}">
                                </form>

                                <a href="#" class="btn btn-danger hvr-icon-pulse-grow"
                                   onclick="document.getElementById('poster-vote-dislike-form').submit();">
                                    <span class="badge badge-light">{{ $poster->total_dislikes }}</span>
                                    <span>Dislike</span>
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

                    <br/>

                    <hr/>

                    {{-- Comment --}}
                    @if(count(PosterComment::where('poster_id', $poster->id)->get()) != 0)
                        <h4>
                            {{ count(PosterComment::where('poster_id', $poster->id)->get()) + count(PosterCommentReply::where('poster_id', $poster->id)->get()) }}
                            Responses
                        </h4>

                        <br/>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <tbody>
                                @foreach(PosterComment::where('poster_id', $poster->id)->get() as $comment)
                                    <tr>
                                        <td>
                                            <div>
                                                {{-- Comment --}}
                                                @include('items.comment')

                                                {{-- Reply section --}}
                                                <div class="mt-2">
                                                    <a href="#collapseReply{{ $comment->id }}" data-toggle="collapse"
                                                       style="color: #0E6177;">Reply</a>

                                                    <div class="collapse" id="collapseReply{{ $comment->id }}">
                                                        <div class="pl-4 pr-4 pt-4 pb-2">
                                                            <h5>Reply a Comment</h5>

                                                            <hr/>

                                                            {{-- Reply comment form --}}
                                                            <form action="{{ route('poster.reply') }}" method="post"
                                                                  enctype="multipart/form-data">
                                                                @csrf

                                                                {{-- Poster ID --}}
                                                                <input type="hidden" name="replyPosterID"
                                                                       value="{{ $poster->id }}">

                                                                {{-- Comment ID --}}
                                                                <input type="hidden" name="replyCommentID"
                                                                       value="{{ $comment->id }}">

                                                                {{-- Name --}}
                                                                <div class="form-group row">
                                                                    <div class="col-md-8">
                                                                        <label for="replyName">
                                                                            Name<span class="text-danger">*</span>
                                                                        </label>

                                                                        <input type="text" id="replyName"
                                                                               name="replyName"
                                                                               class="form-control @error('replyName') is-invalid @enderror"
                                                                               placeholder="Your name"
                                                                               value="{{ old('replyName') }}" required>

                                                                        <span class="invalid-feedback" role="alert">
                                                                            {{ $errors->first('replyName') }}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                {{-- Email --}}
                                                                <div class="form-group row">
                                                                    <div class="col-md-8">
                                                                        <label for="replyEmail">
                                                                            Email<span class="text-danger">*</span>
                                                                        </label>

                                                                        <input type="text" id="replyEmail"
                                                                               name="replyEmail"
                                                                               class="form-control @error('replyEmail') is-invalid @enderror"
                                                                               placeholder="Your email"
                                                                               value="{{ old('replyEmail') }}" required>

                                                                        <span class="invalid-feedback" role="alert">
                                                                            {{ $errors->first('replyEmail') }}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment --}}
                                                                <div class="form-group">
                                                                    <label for="replyComment">
                                                                        Comment<span class="text-danger">*</span>
                                                                    </label>

                                                                    <textarea id="replyComment" name="replyComment"
                                                                              class="form-control @error('replyComment') is-invalid @enderror"
                                                                              placeholder="Comments"
                                                                              rows="5"
                                                                              required>{{ old('replyComment') }}</textarea>

                                                                    <span class="invalid-feedback" role="alert">
                                                                        {{ $errors->first('replyComment') }}
                                                                    </span>
                                                                </div>

                                                                {{-- Post reply button --}}
                                                                <div class="form-group">
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit" class="btn btn-warning">
                                                                            Post Reply
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @foreach(PosterCommentReply::where(['poster_id' => $poster->id, 'comment_id' => $comment->id])->get() as $key => $reply)
                                                <div class="pl-4">
                                                    <hr/>

                                                    {{-- Comment replies --}}
                                                    @include('items.reply')

                                                    {{-- Reply section --}}
                                                    <div class="mt-2">
                                                        <a href="#collapseComment{{ $comment->id }}-Reply{{ $reply->id }}"
                                                           data-toggle="collapse"
                                                           style="color: #0E6177;">Reply</a>

                                                        <div class="collapse"
                                                             id="collapseComment{{ $comment->id }}-Reply{{ $reply->id }}">
                                                            <div class="pl-4 pr-4 pt-4 pb-2">
                                                                <h5>Reply a Comment</h5>

                                                                <hr/>

                                                                {{-- Reply comment form --}}
                                                                <form action="{{ route('poster.reply') }}" method="post"
                                                                      enctype="multipart/form-data">
                                                                    @csrf

                                                                    {{-- Poster ID --}}
                                                                    <input type="hidden" name="replyPosterID"
                                                                           value="{{ $poster->id }}">

                                                                    {{-- Comment ID --}}
                                                                    <input type="hidden" name="replyCommentID"
                                                                           value="{{ $comment->id }}">

                                                                    {{-- Name --}}
                                                                    <div class="form-group row">
                                                                        <div class="col-md-8">
                                                                            <label for="replyName">
                                                                                Name<span class="text-danger">*</span>
                                                                            </label>

                                                                            <input type="text" id="replyName"
                                                                                   name="replyName"
                                                                                   class="form-control @error('replyName') is-invalid @enderror"
                                                                                   placeholder="Your name"
                                                                                   value="{{ old('replyName') }}"
                                                                                   required>

                                                                            <span class="invalid-feedback" role="alert">
                                                                            {{ $errors->first('replyName') }}
                                                                        </span>
                                                                        </div>
                                                                    </div>

                                                                    {{-- Email --}}
                                                                    <div class="form-group row">
                                                                        <div class="col-md-8">
                                                                            <label for="replyEmail">
                                                                                Email<span class="text-danger">*</span>
                                                                            </label>

                                                                            <input type="text" id="replyEmail"
                                                                                   name="replyEmail"
                                                                                   class="form-control @error('replyEmail') is-invalid @enderror"
                                                                                   placeholder="Your email"
                                                                                   value="{{ old('replyEmail') }}"
                                                                                   required>

                                                                            <span class="invalid-feedback" role="alert">
                                                                            {{ $errors->first('replyEmail') }}
                                                                        </span>
                                                                        </div>
                                                                    </div>

                                                                    {{-- Comment --}}
                                                                    <div class="form-group">
                                                                        <label for="replyComment">
                                                                            Comment<span class="text-danger">*</span>
                                                                        </label>

                                                                        <textarea id="replyComment" name="replyComment"
                                                                                  class="form-control @error('replyComment') is-invalid @enderror"
                                                                                  placeholder="Comments"
                                                                                  rows="5"
                                                                                  required>{{ old('replyComment') }}</textarea>

                                                                        <span class="invalid-feedback" role="alert">
                                                                        {{ $errors->first('replyComment') }}
                                                                    </span>
                                                                    </div>

                                                                    {{-- Post reply button --}}
                                                                    <div class="form-group">
                                                                        <div class="d-flex justify-content-end">
                                                                            <button type="submit"
                                                                                    class="btn btn-warning">
                                                                                Post Reply
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                <form action="{{ route('poster.comment') }}" method="post"
                                      enctype="multipart/form-data">
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
                                                  class="form-control @error('comment') is-invalid @enderror"
                                                  placeholder="Comments"
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
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        autosize(document.getElementById("abstract"));
    </script>
@endsection
