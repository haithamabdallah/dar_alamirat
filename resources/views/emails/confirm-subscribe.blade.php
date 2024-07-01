<!-- resources/views/emails/newsletter.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Confirm Your Subscription</title>
    <style>

    </style>
</head>

<body>
    This email sent to you to confirm your subscription.
    To confirm your subscription, please click on the link below.
    <br>
    <p> confirm your subscription : <a href="{{ $url }}">{{ $url }}</a> </p>
    <br>
    If you did not subscribe, please ignore this email.
    Thanks
</body>

</html>
