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
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Home</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Tambah Data Lowongan Pekerjaan</a> 
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
                <h1> Tambah Data <span class="table-project-n">Lowongan Pekerjaan</span></h1><br>
              </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
          <form action="<?php echo site_url();?>/adminLoker/addLoker/" enctype="multipart/form-data" method="POST">
          <table width="100%">
          <tr>
            <td><label form-control-label>Jenis Profesi</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <font color="red" size="2">*tambahkan jenis profesi terlebih dahulu jika pilihan jenis profesi lowongan tidak ada</font>
                <select name="id_profesi" class="form-control">
                  <?php foreach ($array as $key) {?>
                    <option><?php echo $key->nama_profesi;; ?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Kuota</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="kuota" type="number" class="form-control" placeholder="Banyak Maksimal Pelamar">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Dibuka</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="mulai" type="date" class="form-control">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Tanggal Ditutup</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="akhir" type="date" class="form-control">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>IPK Minimal</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="ipkmin" type="text" class="form-control" placeholder="Ketentuan Minimal IPK pelamar">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Usia Maksimal</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="usia" type="number" class="form-control" placeholder="Ketentuan maksimal usia pelamar">
              </div>
            </td>
          </tr>
          
          <tr>
            <td><label form-control-label>Jenis Kelamin</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <select name="jenkel" class="form-control">
                  <option>Perempuan</option>
                  <option>Laki-laki</option>
                  <option>Perempuan/Laki-laki</option>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Pendidikan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="jurusan" type="text" class="form-control" placeholder="Jenjang Pendidikan beserta jurusan">
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