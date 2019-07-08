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
  <section id="services" class="section-bg">
    <div class="container">

      <header class="section-header">
        <h3>Peluang Karir</h3>
      </header>

      <div class="row">
        <div class="col-md-12 col-lg-12 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
          <div class="row">
          <?php foreach ($loker as $key) {
            $prof = $this->db->query("SELECT id_profesi from karyawan where id_status = 'Pelamar' group by id_profesi");//cari profesi yg telah dipilih
            $mprof = $prof->result();
            foreach ($mprof as $profe) {
              if ($profe->id_profesi == "Belum") {
              }else if ($profe->id_profesi == $key->id_profesi) {
              $maque = $this->db->query("SELECT count(id_karyawan) as slsh from karyawan where id_profesi = '$key->id_profesi' AND id_status = 'Pelamar'");//cari banyak orang yang milih
              $selisih = $maque->row(); 
              if ($key->kuota-$selisih->slsh == 0) {//jika kuota masih ada
                ?>
               <div class="col-md-4 col-lg-4 ">
            <div class="box">
            <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc8;"></i></div>
            <h4 class="title" ><a href="#contact" class="scrollto"><?php echo $key->nama_profesi;?></a></h4>
            <p class="description">
              <strong>Mulai :</strong> 
              <?php echo date('d - M - Y', strtotime($key->mulai));?> <br>
              <strong>Sampai :</strong> <?php echo date('d - M - Y', strtotime($key->akhir));?> <br><br>
              
              <strong>IPK Min :</strong> <?php echo $key->ipkmin;?><br>
              <?php echo $key->jenkel;?> <br><strong>Usia maksimal :</strong> <?php echo $key->usia;?> Tahun<br>
              <strong>Jurusan :</strong> <?php echo $key->jurusan;?><br>
              <!-- <strong>kuota :</strong> <?php echo $key->kuota-$selisih->slsh;?> Orang<br> -->
            </p>
            </div>
          </div>
            <?php  }else{} //jika kuota sudah habis
          
           }else{ ?>
            <div class="col-md-4 col-lg-4 ">
            <div class="box">
            <div class="icon"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
            <h4 class="title" ><a href="#contact" class="scrollto"><?php echo $key->nama_profesi;?></a></h4>
            <p class="description">
              <strong>Mulai :</strong> 
              <?php echo date('d - M - Y', strtotime($key->mulai));?> <br>
              <strong>Sampai :</strong> <?php echo date('d - M - Y', strtotime($key->akhir));?> <br><br>
              
              <strong>IPK Min :</strong> <?php echo $key->ipkmin;?><br>
              <?php echo $key->jenkel;?> <br><strong>Usia maksimal :</strong> <?php echo $key->usia;?> tahun<br>
              <strong>Jurusan :</strong> <?php echo $key->jurusan;?><br>
              <!-- <strong>kuota :</strong> <?php echo $key->kuota;?><br> -->
            </p>
            </div>
          </div>
          <?php }}} ?>
          </div>
        </div> 
      </div>
      <div align="center">
        <a href="<?=base_url()?>index.php/login">Kembali</a>
      </div>
    </div>
  </section>
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

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
