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
            </div>
            <div class="col-lg-4 col-xl-3">
                <button
                    type="submit"
                    name="save"
                    class="btn btn-primary-rgba btn-lg btn-block"
                    id="saveEmployee"
                    ><i class="feather icon-save mr-2"></i>
                    Zapisz
                </button>
                <?php
                    if ($isDeleteable) {
                        ?>
                        <button
                            type="submit"
                            name="delete"
                            class="btn btn-danger-rgba btn-lg btn-block"
                            id="saveEmployee"
                            ><i class="feather icon-trash mr-2"></i>
                            Usuń
                        </button>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
</form>