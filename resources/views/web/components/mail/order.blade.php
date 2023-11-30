<!DOCTYPE html>
<html>
<head>
    <title>Thông điệp liên hệ</title>
</head>
<body>
<h1>Xin chào, {{ $data['sender_name'] }}!</h1>
<p>Bạn nhận được thông tin đặt hàng:</p>

<ul>
    <li>Tên: {{ $data['sender_name'] }}</li>
    <li>Số điện thoại: {{ $data['sender_telephone'] }}</li>
    <li>Địa chỉ: {{ $data['sender_address'] }}</li>
    <li>Phương thức thanh toán: {{ ($data['method_pay'] == 1) ?'Thanh toán chuyển khoản':'Thanh toán khi nhận hàng' }}</li>
    <li>Nội dung liên hệ: {{ $data['sender_comments'] }}</li>
</ul>
</body>
</html>
