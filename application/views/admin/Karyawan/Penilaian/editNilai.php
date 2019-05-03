<?php 
  $this->load->view('./header');
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
                <li><a href="#">Data Penilaian</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Edit Data Penilaian</a> 
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
              <h1> Edit Data Penilaian Karyawan</h1><br>
            </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
      
          <form action="<?php echo site_url();?>/adminKaryawan/editNilai/<?php echo $array->id; ?>/<?php echo $array->id_karyawan; ?>" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label>NIK Penilai</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="id_penilai" type="text" class="form-control" value="<?php echo $array->id_penilai ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Hasil Penilaian</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="hasil" type="text" class="form-control" value="<?php echo $array->hasil ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Mulai</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
              <div class="input-daterange input-group" id="datepicker">
                <input name="tanggal" type="text" class="form-control" value="<?php echo $array->tanggal; ?>">
              </div>
              </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Upload Dokumen </label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <input type="hidden" name="file_old" value="<?php echo $array->file; ?>">
                <div class="input-mark-inner">
                      <div class="file-upload-inner ts-forms">
                        <div class="input prepend-big-btn">
                          <label class="icon-right" for="prepend-big-btn">
                            <i class="fa fa-download"></i>
                          </label>
                          <div class="file-button"> Browse
                            <input type="file" name="file" value="<?php echo $array->file; ?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                          </div>
                          <input type="text" id="prepend-big-btn" placeholder="no file selected" value="<?php echo $array->file; ?>">
                          <font size="2">Format dokumen harus dalam bentuk pdf/jpg. Ukuran file maksimal adalah 2 mb </font>
                        </div>
                      </div>
                    </div>
                  
              </div>
            </td>
          </tr>
        </table><br>
        <div align="center">
          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
        </div>
        </form>
        </div>                            
        </div>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('./footer'); ?>