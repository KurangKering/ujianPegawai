<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Ujian Penerimaan Pegawai</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/templates/landing_page/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url('assets/templates/landing_page/'); ?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/templates/landing_page/'); ?>vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/templates/landing_page/'); ?>css/landing-page.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="#"></a>
        <a class="btn btn-primary" href="<?php echo base_url('personalia/login'); ?>">Sign In</a>
      </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead text-white text-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore</h1>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form action="<?php echo base_url('calpeg/pengajuan'); ?>" method="post">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" class="form-control form-control-lg" name="noKtp" placeholder="Masukkan No KTP...">
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" class="btn btn-block btn-lg btn-primary">Daftar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>

    <!-- Footer -->
    

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('assets/templates/landing_page/'); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/templates/landing_page/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
