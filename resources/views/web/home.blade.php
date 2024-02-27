@extends('web.layouts.web')

@section('content')
    <div class="row-content pos-top">
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
                                    alt="{{ $item->name }}" width="1350" height="422" class="img-fluid">
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
                @if(!$isMobile)
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
                @endif
                @forelse($cats as $cat)
                <div id="block_id_{{ $cat->id }}" class="list_products_cat">
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
                @empty
                @endforelse
                @if($isMobile)
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
                @endif
                <div id="block_id_26" class="fo-top hidden-xs">
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
                <div id="block_id_30" class="newslist-content" >
                    <h2 class="titl-newslist">GÓC CHIA SẺ KINH NGHIỆM</h2>
                    <ul class="list-contract owl-carousel">
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
            </div> <!-- END: .pos-top -->
            <div class="clearfix"></div>
        </div><!-- END: main -->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
    <div id="fs-popup-home" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="    background: transparent;    box-shadow: none;
    border: none;">

                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('images/close-modal.png') }}" alt="close_modal" loading="lazy" height="43px" width="43px">
                </button>
                <div class="form-bao-gia">
                    <img class="img-fluid logo-cati-popup" src="{{ asset('images/logo-mk.png') }}" alt="{{ $setting['site_name'] }}" width="90px" height="85px" />
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
    @parent
    <link href="{{ asset('js/web/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/web/home.css') }}" rel="stylesheet" media="screen">
@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/web/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.0/dist/lazyload.min.js"></script>
    <script defer>
        var lazyLoadInstance = new LazyLoad({
            // Your custom settings go here
        });
        window.onload = function() {
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

            $('.swiper-wrapper').owlCarousel({
                loop: false,
                rewind: true,
                dots:true,
                nav:false,
                margin: 30,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:2,
                        nav:false
                    },
                    600:{
                        items:2,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:false,
                        loop:false
                    }
                }
            });

            // $('.swiper-wrapper').slick({
            //     // lazyLoad: 'ondemand',
            //     infinite: true,
            //     slidesToShow: 3,
            //     slidesToScroll: 1,
            //     adaptiveHeight: true,
            //     arrows: true,
            //     dots: true,
            //     responsive: [
            //         {
            //             breakpoint: 767,
            //             settings: {
            //                 slidesToShow: 2,
            //                 slidesToScroll: 2,
            //                 // dots: true,
            //             }
            //         },
            //         {
            //             breakpoint: 900,
            //             settings: {
            //                 slidesToShow: 3,
            //                 slidesToScroll: 1,
            //                 // dots: true,
            //             }
            //         }
            //     ]
            // });

            $('.sider-slick-add').owlCarousel({
                loop: false,
                rewind: true,
                dots:false,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:2,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:5,
                        nav:true,
                        loop:false
                    }
                }
            });

            $('.sun-group').owlCarousel({
                loop: false,
                rewind: true,
                dots:false,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:2,
                        nav:false
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:5,
                        nav:false,
                        loop:false
                    }
                }
            });

            $('.list-contract').owlCarousel({
                loop: false,
                rewind: true,
                dots:false,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:2,
                        nav:false
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:5,
                        nav:false,
                        loop:false
                    }
                }
            });

            // $('.sider-slick-add').not('.slick-initialized').slick({
            //     // lazyLoad: 'ondemand',
            //     infinite: true,
            //     slidesToShow: 5,
            //     slidesToScroll: 5,
            //     arrows: true,
            //     responsive: [
            //         {
            //             breakpoint: 767,
            //             settings: {
            //                 slidesToShow: 2,
            //                 slidesToScroll: 2,
            //                 // dots: true,
            //             }
            //         },
            //         {
            //             breakpoint: 900,
            //             settings: {
            //                 slidesToShow: 3,
            //                 slidesToScroll: 3,
            //                 // dots: true,
            //             }
            //         }
            //     ]
            // });

            // $('.sun-group').slick({
            //     // lazyLoad: 'ondemand',
            //     infinite: true,
            //     slidesToShow: 5,
            //     slidesToScroll: 5,
            //     arrows: true,
            //     responsive: [
            //         {
            //             breakpoint: 767,
            //             settings: {
            //                 slidesToShow: 2,
            //                 slidesToScroll: 2,
            //                 // dots: true,
            //             }
            //         },
            //         {
            //             breakpoint: 900,
            //             settings: {
            //                 slidesToShow: 3,
            //                 slidesToScroll: 3,
            //                 // dots: true,
            //             }
            //         }
            //     ]
            // });
            //
            // $('.list-contract').slick({
            //     // lazyLoad: 'ondemand',
            //     infinite: true,
            //     slidesToShow: 5,
            //     slidesToScroll: 5,
            //     arrows: true,
            //     responsive: [
            //         {
            //             breakpoint: 767,
            //             settings: {
            //                 slidesToShow: 2,
            //                 slidesToScroll: 2,
            //                 // dots: true,
            //             }
            //         },
            //         {
            //             breakpoint: 900,
            //             settings: {
            //                 slidesToShow: 3,
            //                 slidesToScroll: 3,
            //                 // dots: true,
            //             }
            //         }
            //     ]
            // });
        };
    </script>
@endsection
