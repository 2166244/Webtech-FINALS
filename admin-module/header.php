<?php $user = new User(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>VehiLink | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="coco bootstrap template, coco admin, bootstrap,admin template, bootstrap admin,">
    <meta name="author" content="Huban Creative">
    <!-- Base Css Files -->
    <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
    <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
    <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
    <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" />
    <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" />
    <link href="assets/libs/pace/pace.css" rel="stylesheet" />
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
    <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
    <!-- Extra CSS Libraries Start -->
    <link href="assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Extra CSS Libraries End -->
    <link href="assets/css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body class="fixed-left">
    <!-- Modal Start -->
    <!-- Modal Logout -->
    <div class="md-modal md-just-me" id="logout-modal">
        <div class="md-content">
            <h3><strong>Logout</strong> Confirmation</h3>
            <div>
                <p class="text-center">Are you sure want to logout?</p>
                <p class="text-center">
                    <button class="btn btn-danger md-close">Nope!</button>
                    <a href="logout.php" class="btn btn-success md-close">Yeah, I'm sure</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Modal End -->
    <!-- Begin page -->
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <div class="topbar-left">
                <div class="logo">
                    <h1><a href="index.php"><img src="assets/img/logo.png" alt="Logo"></a></h1>
                </div>
                <button class="button-menu-mobile open-left">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Button mobile view to collapse sidebar menu -->
            <div class="navbar navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-collapse2">
                        <ul class="nav navbar-nav navbar-right top-navbar">
                            <li class="dropdown iconify hide-phone"><a href="#" onclick="javascript:toggle_fullscreen()"><i class="icon-resize-full-2"></i></a></li>
                            <li class="dropdown topbar-profile">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="rounded-image topbar-profile-image"><img src="assets/img/icons/user.png"></span> <?php echo $user->data()->first_name . ' ' . $user->data()->last_name; ?> <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="profile.php?user=<?php echo escape($user->data()->username); ?>">My Profile</a></li>
                                    <li><a href="change_password.php">Change Password</a></li>
                                    <li class="divider"></li>
                                    <li><a class="md-trigger" data-modal="logout-modal"><i class="icon-logout-1"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <!-- Top Bar End -->
        <!-- Left Sidebar Start -->
        <div class="left side-menu">
            <div class="sidebar-inner slimscrollleft">
                <div class="clearfix">&nbsp;</div>
                <!--- Profile -->
                <div class="profile-info">
                    <div class="col-xs-4">
                        <a href="profile.php?user=<?php echo escape($user->data()->username); ?>" class="rounded-image profile-image"><img src="assets/img/icons/user.png"></a>
                    </div>
                    <div class="col-xs-8">
                        <div class="profile-text">Welcome <b><?php echo $user->data()->first_name; ?></b></div>
                        <div class="profile-buttons">
                            <a href="profile.php?user=<?php echo escape($user->data()->username); ?>" data-toggle="tooltip" title="Profile"><i class="fa fa-user"></i></a>
                            <a href="lockscreen.php?user=<?php echo escape($user->data()->username); ?>" data-toggle="tooltip" title="Lock Dashboard"><i class="fa fa-lock"></i></a>
                            <a href="#" class="md-trigger" data-modal="logout-modal" data-toggle="tooltip" title="Sign Out"><i class="fa fa-power-off text-red-1"></i></a>
                        </div>
                    </div>
                </div>
                <!--- Divider -->
                <div class="clearfix"></div>
                <hr class="divider" />
                <div class="clearfix"></div>
                <!--- Divider -->
                <div id="sidebar-menu">
                    <ul>
                        <?php
                            $current_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            $filename = basename($current_url);
                        ?>
                        <li>
                            <a href="index.php" class="<?php if ($filename === 'index.php') echo 'active'; ?>"><i class='fa fa-home'></i><span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="vehicles.php" class="<?php if ($filename === 'vehicles.php') echo 'active'; ?>"><i class='fa fa-car'></i><span>Vehicles</span></a>
                        </li>
                        <li>
                            <a href="reservations.php" class="<?php if ($filename === 'reservations.php') echo 'active'; ?>"><i class='fa fa-calendar'></i><span>Reservations</span></a>
                        </li>
                        <li>
                            <a href="user-management.php" class="<?php if ($filename === 'user-management.php') echo 'active'; ?>"><i class='fa fa-users'></i><span>User Management</span></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Start right content -->
        <div class="content-page">
