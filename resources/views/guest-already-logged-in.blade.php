<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Already Connected</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .success-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .location-logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .success-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }
        .success-message {
            font-size: 16px;
            margin-bottom: 25px;
            color: #666;
        }
        .action-button {
            padding: 10px 25px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s;
        }
        .action-button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <img src="" alt="Location Logo" class="location-logo" id="locationLogo">
        <div class="success-title">Already Connected</div>
        <div class="success-message">
            You are already connected to this WiFi network. 
            No need to log in again.
        </div>
        <a href="#" class="action-button" id="continueButton">Continue Browsing</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Get stored data from localStorage
            const logoUrl = localStorage.getItem('locationLogoUrl');
            const themeColor = localStorage.getItem('themeColor');
            const backgroundImageUrl = localStorage.getItem('backgroundImageUrl');
            const returnUrl = localStorage.getItem('returnUrl') || '/';
            
            // Set location logo
            if (logoUrl) {
                $('#locationLogo').attr('src', logoUrl);
            } else {
                // Hide logo if not available
                $('.location-logo').hide();
            }
            
            // Set theme color for button
            if (themeColor) {
                $('.action-button').css('background-color', themeColor);
            } else {
                // Default color
                $('.action-button').css('background-color', '#4285F4');
            }
            
            // Set background image
            if (backgroundImageUrl) {
                $('body').css('background-image', `url(${backgroundImageUrl})`);
            } else {
                // Default background
                $('body').css('background-color', '#f5f5f5');
            }
            
            // Set continue button URL
            $('#continueButton').attr('href', returnUrl);
        });
    </script>
</body>
</html> 