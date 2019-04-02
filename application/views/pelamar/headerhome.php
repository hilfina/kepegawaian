<?php 
  $idku=$this->session->userdata("myId");
  $levelku=$this->session->userdata("myLevel");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
  $aktifku=$this->session->userdata("myAktif");
  $statusku=$this->session->userdata("myStatus");
  $profesiku=$this->session->userdata("myProfesi");
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Kepegawaian</title>
    <!-- HEADER -->
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/owl.transitions.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/meanmenu.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/educate-custon-icon.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/metisMenu/metisMenu-vertical.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/form/themesaller-forms.css">
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/style.css"> 
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/responsive.css"> 
    <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/font-awesome.min.css">  
    <!-- BODY  -->
    <link rel="icon" type="image/png" href="<?=base_url()?>Assets/login/images/logo.png"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/owl.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/fonts/font-awesome-4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/fonts/eleganticons/et-icons.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>asset/css/cardio.css">
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
                        <li class="active">
                            <a title="Home" href="<?php echo site_url('pelamar/home') ?>"><span class="educate-icon educate-home icon-wrap"></span><span class="mini-click-non">Home</span></a>
                        </li>
                        
                        <?php if ($statusku == "Pelamar" && $aktifku == '1') { ?>
                        <li>
                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Data Saya</span></a>
                            <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                                <li><a title="Data Diri" href="<?php echo site_url('pelamar/datasaya') ?>"><span class="mini-cli">Data Diri</span></a></li>
                                <li><a title="Data Pendidikan" href="<?php echo site_url('pelamar/datapend') ?>"><span class="mini-sub-pro">Data Pendidikan</span></a></li>
                                <li><a title="Data Surat" href="<?php echo site_url('pelamar/datasurat') ?>"><span class="mini-sub-pro">Data Surat</span></a></li>
                            </ul>
                        </li>
                        <?php 
                        if ($profesiku != "Belum") {?>
                            <li><a title="Data Diri" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>"><span class="mini-cli">Proses Lamaran</span></a></li>
                        <?php }
                    } elseif ($statusku == "Pelamar" && $aktifku == '0') {?>
                        <li>
                            <a title="Kirim Ulang" href="<?php echo site_url('pelamar/aktivasi') ?>"><span class="mini-click-non">Aktivasi Akun</span></a>
                        </li>
                         <?php } elseif ($statusku == "Calon Karyawan") { ?>
                        <li>
                            <a title="Nilai" href="<?php echo site_url('pelamar/nilai') ?>"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Hasil Nilai Tes</span></a>
                        </li>
                        <?php } elseif ($statusku == "Pelamar Ditolak") { ?>
                       <li><a title="Data Diri" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>"><span class="mini-cli">Proses Lamaran</span></a></li>
                        <?php } ?>                        
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Header menu area -->
    <!-- Start Welcome area -->
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
                                    <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
            
                                                <li class="nav-item">
                                                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                            <img src="img/product/pro4.jpg" alt="" />
                                                            <span class="admin-name"><?php echo $namaku?></span>
                                                            <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                        </a>
                                                    <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                        <li><a title="Ubah Sandi" href="<?php echo site_url('login/ubahpass') ?>"></span>Ubah Sandi</a>
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
                                        <li class="active">
                                            <a title="Home" href="<?php echo site_url('pelamar/home') ?>"><span class="educate-icon educate-home icon-wrap"></span><span class="mini-click-non">Home</span></a>
                                        </li>
                        
                                        <?php if ($statusku == "Pelamar" && $aktifku == '1') { ?>
                                        <li>
                                            <a class="has-arrow" href="mailbox.html" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Data Saya</span></a>
                                            <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                                                <li><a title="Data Diri" href="<?php echo site_url('pelamar/datasaya') ?>"><span class="mini-cli">Data Diri</span></a></li>
                                                <li><a title="Data Pendidikan" href="<?php echo site_url('pelamar/datapend') ?>"><span class="mini-sub-pro">Data Pendidikan</span></a></li>
                                                <li><a title="Data Surat" href="<?php echo site_url('pelamar/datasurat') ?>"><span class="mini-sub-pro">Data Surat</span></a></li>
                                            </ul>
                                        </li>
                                        <?php } elseif ($statusku == "Pelamar" && $aktifku == '0') {?>
                                        <li>
                                            <a title="Kirim Ulang" href="<?php echo site_url('pelamar/aktivasi') ?>"><span class="mini-click-non">Aktivasi Akun</span></a>
                                        </li>
                                        <?php } ?>  
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->