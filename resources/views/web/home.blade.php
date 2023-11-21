@extends('web.layouts.web')

@section('content')
    <div class="row-content pos-top">
        <div class="slideshow-home">
            @if(!empty($slider))
                <div id="owl-demo" class="owl-carousel">
                    @forelse($slider as $item)
                        <div class="item">
                            <a href="{{ $item->url }}">
                                <picture>
                                    <source srcset="{{ asset(replace_image_to_webp($item->image,'small')) }}" media="(max-width: 600px)">
                                    <source srcset="{{ asset(replace_image_to_webp($item->image)) }}">
                                    <img class="img-fluid" width="1920" height="600" src="{{ asset(replace_image_to_webp($item->image)) }}" alt="{{ $item->name }}"/>
                                </picture>

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
                    <div class="swiper-wrapper">
                        @forelse($students as $item)
                            <div class="swiper-slide box-partners">
                                <div class="vn-testimonies-avatar">
                                    <div class="image-student-b">
                                        <img class="img-fluid border-img-show" width="120" height="120" alt="{{ $item->title }}" data-lazy="{{ asset(replace_image_to_webp($item->image)) }}" >
                                    </div>
                                    <p class="name-title-studen">{{ $item->title }}</br>{{ $item->creator }}</p>
                                </div>
                                <div class="comment-studen">{!! $item->content !!}</div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                @forelse($cats as $cat)
                <div id="block_id_{{ $cat->id }}" class="list_products_cat">
                    <h2 title="{{ $cat->name }}" class="title_block_cat"><span>{{ $cat->name }}</span></h2>
                    <div class="sider-slick-add">
                        @forelse($productsInCategories[$cat->id] as $item)
                        <div class="image-check">
                            <figure class="imghvr-flip-vert">
                                <img data-lazy="{{ asset(replace_image_to_webp($item->image)) }}" class="img-fluid" width="216px" height="270px" alt="{{ $item->name }}" >
                                <figcaption>
                                    @if($item->image_after)
                                        <img data-lazy="{{ asset(replace_image_to_webp($item->image_after)) }}" class="img-fluid" width="216px" height="270px" alt="{{ $item->name }}" >
                                    @else
                                        <img data-lazy="{{ asset(replace_image_to_webp($item->image)) }}" class="img-fluid" width="216px" height="270px" alt="{{ $item->name }}" >
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
                                <img data-lazy="{{ asset(replace_image_to_webp($item->image)) }}" width="120" height="120" alt="{{ $item->name }}" title="{{ $item->name }}">
                            </a>
                        </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
                <div id="block_id_30" class="newslist-content" >
                    <h2 class="titl-newslist">GÓC CHIA SẺ KINH NGHIỆM</h2>
                    <ul class="list-contract">
                        @forelse($articles as $item)
                        <li class="">
                            <a href="{{ route('detailArticle',['cat_slug' => $item->category->alias,'slug' => $item->alias]) }}" title="{{ $item->title }}" >
                                <img data-lazy="{{ asset(replace_image_to_webp($item->image)) }}" alt="{{ $item->title }}" class="img-fluid" width="220px" height="150px">
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
                    <img src="{{ asset('images/close-modal.png') }}">
                </button>
                <div class="form-bao-gia">
                    <img class="img-fluid logo-cati-popup" src="{{ asset('images/logo-mk.png') }}" alt="{{ $setting['site_name'] }}" width="90px" height="85px" />
                    <div class="text-center">Báo giá trong 5 phút</div>
                    <form method="post" action="{{ route('saveQuote') }}" name="contact_home" class="form">
                        <input type="text" name="phone_contact" id="phone_contact" placeholder="Số điện thoại" class="form-control" required >
                        <input type="text" name="number_contact" id="number_contact" placeholder="Số lượng dự kiến" class="form-control" required >
                        <input type="submit" value="Nhận báo giá" class="btn btn-success buttom-contact">
                        <input type="text" name="contact_me_by_fax_only" style="opacity: 0 !important" tabindex="-1" autocomplete="off">
                    </form>
                </div>
            </div><!--end: .modal-content-->
        </div><!--end: .modal-dialog-->
    </div><!--end: #fs-alert-->
@endsection

@section('link')
    @parent
    <link href="{{ asset('js/web/OwlCarousel2-2.2.1/assets/owl.carousel.min.css') }}" rel="stylesheet" media="screen">
    <link href="{{ asset('css/web/home.css') }}" rel="stylesheet" media="screen">
@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/web/OwlCarousel2-2.2.1/owl.carousel.min.js') }}"></script>
    <script async defer>
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
            lazyLoad: 'ondemand',
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
            lazyLoad: 'ondemand',
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
            lazyLoad: 'ondemand',
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

        $('.list-contract').slick({
            lazyLoad: 'ondemand',
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
    </script>
@endsection
