<!--Main Component-->
<div class="main">
    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-3">
                <h1><?php echo $header; ?> <?php echo $user_data["name"]; ?></h1>
            </div>
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
                <div class="d-grid justify-content-center szukaj-space">
                <?php
                                $attrib = [
                                    'class'     => 'btn btn-success',
                                    'type'      => 'submit', 
                                    'value'     => 'Zapisz Dane',
                                    'content' => '<i class="lni lni-save"></i> Zapisz Dane'
                                ];
                                echo form_button($attrib);
                            ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </main>
</div>
<!--Main Component Ends-->
