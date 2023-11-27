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
    <script src="{{ asset('/js/web/main.js') }}"></script>
    <!-- Scripts -->
    <script>
        window.onload = function() {
            let toastrSuccsee = "{{ Session::get('success') }}";
            let toastrDanger = "{{ Session::get('danger') }}";
            if (toastrDanger.length > 0 || toastrSuccsee.length > 0) {
                if (toastrDanger.length > 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: toastrDanger,
                    });
                    toastr["error"](toastrDanger)
                } else {
                    Swal.fire(
                        'Thành công!',
                        toastrSuccsee,
                        'success'
                    )
                }
            }

            setTimeout(function () {
                $('#fs-popup-home').modal('show');
            }, 7000);

            (function() {
                document.addEventListener('touchstart', function(e) {
                }, { passive: true });
                document.addEventListener('wheel', function(e) {
                }, { passive: true });
            })();
        };
    </script>
    @yield('script')
</body>
</html>
