<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sistem Seleksi Penerimaan Pegawai</title>
  
  
  <link href="<?php echo base_url('assets/plugins/') ?>toastr/build/toastr.min.css" rel="stylesheet">
  
  <link rel="stylesheet" href="<?php echo site_url(). 'assets/templates/flat-html5-css3-login-form/' ?>css/style.css">

  <link href="<?php echo base_url('assets/templates/inspinia_271/') ?>css/bootstrap.min.css" rel="stylesheet">


</head>

<body>

  <div class="login-page">

    <div class="form">
      <form class="login-form" method="post">
        <input type="text" required="" name="username" placeholder="username"/>
        <input type="password" required="" name="password" placeholder="password"/>
        <button>login</button>
        
      </form>
    </div>
  </div>
  <script src="<?php echo base_url('assets/templates/inspinia_271/') ?>js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url('assets/plugins/') ?>toastr/build/toastr.min.js"></script>


  <script  src="<?php echo site_url(). 'assets/flat-html5-css3-login-form/' ?> js/index.js"></script>



  <script type="text/javascript">
    <?php 
    if (isset($error)) 
    {
      echo $error;
    }
    ?>
  </script>
</body>

</html>
