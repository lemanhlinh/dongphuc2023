@extends('web.layouts.web')

@section('content')
    <div class="row-content pos-top">
        <div class="slideshow-home">
            @if(!empty($slider))
                <div id="owl-demo" class="owl-carousel">
                    @forelse($slider as $item)
                        <div class="item">
                            <a href="{{ $item->url }}">
                                <img class="owl-lazy" width="1920" height="600" src="{{ asset($item->image) }}" alt="{{ $item->name }}"/>
                            </a>
                        </div>
                    @empty
                    @endforelse
                </div>
            @endif
        </div>
    </div> <!-- END: .pos-top -->
    <div class="clearfix"></div>
    <div class="container">
        <div class="main row-content" id="main">
            <div class="row-content pos-top">
                <div id="block_id_2" class="content-block">
                    {!! $setting['content_under_slide'] !!}
                </div>
                <div id="block_id_34" class="vn-sidebar-widget testimonials-list">
                    <h2 class="sidebar-widget-title text-center"><span>Ý kiến khách hàng</span></h2>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @forelse($students as $item)
                            <div class="swiper-slide box-partners">
                                <div class="vn-testimonies-avatar">
                                    <img class="img-fluid border-img-show" width="120" height="120" alt="{{ $item->title }}" src="{{ asset(str_replace('/original/', '/small/', $item->image)) }}" >
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
                    <h2 title="{{ $cat->name }}" class="title_block_cat"><span>{{ $cat->name }}</span></h2>
                    <div class="sider-slick-add">
                        @forelse($productsInCategories[$cat->id] as $item)
                        <div class="image-check">
                            <figure class="imghvr-flip-vert">
                                <img src="{{ asset(str_replace('original', 'resized', $item->image)) }}" class="img-fluid" >
                                <figcaption>
                                    @if($item->image_after)
                                        <img data-src="{{ asset(str_replace('original', 'resized', $item->image_after)) }}" class="img-fluid" >
                                    @else
                                        <img data-src="{{ asset(str_replace('original', 'resized', $item->image)) }}" class="img-fluid" >
                                    @endif
                                </figcaption>
                                <a href="{{ route('detailProduct',['cat_slug'=>$item->category->alias, 'slug' => $item->alias]) }}"></a>
                            </figure>
                            <a href="{{ route('detailProduct',['cat_slug'=>$item->category->alias, 'slug' => $item->alias]) }}">
                                <h3 title="{{ $item->name }}>" class="text-center">{{ $item->name }}</h3>
                            </a>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                @empty
                @endforelse
                <div id="block_id_26" class="fo-top hidden-xs">
                    <h2 class="text-center">ĐỐI TÁC THÂN THIẾT</h2>
                    <ul class="sun-group">
                        @forelse($partner as $item)
                        <li>
                            <a href="{{ $item->url }}">
                                <img src="{{ asset($item->image) }}" width="120" height="120" alt="{{ $item->name }}" title="{{ $item->name }}">
                            </a>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div id="block_id_30" class="newslist-content" >
                    <h2 class="titl-newslist">GÓC CHIA SẺ KINH NGHIỆM</h2>
                    <ul class="list-news-a">
                        @forelse($articles as $item)
                        <li class="">
                            <a href="{{ route('detailArticle',['cat_slug' => $item->category->alias,'slug' => $item->alias]) }}" title="{{ $item->title }}>" >
                                <img src="{{ asset(str_replace('/original/', '/resized/', $item->image)) }}" class="img-fluid">
                                <h3 title="{{ $item->title }}">{{ $item->title }}</h3>
                            </a>
                            <span class="summary-home-new">{{ $item->summary }}</span>
                            <a href="{{ route('detailArticle',['cat_slug' => $item->category->alias,'slug' => $item->alias]) }}" title="{{ $item->title }}" >
                                <p class="text-center phm" style="color: #0067b8;"><i class="fas fa-arrow-right"></i> Xem thêm</p>
                            </a>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div> <!-- END: .pos-top -->
            <div class="clearfix"></div>
        </div><!-- END: main -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
@endsection

@section('link')
    @parent
    <link href="{{ asset('js/web/OwlCarousel2-2.2.1/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/web/home.css') }}" rel="stylesheet">
@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/web/OwlCarousel2-2.2.1/owl.carousel.min.js') }}"></script>
    <script>
        $("#owl-demo").owlCarousel({
            autoplay: true, //Set AutoPlay to 3 seconds
            autoplaySpeed: 500,
            autoHeight: true,
            loop: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            items: 1,
            lazyLoad: true,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    autoplay: false
                },
                480: {
                    autoplay: false
                },
                768: {
                    autoplay: true
                }
            }
        });

        $('.swiper-wrapper').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            adaptiveHeight: true,
            arrows: true,
            dots: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        // dots: true,
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        // dots: true,
                    }
                }
            ]
        });

        $('.sider-slick-add').not('.slick-initialized').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            arrows: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        // dots: true,
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        // dots: true,
                    }
                }
            ]
        });

        $('.sun-group').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5,
            arrows: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        // dots: true,
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        // dots: true,
                    }
                }
            ]
        });

        $('.list-news-a').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            arrows: true,
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        // dots: true,
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        // dots: true,
                    }
                }
            ]
        });
    </script>
@endsection
