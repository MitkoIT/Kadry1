<!--Main Component-->

    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-1">
                <div class="d-flex justify-content-betwean">
                    <h3 class="title-space">
                        <b><?php echo $header; ?></b>
                    </h3>
                </div>
                <?php if (session()->getFlashdata('success')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <div class="d-flex row g-3 szukaj-space">
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location='<?php echo base_url() ?>all-users'">
                            Wszyscy
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location='<?php echo base_url() ?>active'">
                            Aktywni
                        </button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location='<?php echo base_url() ?>unactive'">
                            Nieaktywni
                        </button>
                    </div>
                    <div class="col-auto">
                        <?php echo form_open('user-search') ?>
                        <?php
                        $attribs = [
                            'name' => 'name',
                            'type' => 'text',
                            'placeholder' => 'Nazwisko i Imię',
                            'class' => 'form-control',
                            'id' => 'myInput',
                            'onkeyup' => 'MySearchFunction()',
                        ];
                        echo form_input($attribs);
                        ?>
                    </div>
                    <div class="col-auto">
                        <div class="col-auto">
                            <?php
                            $attrib = [
                                'class' => 'btn btn-secondary',
                                'type' => 'submit',
                                'value' => 'Szukaj',
                                'content' => '<i class="lni lni-search"></i> Szukaj'
                            ];
                            echo form_button($attrib);
                            ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="col-auto ms-auto"> <!-- ms-auto pushes this button to the end -->
                        <button type="button" class="btn btn-secondary"
                            onclick="window.location='<?php echo base_url() ?>user-add'">
                            Dodaj Użytkownika
                        </button>
                    </div>
                </div>
                <div>
                    <div class="table-responsive border border-3 rounded">
                        <table id="myTable" class="table table-hover table-sm">
                            <thead class="custom-thead">
                                <tr>
                                    <th class="text-center">
                                        #ID
                                    </th>
                                    <th class="text-center">
                                        Imię i nazwisko
                                        <i class="lni lni-user"></i>
                                    </th>
                                    <th class="text-center">
                                        Tel.
                                        <i class="lni lni-phone"></i>
                                    </th>
                                    <th class="text-center">
                                        Firma
                                        <i class="lni lni-stamp"></i>
                                    </th>
                                    <?php if ($header == 'Wszyscy Użytkownicy') { ?>
                                        <th class="text-center">
                                            Status
                                            <i class="lni lni-bulb"></i>
                                        </th>
                                    <?php } ?>
                                    <th class="text-center">
                                        Akcja
                                        <i class="lni lni-agenda"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($user_data) {
                                    foreach ($user_data as $user) { ?>
                                        <tr>
                                            <td class="text-center align-middle">
                                                <strong>
                                                    #<?php echo $user['idusers']; ?>
                                                </strong>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?php echo $user['user_name']; ?>
                                                <br>
                                                <span class="mail-span">

                                                    <?php echo $user['user_email']; ?>
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?php
                                                    if ($user['phone']) {
                                                        echo $user['phone'];
                                                    } else { ?>
                                                        <span class="badge bg-danger">
                                                            <?php echo 'Ten Użytkownik nie posiada przypisanego telefonu' ?>
                                                        </span>
                                                    <?php } 
                                                ?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?php
                                                if ($user['company_name']) {
                                                    $parts = explode(',', $user['company_name']);
                                                    $parts = array_map('trim', $parts);

                                                    foreach ($parts as $part) { ?>
                                                        <span class="badge bg-secondary">
                                                            <?php echo $part; ?>
                                                        </span>
                                                    <?php }
                                                } else { ?>
                                                    <span class="badge bg-danger">
                                                        <?php echo 'Ten Użytkownik nie posiada przypisanej firmy.' ?>
                                                    </span>
                                                <?php }
                                                ?>
                                            </td>
                                            <?php if ($header == 'Wszyscy Użytkownicy') { ?>
                                                <td class="text-center align-middle">
                                                    <?php if ($user['active'] == 'n') { ?>
                                                        <span class="badge bg-danger">
                                                            Nieaktywny
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-success">
                                                            Aktywny
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                            <?php } ?>
                                            <td class="text-center align-middle justify-content-center">
                                                <button type="button" class="btn btn-seccond rounded-start"
                                                    onclick="window.location='<?php echo base_url() ?>user-edit/<?php echo $user['idusers'] ?>'">
                                                    <span class="badge bg-secondary">
                                                        Edytuj
                                                    </span>
                                                </button>
                                                <br>
                                                <?php if ($user['active'] == 'y') { ?>
                                                    <button type="button" class="btn btn-seccond rounded-end" data-bs-toggle="modal"
                                                        data-bs-target="#deactiveModal" data-userid="<?php echo $user['idusers'] ?>"
                                                        data-username="<?php echo $user['user_name'] ?>"
                                                        data-path="<?php echo base_url() ?>setunactive/">
                                                        <span class="badge bg-secondary">
                                                            Deaktywuj
                                                        </span>
                                                    </button>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-1">
                     <!-- Display pagination links only if there are multiple pages -->
                    <?php if ($pager) { ?>
                        <?= $pager->links(); ?>
                    <?php }
                    ?>
                </div>
            </div>
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
                    <button type="button" class="btn btn-seccond" data-bs-dismiss="modal">
                        <i class="lni lni-backward"></i>
                        Nie
                    </button>
                    <button type="button" class="btn btn-seccond" id="confirm-deactivate">
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
<script src="<?php echo base_url() ?>script/Modalscript.js"></script>
<script src="<?php echo base_url() ?>script/UserSearch.js"></script>