<?php 
  $this->load->view('./header');
  $levelku=$this->session->userdata("myLevel");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
?>
<br>
 <div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Home</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Detail Pelamar</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Tambah Data Surat</a> 
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
<div class="data-table-area mg-b-15">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="sparkline13-list">
          <div class="sparkline12-hd"><br>
            <div class="main-sparkline12-hd">
              <span><h4 align="center">DATA RIWAYAT PENDIDIKAN</h4></span>
            </div>
          </div><br>
          <div class="container-fluid" role="alert">
              <?php if ($this->session->flashdata('msg_error')) :?>
                <div class="alert alert-danger alert-mg-b"> 
                <?php echo $this->session->flashdata('msg_error')?>
                </div>
              <?php endif; ?>
          </div>

          <form action="<?php echo site_url(); ?>/admin/addSurat/" enctype="multipart/form-data" method="post">
            <div class="sparkline12-graph">
              <div class="input-knob-dial-wrap">
              <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title">
                      <label>NIK</label>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <select type="text" class="chosen-select" name="nik">
                        <option> -- Pilihan -- </option>
                       <?php
                          $cari = $this->db->query("SELECT * from karyawan as k inner join login as l on k.id_karyawan = l.id_karyawan where id_status != 'Pelamar' and id_status != 'Calon Karyawan' and level != 'admin' and level != 'Super Admin' group by nik ");
                          $nik = $cari->result();
                          foreach ($nik as $nik) { ?>
                            <option> <?php echo $nik->nik; ?> </option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title">
                      <label>Jenis Surat</label>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <select  class="form-control" name="nama_surat">
                      <option>--Pilihan--</option>
                        <?php foreach ($surat as $key) { ?>
                          <option><?php echo $key->nama_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title">
                      <label>Nomor Surat</label>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <input type="text" class="form-control" name="no_surat" placeholder="Cth:123">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="date-picker-inner">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>Tanggal Surat</label>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                      <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control" name="tgl_mulai" />
                            <span class="input-group-addon">hingga</span>
                            <input type="text" class="form-control" name="tgl_akhir" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title">
                      <label>Foto Scan Dokumen</label>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <div class="file-upload-inner ts-forms">
                        <div class="input prepend-big-btn">
                          <label class="icon-right" for="prepend-big-btn">
                            <i class="fa fa-download"></i>
                          </label>
                          <div class="file-button"> Browse
                            <input type="file" name="file" value="" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                          </div>
                          <input type="text" id="prepend-big-btn" placeholder="no file selected">
                        </div>
                        <font size="2" color="red"> *Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2 MB </font>
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title"></div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Simpan File Kepegawaian</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>                           
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('./footer'); ?>