<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link href="<?php echo base_url('assets/templates/inspinia_271/') ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url('assets/templates/inspinia_271/') ?>font-awesome/css/font-awesome.css" rel="stylesheet">
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
            <a href="#" class="navbar-brand">Universitas Islam Riau</a>
          </div>
          <div class="navbar-collapse collapse" id="navbar">
               <!--  <ul class="nav navbar-nav">
                    <li class="active">
                        <a aria-expanded="false" role="button" href="layouts.html"> Back to main Layout page</a>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a aria-expanded="false" role="button" href="#" class="dropdown-toggle" data-toggle="dropdown"> Menu item <span class="caret"></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                            <li><a href="">Menu item</a></li>
                        </ul>
                    </li>
                  </ul> -->
                  <!-- <ul class="nav navbar-top-links navbar-right">
                    <li>
                      <a href="<?php echo base_url('calpeg/logout') ?>">
                        <span><?php echo $this->session->userdata('calpeg')['nama'] ?></span> <i class="fa fa-sign-out"></i> 
                      </a>
                    </li>
                  </ul> -->
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
               Template By Inspinia
             </div>
             <div>
              <strong>Copyright</strong> Ilham Rahmadhani &copy; 2018
            </div>
          </div>
        </div>
      </div>

    </body>
    </html>
