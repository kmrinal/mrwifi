<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Mr WiFi - Domain blocking management for network administrators">
    <meta name="keywords" content="wifi, network, domain blocking, content filtering, dashboard, administrator, mr wifi">
    <meta name="author" content="Mr WiFi">
    <title>Domain Blocking - Mr WiFi</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/mrwifi-assets/MrWifi.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/select/select2.min.css">
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

    <style>
        /* Ensure feather icons in avatars are visible */
        .avatar-content svg {
            color: inherit;
            width: 24px !important;
            height: 24px !important;
            stroke-width: 2;
            display: block !important;
        }
        
        /* Fix for general feather icons */
        [data-feather] {
            display: inline-block !important;
            vertical-align: middle;
        }

        /* Badge status */
        .badge-category-adult {
            background-color: rgba(234, 84, 85, 0.12);
            color: #ea5455;
        }
        .badge-category-gambling {
            background-color: rgba(255, 159, 67, 0.12);
            color: #ff9f43;
        }
        .badge-category-malware {
            background-color: rgba(130, 28, 128, 0.12);
            color: #821c80;
        }
        .badge-category-social {
            background-color: rgba(0, 137, 255, 0.12);
            color: #0089ff;
        }
        .badge-category-streaming {
            background-color: rgba(40, 199, 111, 0.12);
            color: #28c76f;
        }
        .badge-category-custom {
            background-color: rgba(45, 45, 45, 0.12);
            color: #2d2d2d;
        }

        /* Category cards */
        .cursor-pointer {
            cursor: pointer;
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
                            <h2 class="content-header-title float-left mb-0">Domain Blocking</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Domain Blocking
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block">
                    <div class="form-group breadcrumb-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-new-category">
                            <i data-feather="plus" class="mr-25"></i>
                            <span>Add Category</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Blocking Categories -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Blocking Categories</h4>
                                <p class="card-text">Toggle categories to enable or disable domain blocking by category.</p>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="card cursor-pointer border shadow-none">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-danger p-50 mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="x-octagon"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="mb-0">Adult Content</h4>
                                                            <span>1,024 domains</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="category-adult" checked>
                                                    <label class="custom-control-label" for="category-adult"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="card cursor-pointer border shadow-none">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-warning p-50 mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="dollar-sign"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="mb-0">Gambling</h4>
                                                            <span>856 domains</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="category-gambling" checked>
                                                    <label class="custom-control-label" for="category-gambling"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="card cursor-pointer border shadow-none">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary p-50 mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="shield-off"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="mb-0">Malware</h4>
                                                            <span>2,345 domains</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="category-malware" checked>
                                                    <label class="custom-control-label" for="category-malware"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="card cursor-pointer border shadow-none">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-info p-50 mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="users"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="mb-0">Social Media</h4>
                                                            <span>342 domains</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="category-social">
                                                    <label class="custom-control-label" for="category-social"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="card cursor-pointer border shadow-none">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-success p-50 mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="film"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="mb-0">Streaming</h4>
                                                            <span>128 domains</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="category-streaming">
                                                    <label class="custom-control-label" for="category-streaming"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="card cursor-pointer border shadow-none">
                                            <div class="card-body d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-secondary p-50 mr-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="tag"></i>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4 class="mb-0">Custom List</h4>
                                                            <span>43 domains</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="category-custom" checked>
                                                    <label class="custom-control-label" for="category-custom"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Domain List Table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Blocked Domains</h4>
                                    <div>
                                        <button type="button" class="btn btn-outline-primary mr-1" data-toggle="modal" data-target="#import-domains">
                                            <i data-feather="upload" class="mr-25"></i>
                                            <span>Import</span>
                                        </button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-new-domain">
                                            <i data-feather="plus" class="mr-25"></i>
                                            <span>Add Domain</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-datatable table-responsive">
                                        <table class="datatables-domains table">
                                            <thead>
                                                <tr>
                                                    <th>Domain</th>
                                                    <th>Category</th>
                                                    <th>Added Date</th>
                                                    <th>Last Updated</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-danger mr-1 p-25">
                                                                <div class="avatar-content">
                                                                    <i data-feather="globe"></i>
                                                                </div>
                                                            </div>
                                                            <span>adultsite.example.com</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-category-adult">Adult Content</span></td>
                                                    <td>Jan 15, 2025</td>
                                                    <td>Jan 15, 2025</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-domain">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-warning mr-1 p-25">
                                                                <div class="avatar-content">
                                                                    <i data-feather="globe"></i>
                                                                </div>
                                                            </div>
                                                            <span>casino.example.com</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-category-gambling">Gambling</span></td>
                                                    <td>Dec 10, 2024</td>
                                                    <td>Jan 02, 2025</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-domain">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-primary mr-1 p-25">
                                                                <div class="avatar-content">
                                                                    <i data-feather="globe"></i>
                                                                </div>
                                                            </div>
                                                            <span>malware.example.com</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-category-malware">Malware</span></td>
                                                    <td>Feb 5, 2025</td>
                                                    <td>Feb 5, 2025</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-domain">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-info mr-1 p-25">
                                                                <div class="avatar-content">
                                                                    <i data-feather="globe"></i>
                                                                </div>
                                                            </div>
                                                            <span>social.example.com</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-category-social">Social Media</span></td>
                                                    <td>Jan 20, 2025</td>
                                                    <td>Jan 20, 2025</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-domain">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-secondary mr-1 p-25">
                                                                <div class="avatar-content">
                                                                    <i data-feather="globe"></i>
                                                                </div>
                                                            </div>
                                                            <span>custom-block.example.com</span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-category-custom">Custom List</span></td>
                                                    <td>Feb 15, 2025</td>
                                                    <td>Feb 15, 2025</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-domain">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="trash" class="mr-50"></i>
                                                                    <span>Delete</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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

    <!-- Add New Category Modal -->
    <div class="modal fade text-left" id="add-new-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Add New Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category-name">Category Name</label>
                            <input type="text" class="form-control" id="category-name" placeholder="Enter category name" />
                        </div>
                        <div class="form-group">
                            <label for="category-description">Description</label>
                            <textarea class="form-control" id="category-description" rows="3" placeholder="Enter category description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category-icon">Icon</label>
                            <select class="form-control" id="category-icon">
                                <option value="tag">Tag</option>
                                <option value="shield-off">Shield Off</option>
                                <option value="x-octagon">X Octagon</option>
                                <option value="dollar-sign">Dollar Sign</option>
                                <option value="users">Users</option>
                                <option value="film">Film</option>
                                <option value="play">Play</option>
                                <option value="shopping-cart">Shopping Cart</option>
                                <option value="briefcase">Briefcase</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category-color">Color</label>
                            <select class="form-control" id="category-color">
                                <option value="primary">Primary</option>
                                <option value="secondary">Secondary</option>
                                <option value="success">Success</option>
                                <option value="danger">Danger</option>
                                <option value="warning">Warning</option>
                                <option value="info">Info</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="category-enabled" checked>
                                <label class="custom-control-label" for="category-enabled">Enabled</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add New Domain Modal -->
    <div class="modal fade text-left" id="add-new-domain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel34">Add New Domain</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="domain-name">Domain</label>
                            <input type="text" class="form-control" id="domain-name" placeholder="example.com" />
                            <small class="form-text text-muted">Enter a domain without http:// or https://</small>
                        </div>
                        <div class="form-group">
                            <label for="domain-category">Category</label>
                            <select class="form-control" id="domain-category">
                                <option value="adult">Adult Content</option>
                                <option value="gambling">Gambling</option>
                                <option value="malware">Malware</option>
                                <option value="social">Social Media</option>
                                <option value="streaming">Streaming</option>
                                <option value="custom">Custom List</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="domain-notes">Notes</label>
                            <textarea class="form-control" id="domain-notes" rows="3" placeholder="Enter any notes"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="block-subdomains" checked>
                                <label class="custom-control-label" for="block-subdomains">Block all subdomains</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Domain</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Domain Modal -->
    <div class="modal fade text-left" id="edit-domain" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel35">Edit Domain</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit-domain-name">Domain</label>
                            <input type="text" class="form-control" id="edit-domain-name" value="adultsite.example.com" readonly />
                        </div>
                        <div class="form-group">
                            <label for="edit-domain-category">Category</label>
                            <select class="form-control" id="edit-domain-category">
                                <option value="adult" selected>Adult Content</option>
                                <option value="gambling">Gambling</option>
                                <option value="malware">Malware</option>
                                <option value="social">Social Media</option>
                                <option value="streaming">Streaming</option>
                                <option value="custom">Custom List</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-domain-notes">Notes</label>
                            <textarea class="form-control" id="edit-domain-notes" rows="3">Added for content filtering purposes.</textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="edit-block-subdomains" checked>
                                <label class="custom-control-label" for="edit-block-subdomains">Block all subdomains</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Import Domains Modal -->
    <div class="modal fade text-left" id="import-domains" tabindex="-1" role="dialog" aria-labelledby="myModalLabel36" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel36">Import Domains</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="import-category">Category</label>
                            <select class="form-control" id="import-category">
                                <option value="adult">Adult Content</option>
                                <option value="gambling">Gambling</option>
                                <option value="malware">Malware</option>
                                <option value="social">Social Media</option>
                                <option value="streaming">Streaming</option>
                                <option value="custom">Custom List</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="import-file">File</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="import-file">
                                <label class="custom-file-label" for="import-file">Choose file</label>
                            </div>
                            <small class="form-text text-muted">Accepted formats: .txt, .csv (one domain per line)</small>
                        </div>
                        <div class="form-group">
                            <label>Or paste domains (one per line)</label>
                            <textarea class="form-control" id="import-domains-text" rows="6" placeholder="example1.com&#10;example2.com&#10;example3.com"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="import-block-subdomains" checked>
                                <label class="custom-control-label" for="import-block-subdomains">Block all subdomains</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="import-overwrite">
                                <label class="custom-control-label" for="import-overwrite">Overwrite existing domains</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Import Domains</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0">
            <span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2025<a class="ml-25" href="#" target="_blank">Mr WiFi</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span>
            <span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
    <script src="app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/forms/form-select2.js"></script>
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
                
                // Fix for avatar container icons
                $('.avatar-icon').each(function() {
                    $(this).css({
                        'width': '24px',
                        'height': '24px'
                    });
                });
            }
            
            // Initialize DataTable
            $('.datatables-domains').DataTable({
                responsive: true,
                columnDefs: [
                    {
                        targets: [4],
                        orderable: false
                    }
                ],
                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    paginate: {
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });
            
            // Initialize select2
            if ($.fn.select2) {
                $('#domain-category, #edit-domain-category, #import-category, #category-icon, #category-color').select2({
                    dropdownParent: $('#domain-category, #edit-domain-category, #import-category').closest('.modal'),
                    minimumResultsForSearch: Infinity
                });
            }
            
            // Custom file input label
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName || 'Choose file');
            });
            
            // Handle category toggles
            $('.custom-switch input[type="checkbox"]').on('change', function() {
                const categoryCard = $(this).closest('.card');
                if ($(this).is(':checked')) {
                    categoryCard.addClass('border-primary');
                } else {
                    categoryCard.removeClass('border-primary');
                }
            });
            
            // Handle edit domain modal data population
            $('#edit-domain').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var row = button.closest('tr');
                var domain = row.find('.d-flex span').text();
                var category = row.find('.badge').text().trim().toLowerCase();
                
                var categoryValue;
                switch(category) {
                    case 'adult content': categoryValue = 'adult'; break;
                    case 'gambling': categoryValue = 'gambling'; break;
                    case 'malware': categoryValue = 'malware'; break;
                    case 'social media': categoryValue = 'social'; break;
                    case 'streaming': categoryValue = 'streaming'; break;
                    default: categoryValue = 'custom';
                }
                
                var modal = $(this);
                modal.find('#edit-domain-name').val(domain);
                modal.find('#edit-domain-category').val(categoryValue).trigger('change');
            });
            
            // Handle domain addition to categories
            $('#add-new-domain form').on('submit', function(e) {
                e.preventDefault();
                
                // In a real implementation, this would save to the backend
                const domainName = $('#domain-name').val();
                const category = $('#domain-category').val();
                const blockSubdomains = $('#block-subdomains').is(':checked');
                
                // Get proper category name and color class
                let categoryName, badgeClass, avatarClass;
                switch(category) {
                    case 'adult': 
                        categoryName = 'Adult Content'; 
                        badgeClass = 'badge-category-adult';
                        avatarClass = 'bg-light-danger';
                        break;
                    case 'gambling': 
                        categoryName = 'Gambling'; 
                        badgeClass = 'badge-category-gambling';
                        avatarClass = 'bg-light-warning';
                        break;
                    case 'malware': 
                        categoryName = 'Malware'; 
                        badgeClass = 'badge-category-malware';
                        avatarClass = 'bg-light-primary';
                        break;
                    case 'social': 
                        categoryName = 'Social Media'; 
                        badgeClass = 'badge-category-social';
                        avatarClass = 'bg-light-info';
                        break;
                    case 'streaming': 
                        categoryName = 'Streaming'; 
                        badgeClass = 'badge-category-streaming';
                        avatarClass = 'bg-light-success';
                        break;
                    default: 
                        categoryName = 'Custom List'; 
                        badgeClass = 'badge-category-custom';
                        avatarClass = 'bg-light-secondary';
                }
                
                // Get current date formatted
                const today = new Date();
                const dateStr = today.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
                
                // Create new table row
                const newRow = `<tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar ${avatarClass} mr-1 p-25">
                                <div class="avatar-content">
                                    <i data-feather="globe"></i>
                                </div>
                            </div>
                            <span>${domainName}</span>
                        </div>
                    </td>
                    <td><span class="badge badge-pill ${badgeClass}">${categoryName}</span></td>
                    <td>${dateStr}</td>
                    <td>${dateStr}</td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-domain">
                                    <i data-feather="edit-2" class="mr-50"></i>
                                    <span>Edit</span>
                                </a>
                                <a class="dropdown-item delete-domain" href="javascript:void(0);">
                                    <i data-feather="trash" class="mr-50"></i>
                                    <span>Delete</span>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>`;
                
                // Add the new row to the table and redraw
                $('.datatables-domains tbody').prepend(newRow);
                
                // Refresh feather icons in the new row
                feather.replace({
                    width: 14,
                    height: 14
                });
                
                // Reset form and close modal
                $(this).trigger('reset');
                $('#add-new-domain').modal('hide');
                
                // Show success message (if toastr is available)
                if (typeof toastr !== 'undefined') {
                    toastr.success(`Domain "${domainName}" has been added to the "${categoryName}" category.`);
                } else {
                    alert(`Domain "${domainName}" has been added to the "${categoryName}" category.`);
                }
            });
            
            // Handle domain deletion
            $(document).on('click', '.delete-domain', function() {
                const row = $(this).closest('tr');
                const domain = row.find('.d-flex span').text();
                
                // Simple confirmation
                if (confirm(`Are you sure you want to delete "${domain}" from the block list?`)) {
                    // Remove the row with animation
                    row.fadeOut(400, function() {
                        // In a real implementation, this would also delete from the backend
                        row.remove();
                    });
                }
            });
            
            // Add category click handler to view domains in that category
            $(document).on('click', '.category-card', function(e) {
                // Don't trigger if clicking on the switch
                if ($(e.target).hasClass('custom-control-input') || $(e.target).hasClass('custom-control-label')) {
                    return;
                }
                
                const categoryName = $(this).find('h4').text();
                const categoryCount = parseInt($(this).find('span').text()) || 0;
                
                // Update the blocked domains card title to show category
                $('.card-title:contains("Blocked Domains")').html(`${categoryName} Blocked Domains <span class="text-muted font-small-3">(${categoryCount} domains)</span>`);
                
                // Filter the datatable to show only this category
                const dt = $('.datatables-domains').DataTable();
                dt.search(categoryName).draw();
                
                // Scroll to the domains section
                $('html, body').animate({
                    scrollTop: $("#basic-datatable").offset().top - 100
                }, 500);
                
                // Change the add domain button to pre-select this category
                $('#add-new-domain').on('show.bs.modal', function() {
                    // Find the category value in the dropdown
                    let categoryValue;
                    switch(categoryName.toLowerCase()) {
                        case 'adult content': categoryValue = 'adult'; break;
                        case 'gambling': categoryValue = 'gambling'; break;
                        case 'malware': categoryValue = 'malware'; break;
                        case 'social media': categoryValue = 'social'; break;
                        case 'streaming': categoryValue = 'streaming'; break;
                        default: categoryValue = 'custom';
                    }
                    $('#domain-category').val(categoryValue).trigger('change');
                });
            });
            
            // Add View Category button to the cards
            $('.card.cursor-pointer').each(function() {
                $(this).addClass('category-card');
                const categoryName = $(this).find('h4').text();
                $(this).find('.card-body').append(`
                    <div class="mt-1">
                        <button class="btn btn-sm btn-outline-primary view-category-btn">View Domains</button>
                        <button class="btn btn-sm btn-outline-secondary edit-category-btn" data-category="${categoryName}">Edit Category</button>
                    </div>
                `);
            });
            
            // View category button click
            $(document).on('click', '.view-category-btn', function(e) {
                e.stopPropagation();
                $(this).closest('.category-card').trigger('click');
            });
            
            // Edit category button click
            $(document).on('click', '.edit-category-btn', function(e) {
                e.stopPropagation();
                const categoryName = $(this).data('category');
                
                // Show a modal for editing the category
                $('#edit-category-modal').modal('show');
                $('#edit-category-name').val(categoryName);
                
                // Populate with existing domains from this category
                const dt = $('.datatables-domains').DataTable();
                let domainsInCategory = [];
                dt.rows().every(function() {
                    const rowData = this.data();
                    if ($(rowData[1]).text() === categoryName) {
                        domainsInCategory.push($(rowData[0]).find('span').text());
                    }
                });
                
                // Populate the domains textarea
                $('#edit-category-domains').val(domainsInCategory.join('\n'));
            });
            
            // Add Edit Category Modal
            if (!$('#edit-category-modal').length) {
                $('body').append(`
                <div class="modal fade text-left" id="edit-category-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Category Domains</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="edit-category-form">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="edit-category-name">Category Name</label>
                                        <input type="text" class="form-control" id="edit-category-name" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-category-domains">Domains (one per line)</label>
                                        <textarea class="form-control" id="edit-category-domains" rows="15"></textarea>
                                        <small class="form-text text-muted">Add or remove domains, one domain per line</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>`);
            }
            
            // Handle edit category form submission
            $(document).on('submit', '#edit-category-form', function(e) {
                e.preventDefault();
                
                const categoryName = $('#edit-category-name').val();
                const domainsText = $('#edit-category-domains').val();
                const domains = domainsText.split('\n').filter(domain => domain.trim() !== '');
                
                // In a real implementation, this would update the backend
                
                // Update domain count on the category card
                $(`.card h4:contains("${categoryName}")`).closest('.card').find('span:first').text(`${domains.length} domains`);
                
                // Close the modal
                $('#edit-category-modal').modal('hide');
                
                // Show success message
                if (typeof toastr !== 'undefined') {
                    toastr.success(`Successfully updated domains for "${categoryName}" category.`);
                } else {
                    alert(`Successfully updated domains for "${categoryName}" category.`);
                }
                
                // Reload the page or refresh the datatable in a real implementation
            });
            
            // Initialize all categories to show view/edit buttons
            $('.card.cursor-pointer').addClass('category-card');
            
            // Add the "All Domains" option at the top
            $('.card-title:contains("Blocked Domains")').after(`
                <div class="mb-2">
                    <button class="btn btn-sm btn-outline-primary mr-1" id="view-all-domains">
                        <i data-feather="list" class="mr-25"></i>View All Domains
                    </button>
                    <button class="btn btn-sm btn-outline-secondary" id="export-all-domains">
                        <i data-feather="download" class="mr-25"></i>Export All
                    </button>
                </div>
            `);
            
            // "View All Domains" button click
            $(document).on('click', '#view-all-domains', function() {
                $('.card-title:contains("Blocked Domains")').html('All Blocked Domains');
                const dt = $('.datatables-domains').DataTable();
                dt.search('').draw();
            });
            
            // Replace Feather icons in new elements
            feather.replace({
                width: 14,
                height: 14
            });
        });

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
        });
    </script>
</body>
</html>