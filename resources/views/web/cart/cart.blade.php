@extends('web.layouts.web')

@section('content')
    <div class="container">
    <div class="layout-cart mb-5">
        <div class="row">
            <div class="col-md-8">
                <div class="wrapper-tb-pop bg-white border mb-4">
                    <h2 class="title-cart">Giỏ hàng của bạn</h2>
                    <form id="order_form" name="order_form" method="post" action="{{ route('order') }}">
                        <table width="100%" border="0" class="table-product-pack table" cellpadding="6">
                            <thead>
                            <tr class="head-tr">
                                <th class="th-column" scope="col">Sản phẩm</th>
                                <th class="text-center" scope="col">Giá</th>
                                <th class="text-center" scope="col">Số lượng</th>
                                <th class="text-center" scope="col">Tạm tính</th>
                            </tr>
                            </thead>
                            <tbody id="popup-cart">
                            <!--  Product list -->
                            @if(!empty($cartItems))
                                @forelse($cartItems as $i => $product)
                            <tr class="tr-pop-{{ $i }}">
                                <td class="name-product">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <a class="pull-left" href="{{ route('detailProduct',['cat_slug'=>$product['product']->slug_cat,'slug'=>$product['product']->alias]) }}">
                                                <img src="{{ asset($product['product']->image) }}" alt="{{ htmlspecialchars($product['product']->name) }}" class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">
                                            <h4 class="media-heading">
                                                <a href="{{ route('detailProduct',['cat_slug'=>$product['product']->slug_cat,'slug'=>$product['product']->alias]) }}">{{ $product['product']->name }}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </td>
                                <td class="td-price text-center" valign="top">
                                    <p>
                                        <span class="price">{{ format_money($product['product']->price, 'đ') }}</span>
                                    </p>
                                </td>
                                <td valign="top">
                                    <div class=" select-box">
                                            <span class="number-input">
                                                <button onclick="this.parentNode.querySelector('input#quantity_{{ $i }}').stepDown()" type="button"></button>
                                                <input type="number" min="1" name="quantity[{{ $i }}]" id="quantity_{{ $i }}" class="quantity" value="{{ $product['quantity'] }}">
                                                <button onclick="this.parentNode.querySelector('input#quantity_{{ $i }}').stepUp()" class="plus" type="button"></button>
                                            </span>
                                    </div>
                                </td>
                                <td class="text-center" valign="top">
                                    <span class="total">{{ $product['product']->price?format_money($product['product']->price * $product['quantity'], 'đ'):0 }}</span>
                                    <a href="{{ route('removeItem',['id'=>$product["product"]->id]) }}">
                                        <i class="far fa-trash-alt"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                                @empty
                                @endforelse
                            @endif
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('home') }}" class="continue-buy text-decoration-none"><i class="fas fa-chevron-left"></i>Tiếp tục mua sắm</a>
                            <a class="update-cart text-decoration-none" href="javascript:void(0);" onclick="validateUpdateCart();"><i class="fas fa-sync-alt"></i>Cập nhật giỏ hàng</a>
                        </div>
                    </form>
                </div>
                <div class="bg-white border p-3 method_payment mb-4">
                    <ul class="list-unstyled">
                        <li>
                            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="1" checked="checked" >
                            <label for="payment_method_bacs" class="mb-3">Chuyển khoản ngân hàng</label>
                            <div class="bg-light p-3 mb-4">
                                {!! $setting['pay_method'] !!}
                            </div>
                        </li>
                        <li>
                            <input id="payment_method_cod" type="radio" class="input-radio" name="payment_method" value="0" >
                            <label for="payment_method_cod">Trả tiền mặt khi nhận hàng </label>
                        </li>
                    </ul>

                </div>
                <div class="bg-white form-address border p-3" id="form_order">
                    <h2 class="title-address">
                        Địa chỉ giao hàng
                    </h2>
                    <form id="order_form_address" name="order_form_address" method="post" action="{{ route('order') }}">
                        @csrf
                        <input type="hidden" id="method_pay" name="method_pay" value="1" >
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="sender_name" value="{{ old('sender_name') }}" placeholder="Họ và tên*" required>
                            @if ($errors->has('sender_name'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('sender_name') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="sender_telephone" value="{{ old('sender_telephone') }}" placeholder="Điện thoại*" required>
                            @if ($errors->has('sender_telephone'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('sender_telephone') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="sender_address" value="{{ old('sender_address') }}" placeholder="Địa chỉ*" required>
                            @if ($errors->has('sender_address'))
                                <p class="help-block text-danger">
                                    <strong>{{ $errors->first('sender_address') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Ghi chú đơn hàng" id="sender_comments" name="sender_comments" style="height: 140px">{{ old('sender_comments') }}</textarea>
                            <label for="floatingTextarea">Ghi chú đơn hàng</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-address">Tiến hành đặt hàng</button>
                            </div>
                        </div>
                        <input type="hidden" name="total_price" value="{{ $total_price }}">
                        <input type="text" name="contact_me_by_fax_only" style="opacity: 0 !important" tabindex="-1" autocomplete="off">
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="statistical mb-4 border">
                    <div class="detail-price">
                        <ul class="list-unstyled">
                            <li><span class="title-dettail">Tổng giá sản phẩm</span> <span class="price-total"><b>{{ format_money($total_price) }}</b></span></li>
                            <li><span class="title-dettail">Phí vận chuyển</span> <span>Miễn phí toàn quốc</span></li>
                            <li>
                                <span class="title-pay">Tạm tính</span>
                                <span class="total-price">{{ format_money($total_price) }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="button-pay text-center">
                        <a href="#form_order" id="submit_form">Tiến hành đặt hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ mix('/css/web/cart-checkout.css') }}">
@endsection

@section('script')
    @parent
    <script>
        $(".input-radio").click(function () {
            var id = $(this).val();
            $("#method_pay").val(id);
        });
    </script>
@endsection
