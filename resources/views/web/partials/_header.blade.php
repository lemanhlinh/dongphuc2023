<header class="row-content" id="header" >
    <div class="backgr-menu" data-spy="affix" data-offset-top="100">
        <div class="container">
            <div class="header-logo clearfix" >
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-3 d-block d-md-none">
                        <div id="page">
                            <div class="header_menu">
                                <a href="#navigation-menu"><i class="fas fa-bars"></i></a>
                            </div>
                        </div>
                    </div>
                    @if (request()->is('home'))
                    <h1 class="text-reset d-inline col-lg-2 col-md-2 col-sm-6 col-6 m-0">
                        <a class="logo-image" href="{{ route('home') }}" title="{{ $setting['site_name'] }}">
                            <img class="img-fluid logo-cati" width="61" height="61" src="{{ $setting['logo'] }}" alt="{{ $setting['site_name'] }}" />
                        </a>
                    </h1>
                    @else
                        <a class="logo-image col-lg-2 col-md-2 col-sm-6 col-6" href="{{ route('home') }}" title="{{ $setting['site_name'] }}">
                            <img class="img-fluid logo-cati" width="61" height="61" src="{{ $setting['logo'] }}" alt="{{ $setting['site_name'] }}" />
                        </a>
                    @endif
                    <div class="col-lg-10 col-md-10 col-sm-9 col-xs-9 d-none d-sm-none d-md-block">
                        <nav class="row-item" id="nav">
                            @if(!empty($menus))
                                @foreach ($menus as $shop)
                                    @include('web.components.menu.top', ['item'=>$shop])
                                @endforeach
                            @endif
                        </nav>
                        <!-- END: nav -->
                    </div>
                </div>
            </div><!-- END: .header-logo -->
            <div class="clearfix"></div>
        </div>
    </div>
</header>
<!-- END: header -->
