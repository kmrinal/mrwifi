$(document).ready(function() {
    // Get the location_id and mac_address from URL path segments
    // URL format: /click-login/{location_id}/{mac_address}
    let locationId, macAddress;
    
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
        
        // Get CSRF token
        const csrfToken = $('input[name="_token"]').val();
        
        // Create data object for login
        const loginData = {
            location_id: locationId,
            mac_address: macAddress,
            login_method: 'click-through'
        };
        
        console.log('Login data:', loginData);
        
        // Make API call to login endpoint using jQuery AJAX
        $.ajax({
            url: '/api/captive-portal/login',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            contentType: 'application/json',
            data: JSON.stringify(loginData),
            success: function(data) {
                console.log('Login response:', data);
                
                if (data.success) {
                    // If login successful
                    $loginButton.text('Connected!')
                        .removeClass('btn-primary')
                        .addClass('btn-success');
                    
                    // Check if there's a redirect URL in location settings
                    $.ajax({
                        url: `/api/guest-network/info/${locationId}`,
                        type: 'GET',
                        data: { mac_address: macAddress },
                        headers: { 
                            'Accept': 'application/json' 
                        },
                        success: function(locationData) {
                            if (locationData.success && 
                                locationData.location && 
                                locationData.location.settings && 
                                locationData.location.settings.redirect_url) {
                                
                                // Redirect after successful login
                                setTimeout(function() {
                                    window.location.href = locationData.location.settings.redirect_url;
                                }, 1500);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching location info:', error);
                        }
                    });
                } else {
                    // If login failed
                    $loginButton.text('Connection Failed')
                        .removeClass('btn-primary')
                        .addClass('btn-danger');
                    
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

    // Get location information
    $.ajax({
        url: `/api/captive-portal/${locationId}/info`,
        type: 'GET',
        data: { mac_address: macAddress },
        headers: { 'Accept': 'application/json' },
        success: function(locationData) {
            console.log('Location data:', locationData);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching location info:', error);
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
    