<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Login Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background-image: url('/path/to/your/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .portal-container {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 32px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            min-height: 500px;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .location-logo {
            height: 64px;
            width: auto;
            margin: 0 auto;
            background: #f0f0f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #666;
            padding: 0 16px;
        }

        .welcome-text {
            color: #333;
            font-size: 0.95rem;
            line-height: 1.5;
            margin: 24px 0 32px;
            text-align: center;
        }

        .login-placeholder {
            background: #f8f8f8;
            border: 2px dashed #ddd;
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            color: #666;
            margin-bottom: 24px;
            flex-grow: 1;
        }

        .login-placeholder p {
            margin-bottom: 8px;
            font-weight: 500;
        }

        .login-placeholder span {
            font-size: 0.9rem;
            color: #888;
        }

        .footer {
            margin-top: auto;
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 24px;
        }

        .brand-logo {
            height: 32px;
            width: auto;
            margin: 0 auto 16px;
            background: #f0f0f0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            padding: 0 12px;
        }

        .terms {
            font-size: 0.8rem;
            color: #666;
        }

        .terms a {
            color: #007bff;
            text-decoration: none;
        }

        @media (max-width: 480px) {
            .portal-container {
                padding: 24px;
                min-height: 450px;
            }

            .location-logo {
                height: 48px;
            }

            .brand-logo {
                height: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="portal-container">
        <!-- Header with Location Logo -->
        <div class="header">
            <div class="location-logo">Location Logo</div>
        </div>

        <!-- Welcome Text -->
        <div class="welcome-text">
            Welcome to our WiFi network. Connect with us to enjoy high-speed internet access. By connecting, you agree to our terms of service and acceptable use policy.
        </div>

        <!-- Login Placeholder -->
        <div class="login-placeholder">
            <p>Login Method Placeholder</p>
            <span>This area will contain the selected login method (email, social, etc.)</span>
        </div>

        <!-- Footer with Brand Logo and Terms -->
        <div class="footer">
            <div class="brand-logo">Brand Logo</div>
            <div class="terms">
                By connecting, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</body>
</html>
