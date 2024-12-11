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
                    <script type="text/javascript">
                        // Redirect after 10 seconds (10000 milliseconds)
                        setTimeout(function() {
                            window.location.href = '<?php echo site_url("/"); ?>';
                            }, 5000);
                    </script>
                    <h1>You will be redirected in 5 seconds...</h1>
                    <p>If you are not redirected, <a href="<?php echo site_url("target_controller/target_method"); ?>">click here</a>.</p>
                </div>
            </div>
        </div>
    </main>
</div>
<!--Main Component Ends-->


