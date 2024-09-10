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
                        <span>Dodaj<br>Użytkownika</span>
                    </a>
                </li>
                <li class="sidebar-items">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Edytuj<br>Użytkownika</span>
                    </a>
                </li>
                <li class="sidebar-items">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>Dezaktywuj<br>Użytkownika</span>
                    </a>
                </li>
                <li class="sidebar-header">
                    Statystyki
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="true" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Użytkownik</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="sidebar">
                        <li class="sidebar-item">
                            <a href="<?php echo base_url()?>/active/y" class="sidebar-link">
                                Aktywny
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="<?php echo base_url()?>/active/n" class="sidebar-link">
                                Nieaktywny
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
        <!--Main Component-->
        <div class="main">
            <nav class="navbar navbar-expand border-bootom">
                <button class="toggler-btn" type="button">
                    <i class="lni lni-text-align-left"></i>
                </button>
            </nav>
            <main class="p-3">
                <div class="container-fluid">
                    <div class="mb-3 text-center">
                        <h1><?php echo $header; ?></h1>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th>ID</th>
                                        <th>Imię</th>
                                        <th>Email</th>
                                        <th>Tel.</th>
                                    </tr>
                                    <?php
                                        if ($user_data) {
                                            foreach ($user_data as $user) {
                                                echo '
                                                    <tr>
                                                    <td>'.$user['idusers'].'</td>
                                                    <td>'.$user['name'].'</td>
                                                    <td>'.$user['email'].'</td>
                                                    <td>'.$user['phone_shop_mitko'].'</td>
                                                    </tr>';
                                            }
                                        }
                                    ?>
                                </table>
                            </div>
                        <div>
                </div>
            </div>
                    </div>
                </div>
            </main>
        </div>
        <!--Main Component Ends-->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="<?php base_url()?>script/script.js"></script>
