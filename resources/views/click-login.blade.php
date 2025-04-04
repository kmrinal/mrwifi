<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Click-Through Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <style>
        body {
            min-height: 100vh;
            background-image: url('/app-assets/mrwifi-assets/captive-portal/images/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .portal-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            max-width: 420px;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            margin: 0 auto;
        }

        .location-logo {
            height: 64px;
            background: #f0f0f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            margin-bottom: 2rem;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 3rem;
            color: #333;
            line-height: 1.6;
        }

        .login-button {
            background-color: #7367f0;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            width: auto;
            min-width: 180px;
            max-width: 250px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .login-button:hover {
            background-color: #5e50ee;
        }

        .brand-logo {
            height: 32px;
            background: #f0f0f0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            margin: 0 auto 1rem;
            width: 100%;
            max-width: 200px;
        }

        .login-info {
            font-size: 0.85rem;
            color: #666;
            margin-top: 1rem;
            text-align: center;
        }

        .footer {
            margin-top: 3rem;
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
            text-align: center;
        }

        .terms {
            font-size: 0.8rem;
            color: #666;
        }

        .terms a {
            color: #7367f0;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .portal-container {
                padding: 1.5rem;
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
        <div class="text-center">
            <div class="location-logo mx-auto">Location Logo</div>
        </div>

        <!-- Welcome Text -->
        <div class="welcome-text">
            Welcome to our WiFi network. Click the button below to connect and enjoy high-speed internet access. By connecting, you agree to our terms of service and acceptable use policy.
        </div>

        <!-- Click-Through Login Section -->
        <div class="text-center">
            <div id="login-form">
                <button type="submit" class="login-button">Connect to WiFi</button>
            </div>
            <div class="login-info">
                No registration required. Simply click to connect.
            </div>
        </div>

        <!-- Footer with Brand Logo and Terms -->
        <div class="footer">
            <div class="brand-logo">Brand Logo</div>
            <div class="terms">
                By connecting, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>

    <script src="/app-assets/vendors/js/jquery/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <script src="/app-assets/mrwifi-assets/captive-portal/js/click-login.js"></script>
</body>
</html>
