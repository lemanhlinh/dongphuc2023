<div class="form-bao-gia">
    <img src="{{ asset('images/logo-mk.png') }}" class="logo-cati-pupop"/>
    <h3 class="text-center">Nhận Báo Giá Sản Phẩm Này</h3>
    <form method="post" action="{{ $router }}" name="contact" class="form">
        @csrf
        <input type="text" name="name_contact" placeholder="Họ tên của bạn" class="form-control" required>
        <input type="text" name="phone_contact" placeholder="Số điện thoại" class="form-control" required>
        <input type="text" name="number_contact" placeholder="Số lượng dự kiến" class="form-control" required>
        <input type="text" name="email_contact" placeholder="Email" class="form-control" >
        <input type="submit" value="Nhận báo giá" class="btn btn-success buttom-contact">
        <input type="hidden" name="id" value="{{ $product_id }}"/>
    </form>
</div>
