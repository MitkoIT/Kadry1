<!--Main Component-->
<div class="main">
    <div class="d-flex justify-content-end">
        tutaj ma byc kto jest zalogowany po lewej stronie ekranu i przycisk wyloguj
    </div>
    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-3 text-center">
                <h1 class="title-space">
                    <?php echo $header; ?>
                </h1>
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
                        onclick="window.location='<?php echo base_url()?>paste'">Dodaj Użytkownika</button>
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
                                        <td class="text-center align-middle">
                                            <a href="<?php echo base_url()?>edit/<?php echo $user['idusers'] ?>/<?php echo $user['idcompany'] ?>">Edytuj</a> 
                                            <br>
                                            <a href="<?php echo base_url()?>setunactive/<?php echo $user['idusers'] ?>">Deaktywuj</a> 
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                        </table>
                        <!-- Pagination Links -->
                        <?= $pager->links(); ?>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!--Main Component Ends-->
