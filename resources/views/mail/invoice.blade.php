<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<ul>
    <li>Payment ID: {{ $data['payment_id'] }}</li>
    <li>Total amount: {{ $data['total'] }}</li>
    <li>Payment type: {{ $data['payment_type'] }}</li>
    <li>Status code: {{ $data['status_code'] }}</li>
</ul>
<p>Thank you for your order!</p>
</body>
</html>
