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
                                foreach ($data['jobPosition']['employees']['all']['users'] ?? [] as $employee) {
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
<div class="modal fade" id="addNodeBudgetModal" tabindex="-1" role="dialog" aria-labelledby="addNodeBudgetModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dodaj budżet do stanowiska</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-12 col-form-label">Budżet</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="addNodeBudgetModalSelect">
                            <option>Wybierz budżet</option>
                            <?php
                                foreach ($data['budgets'] ?? [] as $budget) {
                                    ?>
                                    <option value="<?= $budget->id ?>"><?= $budget->id ?> - <?= $budget->name ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <input
                    type="hidden"
                    id="addNodeBudgetModalId"
                    value=""
                />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-primary-rgba" onclick="addNodeBudget()" data-dismiss="modal">Dodaj przypisanie</button>
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
<div class="modal fade" id="deleteNodeBudgetModal" tabindex="-1" role="dialog" aria-labelledby="deleteNodeBudgetModal" aria-hidden="true">
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
                    id="deleteNodeBudgetModalId"
                    value=""
                />
                <p class="text-muted">Czy napewno chcesz usunąć przypisanie budżetu <span id="deleteNodeBudgetModalBudget">{name}</span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-danger-rgba" onclick="deleteNodeBudget()" data-dismiss="modal">Usuń przypisanie</button>
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
<div class="modal fade" id="changeNodeEmployeeDescriptionModal" tabindex="-1" role="dialog" aria-labelledby="changeNodeEmployeeDescriptionModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pracownik: <span id="nodeEmployeeName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-12 col-form-label">Opis</label>
                    <div class="col-sm-12">
                        <input
                            type="text"
                            class="form-control"
                            id="nodeEmployeeDescription"
                            placeholder="Wpisz opis"
                            value=""
                        />
                    </div>
                </div>
                <input
                    type="hidden"
                    id="nodeEmployeeId"
                    value=""
                />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-primary-rgba" onclick="saveNodeEmployeeDescription()" data-dismiss="modal">Zapisz opis</button>
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
                                    value="<?= $data['jobPosition']['details']->name ?? null ?>"
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
                                            <th>Opis</th>
                                            <th>Akcja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($data['jobPosition']['employees']['position']['users'] ?? [] as $employee) {
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
                                                        <?= $data['jobPosition']['users'][$employee->id]->description ?>
                                                    </td>
                                                    <td>
                                                        <div class="container-buttons">
                                                            <button
                                                                type="button"
                                                                class="btn btn-primary-rgba"
                                                                data-toggle="modal"
                                                                data-target="#changeNodeEmployeeDescriptionModal"
                                                                onclick="openChangeNodeEmployeeDescriptionModal({description: '<?= $data['jobPosition']['users'][$employee->id]->description ?>', id: '<?= $employee->id ?>', name: '<?= $employee->name ?>'})"
                                                                ><span class="ti-pencil"></span>
                                                            </button>
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
                <?php
                    if (!$isNewForm) {
                        ?>
                        <div class="card m-b-30">
                            <div class="card-header">
                                <h5 class="card-title">Budżety przypisane do stanowiska</h5>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <table id="default-datatable" class="display table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nazwa</th>
                                            <th>Akcja</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($data['jobPosition']['budgets'] ?? [] as $budget) {
                                                ?>
                                                <tr>
                                                    <td><?= $budget->id ?></td>
                                                    <td><?= $data['budgets'][$budget->id]->name ?></td>
                                                    <td>
                                                        <div class="container-buttons">
                                                            <button
                                                                type="button"
                                                                class="btn btn-danger-rgba"
                                                                data-toggle="modal"
                                                                data-target="#deleteNodeBudgetModal"
                                                                onclick="loadBudgetToNodeBudgetModal({name: '<?= $data['budgets'][$budget->id]->name ?>', id: '<?= $budget->id ?>'})"
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
                            class="btn btn-primary-rgba btn-lg btn-block"
                            ><i class="feather ri-user-3-line mr-2"></i>
                            Przypisz pracownika
                        </button>
                        <button
                            type="button"
                            onclick="$('#addNodeBudgetModal').modal('show')"
                            class="btn btn-primary-rgba btn-lg btn-block"
                            ><i class="feather icon-plus mr-2"></i>
                            Przypisz budżet
                        </button>
                        <?php
                            if ($data['jobPosition']['details']->isRoot != 1) {
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
    data-company-id="<?= $data['company']->id ?? 0 ?>"
    data-job-position-id="<?= $data['jobPosition']['details']->id ?? 0 ?>"
    >
</script>