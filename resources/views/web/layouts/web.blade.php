@extends('web.layouts.app')
@section('page')
    <div id="app">
        <!-- Header -->
        @include('web.partials._header')
        <!-- /.Header -->
        @yield('content')
        <nav id="navigation-menu">
            <ul id="panel-menu">
                @if(!empty($menus))
                    @foreach ($menus as $shop)
                        @include('web.components.menu.mobile', ['item'=>$shop])
                    @endforeach
                @endif
            </ul>
        </nav>
        <!-- Main Footer -->
        @include('web.partials._footer')
        @include('web.partials._notification')
        @include('web.partials._offcanvas')
    </div>

    <div id="fs-popup-home" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background: transparent; box-shadow: none; border: none;">

                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                    <img data-src="{{ asset('images/close-modal.png') }}" alt="close_modal" loading="lazy" height="43px" width="43px" class="img-fluid lazy">
                </button>
                <div class="form-bao-gia">
                    <img class="img-fluid logo-cati-popup lazy" data-src="{{ asset('images/logo-mk.png') }}" alt="{{ $setting['site_name'] }}" width="90px" height="85px" />
                    <div class="text-center">Báo giá trong 5 phút</div>
                    <form method="post" action="{{ route('saveQuote') }}" name="contact_home" class="form">
                        @csrf
                        <input type="text" name="phone_contact" id="phone_contact" placeholder="Số điện thoại" aria-label="Số điện thoại" class="form-control" required >
                        <input type="text" name="number_contact" id="number_contact" placeholder="Số lượng dự kiến" aria-label="Số lượng dự kiến" class="form-control" required >
                        <input type="submit" value="Nhận báo giá" class="btn btn-success buttom-contact">
                        <input type="text" name="contact_me_by_fax_only" aria-label="contact_me_by_fax_only" style="opacity: 0 !important" tabindex="-1" autocomplete="off">
                    </form>
                </div>
            </div><!--end: .modal-content-->
        </div><!--end: .modal-dialog-->
    </div><!--end: #fs-alert-->
@endsection

@section('link')
    <link rel="stylesheet" href="{{ mix('/css/web/style.css') }}" media="screen">
@endsection

@section('script')
{{--    <script src="{{ mix('/js/web/main.js') }}"></script>--}}
    <script src="{{ mix('js/web/manifest.js') }}"></script>
    <script src="{{ mix('js/web/vendor.js') }}"></script>
    <!-- Scripts -->
    <script>
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
        document.addEventListener(
            "DOMContentLoaded", () => {
                new Mmenu( "#navigation-menu", {
                    // classes: 'mm-white mm-slide',
                    // searchfield: false,
                    // counters: false,
                    // header: false,
                });
                document.querySelector('.mm-wrapper').classList.remove('mm-wrapper--position-left');
            }
        );
        setTimeout(function () {
            $('#fs-popup-home').modal('show');
        }, 20000);
    </script>
    <div id="fb-root"></div>
    <script loading="lazy" defer>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=106623403474888&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@endsection
