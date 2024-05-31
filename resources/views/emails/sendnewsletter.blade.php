<!-- resources/views/emails/newsletter.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Newsletter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 90%;
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
        }
        .header h1 {
            margin: 0;
            color: #333333;
        }
        .content {
            padding: 20px;
        }
        .content p {
            font-size: 16px;
            color: #555555;
        }
        .main-message {
            font-size: 18px;
            font-weight: bold;
            color: #333333;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            color: #999999;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your newsletter</h1>
        </div>
        <div class="content">
            <p></p>
            <p class="main-message"></p>
            <p>{{ $content }}</p>
        </div>
        <div class="footer">
            <p>Thank you for being with us!</p>
        </div>
    </div>
</body>
</html>
