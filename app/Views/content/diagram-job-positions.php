<div class="modal fade" id="jobPositionModal" tabindex="-1" role="dialog" aria-labelledby="deactivateEmploeeModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stanowisko: <span id="jobPositionModalPosition"></span></h5>
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
                <a
                    id="editJobPosition"
                    class="btn btn-primary-rgba"
                    href="<?= base_url() ?>"
                    >Edytuj stanowisko
                </a>
                <a
                    id="newJobPosition"
                    class="btn btn-primary-rgba"
                    href="<?= base_url() ?>"
                    >Dodaj podległe stanowisko
                </a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade show" id="budgetLeftModal" tabindex="-1" role="dialog" aria-labelledby="budgetLeftModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nieprzypisane budżety</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="display table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($data['unassignedBudgets']['budgets'] as $budget) {
                                ?>
                                <tr>
                                    <td><?= $budget->id ?></td>
                                    <td><?= $budget->name ?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nazwa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-rgba" data-dismiss="modal">Zamknij</button>
            </div>
        </div>
    </div>
</div>
<div class="horizontal-layout">
    <div class="infobar-settings-sidebar-overlay"></div>
    <div id="containerbar" class="container-fluid">
        <div class="rightbar">
            <div class="contentbar">
                <div class="default-container">
                    <div class="form-group row">
                        <div class="col-3">
                            <label for="name" class="col-sm-12 col-form-label">Wyszukaj pracownika</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="diagramEmployeeId">
                                    <option>Wybierz pracownika</option>
                                    <?php
                                        foreach ($data['employees']['users'] ?? [] as $employee) {
                                            ?>
                                            <option value="<?= $employee->id ?>"><?= $employee->id ?> - <?= $employee->name ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-3">
                            <button
                                id="budgetLeftModalButton"
                                type="button"
                                class="btn btn-primary-rgba to-right"
                                data-toggle="modal"
                                data-target="#budgetLeftModal"
                                >$ (<?= $data['unassignedBudgets']['amount'] ?>)
                            </button>
                        </div>
                    </div>
                    <div id="diagram-job-positions-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const nodes = <?= $data['nodes'] ?>;
</script>
<script
    src="<?= base_url('public/assets/js/custom/custom-job-positions.js') ?>"
    data-base-url="<?= base_url() ?>"
    data-company-id="<?= $data['company']->id ?>"
    >
</script>