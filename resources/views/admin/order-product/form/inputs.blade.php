<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.order-product.name')</label>
                    <input type="text" class="form-control" name="sender_name" value="{{ isset($order) ? $order->sender_name : old('sender_name') }}" required readonly>
                    @if ($errors->has('sender_name'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('sender_name') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                    <label>@lang('form.order-product.sender_telephone')</label>
                    <input type="text" class="form-control" name="sender_telephone" value="{{ isset($order) ? $order->sender_telephone : old('sender_telephone') }}" readonly required>
                    @if ($errors->has('sender_telephone'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('sender_telephone') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.order-product.sender_address')</label>
                    <input type="text" class="form-control" name="sender_address" value="{{ isset($order) ? $order->sender_address : old('sender_address') }}" readonly required>
                    @if ($errors->has('sender_address'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('sender_address') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clearfix">
                    <label>Hình thức thanh toán</label>
                    <div class="form-group">
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio1" name="payment" readonly value="{{ \App\Models\Article::STATUS_ACTIVE }}" {{ (isset($order->payment) && $order->payment == \App\Models\Article::STATUS_ACTIVE) ? 'checked' : (old('payment') && (old('payment') == \App\Models\Article::STATUS_ACTIVE)) ? 'checked' : '' }} disabled required>
                            <label for="statusRadio1" class="custom-control-label">Thanh toán khi nhận hàng&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </div>
                        <div class="icheck-success d-inline">
                            <input class="" type="radio" id="statusRadio2" name="payment" readonly value="{{ \App\Models\Article::STATUS_INACTIVE }}" {{ (isset($order) && $order->payment == \App\Models\Article::STATUS_INACTIVE) ? 'checked' : (old('payment') && (old('payment') == \App\Models\Article::STATUS_INACTIVE)) ? 'checked' : '' }} disabled required>
                            <label for="statusRadio2" class="custom-control-label">Thanh toán chuyển khoản</label>
                        </div>
                    </div>
                    @if ($errors->has('payment'))
                        <span class="help-block text-danger">
                    <strong>{{ $errors->first('payment') }}</strong>
                </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group clearfix">
                    <label>Trạng thái đơn hàng</label>
                    <select name="status" id="status" class="form-control" required>
                        @forelse( \App\Models\Order::STATUS as $key => $name)
                            <option value="{{ $key }}" {{ isset($order->status) && $order->status == $key ? 'selected' : old('status') == $key ? 'selected' : '' }}>{{ $name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.order-product.sender_comments')</label>
                    <textarea name="sender_comments" id="sender_comments" rows="3" class="form-control" readonly>
                        {{ isset($order) ? $order->sender_comments : old('sender_comments') }}
                    </textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>@lang('form.order-product.admin_note')</label>
                    <textarea name="admin_note" id="admin_note" rows="3" class="form-control">{{ isset($order) ? $order->admin_note : old('admin_note') }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<table class="table table-bordered mt-2" id="list_products">
    <thead class="thead-light">
    <tr>
        <th style="width: 100px;">SKU</th>
        <th style="width: 280px;">Tên sản phẩm</th>
        <th style="width: 100px;">Giá</th>
        <th style="width: 100px;">Số lượng</th>
    </tr>
    </thead>
    <tbody id="table-body">
    @if(!empty($products))
        @forelse($products as $k => $item)
            <tr>
                <td>{{ $item->product->sku }}</td>
                <td><a href="{{ (!empty($item->product->alias) && !empty($item->product->category->alias))?route('detailProduct',['cat_slug' => $item->product->category->alias,'slug'=>$item->product->alias]):'' }}" target="_blank">{{ $item->product->name }}</a></td>
                <td>{{ format_money($item->price) }}</td>
                <td>{{ $item->quantity }}</td>
            </tr>
        @empty
        @endforelse
    @endif
    </tbody>
</table>
<div class="row">
    <div class="col-md-8 text-right text-bold">Tổng tạm tính: </div>
    <div class="col-md-4">{{ format_money($total_money) }}</div>
    @if($order->price_ship_coco)
    <div class="col-md-8 text-right text-bold">Phí ship: </div>
    <div class="col-md-4">{{ $order->price_ship_coco?format_money($order->price_ship_coco):0 }}</div>
    @endif
    @if($order->coupon && $order->price_coupon_now)
    <div class="col-md-8 text-right text-bold">Mã giảm giá (nếu có): </div>
    <div class="col-md-4">
        <p style="margin-bottom: 0">(Mã áp dụng: {{ $order->coupon }})</p>
        -{{ $order->price_coupon_now?format_money($order->price_coupon_now):0 }}
    </div>
    @endif
    <div class="col-md-8 text-right text-bold">Tổng tiền: </div>
    <div class="col-md-4">{{ format_money($total_money + $order->price_ship_coco - $order->price_coupon_now) }}</div>
</div>
@section('link')
    @parent
@endsection

@section('script')
    @parent
@endsection
