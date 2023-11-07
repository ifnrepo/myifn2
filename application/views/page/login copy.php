<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <title>Indoneptune</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="<?= base_url() . 'assets/fonts/icomoon/style.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/owl.carousel.min.css' ?>">
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() . 'assets/vendor/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/style-login.css' ?>">
    <link href="<?= base_url() . 'assets/css/mystyle.css' ?>" rel="stylesheet">
</head>

<body>


    <div class="d-md-flex half">
        <div class="bg" style="background-image: url('<?= base_url() ?>assets/images/bg_1.jpg');"></div>
        <div class="contents">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-12">
                        <div class="form-block mx-auto">
                            <div class="text-center mb-5">
                                <h3>Login to <strong>Indoneptune</strong></h3>
                                <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
                                <?php if ($this->session->flashdata('info') == 'logingagal') : ?>
                                    <div class="info text-danger font-kecil">
                                        Login gagal, cek username dan password anda !
                                    </div>
                                <?php endif; ?>
                            </div>
                            <form action="<?= $formAction; ?>" method="post">
                                <div class="form-group first font-kecil">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" placeholder="Username Anda" id="username" name="username" autocomplete="off>
                                </div>
                                <div class=" form-group last mb-3 font-kecil">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password Anda" id="password" name="password">
                                </div>

                                <div class="d-sm-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-3 mb-sm-0 font-kecil"><span class="caption">Ingat Saya</span>
                                        <!-- <input type="checkbox" checked="checked" /> -->
                                        <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Lupa Password</a></span>
                                </div>

                                <input type="submit" value="Log In" class="btn btn-block btn-success font-kecil">
                                <div style="width: 100%; text-align:center;font-size:9px;" class="mt-1">
                                    <span><?= 'Php Ver. '.phpversion() ?></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="<?= base_url() . 'assets/plugins/jquery/jquery-3.3.1.js' ?>"></script>
    <script src="<?= base_url() . 'assets/js/popper.min.js' ?>"></script>
    <script src="<?= base_url() . 'assets/vendor/bootstrap/js/bootstrap.js' ?>"></script>
    <script src="<?= base_url() . 'assets/js/main-login.js' ?>"></script>
</body>

</html>