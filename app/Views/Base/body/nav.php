<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Olian is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, admin theme, bootstrap 4, responsive, sass support, ui kits, crm, ecommerce">
    <meta name="author" content="Themesbox17">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Kadry - <?= $page->title ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>">
    <link href="<?= base_url('public/assets/plugins/switchery/switchery.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public/assets/css/icons.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public/assets/css/flag-icon.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public/assets/css/style.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public/assets/css/custom.css') ?>" rel="stylesheet" type="text/css">
</head>
<body class="horizontal-layout">
    <div id="infobar-settings-sidebar" class="infobar-settings-sidebar">
        <div class="infobar-settings-sidebar-head d-flex w-100 justify-content-between">
            <h4>Settings</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><span class="iconbar"><i class="ri-close-line menu-hamburger-close"></i></span></a>
        </div>
        <div class="infobar-settings-sidebar-body">
            <div class="custom-mode-setting">
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Popup Notification</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-first" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Message Sound</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-second" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Generate Report</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-third" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Email Statement</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-fourth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Invoice PDF</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-fifth" checked /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Add Users</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-sixth" /></div>
                </div>
                <div class="row align-items-center pb-3">
                    <div class="col-8"><h6 class="mb-0">Show Sidebar</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-seventh" checked /></div>
                </div>
                <div class="row align-items-center">
                    <div class="col-8"><h6 class="mb-0">Sticky Topbar</h6></div>
                    <div class="col-4"><input type="checkbox" class="js-switch-setting-eightth" checked /></div>
                </div>
            </div>
        </div>
    </div>
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar" class="container-fluid">
        <div class="rightbar">
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="mobile-logobar">
                            <a href="index.html" class="mobile-logo"><img src="<?= base_url('public/assets/images/logo.svg') ?>" class="img-fluid" alt="logo"></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="topbar-toggle-icon">
                                        <a class="topbar-toggle-hamburger" href="javascript:void();">
                                            <span class="iconbar">
                                                <i class="ri-more-fill menu-hamburger-horizontal"></i>
                                                <i class="ri-more-2-fill menu-hamburger-vertical"></i>
                                            </span>
                                         </a>
                                     </div>
                                </li>
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger navbar-toggle bg-transparent" href="javascript:void();" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="true">
                                            <span class="iconbar">
                                                <i class="ri-menu-2-line menu-hamburger-collapse"></i>
                                                <i class="ri-close-line menu-hamburger-close"></i>
                                            </span>
                                        </a>
                                     </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="topbar">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-12 align-self-center">
                            <div class="togglebar">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="logobar">
                                            <a href="index.html" class="appTitle">KADRY</a>
                                        </div>
                                    </li>
                                    <li class="list-inline-item list-inline-item-center">
                                        <div>
                                        <div class="searchbar">
                                            <form>
                                                <div class="input-group">
                                                  <input type="search" class="form-control" placeholder="Wyszukaj" aria-label="Search" aria-describedby="button-addon2">
                                                  <div class="input-group-append">
                                                    <button class="btn" type="submit" id="button-addon2"><i class="ri-search-2-line"></i></button>
                                                  </div>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="infobar">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="languagebar">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="languagelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="iconbar iconbar-md"><i class="flag flag-icon-us flag-icon-squared"></i></span></a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languagelink">
                                                    <a class="dropdown-item" href="#"><i class="flag flag-icon-us flag-icon-squared"></i>English</a>
                                                    <a class="dropdown-item" href="#"><i class="flag flag-icon-de flag-icon-squared"></i>German</a>
                                                    <a class="dropdown-item" href="#"><i class="flag flag-icon-bl flag-icon-squared"></i>France</a>
                                                    <a class="dropdown-item" href="#"><i class="flag flag-icon-ru flag-icon-squared"></i>Russian</a>
                                                </div>
                                            </div>
                                        </div>                                   
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="settingbar">
                                            <a href="javascript:void(0)" id="infobar-settings-open" class="infobar-icon">
                                                <span class="iconbar"><i class="ri-settings-3-line"></i></span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="notifybar">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle infobar-icon" href="#" role="button" id="notoficationlink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="iconbar"><i class="ri-notification-3-line"></i><span class="live-icon"></span></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notoficationlink">
                                                    <div class="notification-dropdown-title">
                                                        <h5>Notifications<a href="#">Clear all</a></h5>                            
                                                    </div>
                                                    <ul class="list-unstyled">                                                    
                                                        <li class="media dropdown-item">
                                                            <span class="action-icon badge badge-primary"><i class="ri-archive-line"></i></span>
                                                            <div class="media-body">
                                                                <h5 class="action-title">Product Added</h5>
                                                                <p><span class="timing">Today, 08:40 AM</span></p>                            
                                                            </div>
                                                        </li>
                                                        <li class="media dropdown-item">
                                                            <span class="action-icon badge badge-success"><i class="ri-price-tag-3-line"></i></span>
                                                            <div class="media-body">
                                                                <h5 class="action-title">Sale Started</h5>
                                                                <p><span class="timing">Today, 03:45 PM</span></p>                            
                                                            </div>
                                                        </li>
                                                        <li class="media dropdown-item">
                                                            <span class="action-icon badge badge-warning"><i class="ri-file-text-line"></i></span>
                                                            <div class="media-body">
                                                                <h5 class="action-title">Kelly Reported</h5>
                                                                <p><span class="timing">5 June 2020, 02:20 PM</span></p>                            
                                                            </div>
                                                        </li>
                                                        <li class="media dropdown-item">
                                                            <span class="action-icon badge badge-danger"><i class="ri-file-user-line"></i></span>
                                                            <div class="media-body">    
                                                                <h5 class="action-title">John Resigned</h5>
                                                                <p><span class="timing">2 June 2020, 11:11 AM</span></p>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <div class="notification-dropdown-footer">
                                                        <h5><a href="#">See all</a></h5>                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-inline-item">
                                        <div class="profilebar">
                                            <div class="dropdown">
                                              <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('public/assets/images/users/profile.svg') ?>" class="img-fluid" alt="profile"><span class="live-icon"><?= $user->name ?></span></a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                    <a class="dropdown-item" href="#"><i class="ri-user-6-line"></i>My Profile</a>
                                                    <a class="dropdown-item" href="#"><i class="ri-mail-line"></i>Email</a>
                                                    <a class="dropdown-item" href="#"><i class="ri-settings-3-line"></i>Settings</a>
                                                    <a class="dropdown-item text-danger" href="#"><i class="ri-shut-down-line"></i>Logout</a>
                                                </div>
                                            </div>
                                        </div>                                   
                                    </li>
                                    <li class="list-inline-item menubar-toggle">
                                        <div class="menubar">
                                            <a class="menu-hamburger navbar-toggle bg-transparent" href="javascript:void();" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="true">
                                                <span class="iconbar">
                                                    <i class="ri-menu-2-line menu-hamburger-collapse"></i>
                                                    <i class="ri-close-line menu-hamburger-close"></i>
                                                </span>
                                            </a>
                                         </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navigationbar">
                <div class="container-fluid">
                    <nav class="horizontal-nav mobile-navbar fixed-navbar">
                        <div class="collapse navbar-collapse" id="navbar-menu">
                            <ul class="horizontal-menu">
                                <li class="scroll">
                                    <a href="widgets.html">
                                        <i class="ri-dashboard-line"></i>
                                        <span>Strona główna</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown"><i class="ri-apps-line"></i><span>Użytkownicy</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="apps-calender.html">Aktywni</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown"><i class="ri-book-read-line"></i><span>Budżet</span></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown">
                                            <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown">Basic</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="page-starter.html">Starter</a></li>
                                                <li><a href="page-blog.html">Blog</a></li>
                                                <li><a href="page-faq.html">FAQ</a></li>
                                                <li><a href="page-gallery.html">Gallery</a></li>
                                                <li><a href="page-invoice.html">Invoice</a></li>
                                                <li><a href="page-pricing.html">Pricing</a></li>
                                                <li><a href="page-timeline.html">Timeline</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown" >Store</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="ecommerce-product-list.html">Product List</a></li>
                                                <li><a href="ecommerce-product-detail.html">Product Detail</a></li>
                                                <li><a href="ecommerce-order-list.html">Order List</a></li>
                                                <li><a href="ecommerce-order-detail.html">Order Detail</a></li> 
                                                <li><a href="ecommerce-shop.html">Shop</a></li>
                                                <li><a href="ecommerce-single-product.html">Single Product</a></li>
                                                <li><a href="ecommerce-cart.html">Cart</a></li>
                                                <li><a href="ecommerce-checkout.html">Checkout</a></li>
                                                <li><a href="ecommerce-thankyou.html">Thank You</a></li>
                                                <li><a href="ecommerce-myaccount.html">My Account</a></li>
                                            </ul>
                                        </li>                                    
                                        <li class="dropdown">
                                            <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown">Authentication</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="user-login.html">Login</a></li>
                                                <li><a href="user-register.html">Register</a></li>
                                                <li><a href="user-forgotpsw.html">Forgot Password</a></li>
                                                <li><a href="user-lock-screen.html">Lock Screen</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown">Error</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="error-comingsoon.html">Coming Soon</a></li>  
                                                <li><a href="error-maintenance.html">Maintenance</a></li>
                                                <li><a href="error-404.html">Error 404</a></li>
                                                <li><a href="error-500.html">Error 500</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>                 
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title"><?= $page->title ?></h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <?php
                                    foreach ($page->breadcrumbs as $key => $breadcrumb) {
                                        if ($breadcrumb->isLast == 1) {
                                            ?>
                                            <li class="breadcrumb-item active" aria-current="page">
                                                <?= $breadcrumb->name ?>
                                            </li>
                                            <?php
                                        } else {
                                            ?>
                                            <li class="breadcrumb-item">
                                                <a href="<?= base_url($breadcrumb->path) ?>"><?= $breadcrumb->name ?></a>
                                            </li>
                                            <?php
                                        }
                                    }
                                ?>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="widgetbar">
                            <button class="btn btn-primary"><i class="ri-refresh-line mr-2"></i>Odśwież</button>
                        </div>                        
                    </div>
                </div>          
            </div>
        </div>
    </div>
    <script src="<?= base_url('public/assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/modernizr.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/detect.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.slimscroll.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/horizontal-menu.js') ?>"></script>
    <script src="<?= base_url('public/assets/plugins/switchery/switchery.min.js') ?>"></script>    
    <script src="<?= base_url('public/assets/js/core.js') ?>"></script>
</body>
</html>