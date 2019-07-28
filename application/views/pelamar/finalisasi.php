<?php 
$this->load->view("header.php");
$idku=$this->session->userdata('myId');
?>
<br>
  <div class="breadcome-area">
      <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list single-page-breadcome">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
     <div class="product-status mg-b-15">
            <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list mt-b-30">
                    <div class="sparkline12-hd">
                    <br>
                        <div class="main-sparkline12-hd">
                            <span><h4 align="center">PILIH LOWONGAN</h4></span>
                        </div>
                    </div>
                    <br>
                    <?php 
                        $tb_krywn = $this->db->query("SELECT * from karyawan where id_karyawan = $idku");
                        $krywn = $tb_krywn->row();
                        $tb_lowong = $this->db->query("SELECT * from lowongan where id_karyawan = $idku");
                        $lowong = $tb_lowong->row();
                        $tb_pend = $this->db->query("SELECT * from pendidikan where id_karyawan = $idku");
                    ?>
                    <?php if ($krywn->ttl != "0000-00-00" && $krywn->jenkel != "" && $krywn->alamat != "" && $krywn->status != "" && $krywn->foto != "profile.png" && $lowong->nilai_akhir != "-" && $lowong->pend_akhir != "-"  && $lowong->cv != "" && $lowong->finalisasi == 0 && $tb_pend->result() != null) {?>
                        <div class="alert alert-info">
                            <h4>Pemberitahuan !</h4>
                            <br>
                                Data lamaran yang anda masukkan akan disesuaikan dengan lowongan yang aktif dan data lamaran tidak dapat diubah kembali. Pastikan data anda telah terisi dan benar.
                        </div>
                        <a href="<?php echo site_url('pelamar/finalisasi2')?>" onclick="return confirm('Apakah anda yakin untuk menuju halaman lowongan?');">
                        <button class="btn btn-primary waves-effect waves-light mg-b-15 btn-block" value="send" >HALAMAN LOWONGAN</button>
                        </a>
                    <?php } else {?>
                        
                        <div class="alert alert-info">
                            <h4>Pemberitahuan !</h4>
                            <br>
                                Data Anda masih belum lengkap, segera penuhi CV, data diri dan mengisi data pendidikan.
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("footer.php"); ?>
    