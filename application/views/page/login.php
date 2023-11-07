<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;1,300&display=swap" rel="stylesheet">

    <title>Indoneptune</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.ico">
    <link rel="stylesheet" href="<?= base_url() . 'assets/fonts/icomoon/style.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/owl.carousel.min.css' ?>">
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() . 'assets/vendor/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- Style -->
    <link rel="stylesheet" href="<?= base_url() . 'assets/css/style-login.css' ?>">
</head>

<body>


<div class="content mb-1">
    <div class="container pb-5 pt-5" style="background-color:rgba(255,255,255,0.8);">
      <div class="row">
        <div class="col-md-6 contents mb-5">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3><strong>PT. Indoneptune Net Mfg</strong></h3>
              <p class="text-black mb-0" style="font-weight:400;">Selamat datang pada Sistem Informasi PT. Indoneptune Net Manufacturing</p>
              <hr style="margin-top: 0px !important">
            </div>
            <form action="<?= $formAction; ?>" method="post">
              <div class="form-group first mb-4">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <input type="submit" value="Log In" class="btn btn-sm text-black btn-block btn-success" style="border-radius:0px; font-weight:500;">
              <hr>
            </form>
            <?php if ($this->session->flashdata('info') == 'logingagal') : ?>
                <div class="info text-danger font-kecil">
                    Login gagal, cek username dan password anda !
                </div>
            <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-6 order-md-1 d-flex">
            <div class="align-self-center mx-auto">
                <img src="<?= base_url() ?>assets/images/gambar.png" alt="Image" class="img-fluid">
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