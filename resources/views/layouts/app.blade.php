<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Site title --}}
    <title>{{ SiteSettings::where('key', SiteSettings::SETTING_SITE_TITLE)->first()->value }}</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}"/>

    {{-- Animate css --}}
    <link href="{{ asset('animate/animate.min.css') }}" rel="stylesheet">

    {{-- Bootsrap css --}}
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Hover css --}}
    <link href="{{ asset('hover/css/hover-min.css') }}" rel="stylesheet">

    {{-- Other styles --}}
    <style>
        @font-face {
            font-family: "Product Sans";
            src: url("{{ asset('fonts/ps_regular.ttf') }}");
        }

        html, body {
            font-family: "Product Sans", sans-serif;
            background-color: #ffffff !important;
            height: 100%;
        }

        footer {
            font-size: 0.75em;
            padding: 12px;
        }

        .copyright {
            font-family: sans-serif;
        }

        .page-content {
            flex: 1 0 auto;
        }
    </style>
</head>
<body class="d-flex flex-column">
<div id="app" class="page-content">
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            {{-- Logo Divisi Metabolik Endokrin RSCM --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/images/metabolik-endokrin.png') }}" height="54px"
                     alt="Logo Divisi Metabolik Endokrin RSCM">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                {{-- Left side of navbar --}}
                <ul class="navbar-nav mr-auto">
                    {{-- Home --}}
                    <a class="nav-link text-dark" href="{{ url('/') }}">Home</a>

                    @guest
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownCategory" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="text-dark">Category</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left animate__fadeInDown animate__animated"
                                 aria-labelledby="navbarDropdownCategory">
                                <a class="dropdown-item" href="{{ route('category', '1') }}">
                                    Diabetes Mellitus
                                </a>

                                <a class="dropdown-item" href="{{ route('category', '2') }}">
                                    Diabetic Foot
                                </a>

                                <a class="dropdown-item" href="{{ route('category', '3') }}">
                                    Metabolic Syndrome
                                </a>

                                <a class="dropdown-item" href="{{ route('category', '4') }}">
                                    Dyslipidemia
                                </a>

                                <a class="dropdown-item" href="{{ route('category', '5') }}">
                                    Obesity
                                </a>
                            </div>
                        </li>
                    @endguest

                    @auth
                        {{-- Manager --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownManager" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="text-dark">Collections Manager</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left animate__fadeInDown animate__animated"
                                 aria-labelledby="navbarDropdownManager">
                                {{-- Poster --}}
                                <a class="dropdown-item" href="{{ route('administrator.manager.posters') }}">
                                    Poster
                                </a>
                            </div>
                        </li>

                        {{-- Upload --}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdownUpload" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="text-dark">Upload</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-left animate__fadeInDown animate__animated"
                                 aria-labelledby="navbarDropdownUpload">
                                {{-- Poster --}}
                                <a class="dropdown-item" href="{{ route('administrator.upload.poster') }}">
                                    Poster
                                </a>
                            </div>
                        </li>

                        {{-- Settings --}}
                        <a class="nav-link text-dark" href="{{ route('administrator.settings.page') }}">Settings</a>
                    @endauth
                </ul>

                {{-- Right side of navbar --}}
                <ul class="navbar-nav ml-auto">
                    {{-- Authentication Links --}}
                    @guest
                        {{-- Login --}}
                        @if(SiteSettings::where('key', SiteSettings::SETTING_LOGIN_LINK)->first()->value == 1)
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
                                </li>
                            @endif
                        @endif

                        @if (Route::has('register'))
                            {{-- Register --}}
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <span class="text-dark">{{ Auth::user()->name }}</span> (Administrator)
                            </a>

                            <div class="dropdown-menu dropdown-menu-right animate__fadeInDown animate__animated"
                                 aria-labelledby="navbarDropdown">
                                {{-- Change profile --}}
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalChangeProfile">
                                    Change profile
                                </a>

                                {{-- Change password --}}
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                   data-target="#modalChangePassword">
                                    Change password
                                </a>

                                {{-- Logout --}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                {{-- Logout form --}}
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main class="py-4">
        @yield('content')
    </main>
</div>

{{-- Footer --}}
<footer>
    <hr/>

    <div class="d-flex justify-content-center">
        <span class="text-center"><span class="text-nowrap">Copyright <span class="copyright">&copy;</span> 2020 <a
                    class="text-dark"
                    href="https://metabolikendokrin.com"
                    target="_blank">Divisi Metabolik Endokrin FKUI-RSCM</a></span> by <span class="text-nowrap"><a
                    class="text-dark" href="https://linkedin.com/in/ariefpurnamamuharram" target="_blank">Arief Purnama Muharram</a></span></span>
    </div>
</footer>

{{-- Message modal --}}
@include('dialogs.message.dialog')

@auth
    {{-- Change profile dialog --}}
    @include('dialogs.change_profile.dialog')

    {{-- Change password dialog --}}
    @include('dialogs.change_password.dialog')
@endauth

{{-- Bootstrap script --}}
<script src="{{ asset('jquery/jquery-3.5.1.slim.min.js') }}"></script>
<script src="{{ asset('popper/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

{{-- Autosize script --}}
<script src="{{ asset('autosize/autosize.min.js') }}"></script>

{{-- Font awesome --}}
<script src="https://kit.fontawesome.com/9cb6f587df.js" crossorigin="anonymous"></script>

{{-- Message modal script --}}
@include('dialogs.message.dialog_script')

{{-- Additional scripts --}}
@yield('script')
</body>
</html>
