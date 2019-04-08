<?php 
  $levelku=$this->session->userdata("myLevel");
  $idku=$this->session->userdata("myId");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
  $aktifku=$this->session->userdata("myAktif");
  $statusku=$this->session->userdata("myStatus");
  $profesiku=$this->session->userdata("myProfesi");
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
   
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
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
                        
                        <?php if ($levelku == "admin") {?>
                         <li>
                            <a title="Home" href="#"><span class="educate-icon educate-home icon-wrap"></span><span class="mini-click-non">Home</span></a>
                        </li>
                        <li>
                            <a title="Lowongan" href="<?php echo site_url('adminLoker') ?>"><span class="educate-icon educate-course icon-wrap"></span><span class="mini-click-non">Data Lowongan</span></a>
                        </li>
                        <li>
                            <a title="Profesi" href="<?php echo site_url('adminProfesi') ?>"><span class="educate-icon educate-course icon-wrap"></span><span class="mini-click-non">Data Profesi</span></a>
                        </li>
                        
                        <li>
                            <a title="Karyawan" href="<?php echo site_url('adminKaryawan/') ?>"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Data Karyawan</span></a>
                        </li>
                        <li>
                            <a title="Pendidikan" href="<?php echo site_url('admin/datapend') ?>"><span class="educate-icon educate-message icon-wrap"></span><span class="mini-click-non">Data Pendidikan</span></a>
                        </li>
                        <li>
                            <a title="Surat" href="<?php echo site_url('admin/datasurat') ?>"><span class="educate-icon educate-message icon-wrap"></span><span class="mini-click-non">Data Surat</span></a>
                        </li>
                        <li><a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Data Riwayat</span></a>
                            <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('adminRiwayat/') ?>"><span class="mini-sub-pro">Penempatan</span></a></li>
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('adminStatus') ?>"><span class="mini-sub-pro">Status</span></a></li>
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('adminGol') ?>"><span class="mini-sub-pro">Golongan</span></a></li>
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('adminBerkala') ?>"><span class="mini-sub-pro">Berkala</span></a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Data MOU</span></a>
                            <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('adminHutang/') ?>"><span class="mini-sub-pro">Hutang</span></a></li>
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('adminKontrak') ?>"><span class="mini-sub-pro">Kontrak</span></a></li>
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('adminSekolah') ?>"><span class="mini-sub-pro">Sekolah</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="has-arrow" href="#" aria-expanded="false"><span class="educate-icon educate-message icon-wrap"></span> <span class="mini-click-non">Data Pelamar</span></a>
                            <ul class="submenu-angle interface-mini-nb-dp" aria-expanded="false">
                                <li><a title="Semua Pelamar" href="<?php echo site_url('admin/pelamar') ?>"><span class="mini-cli">Pelamar</span></a></li>
                                <li><a title="Sedang Seleksi" href="<?php echo site_url('admin/dataSeleksi') ?>"><span class="mini-sub-pro">Seleksi Pelamar</span></a></li>
                                <li><a title="Report" href="<?php echo site_url('admin/report') ?>"><span class="mini-sub-pro">Data Report</span></a></li>
                            </ul>
                        </li>
                        <?php } elseif ($statusku == "Pelamar" && $aktifku == '1') { ?>
                        <li>
                            <?php 
                            if ($profesiku == "Belum") {?>
                                <li>
                                    <a title="Home" href="<?php echo site_url('pelamar/home') ?>"><span class="educate-icon educate-home icon-wrap"></span><span class="mini-click-non">Home</span></a>
                                </li>
                            <?php } else {?>
                                <li>
                                    <a title="Home" href="#"><span class="educate-icon educate-home icon-wrap"></span><span class="mini-click-non">Home</span></a>
                                </li>
                            <?php } ?>
                                <li><a title="Data Diri" href="<?php echo site_url('pelamar/datasaya') ?>"><span class="educate-icon educate-professor icon-wrap"></span><span class="mini-click-non">Profil Saya</span></a></li>
                                <li><a title="Data Pendidikan" href="<?php echo site_url('pelamar/datapend') ?>"><span class="educate-icon educate-library icon-wrap"></span><span class="mini-click-non">Data Pendidikan</span></a></li>
                                <?php if($profesiku != "Kasir" || $profesiku != "Administrasi" || $profesiku != "Pekarya"){?>
                                <li><a title="Data Surat" href="<?php echo site_url('pelamar/datasurat') ?>"><span class="educate-icon educate-message icon-wrap"></span><span class="mini-click-non">Data Surat</span></a></li>
                                <?php } ?>
                            <?php 
                            if ($profesiku != "Belum") {?>
                                <li><a title="Data Diri" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>"><span class="mini-click-non">Proses Lamaran</span></a></li>
                            <?php } ?>
                        </li>
                        
                    <?php } elseif ($statusku == "Pelamar" && $aktifku == '0') {?>
                        <li>
                            <a title="Kirim Ulang" href="<?php echo site_url('pelamar/aktivasi') ?>"><span class="mini-click-non">Aktivasi Akun</span></a>
                        </li>
                        <?php } elseif ($statusku == "Calon Karyawan") { ?>
                        <li>
                            <a title="Nilai" href="<?php echo site_url('pelamar/nilai') ?>"><span class="educate-icon educate-data-table icon-wrap"></span> <span class="mini-click-non">Hasil Nilai Tes</span></a>
                            <li><a title="Data Diri" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>"><span class="mini-cli">Proses Lamaran</span></a></li>
                        </li>
                        <?php } elseif ($statusku == "Pelamar Ditolak") { ?>
                       <li><a title="Data Diri" href="<?php echo site_url('pelamar/prosesLamar/')?><?php echo $idku ?>"><span class="mini-cli">Proses Lamaran</span></a></li>
                        <?php } elseif ($levelku == "Karyawan")  { ?>
                        <li>
                            <a title="Home" href="#"><span class="educate-icon educate-home icon-wrap"></span><span class="mini-click-non">Home</span></a>
                            <a title="Data Karyawan" href="<?php echo site_url('karyawan/datasaya') ?>"><span class="educate-icon educate-professor icon-wrap"></span> <span class="mini-click-non">Profil Saya</span></a>
                            <a title="Data Pendidikan" href="<?php echo site_url('karyawan/datapend') ?>"><span class="educate-icon educate-library icon-wrap"></span><span class="mini-click-non">Data Pendidikan</span></a>
                            <a title="Data Orientasi" href="<?php echo site_url('karyawan/dataori') ?>"><span class="educate-icon educate-course icon-wrap"></span><span class="mini-click-non">Data Orientasi</span></a>
                            <a title="Data Diklat" href="<?php echo site_url('karyawan/datadiklat') ?>"><span class="educate-icon educate-department icon-wrap"></span><span class="mini-click-non">Data Diklat</span></a>
                            
                                <a title="Data Kewenangan Klinis" href="<?php echo site_url('karyawan/datakew') ?>"><span class="educate-icon educate-course icon-wrap"></span><span class="mini-click-non">Kewenangan Klinis</span></a>
                            
                            <?php if($profesiku != "Kasir" || $profesiku != "Administrasi" || $profesiku != "Pekarya"){?>
                                <a title="Data Surat" href="<?php echo site_url('karyawan/datasurat') ?>"><span class="educate-icon educate-message icon-wrap"></span><span class="mini-click-non">Data Surat</span></a>
                            <?php }?>
                        </li>
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
                                        <li><a data-toggle="collapse" data-target="#Charts" href="#">Home <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul class="collapse dropdown-header-top">
                                                <li><a href="index.html">Dashboard v.1</a></li>
                                                <li><a href="index-1.html">Dashboard v.2</a></li>
                                                <li><a href="index-3.html">Dashboard v.3</a></li>
                                                <li><a href="analytics.html">Analytics</a></li>
                                                <li><a href="widgets.html">Widgets</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="events.html">Event</a></li>
                                        <li><a data-toggle="collapse" data-target="#demoevent" href="#">Professors <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demoevent" class="collapse dropdown-header-top">
                                                <li><a href="all-professors.html">All Professors</a>
                                                </li>
                                                <li><a href="add-professor.html">Add Professor</a>
                                                </li>
                                                <li><a href="edit-professor.html">Edit Professor</a>
                                                </li>
                                                <li><a href="professor-profile.html">Professor Profile</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demopro" href="#">Students <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demopro" class="collapse dropdown-header-top">
                                                <li><a href="all-students.html">All Students</a>
                                                </li>
                                                <li><a href="add-student.html">Add Student</a>
                                                </li>
                                                <li><a href="edit-student.html">Edit Student</a>
                                                </li>
                                                <li><a href="student-profile.html">Student Profile</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#democrou" href="#">Courses <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="democrou" class="collapse dropdown-header-top">
                                                <li><a href="all-courses.html">All Courses</a>
                                                </li>
                                                <li><a href="add-course.html">Add Course</a>
                                                </li>
                                                <li><a href="edit-course.html">Edit Course</a>
                                                </li>
                                                <li><a href="course-profile.html">Courses Info</a>
                                                </li>
                                                <li><a href="course-payment.html">Courses Payment</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demolibra" href="#">Library <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demolibra" class="collapse dropdown-header-top">
                                                <li><a href="library-assets.html">Library Assets</a>
                                                </li>
                                                <li><a href="add-library-assets.html">Add Library Asset</a>
                                                </li>
                                                <li><a href="edit-library-assets.html">Edit Library Asset</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demodepart" href="#">Departments <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demodepart" class="collapse dropdown-header-top">
                                                <li><a href="departments.html">Departments List</a>
                                                </li>
                                                <li><a href="add-department.html">Add Departments</a>
                                                </li>
                                                <li><a href="edit-department.html">Edit Departments</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#demo" href="#">Mailbox <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="demo" class="collapse dropdown-header-top">
                                                <li><a href="mailbox.html">Inbox</a>
                                                </li>
                                                <li><a href="mailbox-view.html">View Mail</a>
                                                </li>
                                                <li><a href="mailbox-compose.html">Compose Mail</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Miscellaneousmob" href="#">Interface <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Miscellaneousmob" class="collapse dropdown-header-top">
                                                <li><a href="google-map.html">Google Map</a>
                                                </li>
                                                <li><a href="data-maps.html">Data Maps</a>
                                                </li>
                                                <li><a href="pdf-viewer.html">Pdf Viewer</a>
                                                </li>
                                                <li><a href="x-editable.html">X-Editable</a>
                                                </li>
                                                <li><a href="code-editor.html">Code Editor</a>
                                                </li>
                                                <li><a href="tree-view.html">Tree View</a>
                                                </li>
                                                <li><a href="preloader.html">Preloader</a>
                                                </li>
                                                <li><a href="images-cropper.html">Images Cropper</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Chartsmob" href="#">Charts <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Chartsmob" class="collapse dropdown-header-top">
                                                <li><a href="bar-charts.html">Bar Charts</a>
                                                </li>
                                                <li><a href="line-charts.html">Line Charts</a>
                                                </li>
                                                <li><a href="area-charts.html">Area Charts</a>
                                                </li>
                                                <li><a href="rounded-chart.html">Rounded Charts</a>
                                                </li>
                                                <li><a href="c3.html">C3 Charts</a>
                                                </li>
                                                <li><a href="sparkline.html">Sparkline Charts</a>
                                                </li>
                                                <li><a href="peity.html">Peity Charts</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Tablesmob" href="#">Tables <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Tablesmob" class="collapse dropdown-header-top">
                                                <li><a href="static-table.html">Static Table</a>
                                                </li>
                                                <li><a href="data-table.html">Data Table</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#formsmob" href="#">Forms <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="formsmob" class="collapse dropdown-header-top">
                                                <li><a href="basic-form-element.html">Basic Form Elements</a>
                                                </li>
                                                <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                                </li>
                                                <li><a href="password-meter.html">Password Meter</a>
                                                </li>
                                                <li><a href="multi-upload.html">Multi Upload</a>
                                                </li>
                                                <li><a href="tinymc.html">Text Editor</a>
                                                </li>
                                                <li><a href="dual-list-box.html">Dual List Box</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Appviewsmob" href="#">App views <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Appviewsmob" class="collapse dropdown-header-top">
                                                <li><a href="basic-form-element.html">Basic Form Elements</a>
                                                </li>
                                                <li><a href="advance-form-element.html">Advanced Form Elements</a>
                                                </li>
                                                <li><a href="password-meter.html">Password Meter</a>
                                                </li>
                                                <li><a href="multi-upload.html">Multi Upload</a>
                                                </li>
                                                <li><a href="tinymc.html">Text Editor</a>
                                                </li>
                                                <li><a href="dual-list-box.html">Dual List Box</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a data-toggle="collapse" data-target="#Pagemob" href="#">Pages <span class="admin-project-icon edu-icon edu-down-arrow"></span></a>
                                            <ul id="Pagemob" class="collapse dropdown-header-top">
                                                <li><a href="login.html">Login</a>
                                                </li>
                                                <li><a href="register.html">Register</a>
                                                </li>
                                                <li><a href="lock.html">Lock</a>
                                                </li>
                                                <li><a href="password-recovery.html">Password Recovery</a>
                                                </li>
                                                <li><a href="404.html">404 Page</a></li>
                                                <li><a href="500.html">500 Page</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu end -->