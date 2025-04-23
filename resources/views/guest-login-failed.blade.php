<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WiFi Login Failed</title>
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

        .error-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            max-width: 420px;
            width: 100%;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            margin: 0 auto;
            text-align: center;
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

        .error-icon {
            font-size: 64px;
            color: #ea5455;
            margin: 16px 0;
        }

        .error-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }

        .error-message {
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

        .action-button {
            background-color: var(--theme-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            margin: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .action-button:hover {
            background-color: var(--theme-color-dark);
            color: white;
            text-decoration: none;
        }

        .action-button.secondary {
            background-color: #6c757d;
        }

        .action-button.secondary:hover {
            background-color: #5a6268;
        }

        .buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 1rem;
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

        @media (max-width: 576px) {
            .error-container {
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
    <div class="error-container">
        <!-- Header with Location Logo -->
        <div class="text-center">
            <div class="location-logo mx-auto" id="location-logo">
                <div style="background: #f0f0f0; width: 100%; height: 100%; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #666;">
                    Location Logo
                </div>
            </div>
        </div>
        
        <div class="error-icon">
            <i class="fa fa-times-circle"></i>
        </div>
        <h1 class="error-title">Connection Failed</h1>
        <p class="error-message" id="error-message">We couldn't connect you to the WiFi network. This might be due to authentication issues or network problems.</p>
        
        <div id="error-details" class="error-details" style="display: none;">
            <div id="error-detail-message">No specific error details available.</div>
        </div>
        
        <div class="buttons">
            <a href="#" id="try-again-btn" class="action-button">
                <i class="fa fa-refresh"></i> Try Again
            </a>
            <!-- <a href="#" id="show-details-btn" class="action-button secondary">
                <i class="fa fa-info-circle"></i> Show Details
            </a> -->
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
                        By accessing this WiFi service, you agree to comply with all applicable laws and the network's acceptable use policy.
                        We reserve the right to monitor traffic and content accessed through our network, and to terminate access for violations of these terms.
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
                        We collect limited information when you use our WiFi service, including device identifiers, connection times, and usage data.
                        This information is used to improve our service, troubleshoot technical issues, and comply with legal requirements.
                        We do not sell your personal information to third parties.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/app-assets/vendors/js/jquery/jquery.min.js"></script>
    <script src="/app-assets/vendors/js/bootstrap/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Get location data from localStorage
            const locationData = JSON.parse(localStorage.getItem('location_data') || '{}');
            const designData = locationData.design || {};
            var ip_address;

            // Get $_GET['uamip']
            ip_address = '{{ $_GET['uamip'] }}';
            var try_again_btn = 'http://' + ip_address + ':3990/prelogin';
            $('#try-again-btn').attr('href', try_again_btn);
            
            console.log('Location data:', locationData);
            console.log('Design data:', designData);
            
            // Apply design settings
            applyDesignSettings(locationData.settings || {}, designData);
            
            // Get error message from localStorage if available
            const errorMessage = localStorage.getItem('login_error') || 'No specific error details available.';
            $('#error-detail-message').text(errorMessage);
            
            // Toggle error details visibility
            $('#show-details-btn').on('click', function(e) {
                e.preventDefault();
                
                const $errorDetails = $('#error-details');
                const $detailsBtn = $(this);
                
                // if ($errorDetails.is(':visible')) {
                //     $errorDetails.slideUp();
                //     $detailsBtn.html('<i class="fa fa-info-circle"></i> Show Details');
                // } else {
                //     $errorDetails.slideDown();
                //     $detailsBtn.html('<i class="fa fa-times-circle"></i> Hide Details');
                // }
            });
            
            // Check if there's a redirect URL in localStorage for the "Try Again" button
            // const loginUrl = localStorage.getItem('login_url') || '/';
            // $('#try-again-btn').attr('href', loginUrl);
            
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
                
                // Set custom error message if available
                if (design.error_message) {
                    $('#error-message').text(design.error_message);
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
        });
    </script>
</body>
</html> 