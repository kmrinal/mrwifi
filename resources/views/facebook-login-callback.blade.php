<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social WiFi Login with Facebook</title>
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

        .status-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .status-icon {
            font-size: 48px;
            margin-bottom: 1rem;
            color: var(--theme-color);
        }

        .welcome-text, .status-message {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
            line-height: 1.6;
            font-size: 1.2rem;
        }

        .facebook-button {
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px 28px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
            width: 100%;
            margin: 1rem auto;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .footer {
            margin-top: 3rem;
            border-top: 1px solid #eee;
            padding-top: 1.5rem;
            text-align: center;
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

        <!-- Alert for messages -->
        <div id="alert-container" style="display: none;"></div>

        <!-- Status Container -->
        <div class="status-container">
            <div class="status-icon">
                <i class="spinner-border text-primary"></i>
            </div>
            <div class="status-message" id="status-message">
                Connecting you to our WiFi network...
            </div>
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
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    
    <script>
        $(document).ready(function() {
            console.log('Document ready, initializing Facebook callback page');
            
            // Extract parameters from URL
            const urlParams = new URLSearchParams(window.location.search);
            const fbCode = urlParams.get('code');
            
            // Extract state parameter and parse it
            let stateParam = urlParams.get('state');
            let locationId, macAddress;
            
            // Try to parse the state as JSON
            if (stateParam) {
                try {
                    // Decode URI encoded state and parse as JSON
                    const stateObj = JSON.parse(decodeURIComponent(stateParam));
                    console.log('State object:', stateObj);
                    
                    // Extract login_url which contains location_id and mac_address
                    if (stateObj && stateObj.login_url) {
                        const loginUrl = stateObj.login_url;
                        
                        // Parse login_url to extract location_id and mac_address
                        // Expected format: /social-login/facebook/{location_id}/{mac_address}
                        const urlParts = loginUrl.split('/');
                        if (urlParts.length >= 2) {
                            // Get the last two segments of the URL
                            locationId = urlParts[urlParts.length - 2];
                            macAddress = urlParts[urlParts.length - 1];
                        }
                    }
                } catch (e) {
                    console.error('Error parsing state parameter:', e);
                }
            }
            
            console.log('Extracted parameters:', { 
                fbCode, 
                locationId, 
                macAddress,
                stateParam
            });
            
            // Get stored data from localStorage
            const locationData = JSON.parse(localStorage.getItem('location_data') || '{}');
            console.log('Location data:', locationData);
            const challenge = localStorage.getItem('challenge');
            const ipAddress = localStorage.getItem('nas_ip');
            
            // Function to show alerts
            function showAlert(message, type) {
                $('#alert-container').html(`
                    <div class="alert alert-${type}" role="alert">
                        ${message}
                    </div>
                `).show();
                
                // Auto-hide success alerts after 5 seconds
                if (type === 'success') {
                    setTimeout(function() {
                        $('#alert-container').fadeOut();
                    }, 5000);
                }
            }
            
            // Update status message
            function updateStatus(message, isError = false) {
                $('#status-message').text(message);
                if (isError) {
                    $('.status-icon').html('<i class="fa fa-times-circle text-danger" style="font-size: 48px;"></i>');
                    showAlert(message, 'danger');
                } else {
                    $('.status-icon').html('<i class="spinner-border text-primary"></i>');
                }
            }
            
            // Check if we have all required parameters
            if (!fbCode || !locationId || !macAddress || !challenge || !ipAddress) {
                updateStatus('Missing required parameters. Please try again.', true);
                console.error('Missing parameters:', { 
                    fbCode, locationId, macAddress, challenge, ipAddress 
                });
                return;
            }
            
            // Prepare login data for Facebook social login
            const loginData = {
                location_id: locationId,
                mac_address: macAddress,
                login_method: 'social',
                social_platform: 'facebook',
                social_token: fbCode,
                name: '', // We could fetch this from Facebook API if needed
                email: '', // We could fetch this from Facebook API if needed
                challenge: challenge,
                ip_address: ipAddress
            };
            
            console.log('Login data:', loginData);
            
            // Call the login API with Facebook authentication
            $.ajax({
                url: '/api/guest/login',
                method: 'POST',
                data: loginData,
                success: function(response) {
                    console.log('Login response:', response);
                    if (response.success) {
                        // Update message to indicate Facebook authentication success
                        updateStatus('Facebook authentication successful! Connecting to WiFi...');
                        // Update icon to indicate intermediate state
                        $('.status-icon').html('<i class="fa fa-wifi text-primary" style="font-size: 48px;"></i>');
                        
                        // Show a temporary alert for facebook auth success
                        showAlert('Social login successful. Initializing WiFi connection...', 'info');
                        
                        // Redirect to success page or Internet after delay
                        setTimeout(function() {
                            const redirectUrl = response.login_url;
                            if (redirectUrl) {
                                // Update message before redirecting
                                updateStatus('Redirecting to activate WiFi connection...');
                                $('.status-icon').html('<i class="spinner-border text-primary"></i>');
                                
                                console.log('Redirecting to WiFi authentication URL:', redirectUrl);
                                window.location.href = redirectUrl;
                            } else {
                                updateStatus('Error: Missing WiFi activation URL', true);
                            }
                        }, 2000);
                    } else {
                        updateStatus('Authentication failed: ' + (response.message || 'Unknown error'), true);
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Authentication failed';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    updateStatus(errorMessage, true);
                    console.error('Error:', xhr);
                }
            });
            
            // Apply design settings
            function applyDesignSettings(settings, design) {
                // Set theme color from full design data first, fallback to settings
                const themeColor = design.theme_color || settings.theme_color || getComputedStyle(document.documentElement).getPropertyValue('--theme-color').trim();
                if (themeColor) {
                    document.documentElement.style.setProperty('--theme-color', themeColor);
                    
                    // Create a darker version for hover states
                    const darkerColor = createDarkerColor(themeColor);
                    document.documentElement.style.setProperty('--theme-color-dark', darkerColor);
                }
                
                // Set background image from full design data
                if (design.background_image_path) {
                    document.body.style.backgroundImage = `url('/storage/${design.background_image_path}')`;
                }
                
                // Set location logo from full design data
                if (design.location_logo_path) {
                    $('#location-logo').html(`<img src="/storage/${design.location_logo_path}" alt="Location Logo">`);
                }
                
                // Set terms visibility from full design data, fallback to settings
                const showTerms = design.show_terms || settings.terms_enabled;
                if (showTerms) {
                    $('#terms-text').html('By connecting, you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>');
                }
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
            
            // Apply design settings if available
            if (locationData && locationData.settings) {
                applyDesignSettings(
                    locationData.settings || {}, 
                    locationData.design || {}
                );
            }
            
            // Get location information if needed
            if (locationId) {
                $.ajax({
                    url: `/api/captive-portal/${locationId}/info`,
                    type: 'GET',
                    data: { mac_address: macAddress },
                    headers: { 'Accept': 'application/json' },
                    success: function(locationInfo) {
                        console.log('Location info:', locationInfo);
                        
                        // Store location data in localStorage for future use
                        if (locationInfo.success && locationInfo.location) {
                            // Store the challenge and other important data
                            localStorage.setItem('location_data', JSON.stringify(locationInfo.location));
                            localStorage.setItem('challenge', locationInfo.location.challenge);
                            
                            // Apply design settings again with fresh data
                            applyDesignSettings(
                                locationInfo.location.settings || {}, 
                                locationInfo.location.design || {}
                            );
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching location info:', error);
                    }
                });
            }
        });
    </script>
</body>
</html>