<!-- gio hang -->
<div class="modal right fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-side modal-top-right modal-sm">
        <div class="modal-content">
            <div class="modal-body px-4 py-3">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked onclick="return false;" >
                    <label class="form-check-label" for="flexCheckChecked">
                        Sản phẩm đã được thêm <br>
                        vào giỏ hàng thành công!
                    </label>
                </div>
                <p class="mb-2">Chọn thêm sản phẩm khác hoặc</p>
                <a href="{{ route('showCart') }}" class="d-block text-decoration-none bg-warning text-center">Xem giỏ hàng và hoàn tất</a>
            </div>
        </div>
    </div>
</div>
