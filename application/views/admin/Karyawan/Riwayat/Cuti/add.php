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
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Tambah Data Absensi Karyawan</a> 
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
        <div class="sparkline13-list"><br>
          <div class="sparkline13-hd">
            <div class="main-sparkline13-hd" align="center">
              <h1> Tambah Data <span class="table-project-n">Absensi Karyawan</span></h1><br>
            </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
          <form action="<?php echo site_url();?>/adminKaryawan/addCuti/<?php echo $id_karyawan ?>" enctype="multipart/form-data" method="POST">
          
            <table width="100%">
              <tr>
                <td><label form-control-label>Tanggal ijin</label></td>
                <td style="height: 50px">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                      <div class="input-daterange input-group" id="datepicker">
                          <input type="text" class="form-control" name="tgl_awal" />
                          <span class="input-group-addon"><b>hingga</b></span>
                          <input type="text" class="form-control" name="tgl_akhir" />
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><label form-control-label>Keterangan Ijin</label></td>
                <td style="height: 50px">
                  <div class="col-lg-12">
                    <input name="ket" type="text" class="form-control" placeholder="Alasan Ijin . . .">
                  </div>
                </td>
              </tr>
              <tr>
                <td><label form-control-label>Surat Ijin</label></td>
                <td style="height: 50px">
                  <div class="col-lg-12">
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
                </td>
              </tr>
            </table>
          
          <br>
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