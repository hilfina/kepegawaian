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
      
          <form action="<?php echo site_url();?>/adminKaryawan/editAgama/<?php echo $array->id; ?>/<?php echo $array->id_karyawan; ?>" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label>Nama Tes</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nama_tes" type="text" class="form-control" value="<?php echo $array->nama_tes ?>">
                <input name="id" type="hidden" class="form-control" value="<?php echo $array->id ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Tes</label></td>
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
            <td><label form-control-label>Hasil Penilaian</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="hasil" type="text" class="form-control" value="<?php echo $array->hasil ?>">
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