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
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Dodaj Użytkownika</span>
                    </a>
                </li>
                <li class="sidebar-header">
                    Statystyki
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="true" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Użytkownicy</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url()?>active/y" class="sidebar-link">
                                Aktywni
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url()?>active/n" class="sidebar-link">
                                Nieaktywni
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--Sidebar Navigation Ends-->
            <div class="sidebat-footer">
                <a href="#" class="sidebar-link">
                   <i class="lni lni-exit"></i>
                   <span>Wyloguj</span> 
                </a>
            </div>
        </aside>
        <!--Sidebar Ends-->