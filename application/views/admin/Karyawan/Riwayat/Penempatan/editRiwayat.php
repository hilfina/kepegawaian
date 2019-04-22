<?php  $this->load->view('./header'); ?>
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
                <li><a href="#">Home</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Edit Data Riwayat</a> 
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
                <h1> Edit Data Riwayat Penempatan Karyawan</h1><br>
              </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
          <?php foreach ($datRi as $key) { ?>
           <form action="<?php echo site_url();?>/adminRiwayat/edit/<?php echo $key->id_riwayat ?>" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label>NIK</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nik" type="text" class="form-control" value="<?php echo $key->nik ?>" disabled>
                <input name="nik" type="hidden" class="form-control" value="<?php echo $key->nik ?>">
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
            <td><label form-control-label>Jenis Profesi</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <font color="red" size="2">*tambahkan jenis profesi terlebih dahulu jika pilihan jenis profesi lowongan tidak ada</font>
                <select name="id_profesi" class="form-control">
                    <option><?php echo $key->nama_profesi ?></option>
                  <?php foreach ($array as $ke) {?>
                    <option><?php echo $ke->nama_profesi; ?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Penempatan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="ruangan" type="text" class="form-control" value="<?php echo $key->ruangan ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Mulai Tanggal</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
              <div class="input-daterange input-group" id="datepicker">
                <input name="mulai" type="text" class="form-control" value="<?php echo $key->mulai ?>">
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
          <?php } ?>
        </div>                            
        </div>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('./footer'); ?>