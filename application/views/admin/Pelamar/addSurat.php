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
          <form action="<?php echo site_url(); ?>/admin/addSurat/<?php echo $id ?>" enctype="multipart/form-data" method="post">
            <input type="hidden" name="id_karyawan" value="<?php echo $id ?>">
            <div class="sparkline12-graph">
              <div class="input-knob-dial-wrap">
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="input-mask-title">
                      <label>Jenis Surat</label>
                    </div>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="input-mark-inner">
                      <select  class="form-control" name="nama_surat">
                        <?php foreach ($surat as $key) { ?>
                          <option><?php echo $key->nama_surat; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="input-mask-title">
                      <label>Nomor Surat</label>
                    </div>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="input-mark-inner">
                      <input type="text" class="form-control" name="no_surat" placeholder="Cth:123">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="date-picker-inner">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <div class="input-mask-title">
                        <label>Tanggal Surat</label>
                      </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
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
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="input-mask-title">
                      <label>Foto Scan Dokumen</label>
                    </div>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
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
                      </div>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    <div class="input-mask-title"></div>
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    <div class="input-mark-inner">
                      <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Save changes</button>
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