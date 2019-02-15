<?php 
    $this->load->view('header');
    $mylevel=$this->session->userdata("user_level");
    $mynama=$this->session->userdata("user_nama");
?>
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Beranda</h2>
                    <?php
                      $tdy= date("Y-m-d");
                    ?>
                    <ul class="nav navbar-right panel_toolbox">
                     <h2><i class="fa fa-calendar"></i>&nbsp&nbspToday, <?php echo date('F d - Y'); ?></h2>
                    </ul>
                    <div class="clearfix"></div>
                  <div class="x_content">
                    <br />
                  <center><img src="<?=base_url()?>images/aa.jpg"></center>
				          <?php if($mylevel=="ADMIN" || $mylevel=="ADMIN ULP"){ ?>
                      <center><h4><strong>Janji Bayar Hari ini.</strong></h4></center>
                      <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID Pelanggan</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>Tanggal</th>
                          <th>Uraian</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $hasil = mysqli_query( mysqli_connect("localhost","root","","monitoring"), "select * from masalah as m inner join pelanggan as p on m.idpel = p.idpel where m.tanggal_janji =' $tdy'");
                        while ($data=mysqli_fetch_array($hasil)) {
                            echo "<tr>";
                            echo "<td>" ; echo $data["idpel"]; echo "</td>";
                            echo "<td>" ; echo $data["namapel"]; echo "</td>";
                            echo "<td>" ; echo $data["alamat"]; echo "</td>";
                            echo "<td>" ; echo $data["tanggal"]; echo "</td>";
                            echo "<td>" ; echo $data["permasalahan"]; echo "</td>";
                            echo "<td>" ; echo $data["status"]; echo "</td>";
                            echo "</tr>";
                         } 
                        ?>

                      </tbody>
                      </table>


                  <?php }elseif($mylevel=="PENGAWAS"){ ?>
                  <center><h1>TEMAN KERJA</h1></center>
                      <h1><marquee>Selamat datang, Pengawas <?php echo "$mynama"; ?>!</marquee></h1>
                  <?php }elseif($mylevel=="VENDOR"){ ?>
                  <center><h1>TEMAN KERJA</h1></center>
                      <h1><marquee>Selamat datang, Vendor <?php echo "$mynama"; ?>!</marquee></h1>
                  <?php }elseif($mylevel=="PIMPINAN"){ ?>
                  <center><h1>TEMAN KERJA</h1></center>
                      <h1><marquee>Selamat datang, Pimpinan <?php echo "$mynama"; ?>!</marquee></h1>
                  <?php }else{?>
                  <center><h1>TEMAN KERJA</h1></center>
                      <h1><marquee>Selamat datang, Admin <?php echo "$mynama"; ?>!</marquee></h1>
                  <?php }?>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                  
<?php $this->load->view('footer');?>