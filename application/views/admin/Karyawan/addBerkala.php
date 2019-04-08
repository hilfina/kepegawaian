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
                <li><a href="#">Data Berkala Karyawan</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Tambah Data Berkala</a> 
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
                <h1> Tambah Data Berkala Karyawan</h1><br>
              </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
          <form action="<?php echo site_url();?>/adminBerkala/addBerkala/" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label">NIK</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nik" type="text" class="form-control" placeholder="Nomor Induk Karyawan">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Nomor Surat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nomor_sk" type="text" class="form-control" placeholder="Nomor Surat">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Berkala</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="berkala" type="text" class="form-control" placeholder="Berkala"">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Tanggal Mulai</label></td>
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
            <td><label form-control-label">Tanggal Berakhir</label></td>
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
            <td><label form-control-label">Upload Dokumen SK</label></td>
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
                          <font size="2">Format dokumen harus dalam bentuk docx / pdf / jpg. Ukuran file maksimal adalah 2 mb </font>
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