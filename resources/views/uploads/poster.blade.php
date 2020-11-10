@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header">Unggah Poster Baru</div>

            <div class="card-body">
                <form method="post" action="{{ route('administrator.upload.poster.post') }}"
                      enctype="multipart/form-data">
                    @csrf

                    {{-- Title --}}
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="title" class="col-form-label">
                                Judul<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-10">
                            <input type="text" id="title" name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   placeholder="Judul penelitian" value="{{ old('title') }}" required>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('title') }}
                            </span>
                        </div>
                    </div>

                    {{-- Authors --}}
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="authors" class="col-form-label">
                                Pengarang<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-10">
                            <input id="authors" name="authors" type="text"
                                   class="form-control @error('authors') is-invalid @enderror"
                                   placeholder="Nama pengarang" value="{{ old('authors') }}" required>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('authors') }}
                            </span>
                        </div>
                    </div>

                    {{-- Affiliations --}}
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="affiliations" class="col-form-label">
                                Afiliasi<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-10">
                            <textarea id="affiliations" name="affiliations"
                                      class="form-control @error('affiliations') is-invalid @enderror"
                                      placeholder="Afiliasi pengarang" rows="2"
                                      required>{{ old('affiliations') }}</textarea>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('affiliations') }}
                            </span>
                        </div>
                    </div>

                    {{-- Category --}}
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="category" class="col-form-label">
                                Kategori<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-10">
                            <select id="category" name="category"
                                    class="form-control @error('category') is-invalid @enderror" required>
                                <option selected disabled>-- Pilih kategori poster --</option>
                                <option value="1" @if(old('category') == 1) selected @endif>Diabetes mellitus</option>
                                <option value="2" @if(old('category') == 2) selected @endif>Diabetic foot</option>
                                <option value="3" @if(old('category') == 3) selected @endif>Metabolic syndrome</option>
                                <option value="4" @if(old('category') == 4) selected @endif>Dyslipidemia</option>
                                <option value="5" @if(old('category') == 5) selected @endif>Obesity</option>
                            </select>
                        </div>
                    </div>

                    {{-- Poster --}}
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label class="col-form-label">
                                Berkas poster<span class="text-danger">*</span>
                            </label>
                        </div>

                        <div class="col-md-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="poster" name="poster" required>
                                <label class="custom-file-label" for="poster">Pilih file...</label>
                            </div>
                        </div>
                    </div>

                    {{-- Abstract --}}
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="abstract" class="col-form-label">
                                Abstrak
                            </label>
                        </div>

                        <div class="col-md-10">
                            <textarea id="abstract" name="abstract"
                                      class="form-control @error('abstract') is-invalid @enderror"
                                      placeholder="Abstrak" rows="6">{{ old('abstract') }}</textarea>

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('abstract') }}
                            </span>
                        </div>
                    </div>

                    {{-- Keywords --}}
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="keywords" class="col-form-label">
                                Kata kunci
                            </label>
                        </div>

                        <div class="col-md-10">
                            <input type="text" id="keywords" name="keywords"
                                   class="form-control @error('keywords') is-invalid @enderror"
                                   placeholder="Kata kunci" value="{{ old('keywords') }}">

                            <span class="invalid-feedback" role="alert">
                                {{ $errors->first('keywords') }}
                            </span>
                        </div>
                    </div>

                    {{-- Submit button --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#poster').on('change', function () {
            var filename = $(this).val().replace('C:\\fakepath\\', '');
            $(this).next('.custom-file-label').html(filename);
        })
    </script>
@endsection
