<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Login Successful</title>
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-color: #f5f7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-container {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 400px;
            text-align: center;
        }

        .logo {
            width: 120px;
            height: auto;
            margin-bottom: 32px;
        }

        .success-icon {
            font-size: 64px;
            color: #28c76f;
            margin: 16px 0;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }

        .message {
            color: #666;
            font-size: 16px;
            margin-bottom: 32px;
            line-height: 1.5;
        }

        .button {
            background-color: #3B82F6;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .button:hover {
            background-color: #2563EB;
        }

        .footer {
            margin-top: 32px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="MrWiFi Logo" class="logo">
        <div class="success-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <h1 class="title">Successfully Connected!</h1>
        <p class="message">You are now connected to the WiFi network. Enjoy your browsing experience!</p>
        <a href="https://www.mrwifi.co.uk" class="button">Continue Browsing</a>
        <div class="footer">
            Powered by MrWiFi
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get referrer URL from localStorage if available
            const referrerUrl = localStorage.getItem('referrer_url') || 'https://www.mrwifi.co.uk';
            
            // Update the continue button href
            const continueButton = document.querySelector('.button');
            if (continueButton) {
                continueButton.href = referrerUrl;
            }
            
            // Auto-redirect after 5 seconds
            setTimeout(function() {
                window.location.href = referrerUrl;
            }, 5000);
        });
    </script>
</body>
</html> 