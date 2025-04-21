<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Login Failed</title>
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

        .error-container {
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

        .error-icon {
            font-size: 64px;
            color: #ea5455;
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

        .error-details {
            background-color: #f8f9fa;
            padding: 16px;
            border-radius: 8px;
            width: 100%;
            margin-bottom: 24px;
            text-align: left;
            font-size: 14px;
            color: #666;
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
            margin: 8px;
        }

        .button.primary {
            background-color: #3B82F6;
        }

        .button.primary:hover {
            background-color: #2563EB;
        }

        .button.secondary {
            background-color: #6c757d;
        }

        .button.secondary:hover {
            background-color: #5a6268;
        }

        .buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .footer {
            margin-top: 32px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="MrWiFi Logo" class="logo">
        <div class="error-icon">
            <i class="fa fa-times-circle"></i>
        </div>
        <h1 class="title">Connection Failed</h1>
        <p class="message">We couldn't connect you to the WiFi network. This might be due to authentication issues or network problems.</p>
        
        <div id="error-details" class="error-details" style="display: none;">
            <div id="error-message">No specific error details available.</div>
        </div>
        
        <div class="buttons">
            <a href="{{ url('/guest-login') }}" class="button primary">Try Again</a>
            <a href="#" id="show-details-btn" class="button secondary">Show Details</a>
        </div>
        
        <div class="footer">
            Powered by MrWiFi
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get error message from localStorage if available
            const errorMessage = localStorage.getItem('login_error') || 'No specific error details available.';
            document.getElementById('error-message').textContent = errorMessage;
            
            // Toggle error details visibility
            const showDetailsBtn = document.getElementById('show-details-btn');
            const errorDetails = document.getElementById('error-details');
            
            showDetailsBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (errorDetails.style.display === 'none') {
                    errorDetails.style.display = 'block';
                    showDetailsBtn.textContent = 'Hide Details';
                } else {
                    errorDetails.style.display = 'none';
                    showDetailsBtn.textContent = 'Show Details';
                }
            });
            
            // Check if there's a redirect URL in localStorage for the "Try Again" button
            const loginUrl = localStorage.getItem('login_url') || '{{ url("/guest-login") }}';
            const tryAgainBtn = document.querySelector('.button.primary');
            if (tryAgainBtn) {
                tryAgainBtn.href = loginUrl;
            }
        });
    </script>
</body>
</html> 