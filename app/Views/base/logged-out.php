<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="mitko-dev-team">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>KADRY | Nie zalogowany</title>
    <link rel="shortcut icon" href="<?= base_url('public/assets/images/favicon.ico') ?>">
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public/assets/css/icons.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public/assets/css/style.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public/assets/css/custom.css') ?>" rel="stylesheet" type="text/css">
</head>
<body class="vertical-layout">
    <div id="containerbar" class="containerbar authenticate-bg">
        <div class="container">
            <div class="auth-box lock-screen-box">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    <form action="#">
                                        <div class="form-head">
                                            <a href="<?= base_url() ?>" class="appTitle">KADRY</a>
                                        </div> 
                                        <h4 class="text-primary my-4">Zostałeś wylogowany!</h4>
                                        <div class="user-logo mb-4">
                                            <img src="<?= base_url('public/assets/images/users/boy.svg') ?>" class="rounded-circle img-fluid" alt="user-img">
                                        </div>                  
                                      <a href="http://firma.mitko.pl" class="btn btn-primary btn-lg btn-block font-18">Otwórz firma.mitko.pl</a>
                                    </form>
                                    <p class="mb-0 mt-3">Przejdź na firma.mitko.pl aby się zalogować.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/modernizr.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
</body>
</html>