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
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Tambah Pelamar</a> 
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
                <h1> Tambah Data <span class="table-project-n">Pelamar</span></h1><br>
              </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
          <form action="<?php echo site_url();?>/adminPelamar/addPelamar/" enctype="multipart/form-data" method="POST">
          <table width="100%">
            
          <tr>
            <td><label form-control-label">Nomor KTP</label></td>
            <td style="height: 50px" width="70%">
              <div class="col-lg-12">
                <input name="no_ktp" type="text" class="form-control" placeholder="Nomor KTP (Kartu Tanda Penduduk)">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Nama Pelamar</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nama" type="text" class="form-control" placeholder="Nama Pelamar">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Alamat Lengkap</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="alamat" type="text" class="form-control" placeholder="Alamat Lengkap">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Nomor Telepon</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="no_telp" type="text" class="form-control" placeholder="Nomor Telepon">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Email</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="email" type="text" class="form-control" placeholder="Email">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Pendidikan Akhir</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="pendidikan" type="text" class="form-control" placeholder="Nama Institusi">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label">Profesi Yang Dipilih</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <select  class="form-control" name="id_profesi">
                  <option>-- Pilihan --</option>
                  <?php foreach ($array as $key) { ?>
                    <option><?php echo $key->id_profesi; ?></option>
                  <?php } ?>
                </select>
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