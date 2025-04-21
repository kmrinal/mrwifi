<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social WiFi Login with Google</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/fonts/font-awesome/css/font-awesome.min.css">
    <style>
        :root {
            --theme-color: #7367f0;
            --theme-color-light: #7367f015;
            --theme-color-dark: #5e50ee;
        }
        
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
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .location-logo img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            line-height: 1.6;
        }

        .success-message, .error-message {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            line-height: 1.6;
        }

        .success-icon {
            font-size: 4rem;
            color: #28c76f;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .error-icon {
            font-size: 4rem;
            color: #ea5455;
            margin-bottom: 1rem;
            text-align: center;
        }

        .login-button {
            background-color: var(--theme-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .login-button:hover {
            background-color: var(--theme-color-dark);
        }

        .google-button {
            background-color: #ffffff;
            color: #3c4043;
            border: 1px solid #dadce0;
            border-radius: 8px;
            padding: 14px 28px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin: 1rem auto;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: 500;
        }

        .google-button:hover {
            background-color: #f8f9fa;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.12);
        }

        .google-button:active {
            background-color: #f1f3f4;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .google-button i {
            margin-right: 12px;
            font-size: 1.2rem;
            color: #4285f4;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: #666;
            font-size: 0.9rem;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider::before {
            margin-right: 10px;
        }

        .divider::after {
            margin-left: 10px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
        }
        
        .input-group-text {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
            cursor: pointer;
        }

        .brand-logo {
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            width: 100%;
            max-width: 200px;
        }
        
        .brand-logo img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
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
            color: var(--theme-color);
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .status-box {
            text-align: center;
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.7);
        }

        .status-box.success {
            border-left: 4px solid #28c76f;
        }

        .status-box.error {
            border-left: 4px solid #ea5455;
        }

        .status-box.loading {
            /*border-left: 4px solid var(--theme-color);*/
        }

        .spinner-border {
            display: inline-block;
            width: 3rem;
            height: 3rem;
            vertical-align: text-bottom;
            border: 0.25em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
            color: var(--theme-color);
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
        }

        @keyframes spinner-border {
            100% {
                transform: rotate(360deg);
            }
        }

        .debug-info {
            background-color: rgba(0, 0, 0, 0.03);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1.5rem;
            font-size: 0.85rem;
            text-align: left;
        }

        .debug-info h5 {
            color: #666;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .debug-info p {
            margin-bottom: 0.3rem;
        }

        .debug-info .label {
            font-weight: 500;
            color: #555;
        }

        @media (max-width: 576px) {
            .portal-container {
                padding: 1.5rem;
            }
            
            .location-logo {
                height: 60px;
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
            <div class="location-logo mx-auto" id="location-logo">
                <div style="background: #f0f0f0; width: 100%; height: 100%; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #666;">
                    Location Logo
                </div>
            </div>
        </div>

        <!-- Status Container (Loading, Success, Error) -->
        <div id="status-container">
            <!-- Loading State (Default) -->
            <div id="loading-status" class="status-box loading">
                <div class="spinner-border mb-3" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <h4 class="mb-2">Processing Your Connection</h4>
                <p class="mb-0">Please wait while we authenticate your WiFi access...</p>
            </div>
            
            <!-- Success State (Hidden by Default) -->
            <div id="success-status" class="status-box loading" style="display: none;">
                <div class="spinner-border mb-3" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <h4 class="mb-2">Logging in...</h4>
                <p class="mb-3">Please wait while we connect you to the network.</p>
                <div id="redirect-container"></div>
            </div>
            
            <!-- Error State (Hidden by Default) -->
            <div id="error-status" class="status-box error" style="display: none;">
                <div class="error-icon">
                    <i class="fa fa-times-circle"></i>
                </div>
                <h4 class="mb-2">Connection Failed</h4>
                <p id="error-message" class="mb-0">There was a problem connecting to the WiFi network.</p>
            </div>
        </div>
        
        <!-- Debug Information (Hidden by Default) -->
        <div id="debug-info" class="debug-info" style="display: none;">
            <h5>Connection Details</h5>
            <p><span class="label">Location ID:</span> <span id="location-id">--</span></p>
            <p><span class="label">MAC Address:</span> <span id="mac-address">--</span></p>
            <p><span class="label">Challenge:</span> <span id="challenge">--</span></p>
            <p><span class="label">Response:</span> <span id="api-response">--</span></p>
        </div>

        <!-- Footer with Brand Logo and Terms -->
        <div class="footer">
            <div class="brand-logo">
                <img src="/app-assets/mrwifi-assets/Mr-Wifi.PNG" alt="Brand Logo">
            </div>
            <div class="terms" id="terms-text">
                Powered by Mr WiFi
            </div>
        </div>
    </div>

    <script src="/app-assets/vendors/js/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log('Google callback page loaded');
            
            // Function to apply theme color
            function applyThemeColor(themeColor) {
                if (themeColor) {
                    document.documentElement.style.setProperty('--theme-color', themeColor);
                    
                    // Create a darker version for hover states
                    const darkerColor = createDarkerColor(themeColor);
                    document.documentElement.style.setProperty('--theme-color-dark', darkerColor);
                }
            }
            
            // Apply theme color from localStorage if available
            const locationData = JSON.parse(localStorage.getItem('location_data') || '{}');
            if (locationData.design && locationData.design.theme_color) {
                applyThemeColor(locationData.design.theme_color);
            }
            
            // Apply logo from localStorage if available
            if (locationData.design && locationData.design.location_logo_path) {
                $('#location-logo').html(`<img src="/storage/${locationData.design.location_logo_path}" alt="Location Logo">`);
            }
            
            // Apply terms from localStorage if available
            if (locationData.settings && locationData.settings.terms_enabled) {
                $('#terms-text').html('By connecting, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>');
            }
            
            // Get URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const state = urlParams.get('state');
            const code = urlParams.get('code');
            const error = urlParams.get('error');
            
            console.log('Code present:', !!code);
            console.log('State present:', !!state);
            console.log('Error present:', !!error);
            
            // Handle error from OAuth provider
            if (error) {
                showError('Authentication Failed', 'There was an error during Google authentication: ' + error);
                return;
            }
            
            // Check if required parameters are present
            if (!state || !code) {
                showError('Missing Parameters', 'Required authentication parameters are missing.');
                return;
            }
            
            try {
                // Parse the state parameter (contains the original login URL with MAC and location)
                const stateObj = JSON.parse(decodeURIComponent(state));
                console.log('State object:', stateObj);
                
                if (!stateObj.login_url) {
                    showError('Invalid State', 'The authentication state parameter is invalid.');
                    return;
                }
                
                // Extract location and MAC from login_url
                // Expected format: /social-login/google/{location_id}/{mac_address}
                const loginUrlPath = new URL(stateObj.login_url).pathname;
                const pathParts = loginUrlPath.split('/').filter(part => part.length > 0);
                
                console.log('Login URL path:', loginUrlPath);
                console.log('Path parts:', pathParts);
                
                let locationId, macAddress;
                
                if (pathParts.length >= 4 && pathParts[0] === 'social-login' && pathParts[1] === 'google') {
                    locationId = pathParts[2];
                    macAddress = pathParts[3];
                    console.log('Extracted from social-login path - Location:', locationId, 'MAC:', macAddress);
                } else if (pathParts.length >= 3 && pathParts[0] === 'google-login') {
                    locationId = pathParts[1];
                    macAddress = pathParts[2];
                    console.log('Extracted from google-login path - Location:', locationId, 'MAC:', macAddress);
                }
                
                // Update debug info
                $('#location-id').text(locationId || 'Not found');
                $('#mac-address').text(macAddress || 'Not found');
                
                if (!locationId || !macAddress) {
                    showError('Information Missing', 'Could not determine your location or device information.');
                    $('#debug-info').show();
                    return;
                }
                
                // Get challenge from localStorage
                const challenge = localStorage.getItem('challenge');
                console.log('Challenge from localStorage:', challenge);
                $('#challenge').text(challenge || 'Not found');
                
                if (!challenge) {
                    console.log('Challenge not found in localStorage, fetching location info...');
                    // If challenge is missing, try to get location information first
                    $.ajax({
                        url: `/api/captive-portal/${locationId}/info`,
                        type: 'GET',
                        data: { mac_address: macAddress },
                        headers: { 'Accept': 'application/json' },
                        success: function(locationInfo) {
                            console.log('Location info response:', locationInfo);
                            
                            if (locationInfo.success && locationInfo.location) {
                                // Store the challenge and other important data
                                localStorage.setItem('location_data', JSON.stringify(locationInfo.location));
                                localStorage.setItem('challenge', locationInfo.location.challenge);
                                
                                const updatedChallenge = locationInfo.location.challenge;
                                $('#challenge').text(updatedChallenge);
                                
                                // Apply location-specific design if available
                                if (locationInfo.location.design) {
                                    if (locationInfo.location.design.location_logo_path) {
                                        $('#location-logo').html(`<img src="/storage/${locationInfo.location.design.location_logo_path}" alt="Location Logo">`);
                                    }
                                    
                                    if (locationInfo.location.design.theme_color) {
                                        applyThemeColor(locationInfo.location.design.theme_color);
                                    }
                                }
                                
                                // Now that we have the challenge, proceed with guest login
                                proceedWithGuestLogin(locationId, macAddress, updatedChallenge, code);
                            } else {
                                showError('Location Not Found', 'Could not retrieve location information for WiFi access.');
                                $('#debug-info').show();
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching location info:', error);
                            showError('Connection Error', 'Failed to retrieve location information. Please try again.');
                            $('#debug-info').show();
                            $('#api-response').text(xhr.responseText || error);
                        }
                    });
                } else {
                    // We have the challenge, proceed with guest login
                    proceedWithGuestLogin(locationId, macAddress, challenge, code);
                }
                
            } catch (e) {
                console.error('Error processing callback parameters:', e);
                showError('Invalid Parameters', 'Could not process the authentication response.');
                $('#api-response').text(e.toString());
                $('#debug-info').show();
            }
            
            // Function to proceed with guest login using Google authentication
            function proceedWithGuestLogin(locationId, macAddress, challenge, googleCode) {
                console.log('Proceeding with guest login:');
                console.log('- Location ID:', locationId);
                console.log('- MAC Address:', macAddress);
                console.log('- Challenge:', challenge);
                console.log('- Google Code:', googleCode ? 'Present (length: ' + googleCode.length + ')' : 'Missing');
                var ip_address = localStorage.getItem('nas_ip');
                // Call the guest/login API with social auth (Google)
                $.ajax({
                    url: '/api/guest/login',
                    type: 'POST',
                    data: {
                        location_id: locationId,
                        mac_address: macAddress, 
                        challenge: challenge,
                        login_method: 'social',
                        social_platform: 'google',
                        social_auth_code: googleCode,
                        ip_address: ip_address
                    },
                    headers: { 'Accept': 'application/json' },
                    success: function(response) {
                        console.log('Guest login response:', response);
                        $('#api-response').text(JSON.stringify(response));
                        
                        if (response.success) {
                            // Show success message
                            showSuccess();
                            
                            // If there's a redirect URL in the response, add button and set auto-redirect
                            if (response.redirect_url) {
                                console.log('Redirect URL provided:', response.redirect_url);
                                
                                // Add continue button
                                $('#redirect-container').html(`
                                    <a href="${response.redirect_url}" class="login-button">
                                        Continue Browsing
                                    </a>
                                `);
                                
                                // Set auto-redirect after 3 seconds
                                setTimeout(function() {
                                    window.location.href = response.redirect_url;
                                }, 3000);
                            }
                        } else {
                            // Show error with the message from the response
                            showError('Connection Failed', response.message || 'There was an error connecting to the WiFi network.');
                            $('#debug-info').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Guest login error:', error);
                        console.error('Response:', xhr.responseText);
                        
                        let errorMessage = 'There was an error processing your request.';
                        try {
                            const response = JSON.parse(xhr.responseText);
                            if (response.message) {
                                errorMessage = response.message;
                            }
                            $('#api-response').text(JSON.stringify(response));
                        } catch (e) {
                            console.error('Error parsing error response:', e);
                            $('#api-response').text(xhr.responseText || error);
                        }
                        
                        showError('Connection Failed', errorMessage);
                        $('#debug-info').show();
                    }
                });
            }
            
            // Function to show success state
            function showSuccess() {
                $('#loading-status').hide();
                $('#error-status').hide();
                $('#success-status').show();
            }
            
            // Function to show error state
            function showError(title, message) {
                $('#loading-status').hide();
                $('#success-status').hide();
                $('#error-status').find('h4').text(title);
                $('#error-message').text(message);
                $('#error-status').show();
            }
            
            // Helper function to create a darker color for hover states
            function createDarkerColor(hexColor) {
                // Remove # if present
                hexColor = hexColor.replace('#', '');
                
                // Parse the hex color
                let r = parseInt(hexColor.substr(0, 2), 16);
                let g = parseInt(hexColor.substr(2, 2), 16);
                let b = parseInt(hexColor.substr(4, 2), 16);
                
                // Make it darker by reducing each component
                r = Math.max(0, r - 25);
                g = Math.max(0, g - 25);
                b = Math.max(0, b - 25);
                
                // Convert back to hex
                return `#${r.toString(16).padStart(2, '0')}${g.toString(16).padStart(2, '0')}${b.toString(16).padStart(2, '0')}`;
            }
            
            // Apply background image from localStorage if available
            if (locationData.design && locationData.design.background_image_path) {
                document.body.style.backgroundImage = `url('/storage/${locationData.design.background_image_path}')`;
            }
        });
    </script>
</body>
</html>