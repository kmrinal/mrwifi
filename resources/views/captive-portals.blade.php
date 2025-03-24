<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Mr WiFi cloud controller dashboard for managing and monitoring WiFi networks.">
    <meta name="keywords" content="wifi, cloud controller, network management, mrwifi">
    <meta name="author" content="Mr WiFi">
    <title>Captive Portal Designer - Mr WiFi Controller</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/mrwifi-assets/MrWifi.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.min.css">
    <!-- END: Vendor CSS-->
    
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/charts/chart-apex.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/ext-component-toastr.css">
    <!-- END: Page CSS-->
    
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->
    
    <!-- Custom styles for captive portal designer -->
    <style>
        .upload-area {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 1rem;
        }
        
        .upload-area:hover {
            border-color: #7367f0;
            background-color: rgba(115, 103, 240, 0.05);
        }
        
        .upload-icon {
            font-size: 2.5rem;
            color: #7367f0;
            margin-bottom: 1rem;
        }
        
        .color-picker-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .color-preview {
            width: 30px;
            height: 30px;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }
        
        .image-preview {
            width: 100%;
            max-height: 150px;
            object-fit: contain;
            margin-top: 10px;
            border-radius: 5px;
            display: none;
        }
        
        .preview-container {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .preview-header {
            background-color: #f8f9fa;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }
        
        .portal-preview {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
            max-width: 100%;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 32px;
        }
        
        .location-logo {
            height: 64px;
            width: auto;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            color: #666;
            padding: 0 16px;
        }
        
        .welcome-text {
            color: #333;
            font-size: 0.95rem;
            line-height: 1.5;
            margin: 24px 0 32px;
            text-align: center;
        }
        
        .login-placeholder {
            background: #f8f8f8;
            border: 2px dashed #ddd;
            border-radius: 12px;
            padding: 32px;
            text-align: center;
            color: #666;
            margin-bottom: 24px;
            flex-grow: 1;
        }

        .login-placeholder-footer {
            background: #ffffff;
            border: 0px;
            border-radius: 12px;
            padding: 10px;
            text-align: center;
            color: #666;
            margin-bottom: 10px;
            flex-grow: 1;
        }
        
        .footer {
            margin-top: auto;
            /*text-align: center;
            border-top: 1px solid #eee;*/
            padding-top: 24px;
            margin-left: 0px;
            margin-right: 0px;
        }
        
        .brand-logo {
            height: 32px;
            width: auto;
            margin: 0 auto 16px;
            background: #f0f0f0;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            padding: 0 12px;
        }
        
        .terms {
            font-size: 0.8rem;
            color: #666;
        }
        
        .terms a {
            color: #007bff;
            text-decoration: none;
        }
        
        /* Design cards styles */
        .design-card {
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid #e0e0e0;
        }
        
        .design-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .design-preview {
            height: 180px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }
        
        .design-preview .preview-content {
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .location-logo-mini {
            height: 24px;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }
        
        .login-area-mini {
            flex-grow: 1;
            background: rgba(248, 248, 248, 0.8);
            border: 1px dashed #ddd;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #666;
            margin: 8px 0;
        }
        
        .brand-logo-mini {
            height: 20px;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
        
        .design-card:hover .design-preview {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }

        #preview-button {
            transition: all 0.3s ease;
            padding: 10px 20px;
            font-size: 14px;
        }

        .terms-container {
            margin-top: 15px;
            text-align: center;
        }

        .section-label {
            font-weight: 600;
            color: #5e5873;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
        }

        .design-card {
            transition: all 0.3s ease;
            border: 1px solid #ebe9f1;
        }

        .design-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
        }

        .design-preview {
            height: 160px;
            border-radius: 6px;
            overflow: hidden;
            position: relative;
        }

        .preview-content {
            padding: 1rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .design-actions {
            padding-top: 0.5rem;
            border-top: 1px solid #ebe9f1;
        }

        .badge {
            font-size: 0.8rem;
            font-weight: 500;
        }

        .bg-light-primary {
            background-color: rgba(115, 103, 240, 0.12) !important;
        }

        .bg-light-success {
            background-color: rgba(40, 199, 111, 0.12) !important;
        }

        .bg-light-danger {
            background-color: rgba(234, 84, 85, 0.12) !important;
        }

        .tab-content h6 {
            color: #5e5873;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #ebe9f1;
            padding-bottom: 0.5rem;
        }

        .color-picker-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            max-width: 300px;
        }

        .form-control-color {
            width: 60px;
            padding: 0.2rem;
            height: 38px;
        }   

        .card-fullscreen {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100% !important;
            height: 100% !important;
            max-width: 100% !important;
            max-height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            z-index: 2000 !important;
            background: #fff;
        }

        .card-fullscreen .card-body {
            height: calc(100% - 60px); /* Adjust for card header height */
            overflow-y: auto;
        }

        .card-fullscreen .portal-preview {
            max-width: 500px; /* Or your desired width */
            margin: 20px auto;
        }
    </style>
</head>

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
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <!-- Notification content here -->
                    </ul>
                </li>
                
                <!-- User dropdown -->
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder"></span><span class="user-status"></span></div>
                        <span class="avatar"><img class="round" src="app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
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
                            <img src="../../../app-assets/mrwifi-assets/Mr-Wifi.PNG" alt="Mr WiFi logo">
                        </span>
                        <h2 class="brand-text">Mr WiFi</h2>
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
                <li class="nav-item">
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

                <li class="nav-item active">
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
                            <h2 class="content-header-title float-left mb-0">Captive Portal Designer</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/dashboard">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Captive Portals
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="content-body">
                <!-- Captive Portal Designs List -->
                <section id="captive-portal-designs-list">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Your Captive Portal Designs</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <button type="button" class="btn btn-primary waves-effect waves-float waves-light" id="create-new-design">
                                                    <i data-feather="plus" class="mr-50"></i>
                                                    <span>Create New Design</span>
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" id="portal-designs-container">
                                        <!-- Design Cards -->
                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <div class="card design-card">
                                                <div class="card-body p-2">
                                                    <div class="design-preview bg-light-primary">
                                                        <div class="preview-content">
                                                            <div class="location-logo-mini">
                                                                <img src="{{ asset('assets/starbucks.png') }}" alt="Mr WiFi" style="max-height: 20px;">
                                                            </div>
                                                            <div class="login-area-mini">Design 1</div>
                                                            <div class="brand-logo-mini">
                                                                <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="Mr WiFi" style="max-height: 30px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-1">
                                                        <h5 class="mb-0">WiFi Portal 1</h5>
                                                        <small class="text-muted">Last modified: 2024-03-20</small>
                                                    </div>
                                                    <div class="design-actions mt-1 d-flex justify-content-between align-items-center">
                                                        <button class="btn btn-sm btn-outline-primary edit-design" data-id="1">
                                                            <i data-feather="edit-2" class="mr-25"></i> Edit
                                                        </button>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-icon btn-outline-secondary" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" onclick="duplicateDesign(1)">
                                                                    <i data-feather="copy" class="mr-50"></i> Duplicate
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="#" onclick="deleteDesign(1)">
                                                                    <i data-feather="trash-2" class="mr-50"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Repeat for other 3 designs with different colors and numbers -->
                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <div class="card design-card">
                                                <div class="card-body p-2">
                                                    <div class="design-preview bg-light-success">
                                                        <div class="preview-content">
                                                            <div class="location-logo-mini">
                                                                <img src="{{ asset('assets/mcd.png') }}" alt="Mr WiFi" style="max-height: 20px;">
                                                            </div>
                                                            <div class="login-area-mini">Design 2</div>
                                                            <div class="brand-logo-mini">
                                                                <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="Mr WiFi" style="max-height: 15px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-1">
                                                        <h5 class="mb-0">WiFi Portal 2</h5>
                                                        <small class="text-muted">Last modified: 2024-03-19</small>
                                                    </div>
                                                    <div class="design-actions mt-1 d-flex justify-content-between align-items-center">
                                                        <button class="btn btn-sm btn-outline-primary edit-design" data-id="2">
                                                            <i data-feather="edit-2" class="mr-25"></i> Edit
                                                        </button>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-icon btn-outline-secondary" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" onclick="duplicateDesign(2)">
                                                                    <i data-feather="copy" class="mr-50"></i> Duplicate
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="#" onclick="deleteDesign(2)">
                                                                    <i data-feather="trash-2" class="mr-50"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <div class="card design-card">
                                                <div class="card-body p-2">
                                                    <div class="design-preview bg-light-danger">
                                                        <div class="preview-content">
                                                            <div class="location-logo-mini">
                                                                <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="Mr WiFi" style="max-height: 20px;">
                                                            </div>
                                                            <div class="login-area-mini">Design 3</div>
                                                            <div class="brand-logo-mini">
                                                                <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="Mr WiFi" style="max-height: 15px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-1">
                                                        <h5 class="mb-0">WiFi Portal 3</h5>
                                                        <small class="text-muted">Last modified: 2024-03-18</small>
                                                    </div>
                                                    <div class="design-actions mt-1 d-flex justify-content-between align-items-center">
                                                        <button class="btn btn-sm btn-outline-primary edit-design" data-id="3">
                                                            <i data-feather="edit-2" class="mr-25"></i> Edit
                                                        </button>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-icon btn-outline-secondary" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" onclick="duplicateDesign(3)">
                                                                    <i data-feather="copy" class="mr-50"></i> Duplicate
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="#" onclick="deleteDesign(3)">
                                                                    <i data-feather="trash-2" class="mr-50"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6 mb-2">
                                            <div class="card design-card">
                                                <div class="card-body p-2">
                                                    <div class="design-preview bg-light-info">
                                                        <div class="preview-content">
                                                            <div class="location-logo-mini">
                                                                <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="Mr WiFi" style="max-height: 20px;">
                                                            </div>
                                                            <div class="login-area-mini">Design 4</div>
                                                            <div class="brand-logo-mini">
                                                                <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="Mr WiFi" style="max-height: 15px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-1">
                                                        <h5 class="mb-0">WiFi Portal 4</h5>
                                                        <small class="text-muted">Last modified: 2024-03-17</small>
                                                    </div>
                                                    <div class="design-actions mt-1 d-flex justify-content-between align-items-center">
                                                        <button class="btn btn-sm btn-outline-primary edit-design" data-id="4">
                                                            <i data-feather="edit-2" class="mr-25"></i> Edit
                                                        </button>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-icon btn-outline-secondary" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="#" onclick="duplicateDesign(4)">
                                                                    <i data-feather="copy" class="mr-50"></i> Duplicate
                                                                </a>
                                                                <a class="dropdown-item text-danger" href="#" onclick="deleteDesign(4)">
                                                                    <i data-feather="trash-2" class="mr-50"></i> Delete
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Captive Portal Design Content Starts - Initially hidden -->
                <section id="captive-portal-designer" style="display: none;">
                    <div class="row">
                        <div class="col-12 mb-1">
                            <button class="btn btn-outline-secondary waves-effect" id="back-to-list">
                                <i data-feather="arrow-left" class="mr-50"></i>
                                <span>Back to Designs</span>
                            </button>
                        </div>
                    </div>
                    <div class="row match-height">
                        <div class="col-lg-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Design Your Login Page</h4>
                                    <div class="heading-elements">
                                        
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" aria-controls="general" role="tab" aria-selected="true">
                                                <i data-feather="settings" class="mr-25"></i>
                                                <span class="font-weight-bold">General</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="branding-tab" data-toggle="tab" href="#branding" aria-controls="branding" role="tab" aria-selected="false">
                                                <i data-feather="image" class="mr-25"></i>
                                                <span class="font-weight-bold">Branding</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <!-- General Tab (now includes content settings) -->
                                        <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
                                            <form class="mt-2">
                                                <div class="row">
                                                    <div class="col-12 mb-1">
                                                        <h6 class="mb-1">Basic Information</h6>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="portal-name">Portal Name</label>
                                                            <input type="text" class="form-control" id="portal-name" placeholder="Enter a name for this login page">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="portal-description">Description</label>
                                                            <textarea class="form-control" id="portal-description" rows="2" placeholder="Brief description of this design"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="theme-color">Theme Color</label>
                                                            <div class="color-picker-container">
                                                                <input type="color" class="form-control form-control-color" id="theme-color" value="#7367f0">
                                                                <div class="color-preview" style="background-color: #7367f0;"></div>
                                                                <span class="color-value">#7367f0</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 mt-2 mb-1">
                                                        <h6 class="mb-1">Portal Content</h6>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="welcome-message">Welcome Message</label>
                                                            <input type="text" class="form-control" id="welcome-message" placeholder="Welcome to our WiFi" value="Welcome to our WiFi">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="button-text">Button Text</label>
                                                            <input type="text" class="form-control" id="button-text" placeholder="Connect to WiFi" value="Connect to WiFi">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-1">
                                                        <div class="form-group">
                                                            <label for="login-instructions">Login Instructions</label>
                                                            <textarea class="form-control" id="login-instructions" rows="2" placeholder="Enter your email to connect to our WiFi network">Enter your email to connect to our WiFi network</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="show-terms" checked>
                                                                <label class="custom-control-label" for="show-terms">Show Terms & Conditions Link</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <!-- Branding Tab -->
                                        <div class="tab-pane" id="branding" aria-labelledby="branding-tab" role="tabpanel">
                                            <form class="mt-2">
                                                <div class="row">
                                                    <div class="col-12 mb-2">
                                                        <div class="form-group">
                                                            <label for="location-logo">Location Logo</label>
                                                            <div class="upload-area" id="location-logo-upload">
                                                                <i data-feather="upload-cloud" class="upload-icon"></i>
                                                                <h5 class="upload-text">Drop your location logo here or click to browse</h5>
                                                                <p class="text-muted small">Recommended: PNG or SVG, 200x100px</p>
                                                                <input type="file" id="location-logo-file" class="d-none" accept="image/*">
                                                            </div>
                                                            <img src="" id="location-logo-preview" class="image-preview">
                                                            <p class="note">Your location logo will appear at the top of the login page.</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mb-2">
                                                        <div class="form-group">
                                                            <label for="background-image">Background Image</label>
                                                            <div class="upload-area" id="background-upload">
                                                                <i data-feather="image" class="upload-icon"></i>
                                                                <h5 class="upload-text">Drop your background image here or click to browse</h5>
                                                                <p class="text-muted small">Recommended: JPG or PNG, 1920x1080px</p>
                                                                <input type="file" id="background-file" class="d-none" accept="image/*">
                                                            </div>
                                                            <img src="" id="background-preview" class="image-preview">
                                                            <p class="note">This image will be displayed as the page background.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add this new preview column -->
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Preview</h4>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li>
                                                <a data-action="reload"><i data-feather="rotate-cw"></i></a>
                                            </li>
                                            <li>
                                                <a data-action="expand" id="expand-preview"><i data-feather="maximize"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="portal-preview">
                                        <div class="header">
                                            <div class="location-logo" id="preview-location-logo">
                                                <img src="{{ asset('assets/starbucks.png') }}" alt="Mr WiFi" style="max-height: 60px; width: auto;">
                                            </div>
                                            <div class="welcome-text" id="preview-welcome">Welcome to our WiFi</div>
                                        </div>
                                        <div class="login-placeholder">
                                            <p id="preview-instructions">Click Below to Login</p>
                                            <button class="btn btn-primary w-100 mb-2" id="preview-button">Connect to WiFi</button>
                                            <div class="terms-container" id="preview-terms-container">
                                                <small class="terms">
                                                    By connecting, you agree to our <a href="#">Terms & Conditions</a>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="login-placeholder-footer" style="text-align: center;background-color: #ffffff;border:0px;">
                                            <p class="mb-0">Powered by</p>
                                            <img src="{{ asset('app-assets/mrwifi-assets/Mr-Wifi.PNG') }}" alt="Mr WiFi" style="max-height: 40px; width: auto;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <!-- Make sure jQuery is loaded first -->
    <script src="{{ asset('app-assets/vendors/js/jquery/jquery.min.js') }}"></script>
    <!-- Then load Bootstrap bundle which includes Popper.js -->
    <script src="{{ asset('app-assets/vendors/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- Load other vendor scripts -->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Vendor JS-->

    <!-- BEGIN: Theme JS -->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS -->

    <script>
        // Add this to ensure DOM is fully loaded before running scripts
        $(document).ready(function() {
            // Initialize feather icons
            if (typeof feather !== 'undefined') {
                    feather.replace();
            }

            // Check if user object exists before trying to access it
            if (typeof user !== 'undefined') {
                $('.user-name').text(user.name);
                $('.user-status').text(user.role);
            }

            // Live preview updates
            $('#welcome-message').on('input', function() {
                $('#preview-welcome').text($(this).val());
            });

            $('#login-instructions').on('input', function() {
                $('#preview-instructions').text($(this).val());
            });

            $('#button-text').on('input', function() {
                $('#preview-button').text($(this).val());
            });

            $('#theme-color').on('input', function() {
                const color = $(this).val();
                $('#preview-button').css({
                    'background-color': color,
                    'border-color': color
                });
            });

            $('#show-terms').on('change', function() {
                $('#preview-terms-container').toggle(this.checked);
            });

            // Update preview when uploading images
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = $(`#${previewId}`);
                        preview.html(`<img src="${e.target.result}" style="max-width: 100%; height: auto;">`);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#location-logo-file').on('change', function() {
                readURL(this, 'preview-location-logo');
            });

            $('#background-file').on('change', function() {
                readURL(this, 'preview-background');
            });

            // Handle expand preview functionality
            $('[data-action="expand"]').on('click', function(e) {
                e.preventDefault();
                const $previewCard = $(this).closest('.card');
                
                if ($previewCard.hasClass('card-fullscreen')) {
                    // Exit fullscreen
                    $previewCard.removeClass('card-fullscreen');
                    $(this).find('i').replaceWith(feather.icons['maximize'].toSvg());
                } else {
                    // Enter fullscreen
                    $previewCard.addClass('card-fullscreen');
                    $(this).find('i').replaceWith(feather.icons['minimize'].toSvg());
                }
                
                // Re-initialize feather icons
                feather.replace();
            });
        });

        // Function to load a design for editing
        function loadDesignForEditing(designId) {
            // Show the designer section and hide the list
            $('#captive-portal-designs-list').hide();
            $('#captive-portal-designer').show();

            // Load design data based on the designId
            let designData;
            
            switch(designId) {
                case 'default':
                    designData = {
                        name: 'Minimal Login',
                        description: 'Clean and minimal login page design',
                        theme_color: '#7367f0',
                        welcome_message: 'Welcome to our WiFi network',
                        login_instructions: 'Enter your email to connect to our WiFi network',
                        button_text: 'Connect to WiFi',
                        show_terms: true
                    };
                    break;
                case 'business':
                    designData = {
                        name: 'Business Portal',
                        description: 'Professional design for business environments',
                        theme_color: '#28c76f',
                        welcome_message: 'Welcome to our Business WiFi',
                        login_instructions: 'Please enter your business email to connect',
                        button_text: 'Connect Securely',
                        show_terms: true
                    };
                    break;
                // Add other cases as needed
            }

            // Populate form fields with design data
            if (designData) {
                $('#portal-name').val(designData.name);
                $('#portal-description').val(designData.description);
                $('#theme-color').val(designData.theme_color);
                $('.color-preview').css('background-color', designData.theme_color);
                $('.color-value').text(designData.theme_color);
                $('#welcome-message').val(designData.welcome_message);
                $('#login-instructions').val(designData.login_instructions);
                $('#button-text').val(designData.button_text);
                $('#show-terms').prop('checked', designData.show_terms);
                
                // Update preview elements if they exist
                if ($('#preview-welcome').length) {
                    $('#preview-welcome').text(designData.welcome_message);
                }
                if ($('#preview-button').length) {
                    $('#preview-button').text(designData.button_text);
                }

                // Update preview
                $('#preview-welcome').text(designData.welcome_message);
                $('#preview-instructions').text(designData.login_instructions);
                $('#preview-button').text(designData.button_text);
                $('#preview-button').css({
                    'background-color': designData.theme_color,
                    'border-color': designData.theme_color
                });
                $('#preview-terms-container').toggle(designData.show_terms);
            }

            // Initialize any components that need it
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        }

        // Make sure the click handlers are inside document.ready
        $(document).ready(function() {
            // Edit design buttons
            $(document).on('click', '.edit-design', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const designId = $(this).data('id');
                loadDesignForEditing(designId);
            });

            // Back to Designs button handler
            $('#back-to-list').on('click', function() {
                $('#captive-portal-designer').hide();
                $('#captive-portal-designs-list').show();
                
                // Reset form fields
                $('#portal-name').val('');
                $('#portal-description').val('');
                $('#theme-color').val('#7367f0');
                $('#welcome-message').val('Welcome to our WiFi');
                $('#login-instructions').val('Enter your email to connect to our WiFi network');
                $('#button-text').val('Connect to WiFi');
                $('#show-terms').prop('checked', true);
                
                // Reset preview
                $('#preview-welcome').text('Welcome to our WiFi');
                $('#preview-instructions').text('Enter your email to connect to our WiFi network');
                $('#preview-button').text('Connect to WiFi');
                $('#preview-button').css({
                    'background-color': '#7367f0',
                    'border-color': '#7367f0'
                });
                $('#preview-terms-container').show();
            });

            // Create New Design button handler
            $('#create-new-design').on('click', function() {
                $('#captive-portal-designs-list').hide();
                $('#captive-portal-designer').show();
                
                // Set default values
                $('#portal-name').val('New Design');
                $('#portal-description').val('');
                $('#theme-color').val('#7367f0');
                $('#welcome-message').val('Welcome to our WiFi');
                $('#login-instructions').val('Enter your email to connect to our WiFi network');
                $('#button-text').val('Connect to WiFi');
                $('#show-terms').prop('checked', true);
                
                // Update preview with default values
                $('#preview-welcome').text('Welcome to our WiFi');
                $('#preview-instructions').text('Enter your email to connect to our WiFi network');
                $('#preview-button').text('Connect to WiFi');
                $('#preview-button').css({
                    'background-color': '#7367f0',
                    'border-color': '#7367f0'
                });
                $('#preview-terms-container').show();
                
                // Reset image previews
                $('#preview-location-logo').html('<img src="{{ asset("assets/logo-placeholder.png") }}" alt="Location Logo" style="max-height: 40px; width: auto;">');
                $('#location-logo-preview').hide();
                $('#background-preview').hide();
            });
        });

        // Add this JavaScript for the new functions
        function duplicateDesign(id) {
            // Add your duplication logic here
            console.log('Duplicating design:', id);
        }

        function deleteDesign(id) {
            // Add your deletion logic here
            if (confirm('Are you sure you want to delete this design?')) {
                console.log('Deleting design:', id);
            }
        }
    </script>
</body>
</html>