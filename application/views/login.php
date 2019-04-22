<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="icon" type="image/png" href="<?=base_url()?>Assets/login/images/logo.png"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/owl.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/fonts/font-awesome-4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/fonts/eleganticons/et-icons.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/cardio.css">

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
</head>
<body>
<div class="preloader">
<img src="<?=base_url()?>Asset/img/loader.gif" alt="Preloader image">    
</div>
    <nav class="navbar">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><img src="<?=base_url()?>assets/login/images/logo.png" style="width: 60px" data-active-url="<?=base_url()?>assets/login/images/logo.png" alt=""></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right main-nav">
                    <li><a href="#intro">Home</a></li>
                    <li><a href="#dua">Peluang Karir</a></li>
                    <li><a href="#tiga">Contact</a></li>
                    <li><a href="#satu">Login/Daftar</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    
    <header id="intro">
        <div class="container">
            <div class="table">
                <div class="header-text">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="light white">Sistem Informasi Kepegawaian</h3>
                            <h1 class="white typed">Rumah Sakit Islam Aisyiyah</h1>
                            <span class="typed-cursor">|</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="section" id="satu" style="background-color: white">
        <div class="container-login100"  style="background-color: white">
                <div class="container" style="width: 500px; background-color: white" >
                    <div align="center">
                        <span><h3 align="center"><b>LOGIN</b></h3></span>
                        <hr style="border: solid 2px; width: 250px">
                    </div><br>
                
                <form class="login100-form validate-form"method="POST" action="<?php echo base_url() ?>index.php/login">
                    <?php if(isset($error)) { echo $error; }; ?>
                    <strong>
                        <div class="wrap-input100 validate-input" data-validate = "Enter Username">
                        <input class="input100" type="text" name="username">
                        <span class="focus-input100" data-placeholder="Username"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                    </strong>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                <br>
                </form>
                <div align="center">
                    <a href="<?=base_url()?>index.php/login/viewdaftar" >
                       <div class="container-login100-form-btn" style="width: 250px">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn">
                                    Daftar
                                </button>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
    </section>
    <section id="dua" class="section section-padded" >
        <div class="container">
            <div class="row text-center title">
                <div align="center"><span><h3 align="center"><b>PELUANG KARIR</b></h3></span>
                <hr style="border: solid 2px; width: 250px">
            </div>
                <?php foreach ($loker as $key) {?>
                    <div class="col-md-4" >
                    <div class="service" style="height: 400px">
                        <div class="icon-holder">
                            <img src="<?=base_url()?>asset/img/icons/heart-blue.png" alt="" class="icon">
                        </div>
                        <h4 class="heading"><?php echo $key->nama_profesi;?></h4>
                        <p class="description">
                            <strong>Mulai :</strong> <?php echo date('d - M - Y', strtotime($key->mulai));?> <br>
                            <strong>Sampai :</strong> <?php echo date('d - M - Y', strtotime($key->akhir));?> <br><br>
                            <strong>Jurusan :</strong> <?php echo $key->jurusan;?><br>
                            <strong>IPK Min :</strong> <?php echo $key->ipkmin;?><br>
                            <?php echo $key->jenkel;?> <br><strong> dengan usia maks </strong> <?php echo $key->usia;?> tahun<br> 

                        <br>
                        <font color="red">
                            <?php if ( date('y-m-d') <= date('y-m-d', strtotime($key->akhir))) {
                                echo "Sedang Dibuka";
                            }else{
                                echo "Sudah Ditutup";
                            }
                            ?></font>
                        </p>
                    </div>
                </div>
                <?php } ?>
        </div>
        <!-- <div class="cut cut-bottom"></div> -->
    </section>

    <footer id="tiga">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 text-center-mobile">
                    <h3 class="white">Reserve a Free Trial Class!</h3>
                    <h5 class="light regular light-white">Shape your body and improve your health.</h5>
                    <a href="#" class="btn btn-blue ripple trial-button">Start Free Trial</a>
                </div>
                <div class="col-sm-6 text-center-mobile">
                    <h3 class="white">Opening Hours <span class="open-blink"></span></h3>
                    <div class="row opening-hours">
                        <div class="col-sm-6 text-center-mobile">
                            <h5 class="light-white light">Mon - Fri</h5>
                            <h3 class="regular white">9:00 - 22:00</h3>
                        </div>
                        <div class="col-sm-6 text-center-mobile">
                            <h5 class="light-white light">Sat - Sun</h5>
                            <h3 class="regular white">10:00 - 18:00</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Holder for mobile navigation -->
    <div class="mobile-nav">
        <ul>
        </ul>
        <a href="#" class="close-link"><i class="arrow_up"></i></a>
    </div>
    <!-- Scripts -->
    <script src="<?=base_url()?>asset/js/jquery-1.11.1.min.js"></script>
    <script src="<?=base_url()?>asset/js/owl.carousel.min.js"></script>
    <script src="<?=base_url()?>asset/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>asset/js/wow.min.js"></script>
    <script src="<?=base_url()?>asset/js/typewriter.js"></script>
    <script src="<?=base_url()?>asset/js/jquery.onepagenav.js"></script>
    <script src="<?=base_url()?>asset/js/main.js"></script>
</body>

</html>