
<div class="breadcrumbbar">
    <div class="row align-items-center">
        <div class="col-md-8 col-lg-8">
            <h4 class="page-title"><?= $page->title ?></h4>
            <div class="breadcrumb-list">
                <ol class="breadcrumb">
                    <?php
                        foreach ($breadcrumbs as $key => $breadcrumb) {
                            if ($breadcrumb->isLast == 1) {
                                ?>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?= $breadcrumb->name ?>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url($breadcrumb->path) ?>"><?= $breadcrumb->name ?></a>
                                </li>
                                <?php
                            }
                        }
                    ?>
                </ol>
            </div>
        </div>
    </div>          
</div>
        