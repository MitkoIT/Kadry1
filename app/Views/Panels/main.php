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
                <h1 class="title-space">
                    <?php echo $header; ?>
                </h1>
                <div class="row g-3 align-items-center szukaj-space">
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo base_url()?>/'">Wszyscy</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo base_url()?>active'">Aktywni</button>
                    </div>
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" onclick="window.location='<?php echo base_url()?>unactive'">Nieaktywni</button>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="inputName" class="form-control" placeholder="Imię i Nazwisko" name="name">
                    </div>
                    <div class="col-auto">
                        <div class="col-auto">
                            <button type="button" class="btn btn-secondary">Szukaj</button>
                        </div>
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
                                        <td>
                                            <?php echo $user['idusers']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_name']; ?>
                                            <br>
                                            <span class="mail-span"> 
                                                <?php echo $user['user_email']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo $user['phone_shop_mitko']; ?></td>
                                        <td><?php echo $user['company_name']; ?> </td>
                                        <td>
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
