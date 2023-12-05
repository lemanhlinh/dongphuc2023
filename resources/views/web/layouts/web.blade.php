@extends('web.layouts.app')
@section('page')
    <div id="app">
        <!-- Header -->
        @include('web.partials._header')
        <!-- /.Header -->
        <div class="content">
            @yield('content')
        </div>
        <!-- Main Footer -->
        @include('web.partials._footer')
        @include('web.partials._notification')
        @include('web.partials._offcanvas')
    </div>
    <nav id="navigation-menu">
        <ul>
            @if(!empty($menus))
                @foreach ($menus as $shop)
                    @include('web.components.menu.mobile', ['item'=>$shop])
                @endforeach
            @endif
        </ul>
    </nav>
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('/css/web/style.css') }}" media="screen" rel="preload" as="style">
    <link rel="stylesheet" href="{{ asset('/css/web/style.css') }}" media="screen">
@endsection

@section('script')
    <div id="fb-root"></div>
    <script loading="lazy">(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1&appId=106623403474888&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <script type="text/javascript" loading="lazy">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5d04e12253d10a56bd7a38e3/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
@endsection
