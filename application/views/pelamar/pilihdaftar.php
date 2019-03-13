
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
<br><br>
<h3 align="center">PILIHAN PROFESI :</h3>
<?php
    $noww =date('d/m/y'); $a=0;
?>
<div class="widget-program-box mg-tb-30">
    <div class="container">
        <?php foreach ($array as $key){$a++?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" style="padding-bottom: 20px">
                <div class="hpanel widget-int-shape responsive-mg-b-30">
                    <div class="panel-body">
                        <div class="text-center content-box">
                            <h2 class="m-b-xs"><?php echo $key->nama_profesi ?></h2>
                            <div class="m icon-box">
                                <p><strong>
                                    <?php 
                                    $data=mysqli_fetch_array(mysqli_query(mysqli_connect("localhost","root","","kepegawaian"), "select count(nama) as total from karyawan as k inner join login as l on k.id_karyawan=l.id_karyawan where id_profesi = '$key->id_profesi' and (id_status ='Pelamar' || id_status= 'Calon Karyawan') and aktif = 1"));
                                    echo $key->kuota - $data['total']; ?>
                                     Orang</strong></p>
                                <br>
                                <p><?php echo $key->mulai." Sampai ".$key->akhir;?></p>
                                <strong>Ketentuan :</strong>
                                <p>IPK Minimal <strong><?php echo $key->ipkmin ?></strong><br>
                                <strong><?php echo $key->jenkel ?></strong> Degan usia MAX <strong><?php echo $key->usia." Tahun." ?></strong><br>
                                Jurusan <?php echo $key->jurusan ?><br></p>
                            </div>
                            <div class="product-buttons">
                                <a href="<?php echo site_url(); echo "/login/viewDaftar/"; echo $key->id_profesi ;?>"><button type="button" class="button-default cart-btn">Daftar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="container-fluid" align="center">
    <div class="p-t-115">
        <a class="txt2" href="<?=base_url()?>index.php/login/">Kembali ke Halaman Login</a>
    </div>  
</div>
<br><br>
    </script>
    <!-- jquery
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/bootstrap.min.js"></script>
    <!-- wow JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/wow.min.js"></script>
    <!-- price-slider JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/owl.carousel.min.js"></script>
    <!-- sticky JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/jquery.sticky.js"></script>
    <!-- scrollUp JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/sparkline/sparkline-active.js"></script>
    <!-- calendar JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/calendar/moment.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/calendar/fullcalendar.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/calendar/fullcalendar-active.js"></script>
    <!-- data table JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/data-table/bootstrap-table.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/data-table/tableExport.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/data-table/data-table-active.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/data-table/bootstrap-table-editable.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/data-table/bootstrap-editable.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/data-table/colResizable-1.5.source.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/editable/jquery.mockjax.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/editable/mock-active.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/editable/select2.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/editable/moment.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/editable/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/editable/bootstrap-editable.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/editable/xediable-active.js"></script>
    <!-- touchspin JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/touchspin/touchspin-active.js"></script>
    <!-- datapicker JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/datapicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/datapicker/datepicker-active.js"></script>
    <!-- input-mask JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/input-mask/jasny-bootstrap.min.js"></script>
    <!-- chosen JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/chosen/chosen.jquery.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/chosen/chosen-active.js"></script>
    <!-- select2 JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/select2/select2-active.js"></script>
    <!-- rangle-slider JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/rangle-slider/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/rangle-slider/jquery-ui-touch-punch.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/rangle-slider/rangle-active.js"></script>
    <!-- knob JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/knob/jquery.knob.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/knob/knob-active.js"></script>
    <!-- Chart JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/chart/jquery.peity.min.js"></script>
    <script src="<?php echo base_url()?>Assets/template/js/peity/peity-active.js"></script>
    <!-- tab JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/tab.js"></script>
    <!-- plugins JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/plugins.js"></script>
    <!-- main JS
        ============================================ -->
    <script src="<?php echo base_url()?>Assets/template/js/main.js"></script>
   

    

</body>

</html>
<!-- end document-->