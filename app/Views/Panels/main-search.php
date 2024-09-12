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
                <h1><?php echo $header; ?></h1>
            </div>
            <?php if (isset($validation)) {?>
                <div class="alert alert-warning">
                    <?php echo 'Imię i nazwisko musi zawierać co najmniej 2 znaki i nie więcej niż 128 znaków.' ?>
                </div>
                <?php } ?>
            <?php echo form_open('search'); ?>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                            <?php 
                                echo form_label("Znajdź użytkownika, którego chcesz edytować. ","nameid"); 
                            ?>
                    </div>
                    <div class="col-auto">
                        <?php 
                            $attribs = [
                                'name'          => 'name',
                                'type'          => 'text', 
                                'placeholder'   => 'Imię i nazwisko',
                                'class'         => 'form-control',
                                'value'         => set_value('name')
                            ];
                            echo form_input($attribs); 
                        ?>
                    </div>
                </div>
                <div class="d-grid justify-content-center">
                    <?php
                        $attrib = [
                            'class' => 'btn btn-primary fixed-button',
                            'type'  => 'submit', 
                            'value' => 'Edytuj'
                        ];
                        echo form_input($attrib);
                    ?>
                </div>
            <?php echo form_close(); ?>
        </div>
    </main>
</div>
<!--Main Component Ends-->
