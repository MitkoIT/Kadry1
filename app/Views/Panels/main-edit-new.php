<!--Main Component-->
<div class="main">
    <main class="p-3">
        <div class="container-flex">
            <div class="mb-3 text-center">
                <h1>
                    <?php echo $header; ?> 
                </h1>
            </div>
            <?php if (session()->getFlashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if (session()->getFlashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if (isset($validation)) { ?>
                <div class="alert alert-warning">
                    <?= $validation->listErrors() ?>
                </div>
            <?php } ?>
                <div class="container d-flex mt-5">
                    <?php echo form_open('storeuserdata/'.$user_data['idusers']) ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="p-3 h-100 border bg-light">
                                <div class="d-grid justify-content-center">
                                        <div class="row g-1 align-items-center szukaj-space">  
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
                                                        'class'         => 'form-control',
                                                        'value'         => $user_data['name']
                                                    ];
                                                    echo form_input($attribs); 
                                                ?>
                                            </div>  
                                        </div>
                                        <div class="row g-1 align-items-center szukaj-space">
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
                                                        'class'         => 'form-control',
                                                        'value'         => $user_data['phone_shop_mitko']
                                                    ];
                                                    echo form_input($attribs); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row g-1 align-items-center szukaj-space">
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
                                                        'class'         => 'form-control',
                                                        'value'         => $user_data['email']
                                                    ];
                                                    echo form_input($attribs); 
                                                ?>
                                            </div>
                                        </div>
                                        <div class="d-grid justify-content-center szukaj-space">
                                            <?php
                                                $attrib = [
                                                    'class'     => 'btn btn-seccond border border-dark',
                                                    'type'      => 'submit', 
                                                    'value'     => 'Zapisz Dane',
                                                    'content'   => 'Zapisz Dane'
                                                ];
                                                echo form_button($attrib);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php echo form_close(); ?>
                            <!-- Sekcja z firmami -->
                            <div class="col-md-4">
                            <div class="p-3 h-100 border bg-light">
                            <?php echo form_open('storeusercompany/'.$user_data['idusers']) ?>
                                <?php if ($company_num) { 
                                    for ($i = 0; $i < $company_num; $i++) { ?>
                                        <div id= '<?php echo $i; ?>' >
                                            <div class="row g-2 align-items-center szukaj-space">
                                                <div class="col-auto">
                                                    <?php 
                                                        echo form_label("Firma ".$i + 1 ,"firmaid"); 
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
                                                        echo form_dropdown('firmy[]', $attribs, $company_data[$i]['idcompany']); 
                                                    ?>
                                                </div>
                                                <div class="col-auto">
                                                    <?php if ($i > 0 ) { ?>
                                                    <button type="button" class="btn btn-seccond border border-dark" 
                                                        onclick="window.location='<?php echo base_url()?>deletecompanyelement/<?php echo $user_data['idusers'] ?>/<?php echo $company_data[$i]['idcompany'] ?>'">
                                                        Usuń
                                                    </button>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>  
                                <div class="row g-3 align-items-center szukaj-space">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-seccond border border-dark"
                                            onclick="window.location='<?php echo base_url()?>addcompanyelement/<?php echo $user_data['idusers'] ?>'">
                                            Dodaj
                                        </button>
                                    </div>
                                </div>
                                <div class="d-grid justify-content-center szukaj-space">
                                    <?php
                                        $attrib = [
                                            'class'     => 'btn btn-seccond border border-dark',
                                            'type'      => 'submit', 
                                            'value'     => 'Zapisz Zmiany',
                                            'content'   => 'Zapisz Zmiany'
                                        ];
                                        echo form_button($attrib);
                                    ?>
                                </div>
                            </div>
                             <!-- koniec sekcji z firmami -->
                             <?php echo form_close(); ?>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 h-100 border bg-light">
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
                                                'rows'          => '5'
                                            ];
                                            echo form_textarea($attribs); 
                                        ?>
                                    </div>
                                </div>
                                <div class="d-grid justify-content-center szukaj-space">
                            <?php
                                $attrib = [
                                    'class'     => 'btn btn-seccond border border-dark',
                                    'type'      => 'submit', 
                                    'value'     => 'Zapisz Notatkę',
                                    'content'   => 'Zapisz Notatkę'
                                ];
                                echo form_button($attrib);
                            ?>
                        </div>
                            </div>
                        </div>
                        <div class="row mt-5 justify-content-center">
                            <div class="col-md-3">
                                <div class="p-3">
                                    <div class="row g-3 align-items-center szukaj-space">
                                        <?php
                                            $attrib = [
                                                'class'     => 'btn btn-seccond',
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
        </div>
    </main>
</div>
<!--Main Component Ends-->