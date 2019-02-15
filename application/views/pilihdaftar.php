<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Kepegawaian</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="<?=base_url()?>Assets/login/images/logo.png"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>Assets/login/css/main.css">
    <style type="text/css">
        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto auto;
            background-color: #ffffff;
            padding: 5px;
        }
        .grid-item {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid rgba(0, 0, 0, 0.8);
            padding: 20px;
            font-size: 30px;
            text-align: center;
        }
    </style>
<!--===============================================================================================-->
</head>
<body>
    
    <div class="container-login100">
            <div class="wrap-login100" style="width: 1000px;" >
            <span class="login100-form-title p-b-10">
                <h5>Pilihan Profesi:</h5>
            </span>
            <div class="grid-container">
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar2/Administrasi" style="font-size: 20px;">Administrasi</a></div>
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar/Analiskes" style="font-size: 20px;">Analisis Kesehatan</a></div>
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar/Apoteker";  style="font-size: 20px;">Apoteker</a></div>
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar/Aspot" style="font-size: 20px;">Asisten Apoteker</a></div>
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar/Fisioterapis" style="font-size: 20px;">Fisioterapis</a></div>
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar2/Kasir" style="font-size: 20px;">Kasir</a></div>
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar2/Pekarya" style="font-size: 20px;">Pekarya</a></div>
              <div class="grid-item"><a href="<?=base_url()?>index.php/login/viewdaftar/Perawat" style="font-size: 20px;">Perawat</a></div>
            </div>
        </div>
    </div>

<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="<?=base_url()?>Assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?=base_url()?>Assets/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="<?=base_url()?>Assets/login/js/main.js"></script>

</body>
</html>