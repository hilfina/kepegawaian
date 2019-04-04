<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daftar Kepegawaian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="<?=base_url()?>Assets/login/images/logo.png"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/css/main.css"> 
<!--===============================================================================================-->

</head>
<body>

  <div class="container-login100">
    <div class="wrap-login100" style="width: 800px; margin-top: 10px" >

      <!-- multistep form -->
      <form action="<?php echo site_url(); ?>/login/daftar" enctype="multipart/form-data" method="post">
    
        <div align="center">
          <span><h4 align="center"><b>DAFTAR PELAMAR</b></h4></span>
          <hr style="border: solid 2px; width: 250px">
          <hr style="border: solid 1px; width: 200px">
          <?php foreach ($last as $key) { ?>
            <input type="hidden" name="id_karyawan" value="<?php echo $key['id_karyawan']+1?>">
          <?php } ?>
          <table width="100%" style="margin-top: -100px">
            <tr style="height: 50px"><div class="form-group row">
              <td style="width: 30%"><strong>Nama Lengkap :</strong></td>
              <td><input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required></td>
            </tr></div>
            <tr style="height: 50px"><div class="form-group row">
              <td><strong>Nomor KTP :</strong></td>
              <td><input type="text" class="form-control" name="no_ktp" placeholder="Nomor KTP" required></td>
            </tr></div>
            <tr style="height: 50px"><div class="form-group row">
              <td><strong>Email :</strong></td>
              <td><input type="text" class="form-control" name="email"  placeholder="Email" required></td>
            </tr></div>
            <tr style="height: 50px"><div class="form-group row">
              <td> <strong>Username :</strong> </td>
              <td><input class="form-control" type="text" name="username"  placeholder="username" required></td>
            </tr></div>
            <tr style="height: 50px"><div class="form-group row">
              <td><strong>Password :</strong></td>
              <td><input class="form-control" type="password" name="password"  placeholder="password" required></td>
            </tr></div>
            <tr style="height: 50px"><div class="form-group row">
              <td><strong>Jenjang Pendidikan :</strong></td>
              <td><select class="form-control" name="pend_akhir">
                <option>-- Pilihan --</option>
                <option>SMA/SMK</option>
                <option>D-III</option>
                <option>D-IV</option>
                <option>S1</option>
                <option>S2</option>
                <option>S3</option>
              </select></td>
            </tr></div>
            <tr style="height: 50px"><div class="form-group row">
              <td><strong>NEM/IPK :</strong></td>
              <td><input class="form-control" type="text" name="ipk"  placeholder="NEM/IPK" required></td>
            </tr></div>
          </table><br>
          <div class="text-center">
              <button class="btn btn-primary loginbtn">Daftar</button>
              <button class="btn btn-default"><a href="<?=base_url()?>index.php/login/">Batal</a></button>
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