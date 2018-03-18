<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title; ?></title>


    <link href="<?php echo base_url('assets/templates/inspinia_271/') ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/templates/inspinia_271/') ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/plugins/') ?>toastr/build/toastr.min.css" rel="stylesheet">
    
    <link href="<?php echo base_url('assets/templates/inspinia_271/') ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/templates/inspinia_271/') ?>css/style.css" rel="stylesheet">


    <?php echo $css; ?>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/templates/inspinia_271/') ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url('assets/templates/inspinia_271/') ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/templates/inspinia_271/') ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url('assets/templates/inspinia_271/') ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url('assets/templates/inspinia_271/') ?>js/inspinia.js"></script>
    <script src="<?php echo base_url('assets/templates/inspinia_271/') ?>js/plugins/pace/pace.min.js"></script>

    <script src="<?php echo base_url('assets/plugins/') ?>toastr/build/toastr.min.js"></script>

    <?php echo $js; ?>
</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom white-bg">
                <nav class="navbar navbar-static-top" role="navigation">
                    <div class="navbar-header">
                        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                            <i class="fa fa-reorder"></i>
                        </button>
                        <a href="#" class="navbar-brand">*</a>
                    </div>
                    <div class="navbar-collapse collapse" id="navbar">
                        <ul class="nav navbar-nav">

                            <li>
                                <a aria-expanded="false" role="button" href="<?php echo base_url('personalia') ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="<?php echo base_url('personalia/daftarpelamar') ?>"><i class="fa fa-list"></i> <span class="nav-label">Daftar Seluruh Pelamar</span></a>
                            </li>
                            <!-- <li>
                                <a aria-expanded="false" role="button" href="<?php echo base_url('personalia/verifikasiPelamar') ?>"><i class="fa fa-check-square"></i> <span class="nav-label">Verifikasi</span></a>
                            </li> -->

                                
                            <li>
                                <a aria-expanded="false" role="button" href="<?php echo base_url('personalia/seleksi') ?>"><i class="fa fa-area-chart"></i> <span class="nav-label">Seleksi</span></a>
                            </li>
                            <li>
                                <a aria-expanded="false" role="button" href="<?php echo base_url('personalia/arsippegawai') ?>"><i class="fa fa-archive"></i> <span class="nav-label">Arsip Pegawai</span></a>
                            </li>
                            <li class="dropdown">
                                <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-wrench"></i> Pengaturan <span class="caret"></span></a>
                                <ul role="menu" class="dropdown-menu">
                                    <li><a href="<?php echo base_url('personalia/lowongan') ?>">Lowongan</a></li>

                                    <li><a href="<?php echo base_url('personalia/kelolasoal') ?>">Soal</a></li>
                                    <!-- <li><a href="<?php echo base_url('personalia/jabatan') ?>">Jabatan</a></li> -->
                                </ul>
                            </li>
                            

                        </ul>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="<?php echo base_url('personalia/logout') ?>">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="wrapper wrapper-content">
                
                <div class="container">
                    <?php echo $content; ?>
                </div>

            </div>
            <div class="footer">
                <div class="pull-right">
                </div>
                <div>
                    <strong>Copyright</strong> Ilham Rahmadhani &copy; 2018
                </div>
            </div>

        </div>
    </div>



    

</body>

</html>
