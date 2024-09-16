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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Imię</th>
                                <th>Email</th>
                                <th>Tel.</th>
                                <th>Firma</th>
                            </tr>
                            <?php
                            if ($user_data) {
                                foreach ($user_data as $user) { ?>
                                    <tr>
                                        <td><?php echo $user['idusers']; ?></td>
                                        <td><?php echo $user['user_name']; ?></td>
                                        <td><?php echo $user['user_email']; ?></td>
                                        <td><?php echo $user['phone_shop_mitko']; ?></td>
                                        <td><?php echo $user['company_name'] ?></td>
                                    </tr>
                                <?php }
                            } ?>
                        </table>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<!--Main Component Ends-->
