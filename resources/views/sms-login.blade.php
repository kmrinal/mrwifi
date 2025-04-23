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

        .input-group-text {
            display: flex;
            align-items: center;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 8px 0 0 8px;
            padding: 12px;
            font-weight: 500;
            color: #495057;
        }

        .input-group .form-control {
            border-radius: 0 8px 8px 0;
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
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="border-top-right-radius: 0; border-bottom-right-radius: 0; padding: 0.375rem 0.75rem;">
                                <img src="https://flagcdn.com/w20/fr.png" style="margin-right: 5px; height: 15px;" alt="French flag"> +33
                            </span>
                        </div>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                        <input type="hidden" id="full-phone" name="full-phone" value="">
                    </div>
                </div>
                <button type="submit" class="login-button" id="request-otp-button">Send Verification Code</button>
            </form>
        </div>

        <!-- OTP Verification Form -->
        <div id="otp-form" class="otp-container">
            <form id="verify-otp-form">
                <div class="form-group">
                    <label for="otp-1">Verification Code</label>
                    <div class="d-flex justify-content-between">
                        <input type="text" class="form-control text-center otp-input" style="width: 22%; margin-right: 4%;" id="otp-1" name="otp-1" maxlength="1" required>
                        <input type="text" class="form-control text-center otp-input" style="width: 22%; margin-right: 4%;" id="otp-2" name="otp-2" maxlength="1" required>
                        <input type="text" class="form-control text-center otp-input" style="width: 22%; margin-right: 4%;" id="otp-3" name="otp-3" maxlength="1" required>
                        <input type="text" class="form-control text-center otp-input" style="width: 22%;" id="otp-4" name="otp-4" maxlength="1" required>
                    </div>
                    <input type="hidden" id="otp" name="otp" value="">
                </div>
                <div class="resend-container">
                    <span id="timer-text">Request OTP again in <span id="timer">05:00</span></span>
                    <div id="resend-container" style="display: none;">
                        <span>Didn't receive code? <a class="resend-link" id="resend-link">Resend</a></span>
                    </div>
                </div>
                <button type="submit" class="login-button" id="verify-otp-button"></button>
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

    <!-- Modals for Terms and Privacy -->
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms of Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="terms-content">
                        
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="privacyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacyModalLabel">Privacy Policy</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="privacy-content">
                        
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
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
            $('#terms-content').html(designData.terms_content);
            $('#privacy-content').html(designData.privacy_content);
            var button_text = designData.button_text || 'Connect to WiFi';
            $('#verify-otp-button').text(button_text);
            // Get URL parameters (for mac address, etc.)
            const urlParams = new URLSearchParams(window.location.search);
            const macAddress = urlParams.get('mac') || getPathParameter('mac_address');
            const locationId = getPathParameter('location');
            
            // Apply design settings
            applyDesignSettings(locationSettings, designData);
            
            let timerInterval;
            let secondsRemaining = 10; // 30 seconds
            
            // Track SMS send attempts - limit to 5 total (initial + 4 resends)
            let smsSendCount = 0;
            const MAX_SMS_SENDS = 5;
            
            // Handle OTP input functionality
            $('.otp-input').on('input', function() {
                if ($(this).val().length === 1) {
                    // Move focus to next input
                    $(this).next('.otp-input').focus();
                }
                
                // Combine all inputs into the hidden field
                combineOtpValues();
            });
            
            // Handle backspace in OTP inputs
            $('.otp-input').on('keydown', function(e) {
                // If backspace is pressed and the field is empty
                if (e.keyCode === 8 && $(this).val() === '') {
                    // Focus on the previous input
                    $(this).prev('.otp-input').focus();
                }
            });
            
            // Function to combine OTP values
            function combineOtpValues() {
                const otp1 = $('#otp-1').val();
                const otp2 = $('#otp-2').val();
                const otp3 = $('#otp-3').val();
                const otp4 = $('#otp-4').val();
                
                // Combine the values
                const otpValue = otp1 + otp2 + otp3 + otp4;
                
                // Set the hidden field value
                $('#otp').val(otpValue);
            }
            
            // Handle phone number submission
            $('#phone-form').on('submit', function(e) {
                e.preventDefault();
                
                let phoneNumber = $('#phone').val().trim();
                if (!phoneNumber) {
                    showAlert('Please enter a valid phone number', 'danger');
                    return;
                }
                
                // Check if we've reached the maximum SMS limit
                if (smsSendCount >= MAX_SMS_SENDS) {
                    showAlert('Maximum SMS send limit reached (5). Please try again later.', 'warning');
                    return;
                }
                
                // Remove any spaces, dashes, or parentheses
                phoneNumber = phoneNumber.replace(/[\s\-\(\)]/g, '');
                
                // Remove leading zero if present
                if (phoneNumber.startsWith('0')) {
                    phoneNumber = phoneNumber.substring(1);
                }
                
                // Format the full phone number with country code
                const fullPhoneNumber = '+33' + phoneNumber;
                $('#full-phone').val(fullPhoneNumber);
                
                console.log('Submitting phone number:', fullPhoneNumber);
                
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
                        phone: fullPhoneNumber,
                        mac_address: macAddress
                    },
                    success: function(response) {
                        console.log('OTP request response:', response);
                        if (response.success) {
                            // Increment SMS send count
                            smsSendCount++;
                            console.log(`SMS sent ${smsSendCount} of ${MAX_SMS_SENDS} allowed`);
                            
                            // Show OTP form
                            $('#phone-form').hide();
                            // Make the otp inputs empty and fous on first one
                            $('#otp-1').val('');
                            $('#otp-2').val('');
                            $('#otp-3').val('');
                            $('#otp-4').val('');
                            $('#otp-1').focus();
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
                const ipAddress = localStorage.getItem('nas_ip');
                console.log('IP address:', ipAddress);
                console.log('location_data:', location_data);
                if (!otp || otp.length !== 4) {
                    showAlert('Please enter a valid 4-digit verification code', 'danger');
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
                    phone: $('#full-phone').val(),
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
                        var orginal_button_color = $button.css('background-color');
                        if (response.success) {
                            // Stop the timer
                            clearInterval(timerInterval);
                            
                            // Show first success message part on button
                            $button.removeClass('btn-primary').addClass('btn-success')
                                .html('Verified Successfully! <i class="fa fa-check"></i>')
                                .prop('disabled', true);
                            
                            // Show alert for confirmation
                            // showAlert('Authentication successful. Connecting to WiFi...', 'success');
                            
                            // After a short delay, show the second part of the message
                            setTimeout(function() {
                                $button.html('Connecting to WiFi... <i class="fa fa-wifi"></i>');
                                
                                // Redirect to success page or Internet after a further delay
                                setTimeout(function() {
                                    const redirectUrl = response.login_url;
                                    window.location.href = redirectUrl;
                                }, 1500);
                            }, 1500);
                        } else {
                            // Show first error part on button
                            $button.removeClass('btn-primary').addClass('btn-danger')
                                .html('Verification Failed')
                                .prop('disabled', false);
                                
                            // Show alert with error details
                            // showAlert(response.message || 'Failed to verify code', 'danger');
                            
                            // After a short delay, show the second part of the error message
                            setTimeout(function() {
                                $button.html(button_text).removeClass('btn-danger').css('background-color', orginal_button_color);
                            }, 1500);
                        }
                    },
                    error: function(xhr) {
                        // Show first error part on button
                        $button.removeClass('btn-primary').addClass('btn-danger')
                            .html('<i class="fa fa-exclamation-circle"></i> Verification Failed')
                            .prop('disabled', false);
                        
                        // Show error alert
                        let errorMessage = 'Failed to verify code';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        // showAlert(errorMessage, 'danger');
                        
                        // After a short delay, show the second part of the error message
                        setTimeout(function() {
                            $button.html(button_text).removeClass('btn-danger').css('background-color', orginal_button_color);
                        }, 1500);
                    }
                });
            });
            
            // Handle resend OTP
            $('#resend-link').on('click', function() {
                // Check if we've reached the maximum SMS limit
                if (smsSendCount >= MAX_SMS_SENDS) {
                    showAlert('Maximum SMS send limit reached (5). Please try again later.', 'warning');
                    return;
                }
                
                // Reset timer
                secondsRemaining = 10;
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
                        phone: $('#full-phone').val(),
                        mac_address: macAddress
                    },
                    success: function(response) {
                        // Always restore link text, regardless of response
                        $link.text(originalText).css('pointer-events', 'auto');
                        
                        if (response.success) {
                            // Increment SMS send count
                            smsSendCount++;
                            console.log(`SMS sent ${smsSendCount} of ${MAX_SMS_SENDS} allowed`);
                            
                            let successMessage = 'New verification code sent to your phone';
                            
                            // If this is the last allowed attempt, inform the user
                            if (smsSendCount >= MAX_SMS_SENDS) {
                                successMessage += ' (final attempt - limit reached)';
                                // Disable the resend link permanently
                                $('#resend-link').addClass('disabled').css({
                                    'color': '#999',
                                    'text-decoration': 'none',
                                    'cursor': 'not-allowed'
                                });
                            }
                            
                            showAlert(successMessage, 'success');
                        } else {
                            let errorMessage = 'Failed to resend verification code';
                            if (response.message) {
                                errorMessage = response.message;
                            }
                            showAlert(errorMessage, 'danger');
                        }
                    },
                    error: function(xhr) {
                        // Restore the link text and enable it even when error occurs
                        $link.text(originalText).css('pointer-events', 'auto');
                        
                        let errorMessage = 'Failed to resend verification code';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        showAlert(errorMessage, 'danger');
                    },
                    complete: function() {
                        // As an extra safeguard, ensure the link is restored in the complete callback
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
                    $('#terms-text').html('By connecting, you agree to our <a href="#" data-toggle="modal" data-target="#termsModal">Terms of Service</a> and <a href="#" data-toggle="modal" data-target="#privacyModal">Privacy Policy</a>');
                }
                
                // Set custom terms and privacy content if available
                if (design.terms_of_service) {
                    $('#terms-content').html(design.terms_of_service);
                }
                
                if (design.privacy_policy) {
                    $('#privacy-content').html(design.privacy_policy);
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