<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Login Portal</title>
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

        .loading-container {
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

        .loading-spinner {
            width: 50px;
            height: 50px;
            margin: 24px auto;
            border: 3px solid rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            border-top-color: #3B82F6;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .loading-text {
            color: #666;
            font-size: 16px;
            margin-top: 16px;
        }

        .footer {
            margin-top: 32px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="MrWiFi Logo" class="logo">
        <div class="loading-spinner"></div>
        <div class="loading-text">Loading your WiFi login options...</div>
        <div class="footer">
            Powered by MrWiFi
        </div>
    </div>
    
    <script src="{{ asset('app-assets/mrwifi-assets/captive-portal/js/loading.js') }}?v={{ time() }}"></script>
</body>
</html>
