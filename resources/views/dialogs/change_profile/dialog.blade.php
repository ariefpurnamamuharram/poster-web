<div class="modal fade" id="modalChangeProfile" tabindex="-1" role="document" aria-labelledby="modalChangeProfileTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalChangeProfileTitle">
                    Change profile
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="change-profile-form" action="{{ route('user.update.profile') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Username --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="username" class="col-form-label">
                                Username<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-9">
                            <input type="text" id="username" name="username"
                                   class="form-control @error('username') is-invalid @enderror" placeholder="Username"
                                   value="{{ Auth::user()->name }}" required>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('username') }}
                            </span>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="email" class="col-form-label">
                                Email<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-9">
                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                   value="{{ Auth::user()->email }}" required>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('email') }}
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>

                <button class="btn btn-warning" type="button"
                        onclick="event.preventDefault(); document.getElementById('change-profile-form').submit();">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
