@extends('web.layouts.web')

@section('content')
    <div class="container">
        <div class="main row-content" id="main">
            <div class="clearfix"></div>
            <section id="main-breadcrumbs" class="main-breadcrumbs">
                <div class="breadcrumbs row-item">
                    {{ Breadcrumbs::render('catProduct',$cat) }}
                </div><!-- END: .breadcrumb -->
                <div class="clear"></div>
            </section>
            <div class="clearfix"></div>
            <div class="main-content row-item ">
                <div class="row">
                    <div class="main-column-content col-lg-9 col-md-9 col-sm-12 col-xs-12 order-md-2">
                        <div class="content-wp clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <aside class="new-contents">
                                    <h1 class="title-module">{{ $cat->name }}</h1>
                                    <div class="list-products row-item">
                                        <div class="row">
                                            @forelse($products as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                <figure class="imghvr-flip-vert">
                                                    <img src="{{ asset(replace_image_to_webp($item->image)) }}" class="img-fluid" >
                                                    <figcaption>
                                                        @if($item->image_after)
                                                        <img src="{{ asset(replace_image_to_webp($item->image_after)) }}" alt="{{ $item->name }}" class="img-fluid" >
                                                        @else
                                                        <img src="{{ asset(replace_image_to_webp($item->image)) }}" alt="{{ $item->name }}" class="img-fluid" >
                                                        @endif
                                                    </figcaption><a href="{{ route('detailProduct', ['cat_slug' => $cat->alias, 'slug' => $item->alias])  }}"></a>
                                                </figure>
                                                <a class="item resized" href="{{ route('detailProduct', ['cat_slug' => $cat->alias, 'slug' => $item->alias])  }}" title="{{ $item->name }}">
                                                    <div class="content-item">
                                                        <div class="title">{{ $item->name }}</div>
                                                        <p class="price_product">
                                                            {{ format_money($item->price_old) }}
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>

                                    <div class="clearfix"></div>
                                    {{ $products->links('web.components.pagination') }}
                                </aside>
                            </div>
                            <div class="content-cat mbl">
                                {!! $cat->content !!}
                            </div>
                        </div>
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
                                            <a href="{{ route('catProduct',['slug' => $item->alias]) }}">{{ $item->name }}<i class="fas fa-angle-right"></i></a>
                                            @if(count($item->children) > 0)
                                                <ul class="wrapper_children_level0">
                                                    @forelse($item->children as $val)
                                                        <li class="level_1 first-item">
                                                            <a href="{{ route('catProduct',['slug' => $val->alias]) }}">{{ $val->name }}</a>
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
                                        @if($item->type == 1)
                                            <p style="text-align: center;">
                                                <a href="{{ $item->link }}">
                                                    <img alt="{{ $item->name }}" src="{{ asset($item->image) }}" class="img-fluid">
                                                </a>
                                            </p>
                                        @else
                                            {!! $item->content !!}
                                        @endif
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
    <link rel="stylesheet" href="{{ asset('/css/web/product-cat.css') }}">
@endsection

@section('script')
    @parent
@endsection
