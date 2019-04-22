<?php $this->load->view('./header'); ?>
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
                <li><a href="#">Data Diklat Karyawan</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Edit Data Diklat</a> 
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
                <h1> Edit Data Diklat Karyawan</h1><br>
              </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
          <?php foreach ($array as $key) { ?>
          <form action="<?php echo site_url();?>/adminDiklat/editdiklat/<?php echo $key->id_diklat; ?>" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label>NIK</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nik" type="text" class="form-control" value="<?php echo $key->nik; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nama Acara Diklat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nama_diklat" type="text" class="form-control" value="<?php echo $key->nama_diklat; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Jenis Diklat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="jenis_diklat" type="text" class="form-control" value="<?php echo $key->jenis_diklat; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nomor Sertifikat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nomor_sertif" type="text" class="form-control" value="<?php echo $key->nomor_sertif; ?>">
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
                <input name="tgl_akhir" type="text" class="form-control" value="<?php echo $key->tgl_akhir; ?>">
              </div>
              </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tahun Diklat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="tahun" type="text" class="form-control" value="<?php echo $key->tahun; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Jumlah Jam</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <font color="red" size="2">*Format (JAM:MENIT:DETIK)</font>
                <input name="jam" type="text" class="form-control" value="<?php echo $key->jam; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Upload Scan Serftifikat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <font size="2" color="red">*Format dokumen harus dalam bentuk docx / pdf / jpg. Ukuran file maksimal adalah 2 MB </font>
              <input name="file_old" type="hidden" class="form-control" value="<?php echo $key->file; ?>">
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
            </td>
          </tr>
          <tr>
            <td colspan="2" align="center"><br>
              <?php if(($key->file) != NULL){?>
                <img src="<?php echo base_url()?>Assets/dokumen/<?php echo $key->file?>" width="80%"/>   
              <?php }?>
            </td>
          </tr>
        </table><br>
        <div align="center">
          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Tambahkan">
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