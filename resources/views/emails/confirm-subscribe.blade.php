<!-- resources/views/emails/newsletter.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Confirm Your Subscription</title>
    <style>

    </style>
</head>

<body style="background: #fff;">
<div style="
        border-top: 2px solid #111213;
        box-shadow: 0px 0px 80px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
        max-width: 480px;
        margin: 15px auto;
        text-align: center;
        border-radius: 10px;
    ">
    <p>This email sent to you to confirm your subscription.</p>
    <p>To confirm your subscription, please click on the link below.</p>

    <div style="
                display: block;
                margin: 25px 0;">
        <a href="{{ $url }}" style="
                                    background: #0a6ebd;
                                    color: #fff; font-size: 16px;
                                    font-weight: bold;
                                    text-align: center;
                                    border-radius: 10px;
                                    padding: 10px 30px;
                                    text-decoration: none;">confirm your subscription</a>
    </div>

    <p>If you did not subscribe, please ignore this email.</p>
    <p>Thanks</p>
</div>
</body>

</html>
