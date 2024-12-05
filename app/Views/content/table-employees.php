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
                                    <h5 class="card-title"><?= $title ?></h5>
                                </div>
                                <div class="col-6">
                                    <ul class="list-inline-group text-right mb-0 pl-0">
                                        <li class="list-inline-item">
                                            <div class="form-group mb-0 amount-spent-select">
                                                <select class="form-control" id="employeeSelect">
                                                    <option>Wszyscy</option>
                                                    <option <?= $selected === 'aktywni' ? 'selected' : null ?>>Aktywni</option>
                                                    <option <?= $selected === 'nieaktywni' ? 'selected' : null ?>>Nieaktywni</option>
                                                </select>
                                            </div>
                                            <a
                                                class="mt-2 btn btn-sm btn-success text-white"
                                                href="<?= base_url('pracownik/nowy') ?>"
                                                >Dodaj pracownika
                                            </a>  
                                        </li>
                                    </ul>                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="default-datatable" class="display table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Imię i nazwisko</th>
                                                <th>Firma</th>
                                                <th>Przypisane role</th>
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
                                                        <td>
                                                            <div class="btn-group">
                                                                <a
                                                                    type="button"
                                                                    class="btn btn-success-rgba"
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
                                                <th>Przypisane role</th>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const employeeSelect = document.getElementById('employeeSelect');

        employeeSelect.addEventListener('change', (event) => {
            const value = event.target.value;
            let url = '<?= base_url('pracownicy') ?>';
            if (value === 'Aktywni') {
                url = '<?= base_url('pracownicy/aktywni') ?>';
            } else if (value === 'Nieaktywni') {
                url = '<?= base_url('pracownicy/nieaktywni') ?>';
            }
            window.location.href = url;
        });
    });

    function loadEmployeeToModal(employee) {
        const deactivateEmploeeModalUser = document.getElementById('deactivateEmploeeModalUser');
        const deactivateEmploeeModalId = document.getElementById('deactivateEmploeeModalId');
        
        deactivateEmploeeModalUser.innerText = employee.name;
        deactivateEmploeeModalId.value = employee.id;
    }

    function deactivateEmployee() {
        const deactivateEmploeeModalId = document.getElementById('deactivateEmploeeModalId');
        const id = deactivateEmploeeModalId.value;
        
        $.ajax({
            url: '<?= base_url() ?>pracownik/'+id+'/zdezaktywuj',
            type: 'PUT',
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        });
    }
</script>