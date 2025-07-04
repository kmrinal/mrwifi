<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="monsieur-wifi cloud controller dashboard for managing and monitoring WiFi networks.">
    <meta name="keywords" content="wifi, cloud controller, network management, monsieur-wifi">
    <meta name="author" content="monsieur-wifi">
    <title>Location Details - monsieur-wifi Controller</title>
    <link rel="apple-touch-icon" href="/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/app-assets/mrwifi-assets/MrWifi.png">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/extensions/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/vendors/css/maps/leaflet.min.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/maps/map-leaflet.css">
    <link rel="stylesheet" type="text/css" href="/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <!-- END: Custom CSS-->

    <style>
        /* Modern Status Badges */
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-online {
            background: linear-gradient(45deg, #28c76f, #48da89);
            color: white;
            box-shadow: 0 2px 8px rgba(40, 199, 111, 0.3);
        }
        
        .status-offline {
            background: linear-gradient(45deg, #ea5455, #ff6b6b);
            color: white;
            box-shadow: 0 2px 8px rgba(234, 84, 85, 0.3);
        }
        
        .status-warning {
            background: linear-gradient(45deg, #ff9f43, #ffb976);
            color: white;
            box-shadow: 0 2px 8px rgba(255, 159, 67, 0.3);
        }
        
        /* Enhanced Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            background: #fff;
        }
        
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            border-radius: 12px 12px 0 0 !important;
            padding: 1.5rem;
        }
        
        .card-title {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0;
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Modern Navigation Tabs */
        .nav-tabs {
            border: none;
            background: #f8f9fa;
            border-radius: 12px;
            padding: 8px;
            margin-bottom: 2rem;
        }
        
        .nav-tabs .nav-item {
            margin-bottom: 0;
        }
        
        .nav-tabs .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-right: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .nav-tabs .nav-link:hover {
            background: rgba(115, 103, 240, 0.1);
            color: #7367f0;
            transform: translateY(-1px);
        }
        
        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #7367f0 0%, #9c88ff 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(115, 103, 240, 0.3);
        }
        
        /* Enhanced Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 12px;
            padding: 1.5rem;
            border-left: 4px solid #7367f0;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Form Improvements */
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #7367f0;
            box-shadow: 0 0 0 0.2rem rgba(115, 103, 240, 0.15);
        }
        
        .form-group label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        /* Button Enhancements */
        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #7367f0 0%, #9c88ff 100%);
            box-shadow: 0 4px 15px rgba(115, 103, 240, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(115, 103, 240, 0.4);
        }
        
        .btn-outline-primary {
            border: 2px solid #7367f0;
            color: #7367f0;
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: #7367f0;
            color: white;
            transform: translateY(-1px);
        }
        
        /* Network Interface Cards */
        .network-interface-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .interface-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .interface-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .interface-header {
            background: linear-gradient(135deg, #7367f0 0%, #9c88ff 100%);
            color: white;
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .interface-body {
            padding: 1.5rem;
        }
        
        .interface-detail {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .interface-detail:last-child {
            border-bottom: none;
        }
        
        .interface-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .interface-value {
            color: #2c3e50;
            font-weight: 600;
        }
        
        /* Content Sections */
        .content-section {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
        }
        
        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f1f3f4;
        }
        
        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #2c3e50;
            margin: 0;
        }
        
        /* Location Map */
        .location-map {
            height: 280px;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
        }
        
        /* Responsive Grid */
        .responsive-grid {
            display: grid;
            gap: 1.5rem;
        }
        
        @media (min-width: 768px) {
            .responsive-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1200px) {
            .responsive-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        /* Modal Improvements */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }
        
        .modal-header {
            background: linear-gradient(135deg, #7367f0 0%, #9c88ff 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 1.5rem 2rem;
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        .modal-footer {
            border-top: 1px solid #e9ecef;
            padding: 1.5rem 2rem;
        }
        
        /* Progress Indicators */
        .progress {
            height: 8px;
            border-radius: 4px;
            background: #f1f3f4;
        }
        
        .progress-bar {
            border-radius: 4px;
        }
        
        /* Timeline Improvements */
        .timeline {
            position: relative;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 6px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .timeline-point-indicator {
            position: absolute;
            left: -6px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #e9ecef;
            border: 2px solid #fff;
            z-index: 1;
        }
        
        .timeline-point-primary {
            background: #7367f0 !important;
        }
        
        /* Alert Improvements */
        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.5rem;
        }
        
        .alert-info {
            background: linear-gradient(135deg, rgba(115, 103, 240, 0.1) 0%, rgba(156, 136, 255, 0.1) 100%);
            color: #7367f0;
        }
        
        .alert-warning {
            background: linear-gradient(135deg, rgba(255, 159, 67, 0.1) 0%, rgba(255, 185, 118, 0.1) 100%);
            color: #ff9f43;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(40, 199, 111, 0.1) 0%, rgba(72, 218, 137, 0.1) 100%);
            color: #28c76f;
        }
        
        /* Utility Classes */
        .text-gradient {
            background: linear-gradient(135deg, #7367f0 0%, #9c88ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .shadow-soft {
            box-shadow: 0 2px 20px rgba(0,0,0,0.08) !important;
        }
        
        .border-radius-lg {
            border-radius: 12px !important;
        }
        
        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(-10px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>

    <!-- Add this right after the existing styles and before closing the head tag -->
    <style>
        /* Collapsible section styles */
        .collapsible-header {
            cursor: pointer;
            padding: 1rem;
            background-color: #f8f8f8;
            border-radius: 5px;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .collapsible-header:hover {
            background-color: #eee;
        }

        .collapsible-header h5 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .collapsible-content {
            display: none;
            padding: 1rem;
            border-left: 3px solid #7367f0;
            margin-left: 0.5rem;
            margin-bottom: 1.5rem;
            background-color: #fcfcfc;
            border-radius: 0 5px 5px 0;
        }

        /* Card content grouping */
        .card-group-title {
            font-weight: 600;
            color: #5e5873;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Tab organization improvements */
        .config-section {
            margin-bottom: 1.5rem;
        }

        /* Compact form elements */
        .form-compact .form-group {
            margin-bottom: 0.75rem;
        }

        /* Improved navigation */
        .tab-navigation {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .nav-tab-action {
            flex: 1;
            padding: 0.75rem;
            text-align: center;
            background-color: #f8f8f8;
            border-radius: 5px;
            margin: 0 0.5rem 0.5rem 0;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .nav-tab-action:hover, .nav-tab-action.active {
            background-color: #7367f0;
            color: white;
        }

        /* Better switch status indicators */
        .switch-label {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Summary views */
        .summary-view {
            padding: 1rem;
            background-color: #f8f8f8;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .summary-label {
            color: #6e6b7b;
        }

        .summary-value {
            font-weight: 500;
        }

        /* Improved social media options */
        #social-settings {
            background-color: #f8f8f8;
            border-radius: 5px;
            padding: 1rem;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
            border-left: 3px solid #7367f0;
        }
    </style>

    <!-- Add this CSS right after the existing styles and before closing the head tag -->
    <style>
        /* Enhanced Channel Scanning Modal Styles */
        .scan-pulse-container {
            position: relative;
            width: 80px;
            height: 80px;
            margin: 0 auto;
        }
        
        .scan-pulse-dot {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background-color: #7367f0;
            border-radius: 50%;
            z-index: 2;
        }
        
        .scan-pulse-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 40px;
            height: 40px;
            border: 3px solid #7367f0;
            border-radius: 50%;
            opacity: 1;
            z-index: 1;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                width: 30px;
                height: 30px;
                opacity: 1;
            }
            100% {
                width: 80px;
                height: 80px;
                opacity: 0;
            }
        }
        
        /* Timeline styling for scan steps */
        .timeline {
            padding-left: 0;
            list-style: none;
            margin-bottom: 0;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 0.85rem;
        }
        
        .timeline-item:last-child {
            margin-bottom: 0;
        }
        
        .timeline-point {
            position: absolute;
            left: 0;
            top: 0;
        }
        
        .timeline-point-indicator {
            display: inline-block;
            height: 12px;
            width: 12px;
            border-radius: 50%;
            background-color: #ebe9f1;
        }
        
        .timeline-point-primary {
            background-color: #7367f0 !important;
        }
        
        .timeline-point-secondary {
            background-color: #82868b !important;
        }
        
        .timeline-point-success {
            background-color: #28c76f !important;
        }
        
        /* Channel recommendation cards */
        .channel-recommendation {
            padding: 1rem;
            background-color: #f8f8f8;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #7367f0;
        }
        
        .channel-value {
            font-size: 2rem;
            font-weight: 600;
            color: #5e5873;
        }
        
        .interference-meter {
            height: 6px;
            background-color: #eee;
            border-radius: 3px;
            overflow: hidden;
            margin-top: 4px;
        }
        
        .interference-level {
            height: 100%;
            border-radius: 3px;
            background-color: #28c76f;
        }
        
        .interference-low {
            background-color: #28c76f;
            width: 20%;
        }
        
        .interference-medium {
            background-color: #ff9f43;
            width: 50%;
        }
        
        .interference-high {
            background-color: #ea5455;
            width: 80%;
        }

        .pppoe_display {
            display: none;
        }

        .static_ip_display {
            display: none;
        }

        /* Dark mode fixes for wizard/stepper text */
        .dark-layout .text-muted {
            color: #b4b7bd !important;
        }

        .dark-layout .timeline-event h6 {
            color: #d0d2d6 !important;
        }

        .dark-layout .timeline-event p {
            color: #b4b7bd !important;
        }

        .dark-layout .channel-value {
            color: #d0d2d6 !important;
        }

        .dark-layout .card .card-title {
            color: #d0d2d6 !important;
        }

        .dark-layout .card .card-text {
            color: #b4b7bd !important;
        }

        .dark-layout .channel-recommendation {
            background-color: #2c2c2c !important;
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .text-muted {
            color: #b4b7bd !important;
        }

        .semi-dark-layout .timeline-event h6 {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .timeline-event p {
            color: #b4b7bd !important;
        }

        .semi-dark-layout .channel-value {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .card .card-title {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .card .card-text {
            color: #b4b7bd !important;
        }

        .semi-dark-layout .channel-recommendation {
            background-color: #2c2c2c !important;
            color: #d0d2d6 !important;
        }

        /* Dark mode fixes for tab navigation and form text */
        .dark-layout .nav-tabs {
            background-color: #283046 !important;
        }

        .dark-layout .nav-tabs .nav-link {
            color: #b4b7bd !important;
        }

        .dark-layout .nav-tabs .nav-link:hover {
            background-color: rgba(115, 103, 240, 0.2) !important;
            color: #d0d2d6 !important;
        }

        .dark-layout .nav-tabs .nav-link.active {
            color: #ffffff !important;
        }

        .dark-layout .form-group label {
            color: #d0d2d6 !important;
        }

        .dark-layout .interface-label {
            color: #b4b7bd !important;
        }

        .dark-layout .interface-value {
            color: #d0d2d6 !important;
        }

        .dark-layout .section-title {
            color: #d0d2d6 !important;
        }

        .dark-layout .card-title {
            color: #d0d2d6 !important;
        }

        .dark-layout h4, .dark-layout h5, .dark-layout h6 {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .nav-tabs {
            background-color: #283046 !important;
        }

        .semi-dark-layout .nav-tabs .nav-link {
            color: #b4b7bd !important;
        }

        .semi-dark-layout .nav-tabs .nav-link:hover {
            background-color: rgba(115, 103, 240, 0.2) !important;
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .nav-tabs .nav-link.active {
            color: #ffffff !important;
        }

        .semi-dark-layout .form-group label {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .interface-label {
            color: #b4b7bd !important;
        }

        .semi-dark-layout .interface-value {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .section-title {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .card-title {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout h4, .semi-dark-layout h5, .semi-dark-layout h6 {
            color: #d0d2d6 !important;
        }

        /* Dark mode fixes for card headers */
        .dark-layout .card-header {
            background: linear-gradient(135deg, #283046 0%, #2c2c2c 100%) !important;
            border-bottom: 1px solid rgba(180, 183, 189, 0.3) !important;
        }

        .dark-layout .card-header h4, 
        .dark-layout .card-header h5, 
        .dark-layout .card-header h6,
        .dark-layout .card-header .card-title {
            color: #d0d2d6 !important;
        }

        .dark-layout .card-header .btn {
            color: #b4b7bd !important;
            border-color: #b4b7bd !important;
        }

        .dark-layout .card-header .btn:hover {
            color: #ffffff !important;
            background-color: #7367f0 !important;
            border-color: #7367f0 !important;
        }

        .semi-dark-layout .card-header {
            background: linear-gradient(135deg, #283046 0%, #2c2c2c 100%) !important;
            border-bottom: 1px solid rgba(180, 183, 189, 0.3) !important;
        }

        .semi-dark-layout .card-header h4, 
        .semi-dark-layout .card-header h5, 
        .semi-dark-layout .card-header h6,
        .semi-dark-layout .card-header .card-title {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .card-header .btn {
            color: #b4b7bd !important;
            border-color: #b4b7bd !important;
        }

        .semi-dark-layout .card-header .btn:hover {
            color: #ffffff !important;
            background-color: #7367f0 !important;
            border-color: #7367f0 !important;
        }

        /* Dark mode fixes for Router Settings tab specific elements */
        .dark-layout .stat-label {
            color: #b4b7bd !important;
        }

        .dark-layout .stat-value {
            color: #d0d2d6 !important;
        }

        .dark-layout .content-section {
            background-color: #283046 !important;
            border: 1px solid #3b4253 !important;
        }

        .dark-layout .section-header {
            border-bottom-color: #3b4253 !important;
        }

        .dark-layout .alert {
            background-color: #2c2c2c !important;
            border-color: #3b4253 !important;
            color: #d0d2d6 !important;
        }

        .dark-layout .alert .alert-body {
            color: #d0d2d6 !important;
        }

        .dark-layout .custom-control-label {
            color: #d0d2d6 !important;
        }

        .dark-layout .custom-control-label::before {
            background-color: #3b4253 !important;
            border-color: #3b4253 !important;
        }

        .dark-layout small, .dark-layout .small {
            color: #b4b7bd !important;
        }

        .dark-layout .form-control {
            background-color: #3b4253 !important;
            border-color: #3b4253 !important;
            color: #d0d2d6 !important;
        }

        .dark-layout .form-control:focus {
            background-color: #3b4253 !important;
            border-color: #7367f0 !important;
            color: #d0d2d6 !important;
        }

        .dark-layout .form-control option {
            background-color: #3b4253 !important;
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .stat-label {
            color: #b4b7bd !important;
        }

        .semi-dark-layout .stat-value {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .content-section {
            background-color: #283046 !important;
            border: 1px solid #3b4253 !important;
        }

        .semi-dark-layout .section-header {
            border-bottom-color: #3b4253 !important;
        }

        .semi-dark-layout .alert {
            background-color: #2c2c2c !important;
            border-color: #3b4253 !important;
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .alert .alert-body {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .custom-control-label {
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .custom-control-label::before {
            background-color: #3b4253 !important;
            border-color: #3b4253 !important;
        }

        .semi-dark-layout small, .semi-dark-layout .small {
            color: #b4b7bd !important;
        }

        .semi-dark-layout .form-control {
            background-color: #3b4253 !important;
            border-color: #3b4253 !important;
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .form-control:focus {
            background-color: #3b4253 !important;
            border-color: #7367f0 !important;
            color: #d0d2d6 !important;
        }

        .semi-dark-layout .form-control option {
            background-color: #3b4253 !important;
            color: #d0d2d6 !important;
        }
    </style>

    <!-- Add this right before the closing body tag -->
    <style>
        /* Fix for oscillating progress bar */
        #channel-scan-modal .progress-bar {
            transition: width 0.5s linear;
        }
        
        /* Fix for modal close icon */
        #channel-scan-modal .modal-header .close {
            color: #fff;
            text-shadow: none;
            opacity: 0.8;
            padding: 1rem;
            margin: -1rem;
        }
        
        #channel-scan-modal .modal-header .close:hover {
            opacity: 1;
        }
        
        /* Ensure feather icon in close button is visible */
        #channel-scan-modal .modal-header .close span {
            font-size: 1.5rem;
            display: block;
            line-height: 1;
        }
        
        /* Improve modal header icon alignment */
        #channel-scan-modal .modal-title i {
            vertical-align: middle;
            margin-top: -3px;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static menu-collapsed" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <!-- Language dropdown -->
                <li class="nav-item dropdown dropdown-language">
                    <a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-us"></i>
                        <span class="selected-language">English</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag">
                        <a class="dropdown-item" href="javascript:void(0);" data-language="en">
                            <i class="flag-icon flag-icon-us"></i> English
                        </a>
                        <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
                            <i class="flag-icon flag-icon-fr"></i> French
                        </a>
                    </div>
                </li>
                <!-- Dark mode toggle -->
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link nav-link-style">
                        <i class="ficon" data-feather="moon"></i>
                    </a>
                </li>
                <!-- Notifications -->
                <li class="nav-item dropdown dropdown-notification mr-25">
                    <a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
                        <i class="ficon" data-feather="bell"></i>
                        <span class="badge badge-pill badge-primary badge-up">5</span>
                    </a>
                    <!-- Notification dropdown content -->
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <!-- Notification content here -->
                        </ul>
                    </li>
                
                <!-- User dropdown -->
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"></span><span class="user-status"></span></div><span class="avatar"><img class="round" src="app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="/profile"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="dashboard.html">
                        <span class="brand-logo">
                            <img src="../../../app-assets/mrwifi-assets/Mr-Wifi.PNG" alt="monsieur-wifi logo">
                        </span>
                        <h2 class="brand-text">monsieur-wifi</h2>
                    </a>
                </li>
                <li class="nav-item nav-toggle">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                        <i class="d-none d-xl-block collapse-toggle-icon font-medium-4 text-primary" data-feather="disc" data-ticon="disc"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="shadow-bottom"></div>

        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- Management Section -->
                <li class="navigation-header"><span>Management</span></li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="/dashboard">
                        <i data-feather="home"></i>
                        <span class="menu-title text-truncate">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="d-flex align-items-center" href="/locations">
                        <i data-feather="map-pin"></i>
                        <span class="menu-title text-truncate">Locations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="/analytics">
                        <i data-feather="bar-chart-2"></i>
                        <span class="menu-title text-truncate">Usage Analytics</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="d-flex align-items-center" href="/captive-portals">
                        <i data-feather="layout"></i>
                        <span class="menu-title text-truncate">Captive Portals</span>
                    </a>
                </li>

                <!-- For Admin Section -->
                <li class="navigation-header"><span>For Admin</span></li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="/accounts">
                        <i data-feather="users"></i>
                        <span class="menu-title text-truncate">Accounts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="/domain-blocking">
                        <i data-feather="slash"></i>
                        <span class="menu-title text-truncate">Domain Blocking</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="/firmware">
                        <i data-feather="download"></i>
                        <span class="menu-title text-truncate">Firmware</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="/system-settings">
                        <i data-feather="settings"></i>
                        <span class="menu-title text-truncate">System Settings</span>
                    </a>
                </li>
                <!-- Account Section -->
                <li class="navigation-header"><span>Account</span></li>
                <li class="nav-item">
                     <a class="d-flex align-items-center" href="/profile">
                         <i data-feather="user"></i>
                         <span class="menu-title text-truncate">Profile</span>
                     </a>
                </li>
                <li class="nav-item">
                     <a class="d-flex align-items-center" href="/logout">
                         <i data-feather="power"></i>
                         <span class="menu-title text-truncate">Logout</span>
                     </a>
                </li> 
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Location Details</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="locations.html">Locations</a></li>
                                <li class="breadcrumb-item active"><span class="location_name"></span></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="location-analytics.html" class="btn btn-primary">Analytics</a>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Location Overview -->
                <div class="stats-grid">
                    <!-- Location Info Card -->
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h4 class="text-gradient mb-1"><span class="location_name"></span></h4>
                                <p class="text-muted mb-0"><span class="location_address"></span></p>
                            </div>
                            <span class="status-badge status-offline">Offline</span>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="interface-detail">
                                    <span class="interface-label">Router Model</span>
                                    <span class="interface-value router_model_updated"></span>
                                </div>
                                <div class="interface-detail">
                                    <span class="interface-label">Firmware</span>
                                    <span class="interface-value router_firmware"></span>
                                </div>
                                <div class="interface-detail">
                                    <span class="interface-label">Total Users</span>
                                    <span class="interface-value connected_users"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="interface-detail">
                                    <span class="interface-label">Daily Usage</span>
                                    <span class="interface-value daily_usage"></span>
                                </div>
                                <div class="interface-detail">
                                    <span class="interface-label">Uptime</span>
                                    <span class="interface-value uptime"></span>
                                </div>
                                <!-- <div class="interface-detail">
                                    <span class="interface-label">Reboot Count</span>
                                    <span class="interface-value reboot_count">0</span>
                                </div> -->
                            </div>
                        </div>
                        
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn btn-primary btn-sm flex-fill" id="device-restart-btn">
                                <i data-feather="refresh-cw" class="mr-1"></i>
                                Restart
                            </button>
                            <button class="btn btn-outline-primary btn-sm flex-fill" id="update-firmware-btn">
                                <i data-feather="download" class="mr-1"></i>
                                Update
                            </button>
                        </div>
                    </div>

                    <!-- Usage Stats Grid -->
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Current Usage</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" id="usage-period-btn">
                                    Today
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" id="usage-period-dropdown">
                                    <a class="dropdown-item" href="javascript:void(0);" data-period="today">Today</a>
                                    <a class="dropdown-item" href="javascript:void(0);" data-period="7days">Last 7 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);" data-period="30days">Last 30 Days</a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Loading Indicator -->
                        <div id="usage-loading" class="text-center py-3" style="display: none;">
                            <div class="spinner-border spinner-border-sm text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <small class="d-block mt-2 text-muted">Loading usage data...</small>
                        </div>
                        
                        <!-- Usage Data -->
                        <div class="row text-center" id="usage-data">
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="stat-value text-primary" id="download-usage">
                                        <i class="fas fa-spinner fa-spin" style="font-size: 1rem;"></i>
                                    </div>
                                    <div class="stat-label">Download</div>
                                </div>
                                <div>
                                    <div class="stat-value text-info" id="connected-users">
                                        <i class="fas fa-spinner fa-spin" style="font-size: 1rem;"></i>
                                    </div>
                                    <div class="stat-label">Users / Sessions</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <div class="stat-value text-success" id="upload-usage">
                                        <i class="fas fa-spinner fa-spin" style="font-size: 1rem;"></i>
                                    </div>
                                    <div class="stat-label">Upload</div>
                                </div>
                                <div>
                                    <div class="stat-value text-warning" id="avg-session-time">
                                        <i class="fas fa-spinner fa-spin" style="font-size: 1rem;"></i>
                                    </div>
                                    <div class="stat-label">Avg. Session</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Last Updated -->
                        <div class="text-center mt-3">
                            <small class="text-muted" id="usage-last-updated">
                                Loading data...
                            </small>
                        </div>
                    </div>

                    <!-- Location Map Card -->
                    <div class="stat-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0">Location</h5>
                            <small class="text-muted" id="map-coordinates" style="display: none;"></small>
                        </div>
                        <div id="location-map" class="location-map"></div>
                    </div>
                </div>

            <!-- Network Configuration Tabs -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Network Configuration</h4>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="location-settings-tab" data-toggle="tab" href="#location-settings" role="tab" aria-controls="location-settings" aria-selected="false">
                                        <i class="fas fa-building mr-2"></i>Location Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="router-tab" data-toggle="tab" href="#router" aria-controls="router" role="tab" aria-selected="true">
                                        <i data-feather="hard-drive" class="mr-50"></i>Router Settings
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="captive-portal-tab" data-toggle="tab" href="#captive-portal" aria-controls="captive-portal" role="tab" aria-selected="false">
                                        <i data-feather="layout" class="mr-50"></i>Captive Portal WiFi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="secured-wifi-tab" data-toggle="tab" href="#secured-wifi" aria-controls="secured-wifi" role="tab" aria-selected="false">
                                        <i data-feather="lock" class="mr-50"></i>Password WiFi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="connected-users-tab" data-toggle="tab" href="#connected-users" aria-controls="connected-users" role="tab" aria-selected="false">
                                        <i data-feather="users" class="mr-50"></i>Total Users
                                    </a>
                                </li>
                                <!-- Add to your tab navigation -->
                               
                            </ul>
                            <div class="tab-content">
                                <!-- Location Details Tab -->
                                <div class="tab-pane active show" id="location-settings" role="tabpanel" aria-labelledby="location-settings-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Location Information</h4>
                                        </div>
                                        <div class="card-body">
                                            <form id="location-info-form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location-name">Location Name</label>
                                                            <input type="text" class="form-control" id="location-name" placeholder="Enter location name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location-address">Address</label>
                                                            <input type="text" class="form-control" id="location-address" placeholder="Street address">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location-city">City</label>
                                                            <input type="text" class="form-control" id="location-city" placeholder="City">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location-state">State/Province</label>
                                                            <input type="text" class="form-control" id="location-state" placeholder="State/Province">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location-postal-code">Postal Code</label>
                                                            <input type="text" class="form-control" id="location-postal-code" placeholder="Postal code">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location-country">Country</label>
                                                            <input type="text" class="form-control" id="location-country" placeholder="Country">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="router-model-select">Router Model</label>
                                                            <select class="form-control" id="router-model-select">
                                                                <option value="">Select Router Model</option>
                                                                <option value="820AX">820AX</option>
                                                                <option value="835AX">835AX</option>
                                                            </select>
                                                            <small class="text-muted">Choose the router model installed at this location.</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location-manager">Manager Name</label>
                                                            <input type="text" class="form-control" id="location-manager" placeholder="Manager name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location-contact-email">Contact Email</label>
                                                            <input type="email" class="form-control" id="location-contact-email" placeholder="Contact email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location-contact-phone">Contact Phone</label>
                                                            <input type="text" class="form-control" id="location-contact-phone" placeholder="Contact phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="location-status">Status</label>
                                                            <select class="form-control" id="location-status">
                                                                <option value="active">Active</option>
                                                                <option value="inactive">Inactive</option>
                                                                <option value="maintenance">Maintenance</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location-description">Description</label>
                                                            <textarea class="form-control" id="location-description" rows="3" placeholder="Location description"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" id="save-location-info" class="btn btn-primary">Save Location Information</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Router Settings Tab -->
                                <div class="tab-pane fade" id="router" aria-labelledby="router-tab" role="tabpanel">
                                    <!-- WAN Configuration Section -->
                                    <div class="content-section">
                                        <div class="section-header d-flex justify-content-between align-items-center">
                                            <h5 class="section-title">WAN Connection</h5>
                                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#wan-settings-modal">
                                                <i data-feather="edit" class="mr-1"></i>Edit WAN Settings
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="interface-detail">
                                                    <span class="interface-label">Connection Type</span>
                                                    <span class="interface-value" id="wan-type-display">DHCP</span>
                                                </div>
                                            </div>
                                            <div class="col-md-9 wan-static-ip-display_div hidden">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">IP Address</span>
                                                            <span class="interface-value" id="wan-ip-display">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Subnet Mask</span>
                                                            <span class="interface-value" id="wan-subnet-display">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Gateway</span>
                                                            <span class="interface-value" id="wan-gateway-display">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Primary DNS</span>
                                                            <span class="interface-value" id="wan-dns1-display">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9 wan-pppoe-display_div hidden">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Username</span>
                                                            <span class="interface-value" id="wan-pppoe-username">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Service Name</span>
                                                            <span class="interface-value" id="wan-pppoe-service-name">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Network Interfaces Section -->
                                    <div class="content-section">
                                        <div class="section-header">
                                            <h5 class="section-title">Local Network Interfaces</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0">Captive Portal Network</h6>
                                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#captive-portal-modal">
                                                            <i data-feather="edit" class="mr-1"></i>Edit
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">IP Address</span>
                                                            <span class="interface-value" id="captive-ip-display">-</span>
                                                        </div>
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Subnet Mask</span>
                                                            <span class="interface-value" id="captive-netmask-display">-</span>
                                                        </div>
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Gateway</span>
                                                            <span class="interface-value" id="captive-gateway-display">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header d-flex justify-content-between align-items-center">
                                                        <h6 class="mb-0">Password WiFi Network</h6>
                                                        <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#password-network-modal">
                                                            <i data-feather="edit" class="mr-1"></i>Edit
                                                        </button>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="interface-detail">
                                                            <span class="interface-label">Connection Type</span>
                                                            <span class="interface-value" id="password-wifi-ip-type-display">Static IP</span>
                                                        </div>
                                                        <div class="hidden password-ip-assignment-display_div">
                                                            <div class="interface-detail">
                                                                <span class="interface-label">IP Address</span>
                                                                <span class="interface-value" id="password-ip-display">-</span>
                                                            </div>
                                                            <div class="interface-detail">
                                                                <span class="interface-label">Subnet Mask</span>
                                                                <span class="interface-value" id="password-netmask-display">-</span>
                                                            </div>
                                                            <div class="interface-detail">
                                                                <span class="interface-label">Gateway</span>
                                                                <span class="interface-value" id="password-gateway-display">-</span>
                                                            </div>
                                                            <div class="interface-detail">
                                                                <span class="interface-label">DHCP Server</span>
                                                                <span class="interface-value" id="password-dhcp-status-display">-</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- WiFi Radio & Channel Configuration -->
                                    <div class="content-section">
                                        <div class="section-header">
                                            <h5 class="section-title">WiFi Radio & Channel Configuration</h5>
                                        </div>
                                        <div class="row">
                                            <!-- Radio & Power Settings -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="wifi-country">Country/Region</label>
                                                    <select class="form-control" id="wifi-country">
                                                        <option value="US" selected>United States (US)</option>
                                                        <option value="CA">Canada (CA)</option>
                                                        <option value="GB">United Kingdom (GB)</option>
                                                        <option value="FR">France (FR)</option>
                                                        <option value="DE">Germany (DE)</option>
                                                        <option value="IT">Italy (IT)</option>
                                                        <option value="ES">Spain (ES)</option>
                                                        <option value="AU">Australia (AU)</option>
                                                        <option value="JP">Japan (JP)</option>
                                                        <option value="CN">China (CN)</option>
                                                        <option value="IN">India (IN)</option>
                                                        <option value="BR">Brazil (BR)</option>
                                                        <option value="ZA">South Africa (ZA)</option>
                                                        <option value="AE">United Arab Emirates (AE)</option>
                                                        <option value="SG">Singapore (SG)</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="power-level-2g">2.4 GHz Power</label>
                                                    <select class="form-control" id="power-level-2g">
                                                        <option value="20">Maximum (20 dBm)</option>
                                                        <option value="17">High (17 dBm)</option>
                                                        <option value="15" selected>Medium (15 dBm)</option>
                                                        <option value="12">Low (12 dBm)</option>
                                                        <option value="10">Minimum (10 dBm)</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="power-level-5g">5 GHz Power</label>
                                                    <select class="form-control" id="power-level-5g">
                                                        <option value="23">Maximum (23 dBm)</option>
                                                        <option value="20">High (20 dBm)</option>
                                                        <option value="17" selected>Medium (17 dBm)</option>
                                                        <option value="14">Low (14 dBm)</option>
                                                        <option value="10">Minimum (10 dBm)</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Channel Settings -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="channel-width-2g">2.4 GHz Channel Width</label>
                                                    <select class="form-control" id="channel-width-2g">
                                                        <option value="20">20 MHz</option>
                                                        <option value="40" selected>40 MHz</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="channel-width-5g">5 GHz Channel Width</label>
                                                    <select class="form-control" id="channel-width-5g">
                                                        <option value="20">20 MHz</option>
                                                        <option value="40">40 MHz</option>
                                                        <option value="80" selected>80 MHz</option>
                                                        <option value="160">160 MHz</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="channel-2g">2.4 GHz Channel</label>
                                                    <select class="form-control" id="channel-2g">
                                                        <option value="1">Channel 1 (2412 MHz)</option>
                                                        <option value="2">Channel 2 (2417 MHz)</option>
                                                        <option value="3">Channel 3 (2422 MHz)</option>
                                                        <option value="4">Channel 4 (2427 MHz)</option>
                                                        <option value="5">Channel 5 (2432 MHz)</option>
                                                        <option value="6" selected>Channel 6 (2437 MHz)</option>
                                                        <option value="7">Channel 7 (2442 MHz)</option>
                                                        <option value="8">Channel 8 (2447 MHz)</option>
                                                        <option value="9">Channel 9 (2452 MHz)</option>
                                                        <option value="10">Channel 10 (2457 MHz)</option>
                                                        <option value="11">Channel 11 (2462 MHz)</option>
                                                        <option value="12">Channel 12 (2467 MHz)</option>
                                                        <option value="13">Channel 13 (2472 MHz)</option>
                                                        <option value="14">Channel 14 (2484 MHz)</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="channel-5g">5 GHz Channel</label>
                                                    <select class="form-control" id="channel-5g">
                                                        <option value="36" selected>Channel 36 (5180 MHz)</option>
                                                        <option value="40">Channel 40 (5200 MHz)</option>
                                                        <option value="44">Channel 44 (5220 MHz)</option>
                                                        <option value="48">Channel 48 (5240 MHz)</option>
                                                        <option value="52">Channel 52 (5260 MHz)</option>
                                                        <option value="56">Channel 56 (5280 MHz)</option>
                                                        <option value="60">Channel 60 (5300 MHz)</option>
                                                        <option value="64">Channel 64 (5320 MHz)</option>
                                                        <option value="100">Channel 100 (5500 MHz)</option>
                                                        <option value="104">Channel 104 (5520 MHz)</option>
                                                        <option value="108">Channel 108 (5540 MHz)</option>
                                                        <option value="112">Channel 112 (5560 MHz)</option>
                                                        <option value="116">Channel 116 (5580 MHz)</option>
                                                        <option value="120">Channel 120 (5600 MHz)</option>
                                                        <option value="124">Channel 124 (5620 MHz)</option>
                                                        <option value="128">Channel 128 (5640 MHz)</option>
                                                        <option value="132">Channel 132 (5660 MHz)</option>
                                                        <option value="136">Channel 136 (5680 MHz)</option>
                                                        <option value="140">Channel 140 (5700 MHz)</option>
                                                        <option value="149">Channel 149 (5745 MHz)</option>
                                                        <option value="153">Channel 153 (5765 MHz)</option>
                                                        <option value="157">Channel 157 (5785 MHz)</option>
                                                        <option value="161">Channel 161 (5805 MHz)</option>
                                                        <option value="165">Channel 165 (5825 MHz)</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Channel Optimization -->
                                            <div class="col-md-4">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <label class="mb-0">Channel Optimization</label>
                                                    <button class="btn btn-outline-primary btn-sm" id="scan-channels-btn">
                                                        <i data-feather="wifi" class="mr-1"></i>Scan
                                                    </button>
                                                </div>
                                                
                                                <div class="alert alert-info mb-3" id="scan-status-alert">
                                                    <div class="alert-body">
                                                        <i data-feather="info" class="mr-2"></i>
                                                        <span id="scan-status-text">Click Scan to analyze optimal channels.</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="row text-center mb-3">
                                                    <div class="col-6">
                                                        <div class="stat-value text-primary" id="last-optimal-2g">--</div>
                                                        <div class="stat-label">Best 2.4G</div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="stat-value text-success" id="last-optimal-5g">--</div>
                                                        <div class="stat-label">Best 5G</div>
                                                    </div>
                                                </div>
                                                
                                                <div class="text-center mb-2">
                                                    <small class="text-muted" id="last-scan-timestamp">No scan performed yet</small>
                                                </div>
                                                
                                                <button class="btn btn-success btn-block btn-sm" id="save-channels-btn" disabled>
                                                    <i data-feather="check" class="mr-1"></i>Apply Optimal
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center mt-3">
                                            <button class="btn btn-primary" id="save-radio-settings">
                                                <i data-feather="save" class="mr-2"></i>Save All Radio Settings
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Content Filtering Section -->
                                    <div class="content-section">
                                        <div class="section-header d-flex justify-content-between align-items-center">
                                            <h5 class="section-title">Web Content Filtering</h5>
                                            <button class="btn btn-primary" id="save-web-filter-settings">
                                                <i data-feather="save" class="mr-2"></i>Save Web Filter Settings
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="mb-0">Enable Content Filtering</label>
                                                        <div class="custom-control custom-switch custom-control-primary">
                                                            <input type="checkbox" class="custom-control-input" id="global-web-filter">
                                                            <label class="custom-control-label" for="global-web-filter"></label>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted">Apply content filtering to all WiFi networks.</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="global-filter-categories">Block Categories</label>
                                                    <select class="select2 form-control" id="global-filter-categories" multiple="multiple">
                                                        <!-- Categories will be loaded dynamically from API -->
                                                    </select>
                                                    <small class="text-muted">Select content categories to block across all networks.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                    <!-- Simplified Captive Portal WiFi Tab Content -->
                                    <div class="tab-pane fade" id="captive-portal" role="tabpanel" aria-labelledby="captive-portal-tab">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between align-items-center">
                                                    <h4 class="card-title mb-0">Captive Portal WiFi</h4>
                                                    <button class="btn btn-primary save-captive-portal">
                                                        <i data-feather="save" class="mr-1"></i> Save Settings
                                                    </button>
                                                </div>
                                    
                                                <div class="card-body">
                                                    <!-- Basic Settings Section -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="portal-ssid">Network Name (SSID)</label>
                                                                <input type="text" class="form-control" id="captive-portal-ssid" placeholder="Guest WiFi">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="portal-visibility">Network Visibility</label>
                                                                <select class="form-control" id="captive-portal-visible">
                                                                    <option value="1" selected>Visible (Broadcast SSID)</option>
                                                                    <option value="0">Hidden (Don't Broadcast SSID)</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Authentication Section -->
                                                    <h5 class="border-bottom pb-1">Authentication</h5>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="captive-auth-method">Authentication Method</label>
                                                                <select class="form-control" id="captive-auth-method">
                                                                    <option value="click-through" selected>Click-through (No Authentication)</option>
                                                                    <option value="password">Password-based</option>
                                                                    <option value="sms">SMS Verification</option>
                                                                    <option value="email">Email Verification</option>
                                                                    <option value="social">Social Media Login</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group hidden" id="password-auth-options">
                                                                <label for="captive_portal_password">Password</label>
                                                                <div class="input-group">
                                                                    <input type="password" class="form-control form-control-sm" id="captive_portal_password" value="">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary btn-sm" type="button" id="toggle-captive-password">
                                                                            <i data-feather="eye"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group hidden" id="social-auth-options">
                                                                <label for="captive-social-auth-method">Social Media Logins</label>
                                                                <select class="form-control" id="captive-social-auth-method">
                                                                    <option value="facebook">Facebook</option>
                                                                    <option value="google">Google</option>
                                                                </select>
                                                            </div>
                                                    
                                                            <!-- Session Settings -->
                                                            <div class="row">
                                                                <div class="col-6">
                                                                <div class="form-group">
                                                                        <label for="captive-session-timeout">Session (mins)</label>
                                                                        <select class="form-control" id="captive-session-timeout">
                                                                            <option value="60">1 Hr</option>
                                                                            <option value="120">2 Hrs</option>
                                                                            <option value="180">3 Hrs</option>
                                                                            <option value="240">4 Hrs</option>
                                                                            <option value="300">5 Hrs</option>
                                                                            <option value="360">6 Hrs</option>
                                                                            <option value="720">12 Hrs</option>
                                                                            <option value="1440">1 Day</option>
                                                                            <option value="2880">2 Days</option>
                                                                            <option value="4320">3 Days</option>
                                                                            <option value="5760">4 Days</option>
                                                                            <option value="7200">5 Days</option>
                                                                            <option value="8640">6 Days</option>
                                                                            <option value="10080">1 Week</option>
                                                                            <option value="11520">2 Weeks</option>
                                                                            <option value="12960">3 Weeks</option>
                                                                            <option value="14400">1 Month</option>
                                                                            <option value="28800">2 Months</option>
                                                                            <option value="43200">3 Months</option>
                                                                            <option value="57600">4 Months</option>
                                                                            <option value="72000">5 Months</option>
                                                                            <option value="86400">6 Months</option>
                                                                            <option value="100800">7 Months</option>
                                                                            <option value="115200">8 Months</option>
                                                                            <option value="129600">9 Months</option>
                                                                            <option value="144000">10 Months</option>
                                                                            <option value="158400">11 Months</option>
                                                                            <option value="172800">1 Year</option>
                                                                            <option value="345600">2 Years</option>
                                                                            <option value="604800">3 Years</option>
                                                                            <option value="1209600">4 Years</option>
                                                                        </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="captive-idle-timeout">Idle (mins)</label>
                                                                <select class="form-control" id="captive-idle-timeout">
                                                                    <option value="15">15 Mins</option>
                                                                    <option value="30">30 Mins</option>
                                                                    <option value="45">45 Mins</option>
                                                                    <option value="60">1 Hr</option>
                                                                    <option value="120">2 Hrs</option>
                                                                    <option value="180">3 Hrs</option>
                                                                    <option value="240">4 Hrs</option>
                                                                    <option value="360">6 Hrs</option>
                                                                    <option value="720">12 Hrs</option>
                                                                    <option value="1440">1 Day</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- Password Auth Options -->
                                                    <div id="password-auth-options" class="auth-options-section" style="display: none;">
                                                        <div class="form-group">
                                                            <label for="portal-shared-password">Shared Password</label>
                                                            <div class="input-group">
                                                                <input type="password" id="portal-shared-password" class="form-control" placeholder="Enter password">
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-outline-secondary" type="button" id="toggle-portal-password">
                                                                        <i data-feather="eye"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- SMS/Email Auth Options -->
                                            <div id="sms-auth-options" class="auth-options-section" style="display: none;">
                                                <div class="alert alert-info mb-0 p-2">SMS verification will be used to authenticate guests.</div>
                                            </div>

                                            <div id="email-auth-options" class="auth-options-section" style="display: none;">
                                                <div class="alert alert-info mb-0 p-2">Email verification will be used to authenticate guests.</div>
                                            </div>

                                                    <!-- Social Login Options -->
                                                    <div id="social-auth-options" class="auth-options-section" style="display: none;">
                                                        <label>Enable Social Login Options</label>
                                                        <div class="d-flex flex-wrap">
                                                            <div class="custom-control custom-switch custom-control-primary mr-2 mb-1">
                                                                <input type="checkbox" class="custom-control-input" id="social-facebook" checked>
                                                                <label class="custom-control-label" for="social-facebook">Facebook</label>
                                                            </div>
                                                            <div class="custom-control custom-switch custom-control-primary mr-2 mb-1">
                                                                <input type="checkbox" class="custom-control-input" id="social-google" checked>
                                                                <label class="custom-control-label" for="social-google">Google</label>
                                                            </div>
                                                            <div class="custom-control custom-switch custom-control-primary mr-2 mb-1">
                                                                <input type="checkbox" class="custom-control-input" id="social-twitter">
                                                                <label class="custom-control-label" for="social-twitter">Twitter</label>
                                                            </div>
                                                            <div class="custom-control custom-switch custom-control-primary mb-1">
                                                                <input type="checkbox" class="custom-control-input" id="social-apple">
                                                                <label class="custom-control-label" for="social-apple">Apple</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Network Settings Section -->
                                            <!-- <h5 class="border-bottom pb-1 mt-3">Network Settings</h5>
                                                    <div class="row">
                                                <div class="col-md-3">
                                                            <div class="form-group">
                                                        <label for="captive-ip-address">IP Address</label>
                                                        <input type="text" class="form-control" id="captive-ip-address" placeholder="192.168.2.1">
                                                </div>
                                                </div>
                                                <div class="col-md-3">
                                                            <div class="form-group">
                                                        <label for="captive-netmask">Netmask</label>
                                                        <input type="text" class="form-control" id="captive-netmask" placeholder="255.255.255.0">
                                            </div>
                                                </div>
                                                <div class="col-md-6 d-flex align-items-end mb-1">
                                                    <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#captive-network-modal">
                                                        <i data-feather="edit" class="mr-1"></i> Advanced Network Settings
                                                    </button>
                                                </div>
                                            </div> -->
                                            <!-- Bandwidth Section -->
                                            <h5 class="border-bottom pb-1 mt-3">Bandwidth & Portal</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">Bandwidth Limits</label>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                 <label for="captive-download-limit">Download (Mbps)</label>
                                                                <select class="form-control form-control-sm" id="captive-download-limit">
                                                                    <option value="">Select Download Limit</option>
                                                                    <option value="1">1 Mbps</option>
                                                                    <option value="2">2 Mbps</option>
                                                                    <option value="5">5 Mbps</option>
                                                                    <option value="10">10 Mbps</option>
                                                                    <option value="15">15 Mbps</option>
                                                                    <option value="20">20 Mbps</option>
                                                                    <option value="25">25 Mbps</option>
                                                                    <option value="30">30 Mbps</option>
                                                                    <option value="35">35 Mbps</option>
                                                                    <option value="40">40 Mbps</option>
                                                                    <option value="45">45 Mbps</option>
                                                                    <option value="50">50 Mbps</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="captive-upload-limit">Upload (Mbps)</label>
                                                                <select class="form-control form-control-sm" id="captive-upload-limit">
                                                                    <option value="0">Select Upload Limit</option>
                                                                    <option value="1">1 Mbps</option>
                                                                    <option value="2">2 Mbps</option>
                                                                    <option value="5">5 Mbps</option>
                                                                    <option value="10">10 Mbps</option>
                                                                    <option value="15">15 Mbps</option>
                                                                    <option value="20">20 Mbps</option>
                                                                    <option value="25">25 Mbps</option>
                                                                    <option value="30">30 Mbps</option>
                                                                    <option value="35">35 Mbps</option>
                                                                    <option value="40">40 Mbps</option>
                                                                    <option value="45">45 Mbps</option>
                                                                    <option value="50">50 Mbps</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="mb-2">Portal Configuration</label>
                                                        <select class="form-control form-control-sm" id="captive-portal-design">
                                                            <!-- Options will be populated dynamically -->
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Access Control Section -->
                                            <h5 class="border-bottom pb-1 mt-3">Access Control</h5>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <!-- MAC Filtering -->
                                                            <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">MAC Filtering</label>
                                                            <div>
                                                                <select class="form-control form-control-sm" id="portal-mac-filter">
                                                                    <option value="allow-all" selected>Allow All</option>
                                                                    <option value="allow-listed">Allow Listed Only</option>
                                                                    <option value="block-listed">Block Listed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="input-group mb-1">
                                                            <input type="text" class="form-control" id="captive-mac-address" placeholder="00:11:22:33:44:55">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-sm btn-primary" id="captive-add-mac">Add</button>
                                                            </div>
                                                        </div>
                                                        <div class="filtered-mac-list border p-1 rounded" style="max-height: 100px; overflow-y: auto;">
                                                            <!-- MAC addresses will be added here dynamically -->
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                    <!-- Additional Settings -->
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">Guest Network Isolation</label>
                                                            <div class="custom-control custom-switch custom-control-primary">
                                                                <input type="checkbox" class="custom-control-input" id="guest-isolation" checked>
                                                                <label class="custom-control-label" for="guest-isolation"></label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Prevent guests from accessing local network devices.</small>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">Hide Network Name</label>
                                                            <div class="custom-control custom-switch custom-control-primary">
                                                                <input type="checkbox" class="custom-control-input" id="guest-hide-ssid">
                                                                <label class="custom-control-label" for="guest-hide-ssid"></label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Hide the network from WiFi discovery.</small>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>

                                <!-- Simplified Password WiFi Tab Content -->
                                <div class="tab-pane fade" id="secured-wifi" role="tabpanel" aria-labelledby="secured-wifi-tab">
                                            <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h4 class="card-title mb-0">Password WiFi</h4>
                                            <button class="btn btn-primary save-password-network" id="save-secured-wifi">
                                                <i data-feather="save" class="mr-1"></i> Save Settings
                                            </button>
                                            </div>
                                        
                                                <div class="card-body">
                                            <!-- Basic Settings Section -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="wifi-ssid">Network Name (SSID)</label>
                                                        <input type="text" class="form-control" id="password-wifi-ssid" placeholder="Home WiFi">
                                                </div>
                                            </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="password-wifi-password">WiFi Password</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" id="password-wifi-password" placeholder="Password">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button" id="toggle-password">
                                                                    <i data-feather="eye"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="wifi-security">Security Type</label>
                                                        <select class="form-control" id="password-wifi-security">
                                                            <option value="wpa2-psk" selected>WPA2-PSK (Recommended)</option>
                                                            <option value="wpa-wpa2-psk">WPA/WPA2-PSK Mixed</option>
                                                            <option value="wpa3-psk">WPA3-PSK (Most Secure)</option>
                                                            <option value="wep">WEP (Legacy, Not Recommended)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="password_wifi_cipher_suites">Cipher Suites</label>
                                                        <select class="form-control" id="password_wifi_cipher_suites">
                                                            <option value="CCMP" selected>CCMP</option>
                                                            <option value="TKIP">TKIP</option>
                                                            <option value="TKIP+CCMP">TKIP+CCMP</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Network Settings Section -->
                                            <!-- <h5 class="border-bottom pb-1 mt-2">Network Settings</h5>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>IP Configuration</label>
                                                        <div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="static-ip-radio" name="password-ip-assignment" class="custom-control-input" checked>
                                                                <label class="custom-control-label" for="static-ip-radio">Static IP</label>
                                                </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="dhcp-client-radio" name="password-ip-assignment" class="custom-control-input">
                                                                <label class="custom-control-label" for="dhcp-client-radio">DHCP Client</label>
                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="static-ip-field">
                                                        <label for="password-ip-address">IP Address</label>
                                                        <input type="text" class="form-control" id="password-ip-address" placeholder="192.168.1.1">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group" id="static-netmask-field">
                                                        <label for="password-netmask">Netmask</label>
                                                        <input type="text" class="form-control" id="password-netmask" placeholder="255.255.255.0">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d-flex align-items-end mb-1">
                                                    <button class="btn btn-outline-primary btn-sm" id="advanced-network-btn" data-toggle="modal" data-target="#password-network-modal">
                                                        <i data-feather="edit" class="mr-1"></i> Advanced Settings
                                                    </button>
                                        </div>
                                    </div>

                                            <div id="dhcp-client-message" style="display: none;">
                                                <div class="alert alert-info p-2">
                                                    <i data-feather="info" class="mr-1 align-middle"></i>
                                                    <span>In DHCP Client mode, this WiFi interface will request an IP address from an upstream DHCP server.</span>
                                                </div>
                                            </div>
                                             -->
                                            <!-- Access Control Section -->
                                            <h5 class="border-bottom pb-1 mt-3">Access Control</h5>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <!-- MAC Filtering -->
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">MAC Filtering</label>
                                                            <div>
                                                                <select class="form-control form-control-sm" id="secured-mac-filter">
                                                                    <option value="allow-all" selected>Allow All</option>
                                                                    <option value="allow-listed">Allow Listed Only</option>
                                                                    <option value="block-listed">Block Listed</option>
                                                                </select>
                                            </div>
                                                </div>
                                                        <div class="input-group mb-1">
                                                            <input type="text" class="form-control" id="secured-mac-address" placeholder="00:11:22:33:44:55">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-sm btn-primary" id="secured-add-mac">Add</button>
                                            </div>
                                                </div>
                                                        <div class="filtered-mac-list border p-1 rounded" style="max-height: 100px; overflow-y: auto;">
                                                            <!-- MAC addresses will be added here dynamically -->
                                            </div>
                                        </div>
                                                </div>
                                                
                                                <div class="col-lg-6">
                                                    <!-- Network Security Settings -->
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">WPS (WiFi Protected Setup)</label>
                                                            <div class="custom-control custom-switch custom-control-primary">
                                                                <input type="checkbox" class="custom-control-input" id="wps-enabled">
                                                                <label class="custom-control-label" for="wps-enabled"></label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Allow devices to connect using WPS push button.</small>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">Band Steering</label>
                                                            <div class="custom-control custom-switch custom-control-primary">
                                                                <input type="checkbox" class="custom-control-input" id="band-steering" checked>
                                                                <label class="custom-control-label" for="band-steering"></label>
                                                            </div>
                                                        </div>
                                                        <small class="text-muted">Automatically guide devices to the best frequency band.</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- QoS Section -->
                                            <!-- <h5 class="border-bottom pb-1 mt-3">Quality of Service</h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <label class="mb-0">Enable QoS</label>
                                                            <div class="custom-control custom-switch custom-control-primary">
                                                                <input type="checkbox" class="custom-control-input" id="secured-qos">
                                                                <label class="custom-control-label" for="secured-qos"></label>
                                        </div>
                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="secured-priority">Traffic Priority</label>
                                                        <select class="form-control form-control-sm" id="secured-priority">
                                                            <option value="high" selected>High Priority</option>
                                                            <option value="medium">Medium Priority</option>
                                                            <option value="low">Low Priority</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="secured-bandwidth">Reserved Bandwidth (%)</label>
                                                        <input type="number" class="form-control form-control-sm" id="secured-bandwidth" value="70">
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Users Tab -->
                                <div class="tab-pane fade" id="connected-users" aria-labelledby="connected-users-tab" role="tabpanel">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Connected Devices</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>User/Device</th>
                                                                    <th>MAC Address</th>
                                                                    <th>IP Address</th>
                                                                    <th>Network</th>
                                                                    <th>Connected Time</th>
                                                                    <th>Data Usage</th>
                                                                    <th>Signal</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Example Row -->
                                                                <tr>
                                                                    <td>John Doe (iPhone 13)</td>
                                                                    <td>00:1A:2B:3C:4D:5E</td>
                                                                    <td>-</td>
                                                                    <td><span class="badge badge-light-info">Captive Portal</span></td>
                                                                    <td>1h 23m</td>
                                                                    <td>125 MB</td>
                                                                    <td>Excellent (85%)</td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-icon btn-outline-danger">
                                                                            <i data-feather="user-x"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div><!-- End .tab-content -->
                            </div><!-- End .card-body -->
                        </div><!-- End .card -->
                    </div><!-- End .col-12 -->
                </div><!-- End .row -->
            </div><!-- End .content-body -->
        </div><!-- End .content-wrapper -->
    </div><!-- End .content -->
    <!-- END: Content -->

    <!-- BEGIN: Modals -->
    <!-- Enhanced Channel Scan Modal with Results View -->
    <div class="modal fade" id="channel-scan-modal" tabindex="-1" role="dialog" aria-labelledby="channel-scan-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="channel-scan-modal-title">Channel Scan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- Initial view before scan starts -->
                            <div id="pre-scan-view">
                                <div class="alert alert-info">
                                    <div class="alert-body">
                                        <i data-feather="info" class="mr-1 align-middle"></i>
                                        <span>Scanning will analyze nearby WiFi networks and interference to determine optimal channel settings.</span>
                                    </div>
                                </div>
                                
                                <!-- Device and Scan Counter Info -->
                                <div class="card bg-light-primary mb-3">
                                    <div class="card-body p-2">
                                        <div class="row">
                                            <div class="col-6">
                                                <h6 class="mb-1">Device Info</h6>
                                                <p class="mb-0"><strong>Location ID:</strong> <span id="modal-location-id">-</span></p>
                                                <p class="mb-0"><strong>Device ID:</strong> <span id="modal-device-id">-</span></p>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="mb-1">Scan Counter</h6>
                                                <p class="mb-0"><strong>Current Counter:</strong> <span id="modal-scan-counter">-</span></p>
                                                <p class="mb-0"><strong>Next Scan ID:</strong> <span id="modal-next-scan-id">-</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h6>Last Scan Results:</h6>
                                        <ul class="list-group mb-2">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>2.4 GHz Best Channel</span>
                                                <span class="badge badge-primary" id="last-best-channel-2g">Channel 6</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>5 GHz Best Channel</span>
                                                <span class="badge badge-primary" id="last-best-channel-5g">Channel 36</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>Scan Time</span>
                                                <span id="last-scan-time">2023-11-05 14:22</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <h6>Nearby Networks:</h6>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>2.4 GHz</span>
                                                <span class="badge badge-light" id="nearby-networks-2g">8 networks</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>5 GHz</span>
                                                <span class="badge badge-light" id="nearby-networks-5g">4 networks</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center mt-2">
                                    <button class="btn btn-primary" id="start-scan-btn">
                                        <i data-feather="refresh-cw" class="mr-1"></i> Start New Channel Scan
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Scan in progress view -->
                            <div id="scan-in-progress-view" style="display: none;">
                                <div class="alert alert-warning">
                                    <div class="alert-body">
                                        <i data-feather="clock" class="mr-1 align-middle"></i>
                                        <span>Scanning for available WiFi channels and detecting interference. This may take a minute...</span>
                                    </div>
                                </div>
                                
                                <!-- Current Scan Info -->
                                <div class="card bg-light-warning mb-2">
                                    <div class="card-body p-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-0">Current Scan</h6>
                                                <small class="text-muted">Use this scan ID for curl testing</small>
                                            </div>
                                            <div class="text-right">
                                                <h4 class="mb-0 text-warning">ID: <span id="current-scan-id">-</span></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="progress progress-bar-primary mb-2">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                </div>
                                
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-point-indicator" id="step-initiated-indicator"></div>
                                        <div class="timeline-event">
                                            <div class="d-flex justify-content-between">
                                                <h6>Scan Initiated</h6>
                                                <span class="text-muted">Step 1/4</span>
                                            </div>
                                            <p>Preparing device for channel scanning</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-point-indicator" id="step-started-indicator"></div>
                                        <div class="timeline-event">
                                            <div class="d-flex justify-content-between">
                                                <h6>Scan Started</h6>
                                                <span class="text-muted">Step 2/4</span>
                                            </div>
                                            <p>Device is ready and beginning frequency analysis</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-point-indicator" id="step-2g-indicator"></div>
                                        <div class="timeline-event">
                                            <div class="d-flex justify-content-between">
                                                <h6>Scanning 2.4 GHz Band</h6>
                                                <span class="text-muted">Step 3/4</span>
                                            </div>
                                            <p>Checking channels 1-11 for signal strength and interference</p>
                                        </div>
                                    </div>
                                    <div class="timeline-item">
                                        <div class="timeline-point-indicator" id="step-5g-indicator"></div>
                                        <div class="timeline-event">
                                            <div class="d-flex justify-content-between">
                                                <h6>Scanning 5 GHz Band</h6>
                                                <span class="text-muted">Step 4/4</span>
                                            </div>
                                            <p>Checking channels 36-165 for signal strength and interference</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Scan results view -->
                            <div id="scan-results-view" style="display: none;">
                                <div class="alert alert-success mb-2">
                                    <div class="alert-body">
                                        <i data-feather="check-circle" class="mr-1 align-middle"></i>
                                        <span>Scan complete! Optimal channels have been determined based on current RF environment.</span>
                                    </div>
                                </div>
                                
                                <div class="row mb-2">
                                    <div class="col-md-6 col-12">
                                        <div class="card bg-light-primary mb-0">
                                            <div class="card-body">
                                                <h5 class="card-title">2.4 GHz Results</h5>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>Recommended Channel:</span>
                                                    <h3 class="mb-0" id="result-channel-2g">6</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-12">
                                        <div class="card bg-light-primary mb-0">
                                            <div class="card-body">
                                                <h5 class="card-title">5 GHz Results</h5>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span>Recommended Channel:</span>
                                                    <h3 class="mb-0" id="result-channel-5g">36</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Nearby Networks</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover" id="nearby-networks-table">
                                    <thead>
                                        <tr>
                                            <th>Band</th>
                                            <th>Channel</th>
                                            <th>Networks</th>
                                            <th>Signal Strength</th>
                                            <th>Interference</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="nearby-networks-tbody">
                                        <!-- Dynamic content will be populated here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                                
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between">
                                        <button class="btn btn-primary" id="apply-scan-results">
                                            <i data-feather="check" class="mr-1"></i> Apply These Settings
                                        </button>
                                        <button class="btn btn-outline-primary" id="back-to-scan-btn">
                                            <i data-feather="refresh-cw" class="mr-1"></i> Run Another Scan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Portal Management Modal -->
    <div class="modal fade" id="portal-management-modal" tabindex="-1" role="dialog" aria-labelledby="portal-management-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="portal-management-modal-title">Captive Portal Management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-pills mb-2">
                        <li class="nav-item">
                            <a class="nav-link active" id="html-pill" data-toggle="pill" href="#html-editor" aria-expanded="true">HTML</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="css-pill" data-toggle="pill" href="#css-editor" aria-expanded="false">CSS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="js-pill" data-toggle="pill" href="#js-editor" aria-expanded="false">JavaScript</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="social-pill" data-toggle="pill" href="#social-settings" aria-expanded="false">Social Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="preview-pill" data-toggle="pill" href="#preview" aria-expanded="false">Preview</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="html-editor" role="tabpanel" aria-labelledby="html-pill">
                            <textarea class="form-control code-editor" rows="15" style="font-family: monospace;"><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><span class="location_name"></span> WiFi</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <div class="logo">
            <img src="logo.png" alt="ogo">
        </div>
        <h1>Welcome to <span class="location_name"></span> WiFi</h1>
        <p>Please login to access the internet</p>
        
        <form class="login-form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" required>
            </div>
            <div class="checkbox">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the terms and conditions</label>
            </div>
            <button type="submit">Connect</button>
        </form>
        
        <div class="social-login">
            <p>Or connect with</p>
            <div class="social-buttons">
                <button class="facebook">Facebook</button>
                <button class="google">Google</button>
            </div>
        </div>
    </div>
</body>
</html></textarea>
                        </div>
                                        <div class="tab-pane" id="js-editor" role="tabpanel" aria-labelledby="js-pill">
                                            <textarea class="form-control code-editor" rows="15" style="font-family: monospace;">// Optional JavaScript for enhanced functionality
document.addEventListener('DOMContentLoaded', function() {
   // Form submission
   const loginForm = document.querySelector('.login-form');
   if (loginForm) {
       loginForm.addEventListener('submit', function(e) {
           e.preventDefault();
           // Add your form submission logic here
           console.log('Form submitted');
           // You can add AJAX request or other form handling code
       });
   }
});</textarea>
                                          </div>
                         <div class="tab-pane" id="preview" role="tabpanel" aria-labelledby="preview-pill">
                             <div style="border: 1px solid #ddd; border-radius: 4px; padding: 1rem; background-color: #f9f9f9; height: 400px; overflow: auto;">
                                 <h5 class="text-center">Preview will be rendered here</h5>
                                 <p class="text-center text-muted">This is a placeholder for the live preview of your portal page.</p>
                                 <!-- Preview content will be rendered here -->
                                     </div>
                                 </div>
                             </div>
                         </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- Captive Portal Network Settings Modal -->
    <div class="modal fade" id="captive-network-modal" tabindex="-1" role="dialog" aria-labelledby="captive-network-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="captive-network-modal-title">Edit Captive Portal Network Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info mb-2">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-50"></i>
                            <span>Captive Portal requires Static IP configuration.</span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>IP Address</label>
                        <input type="text" class="form-control" placeholder="192.168.10.1" value="192.168.10.1">
                    </div>
                    <div class="form-group">
                        <label>Netmask</label>
                        <input type="text" class="form-control" placeholder="255.255.255.0" value="255.255.255.0">
                    </div>
                    <div class="form-group">
                        <label>Gateway</label>
                        <input type="text" class="form-control" placeholder="192.168.10.1" value="192.168.10.1">
                    </div>
                    <div class="form-group">
                        <label>Broadcast IP</label>
                        <input type="text" class="form-control" placeholder="192.168.10.255" value="192.168.10.255">
                    </div>
                    <div class="form-group">
                        <label>Primary DNS</label>
                        <input type="text" class="form-control" placeholder="8.8.8.8" value="8.8.8.8">
                    </div>
                    <div class="form-group">
                        <label>Secondary DNS</label>
                        <input type="text" class="form-control" placeholder="1.1.1.1" value="1.1.1.1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Password WiFi Network Settings Modal -->
    <div class="modal fade" id="password-network-modal" tabindex="-1" role="dialog" aria-labelledby="password-network-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="password-network-modal-title">Edit Password WiFi Network</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>IP Assignment</label>
                        <select class="form-control" id="password-ip-assignment">
                            <option value="STATIC" selected>Static IP</option>
                            <option value="DHCP">DHCP Client</option>
                        </select>
                        <small class="text-muted">When using DHCP Client, DHCP Server will be automatically disabled.</small>
                    </div>
                    
                    <div id="password-static-fields" class="hidden">
                        <div class="form-group">
                            <label>IP Address</label>
                            <input type="text" class="form-control" placeholder="192.168.1.1" id="password-ip" value="">
                        </div>
                        <div class="form-group">
                            <label>Netmask</label>
                            <input type="text" class="form-control" placeholder="255.255.255.0" id="password-netmask" value="">
                        </div>
                        <div class="form-group">
                            <label>Gateway</label>
                            <input type="text" class="form-control" placeholder="192.168.1.1" id="password-gateway" value="">
                        </div>
                        <div class="form-group">
                            <label>Broadcast IP</label>
                            <input type="text" class="form-control" placeholder="192.168.1.255" id="password-broadcast" value="">
                        </div>
                        <div class="form-group">
                            <label>Primary DNS</label>
                            <input type="text" class="form-control" placeholder="8.8.8.8" id="password-primary-dns" value="">
                        </div>
                        <div class="form-group">
                            <label>Secondary DNS</label>
                            <input type="text" class="form-control" placeholder="1.1.1.1" id="password-secondary-dns" value="">
                        </div>

                        <div class="form-group mt-3 pt-2 border-top">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="password-dhcp-server-toggle" checked>
                                <label class="custom-control-label" for="password-dhcp-server-toggle">Enable DHCP Server</label>
                            </div>
                            <small class="text-muted">Provides automatic IP addressing for connected clients.</small>
                        </div>
                        
                        <div id="password-dhcp-server-fields" class="hidden">
                            <div class="form-group">
                                <label>DHCP Range Start</label>
                                <input type="text" class="form-control" placeholder="192.168.1.100" id="password-dhcp-start" value="192.168.1.100">
                            </div>
                            <div class="form-group">
                                <label>DHCP Range End</label>
                                <input type="text" class="form-control" placeholder="192.168.1.200" id="password-dhcp-end" value="192.168.1.200">
                            </div>
                            <div class="form-group">
                                <label>Lease Time (hours)</label>
                                <input type="number" class="form-control" placeholder="24" id="password-lease-time" value="24">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary save-password-network">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- WAN Settings Modal -->
    <div class="modal fade" id="wan-settings-modal" tabindex="-1" role="dialog" aria-labelledby="wan-settings-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wan-settings-modal-title">Edit WAN Interface Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Connection Type</label>
                        <select class="form-control" id="wan-connection-type">
                            <option value="DHCP">DHCP</option>
                            <option value="STATIC">Static IP</option>
                            <option value="PPPOE">PPPoE</option>
                        </select>
                    </div>
                    
                    <div id="wan-static-fields" class="hidden">
                        <div class="form-group">
                            <label>IP Address</label>
                            <input type="text" class="form-control" id="wan-ip-address" placeholder="203.0.113.10" value="203.0.113.10">
                        </div>
                        <div class="form-group">
                            <label>Netmask</label>
                            <input type="text" class="form-control" id="wan-netmask" placeholder="255.255.255.0" value="255.255.255.0">
                        </div>
                        <div class="form-group">
                            <label>Gateway</label>
                            <input type="text" class="form-control" id="wan-gateway" placeholder="203.0.113.1" value="203.0.113.1">
                        </div>
                        <div class="form-group">
                            <label>Primary DNS</label>
                            <input type="text" class="form-control" id="wan-primary-dns" placeholder="8.8.8.8" value="8.8.8.8">
                        </div>
                        <div class="form-group">
                            <label>Secondary DNS</label>
                            <input type="text" class="form-control" id="wan-secondary-dns" placeholder="1.1.1.1" value="1.1.1.1">
                        </div>
                    </div>
                    
                    <div id="wan-pppoe-fields" style="display: none;">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" id="wan-pppoe-username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="wan-pppoe-password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label>Service Name (Optional)</label>
                            <input type="text" class="form-control" id="wan-pppoe-service-name" placeholder="Service Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary save-wan-settings">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- LAN Settings Modal -->
    <div class="modal fade" id="lan-settings-modal" tabindex="-1" role="dialog" aria-labelledby="lan-settings-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lan-settings-modal-title">Edit LAN Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>IP Address</label>
                        <input type="text" class="form-control" placeholder="192.168.1.1" value="192.168.1.1">
                    </div>
                    <div class="form-group">
                        <label>Netmask</label>
                        <input type="text" class="form-control" placeholder="255.255.255.0" value="255.255.255.0">
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch mb-1">
                            <input type="checkbox" class="custom-control-input" id="dhcp-server-toggle" checked>
                            <label class="custom-control-label" for="dhcp-server-toggle">Enable DHCP Server</label>
                        </div>
                    </div>
                    
                    <div id="dhcp-server-fields">
                        <div class="form-group">
                            <label>DHCP Start Address</label>
                            <input type="text" class="form-control" placeholder="192.168.1.100" value="192.168.1.100">
                        </div>
                        <div class="form-group">
                            <label>DHCP End Address</label>
                            <input type="text" class="form-control" placeholder="192.168.1.200" value="192.168.1.200">
                        </div>
                        <div class="form-group">
                            <label>Lease Time (hours)</label>
                            <input type="number" class="form-control" placeholder="24" value="24">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary save-lan-settings">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Captive Portal Settings Modal -->
    <div class="modal fade" id="captive-portal-modal" tabindex="-1" role="dialog" aria-labelledby="captive-portal-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="captive-portal-modal-title">Captive Portal IP Management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Static IP Settings -->
                    <div class="form-group">
                        <label>IP Assignment</label>
                        <select class="form-control" id="captive-ip-assignment" disabled>
                            <option value="static" selected>Static IP</option>
                        </select>
                        <small class="text-muted">Only Static IP configuration is available for Captive Portal</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="captive-portal-ip">IP Address</label>
                        <input type="text" class="form-control" id="captive-portal-ip" placeholder="192.168.2.1">
                    </div>
                    
                    <div class="form-group">
                        <label for="captive-portal-netmask">Netmask</label>
                        <input type="text" class="form-control" id="captive-portal-netmask" placeholder="255.255.255.0">
                    </div>
                    
                    <div class="form-group">
                        <label for="captive-portal-gateway">Gateway</label>
                        <input type="text" class="form-control" id="captive-portal-gateway" placeholder="192.168.2.1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary save-captive-portal" id="save-captive-portal-settings">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Device Restart Confirmation Modal -->
    <div class="modal fade" id="restart-confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="restart-confirmation-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restart-confirmation-modal-title">
                        <i data-feather="refresh-cw" class="mr-2"></i>Restart Device
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning mb-3">
                        <div class="alert-body">
                            <i data-feather="alert-triangle" class="mr-2"></i>
                            <strong>Warning:</strong> This action will restart the device and temporarily interrupt internet access.
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar bg-light-primary p-50 mr-3">
                            <div class="avatar-content">
                                <i data-feather="hard-drive" class="font-medium-4"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-0">Device Information</h6>
                            <p class="card-text text-muted mb-0">Location: <span class="location_name font-weight-bold"></span></p>
                            <p class="card-text text-muted mb-0">Model: <span class="router_model font-weight-bold"></span></p>
                        </div>
                    </div>
                    
                    <div class="bg-light-secondary p-2 rounded mb-3">
                        <h6 class="mb-2">What happens during restart:</h6>
                        <ul class="mb-0 pl-3">
                            <li>WiFi networks will be temporarily unavailable (2-3 minutes)</li>
                            <li>Connected users will be disconnected</li>
    
                        </ul>
                    </div>
                    
                    <p class="text-muted">Are you sure you want to restart this device?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirm-restart-btn">
                        <i data-feather="refresh-cw" class="mr-1"></i>
                        <span>Restart Device</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Firmware Update Modal -->
    <div class="modal fade" id="firmware-update-modal" tabindex="-1" role="dialog" aria-labelledby="firmware-update-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="firmware-update-modal-title">
                        <i data-feather="download" class="mr-2"></i>Update Firmware
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info mb-3">
                        <div class="alert-body">
                            <i data-feather="info" class="mr-2"></i>
                            <strong>Important:</strong> Firmware update will restart the device and may take 5-10 minutes to complete.
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar bg-light-primary p-50 mr-3">
                            <div class="avatar-content">
                                <i data-feather="hard-drive" class="font-medium-4"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-0">Current Device Information</h6>
                            <p class="card-text text-muted mb-0">Model: <span class="router_model font-weight-bold"></span></p>
                            <p class="card-text text-muted mb-0">Current Firmware: <span class="router_firmware font-weight-bold"></span></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="firmware-version-select">Available Firmware Versions</label>
                        <select class="form-control" id="firmware-version-select">
                            <option value="">Loading firmware versions...</option>
                        </select>
                        <small class="text-muted">Select a firmware version compatible with your device model.</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="firmware-description">Firmware Description</label>
                        <div class="card">
                            <div class="card-body p-2">
                                <div id="firmware-description">
                                    <p class="text-muted mb-0">Select a firmware version to view details.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-light-warning p-2 rounded mb-3">
                        <h6 class="mb-2">During firmware update:</h6>
                        <ul class="mb-0 pl-3">
                            <li>Device will reboot automatically</li>
                            <li>WiFi networks will be unavailable for 5-10 minutes</li>
                            <li>All connected users will be disconnected</li>
                            <li>Do not power off the device during update</li>
                        </ul>
                    </div>
                    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="start-firmware-update-btn" disabled>
                        <i data-feather="download" class="mr-1"></i>
                        <span>Update Firmware</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Firmware Update Progress Modal -->
    <div class="modal fade" id="firmware-progress-modal" tabindex="-1" role="dialog" aria-labelledby="firmware-progress-modal-title" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="firmware-progress-modal-title">
                        <i data-feather="download" class="mr-2"></i>Updating Firmware
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning mb-3">
                        <div class="alert-body">
                            <i data-feather="alert-triangle" class="mr-2"></i>
                            <strong>Do not close this window or power off the device during update.</strong>
                        </div>
                    </div>
                    
                    <div class="text-center mb-3">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    
                    <div class="progress progress-bar-primary mb-2">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="firmware-progress-bar"></div>
                    </div>
                    
                    <div class="text-center">
                        <h6 id="firmware-progress-status">Preparing firmware update...</h6>
                        <p class="text-muted mb-0" id="firmware-progress-description">This may take several minutes to complete.</p>
                    </div>
                    
                    <div class="timeline mt-3">
                        <div class="timeline-item">
                            <div class="timeline-point-indicator timeline-point-primary" id="step-1-indicator"></div>
                            <div class="timeline-event">
                                <h6>Uploading Firmware</h6>
                                <p class="text-muted mb-0">Transferring firmware to device</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-point-indicator" id="step-2-indicator"></div>
                            <div class="timeline-event">
                                <h6>Installing Update</h6>
                                <p class="text-muted mb-0">Writing firmware to device memory</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-point-indicator" id="step-3-indicator"></div>
                            <div class="timeline-event">
                                <h6>Rebooting Device</h6>
                                <p class="text-muted mb-0">Device will restart with new firmware</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END: Modals -->

    <!-- BEGIN: Vendor JS-->
    <script src="/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="/app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="/app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="/app-assets/vendors/js/maps/leaflet.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="/app-assets/js/core/app-menu.js"></script>
    <script src="/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="/app-assets/js/scripts/charts/chart-apex.js"></script>
    <script src="/app-assets/js/scripts/extensions/ext-component-toastr.js"></script>
    <script src="/app-assets/js/scripts/maps/map-leaflet.js"></script>
    <!-- END: Page JS-->
    <script src="/assets/js/config.js"></script>
    <script src="/assets/js/location-details.js?time=<?php echo time(); ?>"></script>
    <script>
        // Firmware Update Modal functionality
        $(document).ready(function() {
            // Show firmware update modal when button is clicked
            $('#update-firmware-btn').on('click', function() {
                // Check if router model is set
                const routerModel = $('.router_model_updated').text().trim();
                if (!routerModel) {
                    toastr.error('Please set the router model first in Location Details before updating firmware.');
                    return;
                }
                
                $('#firmware-update-modal').modal('show');
                loadFirmwareVersions();
            });

            // Load firmware versions based on router model
            function loadFirmwareVersions() {
                // Get router model from the dropdown selection or current device
                const routerModel = $('#router-model-select').val() || $('.router_model_updated').text();
                const $select = $('#firmware-version-select');
                
                console.log('Loading firmware for model:', routerModel);
                
                // Clear existing options
                $select.html('<option value="">Loading firmware versions...</option>');
                
                // Make API call to get firmware versions based on model
                getFirmwareByModel(routerModel)
                
                    .then(function(firmwareVersions) {
                        console.log('Received firmware versions:', firmwareVersions);
                        
                        $select.empty();
                        if (firmwareVersions.length === 0) {
                            $select.html('<option value="">No firmware versions available for this model</option>');
                            $('#firmware-description').html('<div class="alert alert-warning mb-0"><i data-feather="alert-triangle" class="mr-1"></i>This device model (' + routerModel + ') is not supported for firmware updates. Only 820AX and 835AX models are supported.</div>');
                            return;
                        }
                        
                        $select.append('<option value="">Select firmware version...</option>');
                        
                        firmwareVersions.forEach(function(firmware) {
                            console.log('Processing firmware:', firmware);
                            const option = `<option value="${firmware.id}" 
                                            data-name="${firmware.name}"
                                            data-version="${firmware.version}"
                                            data-description="${firmware.description}"
                                            data-release-date="${firmware.release_date}"
                                            data-file-size="${firmware.file_size}"
                                            data-changelog="${firmware.changelog}"
                                            data-model="${firmware.model}"
                                            data-file-name="${firmware.file_name}"
                                            data-md5sum="${firmware.md5sum}">
                                            ${firmware.name}
                                            ${firmware.is_latest ? ' (Latest)' : ''}
                                            ${firmware.is_current ? ' (Current)' : ''}
                                        </option>`;
                            $select.append(option);
                        });
                        
                        // Pre-select current firmware if device data is available
                        if (window.currentDeviceData && window.currentDeviceData.firmware_id) {
                            console.log('Pre-selecting current firmware ID:', window.currentDeviceData.firmware_id);
                            $select.val(window.currentDeviceData.firmware_id);
                            $select.trigger('change'); // Trigger change event to show firmware details
                        } else if (window.currentDeviceData && window.currentDeviceData.firmware_version) {
                            // If no firmware_id but we have firmware_version, try to match by name
                            console.log('Trying to pre-select by firmware version name:', window.currentDeviceData.firmware_version);
                            $select.find('option').each(function() {
                                if ($(this).data('name') === window.currentDeviceData.firmware_version) {
                                    $select.val($(this).val());
                                    $select.trigger('change');
                                    return false; // Break the loop
                                }
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error('Error loading firmware versions:', error);
                        $select.html('<option value="">Error loading firmware versions</option>');
                        $('#firmware-description').html('<div class="alert alert-danger mb-0"><i data-feather="alert-circle" class="mr-1"></i>Failed to load firmware versions. Please try again later.</div>');
                        toastr.error('Failed to load firmware versions');
                    });
            }

            // API call to get firmware by model
            function getFirmwareByModel(model) {

                console.log('Getting firmware by model:', model);
                return new Promise(function(resolve, reject) {
                    // Check if model is supported
                    if (!model || (model !== '820AX' && model !== '835AX')) {
                        resolve([]);
                        return;
                    }

                    $.ajax({
                        url: '/api/firmware/model/' + model,
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + UserManager.getToken(),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            console.log("firmware response:::::", response);
                            // Transform API response to match expected format
                            let firmwareList = [];
                            
                            if (response.data && Array.isArray(response.data)) {
                                firmwareList = response.data.map(function(firmware) {
                                    return {
                                        id: firmware.id,
                                        name: firmware.name || 'Unnamed Firmware',
                                        version: firmware.version || firmware.name || 'Unknown Version',
                                        description: firmware.description || 'No description available',
                                        release_date: firmware.created_at ? firmware.created_at.split('T')[0] : 'Unknown',
                                        file_size: firmware.file_size ? (firmware.file_size + ' bytes') : 'Unknown',
                                        changelog: firmware.description || 'No changelog available',
                                        is_latest: false, // You may need to determine this logic
                                        is_current: false, // You may need to determine this logic
                                        model: firmware.model,
                                        file_name: firmware.file_name,
                                        md5sum: firmware.md5sum,
                                        is_enabled: firmware.is_enabled
                                    };
                                });
                            } else if (response && Array.isArray(response)) {
                                // Handle direct array response
                                firmwareList = response.map(function(firmware) {
                                    return {
                                        id: firmware.id,
                                        name: firmware.name || 'Unnamed Firmware',
                                        version: firmware.version || firmware.name || 'Unknown Version',
                                        description: firmware.description || 'No description available',
                                        release_date: firmware.created_at ? firmware.created_at.split('T')[0] : 'Unknown',
                                        file_size: firmware.file_size ? (firmware.file_size + ' bytes') : 'Unknown',
                                        changelog: firmware.description || 'No changelog available',
                                        is_latest: false,
                                        is_current: false,
                                        model: firmware.model,
                                        file_name: firmware.file_name,
                                        md5sum: firmware.md5sum,
                                        is_enabled: firmware.is_enabled
                                    };
                                });
                            }
                            
                            resolve(firmwareList);
                        },
                        error: function(xhr, status, error) {
                            console.error('API Error:', xhr.responseText);
                            reject(error);
                        }
                    });
                });
            }

            // Handle firmware version selection
            $('#firmware-version-select').on('change', function() {
                const selectedOption = $(this).find('option:selected');
                const $button = $('#start-firmware-update-btn');
                const $description = $('#firmware-description');

                if (selectedOption.val()) {
                    // Enable update button
                    $button.prop('disabled', false);
                    
                    // Show firmware details
                    const details = `
                        <div class="row">
                            <div class="col-6">
                                <strong>Name:</strong> ${selectedOption.data('name')}<br>
                                <strong>Version:</strong> ${selectedOption.data('version')}<br>
                                <strong>Release Date:</strong> ${selectedOption.data('release-date')}<br>
                                <strong>File Size:</strong> ${selectedOption.data('file-size')}
                            </div>
                            <div class="col-6">
                                <strong>Model:</strong> ${selectedOption.data('model')}<br>
                                <strong>File Name:</strong> ${selectedOption.data('file-name')}<br>
                                <strong>MD5 Checksum:</strong><br>
                                <small class="text-muted">${selectedOption.data('md5sum')}</small>
                            </div>
                        </div>
                        <hr class="my-2">
                        <p class="mb-0">${selectedOption.data('description')}</p>
                    `;
                    $description.html(details);
                } else {
                    // Disable update button
                    $button.prop('disabled', true);
                    $description.html('<p class="text-muted mb-0">Select a firmware version to view details.</p>');
                }
            });

            // Handle firmware update start
            $('#start-firmware-update-btn').on('click', function() {
                const selectedOption = $('#firmware-version-select option:selected');
                
                if (!selectedOption.val()) {
                    toastr.error('Please select a firmware version to update.');
                    return;
                }

                const firmwareId = selectedOption.val();
                const firmwareName = selectedOption.data('name');
                const locationId = getLocationId();
                
                console.log('Initiating firmware update:', {
                    locationId: locationId,
                    firmwareId: firmwareId,
                    firmwareName: firmwareName
                });
                
                if (!locationId) {
                    toastr.error('Location ID not found');
                    return;
                }

                // Show loading state
                const $button = $(this);
                const originalText = $button.html();
                $button.html('<i data-feather="loader" class="mr-1"></i> Initiating Update...').prop('disabled', true);

                // Make API call to update firmware
                $.ajax({
                    url: `/api/locations/${locationId}/update-firmware`,
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    data: JSON.stringify({
                        firmware_id: firmwareId,
                        firmware_version: firmwareName
                    }),
                    success: function(response) {
                        console.log('Firmware update API response:', response);
                        
                        // Hide selection modal
                        $('#firmware-update-modal').modal('hide');
                        
                        // Show success message
                        toastr.success('Firmware update initiated successfully! The device will be upgraded in 5-10 minutes. Please do not power off the device during this time.', 'Firmware Update Started', {
                            timeOut: 8000,
                            extendedTimeOut: 3000,
                            closeButton: true,
                            progressBar: true
                        });
                        
                        // Update the displayed firmware version
                        if (response.data && response.data.device && response.data.device.firmware_version) {
                            $('.router_firmware').text(response.data.device.firmware_version);
                            // Update the stored device data
                            if (window.currentDeviceData) {
                                window.currentDeviceData.firmware_version = response.data.device.firmware_version;
                                window.currentDeviceData.firmware_id = response.data.device.firmware_id;
                            }
                        } else {
                            // If no firmware version in response, use the firmware name we sent
                            $('.router_firmware').text(firmwareName);
                            if (window.currentDeviceData) {
                                window.currentDeviceData.firmware_version = firmwareName;
                                window.currentDeviceData.firmware_id = firmwareId;
                            }
                        }
                        
                        // Reset button state
                        $button.html(originalText).prop('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        console.error('Firmware update failed:', xhr.responseText);
                        
                        // Reset button state
                        $button.html(originalText).prop('disabled', false);
                        
                        // Handle API error
                        handleApiError(xhr, status, error, 'updating device firmware');
                    }
                });
            });
        });

        // Function to load web filter categories
        function loadWebFilterCategories() {
            console.log('Loading web filter categories from API');
            
            $.ajax({
                url: '/api/categories/enabled',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + UserManager.getToken(),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    console.log('Categories loaded successfully:', response);
                    
                    const $select = $('#global-filter-categories');
                    $select.empty();
                    
                    if (response.data && Array.isArray(response.data)) {
                        response.data.forEach(function(category) {
                            const option = `<option value="${category.id}" data-name="${category.name}" data-slug="${category.slug}">
                                ${category.name} (${category.active_blocked_domains_count || 0} domains)
                            </option>`;
                            $select.append(option);
                        });
                        
                        // Initialize Select2 if not already initialized
                        if (!$select.hasClass('select2-hidden-accessible')) {
                            $select.select2({
                                placeholder: 'Select categories to block',
                                allowClear: true,
                                width: '100%'
                            });
                        }
                        
                        // Load existing location settings for web filtering
                        loadLocationWebFilterSettings();
                    } else {
                        console.warn('No categories found in response');
                        $select.append('<option value="">No categories available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load categories:', error);
                    handleApiError(xhr, status, error, 'loading web filter categories');
                    
                    // Add fallback categories if API fails
                    const $select = $('#global-filter-categories');
                    $select.html(`
                        <option value="">Failed to load categories</option>
                        <option value="fallback-adult">Adult Content (Fallback)</option>
                        <option value="fallback-malware">Malware & Phishing (Fallback)</option>
                    `);
                }
            });
        }

        // Function to load location web filter settings
        function loadLocationWebFilterSettings() {
            const locationId = getLocationId();
            if (!locationId) {
                console.log('No location ID found - cannot load web filter settings');
                return;
            }

            console.log('Loading web filter settings for location:', locationId);
            
            $.ajax({
                url: '/api/locations/' + locationId + '/settings',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + UserManager.getToken(),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    console.log('Location settings loaded:', response);
                    
                    if (response.data && response.data.settings) {
                        const settings = response.data.settings;
                        
                        // Set web filter enabled status
                        if (settings.web_filter_enabled !== undefined) {
                            $('#global-web-filter').prop('checked', settings.web_filter_enabled);
                        }
                        
                        // Set selected categories
                        if (settings.web_filter_categories && Array.isArray(settings.web_filter_categories)) {
                            $('#global-filter-categories').val(settings.web_filter_categories).trigger('change');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to load location settings:', error);
                    // Don't show error to user for settings loading failure
                }
            });
        }

        // Function to save web filter settings
        function saveWebFilterSettings() {
            const locationId = getLocationId();
            if (!locationId) {
                toastr.error('Location ID not found');
                return;
            }

            const webFilterEnabled = $('#global-web-filter').is(':checked');
            const selectedCategories = $('#global-filter-categories').val() || [];

            console.log('Saving web filter settings:', {
                web_filter_enabled: webFilterEnabled,
                web_filter_categories: selectedCategories
            });

            $.ajax({
                url: '/api/locations/' + locationId + '/settings',
                method: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + UserManager.getToken(),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                data: JSON.stringify({
                    web_filter_enabled: webFilterEnabled,
                    web_filter_categories: selectedCategories
                }),
                success: function(response) {
                    console.log('Web filter settings saved successfully:', response);
                    toastr.success('Web content filtering settings saved successfully!');
                },
                error: function(xhr, status, error) {
                    handleApiError(xhr, status, error, 'saving web filter settings');
                }
            });
        }

        // Function to get location ID (moved outside of document ready block for global access)
        function getLocationId() {
            // Option 1: From URL path (e.g., /locations/123/details or /location-details?id=123)
            const pathParts = window.location.pathname.split('/');
            console.log('URL path parts:', pathParts);
            
            // Check for locations/ID pattern
            const locationIndex = pathParts.indexOf('locations');
            if (locationIndex !== -1 && pathParts[locationIndex + 1]) {
                const locationId = pathParts[locationIndex + 1];
                console.log('Found location ID from path:', locationId);
                return locationId;
            }
            
            // Option 2: From URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const locationId = urlParams.get('location_id') || urlParams.get('id');
            if (locationId) {
                console.log('Found location ID from URL params:', locationId);
                return locationId;
            }
            
            // Option 3: From breadcrumb text (as fallback) - "Location 14"
            const breadcrumbText = $('.breadcrumb-item.active').text();
            console.log('Breadcrumb text:', breadcrumbText);
            const locationMatch = breadcrumbText.match(/Location (\d+)/);
            if (locationMatch) {
                const locationId = locationMatch[1];
                console.log('Found location ID from breadcrumb:', locationId);
                return locationId;
            }
            
            // Option 4: From data attribute or global variable
            if (window.currentLocationId) {
                console.log('Found location ID from global variable:', window.currentLocationId);
                return window.currentLocationId;
            }
            
            console.log('No location ID found');
            return null;
        }

        // Helper function to handle API errors consistently
        function handleApiError(xhr, status, error, context) {
            console.error(`API Error in ${context}:`, error);
            console.error('Status:', status);
            console.error('Response:', xhr.responseText);
            
            if (xhr.status === 401) {
                console.error('Unauthorized - redirecting to login');
                toastr.error('Session expired. Please log in again.');
                setTimeout(() => {
                    window.location.href = '/';
                }, 2000);
                return;
            }
            
            let errorMessage = 'An error occurred';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            } else if (xhr.responseText) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    errorMessage = response.message || response.error || errorMessage;
                } catch (e) {
                    errorMessage = error || errorMessage;
                }
            }
            
            toastr.error(`${context}: ${errorMessage}`);
        }

        // Router Model Selection functionality
        $(document).ready(function() {
            // Check authentication first
            if (!UserManager.getToken()) {
                console.error('No authentication token found, redirecting to login');
                
                // Debug: Let's see what's actually in localStorage
                console.log('localStorage contents:');
                for (let i = 0; i < localStorage.length; i++) {
                    const key = localStorage.key(i);
                    console.log(`${key}: ${localStorage.getItem(key)}`);
                }
                
                console.log('UserManager.getToken():', UserManager.getToken());
                console.log('Available UserManager methods:', Object.keys(UserManager));
                
                // Don't redirect immediately for debugging
                // window.location.href = '/';
                // return;
            } else {
                console.log('Authentication token found:', UserManager.getToken().substring(0, 20) + '...');
            }

            // Clear/unset router model on page load
            console.log('Clearing router model on page load');
            $('.router_model_updated').text('');
            $('.router_firmware').text('Unknown');  // Set default text instead of empty
            $('#router-model-select').val('');
            
            // Global variable to store current device data
            window.currentDeviceData = null;

            // Function to load device data from API
            // Function to load device info specifically for the modal
            function loadDeviceInfoForModal(locationId) {
                console.log('Loading device info for modal');
                
                $.ajax({
                    url: '/api/locations/' + locationId,
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        console.log('Device info loaded for modal:', response);
                        
                        // Extract device data from response
                        let device = null;
                        if (response.data && response.data.device) {
                            device = response.data.device;
                        } else if (response.device) {
                            device = response.device;
                        } else if (response.data && response.data.devices && response.data.devices.length > 0) {
                            device = response.data.devices[0];
                        }
                        
                        if (device) {
                            $('#modal-device-id').text(device.id || '-');
                            $('#modal-scan-counter').text(device.scan_counter || 0);
                            $('#modal-next-scan-id').text((device.scan_counter || 0) + 1);
                        } else {
                            $('#modal-device-id').text('-');
                            $('#modal-scan-counter').text('-');
                            $('#modal-next-scan-id').text('-');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to load device info for modal:', error);
                        $('#modal-device-id').text('Error');
                        $('#modal-scan-counter').text('Error');
                        $('#modal-next-scan-id').text('Error');
                    }
                });
            }

            function loadDeviceData() {
                console.log('Loading device data from API');
                
                // Get location ID from URL or data attribute
                const locationId = getLocationId();
                
                if (!locationId) {
                    console.log('No location ID found - cannot load device data');
                    return;
                }

                console.log('Making API call to /api/locations/' + locationId);

                $.ajax({
                    url: '/api/locations/' + locationId,
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        console.log('API Response received:', response);
                        
                        // Extract location data from response
                        let location = null;
                        if (response.data) {
                            location = response.data;
                        } else if (response.location) {
                            location = response.location;
                        }

                        console.log('Extracted location data:', location);

                        // Store location data globally for use in other functions
                        window.currentLocationData = location;

                        // Initialize map if location has coordinates
                        if (location && location.latitude && location.longitude) {
                            // Convert coordinates to ensure they're numbers
                            const lat = parseFloat(location.latitude);
                            const lng = parseFloat(location.longitude);
                            
                            if (!isNaN(lat) && !isNaN(lng)) {
                                // Delay map initialization to ensure DOM is ready
                                setTimeout(function() {
                                    initializeLocationMap(lat, lng, location.name, location.address);
                                }, 300);
                            } else {
                                console.error('Invalid coordinates from API:', location.latitude, location.longitude);
                                $('#location-map').html(`
                                    <div class="d-flex align-items-center justify-content-center h-100">
                                        <div class="text-center text-warning">
                                            <i data-feather="alert-circle" class="mb-2"></i>
                                            <p class="mb-0">Invalid coordinates from server</p>
                                            <small>Please check location data</small>
                                        </div>
                                    </div>
                                `);
                                if (typeof feather !== 'undefined') {
                                    feather.replace();
                                }
                            }
                        } else {
                            console.log('No coordinates found for location, map not initialized');
                            // Show a message in the map container
                            $('#location-map').html(`
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center text-muted">
                                        <i data-feather="map-pin" class="mb-2"></i>
                                        <p class="mb-0">No coordinates available</p>
                                        <small>Add address information to see location on map</small>
                                    </div>
                                </div>
                            `);
                            $('#map-coordinates').hide();
                            if (typeof feather !== 'undefined') {
                                feather.replace();
                            }
                        }
                        
                        // Extract device data from response
                        let device = null;
                        if (response.data && response.data.device) {
                            device = response.data.device;
                        } else if (response.device) {
                            device = response.device;
                        } else if (response.data && response.data.devices && response.data.devices.length > 0) {
                            device = response.data.devices[0]; // Take first device if multiple
                        }

                        console.log('Extracted device data:', device);

                        if (device) {
                            // Store device data globally for use in other functions
                            window.currentDeviceData = device;
                            
                            // Update router model if it exists
                            if (device.model) {
                                console.log('Setting router model to:', device.model);
                                $('.router_model_updated').text(device.model);
                                $('#router-model-select').val(device.model);
                            } else {
                                console.log('No device model found, leaving blank');
                                $('.router_model_updated').text('');
                                $('#router-model-select').val('');
                            }

                            // Update firmware version if it exists
                            if (device.firmware_version && device.firmware_version.trim() !== '') {
                                console.log('Setting firmware version to:', device.firmware_version);
                                $('.router_firmware').text(device.firmware_version);
                            } else {
                                console.log('No firmware version found, checking for latest firmware for model:', device.model);
                                $('.router_firmware').text('Not Set');
                                
                                // If device has a model but no firmware, try to get the latest firmware for this model
                                if (device.model && (device.model === '820AX' || device.model === '835AX')) {
                                    loadLatestFirmwareForModel(device.model);
                                }
                            }
                            // Update other device fields
                            if (device.reboot_count !== null && device.reboot_count !== undefined) {
                                console.log('Setting reboot count to:', device.reboot_count);
                                $('.reboot_count').text(device.reboot_count);
                            }
                            
                            // Update uptime if it exists
                            if (device.uptime !== null && device.uptime !== undefined) {
                                var uptime_text = '';
                                var actual_uptime = device.uptime;
                                
                                // If device is offline, set uptime to 0
                                if (device.is_online === false) {
                                    console.log('Device is offline, setting uptime to 0');
                                    actual_uptime = 0;
                                }
                                
                                console.log('Setting uptime to:', actual_uptime);
                                
                                // Uptime is in seconds, convert to hours, minutes, Hours Days
                                const uptime_hours = Math.floor(actual_uptime / 3600);
                                const uptime_minutes = Math.floor((actual_uptime % 3600) / 60);
                                if (uptime_hours > 24) {
                                    const uptime_days = Math.floor(uptime_hours / 24);
                                    uptime_text = uptime_days + 'd ' + (uptime_hours % 24) + 'h ' + uptime_minutes + 'm';
                                } else if (uptime_hours > 0) {
                                    uptime_text = uptime_hours + 'h ' + uptime_minutes + 'm';
                                } else {
                                    uptime_text = uptime_minutes + 'm';
                                }
                                $('.uptime').text(uptime_text);
                            } else {
                                console.log('No uptime found, leaving blank');
                                $('.uptime').text('');
                            }
                        } else {
                            console.log('No device data found in response, setting defaults');
                            window.currentDeviceData = null;
                            $('.router_model_updated').text('');
                            $('.router_firmware').text('Unknown');
                            $('.uptime').text('');
                        }
                    },
                    error: function(xhr, status, error) {
                        handleApiError(xhr, status, error, 'loading device data');
                    }
                });
            }

            // Function to initialize location map with coordinates
            function initializeLocationMap(latitude, longitude, locationName, locationAddress) {
                console.log('Initializing location map with coordinates:', latitude, longitude);
                console.log('Coordinate types:', typeof latitude, typeof longitude);
                
                // Convert to numbers and validate coordinates
                const lat = parseFloat(latitude);
                const lng = parseFloat(longitude);
                
                if (isNaN(lat) || isNaN(lng)) {
                    console.error('Invalid coordinates provided:', { latitude, longitude });
                    $('#location-map').html(`
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="text-center text-warning">
                                <i data-feather="alert-circle" class="mb-2"></i>
                                <p class="mb-0">Invalid coordinates</p>
                                <small>Latitude: ${latitude}, Longitude: ${longitude}</small>
                            </div>
                        </div>
                    `);
                    $('#map-coordinates').hide();
                    if (typeof feather !== 'undefined') {
                        feather.replace();
                    }
                    return;
                }
                
                // Check if map container exists and is visible
                const mapContainer = document.getElementById('location-map');
                if (!mapContainer) {
                    console.error('Map container not found');
                    return;
                }
                
                // Clear existing map if any
                if (window.locationMap) {
                    try {
                        window.locationMap.remove();
                        window.locationMap = null;
                    } catch (e) {
                        console.log('Error removing existing map:', e);
                    }
                }
                
                $('#location-map').empty();
                
                // Wait a bit to ensure container is properly rendered
                setTimeout(function() {
                    try {
                        // Check if Leaflet is loaded
                        if (typeof L === 'undefined') {
                            console.error('Leaflet library not loaded');
                            $('#location-map').html(`
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="text-center text-warning">
                                        <i data-feather="alert-circle" class="mb-2"></i>
                                        <p class="mb-0">Map library loading...</p>
                                        <small>Please wait a moment</small>
                                    </div>
                                </div>
                            `);
                            if (typeof feather !== 'undefined') {
                                feather.replace();
                            }
                                                         // Retry after Leaflet loads
                             setTimeout(function() {
                                 initializeLocationMap(lat, lng, locationName, locationAddress);
                             }, 1000);
                            return;
                        }
                        
                        // Check again that container exists and has dimensions
                        if (!isMapContainerReady()) {
                            console.log('Map container not ready, waiting...');
                                                         // Try again after a longer delay
                             setTimeout(function() {
                                 initializeLocationMap(lat, lng, locationName, locationAddress);
                             }, 500);
                            return;
                        }
                        
                        // Initialize the map
                        const map = L.map('location-map').setView([lat, lng], 15);
                    
                    // Add OpenStreetMap tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19
                    }).addTo(map);
                    
                    // Create popup content
                    let popupContent = `<strong>${locationName || 'Location'}</strong>`;
                    if (locationAddress) {
                        popupContent += `<br><small>${locationAddress}</small>`;
                    }
                    popupContent += `<br><small>Lat: ${lat.toFixed(6)}, Lng: ${lng.toFixed(6)}</small>`;
                    
                    // Add marker with popup
                    const marker = L.marker([lat, lng]).addTo(map);
                    marker.bindPopup(popupContent).openPopup();
                    
                        // Store map reference globally for potential future use
                        window.locationMap = map;
                        
                        // Show coordinates in the header
                        $('#map-coordinates').text(`${lat.toFixed(6)}, ${lng.toFixed(6)}`).show();
                        
                        console.log('Location map initialized successfully');
                    } catch (error) {
                        console.error('Error initializing location map:', error);
                        $('#location-map').html(`
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-center text-danger">
                                    <i data-feather="alert-triangle" class="mb-2"></i>
                                    <p class="mb-0">Error loading map</p>
                                    <small>Please try refreshing the page</small>
                                </div>
                            </div>
                        `);
                        $('#map-coordinates').hide();
                        if (typeof feather !== 'undefined') {
                            feather.replace();
                        }
                    }
                }, 100); // End of setTimeout
            }

            // Function to check if map container is ready
            function isMapContainerReady() {
                const container = document.getElementById('location-map');
                if (!container) {
                    return false;
                }
                
                // Check if container is visible and has dimensions
                const rect = container.getBoundingClientRect();
                return rect.width > 0 && rect.height > 0;
            }

            // Function to update location map with new coordinates
            function updateLocationMap(location) {
                if (!location || !location.latitude || !location.longitude) {
                    console.log('No location coordinates to update map');
                    return;
                }
                
                // Convert coordinates to ensure they're numbers
                const lat = parseFloat(location.latitude);
                const lng = parseFloat(location.longitude);
                
                if (isNaN(lat) || isNaN(lng)) {
                    console.error('Invalid coordinates in location data:', location.latitude, location.longitude);
                    return;
                }
                
                console.log('Updating location map with new coordinates:', lat, lng);
                
                // Check if container is ready before updating
                if (isMapContainerReady()) {
                    initializeLocationMap(lat, lng, location.name, location.address);
                } else {
                    console.log('Map container not ready, waiting...');
                    setTimeout(function() {
                        updateLocationMap(location);
                    }, 500);
                }
            }

            // Function to load latest firmware for a specific model when current firmware is not set
            function loadLatestFirmwareForModel(model) {
                console.log('Loading latest firmware for model:', model);
                
                getFirmwareByModel(model)
                    .then(function(firmwareVersions) {
                        if (firmwareVersions.length > 0) {
                            // Find the latest firmware (you can modify this logic based on your needs)
                            // For now, we'll take the first one or look for one marked as latest
                            let latestFirmware = firmwareVersions.find(fw => fw.is_latest) || firmwareVersions[0];
                            
                            console.log('Found latest firmware:', latestFirmware);
                            $('.router_firmware').text(latestFirmware.version + ' (Latest Available)');
                        } else {
                            console.log('No firmware versions found for model:', model);
                            $('.router_firmware').text('No Firmware Available');
                        }
                    })
                    .catch(function(error) {
                        console.error('Error loading latest firmware for model:', error);
                        $('.router_firmware').text('Error Loading Firmware');
                    });
            }

            // Save location information including router model
            $('#save-location-info').on('click', function() {
                const locationData = {
                    name: $('#location-name').val(),
                    address: $('#location-address').val(),
                    city: $('#location-city').val(),
                    state: $('#location-state').val(),
                    postal_code: $('#location-postal-code').val(),
                    country: $('#location-country').val(),
                    router_model: $('#router-model-select').val(),
                    manager: $('#location-manager').val(),
                    contact_email: $('#location-contact-email').val(),
                    contact_phone: $('#location-contact-phone').val(),
                    status: $('#location-status').val(),
                    description: $('#location-description').val(),
                };

                // Validate required fields
                if (!locationData.name) {
                    toastr.error('Location name is required.');
                    return;
                }

                // Router model is optional now - removed validation
                // if (!locationData.router_model) {
                //     toastr.error('Please select a router model.');
                //     return;
                // }

                // Show loading state
                const $button = $(this);
                const originalText = $button.html();
                $button.html('<i data-feather="loader" class="mr-1"></i> Saving...').prop('disabled', true);

                // Make real API call to save location information
                const locationId = getLocationId();
                if (!locationId) {
                    toastr.error('Location ID not found');
                    $button.html(originalText).prop('disabled', false);
                    return;
                }

                console.log('Saving location data:', locationData);

                $.ajax({
                    url: '/api/locations/' + locationId,
                    method: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    data: JSON.stringify(locationData),
                    success: function(response) {
                        console.log('Location data saved successfully:', response);
                        
                        // Update UI elements with new data
                        $('.location_name').text(locationData.name);
                        $('.location_address').text(locationData.address + ', ' + locationData.city + ', ' + locationData.state);
                        $('.router_model_updated').text(locationData.router_model);
                        
                        // Reset button state
                        $button.html(originalText).prop('disabled', false);
                        
                        // Show success message
                        toastr.success('Location information saved successfully!');
                        
                        // Re-initialize feather icons
                        if (typeof feather !== 'undefined') {
                            feather.replace();
                        }
                        
                        // Reload device data to verify the update and refresh map with potentially new coordinates
                        setTimeout(function() {
                            loadDeviceData();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        // Reset button state first
                        $button.html(originalText).prop('disabled', false);
                        
                        // Then handle the API error
                        handleApiError(xhr, status, error, 'saving location data');
                    }
                });
            });

            // Load existing location data when page loads
            function loadLocationData() {
                console.log('loadLocationData called');
                
                // In a real application, this would load from your backend
                // For now, we'll populate with sample data if fields are empty
                
                if (!$('#location-name').val()) {
                    console.log('Loading sample location data');
                    // Sample data - replace with actual API call
                    const sampleData = {
                        name: 'Downtown Coffee Shop',
                        address: '123 Main Street',
                        city: 'New York',
                        state: 'NY',
                        postal_code: '10001',
                        country: 'United States',
                        router_model: '', // Always start with blank
                        manager: 'John Smith',
                        contact_email: 'john@coffeeshop.com',
                        contact_phone: '+1 (555) 123-4567',
                        status: 'active',
                        description: 'Main downtown location with high traffic'
                    };
                    
                    // Populate form fields
                    $('#location-name').val(sampleData.name);
                    $('#location-address').val(sampleData.address);
                    $('#location-city').val(sampleData.city);
                    $('#location-state').val(sampleData.state);
                    $('#location-postal-code').val(sampleData.postal_code);
                    $('#location-country').val(sampleData.country);
                    $('#router-model-select').val(sampleData.router_model);
                    $('#location-manager').val(sampleData.manager);
                    $('#location-contact-email').val(sampleData.contact_email);
                    $('#location-contact-phone').val(sampleData.contact_phone);
                    $('#location-status').val(sampleData.status);
                    $('#location-description').val(sampleData.description);
                    
                    // Update UI elements
                    $('.location_name').text(sampleData.name);
                    $('.location_address').text(sampleData.address + ', ' + sampleData.city + ', ' + sampleData.state);
                    $('.router_model_updated').text(sampleData.router_model);
                } else {
                    console.log('Location data already loaded, skipping');
                }
            }

            // Load data when the location settings tab is shown
            $('a[href="#location-settings"]').on('shown.bs.tab', function() {
                loadLocationData();
            });

            // Load data immediately if location settings tab is active
            if ($('#location-settings').hasClass('active')) {
                loadLocationData();
            }

            // Handle router model selection change
            $('#router-model-select').on('change', function() {
                const selectedModel = $(this).val();
                console.log('Router model changed to:', selectedModel);
                
                // Update UI immediately
                $('.router_model_updated').text(selectedModel);
                
                // Update device model via API
                updateDeviceModel(selectedModel);
                
                // Show success message
                if (selectedModel) {
                    toastr.success('Router model updated to ' + selectedModel);
                }
            });

            // Function to update device model via API
            function updateDeviceModel(model) {
                const locationId = getLocationId();
                if (!locationId) {
                    console.log('No location ID found, cannot update device model');
                    return;
                }

                console.log('Updating device model to:', model, 'for location:', locationId);

                $.ajax({
                    url: '/api/locations/' + locationId,
                    method: 'PUT',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    data: JSON.stringify({
                        device: {
                            model: model
                        }
                    }),
                    success: function(response) {
                        console.log('Device model updated successfully:', response);
                        toastr.success('Router model updated successfully');
                        
                        // Reload device data to verify the update
                        setTimeout(function() {
                            loadDeviceData();
                        }, 1000);
                    },
                    error: function(xhr, status, error) {
                        handleApiError(xhr, status, error, 'updating device model');
                    }
                });
            }

            // Initialize router model on page load
            setTimeout(function() {
                const currentRouterModel = $('.router_model').text();
                console.log('Timeout check - current router model:', currentRouterModel);
                
                if (!currentRouterModel || currentRouterModel === '') {
                    const savedModel = localStorage.getItem('router_model');
                    if (savedModel) {
                        console.log('Timeout setting router model to saved:', savedModel);
                        $('.router_model').text(savedModel);
                    } else {
                        console.log('No saved model, leaving blank');
                    }
                } else {
                    console.log('Timeout check - router model already properly set:', currentRouterModel);
                }
            }, 100);

            // Load device data when page loads - with delay to ensure DOM is ready
            $(document).ready(function() {
                setTimeout(function() {
                    loadDeviceData();
                }, 500);
            });

            // Handle window resize to make map responsive
            $(window).on('resize', function() {
                if (window.locationMap) {
                    setTimeout(function() {
                        window.locationMap.invalidateSize();
                    }, 100);
                }
            });

            // Handle tab switching to refresh map size
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                if (window.locationMap) {
                    setTimeout(function() {
                        window.locationMap.invalidateSize();
                    }, 100);
                } else {
                    // If map doesn't exist but container is now visible, try to initialize
                    setTimeout(function() {
                        if (isMapContainerReady() && window.currentLocationData) {
                            const location = window.currentLocationData;
                            if (location && location.latitude && location.longitude) {
                                // Convert coordinates to ensure they're numbers
                                const lat = parseFloat(location.latitude);
                                const lng = parseFloat(location.longitude);
                                
                                if (!isNaN(lat) && !isNaN(lng)) {
                                    initializeLocationMap(lat, lng, location.name, location.address);
                                }
                            }
                        }
                    }, 200);
                }
            });

            // Fix for Total Users tab - Force proper Bootstrap tab initialization
            $(document).ready(function() {
                // Debug: Check if tab elements exist
                console.log('Total Users tab link exists:', $('#connected-users-tab').length > 0);
                console.log('Total Users tab content exists:', $('#connected-users').length > 0);
                
                // Force tab initialization
                $('#connected-users-tab').on('click', function(e) {
                    e.preventDefault();
                    console.log('Total Users tab clicked');
                    
                    // Remove active class from all tabs
                    $('.nav-link').removeClass('active');
                    $('.tab-pane').removeClass('active show');
                    
                    // Add active class to clicked tab
                    $(this).addClass('active');
                    $('#connected-users').addClass('active show');
                    
                    console.log('Total Users tab should now be visible');
                });
                
                // Also handle all other tabs the same way to ensure consistency
                $('.nav-link[data-toggle="tab"]').on('click', function(e) {
                    e.preventDefault();
                    const targetId = $(this).attr('href');
                    console.log('Tab clicked:', targetId);
                    
                    // Remove active class from all tabs
                    $('.nav-link').removeClass('active');
                    $('.tab-pane').removeClass('active show');
                    
                    // Add active class to clicked tab and its content
                    $(this).addClass('active');
                    $(targetId).addClass('active show');
                });
            });

            // Load web filter categories when page loads
            loadWebFilterCategories();
            
            // Load last scan results when page loads
            loadLastScanResults();
            
            // Load radio settings when page loads
            loadRadioSettings();

            // Function to load radio settings from database
            function loadRadioSettings() {
                const locationId = getLocationId();
                if (!locationId) {
                    console.log('No location ID found - cannot load radio settings');
                    return;
                }

                console.log('Loading radio settings for location:', locationId);
                
                $.ajax({
                    url: `/api/locations/${locationId}/settings`,
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        console.log('Radio settings loaded:', response);
                        
                        if (response.success && response.data && response.data.settings) {
                            const settings = response.data.settings;
                            
                            // Populate Country/Region
                            if (settings.country_code) {
                                $('#wifi-country').val(settings.country_code);
                            }
                            
                            // Populate 2.4 GHz Power
                            if (settings.transmit_power_2g) {
                                $('#power-level-2g').val(settings.transmit_power_2g);
                            }
                            
                            // Populate 5 GHz Power
                            if (settings.transmit_power_5g) {
                                $('#power-level-5g').val(settings.transmit_power_5g);
                            }
                            
                            // Populate Channel Widths
                            if (settings.channel_width_2g) {
                                $('#channel-width-2g').val(settings.channel_width_2g);
                            }
                            
                            if (settings.channel_width_5g) {
                                $('#channel-width-5g').val(settings.channel_width_5g);
                            }
                            
                            // Populate Channels
                            if (settings.channel_2g) {
                                $('#channel-2g').val(settings.channel_2g);
                            }
                            
                            if (settings.channel_5g) {
                                $('#channel-5g').val(settings.channel_5g);
                            }
                            
                            console.log('Radio settings populated successfully');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Failed to load radio settings:', error);
                        // Don't show error toast as settings might not exist yet
                    }
                });
            }

            // Event handlers for web filter settings
            $('#save-web-filter-settings').on('click', function() {
                saveWebFilterSettings();
            });

            // Event handler for saving radio settings including channels
            $('#save-radio-settings').on('click', function() {
                console.log('Save radio settings clicked');
                
                const locationId = getLocationId();
                if (!locationId) {
                    toastr.error('Location ID not found');
                    return;
                }
                
                // Get all radio settings from the form
                const radioSettings = {
                    wifi_country: $('#wifi-country').val(),
                    power_level_2g: $('#power-level-2g').val(),
                    power_level_5g: $('#power-level-5g').val(),
                    channel_width_2g: $('#channel-width-2g').val(),
                    channel_width_5g: $('#channel-width-5g').val(),
                    channel_2g: parseInt($('#channel-2g').val()),
                    channel_5g: parseInt($('#channel-5g').val())
                };
                
                console.log('Saving radio settings:', radioSettings);
                
                // Show loading state
                const $button = $(this);
                const originalText = $button.html();
                $button.html('<i data-feather="loader" class="mr-1"></i> Saving...').prop('disabled', true);
                
                // Get current channel settings to check if they changed
                getCurrentChannelSettings(locationId)
                    .then(function(currentSettings) {
                        console.log('Current settings for radio save:', currentSettings);
                        
                        const currentChannel2g = currentSettings.channel_2g || null;
                        const currentChannel5g = currentSettings.channel_5g || null;
                        
                        // Check if channels have changed
                        const channelsChanged = (currentChannel2g != radioSettings.channel_2g) || (currentChannel5g != radioSettings.channel_5g);
                        
                        console.log('Radio settings - channels changed:', channelsChanged, {
                            current2g: currentChannel2g,
                            new2g: radioSettings.channel_2g,
                            current5g: currentChannel5g,
                            new5g: radioSettings.channel_5g
                        });
                        
                        // Add config version increment flag to radio settings
                        radioSettings.increment_config_version = channelsChanged;
                        radioSettings.updated_from = 'radio_settings';
                        
                        return saveAllRadioSettings(locationId, radioSettings);
                    })
                    .then(function(response) {
                        console.log('Radio settings saved successfully:', response);
                        
                        // Reset button state
                        $button.html(originalText).prop('disabled', false);
                        
                        // Show success message
                        // The /api/locations/{id} endpoint doesn't return config_version_incremented flag
                        // but the backend will increment it automatically when radio settings change
                        toastr.success('Radio settings saved successfully!', 'Settings Saved', {
                            timeOut: 4000,
                            closeButton: true
                        });
                    })
                    .catch(function(error) {
                        console.error('Failed to save radio settings:', error);
                        
                        // Reset button state
                        $button.html(originalText).prop('disabled', false);
                        
                        toastr.error('Failed to save radio settings. Please try again.');
                    });
            });
            
            // Function to save all radio settings
            function saveAllRadioSettings(locationId, settings) {
                return new Promise(function(resolve, reject) {
                    console.log('Saving all radio settings:', settings);
                    
                    // Prepare the data with settings_type for the backend
                    const requestData = {
                        settings_type: 'router',
                        settings: settings
                    };
                    
                    $.ajax({
                        url: `/api/locations/${locationId}`,
                        method: 'PUT',
                        headers: {
                            'Authorization': 'Bearer ' + UserManager.getToken(),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        data: JSON.stringify(requestData),
                        success: function(response) {
                            console.log('All radio settings saved successfully:', response);
                            resolve(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to save radio settings:', xhr.responseText);
                            reject(error);
                        }
                    });
                });
            }

            // Apply optimal channels (from scan results)
            $('#save-channels-btn').on('click', function() {
                applyOptimalChannels();
            });
            
            // Function to apply optimal channels from last scan
            function applyOptimalChannels() {
                const scanData = window.lastScanResults;
                
                if (!scanData || (!scanData.optimal_channel_2g && !scanData.optimal_channel_5g)) {
                    toastr.error('No optimal channels available. Please run a scan first.', 'No Scan Data');
                    return;
                }
                
                console.log('Applying optimal channels from scan:', scanData);
                
                const optimal2g = scanData.optimal_channel_2g;
                const optimal5g = scanData.optimal_channel_5g;
                
                // Update form fields to show optimal channels
                if (optimal2g) {
                    $('#channel-2g').val(optimal2g);
                }
                if (optimal5g) {
                    $('#channel-5g').val(optimal5g);
                }
                
                // Save channels with scan data
                saveChannelSettings(optimal2g, optimal5g, true, 'channel_optimization');
            }

            // Channel scan button event handler
            $('#scan-channels-btn').on('click', function() {
                console.log('Channel scan button clicked');
                
                // Populate device info in modal
                const locationId = getLocationId();
                if (locationId) {
                    $('#modal-location-id').text(locationId);
                    
                    // Get device info and scan counter
                    loadDeviceInfoForModal(locationId);
                }
                
                $('#channel-scan-modal').modal('show');
            });

            // Channel scan modal event handlers
            $('#start-scan-btn').on('click', function() {
                console.log('Starting channel scan');
                startChannelScan();
            });

            $('#back-to-scan-btn').on('click', function() {
                console.log('Back to scan button clicked');
                showPreScanView();
            });

            $('#apply-scan-results').on('click', function() {
                console.log('Applying scan results');
                applyScanResults();
            });

            // Clean up polling when modal is closed
            $('#channel-scan-modal').on('hidden.bs.modal', function() {
                console.log('Channel scan modal closed, cleaning up polling');
                if (window.scanPollingInterval) {
                    clearInterval(window.scanPollingInterval);
                    window.scanPollingInterval = null;
                }
                
                // Reset to pre-scan view for next time
                showPreScanView();
            });

            // Channel scan functions
            function startChannelScan() {
                console.log('Starting real channel scan process');
                
                const locationId = getLocationId();
                if (!locationId) {
                    toastr.error('Location ID not found');
                    return;
                }
                
                // Hide pre-scan view and show progress view
                $('#pre-scan-view').hide();
                $('#scan-in-progress-view').show();
                $('#scan-results-view').hide();
                
                // Reset progress
                $('.progress-bar').css('width', '0%').attr('aria-valuenow', 0);
                $('.timeline-point-indicator').removeClass('timeline-point-primary timeline-point-success');
                
                // Initialize the first step
                $('#step-initiated-indicator').addClass('timeline-point-primary');
                
                // Initiate scan via API
                $.ajax({
                    url: `/api/locations/${locationId}/scan/initiate`,
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        console.log('Scan initiated successfully:', response);
                        
                        if (response.data && response.data.scan_id) {
                            // Store scan ID for polling
                            window.currentScanId = response.data.scan_id;
                            
                            // Display scan ID prominently
                            $('#current-scan-id').text(response.data.scan_id);
                            
                            // Update the next scan ID counter in pre-scan view for future reference
                            $('#modal-scan-counter').text(response.data.scan_counter || response.data.scan_id);
                            $('#modal-next-scan-id').text((response.data.scan_counter || response.data.scan_id) + 1);
                            
                            // Start polling for scan status
                            pollScanStatus(locationId, response.data.scan_id);
                            
                            toastr.success(`Channel scan initiated! Scan ID: ${response.data.scan_id}`, 'Scan Started', {
                                timeOut: 5000,
                                closeButton: true
                            });
                        } else {
                            console.error('Invalid response format:', response);
                            toastr.error('Failed to initiate scan - invalid response');
                            showPreScanView();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to initiate scan:', error);
                        handleApiError(xhr, status, error, 'initiating channel scan');
                        showPreScanView();
                    }
                });
            }

            function pollScanStatus(locationId, scanId) {
                console.log('Polling scan status for scan ID:', scanId);
                
                // Clear any existing polling interval
                if (window.scanPollingInterval) {
                    clearInterval(window.scanPollingInterval);
                }
                
                window.scanPollingInterval = setInterval(function() {
                    $.ajax({
                        url: `/api/locations/${locationId}/scan/${scanId}/status`,
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + UserManager.getToken(),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            console.log('Scan status:', response);
                            
                            if (response.data) {
                                const data = response.data;
                                
                                // Update progress bar
                                const progress = data.progress || 0;
                                $('.progress-bar').css('width', progress + '%').attr('aria-valuenow', progress);
                                
                                // Update timeline indicators based on status
                                updateTimelineIndicators(data.status);
                                
                                // Check if scan is completed
                                if (data.is_completed) {
                                    clearInterval(window.scanPollingInterval);
                                    console.log('Scan completed, showing results');
                                    showScanResults(data);
                                } else if (data.is_failed) {
                                    clearInterval(window.scanPollingInterval);
                                    console.log('Scan failed:', data.error_message);
                                    toastr.error('Scan failed: ' + (data.error_message || 'Unknown error'));
                                    showPreScanView();
                                }
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to get scan status:', error);
                            clearInterval(window.scanPollingInterval);
                            handleApiError(xhr, status, error, 'getting scan status');
                            showPreScanView();
                        }
                    });
                }, 2000); // Poll every 2 seconds
            }

            function updateTimelineIndicators(status) {
                // Reset all indicators
                $('.timeline-point-indicator').removeClass('timeline-point-primary timeline-point-success');
                
                switch (status) {
                    case 'initiated':
                        $('#step-initiated-indicator').addClass('timeline-point-primary');
                        break;
                    case 'started':
                        $('#step-initiated-indicator').addClass('timeline-point-success');
                        $('#step-started-indicator').addClass('timeline-point-primary');
                        break;
                    case 'scanning_2g':
                        $('#step-initiated-indicator').addClass('timeline-point-success');
                        $('#step-started-indicator').addClass('timeline-point-success');
                        $('#step-2g-indicator').addClass('timeline-point-primary');
                        break;
                    case 'scanning_5g':
                        $('#step-initiated-indicator').addClass('timeline-point-success');
                        $('#step-started-indicator').addClass('timeline-point-success');
                        $('#step-2g-indicator').addClass('timeline-point-success');
                        $('#step-5g-indicator').addClass('timeline-point-primary');
                        break;
                    case 'completed':
                        $('#step-initiated-indicator').addClass('timeline-point-success');
                        $('#step-started-indicator').addClass('timeline-point-success');
                        $('#step-2g-indicator').addClass('timeline-point-success');
                        $('#step-5g-indicator').addClass('timeline-point-success');
                        break;
                }
            }

            function showScanResults(scanData) {
                console.log('Showing scan results with real data:', scanData);
                
                // Hide progress view and show results view
                $('#scan-in-progress-view').hide();
                $('#scan-results-view').show();
                
                // Update result channels with real data
                if (scanData) {
                    const optimal2g = scanData.optimal_channel_2g || 6;
                    const optimal5g = scanData.optimal_channel_5g || 36;
                    
                    $('#result-channel-2g').text(optimal2g);
                    $('#result-channel-5g').text(optimal5g);
                    
                    // Update last scan info
                    $('#last-best-channel-2g').text('Channel ' + optimal2g);
                    $('#last-best-channel-5g').text('Channel ' + optimal5g);
                    
                    if (scanData.completed_at) {
                        $('#last-scan-time').text(new Date(scanData.completed_at).toLocaleString());
                    } else {
                        $('#last-scan-time').text(new Date().toLocaleString());
                    }
                    
                    // Update nearby networks count
                    if (scanData.nearby_networks_2g !== undefined) {
                        $('#nearby-networks-2g').text(scanData.nearby_networks_2g + ' networks');
                    }
                    if (scanData.nearby_networks_5g !== undefined) {
                        $('#nearby-networks-5g').text(scanData.nearby_networks_5g + ' networks');
                    }
                    
                    // Populate nearby networks table with real data
                    populateNearbyNetworksTable(scanData);
                    
                    // Update Channel Optimization display with new scan results
                    updateChannelOptimizationDisplay(scanData);
                    
                    // Store scan results for apply function
                    window.lastScanResults = scanData;
                } else {
                    // Fallback if no data provided
                    const optimal2g = 6;
                    const optimal5g = 36;
                    
                    $('#result-channel-2g').text(optimal2g);
                    $('#result-channel-5g').text(optimal5g);
                    
                    $('#last-best-channel-2g').text('Channel ' + optimal2g);
                    $('#last-best-channel-5g').text('Channel ' + optimal5g);
                    $('#last-scan-time').text(new Date().toLocaleString());
                    
                    // Show fallback data for nearby networks
                    populateNearbyNetworksTable(null);
                }
            }
            
            // Function to populate the nearby networks table with real API data
            function populateNearbyNetworksTable(scanData) {
                console.log('Populating nearby networks table with data:', scanData);
                
                const $tbody = $('#nearby-networks-tbody');
                $tbody.empty();
                
                if (scanData && (scanData.scan_results_2g || scanData.scan_results_5g)) {
                    // Process real API data structure
                    
                    // Group networks by channel from scan results
                    const channelMap = {};
                    
                    // Process 2.4GHz scan results
                    if (scanData.scan_results_2g && Array.isArray(scanData.scan_results_2g)) {
                        scanData.scan_results_2g.forEach(function(network) {
                            const channel = network.channel;
                            const key = `2.4GHz-${channel}`;
                            
                            if (!channelMap[key]) {
                                channelMap[key] = {
                                    band: '2.4 GHz',
                                    channel: channel,
                                    networks: [],
                                    count: 0,
                                    signals: []
                                };
                            }
                            
                            channelMap[key].networks.push(network);
                            channelMap[key].count++;
                            channelMap[key].signals.push(network.signal);
                        });
                    }
                    
                    // Process 5GHz scan results
                    if (scanData.scan_results_5g && Array.isArray(scanData.scan_results_5g)) {
                        scanData.scan_results_5g.forEach(function(network) {
                            const channel = network.channel;
                            const key = `5GHz-${channel}`;
                            
                            if (!channelMap[key]) {
                                channelMap[key] = {
                                    band: '5 GHz',
                                    channel: channel,
                                    networks: [],
                                    count: 0,
                                    signals: []
                                };
                            }
                            
                            channelMap[key].networks.push(network);
                            channelMap[key].count++;
                            channelMap[key].signals.push(network.signal);
                        });
                    }
                    
                    // Add common channels that might not have networks
                    const common2gChannels = [1, 6, 11];
                    const common5gChannels = [36, 40, 44, 48, 149, 153, 157, 161];
                    
                    common2gChannels.forEach(function(channel) {
                        const key = `2.4GHz-${channel}`;
                        if (!channelMap[key]) {
                            channelMap[key] = {
                                band: '2.4 GHz',
                                channel: channel,
                                networks: [],
                                count: 0,
                                signals: []
                            };
                        }
                    });
                    
                    common5gChannels.forEach(function(channel) {
                        const key = `5GHz-${channel}`;
                        if (!channelMap[key]) {
                            channelMap[key] = {
                                band: '5 GHz',
                                channel: channel,
                                networks: [],
                                count: 0,
                                signals: []
                            };
                        }
                    });
                    
                    // Sort channels and create table rows
                    const sortedChannels = Object.values(channelMap).sort(function(a, b) {
                        // Sort by band first (2.4GHz then 5GHz), then by channel number
                        if (a.band !== b.band) {
                            return a.band === '2.4 GHz' ? -1 : 1;
                        }
                        return parseInt(a.channel) - parseInt(b.channel);
                    });
                    
                    sortedChannels.forEach(function(channelData) {
                        const avgSignal = channelData.signals.length > 0 ? 
                            Math.round(channelData.signals.reduce((a, b) => a + b, 0) / channelData.signals.length) + ' dBm' : 
                            'N/A';
                            
                        // Determine interference level based on network count and signal strength
                        let interferenceLevel = 'None';
                        if (channelData.count === 0) {
                            interferenceLevel = 'None';
                        } else if (channelData.count === 1) {
                            interferenceLevel = 'Low';
                        } else if (channelData.count <= 3) {
                            interferenceLevel = 'Medium';
                        } else {
                            interferenceLevel = 'High';
                        }
                        
                        // Check if this is the optimal channel
                        const isOptimal = (channelData.band === '2.4 GHz' && channelData.channel == scanData.optimal_channel_2g) ||
                                        (channelData.band === '5 GHz' && channelData.channel == scanData.optimal_channel_5g);
                        
                        const row = createNetworkTableRow(
                            channelData.band,
                            channelData.channel,
                            channelData.count,
                            avgSignal,
                            interferenceLevel,
                            isOptimal
                        );
                        $tbody.append(row);
                    });
                    
                } else {
                    // Fallback: show sample data structure
                    console.log('No scan data available, showing sample structure');
                    
                    const fallbackData = [
                        { band: '2.4 GHz', channel: 1, networks: 3, signal: '-45 dBm', interference: 'Medium' },
                        { band: '2.4 GHz', channel: 6, networks: 1, signal: '-38 dBm', interference: 'Low' },
                        { band: '2.4 GHz', channel: 11, networks: 2, signal: '-52 dBm', interference: 'Medium' },
                        { band: '5 GHz', channel: 36, networks: 1, signal: '-41 dBm', interference: 'Low' },
                        { band: '5 GHz', channel: 44, networks: 2, signal: '-48 dBm', interference: 'Medium' }
                    ];
                    
                    fallbackData.forEach(function(data) {
                        const row = createNetworkTableRow(
                            data.band,
                            data.channel,
                            data.networks,
                            data.signal,
                            data.interference,
                            false
                        );
                        $tbody.append(row);
                    });
                }
                
                // Show message if no scan data found
                if ($tbody.children().length === 0) {
                    $tbody.append(`
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <i data-feather="wifi-off" class="mr-2"></i>
                                No channel scan data available
                            </td>
                        </tr>
                    `);
                }
                
                // Re-initialize feather icons
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
            
            // Helper function to create a table row for network data
            function createNetworkTableRow(band, channel, networkCount, signalStrength, interferenceLevel, isOptimal = false) {
                const interferenceClass = getInterferenceClass(interferenceLevel);
                const interferenceIcon = getInterferenceIcon(interferenceLevel);
                const rowClass = isOptimal ? 'table-success' : '';
                const networkBadgeClass = networkCount === 0 ? 'badge-light-success' : 'badge-light-info';
                
                let statusBadge = '';
                if (isOptimal) {
                    statusBadge = '<span class="badge badge-success"><i data-feather="star" class="mr-1" style="width: 12px; height: 12px;"></i>Optimal</span>';
                } else if (networkCount === 0) {
                    statusBadge = '<span class="badge badge-light-success"><i data-feather="check" class="mr-1" style="width: 12px; height: 12px;"></i>Available</span>';
                } else if (networkCount >= 4) {
                    statusBadge = '<span class="badge badge-light-danger"><i data-feather="wifi" class="mr-1" style="width: 12px; height: 12px;"></i>Crowded</span>';
                } else if (networkCount >= 2) {
                    statusBadge = '<span class="badge badge-light-warning"><i data-feather="radio" class="mr-1" style="width: 12px; height: 12px;"></i>Busy</span>';
                } else {
                    statusBadge = '<span class="badge badge-light-info"><i data-feather="radio" class="mr-1" style="width: 12px; height: 12px;"></i>In Use</span>';
                }
                
                return `
                    <tr class="${rowClass}">
                        <td><span class="badge badge-light-${band === '2.4 GHz' ? 'primary' : 'success'}">${band}</span></td>
                        <td><strong>${channel}</strong></td>
                        <td>
                            <span class="badge ${networkBadgeClass}">${networkCount} network${networkCount !== 1 ? 's' : ''}</span>
                        </td>
                        <td>${signalStrength}</td>
                        <td>
                            <span class="badge badge-${interferenceClass}">
                                <i data-feather="${interferenceIcon}" class="mr-1" style="width: 12px; height: 12px;"></i>
                                ${interferenceLevel}
                            </span>
                        </td>
                        <td>${statusBadge}</td>
                    </tr>
                `;
            }
            
            // Helper function to get interference badge class
            function getInterferenceClass(level) {
                switch (level.toLowerCase()) {
                    case 'none': return 'light-success';
                    case 'low': return 'light-success';
                    case 'medium': return 'light-warning';
                    case 'high': return 'light-danger';
                    default: return 'light-secondary';
                }
            }
            
            // Helper function to get interference icon
            function getInterferenceIcon(level) {
                switch (level.toLowerCase()) {
                    case 'none': return 'check-circle';
                    case 'low': return 'check-circle';
                    case 'medium': return 'alert-triangle';
                    case 'high': return 'x-circle';
                    default: return 'help-circle';
                }
            }
            
            // Helper function to calculate interference level from signal strength
            function calculateInterferenceLevel(signalStrength) {
                if (typeof signalStrength === 'string') {
                    const dbm = parseInt(signalStrength.replace(/[^\d-]/g, ''));
                    if (dbm > -40) return 'High';
                    if (dbm > -60) return 'Medium';
                    return 'Low';
                }
                return 'Unknown';
            }

            function showPreScanView() {
                console.log('Showing pre-scan view');
                
                // Stop any ongoing polling
                if (window.scanPollingInterval) {
                    clearInterval(window.scanPollingInterval);
                    window.scanPollingInterval = null;
                }
                
                // Show pre-scan view and hide others
                $('#pre-scan-view').show();
                $('#scan-in-progress-view').hide();
                $('#scan-results-view').hide();
                
                // Reset progress and timeline
                $('.progress-bar').css('width', '0%').attr('aria-valuenow', 0);
                $('.timeline-point-indicator').removeClass('timeline-point-primary timeline-point-success');
            }

            function applyScanResults() {
                console.log('Applying scan results');
                
                const newChannel2g = $('#result-channel-2g').text();
                const newChannel5g = $('#result-channel-5g').text();
                const locationId = getLocationId();
                
                if (!locationId) {
                    toastr.error('Location ID not found');
                    return;
                }
                
                // Show loading state
                const $button = $('#apply-scan-results');
                const originalText = $button.html();
                $button.html('<i data-feather="loader" class="mr-1"></i> Applying...').prop('disabled', true);
                
                // Get current channel settings first
                getCurrentChannelSettings(locationId)
                    .then(function(currentSettings) {
                        console.log('Current channel settings:', currentSettings);
                        
                        const currentChannel2g = currentSettings.channel_2g || null;
                        const currentChannel5g = currentSettings.channel_5g || null;
                        
                        // Check if channels have changed
                        const channelsChanged = (currentChannel2g != newChannel2g) || (currentChannel5g != newChannel5g);
                        
                        console.log('Channels changed:', channelsChanged, {
                            current2g: currentChannel2g,
                            new2g: newChannel2g,
                            current5g: currentChannel5g,
                            new5g: newChannel5g
                        });
                        
                        // Save the new channel settings
                        return saveChannelSettings(locationId, newChannel2g, newChannel5g, channelsChanged);
                    })
                    .then(function(response) {
                        console.log('Channel settings saved successfully:', response);
                        
                        // Update the main form with optimal channels
                        $('#channel-2g').val(newChannel2g);
                        $('#channel-5g').val(newChannel5g);
                        
                        // Reset button state
                        $button.html(originalText).prop('disabled', false);
                        
                        // Close modal
                        $('#channel-scan-modal').modal('hide');
                        
                        // Show success message
                        if (response.config_version_incremented) {
                            toastr.success(`Optimal channels applied and saved: 2.4GHz Channel ${newChannel2g}, 5GHz Channel ${newChannel5g}. Config version incremented to ${response.new_config_version}.`, 'Channels Updated', {
                                timeOut: 6000,
                                closeButton: true
                            });
                        } else {
                            toastr.success(`Optimal channels applied: 2.4GHz Channel ${newChannel2g}, 5GHz Channel ${newChannel5g}. No changes detected.`, 'Channels Applied', {
                                timeOut: 4000,
                                closeButton: true
                            });
                        }
                    })
                    .catch(function(error) {
                        console.error('Failed to apply scan results:', error);
                        
                        // Reset button state
                        $button.html(originalText).prop('disabled', false);
                        
                        toastr.error('Failed to save channel settings. Please try again.');
                    });
            }
            
            // Function to get current channel settings from location_settings
            function getCurrentChannelSettings(locationId) {
                return new Promise(function(resolve, reject) {
                    $.ajax({
                        url: `/api/locations/${locationId}/settings`,
                        method: 'GET',
                        headers: {
                            'Authorization': 'Bearer ' + UserManager.getToken(),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        success: function(response) {
                            console.log('Current location settings response:', response);
                            
                            let settings = {};
                            if (response.data && response.data.settings) {
                                settings = response.data.settings;
                            } else if (response.settings) {
                                settings = response.settings;
                            }
                            
                            resolve({
                                channel_2g: settings.channel_2g || null,
                                channel_5g: settings.channel_5g || null,
                                config_version: settings.config_version || 1
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to get current channel settings:', error);
                            // If we can't get current settings, assume no previous channels
                            resolve({
                                channel_2g: null,
                                channel_5g: null,
                                config_version: 1
                            });
                        }
                    });
                });
            }
            
            // Function to save channel settings to location_settings
            function saveChannelSettings(locationId, channel2g, channel5g, shouldIncrementVersion) {
                return new Promise(function(resolve, reject) {
                    const settingsData = {
                        channel_2g: parseInt(channel2g),
                        channel_5g: parseInt(channel5g),
                        increment_config_version: shouldIncrementVersion,
                        updated_from: 'channel_scan'
                    };
                    
                    console.log('Saving channel settings:', settingsData);
                    
                    $.ajax({
                        url: `/api/locations/${locationId}/settings`,
                        method: 'PUT',
                        headers: {
                            'Authorization': 'Bearer ' + UserManager.getToken(),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        data: JSON.stringify(settingsData),
                        success: function(response) {
                            console.log('Channel settings saved successfully:', response);
                            resolve(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Failed to save channel settings:', xhr.responseText);
                            reject(error);
                        }
                    });
                });
            }

            // Enable/disable category selector based on main switch
            $('#global-web-filter').on('change', function() {
                const isEnabled = $(this).is(':checked');
                $('#global-filter-categories').prop('disabled', !isEnabled);
                
                if (isEnabled) {
                    $('#global-filter-categories').select2('enable');
                } else {
                    $('#global-filter-categories').select2('disable');
                }
            });
            
            // Function to load last scan results
            function loadLastScanResults() {
                const locationId = getLocationId();
                if (!locationId) {
                    console.log('No location ID found - cannot load last scan results');
                    return;
                }

                console.log('Loading last scan results for location:', locationId);
                
                // First try to get the latest scan results directly
                $.ajax({
                    url: `/api/locations/${locationId}/scan-results/latest`,
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        console.log('Last scan results loaded:', response);
                        
                        if (response.data) {
                            const scanData = response.data;
                            updateChannelOptimizationDisplay(scanData);
                        } else {
                            console.log('No previous scan results found');
                            updateChannelOptimizationDisplay(null);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Failed to load last scan results from scan-results endpoint, trying alternative:', error);
                        
                        // Fallback: try to get scan history directly
                        $.ajax({
                            url: `/api/locations/${locationId}/scans`,
                            method: 'GET',
                            headers: {
                                'Authorization': 'Bearer ' + UserManager.getToken(),
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            success: function(scansResponse) {
                                console.log('Scans history loaded:', scansResponse);
                                
                                // Look for the most recent completed scan
                                if (scansResponse.data && scansResponse.data.length > 0) {
                                    // Find the most recent completed scan
                                    const completedScans = scansResponse.data.filter(scan => scan.is_completed && !scan.is_failed);
                                    if (completedScans.length > 0) {
                                        // Sort by completed_at or created_at descending and take the first
                                        completedScans.sort((a, b) => {
                                            const aDate = new Date(a.completed_at || a.created_at);
                                            const bDate = new Date(b.completed_at || b.created_at);
                                            return bDate - aDate;
                                        });
                                        
                                        const latestScan = completedScans[0];
                                        console.log('Found latest completed scan:', latestScan);
                                        updateChannelOptimizationDisplay(latestScan);
                                    } else {
                                        console.log('No completed scans found in scan history');
                                        updateChannelOptimizationDisplay(null);
                                    }
                                } else {
                                    console.log('No scan history found');
                                    updateChannelOptimizationDisplay(null);
                                }
                            },
                            error: function(xhr2, status2, error2) {
                                console.log('Failed to load scan history:', error2);
                                updateChannelOptimizationDisplay(null);
                            }
                        });
                    }
                });
            }
            
            // Function to update the Channel Optimization display
            function updateChannelOptimizationDisplay(scanData) {
                console.log('Updating channel optimization display with:', scanData);
                
                if (scanData && scanData.is_completed && !scanData.is_failed) {
                    // Update optimal channels
                    $('#last-optimal-2g').text(scanData.optimal_channel_2g || '--');
                    $('#last-optimal-5g').text(scanData.optimal_channel_5g || '--');
                    
                    // Update timestamp
                    if (scanData.completed_at) {
                        const scanDate = new Date(scanData.completed_at);
                        const timeAgo = getTimeAgo(scanDate);
                        $('#last-scan-timestamp').text(`Last scan: ${timeAgo}`);
                    } else {
                        $('#last-scan-timestamp').text('Scan completed recently');
                    }
                    
                    // Update status alert
                    $('#scan-status-alert').removeClass('alert-info alert-warning').addClass('alert-success');
                    $('#scan-status-text').html('Optimal channels available from last scan.');
                    
                    // Enable Apply button
                    $('#save-channels-btn').prop('disabled', false);
                    
                    // Update the main channel form fields with optimal values
                    if (scanData.optimal_channel_2g) {
                        $('#channel-2g').val(scanData.optimal_channel_2g);
                    }
                    if (scanData.optimal_channel_5g) {
                        $('#channel-5g').val(scanData.optimal_channel_5g);
                    }
                    
                    // Store scan results globally for other functions to use
                    window.lastScanResults = scanData;
                    
                } else if (scanData && scanData.is_failed) {
                    // Scan failed
                    $('#last-optimal-2g').text('--');
                    $('#last-optimal-5g').text('--');
                    $('#last-scan-timestamp').text('Last scan failed');
                    $('#scan-status-alert').removeClass('alert-info alert-success').addClass('alert-warning');
                    $('#scan-status-text').html('<i data-feather="alert-triangle" class="mr-2"></i>Previous scan failed. Try scanning again.');
                    $('#save-channels-btn').prop('disabled', true);
                    
                } else {
                    // No scan data available
                    $('#last-optimal-2g').text('--');
                    $('#last-optimal-5g').text('--');
                    $('#last-scan-timestamp').text('No scan performed yet');
                    $('#scan-status-alert').removeClass('alert-success alert-warning').addClass('alert-info');
                    $('#scan-status-text').html('<i data-feather="info" class="mr-2"></i>Click Scan to analyze optimal channels.');
                    $('#save-channels-btn').prop('disabled', true);
                }
                
                // Re-initialize feather icons
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
            }
            
            // Helper function to get time ago string
            function getTimeAgo(date) {
                const now = new Date();
                const diffMs = now - date;
                const diffMins = Math.floor(diffMs / 60000);
                const diffHours = Math.floor(diffMs / 3600000);
                const diffDays = Math.floor(diffMs / 86400000);
                
                if (diffMins < 1) return 'just now';
                if (diffMins < 60) return `${diffMins} minute${diffMins > 1 ? 's' : ''} ago`;
                if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
                if (diffDays < 7) return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
                
                return date.toLocaleDateString() + ' at ' + date.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
            }
            
            // Test API call for debugging
            console.log('Testing API authentication...');
            $.ajax({
                url: '/api/locations',
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + UserManager.getToken(),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    console.log('API Test Success:', response);
                },
                error: function(xhr, status, error) {
                    console.log('API Test Failed:', {
                        status: xhr.status,
                        statusText: xhr.statusText,
                        responseText: xhr.responseText,
                        error: error
                    });
                }
            });
            
            // Debug: Test all possible scan endpoints
            const locationId = getLocationId();
            if (locationId) {
                console.log('=== DEBUGGING SCAN ENDPOINTS FOR LOCATION:', locationId, '===');
                
                // Test 1: scan-results/latest
                $.ajax({
                    url: `/api/locations/${locationId}/scan-results/latest`,
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        console.log('✅ /scan-results/latest SUCCESS:', response);
                        if (response.data) {
                            console.log('🎯 Found scan data in latest endpoint, testing update...');
                            updateChannelOptimizationDisplay(response.data);
                        }
                    },
                    error: function(xhr) {
                        console.log('❌ /scan-results/latest FAILED:', xhr.status, xhr.responseText);
                    }
                });
                
                // Test 2: scans endpoint
                $.ajax({
                    url: `/api/locations/${locationId}/scans`,
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + UserManager.getToken(),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        console.log('✅ /scans SUCCESS:', response);
                        if (response.data && response.data.length > 0) {
                            console.log('🎯 Found scan history, testing with latest completed scan...');
                            const completedScans = response.data.filter(scan => scan.is_completed && !scan.is_failed);
                            if (completedScans.length > 0) {
                                completedScans.sort((a, b) => {
                                    const aDate = new Date(a.completed_at || a.created_at);
                                    const bDate = new Date(b.completed_at || b.created_at);
                                    return bDate - aDate;
                                });
                                console.log('📊 Testing with latest scan:', completedScans[0]);
                                updateChannelOptimizationDisplay(completedScans[0]);
                            }
                        }
                    },
                    error: function(xhr) {
                        console.log('❌ /scans FAILED:', xhr.status, xhr.responseText);
                    }
                });
                
                console.log('=== END DEBUGGING ===');
            }
        });
    </script>
    </body>
<!-- END: Body-->
</html>
</html>