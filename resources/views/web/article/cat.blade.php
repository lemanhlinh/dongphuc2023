@extends('web.layouts.web')

@section('content')
    <div class="container">
        <div class="main row-content" id="main">
            <div class="clearfix"></div>
            <section id="main-breadcrumbs" class="main-breadcrumbs">
                <div class="breadcrumbs row-item">
                    {{ Breadcrumbs::render('catArticle', $category) }}
                </div><!-- END: .breadcrumb -->
                <div class="clear"></div>
            </section>
            <div class="clearfix"></div>
            <div class="main-content row-item ">
                <div class="row">
                    <div class="main-column-content col-lg-9 col-md-9 col-sm-12 col-xs-12 order-md-2">
                        <div class="content-wp clearfix">
                            <aside class="new-contents">
                                <h1 class="title-module"><i class="far fa-comment-alt"></i>{{ $category->name }}</h1>
                                <div class="list-news row-item">
                                    @forelse($article as $item)
                                    <div class="item-show-news">
                                        <a class="item small" href="{{ route('detailArticle',['cat_slug' => $category->alias,'slug' => $item->alias]) }}" title="{{ $item->title }}">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    <img class="img-fluid" src="{{ asset(replace_image_to_webp($item->image)) }}" alt="{{ $item->title }}">
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <div class="content-item">
                                                        <h2 class="title">{{ $item->title }}</h2>
                                                        <time>{{ $item->created_at }}</time>
                                                        <summary class="summary">{{ $item->summary }}</summary>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="clearfix"></div>
                            {{ $article->links('web.components.pagination') }}
                            </aside>
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
    <link rel="stylesheet" href="{{ asset('/css/web/article-list.css') }}">
@endsection

@section('script')
    @parent
@endsection
