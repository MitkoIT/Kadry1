<!--<div class="title-area">
    <a href="<?= base_url() ?>">Kadry</a>
</div>-->

<body>
    <div class="d-flex">
        <!--Sidebar-->
        <aside id="sidebar" class="sidebar-toggle">
            <div class="sidebar-logo">
                <a href="<?php echo base_url() ?>/">Kadry</a>
            </div>
            <ul class="sidebar-nav p-9">
                <li class="sidebar-header">
                    Zarządzaj
                </li>
                <li class="sidebar-items link-button">
                    <a href="<?php echo base_url()?>active">
                        <strong>Użytkownicy</strong>
                    </a>
                </li>
                <li class="sidebar-items link-button">
                    <a href="<?php echo base_url()?>budget-allbudgets">
                        <strong>Budżety</strong>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <div class="sidebar-footer-container">
                    <div class="btn-group">
                        <button
                            type="button"
                            class="btn dropdown-toggle caret text-white"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        ><?= session()->get('name') ?></button>
                        <ul class="dropdown-menu dropdown-menu-end navbar-default dropdown-default text-center ps-3 pe-3 dropdown-style">
                            <li>
                                <a class="nav-link" href="<?= base_url('/logout') ?>">
                                    Wyloguj
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!--Sidebar Ends-->

        
<!-- Name and Logout Panel Starts -->
<div class="main">
<!--<div class="d-flex justify-content-between mt-0 welcome-bar">
    <div class="date-logo m-3 mt-3">
        <p id="date"></p>
    </div>
    <div class="mt-3">
        <span class="logged-user">
            <?= session()->get('name') ?>
        </span>
        <button type="button" class="btn btn-seccond rounded-start"
            onclick="window.location='<?php echo base_url()?>/logout'">
            <span class="badge bg-danger">
                Wyloguj
            </span>
        </button>
    </div>
</div>-->

<script src="<?php echo base_url() ?>script/CurrentDate.js"></script>