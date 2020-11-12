@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header bg-white">Settings</div>

            <div class="card-body">
                <form action="{{ route('administrator.settings.update') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkLoginLink" name="checkLoginLink"
                                   value="1"
                                   @if(SiteSettings::where('key', SiteSettings::SETTING_LOGIN_LINK)->first()->value == 1) checked @endif>

                            <label class="form-check-label" for="checkLoginLink">
                                Show login link on navigation bar
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
