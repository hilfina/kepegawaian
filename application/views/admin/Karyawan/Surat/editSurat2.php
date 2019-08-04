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
                <li><a href="#">Data Kontrak</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="#">Edit Data Surat</a> 
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
              <h1> Edit Data Surat Karyawan</h1><br>
            </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 20%">
        <?php foreach ($data as $key) { ?>
          <form action="<?php echo site_url();?>/adminNotifikasi/addSurat/<?php echo $key->nik."/".$key->id_surat?>" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label>NIK</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nik" type="text" class="form-control" value="<?php echo $key->nik ?>" disabled>
                <input name="nik" type="hidden" value="<?php echo $key->nik ?>">
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
            <td><label form-control-label>Nomor Surat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="no_surat" type="text" class="form-control" value="<?php echo $key->no_surat ?>" disabled>
                <input name="id_sipstr" type="hidden" value="<?php echo $key->id_sipstr ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Jenis Surat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nama_surat" type="text" class="form-control" value="<?php echo $key->nama_surat ?>" disabled>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Mulai</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
              <div class="input-daterange input-group" id="datepicker">
                <input name="tgl_mulai" type="text" class="form-control" value="<?php echo date('Y/m/d', strtotime($key->tgl_mulai)); ?>" disabled>
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
                <input name="tgl_akhir" type="text" class="form-control" value="<?php echo date('Y/m/d', strtotime($key->tgl_akhir)); ?>"disabled>
              </div>
              </div>
              </div>
            </td>
          </tr>
          <tr><td><br></td></tr>
          <tr>
            <td align="center" colspan="2">
              <div class="pdf-viewer-area mg-b-15">
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
              </div>
            </td>
          </tr>
        </table><br>
        <div align="center">
          <div class="pdf-single-pro">
            <a class="media" href="<?php echo base_url()?>Assets/dokumen/<?php echo $key->file; ?>"></a>
          </div>
        </div>
        <br>
        <div align="center">
          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Perbarui data">
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