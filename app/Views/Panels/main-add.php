<!--Main Component-->
<div class="main">
    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-3">
                <h1>
                    <i class="lni lni-add-files"></i>
                    <?php echo $header; ?>
                </h1>
            </div>
            <?php if (isset($validation)) { ?>
                <div class="alert alert-warning">
                    <?= $validation->listErrors() ?>
                </div>
            <?php } ?>
            <div class="d-grid justify-content-center border border-3 border-secondary p-3 rounded">
                <?php echo form_open('add')?>
                    <div class="row g-3 align-items-center szukaj-space">
                            <div class="col-auto">
                                <?php 
                                    echo form_label("Imie i Nazwisko","nameid"); 
                                ?>
                            </div>
                            <div class="col-auto">
                                <?php 
                                    $attribs = [
                                        'name'          => 'name',
                                        'type'          => 'text', 
                                        'placeholder'   => 'Imię i Nazwisko',
                                        'class'         => 'form-control'
                                    ];
                                    echo form_input($attribs); 
                                ?>
                            </div>
                    </div>
                    <div class="row g-3 align-items-center szukaj-space">
                        <div class="col-auto">
                            <?php 
                                echo form_label("Tel.","phoneid"); 
                            ?>
                        </div>
                        <div class="col-auto">
                            <?php 
                                $attribs = [
                                    'name'          => 'phone',
                                    'type'          => 'text', 
                                    'placeholder'   => 'Numer Telefonu',
                                    'class'         => 'form-control'
                                ];
                                echo form_input($attribs); 
                            ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center szukaj-space">
                        <div class="col-auto">
                            <?php 
                                echo form_label("Email@","emailid"); 
                            ?>
                        </div>
                        <div class="col-auto">
                            <?php 
                                $attribs = [
                                    'name'          => 'email',
                                    'type'          => 'email', 
                                    'placeholder'   => 'example@example.pl',
                                    'class'         => 'form-control'
                                ];
                                echo form_input($attribs); 
                            ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center szukaj-space">
                        <div class="col-auto">
                            <?php 
                                echo form_label("Firma","firmaid"); 
                            ?>
                        </div>
                        <div class="col-auto">
                            <?php 
                                $data = [];
                                if ($company_list) {
                                    foreach ($company_list as $company) {
                                        $data[$company['idcompany']] = $company['name'];
                                    }
                                }
                                $attribs = $data;
                                echo form_dropdown('firma', $attribs); 
                            ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center szukaj-space">
                        <?php
                            $attrib = [
                                'class'     => 'btn btn-success',
                                'type'      => 'submit', 
                                'value'     => 'Dodaj Użytkownika',
                                'content' => 'Dodaj Użytkownika'
                            ];
                            echo form_button($attrib);
                        ?>
                        <?php
                            $attrib = [
                                'class'     => 'btn btn-danger',
                                'value'     => 'Wstecz',
                                'onclick'   => "window.location='" . base_url('active') . "'",
                                'content'   => 'Wstecz'
                            ];
                            echo form_button($attrib);
                        ?>   
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </main>
</div>
<!--Main Component Ends-->
