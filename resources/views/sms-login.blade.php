<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Login with SMS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
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
        }

        .login-button:hover {
            background-color: var(--theme-color-dark);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px;
        }

        .otp-container {
            display: none;
        }

        .resend-container {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .resend-link {
            color: var(--theme-color);
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

        <!-- Welcome Text -->
        <div class="welcome-text" id="welcome-text">
            Please enter your phone number to receive a one-time password and connect to our WiFi network.
        </div>

        <!-- Alert for messages -->
        <div id="alert-container" style="display: none;"></div>

        <!-- SMS Login Form -->
        <div id="phone-form" class="phone-container">
            <form id="phone-form">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                <button type="submit" class="login-button" id="request-otp-button">Send Verification Code</button>
            </form>
        </div>

        <!-- OTP Verification Form -->
        <div id="otp-form" class="otp-container">
            <form id="verify-otp-form">
                <div class="form-group">
                    <label for="otp">Verification Code</label>
                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter 6-digit code" maxlength="6" required>
                </div>
                <div class="resend-container">
                    <span id="timer-text">Code expires in <span id="timer">05:00</span></span>
                    <div id="resend-container" style="display: none;">
                        <span>Didn't receive code? <a class="resend-link" id="resend-link">Resend</a></span>
                    </div>
                </div>
                <button type="submit" class="login-button" id="verify-otp-button">Connect to WiFi</button>
            </form>
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

    <!-- Bootstrap JS -->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    
    <script>
        $(document).ready(function() {
            // Get location data from localStorage
            const locationData = JSON.parse(localStorage.getItem('location_data') || '{}');
            const locationSettings = locationData.settings || {};
            
            // Get design data - use the full design object from the response if available
            const designData = locationData.design || {};
            console.log('Location data:', locationData);
            console.log('Design data:', designData);
            
            // Get URL parameters (for mac address, etc.)
            const urlParams = new URLSearchParams(window.location.search);
            const macAddress = urlParams.get('mac') || getPathParameter('mac_address');
            const locationId = getPathParameter('location');
            
            // Apply design settings
            applyDesignSettings(locationSettings, designData);
            
            let timerInterval;
            let secondsRemaining = 300; // 5 minutes
            
            // Handle phone number submission
            $('#phone-form').on('submit', function(e) {
                e.preventDefault();
                
                const phoneNumber = $('#phone').val();
                if (!phoneNumber) {
                    showAlert('Please enter a valid phone number', 'danger');
                    return;
                }
                
                // Show loading state
                const $button = $('#request-otp-button');
                const originalText = $button.text();
                $button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Sending...').prop('disabled', true);
                
                // Call the requestOtp API
                $.ajax({
                    url: '/api/guest/request-otp',
                    method: 'POST',
                    data: {
                        location_id: locationId,
                        phone: phoneNumber,
                        mac_address: macAddress
                    },
                    success: function(response) {
                        console.log('OTP request response:', response);
                        if (response.success) {
                            // Show OTP form
                            $('#phone-form').hide();
                            $('#otp-form').show();
                            
                            // Start the timer
                            startTimer();
                            
                            showAlert('Verification code sent to your phone', 'success');
                        } else {
                            // Show error
                            $button.html(originalText).prop('disabled', false);
                            showAlert(response.message || 'Failed to send verification code', 'danger');
                        }
                    },
                    error: function(xhr) {
                        // Restore button
                        $button.html(originalText).prop('disabled', false);
                        
                        // Show error
                        let errorMessage = 'Failed to send verification code';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert(errorMessage, 'danger');
                    }
                });
            });
            
            // Handle OTP verification
            $('#verify-otp-form').on('submit', function(e) {
                e.preventDefault();
                
                const otp = $('#otp').val();
                const challenge = localStorage.getItem('challenge');
                const location_data = JSON.parse(localStorage.getItem('location_data') || '{}');
                const ipAddress = location_data.ip_address;
                console.log('IP address:', ipAddress);
                console.log('location_data:', location_data);
                if (!otp || otp.length !== 6) {
                    showAlert('Please enter a valid 6-digit verification code', 'danger');
                    return;
                }
                
                // Show loading state
                const $button = $('#verify-otp-button');
                const originalText = $button.text();
                $button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...').prop('disabled', true);
                var login_data = {
                    location_id: locationId,
                    mac_address: macAddress,
                    login_method: 'sms',
                    phone: $('#phone').val(),
                    otp: otp,
                    challenge: challenge,
                    ip_address: ipAddress
                }
                console.log('Login data:', login_data);
                // Call the login API with OTP verification
                $.ajax({
                    url: '/api/guest/login',
                    method: 'POST',
                    data: login_data,
                    success: function(response) {
                        console.log('Login response:', response);
                        if (response.success) {
                            // Stop the timer
                            clearInterval(timerInterval);
                            
                            // Show success message
                            showAlert('Successfully connected to WiFi', 'success');
                            $button.html('Connected!').removeClass('btn-primary').addClass('btn-success');
                            
                            // Redirect to success page or Internet after delay
                            setTimeout(function() {
                                const redirectUrl = response.login_url;
                                window.location.href = redirectUrl;
                            }, 2000);
                        } else {
                            // Show error
                            $button.html(originalText).prop('disabled', false);
                            showAlert(response.message || 'Failed to verify code', 'danger');
                        }
                    },
                    error: function(xhr) {
                        // Restore button
                        $button.html(originalText).prop('disabled', false);
                        
                        // Show error
                        let errorMessage = 'Failed to verify code';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert(errorMessage, 'danger');
                    }
                });
            });
            
            // Handle resend OTP
            $('#resend-link').on('click', function() {
                // Reset timer
                secondsRemaining = 300;
                updateTimerDisplay();
                
                // Show timer and hide resend link
                $('#timer-text').show();
                $('#resend-container').hide();
                
                // Restart timer
                startTimer();
                
                // Show loading state
                const $link = $(this);
                const originalText = $link.text();
                $link.text('Sending...').css('pointer-events', 'none');
                
                // Call the requestOtp API again
                $.ajax({
                    url: '/api/guest/request-otp',
                    method: 'POST',
                    data: {
                        location_id: locationId,
                        phone: $('#phone').val(),
                        mac_address: macAddress
                    },
                    success: function(response) {
                        if (response.success) {
                            showAlert('New verification code sent to your phone', 'success');
                        } else {
                            showAlert(response.message || 'Failed to resend verification code', 'danger');
                        }
                        $link.text(originalText).css('pointer-events', 'auto');
                    },
                    error: function(xhr) {
                        let errorMessage = 'Failed to resend verification code';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert(errorMessage, 'danger');
                        $link.text(originalText).css('pointer-events', 'auto');
                    }
                });
            });
            
            // Function to start the timer
            function startTimer() {
                // Clear any existing interval
                if (timerInterval) {
                    clearInterval(timerInterval);
                }
                
                updateTimerDisplay();
                
                timerInterval = setInterval(function() {
                    secondsRemaining--;
                    
                    if (secondsRemaining <= 0) {
                        clearInterval(timerInterval);
                        $('#timer-text').hide();
                        $('#resend-container').show();
                    } else {
                        updateTimerDisplay();
                    }
                }, 1000);
            }
            
            // Function to update the timer display
            function updateTimerDisplay() {
                const minutes = Math.floor(secondsRemaining / 60);
                const seconds = secondsRemaining % 60;
                $('#timer').text(`${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`);
            }
            
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
            
            // Function to apply design settings
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
                
                // Set welcome message from full design data, fallback to settings
                const welcomeMessage = design.welcome_message || settings.welcome_message;
                if (welcomeMessage) {
                    $('#welcome-text').text(welcomeMessage);
                    
                    // Add login instructions if available
                    const loginInstructions = design.login_instructions || 'Please enter your phone number to receive a verification code.';
                    if (loginInstructions) {
                        $('#welcome-text').append(`<p class="mt-2">${loginInstructions}</p>`);
                    }
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
            
            // Helper function to get parameter from URL path
            function getPathParameter(param) {
                const pathParts = window.location.pathname.split('/');
                
                if (param === 'location') {
                    // Assuming URL pattern like /sms-login/{location}/{mac_address}
                    return pathParts[2] || '';
                } else if (param === 'mac_address') {
                    // Assuming URL pattern like /sms-login/{location}/{mac_address}
                    return pathParts[3] || '';
                }
                
                return '';
            }
            
            // If location_id or mac_address is missing, show error
            if (!locationId || !macAddress) {
                $('.portal-container').html(`
                    <div class="text-center">
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error</h4>
                            <p>Required information is missing. Please check your connection or contact support.</p>
                        </div>
                    </div>
                `);
            }
            
            // Get location information
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
        });
    </script>
</body>
</html>