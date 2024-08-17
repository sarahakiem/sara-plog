<!DOCTYPE html>
<html>
<head>
    <title>Contact Us Message</title>
</head>
<body>
    <h1>{{ $mails['subject'] }}</h1>
    <p><strong>Name:</strong> {{ $mails['name'] }}</p>
    <p><strong>Email:</strong> {{ $mails['email'] }}</p>
    <p><strong>Message:</strong> {{ $mails['message'] }}</p>
</body>
</html>
