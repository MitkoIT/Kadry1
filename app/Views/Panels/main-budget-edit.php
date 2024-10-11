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
        <div class="container-flex">
            <div class="mb-3 text-center">
                <h1>
                    <?php echo $budget_data['budzet_nazwa']; ?> 
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
                <div class="row">
                    <div class="col-md-4"> 
                        <h3>Informacje</h3>
                        <p>This is the first column. It takes up 1/3 of the width of the screen.</p>
                    </div>
                    <div class="col-md-8 table-responsive"> 
                        <h3>Pracownicy</h3>
                        <p>This is the second column. It takes up 2/3 of the width of the screen and has the ability to scroll if the content exceeds the height limit.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque imperdiet consectetur dolor in elementum. Sed sit amet accumsan arcu, in dignissim nibh. Aenean vel mi massa. Suspendisse potenti. Proin euismod, libero ac consequat sodales, felis elit bibendum libero, vitae tincidunt purus justo sit amet justo. Sed at purus elit. Donec quis malesuada sem. Nunc non neque id sapien fermentum facilisis. Sed cursus, nibh at vehicula tincidunt, odio nibh tincidunt urna, et tincidunt enim est nec nisi.</p>
                        
                    </div>
                </div>
            </div>
            <div class="mt-4 row mt-3">
                <div class="col text-center">
                    <button type="button" class="btn btn-secondary" 
                        onclick="window.location='<?php echo base_url()?>budget-allbudgets'">
                        Wstecz
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>
<!--Main Component Ends-->