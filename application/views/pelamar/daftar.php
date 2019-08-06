
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
          </div>
          <div class="sparkline12-graph">
              <div class="input-knob-dial-wrap">
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
                      <div class="input-mask-title">
                        <label>Nama Lengkap</label>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                      <input name="nama" type="text" class="form-control" required >
                      <?php echo form_error('nama','<div style="color:red">', '</div>'); ?>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>No. Telepon</label>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                      <input name="no_telp" type="number" class="form-control" required>
                      <?php echo form_error('no_telp','<div style="color:red">', '</div>'); ?>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>Email</label>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                      <input name="email" type="email" class="form-control" required>
                      <?php if ($this->session->flashdata('msg_error')) :?>
                        <div style="color: red"> 
                        <?php echo $this->session->flashdata('msg_error')?>
                        </div>
                      <?php endif; ?>

                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>Username</label>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                      <input name="username" type="text" class="form-control" required>
                      <?php echo form_error('username','<div style="color:red">', '</div>'); ?>
                      <font size="2"> *Minimal 6 karakter. Disarankan menggunakan nomor ktp. </font>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>Password</label>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                      <input name="password" type="password" class="form-control" required minlength="8">
                      <?php echo form_error('password','<div style="color:red">', '</div>'); ?>
                      <font size="2"> *Minimal 8 karakter </font>
                    </div>

                  </div>
                  <br>
                  <div class="text-center">
                      <button class="btn btn-primary loginbtn">Daftar</button>
                      <button class="btn btn-default"><a href="<?=base_url()?>index.php/login/">Batal</a></button>
                  </div>
                </div>
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