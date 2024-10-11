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
        <div class="container-fluid">
            <div class="mb-1">
                <div>
                    <h1 class="title-space">
                        <b><?php echo $header; ?></b>
                    </h1>
                </div>
                <!--flash info section start-->
                <!--flash info section end -->
                <!-- button section start -->
                <div class="d-flex row g-3 szukaj-space justify-content-between">
                    <div class="col-auto">
                        <?php echo form_open('budget-search') ?>
                            <?php 
                                $attribs = [
                                    'name'          => 'budzet',
                                    'type'          => 'text', 
                                    'placeholder'   => 'Nazwa',
                                    'class'         => 'form-control',
                                    'id'            => 'myInput',
                                    'onkeyup'       => 'MySearchFunction()',
                                ];
                                echo form_input($attribs); 
                            ?>
                    </div>
                    <div class="col-auto">
                        <div class="col-auto">
                            <?php
                                $attrib = [
                                    'class'     => 'btn btn-secondary',
                                    'type'      => 'submit', 
                                    'value'     => 'Szukaj',
                                    'content' => '<i class="lni lni-search"></i> Szukaj'
                                ];
                                echo form_button($attrib);
                            ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <div class="col-auto ms-auto"> <!-- ms-auto pushes this button to the end -->
                        <button type="button" class="btn btn-secondary" 
                            onclick="window.location='<?php echo base_url()?>budget-addbudget'">
                            Nowy
                        </button>
                    </div>
                </div> <!-- button section end -->
                <div class="table-responsive border border-3 rounded">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Nazwa</th>
                                <th class="text-center">Data Dodania</th>
                                <th class="text-center">Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($budget_data) {
                                foreach ($budget_data as $budget) { ?>
                                    <tr>
                                        <td class="text-center align-middle">
                                            <?php echo $budget['id_budzet']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php echo $budget['budzet_nazwa']; ?>
                                        </td>
                                        <td class="text-center align-middle">
                                            <?php echo $budget['budzet_data_dodania']; ?>
                                        </td>
                                        <td class="text-center align-middle justify-content-center">
                                            <button type="button" class="btn btn-seccond rounded-start" 
                                                onclick="window.location='budget-edit/<?php echo $budget['id_budzet'] ?>'">
                                                <span class="badge bg-secondary">
                                                    Zarządzaj
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
                            <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
<!--Main Component Ends-->

<script src="<?php echo base_url()?>script/BudgetSearch.js"></script>
