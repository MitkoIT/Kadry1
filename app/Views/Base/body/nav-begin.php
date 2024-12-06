<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Olian is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, admin theme, bootstrap 4, responsive, sass support, ui kits, crm, ecommerce">
    <meta name="author" content="Themesbox17">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Kadry | <?= $page->title ?></title>
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
            <h4>Ustawienia</h4><a href="javascript:void(0)" id="infobar-settings-close" class="infobar-settings-close"><span class="iconbar"><i class="ri-close-line menu-hamburger-close"></i></span></a>
        </div>
        <div class="infobar-settings-sidebar-body">
            <div class="custom-mode-setting" style="display: none">
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
                                </ul>
                            </div>
                            <div class="infobar">
                                <ul class="list-inline mb-0">
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
                                                    <span class="iconbar"><i class="ri-notification-3-line"></i><!--<span class="live-icon"></span>--></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notoficationlink">
                                                    <div class="notification-dropdown-title">
                                                        <h5>Powiadomienia<a href="#">Wyczyść</a></h5>                            
                                                    </div>
                                                    <ul class="list-unstyled">                                                    
                                                        <!--<li class="media dropdown-item">
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
                                                        </li>-->
                                                    </ul>
                                                    <div class="notification-dropdown-footer">
                                                        <h5><a href="#">Zobacz wszystkie</a></h5>                            
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
                                                    <a class="dropdown-item text-danger" href="<?= base_url('wylogowywanie') ?>">
                                                        <i class="ri-shut-down-line"></i>
                                                        Wyloguj się
                                                    </a>
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
                                    <a href="<?= base_url() ?>">
                                        <i class="ri-dashboard-line"></i>
                                        <span>Strona główna</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="<?= base_url('pracownicy') ?>" class="dropdown-toggle" data-toggle="dropdown"><i class="ri-apps-line"></i><span>Pracownicy</span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= base_url('pracownicy') ?>">Lista pracowników</a></li>
                                        <li><a href="<?= base_url('pracownik/nowy') ?>">Dodaj nowego pracownika</a></li>
                                        <?php
                                            foreach ($page->companies as $company) {
                                                ?>
                                                <li>
                                                    <a
                                                        href="<?= base_url('pracownicy/'.$company->id) ?>"
                                                        >Pracownicy <span style="text-transform: capitalize"><?= strtolower($company->name) ?></span>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>