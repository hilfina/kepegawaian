<?php 
  $levelku=$this->session->userdata("myLevel");
  $idku=$this->session->userdata("myId");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
  $aktifku=$this->session->userdata("myAktif");
  $statusku=$this->session->userdata("myStatus");
  $profesiku=$this->session->userdata("myProfesi");
  $finalku=$this->session->userdata("myFinalisasi");
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kepegawaian</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- notifications CSS
        ============================================ -->
    <link rel="stylesheet" href="css/notifications/Lobibox.min.css">
    <link rel="stylesheet" href="css/notifications/notifications.css">
    <!-- favicon
        ============================================ -->
    <link rel="shortcut icon" type="template/image/x-icon" href="<?php echo base_url()?>Assets/img/favicon.ico">
    <!-- Google Fonts
        ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/bootstrap.min.css">
    <!-- Bootstrap CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/font-awesome.min.css">
    <!-- owl.carousel CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/owl.theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/owl.transitions.css">
    <!-- animate CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/animate.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/normalize.css">
    <!-- meanmenu icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/meanmenu.min.css">
    <!-- main CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/main.css">
    <!-- educate icon CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/educate-custon-icon.css">
    <!-- morrisjs CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/calendar/fullcalendar.print.min.css">
    <!-- touchspin CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/touchspin/jquery.bootstrap-touchspin.min.css">
    <!-- x-editor CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/editor/select2.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/editor/datetimepicker.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/editor/bootstrap-editable.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/editor/x-editor-style.css">
    <!-- normalize CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/data-table/bootstrap-table.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/data-table/bootstrap-editable.css">
     <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/form/all-type-forms.css">
    <!-- datapicker CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/datapicker/datepicker3.css">
    <!-- forms CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/form/themesaller-forms.css">
    <!-- style CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/style.css">
    <!-- style alert CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/alerts.css">
    <!-- select2 CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/select2/select2.min.css">
    <!-- chosen CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/chosen/bootstrap-chosen.css">
    <!-- responsive CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/responsive.css">
    <!-- modals CSS
        ============================================ -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/modals.css">
    <!-- modernizr JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/vendor/modernizr-2.8.3.min.js"></script>
   <style type="text/css">
    .lulus {
      background-color: #b3ffb3;
      width:45%;
      height: 120px;
      border-radius: 10px;
   }
   .gagal {
      background-color: #ff8080;
      width:45%;
      height: 120px;
      border-radius: 10px;
   }
   .belom {
      background-color: #e6f2ff;
      width:45%;
      height: 120px;
      border-radius: 10px;
   }
   .masih {
      background-color: #ffff80;
      width:45%;
      height: 120px;
      border-radius: 10px;
   }
   .img{
    max-height: 100%;
    max-width: 100%;
    transition: 0,75s;
    align-items: right;
   }
   .zoomimage:hover img{
    transform: scale(7.9);
   }
   .zoomimage{
    overflow:90%;
    text-align: center;
   }
   </style>
