<!--Main Component-->
<div class="main">
    <div class="d-flex justify-content-end">
        <span>Użytkownik </span>
        <a href="#" class="mx-4">
            <i class="lni lni-exit"></i>
            <span>Wyloguj</span> 
        </a>
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
                        onclick="window.location='<?php echo base_url()?>/'">Wszyscy</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" 
                        onclick="window.location='<?php echo base_url()?>active'">Aktywni</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" 
                        onclick="window.location='<?php echo base_url()?>unactive'">Nieaktywni</button>
                    </div>
                    <div class="col-auto">
                        <?php echo form_open('search') ?>
                            <?php 
                                $attribs = [
                                    'name'          => 'name',
                                    'type'          => 'text', 
                                    'placeholder'   => 'Imię i Nazwisko',
                                    'class'         => 'form-control',
                                ];
                                echo form_input($attribs); 
                            ?>
                    </div>
                    <div class="col-auto">
                        <div class="col-auto">
                            <?php
                                $attrib = [
                                    'class' => 'btn btn-secondary',
                                    'type'  => 'submit', 
                                    'value' => 'Szukaj'
                                ];
                                echo form_input($attrib);
                            ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" 
                            onclick="window.location='<?php echo base_url()?>paste'">
                            Dodaj Użytkownika
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Imię i nazwisko</th>
                                <th>Tel.</th>
                                <th>Firma</th>
                                <th>Action</th>
                            </tr>
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
                                            <button type="button" class="btn btn-success btn-sm btn-sml" 
                                                onclick="window.location='<?php echo base_url()?>edit/<?php echo $user['idusers'] ?>/<?php echo $user['idcompany'] ?>'">
                                                Edytuj
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm btn-sml" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deactiveModal"
                                                data-userid = "<?php echo $user['idusers'] ?>"
                                                data-username = "<?php echo $user['user_name'] ?>"
                                                data-path = "<?php echo base_url()?>setunactive/">
                                                Deaktywuj
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                        </table>
                        <!-- Pagination Links -->
                        <?= $pager->links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="deactiveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Potwierdz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Czy na pewno chcesz deaktywować użytkownika <span id="user-name"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <button type="button" class="btn btn-primary" id="confirm-deactivate">
                        Tak
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Main Component Ends-->
