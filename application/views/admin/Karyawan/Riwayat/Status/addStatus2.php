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
                <li><a href="#">Home</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Tambah Data Status</a> 
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
                <h1> Tambah Data Status Karyawan</h1><br>
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
        <?php foreach ($array2 as $id) {?>
          <form action="<?php echo site_url();?>/adminStatus/addStatus/<?php echo $id->id_karyawan; ?>" enctype="multipart/form-data" method="POST">
          <?php  } ?>
          <table width="100%">
          <tr>
            <td><label form-control-label>Nomor Surat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nomor_sk" type="text" class="form-control" placeholder="Nomor Surat">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Jenis Status</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <select name="id_status" class="form-control">
                <option>---Pilih---</option>
                  <?php foreach ($array as $key) {?>
                    <option><?php echo $key->id_status; ?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Mulai</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
              <div class="input-daterange input-group" id="datepicker">
                <input name="mulai" type="text" class="form-control">
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
                <input name="akhir" type="text" class="form-control">
              </div>
              </div>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Foto Scan SK</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <div class="input-mark-inner">
                      <div class="file-upload-inner ts-forms">
                        <div class="input prepend-big-btn">
                          <label class="icon-right" for="prepend-big-btn">
                            <i class="fa fa-download"></i>
                          </label>
                          <div class="file-button"> Browse
                            <input type="file" name="alamat_sk" value="" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                          </div>
                          <input type="text" id="prepend-big-btn" placeholder="no file selected">
                          <font size="2">Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2 mb </font>
                        </div>
                      </div>
                    </div>
              </div>
            </td>
          </tr>
        </table><br>
        <div align="center">
          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Tambahkan">
        </div>
        </form>
        </div>                            
        </div>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('./footer'); ?>