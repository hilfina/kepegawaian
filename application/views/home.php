<?php 
$this->load->view("header.php");
$idku=$this->session->userdata("myId");
?><br>
<div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center"><br>
              <h3 align="center"><b>Sistem Kepegawaian RSI Aisyiyah</b></h3>
              <hr style="width: 70%">
            </div>            
          </div><br>  
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="contacts-area mg-b-15">
                <div class="container-fluid">    
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-top-left-radius:10px; border-top-right-radius: 10px;">                        
                        <div class="student-dtl">                          
                          <h2>Karyawan</h2><hr>
                          <br>
                          <?php if ($karyawan->banyak == 0) {
                            echo "Tidak ada karyawan.";
                          }else{
                            echo $karyawan->banyak." Orang"; ?>
                            <div align="center"><br>
                              <a href="<?php echo site_url('adminKaryawan/') ?>"><button class="btn btn-primary waves-effect waves-light mg-b-15">Lihat Data</button></a>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-top-left-radius:10px; border-top-right-radius: 10px;">                        
                        <div class="student-dtl">                          
                          <h2>Pelamar</h2><hr>
                          <br>
                          <?php if ($pelamar->banyak == 0) {
                            echo "Tidak ada pelamar.";
                          }else{
                            echo $pelamar->banyak." Orang"; ?>
                            <div align="center"><br>
                              <a href="<?php echo site_url('adminPelamar/') ?>"><button class="btn btn-primary waves-effect waves-light mg-b-15">Lihat Data</button></a>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-top-left-radius:10px; border-top-right-radius: 10px;">                        
                        <div class="student-dtl">                          
                          <h2>Calon Karyawan</h2><hr>
                          <br>                          
                          <?php if ($calon->banyak == 0) {
                            echo "Tidak ada calon karyawan.";
                          }else{
                            echo $calon->banyak." Orang"; ?>
                            <div align="center"><br>
                              <a href="<?php echo site_url('adminPelamar/') ?>"><button class="btn btn-primary waves-effect waves-light mg-b-15">Lihat Data</button></a>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="contacts-area mg-b-15">
                <div class="container-fluid">    
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-top-left-radius:10px; border-top-right-radius: 10px;">                        
                        <div class="student-dtl">                          
                          <h2>File Kadaluarsa</h2><hr>
                          <br>                         
                          <?php if ($sipstr->banyak+$mou_h->banyak+$mou_s->banyak+$mou_k->banyak+$kreden->banyak+$mou_kl->banyak == 0) {
                            echo "Tidak ada calon karyawan.";
                          }else{
                            echo $sipstr->banyak+$mou_h->banyak+$mou_s->banyak+$mou_k->banyak+$kreden->banyak+$mou_kl->banyak." File"; ?>
                            <div align="center"><br>
                              <a href="<?php echo site_url('adminPelamar/') ?>"><button class="btn btn-primary waves-effect waves-light mg-b-15">Lihat Data</button></a>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-top-left-radius:10px; border-top-right-radius: 10px;">                        
                        <div class="student-dtl">                          
                          <h2>Jadwal Seleksi</h2><hr>
                          <br>                         
                          <?php if ($seleksi->banyak == 0) {
                            echo "Tidak ada seleksi.";
                          }else{
                            echo $seleksi->banyak." Orang"; ?>
                            <div align="center"><br>
                              <a href="<?php echo site_url('admin/dataSeleksi') ?>"><button class="btn btn-primary waves-effect waves-light mg-b-15">Lihat Data</button></a>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-top-left-radius:10px; border-top-right-radius: 10px;">                        
                        <div class="student-dtl">                          
                          <h2>Lowongan Tersedia</h2><hr>
                          <br>                         
                          <?php if ($loker->banyak == 0) {
                            echo "Tidak ada lowongan.";
                          }else{
                            echo $loker->banyak." Lowongan"; ?>
                            <div align="center"><br>
                              <a href="<?php echo site_url('adminLoker/') ?>"><button class="btn btn-primary waves-effect waves-light mg-b-15">Lihat Data</button></a>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view("footer.php"); ?>