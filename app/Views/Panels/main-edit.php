<!--Main Component-->
<div class="main">
    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-3">
                <h1>
                    <i class="lni lni-stamp"></i>
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
           <div class="d-grid justify-content-center border border-3 border-secondary p-3 rounded">
            <?php echo form_open('store/'.$user_data['idusers'].'/'.$company_data['idcompany']) ?>
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
                                    'class'         => 'form-control',
                                    'value'         => $user_data['name']
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
                                    'class'         => 'form-control',
                                    'value'         => $user_data['phone_shop_mitko']
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
                                    'class'         => 'form-control',
                                    'value'         => $user_data['email']
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
                                echo form_dropdown('firma', $attribs, $company_data['idcompany']); 
                            ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center szukaj-space">
                        <?php
                            $attrib = [
                                'class'     => 'btn btn-success',
                                'type'      => 'submit', 
                                'value'     => 'Zapisz Dane',
                                'content' => 'Zapisz Dane'
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
