<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Mr WiFi - Firmware management for network administrators">
    <meta name="keywords" content="wifi, network, firmware, updates, dashboard, administrator, mr wifi">
    <meta name="author" content="Mr WiFi">
    <title>Firmware Management - Mr WiFi</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/mrwifi-assets/MrWifi.png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/file-uploaders/dropzone.min.css">
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
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-file-uploader.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- Add this right before the closing </head> tag -->
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
        .badge-status-stable {
            background-color: rgba(40, 199, 111, 0.12);
            color: #28c76f;
        }
        .badge-status-beta {
            background-color: rgba(255, 159, 67, 0.12);
            color: #ff9f43;
        }
        .badge-status-deprecated {
            background-color: rgba(234, 84, 85, 0.12);
            color: #ea5455;
        }
        
        /* Progress bars */
        .progress-bar-success {
            background-color: #28c76f;
        }
        .progress-bar-info {
            background-color: #00cfe8;
        }
        .progress-bar-warning {
            background-color: #ff9f43;
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
                            <h2 class="content-header-title float-left mb-0">Firmware Management</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active">Firmware
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block">
                    <div class="form-group breadcrumb-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-new-firmware">
                            <i data-feather="upload-cloud" class="mr-25"></i>
                            <span>Upload New Firmware</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Statistics Cards -->
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-primary p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="hard-drive"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder" id="total-firmware">8</h2>
                                <p class="card-text">Total Firmware Versions</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-success p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="check-circle"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder" id="stable-firmware">5</h2>
                                <p class="card-text">Stable Releases</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-warning p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="alert-triangle"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder" id="beta-firmware">2</h2>
                                <p class="card-text">Beta Releases</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-sm-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="avatar bg-light-danger p-50 mb-1">
                                    <div class="avatar-content">
                                        <i data-feather="archive"></i>
                                    </div>
                                </div>
                                <h2 class="font-weight-bolder" id="deprecated-firmware">1</h2>
                                <p class="card-text">Deprecated Versions</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Firmware Table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Firmware Versions</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-datatable table-responsive">
                                        <table class="datatables-firmware table">
                                            <thead>
                                                <tr>
                                                    <th>Version</th>
                                                    <th>Status</th>
                                                    <th>Device Model</th>
                                                    <th>Release Date</th>
                                                    <th>Size</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-primary mr-1 p-25">
                                                                <div class="avatar-content">
                                                                    <i data-feather="hard-drive"></i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="font-weight-bold">v2.1.4</div>
                                                                <div class="small text-truncate text-muted">Security patch</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-status-stable">Stable</span></td>
                                                    <td>MR-AP-2000</td>
                                                    <td>Jan 15, 2025</td>
                                                    
                                                    <td>14.8 MB</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-firmware">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="download" class="mr-50"></i>
                                                                    <span>Download</span>
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
                                                                    <i data-feather="hard-drive"></i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="font-weight-bold">v2.1.3</div>
                                                                <div class="small text-truncate text-muted">Performance improvements</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-status-stable">Stable</span></td>
                                                    <td>MR-AP-2000</td>
                                                    <td>Dec 10, 2024</td>
                                                    
                                                    <td>14.5 MB</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-firmware">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="download" class="mr-50"></i>
                                                                    <span>Download</span>
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
                                                                    <i data-feather="hard-drive"></i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="font-weight-bold">v3.0.1-beta</div>
                                                                <div class="small text-truncate text-muted">New features testing</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge badge-pill badge-status-beta">Beta</span></td>
                                                    <td>MR-AP-3000</td>
                                                    <td>Feb 2, 2025</td>
                                                    
                                                    <td>16.2 MB</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#edit-firmware">
                                                                    <i data-feather="edit-2" class="mr-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <a class="dropdown-item" href="javascript:void(0);">
                                                                    <i data-feather="download" class="mr-50"></i>
                                                                    <span>Download</span>
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

                <!-- Add New Firmware Modal -->
                <div class="modal fade text-left" id="add-new-firmware" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Upload New Firmware</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="version">Version Number</label>
                                                <input type="text" class="form-control" id="version" placeholder="e.g. v2.1.5" />
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status">
                                                    <option value="stable">Stable</option>
                                                    <option value="beta">Beta</option>
                                                    <option value="deprecated">Deprecated</option>
                                                </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="model">Device Model</label>
                                                <select class="form-control" id="model">
                                                    <option value="MR-AP-1000">MR-AP-1000</option>
                                                    <option value="MR-AP-2000">MR-AP-2000</option>
                                                    <option value="MR-AP-3000">MR-AP-3000</option>
                                                </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="release-date">Release Date</label>
                                                <input type="date" id="release-date" class="form-control" />
                                </div>
                            </div>
                                        <div class="col-12">
                                <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description" rows="3" placeholder="Firmware description and changelog"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="firmware-file">Firmware File</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="firmware-file">
                                                    <label class="custom-file-label" for="firmware-file">Choose file</label>
                                    </div>
                                                <small class="form-text text-muted">Max file size: 50MB. Accepted formats: .bin, .fw, .img</small>
                                </div>
                            </div>
                                        <div class="col-12">
                                <div class="form-group">
                                                <label for="release-notes">Release Notes</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="release-notes">
                                                    <label class="custom-file-label" for="release-notes">Choose file</label>
                                                </div>
                                                <small class="form-text text-muted">Max file size: 10MB. Accepted formats: .pdf, .txt, .md</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Upload Firmware</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Firmware Modal -->
                <div class="modal fade text-left" id="edit-firmware" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel34">Edit Firmware</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#">
                                <div class="modal-body">
                                    <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="edit-version">Version Number</label>
                                                <input type="text" class="form-control" id="edit-version" value="v2.1.4" readonly />
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="edit-status">Status</label>
                                                <select class="form-control" id="edit-status">
                                                    <option value="stable" selected>Stable</option>
                                                    <option value="beta">Beta</option>
                                                    <option value="deprecated">Deprecated</option>
                                                </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="edit-model">Device Model</label>
                                                <select class="form-control" id="edit-model">
                                                    <option value="MR-AP-1000">MR-AP-1000</option>
                                                    <option value="MR-AP-2000" selected>MR-AP-2000</option>
                                                    <option value="MR-AP-3000">MR-AP-3000</option>
                                                </select>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                                <label for="edit-release-date">Release Date</label>
                                                <input type="date" id="edit-release-date" class="form-control" value="2025-01-15" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="edit-description">Description</label>
                                                <textarea class="form-control" id="edit-description" rows="3">Security patch addressing vulnerability CVE-2024-12345. Improved stability for high-density deployments.</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Firmware File</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="edit-firmware-file" accept=".bin,.fw">
                                                    <label class="custom-file-label" for="edit-firmware-file">Choose firmware file</label>
                                                </div>
                                                <small class="form-text text-muted">Accepted formats: .bin, .fw</small>
                                    </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Documentation</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="edit-firmware-docs" accept=".pdf,.doc,.docx">
                                                    <label class="custom-file-label" for="edit-firmware-docs">Choose documentation file</label>
                                                </div>
                                                <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX</small>
                                </div>
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
                <script src="app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
                <script src="app-assets/js/scripts/forms/form-file-uploader.js"></script>
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
                        $('.datatables-firmware').DataTable({
                responsive: true,
                columnDefs: [
                    {
                        targets: [6],
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
            
                        // Initialize status and model select2
            if ($.fn.select2) {
                            $('#status, #edit-status, #model, #edit-model').select2({
                                dropdownParent: $('#status, #edit-status').closest('.modal'),
                    minimumResultsForSearch: Infinity
                });
            }
            
                        // Custom file input label
                        $('.custom-file-input').on('change', function() {
                            let fileName = $(this).val().split('\\').pop();
                            $(this).next('.custom-file-label').html(fileName || 'Choose file');
                        });
                        
                        // Handle edit firmware modal data population
                        $('#edit-firmware').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget);
                            var row = button.closest('tr');
                            var version = row.find('.font-weight-bold').text();
                            var description = row.find('.small.text-muted').text();
                            var status = row.find('.badge-status-stable, .badge-status-beta, .badge-status-deprecated').text();
                            var model = row.find('td:nth-child(3)').text();
                            var date = row.find('td:nth-child(4)').text();
                            
                            // Convert date to input format (YYYY-MM-DD)
                            var dateObj = new Date(date);
                            var formattedDate = dateObj.toISOString().split('T')[0];
                            
                            var modal = $(this);
                            modal.find('#edit-version').val(version);
                            modal.find('#edit-description').val(description);
                            modal.find('#edit-status').val(status.toLowerCase()).trigger('change');
                            modal.find('#edit-model').val(model).trigger('change');
                            modal.find('#edit-release-date').val(formattedDate);
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