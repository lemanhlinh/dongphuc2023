@extends('web.layouts.web')

@section('content')
    <div class="container">
        <div class="main row-content" id="main">
            <div class="clearfix"></div>
            <section id="main-breadcrumbs" class="main-breadcrumbs">
                <div class="breadcrumbs row-item">
                    {{ Breadcrumbs::render('detailProduct',$product) }}
                </div><!-- END: .breadcrumb -->
                <div class="clear"></div>
            </section>
            <div class="clearfix"></div>
            <div class="main-content row-item ">
                <div class="row">
                    <div class="main-column-content col-lg-9 col-md-9 col-sm-12 col-xs-12 order-md-2">
                        <div class="content-wp clearfix">
                            <div class="background-detail-product">
                                <div class="row g-0">
                                    <div class="all_info_product col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="image-table">
                                            <div class="img_styling clearfix">
                                                @include('web.components.styling',['product_images' => $product_images, 'image_data' => $product->image])
                                            </div>
                                        </div>
                                    </div>

                                    <div class="price_product_pc col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="fix_scroll">
                                            <div class="border-detail_top">
                                                <h1 class="title-book">{{ $product->name }}</h1>
                                                @if ($product->sku)
                                                <div class="sku-code">
                                                    <b>Mã:</b> {{ $product->sku }}
                                                </div>
                                                @endif
                                                <div class="price_product">
                                                    <b>Giá:</b> {{ format_money($product->price) }}
                                                </div>
                                            </div>
                                            <div class="info-special-book">
                                                {!! $product->content_info !!}
                                            </div>
                                            <div class="quality-product d-flex">
                                                <div class="wrapper-quantity me-5">
                                                    <p class="title-size fw-bold mb-2">Số lượng</p>
                                                    <span class="number-input">
                                                        <button onclick="this.parentNode.querySelector('input.quantity').stepDown()" ></button>
                                                        <input type="number" min="1" name="quantity" id="quantity" class="quantity" value="1" />
                                                        <button onclick="this.parentNode.querySelector('input.quantity').stepUp()" class="plus"></button>
                                                    </span>
                                                </div>
                                                <div class="info-product">
                                                    <p class="title-size fw-bold mb-2">Tình trạng</p>
                                                    <p class="status-product m-0"><i class="fas fa-check-circle me-2"></i>Còn hàng</p>
                                                </div>
                                            </div>
                                            <div class="add-cart-now">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#cartModal" onclick="order({{ $product->id }})" class="btn-instalment text-decoration-none d-flex flex-column justify-content-center align-items-center text-uppercase p-3 pt-2 mt-3">
                                                            <img src="{{ asset('images/cart.svg') }}" alt="" class="img-fluid d-block">
                                                            <span>Thêm vào giỏ hàng</span>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="#" class="bottom-popup btn-instalment text-decoration-none d-flex flex-column justify-content-center align-items-center text-uppercase p-3 pt-2 mt-3" onclick="get_info({{ $product->id }})">
                                                            <img src="{{ asset('images/buy.svg') }}" alt="" class="img-fluid d-block">
                                                            <span>Nhận báo giá</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-product clearfix">
                                    <div class="title-content"><span>Thông tin sản phẩm</span></div>
                                    <div class="content-book">
                                        {!! $product->content !!}
                                    </div>
                                </div>
                            </div>
                            @include('web.product.related',['product_related' => $product_related,'cat_slug' => $cat_slug])
                            <div class="modal-for-product">
                                @include('web.product.modal')
                            </div>
                            <input type="hidden" value="{{ $product->price }}" name='product_price' id='product_price'  />
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
                                    <div class="banner_item_0 banner_item">
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
    <link rel="stylesheet" href="{{ asset('/js/web/magiczoomplus/magiczoomplus.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('/css/web/product-detail.css') }}" media="screen">
    <link href="{{ asset('js/web/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css') }}" rel="stylesheet" media="screen">
@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/web/magiczoomplus/magiczoomplus.js') }}"></script>
    <script src="{{ asset('/js/web/OwlCarousel2-2.3.4/dist/owl.carousel.min.js') }}"></script>
    <script>
        $('.sider-slick-add').owlCarousel({
            loop: false,
            rewind: true,
            dots:false,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
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
        // $('.sider-slick-add').slick({
        //     infinite: true,
        //     slidesToShow: 3,
        //     slidesToScroll: 3,
        //     arrows: true,
        //     rows: 2,
        //     responsive: [
        //         {
        //             breakpoint: 767,
        //             settings: {
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1,
        //                 // dots: true,
        //             }
        //         },
        //         {
        //             breakpoint: 900,
        //             settings: {
        //                 slidesToShow: 2,
        //                 slidesToScroll: 2,
        //                 // dots: true,
        //             }
        //         }
        //     ]
        // });

        $(".full").click(function () {
            $(".wrapper-popup-2").hide();
            $(".full").hide();
        });

        // setTimeout(function() {
        //     var product_id = $('#product_id').val();
        //     $.get("/index.php?module=products&view=product&task=update_hits&raw=1",{id: product_id}, function(status){
        //     });
        // }, 3000);

        function get_info(id){
            $.ajax({
                type : 'POST',
                url : '{{ route('contactProduct') }}',
                data: {
                    id: id,
                    saveQuote: "{{ route('saveQuote') }}",
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success : function(data){
                    $("#wrapper-popup-2").html(data);
                    ajax_pop_cart();
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('There is an error in the process of bringing up the server. Would you please check the connection.');
                }
            });
            $(".wrapper-popup-2").show();
            $(".full").show();
        }

        function order(id_prd) {
            var quantity = $("#quantity").val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '{{ route('addToCart') }}',
                data: {
                    quantity: quantity?quantity:1,
                    id: id_prd,
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success: function (data) {
                    $("#cart-top").html(data.total);
                    Swal.fire(
                        'Thành công!',
                        'Thêm vào giỏ hàng thành công',
                        'success'
                    )
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Có lỗi xảy ra, Không thành công',
                    })
                }
            });
        }
        function ajax_pop_cart(){
            $("#close-cart").click(function(){
                $(".wrapper-popup-2").hide();
                $(".wrapper-popup").hide();
                $(".full").hide();
            });
        }
    </script>
@endsection
