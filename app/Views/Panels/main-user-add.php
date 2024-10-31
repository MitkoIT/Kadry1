<!--Main Component-->
    <main class="p-3">
        <div class="container-flex">
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
            <div class="container d-flex mt-5">
                <?php echo form_open('user-add-save')?>
                    <div class="row">
                        <div class="col-md-4">
                        <h3>Dane Osobowe</h3>
                            <div class="p-3 border bg-light h-100">
                                <div class="d-grid justify-content-center">
                                    <div class="row g-1 align-items-center szukaj-space">  
                                        <div class="col">
                                            <?php 
                                                echo form_label("Imie i Nazwisko","nameid"); 
                                            ?>
                                        </div>
                                        <div class="col">
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
                                    <div class="row g-1 align-items-center szukaj-space">
                                        <div class="col">
                                            <?php 
                                                echo form_label("Tel.","phoneid"); 
                                            ?>
                                        </div>
                                        <div class="col">
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
                                    <div class="row g-1 align-items-center szukaj-space">
                                        <div class="col">
                                            <?php 
                                                echo form_label("Email@","emailid"); 
                                            ?>
                                        </div>
                                        <div class="col">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                        <h3>Firma</h3>
                            <div class="p-3 border bg-light h-100">
                                <!--container for javascript -->
                                <div id="elementContainer"> 
                                    <div id="firmListTemplate">
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
                                                    echo form_dropdown('firmy[]', $attribs); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3 align-items-center szukaj-space">
                                    <div class="col-auto">
                                        <button type="button" id='addCompany' class="btn btn-secondary border border-dark">
                                            Dodaj
                                        </button>
                                    </div>
                                </div>
                            </div>

                                        <!--tutaj dodac trzeba nastepny przycisk dodaj forme -->
                        </div>
                        <div class="col-md-4">
                        <h3>Notatka</h3>
                            <div class="p-3 border bg-light h-100">
                                <div class="g-3 align-items-center szukaj-space">
                                    <div class="col-auto">
                                        <?php 
                                            echo form_label("Notatka","notatkaid"); 
                                        ?>
                                    </div>
                                    <div class="col-auto">
                                        <?php 
                                            $attribs = [
                                                'name'          => 'notatka',
                                                'placeholder'   => 'Notatka',
                                                'class'         => 'form-control',
                                                'rows'          => '3'
                                            ];
                                            echo form_textarea($attribs); 
                                        ?>
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
                                            'value'     => 'Dodaj Użytkownika',
                                            'content'   => 'Dodaj Użytkownika'
                                        ];
                                        echo form_button($attrib);
                                    ?>
                                    <?php
                                        $attrib = [
                                            'class'     => 'btn btn-secondary border border-dark',
                                            'value'     => 'Wstecz',
                                            'onclick'   => "window.location='" . base_url('active') . "'",
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

<script src="<?php echo base_url()?>script/AddCompanyButton.js"></script>