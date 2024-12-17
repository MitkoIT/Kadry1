<div class="modal fade" id="deactivateEmploeeModal" tabindex="-1" role="dialog" aria-labelledby="deactivateEmploeeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Potwierdź dezaktywację</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input
                    type="hidden"
                    id="deactivateEmploeeModalId"
                    value=""
                />
                <p class="text-muted">Czy napewno chcesz zdezaktywować pracownika <span id="deactivateEmploeeModalUser">{name}</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-danger-rgba" onclick="deactivateEmployee()" data-dismiss="modal">Zdezaktywuj pracownika</button>
            </div>
        </div>
    </div>
</div>
<div class="horizontal-layout">   
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar" class="container-fluid">
        <div class="rightbar">
            <div class="contentbar">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card m-b-30">
                            <div class="card-header row align-items-center">
                                <div class="col-6">
                                    <h5 class="card-title"><?= $data['title'] ?></h5>
                                </div>
                                <div class="col-6">
                                    <ul class="list-inline-group text-right mb-0 pl-0">
                                        <li class="list-inline-item">
                                            <div class="form-group mb-0 amount-spent-select">
                                                <select class="form-control" id="employeeSelect">
                                                    <option>Wszyscy</option>
                                                    <option <?= $data['selected'] === 'aktywni' ? 'selected' : null ?>>Aktywni</option>
                                                    <option <?= $data['selected'] === 'nieaktywni' ? 'selected' : null ?>>Nieaktywni</option>
                                                </select>
                                            </div>
                                        </li>
                                    </ul>                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="display table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Imię i nazwisko</th>
                                                <th>Firma</th>
                                                <th>Schemat</th>
                                                <th>Akcja</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach ($data['employees']['companyUsers'] as $employee) {
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
                                                                foreach ($data['employees']['companies'][$employee->id] ?? [] as $company) {
                                                                    ?>
                                                                    <span class="badge badge-dark"><?= $company ?></span>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </td>
                                                        <td class="col-5">
                                                            <ul>
                                                                <?php
                                                                    foreach ($data['employees']['schema'][$employee->id] ?? [] as $schema) {
                                                                        ?>
                                                                        <li>
                                                                            <b><?= $schema['child']->name ?></b>
                                                                            <?php
                                                                                if ($schema['child']->description) {
                                                                                    echo ' / '.$schema['child']->description;
                                                                                }
                                                                                
                                                                                foreach ($schema['parent']->employees ?? [] as $parentEmployee) {
                                                                                    if (isset($data['employees']['users'][$parentEmployee->userId])) {
                                                                                        echo ' - [<small>Szef: '.$data['employees']['users'][$parentEmployee->userId]->name.' - '.$schema['parent']->name;
                                                                                        if ((!is_null($parentEmployee->description)) &&
                                                                                            (($parentEmployee->description != ''))) {
                                                                                            echo ' / '.$parentEmployee->description;
                                                                                        }
                                                                                        echo '</small>]';
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <div class="container-buttons">
                                                                <a
                                                                    type="button"
                                                                    class="btn btn-primary-rgba"
                                                                    href="<?= base_url('pracownik/'.$employee->id) ?>"
                                                                    ><span class="ti-pencil"></span>
                                                                </a>
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-danger-rgba"
                                                                    data-toggle="modal"
                                                                    data-target="#deactivateEmploeeModal"
                                                                    onclick="loadEmployeeToModal({name: '<?= $employee->name ?>', id: '<?= $employee->id ?>'})"
                                                                    ><span class="ti-trash"></span>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Imię i nazwisko</th>
                                                <th>Firma</th>
                                                <th>Schemat</th>
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
<script
    src="<?= base_url('public/assets/js/custom/custom-table-employees.js') ?>"
    data-base-url="<?= base_url() ?>"
    data-company-id="<?= $data['company']->id ?? null ?>"
    >
</script>