</head>
<body>
  <!-- Start Header menu area -->
  <div class="left-sidebar-pro">
    <nav id="sidebar" class="">
      <div class="sidebar-header">
        <a href="index.html"><img class="main-logo" src="<?php echo base_url()?>Assets/template/img/logo.png" alt="" width="180px" /></a>
        <strong><a href="index.html"><img src="img/logo/logosn.png" alt="" /></a></strong>
      </div>
      <div class="left-custom-menu-adp-wrap comment-scrollbar">
        <nav class="sidebar-nav left-sidebar-menu-pro">
          <ul class="metismenu" id="menu1">
            <?php if($levelku == "admin"){?>
              <li>
                <a title="Home" href="<?php echo site_url('home/') ?>">
                  <span class="educate-icon educate-home icon-wrap"></span>
                  <span class="mini-click-non">Home</span>
                </a>
              </li>
              <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                  <span class="educate-icon educate-professor icon-wrap"></span> 
                  <span class="mini-click-non">Data Karyawan</span>
                </a>
                <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                  <li><a title="Karyawan" href="<?php echo site_url('adminKaryawan/') ?>">Karyawan</a></li>
                  <li><a title="Karyawan" href="<?php echo site_url('admin/datapend') ?>">Pendidikan</a></li>
                  <li><a title="Diklat" href="<?php echo site_url('adminDiklat/') ?>">Diklat</a></li>
                  <li><a title="Orientasi" href="<?php echo site_url('adminOri/') ?>">Orientasi</a></li>
                  <li><a title="Uraian Tugas" href="<?php echo site_url('adminUrgas/') ?>">Uraian Tugas</a></li>
                  <li><a title="Proses Kredensial" href="<?php echo site_url('adminKew/') ?>">Proses Kredensial</a></li>
                  <li><a title="Data Profesi" href="<?php echo site_url('adminProfesi/') ?>">Data profesi</a></li>
                  <li><a title="Data Profesi" href="<?php echo site_url('adminJenStatus/') ?>">Data Status</a></li>
                </ul>
              </li>
              <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                  <span class="educate-icon educate-library icon-wrap"></span>
                  <span class="mini-click-non">File Kepegawaian</span>
                </a>
                <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                  <li><a title="MOU Hutang" href="<?php echo site_url('adminJenSurat/') ?>">Data Jenis Surat</a></li>
                  <li><a title="MOU Hutang" href="<?php echo site_url('admin/datasurat') ?>">Data Surat</a></li>
                  <li><a title="MOU Hutang" href="<?php echo site_url('adminHutang/') ?>">MOU Hutang</a></li>
                  <li><a title="MOU Kontrak" href="<?php echo site_url('adminKontrak') ?>">MOU Kontrak</a></li>
                  <li><a title="MOU Sekolah" href="<?php echo site_url('adminSekolah') ?>">MOU Sekolah</a></li>
                  <li><a title="MOU Klinis" href="<?php echo site_url('adminKlinis') ?>">MOU Klinis</a></li>
                </ul>
              </li>
              <li><a class="has-arrow" href="#" aria-expanded="false">
                <span class="educate-icon educate-library icon-wrap"></span> 
                <span class="mini-click-non">Data Riwayat</span></a>
                <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                  <li><a title="Penempatan" href="<?php echo site_url('adminRiwayat/') ?>">Penempatan</a></li>
                  <li><a title="Status" href="<?php echo site_url('adminStatus') ?>">Status</a></li>
                  <li><a title="Golongan" href="<?php echo site_url('adminGol') ?>">Golongan</a></li>
                  <li><a title="Berkala" href="<?php echo site_url('adminBerkala') ?>">Berkala</a></li>
                </ul>
              </li>
              <li>
                <a class="has-arrow" href="#" aria-expanded="false">
                  <span class="educate-icon educate-student icon-wrap"></span> 
                  <span class="mini-click-non">Data Pelamar</span>
                </a>
                <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                  <li><a title="Semua Pelamar" href="<?php echo site_url('adminPelamar') ?>">Pelamar</a></li>
                  <li><a title="Sedang Seleksi" href="<?php echo site_url('admin/dataSeleksi') ?>">Seleksi Pelamar</a></li>
                  <li><a title="Loker" href="<?php echo site_url('adminLoker') ?>">Lowongan Pekerjaan</a></li>
                </ul>
              </li>
            <?php }elseif ($levelku == "Pelamar" && $statusku == "Pelamar" && $aktifku == '1' && $finalku == '0') { ?>
              <li>
                <?php if ($profesiku == "Belum") {?>
                <li>
                  <a title="Home" href="<?php echo site_url('pelamar/home') ?>">
                    <span class="educate-icon educate-home icon-wrap"></span>
                    <span class="mini-click-non">Peluang Karir</span>
                  </a>
                </li>
                <?php } else {?>
                  <li>
                    <a title="Home" href="#">
                      <span class="educate-icon educate-home icon-wrap"></span>
                      <span class="mini-click-non">Home</span>
                    </a>
                  </li>
                  <li>
                    <a title="Home" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>">
                      <span class="educate-icon educate-home icon-wrap"></span>
                      <span class="mini-click-non">Proses Pelamaran</span>
                    </a>
                  </li>
                <?php } ?>
                <li>
                  <a title="Data Diri" href="<?php echo site_url('pelamar/datasaya') ?>">
                    <span class="educate-icon educate-professor icon-wrap"></span>
                    <span class="mini-click-non">Profil Saya</span>
                  </a>
                </li>
                <li>
                  <a title="Data Pendidikan" href="<?php echo site_url('pelamar/datapend') ?>">
                    <span class="educate-icon educate-library icon-wrap"></span>
                    <span class="mini-click-non">Data Pendidikan</span>
                  </a>
                </li>
                <?php if($profesiku != "Kasir" || $profesiku != "Administrasi" || $profesiku != "Pekarya" ){?>
                  <li>
                    <a title="Data Surat" href="<?php echo site_url('pelamar/datasurat') ?>">
                      <span class="educate-icon educate-message icon-wrap"></span>
                      <span class="mini-click-non">Data Surat</span>
                    </a>
                  </li>
                <?php } ?>
                <?php if ($profesiku != "Belum" ) {?>
                  <li>
                    <a title="Finalisasi" href="<?php echo site_url('pelamar/finalisasi')?>"
                      ><span class="fa fa-check-square-o" ></span>
                      <span class="mini-click-non"> Finalisasi Data</span>
                    </a>
                  </li>
                <?php } ?>
              </li>
            <?php } elseif ($levelku == "Pelamar" && $statusku == "Pelamar" && $aktifku == '1' && $finalku == '1') { ?>
              <li>
                <a title="Home" href="#">
                  <span class="educate-icon educate-home icon-wrap"></span>
                  <span class="mini-click-non">Home</span>
                </a>
              </li>
              <li><a title="Cetak" href="<?php echo site_url('pelamar/Cetak') ?>"><span class="mini-click-non">Cetak Kartu Seleksi</span></a></li> 
              <li><a title="Data Diri" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>"><span class="mini-click-non">Proses Lamaran</span></a></li>
            <?php } elseif ($levelku == "Pelamar" && $statusku == "Pelamar" && $aktifku == '0') {?>
                <li>
                  <a title="Kirim Ulang" href="<?php echo site_url('pelamar/aktivasi') ?>">
                    <span class="mini-click-non">Aktivasi Akun</span>
                  </a>
                </li>
            <?php } elseif ($levelku == "Pelamar" && $statusku == "Calon Karyawan") { ?>
            <li>
              <li>
                <a title="Home" href="#">
                  <span class="educate-icon educate-home icon-wrap"></span>
                  <span class="mini-click-non">Home</span></a>
              </li>
              <li><a title="Cetak" href="<?php echo site_url('pelamar/Cetak') ?>"><span class="mini-click-non">Cetak Kartu Seleksi</span></a></li> 
              <li><a title="Data Diri" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>"><span class="mini-click-non">Proses Lamaran</span></a></li>
            </li>
            <?php } elseif ($levelku == "Karyawan" && $aktifku == '0')  { ?>
            <li>
              <a title="Aktivasi Akun" href="<?php echo site_url('pelamar/aktivasi') ?>">
                <span class="mini-click-non">Aktivasi Akun</span>
              </a>
            </li>
            <?php } elseif ($levelku == "Karyawan" && $aktifku == '1')  { ?>
            <li>
              <a title="Home" href="#">
                <span class="educate-icon educate-home icon-wrap"></span>
                <span class="mini-click-non">Home</span>
              </a>
              <a title="Data Karyawan" href="<?php echo site_url('karyawan/datasaya') ?>">
                <span class="educate-icon educate-professor icon-wrap"></span> 
                <span class="mini-click-non">Profil Saya</span>
              </a>
              <a title="Data Pendidikan" href="<?php echo site_url('karyawan/datapend') ?>">
                <span class="educate-icon educate-library icon-wrap"></span>
                <span class="mini-click-non">Data Pendidikan</span>
              </a>
              <a title="Data Orientasi" href="<?php echo site_url('karyawan/dataori') ?>">
                <span class="educate-icon educate-course icon-wrap"></span>
                <span class="mini-click-non">Data Orientasi</span>
              </a>
              <a title="Data Diklat" href="<?php echo site_url('karyawan/datadiklat') ?>">
                <span class="educate-icon educate-department icon-wrap"></span>
                <span class="mini-click-non">Data Diklat</span>
              </a>
              <a title="Data Kredensial Klinis" href="<?php echo site_url('karyawan/datakew') ?>">
                <span class="educate-icon educate-course icon-wrap"></span>
                <span class="mini-click-non">Proses Kredensial</span>
              </a>
                <?php if($profesiku != "Kasir" || $profesiku != "Administrasi" || $profesiku != "Pekarya"){?>
                  <a title="Data Surat" href="<?php echo site_url('karyawan/datasurat') ?>">
                    <span class="educate-icon educate-message icon-wrap"></span>
                    <span class="mini-click-non">Data Surat</span>
                  </a>
                <?php }?>
              <?php }?>
            </li>
          </ul>
        </nav>
      </div>
    </nav>
  </div>
   
  <div class="all-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="logo-pro">
            <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
          </div>
        </div>
      </div>
    </div>
    <div class="header-advance-area">
      <div class="header-top-area">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="header-top-wraper">
                <div class="row">
                  <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                    <div class="menu-switcher-pro">
                      <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                        <i class="educate-icon educate-nav"></i>
                      </button>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-7 col-sm-5 col-xs-12">
                    <div class="header-top-menu tabl-d-n"> </div>
                  </div>
                  <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="header-right-info">
                      <ul class="nav navbar-nav mai-top-nav header-right-menu">
                        <?php if($levelku == "admin"){ ?>
                          <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                          <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                            <div class="notification-single-top">
                              <h1>Notifications</h1>
                            </div>
                              <ul class="notification-menu">
                                <?php 
                                  $tanggal = date('Y-m-d'); 
                                  $tanggal2 = date('Y-m-d', strtotime('+6 month',strtotime($tanggal))); 
                                  $tanggal3 = date('Y-m-d', strtotime('+3 month',strtotime($tanggal))); 
                                  if ($this->db->get('sip_str')) { 
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('sip_str', 'karyawan.id_karyawan = sip_str.id_karyawan');
                                    $this->db->join('jenis_surat', 'sip_str.id_surat = jenis_surat.id_surat');
                                    $surat = $this->db->get()->result();
                                    foreach ($surat as $key => $surat) {
                                      if ($surat->tgl_akhir <= $tanggal2 && $surat->mail != 1) { ?>
                                        <li>
                                          <a href="<?php echo site_url('adminNotifikasi/Nsurat/');echo $surat->id_sipstr?>" title="Kirim Email Notifikasi">
                                            <div class="notification-content">
                                              <h2><?php echo $surat->nama; ?></h2>
                                              <p><?php echo "File ".$surat->nama_surat." akan berakhir pada tangal ".date('d M Y', strtotime($surat->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }
                                  if ($this->db->get('mou_hutang')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_hutang', 'karyawan.id_karyawan = mou_hutang.id_karyawan');
                                    $mou_h = $this->db->get()->result();
                                    foreach ($mou_h as $key => $mou_h) {
                                      if ($mou_h->tgl_akhir <= $tanggal3 && $mou_h->notif != 1) { ?>
                                        <li>
                                          <a href="<?php echo site_url('adminNotifikasi/Nhutang/');echo $mou_h->id?>" title="Lihat Data">
                                            <div class="notification-content">
                                              <h2><?php echo $mou_h->nama; ?></h2>
                                              <p><?php echo "MOU Hutang akan berakhir pada tangal ".date('d M Y', strtotime($mou_h->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('mou_klinis')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_klinis', 'karyawan.id_karyawan = mou_klinis.id_karyawan');
                                    $mou_kl = $this->db->get()->result();
                                    foreach ($mou_kl as $key => $mou_kl) {
                                      if ($mou_kl->tgl_akhir <= $tanggal3 && $mou_kl->notif != 1) { ?>
                                        <li>
                                          <a href="<?php echo site_url('adminNotifikasi/Nklinis/');echo $mou_kl->id?>" title="Lihat Data">
                                            <div class="notification-content">
                                              <h2><?php echo $mou_kl->nama; ?></h2>
                                              <p><?php echo "MOU Klinis akan berakhir pada tangal ".date('d M Y', strtotime($mou_kl->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('mou_sekolah')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_sekolah', 'karyawan.id_karyawan = mou_sekolah.id_karyawan');
                                    $mou_s = $this->db->get()->result();
                                    foreach ($mou_s as $key => $mou_s) {
                                      if ($mou_s->tgl_akhir <= $tanggal3 && $mou_s->notif != 1) { ?>
                                        <li>
                                          <a href="<?php echo site_url('adminNotifikasi/Nsekolah/');echo $mou_s->id?>" title="Lihat Data">
                                            <div class="notification-content">
                                              <h2><?php echo $mou_s->nama; ?></h2>
                                              <p><?php echo "MOU Sekolah akan berakhir pada tangal ".date('d M Y', strtotime($mou_s->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('mou_kontrak')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_kontrak', 'karyawan.id_karyawan = mou_kontrak.id_karyawan');
                                    $mou_k = $this->db->get()->result();
                                    foreach ($mou_k as $key => $mou_k) {
                                      if ($mou_k->tgl_akhir <= $tanggal3 && $mou_k->notif != 1) { ?>
                                        <li>
                                          <a href="<?php echo site_url('adminNotifikasi/Nkontrak/');echo $mou_k->id?>" title="Lihat Data">
                                            <div class="notification-content">
                                              <h2><?php echo $mou_k->nama; ?></h2>
                                              <p><?php echo "MOU Kontrak akan berakhir pada tangal ".date('d M Y', strtotime($mou_k->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('kewenangan_klinis')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('kewenangan_klinis', 'karyawan.id_karyawan = kewenangan_klinis.id_karyawan');
                                    $kew = $this->db->get()->result();
                                    foreach ($kew as $key => $kew) {
                                      if ($kew->tgl_akhir <= $tanggal3 && $kew->notif != 1) { ?>
                                        <li>
                                          <a href="<?php echo site_url('adminNotifikasi/NKew/');echo $kew->id_kewenangan?>" title="Lihat Data">
                                            <div class="notification-content">
                                              <h2><?php echo $kew->nama; ?></h2>
                                              <p><?php echo "Kredensial akan berakhir pada tangal ".date('d M Y', strtotime($kew->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('status')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('status', 'karyawan.id_karyawan = status.id_karyawan');
                                    $status = $this->db->get()->result();
                                    foreach ($status as $key => $status) {
                                      if ($status->akhir <= $tanggal3 && $status->notif != 1) { ?>
                                        <li>
                                          <a href="<?php echo site_url('adminNotifikasi/NStatus/');echo $status->id."/".$status->id_karyawan; ?>" title="Lihat Data">
                                            <div class="notification-content">
                                              <h2><?php echo $status->nama; ?></h2>
                                              <p><?php echo "Akan berakhir status sebagai ".$status->id_status." pada tangal ".date('d M Y', strtotime($status->akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }
                                  ?>
                              </ul>
                          </div>
                      </li>
                        <?php }elseif($levelku == "Karyawan"){ ?>
                          <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><i class="educate-icon educate-bell" aria-hidden="true"></i><span class="indicator-nt"></span></a>
                          <div role="menu" class="notification-author dropdown-menu animated zoomIn">
                            <div class="notification-single-top">
                              <h1>Notifications</h1>
                            </div>
                              <ul class="notification-menu">
                                <?php 
                                  $tanggal = date('Y-m-d'); 
                                  $tanggal2 = date('Y-m-d', strtotime('+6 month',strtotime($tanggal))); 
                                  $tanggal3 = date('Y-m-d', strtotime('+3 month',strtotime($tanggal))); 
                                  if ($this->db->get('sip_str')) { 
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('sip_str', 'karyawan.id_karyawan = sip_str.id_karyawan');
                                    $this->db->join('jenis_surat', 'sip_str.id_surat = jenis_surat.id_surat');
                                    $surat = $this->db->get()->result();
                                    foreach ($surat as $key => $surat) {
                                      if ($surat->tgl_akhir <= $tanggal2 && $surat->notif_k != 1 && $surat->id_karyawan == $idku) { ?>
                                        <li>
                                          <a href="<?php echo site_url('karyawan/Nsurat/');echo $surat->id_sipstr?>" >
                                            <div class="notification-content">
                                              <h2><?php echo $surat->nama_surat; ?></h2>
                                              <p><?php echo "File ".$surat->jenis_surat." anda akan berakhir pada tangal ".date('d M Y', strtotime($surat->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }
                                  if ($this->db->get('mou_hutang')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_hutang', 'karyawan.id_karyawan = mou_hutang.id_karyawan');
                                    $mou_h = $this->db->get()->result();
                                    foreach ($mou_h as $key => $mou_h) {
                                      if ($mou_h->tgl_akhir <= $tanggal3 && $mou_h->notif_k != 1 && $mou_h->id_karyawan == $idku) { ?>
                                        <li>
                                          <a href="<?php echo site_url('karyawan/Nhutang/');echo $mou_h->id; ?>" >
                                            <div class="notification-content">
                                              <h2>MOU Hutang</h2>
                                              <p><?php echo "MOU Hutang anda akan berakhir pada tangal ".date('d M Y', strtotime($mou_h->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('mou_klinis')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_klinis', 'karyawan.id_karyawan = mou_klinis.id_karyawan');
                                    $mou_kl = $this->db->get()->result();
                                    foreach ($mou_kl as $key => $mou_kl) {
                                      if ($mou_kl->tgl_akhir <= $tanggal3 && $mou_kl->notif_k != 1 && $mou_kl->id_karyawan == $idku) { ?>
                                        <li>
                                          <a href="<?php echo site_url('karyawan/Nklinis/');echo $mou_kl->id; ?>" >
                                            <div class="notification-content">
                                              <h2>MOU Klinis</h2>
                                              <p><?php echo "MOU Klinis anda akan berakhir pada tangal ".date('d M Y', strtotime($mou_kl->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('mou_sekolah')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_sekolah', 'karyawan.id_karyawan = mou_sekolah.id_karyawan');
                                    $mou_s = $this->db->get()->result();
                                    foreach ($mou_s as $key => $mou_s) {
                                      if ($mou_s->tgl_akhir <= $tanggal3 && $mou_s->notif_k != 1 && $mou_s->id_karyawan == $idku) { ?>
                                        <li>
                                          <a href="<?php echo site_url('karyawan/Nsekolah/');echo $mou_s->id; ?>" >
                                            <div class="notification-content">
                                              <h2>MOU Sekolah</h2>
                                              <p><?php echo "MOU Sekolah anda akan berakhir pada tangal ".date('d M Y', strtotime($mou_s->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }if ($this->db->get('mou_kontrak')) {
                                    $this->db->select('*');
                                    $this->db->from('karyawan');
                                    $this->db->join('mou_kontrak', 'karyawan.id_karyawan = mou_kontrak.id_karyawan');
                                    $mou_k = $this->db->get()->result();
                                    foreach ($mou_k as $key => $mou_k) {
                                      if ($mou_k->tgl_akhir <= $tanggal3 && $mou_k->notif_k != 1 && $mou_k->id_karyawan == $idku) { ?>
                                        <li>
                                          <a href="<?php echo site_url('karyawan/Nkontrak/');echo $mou_k->id; ?>" >
                                            <div class="notification-content">
                                              <h2>MOU Kontrak</h2>
                                              <p><?php echo "MOU Kontrak anda akan berakhir pada tangal ".date('d M Y', strtotime($mou_k->tgl_akhir)) ;?></p>
                                            </div>
                                          </a>
                                        </li>
                              <?php   }
                                    }
                                  }
                                  ?>
                              </ul>
                          </div>
                      </li>
                        <?php }else{} ?>
                        <li class="nav-item">
                          <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <img src="img/product/pro4.jpg" alt="" />
                            <span class="admin-name"><?php echo $namaku?></span>
                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                          </a>
                          <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                            <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Ubah Sandi</a>
                            </li>
                            <li><a href="<?php echo site_url('admin/logout')?>"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                            </li>
                          </ul>
                        </li>
                        <li class="nav-item nav-setting-open"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"></a> 
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
            <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="mobile-menu">
              <nav id="dropdown">
                <ul class="mobile-menu-nav">
                  <?php if ($levelku == "admin") {?>
                    <li><a href="<?php echo site_url('home/') ?>">HOME</a></li>
                    <li><a data-toggle="collapse" data-target="#karyawan">data karyawan<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                      <ul id="karyawan" class="collapse dropdown-header-top">
                        <li><a href="<?php echo site_url('adminKaryawan/') ?>">Karyawan</a></li>
                        <li><a href="<?php echo site_url('adminDiklat/') ?>">Diklat</a></li>
                        <li><a href="<?php echo site_url('adminOri/') ?>">Orientasi</a></li>
                        <li><a href="<?php echo site_url('adminUraianTugas/') ?>">Uraian Tugas</a></li>
                      </ul>
                    </li>
                    <li><a href="<?php echo site_url('admin/dataPend') ?>">Data pendidikan</a></li>
                    <li><a href="<?php echo site_url('admin/dataSurat') ?>">data surat</a></li>
                    <li><a href="<?php echo site_url('adminKew/') ?>">kewenangan klinis</a></li>
                    <li><a data-toggle="collapse" data-target="#riwayat">data riwayat<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                      <ul id="riwayat" class="collapse dropdown-header-top">
                        <li><a href="<?php echo site_url('adminRiwayat/') ?>">Penempatan</a></li>
                        <li><a href="<?php echo site_url('adminStatus') ?>">Status</a></li>
                        <li><a href="<?php echo site_url('adminGol') ?>">Golongan</a></li>
                        <li><a href="<?php echo site_url('adminBerkala') ?>">Berkala</a></li>
                      </ul>
                    </li>
                    <li><a data-toggle="collapse" data-target="#mou">data M O U<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                      <ul id="mou" class="collapse dropdown-header-top">
                        <li><a href="<?php echo site_url('adminHutang/') ?>">Hutang</a></li>
                        <li><a href="<?php echo site_url('adminKontrak') ?>">Kontrak</a></li>
                        <li><a href="<?php echo site_url('adminSekolah') ?>">Sekolah</a></li>
                      </ul>
                    </li>
                    <li><a data-toggle="collapse" data-target="#pelamar">data pelamar<span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                      <ul id="pelamar" class="collapse dropdown-header-top">
                        <li><a href="<?php echo site_url('adminPelamar/') ?>">pelamar</a></li>
                        <li><a href="<?php echo site_url('admin/dataSeleksi') ?>">seleksi</a></li>
                        <li><a href="<?php echo site_url('admin/report/') ?>">data report</a></li>
                      </ul>
                    </li>
                    <li><a href="<?php echo site_url('adminLoker/') ?>">data lowongan</a></li>
                    <li><a href="<?php echo site_url('adminProfesi/') ?>">data profesi</a></li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>