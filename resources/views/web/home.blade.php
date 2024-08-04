@extends('web.layouts.web')

@section('content')
    <div class="row-content pos-top">
        <div class="container">
            <div class="slideshow-home">
                @if(!empty($slider))
                    <div id="owl-demo" class="owl-carousel">
                        @forelse($slider as $item)
                            <div class="item">
                                <a href="{{ $item->url }}" title="{{ $item->name }}">
                                    <img
                                        src="{{ asset(replace_image_to_webp($item->image,'small')) }}"
                                        srcset="
                                            {{ asset(replace_image_to_webp($item->image,'small')) }} 400w,
                                            {{ asset(replace_image_to_webp($item->image)) }} 800w,
                                            {{ asset(replace_image_to_webp($item->image)) }} 1200w"
                                        sizes="(max-width: 600px) 400px,
                                        (max-width: 1024px) 800px,
                                        1200px"
                                        alt="{{ $item->name }}"  fetchpriority="high" width="1350" height="422" class="img-fluid">
                                </a>
                            </div>
                        @empty
                        @endforelse
                    </div>
                @endif
            </div>
        </div>
    </div> <!-- END: .pos-top -->
    <div class="container">
        <div id="block_id_2" class="content-block">
            {!! $setting['content_under_slide'] !!}
        </div>
        <div id="block_id_34" class="vn-sidebar-widget testimonials-list">
            <h2 class="sidebar-widget-title text-center"><span>Ý kiến khách hàng</span></h2>
            <div class="swiper-wrapper owl-carousel">
                @forelse($students as $item)
                    <div class="swiper-slide box-partners">
                        <div class="vn-testimonies-avatar">
                            <div class="image-student-b">
                                <img class="img-fluid border-img-show lazy" width="120" height="120" alt="{{ $item->title }}" loading="lazy" data-src="{{ asset(replace_image_to_webp($item->image)) }}" >
                            </div>
                            <p class="name-title-studen">{{ $item->title }}</br>{{ $item->creator }}</p>
                        </div>
                        <div class="comment-studen">{!! $item->content !!}</div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    @forelse($cats as $cat)
        <div id="block_id_{{ $cat->id }}" class="list_products_cat">
            <div class="container">
                <h2 title="{{ $cat->name }}" class="title_block_cat"><span>{{ $cat->name }}</span></h2>
                <div class="sider-slick-add owl-carousel">
                    @forelse($productsInCategories[$cat->id] as $item)
                        <div class="image-check">
                            <figure class="imghvr-flip-vert">
                                <img data-src="{{ asset(replace_image_to_webp($item->image)) }}" loading="lazy" class="img-fluid lazy" width="216px" height="270px" alt="{{ $item->name }}" >
                                <figcaption>
                                    @if($item->image_after)
                                        <img data-src="{{ asset(replace_image_to_webp($item->image_after)) }}" class="img-fluid lazy" width="216px" height="270px" alt="{{ $item->name }}" >
                                    @else
                                        <img data-src="{{ asset(replace_image_to_webp($item->image)) }}" class="img-fluid lazy" width="216px" height="270px" alt="{{ $item->name }}" >
                                    @endif
                                </figcaption>
                                <a href="{{ route('detailProduct',['cat_slug'=>$item->category->alias, 'slug' => $item->alias]) }}" title="{{ $item->name }}"></a>
                            </figure>
                            <a href="{{ route('detailProduct',['cat_slug'=>$item->category->alias, 'slug' => $item->alias]) }}" title="{{ $item->name }}">
                                <h3 title="{{ $item->name }}>" class="text-center">{{ $item->name }}</h3>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    @empty
    @endforelse
    <div id="block_id_26" class="fo-top hidden-xs">
        <div class="container">
            <h2 class="text-center">ĐỐI TÁC THÂN THIẾT</h2>
            <ul class="sun-group owl-carousel">
                @forelse($partner as $item)
                    <li>
                            <span>
                                <img data-src="{{ asset(replace_image_to_webp($item->image)) }}" class="lazy" loading="lazy" width="120" height="120" alt="{{ $item->name }}" title="{{ $item->name }}">
                            </span>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
    </div>
    <div id="block_id_30" class="newslist-content" >
        <div class="container">
            <h2 class="titl-newslist">GÓC CHIA SẺ KINH NGHIỆM</h2>
            <ul class="list-contract owl-carousel list-unstyled">
                @forelse($articles as $item)
                    <li class="">
                        <a href="{{ route('detailArticle',['cat_slug' => $item->category->alias,'slug' => $item->alias]) }}" title="{{ $item->title }}" >
                            <img data-src="{{ asset(replace_image_to_webp($item->image)) }}" loading="lazy" alt="" class="img-fluid lazy" width="220px" height="150px">
                            <h3 title="{{ $item->title }}">{{ $item->title }}</h3>
                        </a>
                    </li>
                @empty
                @endforelse
            </ul>
        </div>
    </div>
@endsection

@section('link')
    @parent
    <link href="{{ mix('css/web/home.css') }}" rel="stylesheet" media="screen">
@endsection

@section('script')
    @parent
    <script src="{{ mix('js/web/home.js') }}"></script>
@endsection
