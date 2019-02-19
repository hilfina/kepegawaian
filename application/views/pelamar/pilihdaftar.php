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
            border: 1px;
            border-color:  #000000;
            padding: 20px;
            font-size: 30px;
            text-align: center;
        }
        .griddaftar{
          background-color: #b3d9ff; 
          margin-right:     10px;
          margin-bottom:    10px;
        }
        .griddaftarr{
          background-color: #cce6ff ; 
          margin-right:     10px;
          margin-bottom:    10px;
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
            <div class="container-fluid" align="center" style="padding-top: 20px">
            <div class="grid-container">
                <a href="<?=base_url()?>index.php/login/viewdaftar2/Administrasi" ">
                    <div class="grid-item griddaftarr" style="font-size: 20px;">Administrasi</div>
                </a>
                <a href="<?=base_url()?>index.php/login/viewdaftar/AnalisKes" >
                    <div class="grid-item griddaftar" style="font-size: 20px;">Analis Kesehatan</div>
                </a>
                <a href="<?=base_url()?>index.php/login/viewdaftar/Perawat";>
                    <div class="grid-item griddaftarr" style="font-size: 20px;" >Apoteker</div>
                </a>
                <a href="<?=base_url()?>index.php/login/viewdaftar/Aspot";>
                    <div class="grid-item griddaftarr" style="font-size: 20px;" >Asisten Apoteker</div>
                </a>
                <a href="<?=base_url()?>index.php/login/viewdaftar/Fisioterapis";>
                    <div class="grid-item griddaftarr" style="font-size: 20px;" >Fisioterapis</div>
                </a>
                <a href="<?=base_url()?>index.php/login/viewdaftar2/Kasir";>
                    <div class="grid-item griddaftarr" style="font-size: 20px;" >Kasir</div>
                </a>
                <a href="<?=base_url()?>index.php/login/viewdaftar2/Pekarya";>
                    <div class="grid-item griddaftarr" style="font-size: 20px;" >Pekarya</div>
                </a>
                <a href="<?=base_url()?>index.php/login/viewdaftar/Perawat";>
                    <div class="grid-item griddaftarr" style="font-size: 20px;" >Perawat</div>
                </a>
            </div>
            <div class="container-fluid" align="center">
                <div class="p-t-115">
                    <a class="txt2" href="<?=base_url()?>index.php/login/">
                            Kembali ke Halaman Login
                        </a>
                </div>  
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