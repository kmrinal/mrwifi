<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Bloom WiFi cloud controller dashboard for managing and monitoring WiFi networks.">
    <meta name="keywords" content="wifi, cloud controller, network management, bloom">
    <meta name="author" content="Bloom Networks">
    <title>Dashboard - Bloom WiFi Controller</title>
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
    
    <!-- Ensure proper loading of Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="app-assets/vendors/js/jquery/jquery.min.js"></script>

    <!-- BEGIN: Page Vendor JS-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>

    <!-- First, add this in the head section -->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/maps/leaflet.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/maps/map-leaflet.css">

    <!-- Add this CSS in the head section -->
    <style>
    .dataTables_paginate {
        margin-top: 1rem !important;
        padding: 1rem !important;
    }

    .pagination {
        display: flex;
        justify-content: flex-end;
    }

    .page-link {
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        border: 1px solid #ddd;
        color: #7367f0;
    }

    .page-item.active .page-link {
        background-color: #7367f0;
        border-color: #7367f0;
        color: #fff;
    }

    .page-item.disabled .page-link {
        color: #b9b9c3;
        pointer-events: none;
        background-color: #fff;
        border-color: #ddd;
    }
    
    .location-card {
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .location-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .status-badge {
        padding: 5px 10px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .status-online {
        background-color: rgba(40, 199, 111, 0.12);
        color: #28c76f;
    }
    
    .status-offline {
        background-color: rgba(234, 84, 85, 0.12);
        color: #ea5455;
    }
    
    .status-warning {
        background-color: rgba(255, 159, 67, 0.12);
        color: #ff9f43;
    }
    
    .network-stat-icon {
        height: 45px;
        width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
    }
    
    /* Fix for marker icons */
    .marker-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Ensure proper loading of Leaflet map */
    .leaflet-map {
        z-index: 1;
    }
    
    /* Fix for potential CSS conflicts */
    .leaflet-container {
        font-family: inherit;
        font-size: inherit;
    }
    
    /* Ensure proper popup styling */
    .leaflet-popup-content {
        margin: 0;
        padding: 0;
    }
    
    /* Fix for potential icon issues */
    .feather {
        height: 14px;
        width: 14px;
        display: inline-block;
        vertical-align: middle;
    }
    
    /* Ensure proper marker styling */
    .custom-div-icon, .marker-icon {
        background: transparent;
        border: none;
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
                <li class="nav-item active">
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
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Dashboard</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Dashboard
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="locations.html"><i class="mr-1" data-feather="plus"></i><span class="align-middle">Add Location</span></a>
                                <!-- <a class="dropdown-item" href="devices.html"><i class="mr-1" data-feather="hard-drive"></i><span class="align-middle">Add Device</span></a> -->
                                <a class="dropdown-item" href="users.html"><i class="mr-1" data-feather="user-plus"></i><span class="align-middle">Add User</span></a>
                                <a class="dropdown-item" href="analytics.html"><i class="mr-1" data-feather="bar-chart-2"></i><span class="align-middle">Reports</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Dashboard Content Starts -->
                <section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Welcome Card -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card card-congratulation-medal">
                                <div class="card-body">
                                    <h5>Welcome to monsieur-wifi Dashboard</h5>
                                    <p class="card-text font-small-3">Network Status Overview</p>
                                    <h3 class="mb-75 mt-2 pt-50">
                                        <span class="text-primary">6 Locations</span>
                                    </h3>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center mr-2">
                                            <i data-feather="check-circle" class="text-success font-medium-2 mr-50"></i>
                                            <span class="font-weight-bold">5 Active</span>
                                </div>
                                        <span class="mx-1">|</span>
                                        <div class="d-flex align-items-center ml-1">
                                            <i data-feather="x-circle" class="text-danger font-medium-2 mr-50"></i>
                                            <span class="font-weight-bold">1 Offline</span>
                            </div>
                        </div>
                                    <a type="button" class="btn btn-primary mt-1" href="locations.html">View Details</a>
                                    <img src="app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                                </div>
                            </div>
                        </div>
                        <!--/ Welcome Card -->

                        <!-- Statistics Card -->
                        <div class="col-lg-8 col-12">
                            <div class="card card-statistics">
                                <div class="card-header">
                                    <h4 class="card-title">Network Statistics</h4>
                                    <div class="d-flex align-items-center">
                                        <p class="card-text mr-25 mb-0">Updated just now</p>
                                    </div>
                                </div>
                                <div class="card-body statistics-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                            <div class="media">
                                                <div class="avatar bg-light-primary mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="wifi" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">5/6</h4>
                                                    <p class="card-text font-small-3 mb-0">Routers Online</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                            <div class="media">
                                                <div class="avatar bg-light-info mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">2,380</h4>
                                                    <p class="card-text font-small-3 mb-0">Active Users</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="media">
                                                <div class="avatar bg-light-warning mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="download" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">5.2TB</h4>
                                                    <p class="card-text font-small-3 mb-0">Data Used</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="media">
                                                <div class="avatar bg-light-success mr-2">
                                                    <div class="avatar-content">
                                                        <i data-feather="activity" class="avatar-icon"></i>
                                                    </div>
                                                </div>
                                                <div class="media-body my-auto">
                                                    <h4 class="font-weight-bolder mb-0">99.8%</h4>
                                                    <p class="card-text font-small-3 mb-0">Uptime</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                    </div>

                    <div class="row match-height">
                        <!-- Network Map -->
                        <div class="col-lg-8 col-12">
                                    <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Network Map</h4>
                                    <div class="d-flex">
                                        <button id="fullscreen-btn" class="btn btn-sm btn-outline-primary mr-1">
                                            <i data-feather="maximize"></i>
                                        </button>
                                        <div class="dropdown chart-dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="networkMapDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Last 7 Days
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="networkMapDropdown">
                                                <a class="dropdown-item" href="javascript:void(0);">Last 7 Days</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                        </div>
                                    </div>
                                        </div>
                                        </div>
                                        <div class="card-body">
                                    <div id="network-map" style="height: 400px;"></div>
                                            </div>
                            </div>
                        </div>
                        <!--/ Network Map -->

                        <!-- Alerts and Network Health -->
                        <div class="col-lg-4 col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Network Health</h4>
                                    <div class="dropdown chart-dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="healthDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 Days
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="healthDropdown">
                                            <a class="dropdown-item" href="javascript:void(0);">Last 7 Days</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 d-flex flex-column flex-wrap text-center mb-2">
                                            <h1 class="font-large-2 font-weight-bolder mt-2 mb-0">99.8%</h1>
                                            <p class="card-text">Overall Uptime</p>
                            </div>
                        </div>
                                    <div id="network-health-chart" class="mt-2"></div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-light-primary mr-1 p-50">
                                                    <div class="avatar-content">
                                                        <i data-feather="wifi" class="font-medium-4"></i>
                                                </div>
                                                </div>
                                                <div>
                                                    <h4 class="font-weight-bolder mb-0">5/6</h4>
                                                    <p class="card-text font-small-3 mb-0">Routers Online</p>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar bg-light-success mr-1 p-50">
                                                    <div class="avatar-content">
                                                        <i data-feather="activity" class="font-medium-4"></i>
                                            </div>
                                        </div>
                                                <div>
                                                    <h4 class="font-weight-bolder mb-0">0</h4>
                                                    <p class="card-text font-small-3 mb-0">Active Alerts</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                        <!--/ Alerts and Network Health -->
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Locations Overview</h4>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="locationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            All Locations
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="locationDropdown">
                                            <a class="dropdown-item" href="javascript:void(0);">All Locations</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Online Only</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Offline Only</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Location Card 1 -->
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
                                                                <h5 class="mb-0">Paris Office</h5>
                                                                <small class="text-muted">123 Main Street, Suite 100</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge badge-pill badge-light-success">Online</span>
                                                        </div>
                                                    
                                                    <div class="row mt-1">
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="users" class="text-info mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>856 Users</small>
                                                        </div>
                                                        </div>
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="download" class="text-warning mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>1.2TB Used</small>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="d-flex align-items-center">
                                                            <i data-feather="hard-drive" class="text-primary mr-1" style="width: 14px; height: 14px;"></i>
                                                            <small>Router Online</small>
                                                        </div>
                                                        <a href="location-details.html" class="btn btn-sm btn-primary">View Details</a>
                                                        </div>
                                                        </div>
                                                        </div>
                                        </div>

                                        <!-- Location Card 2 -->
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
                                                                <h5 class="mb-0">Lyon Branch</h5>
                                                                <small class="text-muted">456 Oak Avenue, Suite 200</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge badge-pill badge-light-success">Online</span>
                                                        </div>
                                                    
                                                    <div class="row mt-1">
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="users" class="text-info mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>542 Users</small>
                                                        </div>
                                                        </div>
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="download" class="text-warning mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>0.8TB Used</small>
                                                                </div>
                                                            </div>
                                                            </div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="d-flex align-items-center">
                                                            <i data-feather="hard-drive" class="text-primary mr-1" style="width: 14px; height: 14px;"></i>
                                                            <small>Router Online</small>
                                                        </div>
                                                        <a href="location-details.html" class="btn btn-sm btn-primary">View Details</a>
                                                        </div>
                                                        </div>
                                                        </div>
                                        </div>

                                        <!-- Location Card 3 -->
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
                                                                <h5 class="mb-0">Marseille Warehouse</h5>
                                                                <small class="text-muted">789 Industrial Pkwy</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge badge-pill badge-light-success">Online</span>
                                                    </div>
                                                    
                                                    <div class="row mt-1">
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="users" class="text-info mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>128 Users</small>
                                                        </div>
                                                        </div>
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="download" class="text-warning mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>0.3TB Used</small>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="d-flex align-items-center">
                                                            <i data-feather="hard-drive" class="text-primary mr-1" style="width: 14px; height: 14px;"></i>
                                                            <small>Router Online</small>
                                                        </div>
                                                        <a href="location-details.html" class="btn btn-sm btn-primary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Location Card 4 -->
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
                                                                <h5 class="mb-0">Nice Retail</h5>
                                                                <small class="text-muted">101 Shopping Center Blvd</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge badge-pill badge-light-success">Online</span>
                                                    </div>
                                                    
                                                    <div class="row mt-1">
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="users" class="text-info mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>752 Users</small>
                                                        </div>
                                                        </div>
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="download" class="text-warning mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>0.6TB Used</small>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="d-flex align-items-center">
                                                            <i data-feather="hard-drive" class="text-primary mr-1" style="width: 14px; height: 14px;"></i>
                                                            <small>Router Online</small>
                                                        </div>
                                                        <a href="location-details.html" class="btn btn-sm btn-primary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Location Card 5 -->
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
                                                                <h5 class="mb-0">Bordeaux Data Center</h5>
                                                                <small class="text-muted">202 Tech Drive</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge badge-pill badge-light-success">Online</span>
                                                    </div>
                                                    
                                                    <div class="row mt-1">
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="users" class="text-info mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>24 Users</small>
                                                        </div>
                                                        </div>
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="download" class="text-warning mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>1.8TB Used</small>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="d-flex align-items-center">
                                                            <i data-feather="hard-drive" class="text-primary mr-1" style="width: 14px; height: 14px;"></i>
                                                            <small>Router Online</small>
                                                        </div>
                                                        <a href="location-details.html" class="btn btn-sm btn-primary">View Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Location Card 6 -->
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
                                                                <h5 class="mb-0">Toulouse Office</h5>
                                                                <small class="text-muted">303 Remote Way</small>
                                                            </div>
                                                        </div>
                                                        <span class="badge badge-pill badge-light-success">Online</span>
                                                    </div>
                                                    
                                                    <div class="row mt-1">
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="users" class="text-info mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>78 Users</small>
                                                        </div>
                                                        </div>
                                                        <div class="col-6">
                                                        <div class="d-flex align-items-center">
                                                                <i data-feather="download" class="text-warning mr-1" style="width: 14px; height: 14px;"></i>
                                                                <small>0.5TB Used</small>
                                                        </div>
                                                        </div>
                                    </div>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                                        <div class="d-flex align-items-center">
                                                            <i data-feather="hard-drive" class="text-primary mr-1" style="width: 14px; height: 14px;"></i>
                                                            <small>Router Online</small>
                                </div>
                                                        <a href="location-details.html" class="btn btn-sm btn-primary">View Details</a>
                            </div>
                        </div>
                                </div>
                                        </div>
                                        </div>
                                    </div>
                                            </div>
                                        </div>
                                        </div>

                    <!-- Network Analytics Overview -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Network Analytics Overview</h4>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="analyticsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 Days
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="analyticsDropdown">
                                            <a class="dropdown-item" href="javascript:void(0);">Last 7 Days</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                    </div>
                                            </div>
                                        </div>
                                <div class="card-body">
                                    <!-- Analytics Metrics Row -->
                                    <div class="row mb-2">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-1">
                                                <div class="avatar bg-light-primary p-50 mr-1">
                                                    <div class="avatar-content">
                                                        <i data-feather="users" class="font-medium-4"></i>
                                        </div>
                                    </div>
                                                <div>
                                                    <h4 class="mb-0">8,249</h4>
                                                    <span>Total Users</span>
                                                </div>
                                            </div>
                                            <div class="progress progress-bar-primary mb-1" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100" style="width: 83%"></div>
                                            </div>
                                            <span class="text-success"><i data-feather="trending-up" class="font-small-3 mr-25"></i> +12.4% growth</span>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-1">
                                                <div class="avatar bg-light-info p-50 mr-1">
                                                    <div class="avatar-content">
                                                        <i data-feather="activity" class="font-medium-4"></i>
                                        </div>
                                        </div>
                                                <div>
                                                    <h4 class="mb-0">243.8 GB</h4>
                                                    <span>Data Usage</span>
                                        </div>
                                        </div>
                                            <div class="progress progress-bar-info mb-1" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%"></div>
                                        </div>
                                            <span class="text-danger"><i data-feather="trending-down" class="font-small-3 mr-25"></i> -5.3% decrease</span>
                                    </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-1">
                                                <div class="avatar bg-light-success p-50 mr-1">
                                                    <div class="avatar-content">
                                                        <i data-feather="wifi" class="font-medium-4"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="mb-0">98.7%</h4>
                                                    <span>Uptime</span>
                                                </div>
                                            </div>
                                            <div class="progress progress-bar-success mb-1" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%"></div>
                                            </div>
                                            <span class="text-success"><i data-feather="trending-up" class="font-small-3 mr-25"></i> +1.2% improved</span>
                                        </div>
                                        
                                        <div class="col-md-3 col-sm-6">
                                            <div class="d-flex align-items-center mb-1">
                                                <div class="avatar bg-light-warning p-50 mr-1">
                                                    <div class="avatar-content">
                                                        <i data-feather="alert-triangle" class="font-medium-4"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <h4 class="mb-0">12</h4>
                                                    <span>Websites Blocked</span>
                                                </div>
                                            </div>
                                            <div class="progress progress-bar-warning mb-1" style="height: 6px">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                            </div>
                                            <span class="text-warning"><i data-feather="minus" class="font-small-3 mr-25"></i> No change</span>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Dashboard Content Ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2025<a class="ml-25" href="https://mrwifi.com" target="_blank">monsieur-wifi</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <!-- END: Page JS-->

    <!-- Include config.js before other custom scripts -->
    <script src="assets/js/config.js"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }

            // Initialize small charts
            var usersOptions = {
                chart: {
                    type: 'line',
                    height: 40,
                    sparkline: { enabled: true },
                    toolbar: { show: false }
                },
                colors: ['#7367F0'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 2.5
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 0.9,
                        opacityFrom: 0.7,
                        opacityTo: 0.5,
                        stops: [0, 80, 100]
                    }
                },
                series: [{
                    name: 'Users',
                    data: [2100, 2300, 2500, 2700, 2600, 2800, 2856]
                }],
                tooltip: { fixed: { enabled: false } }
            };

            var devicesOptions = {
                chart: {
                    type: 'line',
                    height: 40,
                    sparkline: { enabled: true },
                    toolbar: { show: false }
                },
                colors: ['#28C76F'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 2.5
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 0.9,
                        opacityFrom: 0.7,
                        opacityTo: 0.5,
                        stops: [0, 80, 100]
                    }
                },
                series: [{
                    name: 'Devices',
                    data: [42, 43, 45, 44, 45, 43, 45]
                }],
                tooltip: { fixed: { enabled: false } }
            };

            var bandwidthOptions = {
                chart: {
                    type: 'line',
                    height: 40,
                    sparkline: { enabled: true },
                    toolbar: { show: false }
                },
                colors: ['#FF9F43'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 2.5
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 0.9,
                        opacityFrom: 0.7,
                        opacityTo: 0.5,
                        stops: [0, 80, 100]
                    }
                },
                series: [{
                    name: 'Bandwidth',
                    data: [1.8, 2.0, 2.2, 2.3, 2.1, 2.4, 2.4]
                }],
                tooltip: { fixed: { enabled: false } }
            };

            var alertsOptions = {
                chart: {
                    type: 'line',
                    height: 40,
                    sparkline: { enabled: true },
                    toolbar: { show: false }
                },
                colors: ['#EA5455'],
                dataLabels: { enabled: false },
                stroke: {
                    curve: 'smooth',
                    width: 2.5
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 0.9,
                        opacityFrom: 0.7,
                        opacityTo: 0.5,
                        stops: [0, 80, 100]
                    }
                },
                series: [{
                    name: 'Alerts',
                    data: [5, 4, 3, 5, 4, 3, 3]
                }],
                tooltip: { fixed: { enabled: false } }
            };

            // Initialize charts
            new ApexCharts(document.querySelector('#users-online-chart'), usersOptions).render();
            new ApexCharts(document.querySelector('#devices-online-chart'), devicesOptions).render();
            new ApexCharts(document.querySelector('#bandwidth-chart'), bandwidthOptions).render();
            new ApexCharts(document.querySelector('#alerts-chart'), alertsOptions).render();

            // Network Health Chart
            var healthOptions = {
                chart: {
                    height: 270,
                    type: 'radialBar'
                },
                colors: ['#28C76F', '#7367F0', '#FF9F43'],
                plotOptions: {
                    radialBar: {
                        size: 150,
                        hollow: {
                            size: '20%'
                        },
                        track: {
                            strokeWidth: '100%',
                            margin: 15
                        },
                        dataLabels: {
                            name: {
                                fontSize: '14px'
                            },
                            value: {
                                fontSize: '16px',
                                formatter: function(val) {
                                    return val + '%';
                                }
                            },
                            total: {
                                show: true,
                                label: 'Overall',
                                formatter: function() {
                                    return '86%';
                                }
                            }
                        }
                    }
                },
                series: [90, 80, 85],
                labels: ['Uptime', 'Performance', 'Connectivity']
            };

            new ApexCharts(document.querySelector('#network-health-chart'), healthOptions).render();
        });
    </script>
    
    <script src="app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="app-assets/vendors/js/maps/leaflet.min.js"></script>

    <script src="app-assets/js/scripts/maps/map-leaflet.js"></script>

    <script>
        // Initialize map
    $(document).ready(function() {
            // Check if Leaflet is loaded
            if (typeof L !== 'undefined') {
                // Initialize the map
                var networkMap = L.map('network-map').setView([46.2276, 2.2137], 6);
                
                // Add tile layer (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(networkMap);
                
                // Add location markers
                var locations = [
                    { name: "Paris Office", lat: 48.8566, lng: 2.3522, status: "online" },
                    { name: "Lyon Branch", lat: 45.7640, lng: 4.8357, status: "online" },
                    { name: "Marseille Warehouse", lat: 43.2965, lng: 5.3698, status: "online" },
                    { name: "Nice Retail", lat: 43.7102, lng: 7.2620, status: "online" },
                    { name: "Bordeaux Data Center", lat: 44.8378, lng: -0.5792, status: "online" },
                    { name: "Toulouse Office", lat: 43.6047, lng: 1.4442, status: "online" }
                ];
                
                // Define marker icons - using simpler divIcons to avoid errors
                var onlineIcon = L.divIcon({
                    className: 'marker-icon marker-icon-online',
                    html: '<div style="background-color:#28C76F; width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff;"></div>',
                    iconSize: [16, 16],
                    iconAnchor: [8, 8]
                });
                
                var warningIcon = L.divIcon({
                    className: 'marker-icon marker-icon-warning',
                    html: '<div style="background-color:#FF9F43; width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff;"></div>',
                    iconSize: [16, 16],
                    iconAnchor: [8, 8]
                });
                
                var offlineIcon = L.divIcon({
                    className: 'marker-icon marker-icon-offline',
                    html: '<div style="background-color:#EA5455; width: 12px; height: 12px; border-radius: 50%; border: 2px solid #fff;"></div>',
                    iconSize: [16, 16],
                    iconAnchor: [8, 8]
                });
                
                // Add markers to map
                locations.forEach(function(location) {
                    var icon;
                    if (location.status === "online") {
                        icon = onlineIcon;
                    } else if (location.status === "warning") {
                        icon = warningIcon;
                    } else {
                        icon = offlineIcon;
                    }
                    
                    var marker = L.marker([location.lat, location.lng], { icon: icon }).addTo(networkMap);
                    
                    // Simplified popup content to avoid potential issues
                    var popupContent = '<div class="p-1">' +
                        '<h6 class="mb-1">' + location.name + '</h6>' +
                        '<p class="mb-1 small">Location: ' + location.lat.toFixed(4) + ', ' + location.lng.toFixed(4) + '</p>' +
                        '<p class="mb-0 small">Status: <span class="text-' + 
                        (location.status === "online" ? "success" : (location.status === "warning" ? "warning" : "danger")) + 
                        '">' + location.status.charAt(0).toUpperCase() + location.status.slice(1) + '</span></p>' +
                        '<a href="location-details.html" class="btn btn-sm btn-primary mt-2">View Details</a>' +
                        '</div>';
                    
                    marker.bindPopup(popupContent);
                });
                
                // Handle fullscreen button with simplified approach
                document.getElementById('fullscreen-btn').addEventListener('click', function() {
                    var mapElement = document.getElementById('network-map');
                    
                    if (!document.fullscreenElement) {
                        if (mapElement.requestFullscreen) {
                            mapElement.requestFullscreen();
                        } else if (mapElement.mozRequestFullScreen) {
                            mapElement.mozRequestFullScreen();
                        } else if (mapElement.webkitRequestFullscreen) {
                            mapElement.webkitRequestFullscreen();
                        } else if (mapElement.msRequestFullscreen) {
                            mapElement.msRequestFullscreen();
                        }
                        this.innerHTML = '<i data-feather="minimize-2"></i> Exit Full Screen';
                    } else {
                        if (document.exitFullscreen) {
                            document.exitFullscreen();
                        } else if (document.mozCancelFullScreen) {
                            document.mozCancelFullScreen();
                        } else if (document.webkitExitFullscreen) {
                            document.webkitExitFullscreen();
                        } else if (document.msExitFullscreen) {
                            document.msExitFullscreen();
                        }
                        this.innerHTML = '<i data-feather="maximize-2"></i> Full Screen';
                    }
                    
                    // Re-initialize feather icons after DOM changes
                    setTimeout(function() {
                        if (typeof feather !== 'undefined') {
                            feather.replace({
                                width: 14,
                                height: 14
                            });
                        }
                    }, 100);
                });
            }
    });
    </script>

    <script>
        // Authentication check and user display
        $(document).ready(function() {
            // Check if user is logged in using UserManager from config.js
            const user = UserManager.getUser();
            const token = UserManager.getToken();
            
            if (!token || !user) {
                // No token or user found, redirect to login page
                window.location.href = '/';
                return;
            }
            
            // Update user display in the top right dropdown
            $('.user-name').text(user.name);
            $('.user-status').text(user.role);
            
            // Show welcome toast if toastr is available
            // if (typeof toastr !== 'undefined') {
            //     toastr.options = {
            //         closeButton: true,
            //         tapToDismiss: false,
            //         progressBar: true,
            //         positionClass: 'toast-top-right',
            //         showDuration: '300',
            //         hideDuration: '1000',
            //         timeOut: '5000',
            //         extendedTimeOut: '1000',
            //         showEasing: 'swing',
            //         hideEasing: 'linear',
            //         showMethod: 'fadeIn',
            //         hideMethod: 'fadeOut'
            //     };
                
            //     toastr.success(
            //         'Welcome back to the monsieur-wifi Dashboard',
            //         'Hello, ' + user.name + '!'
            //     );
            // }
            
            // Implement logout functionality using UserManager
            $('.logout-button, a[href="/logout"]').on('click', function(e) {
                e.preventDefault();
                UserManager.logout(true); // true to redirect to login page
            });
            
            // Check user role and show/hide admin menu items
            if (!UserManager.hasRole('admin')) {
                $('[data-admin-only="true"]').hide();
            }
        });
    </script>
</body>
<!-- END: Body-->
</html>