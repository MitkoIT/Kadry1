<form method="POST">
    <div class="contentbar">
        <div class="row">
            <div class="col-lg-8 col-xl-9">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Dane identyfikacyjne</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-sm-12 col-form-label">Imię i nazwisko</label>
                            <div class="col-sm-12">
                                <input
                                    type="text"
                                    class="form-control font-20"
                                    id="name"
                                    name="user[name]"
                                    placeholder="Wpisz imię i nazwisko"
                                    value="<?= $data['employee']['user']->name ?? null ?>"
                                />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-12 col-form-label">E-mail</label>
                            <div class="col-sm-12">
                                <input
                                    type="text"
                                    class="form-control font-20"
                                    id="email"
                                    name="user[email]"
                                    placeholder="Wpisz e-mail"
                                    value="<?= $data['employee']['user']->email ?? null ?>"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Ustawienia</h5>
                    </div>
                    <div class="card-body">
                        <?php
                            $checked = '';
                            $isEmplyeeActive = $data['employee']['user']->active ?? null;
                            
                            if (isset($isEmplyeeActive)) {
                                $checked = $isEmplyeeActive === 'y' ? 'checked' : '';
                            }
                        ?>
                        <div class="custom-control custom-checkbox">
                            <input
                                type="checkbox"
                                class="custom-control-input"
                                id="isEmployeeActive"
                                name="user[isEmployeeActive]"
                                <?= $checked ?>
                            />
                            <label class="custom-control-label" for="isEmployeeActive">
                                <span>Aktywny</span>
                            </label>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Firmy</h5>
                    </div>
                    <div class="card-body">
                        <?php
                            foreach ($data['companies'] as $company) {
                                $checked = '';
                                ?>
                                <div class="custom-control custom-checkbox">
                                    <?php
                                        foreach ($data['employee']['companies'] ?? [] as $employeeCompany) {
                                            if ($company->id === $employeeCompany->id) {
                                                $checked = 'checked';
                                                break;
                                            }
                                        }
                                    ?>
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="company_<?= $company->name ?>"
                                        name="company[<?= $company->name ?>]"
                                        <?= $checked ?>
                                    />
                                    <label class="custom-control-label" for="company_<?= $company->name ?>">
                                        <span class="capitalize"><?= strtolower($company->name) ?></span>
                                    </label>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Role</h5>
                    </div>
                    <div class="card-body">
                        <div class="product-tags">
                            <span class="badge badge-secondary-inverse">New</span>
                            <span class="badge badge-secondary-inverse">Latest</span>
                            <span class="badge badge-secondary-inverse">Trending</span>
                            <span class="badge badge-secondary-inverse">Popular</span>
                            <span class="badge badge-secondary-inverse">Sale</span>
                        </div>                                
                    </div>
                    <div class="card-footer">
                        <div class="add-product-tags">
                            <div class="input-group">
                                <input type="search" class="form-control" placeholder="Add Tags" aria-label="Search" aria-describedby="button-addonTags">
                                <div class="input-group-append">
                                <button class="input-group-text" type="submit" id="button-addonTags">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button
                    type="submit"
                    class="btn btn-primary-rgba btn-lg btn-block"
                    id="saveEmployee"
                    ><i class="feather icon-save mr-2"></i>
                    Zapisz
                </button>
            </div>
        </div>
    </div>
</form>