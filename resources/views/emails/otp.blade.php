<!-- resources/views/emails/newsletter.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Your OTP Code</title>
</head>

<body style="background: #fff;">
<div style="
        border-top: 2px solid #111213;
        box-shadow: 0px 0px 80px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
        max-width: 480px;
        margin: 15px auto;
        text-align: center;
    ">
    <div style="
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;">
        <p>Your OTP code is:</p>
        <p style="
                                    background: #0a6ebd;
                                    color: #fff; font-size: 16px;
                                    font-weight: bold;
                                    text-align: center;
                                    border-radius: 10px;
                                    padding: 10px 30px;
                                    text-decoration: none;">{{ $otp }}</p>
    </div>

</div>
</body>

</html>
