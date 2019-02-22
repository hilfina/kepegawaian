<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Kepegawaian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="<?=base_url()?>Assets/login/images/logo.png"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/css/main.css"> 
<!--===============================================================================================-->

</head>
<body>
<div class="container-login100">
<div class="wrap-login100" style="width: 800px;" >


<!-- multistep form -->
<form id="regForm" action="<?php echo site_url(); ?>/login/daftar" enctype="multipart/form-data" method="post">
    
      <span><h4 align="center"><b>REGISTRASI PELAMAR</b></h4></span>
      <br>
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Nama Lengkap </label>
          <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Alamat </label>      
          <input type="text" class="form-control" name="alamat"  placeholder="Alamat" required>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Nomor Telepon </label>
          <input type="text" class="form-control" name="no_telp"  placeholder="Nomor Telepon" required>
      </div>  
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Email </label>
          <input type="text" class="form-control" name="email"  placeholder="Email" required>
      </div>
      <input type="text" name="id_profesi"  value="<?php echo $profesi ?>" hidden> 
      <?php foreach ($last as $key) { ?>
      <input type="hidden" name="id_karyawan" value="<?php echo $key['id_karyawan']+1?>">
      <?php } ?>
      <div class="form-group row">
        <label class="col-sm-3 form-control-label">Username</label>  
          <input class="form-control" type="text" name="username"  placeholder="username" required>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 form-control-label">Password</label>
          <input class="form-control" type="password" name="password"  placeholder="password" required>
      </div>
      <div class="text-center">
          <button class="btn btn-primary loginbtn">Register</button>
          <button class="btn btn-default"><a href="<?=base_url()?>index.php/login/pilihdaftar">Cancel</a></button>
      </div>
</form>
</div>
</div>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?=base_url()?>Assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->

</body>
</html>