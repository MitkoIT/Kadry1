<div class="modal fade" id="addNodeEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addNodeEmployeeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dodaj pracownika do stanowiska</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-12 col-form-label">Pracownik</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="addNodeEmployeeModalSelect">
                            <option>Wybierz pracownika</option>
                            <?php
                                foreach ($data['employees']['all']['users'] ?? [] as $employee) {
                                    ?>
                                    <option value="<?= $employee->id ?>"><?= $employee->id ?> - <?= $employee->name ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <input
                    type="hidden"
                    id="addNodeEmployeeModalId"
                    value=""
                />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-primary-rgba" onclick="addNodeEmployee()" data-dismiss="modal">Dodaj przypisanie</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteNodeEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="deleteNodeEmployeeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Potwierdź usunięcie przypisania</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input
                    type="hidden"
                    id="deleteNodeEmployeeModalId"
                    value=""
                />
                <p class="text-muted">Czy napewno chcesz usunąć przypisanie pracownika <span id="deleteNodeEmployeeModalUser">{name}</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-danger-rgba" onclick="deleteNodeEmployee()" data-dismiss="modal">Usuń przypisanie</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteJobPositionModal" tabindex="-1" role="dialog" aria-labelledby="deleteJobPositionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Potwierdź usunięcie stanowiska</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input
                    type="hidden"
                    id="deleteNodeEmployeeModalId"
                    value=""
                />
                <p class="text-muted">Czy napewno chcesz usunąć to stanowisko i wszystkie podległe?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-danger-rgba" onclick="deleteJobPosition()" data-dismiss="modal">Usuń stanowisko</button>
            </div>
        </div>
    </div>
</div>
<form method="POST">
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Dane stanowiska</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Nazwa stanowiska</label>
                            <div class="col-sm-12">
                                <input
                                    type="text"
                                    class="form-control font-20"
                                    id="name"
                                    name="jobPosition[name]"
                                    placeholder="Wpisz nazwę stanowiska"
                                    value="<?= $data['jobPosition']->name ?? null ?>"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    if (!$isNewForm) {
                        ?>
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Pracownicy przypisani do stanowiska</h5>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="display table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Imię i nazwisko</th>
                                            <th>Akcja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($data['employees']['position']['users'] ?? [] as $employee) {
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
                                                        <div class="container-buttons">
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
                                                                data-target="#deleteNodeEmployeeModal"
                                                                onclick="loadEmployeeToNodeEmployeeModal({name: '<?= $employee->name ?>', id: '<?= $employee->id ?>'})"
                                                                ><span class="ti-trash"></span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div class="col-lg-4 col-xl-3">
                <button
                    type="submit"
                    name="save"
                    class="btn btn-primary-rgba btn-lg btn-block"
                    ><i class="feather icon-save mr-2"></i>
                    Zapisz
                </button>
                <?php
                    if (!$isNewForm) {
                        ?>
                        <button
                            type="button"
                            onclick="$('#addNodeEmployeeModal').modal('show')"
                            class="btn btn-success-rgba btn-lg btn-block"
                            ><i class="feather ri-user-3-line mr-2"></i>
                            Przypisz pracownika
                        </button>
                        <?php
                            if ($data['jobPosition']->isRoot != 1) {
                                ?>
                                <button
                                    type="button"
                                    onclick="$('#deleteJobPositionModal').modal('show')"
                                    class="btn btn-danger-rgba btn-lg btn-block"
                                    ><i class="feather icon-trash mr-2"></i>
                                    Usuń
                                </button>
                                <?php
                            }
                        ?>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</form>
<script
    src="<?= base_url('public/assets/js/custom/custom-job-position.js') ?>"
    data-base-url="<?= base_url() ?>"
    data-job-position-id="<?= $data['jobPosition']->id ?? 0 ?>"
    >
</script>