<!DOCTYPE html>
<html>
<head>
    <title>Thông điệp liên hệ</title>
</head>
<body>
<h1>Xin chào, {{ $data['full_name'] }}!</h1>
<p>Bạn nhận được liên hệ với các thông tin sau:</p>

<ul>
    <li>Tên: {{ $data['full_name'] }}</li>
    <li>Số điện thoại: {{ $data['phone'] }}</li>
    <li>Email: {{ $data['email'] }}</li>
    <li>Nội dung liên hệ: {{ $data['content'] }}</li>
</ul>
</body>
</html>
