<div class="horizontal-layout">   
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar" class="container-fluid">
        <div class="rightbar">
            <div class="contentbar">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title"><?= $title ?></h5>
                                <a
                                    class="btn btn-sm btn-success text-white"
                                    href="<?= base_url('pracownik/nowy') ?>"
                                    >Dodaj pracownika
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="display table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>l.p</th>
                                                <th>Imię i nazwisko</th>
                                                <th>Firma</th>
                                                <th>Przypisane role</th>
                                                <th>Ostatnie logowanie</th>
                                                <th>Logi</th>
                                                <th>Akcja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($employees['users'] as $employee) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $employee->id ?></td>
                                                        <td>
                                                            <p>
                                                                <?= $employee->name ?><br>
                                                                <small>
                                                                    <a
                                                                        class="fs-3"
                                                                        href="mailto:<?= $employee->email ?>"
                                                                        ><?= $employee->email ?>
                                                                    </a>
                                                                </small>
                                                            </p>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                foreach ($employees['companies'][$employee->id] ?? [] as $company) {
                                                                    ?>
                                                                    <span class="badge badge-dark"><?= $company ?></span>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                foreach (explode(",", $employee->role) ?? [] as $role) {
                                                                    if (strlen($role) > 1) {
                                                                        ?>
                                                                        <span class="badge badge-primary">
                                                                            <?= $role ?>
                                                                        </span>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?= $employees['logins'][$employee->id] ?? null ?></td>
                                                        <td>
                                                            <a
                                                                class="btn btn-sm btn-primary text-white"
                                                                href="<?= base_url('pracownik/'.$employee->id.'/logi') ?>"
                                                                >Logi
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <a
                                                                class="btn btn-sm btn-success text-white"
                                                                href="<?= base_url('pracownik/'.$employee->id) ?>"
                                                                >Edytuj
                                                            </a>
                                                            <a
                                                                class="btn btn-sm btn-success text-white"
                                                                href="<?= base_url('pracownik/'.$employee->id.'/aplikacje') ?>"
                                                                >Aplikacje
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>l.p</th>
                                                <th>Imię i nazwisko</th>
                                                <th>Firma</th>
                                                <th>Przypisane role</th>
                                                <th>Ostatnie logowanie</th>
                                                <th>Logi</th>
                                                <th>Akcja</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>