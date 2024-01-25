<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel8') }}</title>

    <!--Icon -->
    <link rel="icon" href="{{ asset('content/imgs/favicon-hr.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('content/imgs/favicon-hr.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('content/imgs/favicon-hr.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('content/fontawesome-free-5.15.4-web/css/all.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('content/bootstrap-5.1.3/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Bootstrap Table -->
    <link href="{{ asset('content/bootstrap-table-1.21.1/bootstrap-table.min.css') }}" rel="stylesheet" />
    <!-- Toastr -->
    <link href="{{ asset('content/toastr-2.1.3/toastr.min.css') }}" rel="stylesheet" />
    <!-- Aos -->
    <link href="{{ asset('content/aos-2.3.1/aos.css') }}" rel="stylesheet" />
    <!-- menukit css and js  -->
    <link href="{{ asset('content/menukit/menukit.css') }}" rel="stylesheet" />
    <script src="{{ asset('content/menukit/menukit_m1.js') }}"></script>
    <!-- Select2 -->
    <link href="{{ asset('content/select2-4.0.13/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('content/select2-bootstrap-1.3.0/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet" />
    <!-- Line-Awesome -->
    <link href="{{ asset('content/line-awesome-1.3.0/css/line-awesome.min.css') }}" rel="stylesheet" />
    <!-- SwetAlert -->
    <link href="{{ asset('content/sweetalert2-11.4.29/sweetalert2.min.css') }}" rel="stylesheet" />
    <!-- JqueryUI -->
    <link href="{{ asset('content/jquery-ui-1.13.1/jquery-ui.css') }}" rel="stylesheet" />
    <style>
        .preloader {
            background-image: url('/imgs/preLoad2.gif');
            position: fixed;
            width: 100%;
            height: 100vh;
            background-color: #ffffffd6;
            background-repeat: no-repeat;
            background-position: center;
            background-size: 60px !important;
            z-index: 9999;
        }
    </style>
    <!-- Site -->
    <link href="{{ asset('css/site.css') }}" rel="stylesheet" />
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- scripts -->
    @yield("styles")
</head>
<body class="d-flex flex-column h-100">
    <div class="preloader"></div>
    <!-- Nav bar -->
    @include('layouts.include._nav')
    <!-- Nav bar -->

    <main class="py-1 p-lg-4">
        @yield('content')
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">{{ config('app.name', 'Laravel8') }} {{  date("Y") }}.</span>
        </div>
    </footer>

    <a href="#page-top" id="back-to-top" class="page-scroll" title="Back to top" style="display: none;"><i class="fas fa-arrow-alt-circle-up"></i></a>
{{--     <div id="spinner-div">
        <div class="spinner-border text-primary" role="status">
        </div>
    </div> --}}

    {{-- Jquery js --}}
    <script src="{{ asset('content/jquery-3.6.0/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('content/fontawesome-free-5.15.4-web/js/all.js') }}"></script>
    {{-- Bootstrap js--}}
    <script src="{{ asset('content/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
    {{-- Bootstrap Table --}}
    <script src="{{ asset('content/bootstrap-table-1.21.1/bootstrap-table.min.js') }}"></script>
    {{-- Jquery validation --}}
    <script src="{{ asset('content/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('content/jquery-validation-unobtrusive-3.2.12/jquery.validate.unobtrusive.min.js') }}"></script>
    <script src="{{ asset('content/jquery.unobtrusive-ajax/jquery.unobtrusive-ajax.min.js') }}"></script>
    <script src="{{ asset('content/jquery-validation-unobtrusive-3.2.12/jqeury.validate.unobtrusive.numericlessthan.js') }}"></script>
    {{-- <script src="{{ asset('content/apphr/CustomValidator/Common.js') }}"></script> --}}
    {{-- Toastr --}}
    <script src="{{ asset('content/toastr-2.1.3/toastr.min.js') }}"></script>
    {{-- Aos --}}
    <script src="{{ asset('content/aos-2.3.1/aos.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('content/select2-4.0.13/js/select2.min.js') }}"></script>
    <script src="{{ asset('content/select2-4.0.13/js/i18n/es.js') }}"></script>
    {{-- SwetAlert --}}
    <script src="{{ asset('content/sweetalert2-11.4.29/sweetalert2.min.js') }}"></script>
    {{-- JqueryUI --}}
    <script src="{{ asset('content/jquery-ui-1.13.1/jquery-ui.js') }}"></script>
    <script src="{{ asset('content/jquery-ui-1.13.1/jquery.ui.autocomplete.scroll.js') }}"></script>
    {{-- loading overlay  --}}
    <script src="{{ asset('content/jquery-loading-overlay-2.1.7/loadingoverlay.js') }}"></script>
    {{-- Moment --}}
    <script src="{{ asset('content/moment-2.27.0/moment.min.js') }}"></script>

    {{-- site --}}
    <script src="{{ asset('content/functions.js') }}"></script>
    <script src="{{ asset('js/site.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')
    <script>
        window.baseUrl="{{URL::to('/')}}";
        window.onload = function () {
            $('.preloader').fadeOut();
        }
    </script>
</body>
</html>
