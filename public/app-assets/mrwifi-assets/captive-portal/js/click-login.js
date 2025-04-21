$(document).ready(function() {
    // Get the location_id and mac_address from URL path segments
    // URL format: /click-login/{location_id}/{mac_address}
    let locationId, macAddress;
    let locationData = JSON.parse(localStorage.getItem('location_data') || '{}');
    let designData = JSON.parse(localStorage.getItem('design_data'));

    console.log('locationData', locationData);
    console.log('designData', designData);
    
    // Parse URL path
    const pathSegments = window.location.pathname.split('/').filter(segment => segment.length > 0);
    if (pathSegments.length >= 3 && pathSegments[0] === 'click-login') {
        locationId = pathSegments[1];
        macAddress = pathSegments[2];
    } else {
        // Fallback to URL parameters if path format doesn't match
        const urlParams = new URLSearchParams(window.location.search);
        locationId = urlParams.get('location_id');
        macAddress = urlParams.get('mac_address');
    }
    
    // Function to handle the login process
    function handleLogin(e) {
        if (e) {
            e.preventDefault();
        }
        
        // Show loading state on button
        const $loginButton = $('.login-button');
        const originalButtonText = $loginButton.text();
        $loginButton.text('Connecting...').prop('disabled', true);
        
        const challenge = localStorage.getItem('challenge');
        const locationDataObj = JSON.parse(localStorage.getItem('location_data') || '{}');
        const ipAddress = locationDataObj.ip_address;
        
        // Create data object for login
        const loginData = {
            location_id: locationId,
            mac_address: macAddress,
            login_method: 'click-through',
            challenge: challenge,
            ip_address: ipAddress
        };
        
        console.log('Login data:', loginData);
        
        // Make API call to login endpoint using jQuery AJAX
        $.ajax({
            url: '/api/guest/login',
            type: 'POST',
            data: loginData,
            success: function(data) {
                console.log('Login response:', data);
                
                if (data.success) {
                    // If login successful
                    $loginButton.text('Connected!')
                        .removeClass('btn-primary')
                        .addClass('btn-success');
                    
                    // Show success message
                    showAlert('Successfully connected to WiFi', 'success');
                    
                    // Redirect to login URL after delay
                    setTimeout(function() {
                        const redirectUrl = data.login_url;
                        window.location.href = redirectUrl;
                    }, 2000);
                } else {
                    // If login failed
                    $loginButton.text('Login Failed')
                        .removeClass('btn-primary')
                        .addClass('btn-danger');
                    
                    // Show error message
                    showAlert(data.message || 'Failed to connect to WiFi', 'danger');
                    
                    // Reset button after delay
                    setTimeout(function() {
                        $loginButton.text(originalButtonText)
                            .removeClass('btn-danger')
                            .addClass('btn-primary')
                            .prop('disabled', false);
                    }, 3000);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error during login:', error);
                
                $('.login-button').text('Connection Error')
                    .removeClass('btn-primary')
                    .addClass('btn-danger');
                
                // Show error message
                let errorMessage = 'Error connecting to WiFi';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showAlert(errorMessage, 'danger');
                
                // Reset button after delay
                setTimeout(function() {
                    $('.login-button').text(originalButtonText)
                        .removeClass('btn-danger')
                        .addClass('btn-primary')
                        .prop('disabled', false);
                }, 3000);
            }
        });
    }
    
    // Function to show alerts
    function showAlert(message, type) {
        // Check if alert container exists, if not create it
        if ($('#alert-container').length === 0) {
            $('<div id="alert-container" style="margin-bottom: 20px;"></div>').insertBefore('#login-form');
        }
        
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

    // Get location information including challenge and IP address
    $.ajax({
        url: `/api/captive-portal/${locationId}/info`,
        type: 'GET',
        data: { mac_address: macAddress },
        headers: { 'Accept': 'application/json' },
        success: function(locationInfo) {
            console.log('Location info:', locationInfo);
            
            // Store location data and challenge in localStorage
            if (locationInfo.success && locationInfo.location) {
                localStorage.setItem('location_data', JSON.stringify(locationInfo.location));
                localStorage.setItem('challenge', locationInfo.location.challenge);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching location info:', error);
            showAlert('Error loading WiFi information. Please refresh the page.', 'danger');
        }
    });
    
    // Add event listeners using jQuery
    $('form').on('submit', handleLogin);
    $('.login-button').on('click', handleLogin);
    
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
});
    