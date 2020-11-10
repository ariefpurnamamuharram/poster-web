<div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="modalChangePasswordTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalChangePasswordTitle">
                    Ganti password
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-labelledby="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="change-password-form" action="{{ route('user.change.password') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Old password --}}
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="oldPassword" class="col-form-label">
                                Password lama<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-7">
                            <input id="oldPassword" name="oldPassword" type="password"
                                   class="form-control @error('oldPassword') is-invalid @enderror"
                                   placeholder="Password lama Anda" required>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('oldPassword') }}
                            </span>
                        </div>
                    </div>

                    {{-- New password --}}
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="newPassword" class="col-form-label">
                                Password baru<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-7">
                            <input id="newPassword" name="newPassword" type="password"
                                   class="form-control @error('newPassword') is-invalid @enderror"
                                   placeholder="Password baru Anda" required>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('newPassword') }}
                            </span>
                        </div>
                    </div>

                    {{-- New password confirmation --}}
                    <div class="form-group row">
                        <div class="col-md-5">
                            <label for="newPassword_confirmation" class="col-form-label">
                                Konfirmasi password<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-7">
                            <input id="newPassword_confirmation" name="newPassword_confirmation" type="password"
                                   class="form-control @error('newPassword') is-invalid @enderror"
                                   placeholder="Konfirmasi password baru Anda" required>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('newPassword') }}
                            </span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">
                    Tutup
                </button>

                <button class="btn btn-warning" onclick="document.getElementById('change-password-form').submit();">
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>
