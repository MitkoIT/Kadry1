<!--Main Component-->
<div class="main">
<div class="d-flex justify-content-end mt-3">
        <div class="border border-secondary border-3 rounded-pill mx-4 p-2">
            <span class="mt-3"> 
                <span class="logged-user">  
                    Imię Nazwisko
                </span> 
            </span>
            <button class="btn btn-danger mx-4">
                <i class="lni lni-exit"></i>
                Wyloguj
            </button>
        </div>
    </div>
    <main class="p-3">
        <div class="container">
            <div class="mb-3 text-center">
                <h1>
                    <?php echo $header; ?>
                </h1>
            </div>
            <?php if (isset($validation)) { ?>
                <div class="alert alert-warning">
                    <?= $validation->listErrors() ?>
                </div>
            <?php } ?>
            <div class="container mt-5">
                <?php echo form_open('budget-add-save')?>
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Informacje</h3>
                            <div class="p-3 border bg-light h-100">
                                <div class="d-grid justify-content-center">
                                    <div class="row g-1 align-items-center szukaj-space">  
                                        <div class="col-auto">
                                            <?php 
                                                echo form_label("Nazwa","nameid"); 
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <?php 
                                                $attribs = [
                                                    'name'          => 'name',
                                                    'type'          => 'text', 
                                                    'placeholder'   => 'Nazwa',
                                                    'class'         => 'form-control'
                                                ];
                                                echo form_input($attribs); 
                                            ?>
                                        </div>  
                                    </div>
                                    <div class="row g-1 align-items-center szukaj-space">
                                        <div class="col-auto">
                                            <?php 
                                                echo form_label("Cel","targetid"); 
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <?php 
                                                $data = [];
                                                if ($target_list) {
                                                    foreach ($target_list as $target) {
                                                        $data[$target['id_cel']] = $target['cel_nazwa'];
                                                    }
                                                }
                                                $options = $data;
                                                $attributes = [
                                                    'class' => 'form-select'
                                                ];
                                                echo form_dropdown('cel', $options, null, $attributes); 
                                            ?>
                                        </div>
                                    </div>
                                    <div class="row g-1 align-items-center szukaj-space">
                                        <div class="col-auto">
                                            <?php 
                                                echo form_label("Firma","companyid"); 
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <?php 
                                             $data = [];
                                             if ($company_list) {
                                                   foreach ($company_list as $company) {
                                                      $data[$company['id_firma']] = $company['firma_nazwa'];
                                                 }
                                             }
                                             $options = $data;
                                             $attributes = [
                                                 'class' => 'form-select'
                                             ];
                                             echo form_dropdown('firma', $options, null, $attributes); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Pracownicy</h3>
                            <div class="p-3 border bg-light h-100">
                                <div class="d-grid justify-content-center">
                                    <div class="row g-3 align-items-center szukaj-space">
                                        <div class="col-auto">
                                            <?php 
                                                echo form_label("Właśćiciel","ownerid"); 
                                            ?>
                                        </div>
                                        <div class="col-auto">
                                            <?php 
                                                $data = [];
                                                if ($user_data) {
                                                    foreach ($user_data as $user) {
                                                        $data[$user['idusers']] = $user['name'];
                                                    }
                                                }
                                                $options = $data;
                                                $attributes = [
                                                    'class' => 'selectpicker form-group',
                                                    'data-live-search' => 'true',
                                                ];
                                                echo form_dropdown('owner', $options, null, $attributes); 
                                            ?>
                                        </div>  
                                    </div>
                                    <div class="row g-3 align-items-center szukaj-space">
                                        <div class="col-auto">
                                                <?php 
                                                    echo form_label("Zastępca","semiownerid"); 
                                                ?>
                                            </div>
                                        <div class="col-auto">
                                            <?php 
                                                $data = [];
                                                if ($user_data) {
                                                    foreach ($user_data as $user) {
                                                        $data[$user['idusers']] = $user['name'];
                                                    }
                                                }
                                                $options = $data;
                                                $attributes = [
                                                    'class' => 'selectpicker',
                                                    'data-live-search' => 'true',
                                                ];
                                                echo form_dropdown('semiowner', $options, null, $attributes); 
                                            ?>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5 justify-content-center">
                        <div class="col-md-4">
                            <div class="p-3">
                                <div class="row g-3 align-items-center szukaj-space">
                                    <?php
                                        $attrib = [
                                            'class'     => 'btn btn-secondary border border-dark',
                                            'type'      => 'submit', 
                                            'value'     => 'Dodaj',
                                            'content'   => 'Dodaj'
                                        ];
                                        echo form_button($attrib);
                                    ?>
                                    <?php
                                        $attrib = [
                                            'class'     => 'btn btn-secondary border border-dark',
                                            'value'     => 'Wstecz',
                                            'onclick'   => "window.location='" . base_url('budget-allbudgets') . "'",
                                            'content'   => 'Wstecz'
                                        ];
                                        echo form_button($attrib);
                                    ?>   
                                </div>
                            </div>
                        </div>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </main>
</div>

<!--Main Component Ends-->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap-Select JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>