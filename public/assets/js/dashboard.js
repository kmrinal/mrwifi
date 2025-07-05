/**
 * Dashboard JavaScript for dynamic data loading
 * Uses JWT authentication for API calls
 */

let dashboardData = {
    overview: null,
    analytics: null
};

// Global variable to store the map instance
let networkMap = null;

// Global variable to store all locations for filtering
let allLocations = [];

// Current location filter state
let currentLocationFilter = 'all';

/**
 * Load dashboard overview data
 */
function loadDashboardOverview() {
    const token = UserManager.getToken();
    
    if (!token) {
        console.error('No authentication token found');
        return;
    }
    
    // Show loading indicators
    showOverviewLoading(true);
    
    $.ajax({
        url: '/api/dashboard/overview',
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                dashboardData.overview = response.data;
                updateOverviewDisplay(response.data);
                updateLocationCards(response.data.locations.data);
            } else {
                console.error('Failed to load dashboard overview:', response.message);
                showOverviewError();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading dashboard overview:', error);
            showOverviewError();
        },
        complete: function() {
            showOverviewLoading(false);
        }
    });
}

/**
 * Load analytics data
 * @param {string} period - Period for analytics (1, 7, 30, 90 days)
 */
function loadAnalytics(period = '7') {
    const token = UserManager.getToken();
    
    if (!token) {
        console.error('No authentication token found');
        return;
    }
    
    // Show loading indicators
    showAnalyticsLoading(true);
    
    $.ajax({
        url: '/api/dashboard/analytics',
        method: 'GET',
        data: { period: period },
        headers: {
            'Authorization': 'Bearer ' + token,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                dashboardData.analytics = response.data;
                updateAnalyticsDisplay(response.data);
            } else {
                console.error('Failed to load analytics:', response.message);
                showAnalyticsError();
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading analytics:', error);
            showAnalyticsError();
        },
        complete: function() {
            showAnalyticsLoading(false);
        }
    });
}

/**
 * Initialize network map with real location data
 * @param {Array} locations - Array of location data with coordinates
 */
function initializeNetworkMap(locations) {
    // Check if Leaflet is loaded and map container exists
    if (typeof L === 'undefined' || !document.getElementById('network-map')) {
        console.warn('Leaflet not loaded or map container not found');
        return;
    }
    
    // Hide loading indicator
    const loadingElement = document.getElementById('map-loading');
    if (loadingElement) {
        loadingElement.style.display = 'none';
    }
    
    // Clear existing map if it exists
    if (networkMap) {
        networkMap.remove();
        networkMap = null;
    }
    
    // Filter locations that have coordinates
    const locationsWithCoords = locations.filter(location => 
        location.latitude && location.longitude && 
        !isNaN(parseFloat(location.latitude)) && 
        !isNaN(parseFloat(location.longitude))
    );
    
    if (locationsWithCoords.length === 0) {
        // No locations with coordinates, show message
        document.getElementById('network-map').innerHTML = 
            '<div class="d-flex align-items-center justify-content-center h-100">' +
            '<div class="text-center">' +
            '<i data-feather="map-pin" class="font-large-1 text-muted mb-1"></i>' +
            '<p class="text-muted">No locations with coordinates found</p>' +
            '</div></div>';
        
        // Re-initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace({ width: 14, height: 14 });
        }
        return;
    }
    
    // Initialize the map with a default view (will be adjusted after adding markers)
    networkMap = L.map('network-map').setView([0, 0], 2);
    
    // Add tile layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(networkMap);
    
    // Define marker icons - Green for online, Red for offline
    const onlineIcon = L.divIcon({
        className: 'marker-icon marker-icon-online',
        html: '<div style="background-color:#00C851; width: 14px; height: 14px; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.4);"></div>',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    });
    
    const offlineIcon = L.divIcon({
        className: 'marker-icon marker-icon-offline',
        html: '<div style="background-color:#FF3547; width: 14px; height: 14px; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.4);"></div>',
        iconSize: [20, 20],
        iconAnchor: [10, 10]
    });
    
    // Create array to store all markers for bounds calculation
    const markers = [];
    
    // Add markers for each location with coordinates
    locationsWithCoords.forEach(function(location) {
        const lat = parseFloat(location.latitude);
        const lng = parseFloat(location.longitude);
        
        // Choose icon based on online status - Green for online, Red for offline
        const icon = location.online_status === 'online' ? onlineIcon : offlineIcon;
        
        // Debug logging
        console.log(`Location: ${location.name}, Status: ${location.online_status}, Icon: ${location.online_status === 'online' ? 'Green' : 'Red'}`);
        
        // Create marker
        const marker = L.marker([lat, lng], { icon: icon }).addTo(networkMap);
        markers.push(marker);
        
        // Create popup content with location details
        const statusColor = location.online_status === 'online' ? 'success' : 'danger';
        const statusText = location.online_status === 'online' ? 'Online' : 'Offline';
        
        const popupContent = `
            <div class="p-2" style="min-width: 200px;">
                <h6 class="mb-1">${location.name}</h6>
                <p class="mb-1 small text-muted">${location.address || 'No address available'}</p>
                <div class="row mt-2 mb-2">
                    <div class="col-12">
                        <span class="badge badge-${statusColor} badge-pill">${statusText}</span>
                    </div>
                </div>
                <div class="row small">
                    <div class="col-6">
                        <i class="fas fa-users text-info mr-1"></i>
                        ${location.users || 0} Users
                    </div>
                    <div class="col-6">
                        <i class="fas fa-download text-warning mr-1"></i>
                        ${(location.data_usage_gb || 0).toFixed(1)}GB
                    </div>
                </div>
                <div class="mt-2">
                    <a href="/locations/${location.id}" class="btn btn-sm btn-primary btn-block">
                        View Details
                    </a>
                </div>
            </div>
        `;
        
        marker.bindPopup(popupContent);
    });
    
    // Auto-fit map to show all markers with proper bounds
    if (markers.length === 1) {
        // Single location: center on it with reasonable zoom
        const singleMarker = markers[0];
        const latLng = singleMarker.getLatLng();
        networkMap.setView([latLng.lat, latLng.lng], 13);
    } else if (markers.length > 1) {
        // Multiple locations: fit bounds to show all markers
        const group = new L.featureGroup(markers);
        const bounds = group.getBounds();
        networkMap.fitBounds(bounds, {
            padding: [20, 20], // Add padding around the bounds
            maxZoom: 15 // Prevent zooming in too much
        });
    }
    
    console.log(`Network map initialized with ${locationsWithCoords.length} location markers`);
}

