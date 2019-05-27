<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sistem Informasi Kepegawaian RSIA</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?php echo base_url()?>Assets/login/images/logo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo base_url()?>login/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo base_url()?>login/lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>login/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>login/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>login/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>login/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo base_url()?>login/css/style.css" rel="stylesheet">

  <style type="text/css">
      .main-nav{
        font-size: 18px;
      }
  </style>
</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
        <a href="#intro" class="scrollto"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Home</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#services">Peluang Karir</a></li>
          <li><a href="#contact">Login/Daftar</a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-info" >
        <h2>Sistem Informasi Kepegawaian</h2><h3 style="color: white" >Rumah Sakit Islam Aisyiyah Malang</h3 >
      </div>

      <div class="intro-info" align="center">
      <img src="<?=base_url()?>assets/login/images/logo.png" style="width: 200px; height: 200px" alt="" class="img-fluid">
        
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">

        <header class="section-header">
          <h3>Tentang</h3>
          <p>Sistem Informasi Kepegawaian Rumah Sakit Islam Aisyiyah Malang berguna untuk pelamar apabila ingin mendaftar pada peluang karir dan juga sebagai pusat informasi data kepegawaian karyawan rumah sakit islam aisyiyah malang</p>
        </header>

          <div class="col-lg-6 background order-lg-2 order-1 wow fadeInUp">
            <img src="img/about-img.svg" class="img-fluid" alt="">
          </div>
          </div>
        </div>
      </div>
    </section><!-- #about -->

    <!--==========================
      Services Section
    ============================-->
    <section id="services" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Peluang Karir</h3>
          <p>Berikut daftar lowongan pekerjaan yang dibuka pada Rumah Sakit Islam Aisyiyah Malang</p>
        </header>

        <div class="row">
          <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="row">
            <?php foreach ($loker as $key) {?>
            <div class="col-md-6 col-lg-6 ">
                <div class="box">
              <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
                <h4 class="title" ><a href="#contact" class="scrollto"><?php echo $key->nama_profesi;?></a></h4>
                <p class="description">
                    <strong>Mulai :</strong> 
                    <?php echo date('d - M - Y', strtotime($key->mulai));?> <br>
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
                        ?>
                    
                    </font>
                </p>
            </div>
            </div>
            
            <?php } ?>
            </div>
          </div>         

        </div>

      </div>
    </section><!-- #services -->

    <!--==========================
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container-fluid">

        <div class="section-header">
          <h3>LOGIN</h3>
        </div>

        <div class="row wow fadeInUp">

          <div class="col-lg-3">
          </div>

          <div class="col-lg-6">

            <div class="form">
              
                <form action="<?php echo base_url()?>index.php/login" method="post">
                <?php if(isset($error)) { echo $error; }; ?>
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" id="subject" placeholder="Username" />
                      <div class="validation"></div>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="subject" placeholder="Password" data-rule="minlen:8" data-msg="Please enter at least 8 chars of subject" />
                      <div class="validation"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9"><font size="3" align="left" >Ingin melamar pekerjaan? Klik <a href="<?=base_url()?>index.php/login/daftar"> disini.</a></font> </div>
                        <div class="col-sm-3"><button type="submit">Masuk</button> </div>  

                    </div>   
                </form>
                
            </div>
          </div>

        <div class="col-lg-3">
        </div>

        </div>

      </div>
    </section><!-- #contact -->

  </main>

  <!--==========================
    Footer
  ============================-->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-info">
            <h3>Sistem Informasi Kepegawaian RSIA </h3>
            <p>Sistem informasi kepegawaian hanya dapat digunakan apabila tersambung pada wifi Rumah Sakit Islam Aisyiyah Malang </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Kontak</h4>
            <p>
              Jl. Sulawesi No.16<br>
              Kasin, Klojen 65117 <br>
              Kota Malang, Jawa Timur <br>
              <strong>Email:</strong> sdirsiamalang@gmail.com<br>
            </p>

            <div class="social-links">
              <a href="https://www.instagram.com/rsiaisyiyahmalang/" class="instagram"><i class="fa fa-instagram"></i></a>
              <a href="https://rsiaisyiyah-malang.or.id/" class="google-plus"><i class="fa fa-globe"></i></a>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-newsletter">
            <h4>Bantuan</h4>
            <p>Apabila anda lupa kata sandi login, silahkan menghubungi bagian SDI untuk reset password.</p>
           <!--  <form action="" method="post">
              <input type="email" name="email"><input type="submit"  value="Subscribe">
            </form> -->
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Polinema</strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="<?php echo base_url()?>login/lib/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/easing/easing.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/mobile-nav/mobile-nav.js"></script>
  <script src="<?php echo base_url()?>login/lib/wow/wow.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/waypoints/waypoints.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/counterup/counterup.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/isotope/isotope.pkgd.min.js"></script>
  <script src="<?php echo base_url()?>login/lib/lightbox/js/lightbox.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="<?php echo base_url()?>login/contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="<?php echo base_url()?>login/js/main.js"></script>

</body>
</html>
