<?php 
  $this->load->view('./header');
  $levelku=$this->session->userdata("myLevel");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
?>
<div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Edit Data Seleksi</span>
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
        <?php foreach ($array as $key){ ?>
        <form action="<?php echo site_url();?>/admin/editSeleksi/<?php echo $key->id_karyawan;?>" enctype="multipart/form-data" method="POST">
          <input name="idKSel" type="hidden" class="form-control" value="<?php echo $key->id_karyawan; ?>">
          <table width="100%">
            <tr>
              <td width="20%"><label form-control-label>ID Seleksi</label></td>
              <td style="height: 50px" width="80%">
                <div class="col-lg-12">
                  <input name="idSel" type="text" class="form-control" value="<?php echo $key->id_seleksi; ?>" style="width:100%" disabled>
                </div>
              </td>
            </tr>
          <tr>
            <td><label form-control-label>Tanggal Seleksi</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="tglSel" type="date" class="form-control" value="<?php echo $key->tgl_seleksi; ?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nilai Wawancara</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nwSel" type="text" class="form-control" value="<?php echo $key->nilai_wawancara;?>" >
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nilai Agama</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="naSel" type="text" class="form-control" value="<?php echo $key->nilai_agama;?>">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nilai Kompetensi</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nkSel" type="text" class="form-control" value="<?php echo $key->nilai_kompetensi;?>" >
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tes PPA</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="tpSel" type="text" class="form-control" value="<?php echo $key->tes_ppa; ?>" >
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tes Psikologi</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="tpsSel" type="text" class="form-control" value="<?php echo $key->tes_psikologi; ?>" >
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tes Kesehatan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="tkSel" type="text" class="form-control" value="<?php echo $key->tes_kesehatan?>">
              </div>
            </td>
          </tr>
        </table>
        <input name="" type="submit" class="form-control" value="Update">
        </form>                       
        <?php } ?>                                
        </div>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('./footer'); ?>