<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link type="image/x-icon" href="{{ asset('images/favicon.ico') }}" rel="icon">
    <!-- Fonts -->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/web/slick.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/web/slick-theme.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/web/imagehover.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/web/jquery.mmenu.all.css') }}" rel="stylesheet" media="screen">
    <style>
        #navigation-menu {
            display: none;
        }
        .header_menu a {
            display: block;
            width: 48px;
            height: 46px;
            position: absolute;
            left: 10px;
            border-radius: 5px;
            top: 4px;
            color: #fff;
        }
        .header_menu a i{
            font-size: 30px;
            line-height: 54px;
        }
        .header_menu {
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            line-height: 40px;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            width: 42px;
            height: 40px;
        }
    </style>
    @yield('link')
</head>
<body>
    @yield('page')
    <!-- jQuery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/web/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/web/slick.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/6302d443cd.js"></script>
    <script src="{{ asset('/js/web/jquery.mmenu.min.all.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    <script defer>
        (function() {
            document.addEventListener('touchstart', function(e) {
            }, { passive: true });
            document.addEventListener('wheel', function(e) {
            }, { passive: true });
        })();
    </script>
    <script defer>
        window.onload = function() {
            $(function () {
                $('nav#navigation-menu').mmenu({
                    classes: 'mm-white mm-slide',
                    searchfield: false,
                    counters: false,
                    header: false,
                });
            });
        };
    </script>
    @yield('script')
</body>
</html>
