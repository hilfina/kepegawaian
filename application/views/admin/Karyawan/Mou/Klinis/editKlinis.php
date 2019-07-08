<?php  $this->load->view('./header'); ?><br>
 <div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="#">Data Klinis</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Edit Data Klinis</a> 
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
          <br>
          <div class="sparkline13-hd">
              <div class="main-sparkline13-hd" align="center">
                <h1> Edit Data Klinis Karyawan</h1><br>
              </div>
          </div>
        <div class="container-fluid" role="alert">
            <?php if ($this->session->flashdata('msg_error')) :?>
              <div class="alert alert-danger alert-mg-b"> 
              <?php echo $this->session->flashdata('msg_error')?>
              </div>
            <?php endif; ?>
        </div>

        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
        <?php foreach ($array as $key) { ?>
          <form action="<?php echo site_url();?>/adminKlinis/edit/<?php echo $key->id?>" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label>NIK</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nik" type="text" class="form-control" value="<?php echo $key->nik ?>" disabled>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nama Karyawan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nama" type="text" class="form-control" value="<?php echo $key->nama ?>" disabled>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nomor MOU</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="no_mou" type="text" class="form-control" value="<?php echo $key->no_mou ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Mulai</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
              <div class="input-daterange input-group" id="datepicker">
                <input name="tgl_mulai" type="text" class="form-control" value="<?php echo $key->tgl_mulai; ?>">
              </div>
              </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Berakhir</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
              <div class="input-daterange input-group" id="datepicker">
                <input name="tgl_akhir" type="text" class="form-control" value="<?php echo$key->tgl_akhir; ?>">
              </div>
              </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Keterangan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="ket" type="text" class="form-control" value="<?php echo $key->ket ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Upload Dokumen MOU</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <input type="hidden" name="file_old" value="<?php echo $key->file; ?>">
                <font size="2" color="red">Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2MB</font>
                <div class="input-mark-inner">
                  <div class="file-upload-inner ts-forms">
                    <div class="input prepend-big-btn">
                      <label class="icon-right" for="prepend-big-btn">
                        <i class="fa fa-download"></i>
                      </label>
                      <div class="file-button"> Browse
                        <input type="file" name="file" value="<?php echo $key->file; ?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                      </div>
                      <input type="text" id="prepend-big-btn" placeholder="no file selected" value="<?php echo $key->file; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          <tr><td><br></td></tr>
          <tr>
            <td></td>
            <td align="center"><div class="pdf-viewer-area mg-b-15">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> </div>
                  <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                    <div class="pdf-single-pro">
                      <a class="media" href="<?php echo base_url()?>Assets/dokumen/<?php echo $key->file; ?>"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div></td>
          </tr>
        </table><br>
        <div align="center">
          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
        </div>
        </form>
        <?php } ?>
        </div>                            
        </div>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('./footer'); ?>