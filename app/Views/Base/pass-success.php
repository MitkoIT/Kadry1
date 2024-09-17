<!--Main Component-->
<div class="main">
    <div class="d-flex justify-content-end">
        
    </div>
    <main class="p-3">
        <div class="container-fluid">
            <div class="mb-3 text-center">
                <h1 class="title-space">
                    <?php echo $header; ?>
                </h1>
                <?php if (session()->getFlashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php } ?>
                <div class="row g-3 align-items-center szukaj-space">
                    tu nastąpi przekierowanie do panelu logowania
                </div>
            </div>
        </div>
    </main>
</div>
<!--Main Component Ends-->
