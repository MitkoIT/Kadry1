<body>
    <div class="d-flex">
        <!--Sidebar-->
        <aside id="sidebar" class="sidebar-toggle">
            <div class="sidebar-logo">
                <a href="<?php echo base_url() ?>/">Panel<br>Administracyjny</a>
            </div>
            <!--Sidebar Navigation-->
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
            <!--Sidebar Navigation Ends-->
            <div class="sidebar-footer">
                
            </div>
        </aside>
        <!--Sidebar Ends-->
<!-- Name and Logout Panel Starts -->
<div class="main">
<div class="d-flex justify-content-between mt-0 welcome-bar rounded-bottom">
    <div class="date-logo m-3 mt-3">
        <p id="date"></p>
    </div>
    <div class="mt-3">
        <span class="logged-user">
            <?php
                $session = session(); 
                echo 'Witaj '.$session->get('name');
            ?>
        </span>
        <button type="button" class="btn btn-seccond rounded-start"
            onclick="window.location='<?php echo base_url()?>/logout'">
            <span class="badge bg-danger">
                Wyloguj
            </span>
        </button>
    </div>
</div>

<script src="<?php echo base_url() ?>script/CurrentDate.js"></script>