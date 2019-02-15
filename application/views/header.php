<?php 
  $mylevel=$this->session->userdata("user_level");
  $myid=$this->session->userdata("user_id");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Sistem Informasi Kepegawaian</title>
    <link href="<?=base_url()?>Assets/login/images/logo.png" rel="icon">
    <!-- <link href="<?=base_url()?>assets/images/listrik.jpg" rel="apple-touch-icon">
 -->
    <!-- Bootstrap -->

    <link href="<?=base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url()?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?=base_url()?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?=base_url()?>assets/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?=base_url()?>assets/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?=base_url()?>assets/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?=base_url()?>assets/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?=base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?=base_url()?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url()?>assets/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="" class="site_title"><i class="fa fa-building-o"></i> <span>  RSI Aisyiyah</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <!-- <img src=<?php echo base_url("assets/upload")."/"."$foto" ?> alt="...." class="img-circle profile_img"> -->
              </div>
              <div class="profile_info">
                <?php
                  $hasil = mysqli_query( mysqli_connect("localhost","root","","kepegawaian"), "select * from karyawan WHERE id_karyawan = '$myid'");
                  $data=mysqli_fetch_array($hasil);
                ?>
                <span>Selamat Datang, <strong><font color="#fff"><?php echo $data["nama"]; ?></font></strong></span>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br>

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menu</h3>
                <ul class="nav side-menu">    
                              
                  <?php if ($mylevel == "ADMIN") {?>
                  <li><a href="<?php echo site_url('monitoring') ?>"><i class="fa fa-edit"></i> Beranda </a></li>
                    <li><a><i class="fa fa-book"></i>Data Master <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo site_url('admin/datapengguna') ?>"><i class="fa fa-user"></i>Data Pengguna</a></li>
                        <li><a href="<?php echo site_url('admin/datapelanggan') ?>"><i class="fa fa-users"></i>Data Pelanggan</a></li>
                         <li><a href="<?php echo site_url('admin/datamasalah') ?>"><i class="fa fa-file"></i>Data Permasalahan Pelanggan</a></li>
                      </ul>
                    </li>
                    <li><a href="<?php echo site_url('admin/datapekerjaan') ?>"><i class="fa fa-edit"></i> Pekerjaan</a></li>
                    <li><a><i class="fa fa-print"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <li><a href="<?php echo site_url('admin/laporan') ?>"><i class="fa fa-file-pdf-o"></i>Get PDF</a></li>
                      <li><a href="<?php echo site_url('admin/laporanex') ?>"><i class="fa fa-file-excel-o"></i>Get Excel</a></li>

                    </ul>
                  </li>
                  <?php }elseif ($mylevel == "VENDOR") { ?>
                  <li><a href="<?php echo site_url('monitoring') ?>"><i class="fa fa-edit"></i> Beranda </a></li>
                    <li><a href="<?php echo site_url('vendor/dataprogress') ?>"><i class="fa fa-edit"></i> Data Progress</a></li>
                    <li><a><i class="fa fa-print"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('vendor/laporan') ?>"><i class="fa fa-file-pdf-o"></i>Get PDF</a></li>
                      <li><a href="<?php echo site_url('vendor/laporanex') ?>"><i class="fa fa-file-excel-o"></i>Get Excel</a></li>
                    </ul>
                  </li>
                  <?php }elseif ($mylevel == "PIMPINAN" || $mylevel =="ASISTEN PIMPINAN") {?>
                  <li><a href="<?php echo site_url('monitoring') ?>"><i class="fa fa-edit"></i> Beranda </a></li>
                    <li><a href="<?php echo site_url('pimpinanasisten/datapekerjaan') ?>"><i class="fa fa-file"></i> Data Kegiatan Pekerjaan</a></li>
                    <li><a href="<?php echo site_url('admin/datamasalah') ?>"><i class="fa fa-file"></i>Data Permasalahan Pelanggan</a></li>
                  <?php }elseif ($mylevel == "PENGAWAS") { ?>
                  <li><a href="<?php echo site_url('monitoring') ?>"><i class="fa fa-edit"></i> Beranda </a></li>
                  <li><a href="<?php echo site_url('pengawas/dataprogress') ?>"><i class="fa fa-edit"></i> Data Progress</a></li>
                  <li><a href="<?php echo site_url('admin/datamasalah') ?>"><i class="fa fa-file"></i>Data Permasalahan Pelanggan</a></li>
                  <?php }elseif ($mylevel == "ADMIN ULP") { ?>
                  <li><a href="<?php echo site_url('ulp') ?>"><i class="fa fa-search"></i> Pencarian </a></li>    
                  <li><a href="<?php echo site_url('adminulp/datapelanggan') ?>"><i class="fa fa-users"></i>Data Pelanggan</a></li>
                  <li><a href="<?php echo site_url('adminulp/datamasalah') ?>"><i class="fa fa-file"></i>Data Permasalahan Pelanggan</a></li>
                  <?php } ?>
                  
                </ul>
              </div>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   <!--  <?php echo $nama ?> -->
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo site_url('admin/myProfile/') ?>"><i class="fa fa-profile"></i> My Profile</a></li>
                    <li><a href="<?php echo site_url('home/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->