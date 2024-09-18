<!--Main Component-->
<div class="main">
    <div class="d-flex justify-content-end mt-3">
        <span class="mt-3"> Witaj! zalogowany użytkowniku </span>
        <button class="btn btn-danger mx-4">
            <i class="lni lni-exit"></i>
            Wyloguj
        </button>
    </div>
    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-3">
                <h1 class="title-space">
                    <b><?php echo $header; ?></b>
                </h1>
                <?php if (session()->getFlashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php } ?>
                <div class="row g-3 align-items-center szukaj-space">
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" 
                            onclick="window.location='<?php echo base_url()?>/'">
                            <i class="lni lni-users"></i>
                            Wszyscy
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" 
                            onclick="window.location='<?php echo base_url()?>active'">
                            <i class="lni lni-user"></i>
                            Aktywni
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" 
                            onclick="window.location='<?php echo base_url()?>unactive'">
                            <i class="lni lni-cross-circle"></i>
                            Nieaktywni
                        </button>
                    </div>
                    <div class="col-auto">
                        <?php echo form_open('search') ?>
                            <?php 
                                $attribs = [
                                    'name'          => 'name',
                                    'type'          => 'text', 
                                    'placeholder'   => 'Nazwisko i Imię',
                                    'class'         => 'form-control',
                                    'id'            => 'myInput',
                                    'onkeyup'       => 'MySearchFunction()',
                                ];
                                echo form_input($attribs); 
                            ?>
                    </div>
                    <div class="col-auto">
                        <div class="col-auto">
                            <?php
                                $attrib = [
                                    'class'     => 'btn btn-primary',
                                    'type'      => 'submit', 
                                    'value'     => 'Szukaj',
                                    'content' => '<i class="lni lni-search"></i> Szukaj'
                                ];
                                echo form_button($attrib);
                            ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" 
                            onclick="window.location='<?php echo base_url()?>paste'">
                            <i class="lni lni-plus"></i>
                            Dodaj Użytkownika
                        </button>
                    </div>
                </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Imię i nazwisko</th>
                                    <th class="text-center">Tel.</th>
                                    <th class="text-center">Firma</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($user_data) {
                                    foreach ($user_data as $user) { ?>
                                        <tr>
                                            <td class="text-center align-middle">
                                                <?php echo $user['idusers']; ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?php echo $user['user_name']; ?>
                                                <br>
                                                <span class="mail-span"> 
                                                    <?php echo $user['user_email']; ?>
                                                </span>
                                            </td>
                                            <td class="text-center align-middle"><?php echo $user['phone_shop_mitko']; ?></td>
                                            <td class="text-center align-middle"><?php echo $user['company_name']; ?> </td>
                                            <td class="text-center align-middle mb-2">
                                                <button type="button" class="btn btn-success btn-sm btn-sml rounded-start" 
                                                    onclick="window.location='<?php echo base_url()?>edit/<?php echo $user['idusers'] ?>/<?php echo $user['idcompany'] ?>'"
                                                    style="background-color:rgba(0, 255, 0, 0.3); color: #006400; border: 3px solid #0f0;">
                                                    <i class="lni lni-credit-cards"></i>
                                                    Edytuj
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm btn-sml rounded-end" 
                                                    style="background-color:rgba(255, 0, 0, 0.3);  color: rgb(255,0,0); border: 3px solid #f00;" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#deactiveModal"
                                                    data-userid = "<?php echo $user['idusers'] ?>"
                                                    data-username = "<?php echo $user['user_name'] ?>"
                                                    data-path = "<?php echo base_url()?>setunactive/">
                                                    <i class="lni lni-cross-circle"></i>
                                                    Deaktywuj
                                                </button>
                                            </td>
                                        </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                 <!-- Pagination Links -->
                    <?= $pager->links(); ?>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="deactiveModal" tabindex="-1" aria-labelledby="deactiveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deactiveModalLabel">Potwierdź</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Czy na pewno chcesz deaktywować użytkownika <span id="user-name"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="lni lni-backward"></i>
                        Nie
                    </button>
                    <button type="button" class="btn btn-success" id="confirm-deactivate">
                        <i class="lni lni-eraser"></i>
                        Tak
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Ends-->
</div>
<!--Main Component Ends-->
