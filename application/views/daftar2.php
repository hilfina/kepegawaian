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
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/daftar/main.css">
<!--===============================================================================================-->
    <style type="text/css">
    .form-control{
      font-family: arial;
    }
    </style>
</head>
<body>
<div class="container-login100">
<div class="wrap-login100" style="width: 800px;" >
<!-- multistep form -->
<form id="regForm" action="<?php echo site_url(); ?>/login/daftar2" enctype="multipart/form-data" method="post">
    

    <!-- One "tab" for each step in the form: -->
    <div class="tab">
      <span><h4 align="center">DATA KARYAWAN</h4></span>
    <br>
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">No. KTP :</label>
        <div class="col-sm-9">
           <input type="text" class="form-control" name="no_ktp" placeholder="No.KTP">
        </div>
      </div>
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">No. BPJS :</label>
        <div class="col-sm-9">
           <input type="text" class="form-control" name="no_bpjs" placeholder="No.BPJS">
           <p>*apabila tidak memiliki silahkan isikan dengan angka 0</p>
        </div>
      </div>
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Nama Lengkap :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Alamat :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="alamat"  placeholder="Alamat">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Nomor Telepon :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="no_telp"  placeholder="Nomor Telepon">
        </div>
      </div>  
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Email :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="email"  placeholder="Email">
        </div>
      </div>
      <input type="text" name="id_profesi"  value="<?php echo $profesi ?>" hidden> 
    </div>

    <!-- LOWONGAN -->
    <div class="tab">
      <span><h4 align="center">DATA PENDIDIKAN</h4></span>
    <br> 
    <?php foreach ($last as $key) { ?>
    <input type="hidden" name="id_karyawan" value="<?php echo $key['id_karyawan']+1?>">
    <?php } ?>
    <div class="form-group row">
      <label class="col-sm-3 form-control-label">Pendidikan Terakhir :</label>
        <div class="col-sm-9">
          <select type="text" class="form-control" name="pend_akhir">
          <option>S3</option>
          <option>S2</option>
          <option>S1</option>
          <option>D3</option>
          <option>D1</option>
          <option>SMA/SMK</option>
          </select>
        </div>  
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">IPK Terakhir :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="nilai_akhir"  placeholder="IPK Terakhir">
        </div>
      </div> 
    </div>

    <!-- PENDIDIKAN YANG DILAKUKAN-->
    <div class="tab">
      <span><h4 align="center">DATA RIWAYAT PENDIDIKAN</h4></span>
    <br>
    <?php foreach ($last as $key) { ?>
    <input type="hidden" name="id_karyawan" value="<?php echo $key['id_karyawan']+1?>">
    <?php } ?>
    <div class="form-group row">
      <label class="col-sm-3 form-control-label">Pendidikan :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="pendidikan"  placeholder="Pendidikan">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Tahun Mulai Pendidikan :</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="mulai">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Tahun Akhir Pendidikan :</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="akhir">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Nomor Ijazah :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="nomor_ijazah">
        </div>
      </div> 
      <div class="form-group row">
        <label class="col-sm-3 form-control-label">Masukkan Gambar Ijazah :</label>
        <div class="col-sm-9">
          <input type="file" class="form-control" name="pendidikanfile" />
          <p>*maximal ukuran gambar adalah 20mb</p>
        </div>
      </div> 
      
      <br> 
    </div>

    <div class="tab">
      <span><h4 align="center">DATA LOGIN</h4></span>
    <br>
    <?php foreach ($last as $key) { ?>
    <input type="hidden" name="id_karyawan" value="<?php echo $key['id_karyawan']+1?>">
    <?php } ?>
      <span> Username </span>
        <input class="form-control" type="text" name="username"  placeholder="username" required>
      <br> 
      <span> Password </span>
        <input class="form-control" type="password" name="password"  placeholder="password" required>
        <!-- <input class="form-control" type="text" name="level"  value="pelamar" hidden> -->
        <br>
    </div>
    <div style="overflow:auto;">
      <div style="float:right;">
        <button class="btn" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
        <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      </div>
    </div>
    <!-- Circles which indicates the steps of the form: -->
    <div style="text-align:center;margin-top:40px;">
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
      <span class="step"></span>
    </div>
</form>
</div>
</div>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?=base_url()?>Assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/daftar/main.js"></script>

</body>
</html>