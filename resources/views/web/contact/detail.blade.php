@extends('web.layouts.web')

@section('content')
    <div class="container">
        <div class="main row-content" id="main">
            <div class="clearfix"></div>
            <section id="main-breadcrumbs" class="main-breadcrumbs">
                <div class="breadcrumbs row-item">
                    {{ Breadcrumbs::render('contact') }}
                </div><!-- END: .breadcrumb -->
                <div class="clear"></div>
            </section>
            <div class="clearfix"></div>
            <div class="main-content row-item ">
                <div class="row">
                    <div class="main-column-content col-lg-9 col-md-9 col-sm-12 col-xs-12 order-md-2">
                        <div class="contact-main row-item">
                            <h1 class="title-module">
                                Liên hệ với đồng phục Cati
                            </h1><!-- END: .name-contact -->
                            <div class="wapper-content-page clearfix">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        {!! $setting['info_contact'] !!}
                                        @include('web.contact.form')
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        {!! $setting['map_contact'] !!}
                                    </div>
                                </div>
                            </div><!-- END: .wapper-content-page -->
                        </div><!-- END: .contact -->
                    </div>
                    <div class="main-column-left col-lg-3 col-md-3 col-sm-12 col-xs-12 order-md-1">
                        <div class="menu_right clearfix hidden-xs">
                            <div class="title-menu-pro">
                                <i class="fas fa-bars"></i>Menu danh mục
                            </div>
                            <div id="cssmenu_content">
                                <ul class="product_menuproduct_menu_default">
                                    @forelse($cat_product_home as $item)
                                        <li class="level_0 first-item" >
                                            <a href="">{{ $item->name }}<i class="fas fa-angle-right"></i></a>
                                            @if(count($item->children) > 0)
                                                <ul class="wrapper_children_level0">
                                                    @forelse($item->children as $val)
                                                        <li class="level_1 first-item">
                                                            <a href="">{{ $val->name }}</a>
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            @endif
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @forelse($banners as $item)
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="banner-list">

                                    <div class="banner_item_0 banner_item" id="banner_item_29">
                                        <p style="text-align: center;"><a
                                                href="{{ $item->link }}"><img
                                                    alt="{{ $item->name }}"
                                                    src="{{ asset($item->image) }}"
                                                    style="width: 235px; height: 610px;"></a></p>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div><!-- END: main -->
        <div class="clearfix"></div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/contact.css') }}">
@endsection

@section('script')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let toastrSuccsee = '{{ Session::get('success') }}';
        let toastrDanger = '{{ Session::get('danger') }}';
        if (toastrDanger.length > 0 || toastrSuccsee.length > 0) {
            if (toastrDanger.length > 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: toastrDanger,
                })
                toastr["error"](toastrDanger)
            } else {
                Swal.fire(
                    'Thành công!',
                    toastrSuccsee,
                    'success'
                )
            }
        }
    </script>
@endsection
