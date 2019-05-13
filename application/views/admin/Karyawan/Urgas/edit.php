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
                <li><a href="#">Data Uraian Tugas</a> <span class="bread-slash">/</span> </li>
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
              <span><h4 align="center">EDIT DATA URAIAN TUGAS KARYAWAN</h4></span>
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
            <form action="<?php echo site_url(); ?>/adminUrgas/edit/<?php echo $key->id_uraian?>" enctype="multipart/form-data" method="post">
              <div class="sparkline12-graph">
                <div class="input-knob-dial-wrap">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>NIK</label>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                      <input name="nik" type="text" class="form-control" value="<?php echo $key->nik ?>" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                      <div class="input-mask-title">
                        <label>Upload Dokumen Uraian Tugas</label>
                      </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                      <div class="input-mark-inner">
                        <div class="file-upload-inner ts-forms">
                          <div class="input prepend-big-btn">
                            <label class="icon-right" for="prepend-big-btn">
                              <i class="fa fa-download"></i>
                            </label>
                            <div class="file-button"> Browse
                              <input type="hidden" name="file_old" value="<?php echo $key->file_urgas; ?>">
                              <input type="file" name="file_urgas" value="<?php echo $key->file_urgas; ?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                            </div>
                            <input type="text" id="prepend-big-btn" placeholder="no file selected" value="<?php echo $key->file_urgas; ?>">
                            <font size="2" color="red"> *Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2 MB </font>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br><br>
                  <div class="row"align="center">
                    <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Simpan</button>
                  </div>
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
