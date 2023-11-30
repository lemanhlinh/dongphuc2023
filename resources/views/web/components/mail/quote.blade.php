<!DOCTYPE html>
<html>
<head>
    <title>Thông điệp liên hệ</title>
</head>
<body>
<h1>Nhận báo giá với các thông tin sau:</h1>

<ul>
    @if($data->input('name_contact'))
    <li>Tên: {{ $data->input('name_contact') }}</li>
    @endif
    <li>Số điện thoại: {{ $data->input('phone_contact') }}</li>
    @if($data->input('email_contact'))
    <li>Email: {{ $data->input('email_contact') }}</li>
    @endif
    <li>Số lượng: {{ $data->input('number_contact') }}</li>
</ul>
</body>
</html>
