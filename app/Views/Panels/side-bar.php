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
                <li class="sidebar-items">
                    <a href="<?php echo base_url()?>active">Użytkownicy</a>
                </li>
                <li class="sidebar-items">
                    <a href="<?php echo base_url()?>budget-allbudgets">Budżety</a>
                </li>
            </ul>
            <!--Sidebar Navigation Ends-->
            <div class="sidebat-footer">
                
            </div>
        </aside>
        <!--Sidebar Ends-->
        <div class="main">
<div class="d-flex justify-content-end mt-3">
    <span class="mt-3">
        <span class="logged-user">
            <?php
                $session = session(); 
                echo 'Witaj '.$session->get('name');
            ?>
        </span>
    </span>
    <button type="button" class="btn btn-seccond rounded-start"
        onclick="window.location='<?php echo base_url()?>/logout'">
        <span class="badge bg-danger">
            Wyloguj
        </span>
    </button>
</div>