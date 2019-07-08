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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
              <h3 align="center"><b>PELUANG KARIR</b></h3>
              <hr style="border: solid 2px; width: 250px; background-color: black">
              <hr style="border: solid 1px; width: 200px; background-color: black">
            </div>            
          </div><br>  
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="contacts-area mg-b-15">
                <div class="container-fluid">    
                  <div class="row">
                    <?php foreach ($loker as $key) {
                      $maque = $this->db->query("SELECT count(id_karyawan) as slsh from karyawan where id_profesi = '$key->id_profesi' AND id_status = 'Pelamar'");//cari banyak orang yang milih
                      $selisih = $maque->row(); 
                      if ($key->kuota-$selisih->slsh != 0) {//jika kuota masih ada ?>
                      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-top-left-radius:10px; border-top-right-radius: 10px;">                        
                          <div class="student-dtl">                          
                            <h2><?php echo $key->nama_profesi;?></h2>
                          </div>
                        </div>
                        <div class="student-inner-std res-mg-b-30"  style="background-color: #e6f2ff">                        
                          <div class="student-dtl">                          
                            <font size="2">
                              <strong>Mulai :</strong> <?php echo date('d - M - Y', strtotime($key->mulai));?><br>
                              <strong>Sampai :</strong> <?php echo date('d - M - Y', strtotime($key->akhir));?><br>
                              <strong>Jurusan :</strong> <?php echo $key->jurusan;?><br>
                              <strong>IPK Min :</strong> <?php echo $key->ipkmin;?><br>
                              <?php echo $key->jenkel;?> <br><strong> dengan usia maks </strong> <?php echo $key->usia;?> tahun<br><br><br>
                            </font>
                            <font color="red" size="2">
                              <?php if ( date('y-m-d') <= date('y-m-d', strtotime($key->akhir))) { ?>
                                <a href="<?php echo site_url(); echo "/pelamar/lamar/"; echo $idku ; echo "/"; echo $key->id_profesi; ?>"> <button class='btn-link'>Lamar Sekarang</button></a>
                              <?php }else{ echo "<br> Sudah Ditutup"; } ?>
                            </font>
                          </div>
                        </div>
                        <div class="student-inner-std res-mg-b-30"  style="background-color: #cce5ff; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">                        
                          <div class="student-dtl"> 
                          </div>
                        </div>
                      </div>     
                    <?php }else{}} ?>
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