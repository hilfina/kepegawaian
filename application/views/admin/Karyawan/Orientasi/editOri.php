<?php $this->load->view("header.php"); ?><br>
<div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="#">Data Orientasi</a> <span class="bread-slash">/</span> </li>
                <li><span class="bread-blod">Edit Dokumen</span> </li>
              </ul>
            </div>
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
          <div class="sparkline12-hd">  <br>
            <div class="main-sparkline12-hd">
              <span><h4 align="center">EDIT DATA ORIENTASI KARYAWAN</h4></span>
            </div>
          </div><br>
          <div class="container-fluid" role="alert">
              <?php if ($this->session->flashdata('msg_error')) :?>
                <div class="alert alert-danger alert-mg-b"> 
                <?php echo $this->session->flashdata('msg_error')?>
                </div>
              <?php endif; ?>
          </div>

          <?php foreach ($array as $key) { ?>
            <form action="<?php echo site_url(); ?>/adminOri/edit/<?php echo $key->id_orientasi?>" enctype="multipart/form-data" method="post">
              <div class="sparkline12-graph">
                <div class="input-knob-dial-wrap">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>NIK</label>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                      <input name="nik" type="text" class="form-control" value="<?php echo $key->nik ?>" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>Nama Karyawan</label>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                      <input name="nama" type="text" class="form-control" value="<?php echo $key->nama ?>" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="date-picker-inner">
                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="input-mask-title">
                          <label>Tanggal Orientasi</label>
                        </div>
                      </div>
                      <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                        <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                          <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="form-control" name="tgl_mulai" value="<?php echo $key->tgl_mulai; ?>" />
                            <span class="input-group-addon">hingga</span>
                            <input type="text" class="form-control" name="tgl_akhir" value="<?php echo$key->tgl_akhir; ?>" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>Upload Dokumen Kehadiran</label>
                      </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                      <div class="input-mark-inner">
                        <div class="file-upload-inner ts-forms">
                          <font size="2" color="red"> *Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2 MB </font>
                          <div class="input prepend-big-btn">
                            <label class="icon-right" for="prepend-big-btn">
                              <i class="fa fa-download"></i>
                            </label>
                            <div class="file-button"> Browse
                              <input type="hidden" name="file_old" value="<?php echo $key->doku_hadir; ?>">
                              <input type="file" name="doku_hadir" value="<?php echo $key->doku_hadir; ?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                            </div>
                            <input type="text" id="prepend-big-btn" placeholder="no file selected" value="<?php echo $key->doku_hadir; ?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br><br>
                  <div class="row"align="center">
                    <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Simpan</button>
                  <div>
                </div>
              </div>
            </form>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view("footer.php"); ?>