/**
 * Update overview display with real data
 * @param {Object} data - Overview data from API
 */
function updateOverviewDisplay(data) {
    const locations = data.locations;
    const networkStats = data.network_stats;
    
    // Update welcome card
    $('#welcome-total-locations').text(locations.total + ' Location' + (locations.total !== 1 ? 's' : ''));
    $('#welcome-active-count').text(locations.online);
    $('#welcome-offline-count').text(locations.offline);
    
    // Update network statistics
    $('#routers-online-count').text(networkStats.routers_online + '/' + networkStats.routers_total);
    $('#active-users-count').text(networkStats.active_users.toLocaleString());
    $('#data-used-count').text(networkStats.data_used_tb + 'TB');
    $('#uptime-percentage').text(networkStats.uptime_percentage + '%');
    
    // Update network health chart values
    updateNetworkHealthChart(networkStats.uptime_percentage);
    
    // Initialize network map with real location data
    initializeNetworkMap(locations.data);
    
    console.log('Dashboard overview updated successfully');
}

/**
 * Update analytics display with real data
 * @param {Object} data - Analytics data from API
 */
function updateAnalyticsDisplay(data) {
    const analytics = data.analytics;
    
    // Update analytics metrics
    $('#analytics-total-users').text(analytics.total_users.toLocaleString());
    $('#analytics-data-usage').text(analytics.data_usage_gb + ' GB');
    $('#analytics-uptime').text(analytics.uptime + '%');
    $('#analytics-sessions').text(analytics.total_sessions.toLocaleString());
    
    console.log('Analytics updated for period:', data.period + ' days');
}

/**
 * Update location cards with real data
 * @param {Array} locations - Array of location data
 */
function updateLocationCards(locations) {
    // Store all locations for filtering
    allLocations = locations;
    
    // Apply current filter
    renderLocationCards();
}

/**
 * Filter locations based on current filter
 * @param {string} filter - Filter type: 'all', 'online', 'offline'
 */
function filterLocations(filter) {
    currentLocationFilter = filter;
    
    // Update dropdown text
    let filterText = 'All Locations';
    switch(filter) {
        case 'online':
            filterText = 'Online Only';
            break;
        case 'offline':
            filterText = 'Offline Only';
            break;
    }
    $('#locationDropdown').text(filterText);
    
    // Re-render cards with filter
    renderLocationCards();
}

/**
 * Render location cards based on current filter
 */
