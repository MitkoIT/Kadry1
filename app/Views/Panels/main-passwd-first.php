<!--Main Component-->
<div class="main">
    <nav class="navbar navbar-expand border-bootom">
        <button class="toggler-btn" type="button">
            <i class="lni lni-text-align-left"></i>
        </button>
    </nav>
    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-3 text-center">
                <h1><?php echo $header; ?> <?php echo $user_data["name"]; ?></h1>
            </div>
            <?php if (isset($validation)) { ?>
                <div class="alert alert-warning">
                    <?= $validation->listErrors() ?>
                </div>
            <?php } ?>
            <?php echo form_open('firstpasswd/'.$user_data['idusers'])?>
            <div class="row g-3 align-items-center szukaj-space">
                    <div class="col-auto">
                        <?php 
                            echo form_label("Nowe hasło","passwordid"); 
                        ?>
                    </div>
                    <div class="col-auto">
                        <?php 
                            $attribs = [
                                'name'          => 'password',
                                'type'          => 'password', 
                                'placeholder'   => 'Wprowadz hasło',
                                'class'         => 'form-control',
                            ];
                            echo form_input($attribs); 
                        ?>
                    </div>
                </div>
                <div class="row g-3 align-items-center szukaj-space">
                    <div class="col-auto">
                        <?php 
                            echo form_label("Powtórz hasło","confirmpasswdid"); 
                        ?>
                    </div>
                    <div class="col-auto">
                        <?php 
                            $attribs = [
                                'name'          => 'confirmpasswd',
                                'type'          => 'password', 
                                'placeholder'   => 'Powtorz hasło',
                                'class'         => 'form-control',
                            ];
                            echo form_input($attribs); 
                        ?>
                    </div>
                </div>
            </div>
                <div class="d-grid justify-content-center szukaj-space">
                    <?php
                        $attrib = [
                            'class' => 'btn btn-secondary',
                            'type'  => 'submit', 
                            'value' => 'Zmień hasło'
                        ];
                        echo form_input($attrib);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </main>
</div>
<!--Main Component Ends-->
