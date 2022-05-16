<!DOCTYPE html>
<html class="loading" lang="es">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="VERDUM PERÚ SAC">
    <title>Verdum Perú (portaldistribuidor y selección)</title>
    <!-- <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL ?>public/dist/img/favicon.png">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico"> -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <?php if (isset($_layoutParams['cssSp']) && count($_layoutParams['cssSp'])) : ?>
        <?php foreach ($_layoutParams['cssSp'] as $layoutcssSp) : ?>
            <link rel="stylesheet" href="<?php echo  $layoutcssSp ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<!-- <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col=""> -->

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center" data-nav="brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="../../../html/rtl/vertical-menu-template/index.html">
                        <span class="brand-logo">
                            <img class="brand-image" src="<?php echo BASE_URL ?>public/dist/img/favicon.png" alt="avatar" height="32" width="40">
                        </span>
                        <h2 class="brand-text">VERDUM</h2>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                        <li class="dropdown-menu-header">
                            <div class="dropdown-header d-flex">
                                <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                                <div class="badge badge-pill badge-light-primary">6 New</div>
                            </div>
                        </li>
                        <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar"><img src="../../../app-assets/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar"><img src="../../../app-assets/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32"></div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content">MD</div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                    </div>
                                </div>
                            </a>
                            <div class="media d-flex align-items-center">
                                <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                                <div class="custom-control custom-control-primary custom-switch">
                                    <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">
                                    <label class="custom-control-label" for="systemNotification"></label>
                                </div>
                            </div><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar bg-light-danger">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to hight CPU usage</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar bg-light-success">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">Sales report</span>&nbsp;generated</p><small class="notification-text"> Last month sales report generated</small>
                                    </div>
                                </div>
                            </a><a class="d-flex" href="javascript:void(0)">
                                <div class="media d-flex align-items-start">
                                    <div class="media-left">
                                        <div class="avatar bg-light-warning">
                                            <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <p class="media-heading"><span class="font-weight-bolder">High memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server using high memory</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder"><?php echo $_SESSION['usuario'] ?></span>
                            <span class="user-status"><?php echo $_SESSION['perfil'] ?></span>
                        </div><span class="avatar">
                            <img class="round" src="<?php echo BASE_URL . $_SESSION['foto'] ?>" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="<?php echo BASE_URL ?>index/logout"><i class="mr-50" data-feather="power"></i>Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="horizontal-menu-wrapper">
        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-shadow menu-border" role="navigation" data-menu="menu-wrapper" data-menu-type="floating-nav">
            <!-- Horizontal menu content-->
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <!-- include ../../../includes/mixins-->

                <!-- <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="dropdown nav-item" data-menu="dropdown">
                        <a class="dropdown-toggle nav-link d-flex align-items-center" href="index.html">
                            <i data-feather="home"></i>
                            <span data-i18n="Dashboards">Dashboards</span>
                        </a>
                        
                        <ul class="dropdown-menu">
                            <li data-menu="">
                                <a class="dropdown-item d-flex align-items-center" href="dashboard-analytics.html">
                                    <i data-feather="activity"></i><span>Analytics</span>
                                </a>
                            </li>
                            <li class="active" data-menu="">
                                <a class="dropdown-item d-flex align-items-center" href="dashboard-ecommerce.html">
                                    <i data-feather="shopping-cart"></i><span>eCommerce</span>
                                </a>
                            </li>
                            <li class="" data-menu="">
                                <a class="dropdown-item d-flex align-items-center" href="dashboard-ecommerce.html">
                                    <i data-feather="shopping-cart"></i><span>eCommerce</span>
                                </a>
                            </li>
                        </ul>

                    </li>
                </ul> -->

                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <?php foreach ($_SESSION['menus'] as $menu) { ?>
                        
                        <li class="dropdown nav-item <?php if ($_SESSION['selmenu'] == $menu['v_link']) {if ($menu['i_submenu']==1){echo "";}else{echo "active";}}?> <?php if ($_SESSION['selmenu'] == $menu['v_link']) {echo $_SESSION['despliegue'];}?>" data-menu="dropdown">
                            <a class="dropdown-toggle nav-link d-flex align-items-center" onclick="navegacionmenu('<?php echo $menu['v_link'] ?>')" href="<?php echo BASE_URL . $menu['v_link'] ?>/index">
                                <i data-feather="<?php echo $menu['v_icono'] ?>"></i>
                                <span class="menu-title text-truncate"><?php echo str_replace("&otilde;", "ó", $menu['v_nombre']) ?></span>
                            </a>
                            <ul class="dropdown-menu">
                            <?php if (isset($_SESSION['submenus'])) { ?>
                                <?php foreach ($_SESSION['submenus'] as $submenu) { ?>
                                    <?php if ($submenu['i_idmenu'] == $menu['i_id']) { ?>

                                            <li data-menu="" class="<?php if ($_SESSION['selsubmenu'] == $submenu['v_link']) {echo "active";} else {echo "";} ?>">
                                                <a onclick="clicksub('<?php echo $submenu['v_link'] ?>')" class="dropdown-item d-flex align-items-center" href="<?php echo BASE_URL . $submenu['v_link'] ?>/index" class="nav-link">
                                                    <i data-feather="<?php echo $submenu['v_icono'] ?>"></i>
                                                    <span><?php echo $submenu['v_nombre'] ?></span>
                                                </a>
                                            </li>
                                        
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            </ul>
                        </li>

                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- END: Main Menu-->