function renderLocationCards() {
    const $container = $('#locations-container');
    
    if (!$container.length) {
        console.warn('Location cards container not found');
        return;
    }
    
    // Clear existing cards
    $container.empty();
    
    // Filter locations based on current filter
    let filteredLocations = allLocations;
    
    if (currentLocationFilter === 'online') {
        filteredLocations = allLocations.filter(location => location.online_status === 'online');
    } else if (currentLocationFilter === 'offline') {
        filteredLocations = allLocations.filter(location => location.online_status === 'offline');
    }
    
    // Show message if no locations match filter
    if (filteredLocations.length === 0) {
        let message = 'No locations found';
        if (currentLocationFilter === 'online') {
            message = 'No online locations found';
        } else if (currentLocationFilter === 'offline') {
            message = 'No offline locations found';
        }
        
        $container.html(`
            <div class="col-12">
                <div class="text-center py-4">
                    <i data-feather="map-pin" class="font-large-1 text-muted mb-2"></i>
                    <p class="text-muted">${message}</p>
                </div>
            </div>
        `);
        
        // Re-initialize feather icons
        if (typeof feather !== 'undefined') {
            feather.replace({ width: 14, height: 14 });
        }
        return;
    }
    
    // Create cards for filtered locations
    filteredLocations.forEach(function(location, index) {
        if (index >= 6) return; // Limit to 6 cards for dashboard
        
        const statusClass = location.online_status === 'online' ? 'badge-light-success' : 'badge-light-danger';
        const statusText = location.online_status === 'online' ? 'Online' : 'Offline';
        
        const cardHtml = `
            <div class="col-md-6 col-lg-4 mb-2">
                <div class="card shadow-none border">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-light-primary p-50 mr-1">
                                    <div class="avatar-content">
                                        <i data-feather="map-pin" class="font-medium-4"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">${location.name}</h5>
                                    <small class="text-muted">${location.address || 'No address'}</small>
                                </div>
                            </div>
                            <span class="badge badge-pill ${statusClass}">${statusText}</span>
                        </div>
                        
                        <div class="row mt-1">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i data-feather="users" class="text-info mr-1" style="width: 14px; height: 14px;"></i>
                                    <small>${location.users} Users</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <i data-feather="download" class="text-warning mr-1" style="width: 14px; height: 14px;"></i>
                                    <small>${location.data_usage_gb.toFixed(2)}GB Used</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="d-flex align-items-center">
                                <i data-feather="hard-drive" class="text-primary mr-1" style="width: 14px; height: 14px;"></i>
                                <small>Router ${statusText}</small>
                            </div>
                            <a href="/location-details-v2/${location.id}" class="btn btn-sm btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $container.append(cardHtml);
    });
    
    // Re-initialize feather icons for new cards
    if (typeof feather !== 'undefined') {
        feather.replace({
            width: 14,
            height: 14
        });
    }
}

/**
 * Update network health chart
 * @param {number} uptimePercentage - Uptime percentage
 */
function updateNetworkHealthChart(uptimePercentage) {
    // Update the radial chart if it exists
    $('#network-health-uptime').text(uptimePercentage + '%');
    
    // Update the overall uptime display
    $('.network-uptime-display').text(uptimePercentage + '%');
}

/**
 * Show/hide loading indicators for overview section
 * @param {boolean} show - Whether to show loading
 */
function showOverviewLoading(show) {
    if (show) {
        $('#welcome-card .card-body').append('<div class="overview-loading text-center"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></div>');
        $('#network-stats .card-body').append('<div class="overview-loading text-center"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></div>');
    } else {
        $('.overview-loading').remove();
    }
}

/**
 * Show/hide loading indicators for analytics section
 * @param {boolean} show - Whether to show loading
 */
function showAnalyticsLoading(show) {
    if (show) {
        $('#analytics-section .card-body').append('<div class="analytics-loading text-center"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></div>');
    } else {
        $('.analytics-loading').remove();
    }
}

/**
 * Show error message for overview section
 */
function showOverviewError() {
    const errorHtml = '<div class="alert alert-danger alert-dismissible mt-2" role="alert"><i data-feather="alert-triangle" class="mr-50"></i>Failed to load dashboard data. Please refresh the page.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    $('#dashboard-errors').html(errorHtml);
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
}

/**
 * Show error message for analytics section
 */
function showAnalyticsError() {
    const errorHtml = '<div class="alert alert-warning alert-dismissible mt-2" role="alert"><i data-feather="alert-circle" class="mr-50"></i>Failed to load analytics data.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    $('#analytics-errors').html(errorHtml);
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
}

/**
 * Initialize dashboard
 */
function initializeDashboard() {
    console.log('Initializing dashboard...');
    
    // Check authentication
    const user = UserManager.getUser();
    const token = UserManager.getToken();
    
    if (!token || !user) {
        console.error('User not authenticated');
        window.location.href = '/';
        return;
    }
    
    // Load initial data
    loadDashboardOverview();
    loadAnalytics('7'); // Default to 7 days
    
    // Set up event listeners
    setupEventListeners();
    
    console.log('Dashboard initialized successfully');
}

/**
 * Set up event listeners
 */
function setupEventListeners() {
    // Analytics period dropdown
    $(document).on('click', '[data-analytics-period]', function(e) {
        e.preventDefault();
        const period = $(this).data('analytics-period');
        loadAnalytics(period);
        
        // Update dropdown text
        const periodText = $(this).text();
        $(this).closest('.dropdown').find('.dropdown-toggle').text(periodText);
    });
    
    // Location filter dropdown
    $(document).on('click', '[data-location-filter]', function(e) {
        e.preventDefault();
        const filterType = $(this).data('location-filter');
        
        // Apply filter
        filterLocations(filterType);
    });
    
    // Refresh button (if exists)
    $(document).on('click', '[data-action="refresh-dashboard"]', function(e) {
        e.preventDefault();
        loadDashboardOverview();
        loadAnalytics('7');
    });
}

// Initialize when document is ready
$(document).ready(function() {
    initializeDashboard();
}); 