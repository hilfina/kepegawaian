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
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Tambah Karyawan</a> 
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
        <div class="sparkline13-list"> <br>
          <div class="sparkline13-hd">
            <div class="main-sparkline13-hd" align="center">
              <h1> Tambah Data <span class="table-project-n">Karyawan</span></h1>
            </div> <br>
            <div class="container-fluid" style="padding-right: 20%; padding-left: 10%;">
              <?php echo validation_errors('<div class="alert alert-danger fade-show">','</div>'); ?>
            </div>
          </div>

          <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
          <div class="alert alert-info"><b>Perhatian !</b><br>
                Dengan menambahkan data pada form dibawah, <br>
                User dengan hak akses Karyawan akan mendapat username dan password berupa nomor ktp.<br>
                Sedangkan user dengan hak akses Admin atau Super Admin akan mendapat username dan password berupa nomor NIK.
            </div>
          <form action="<?php echo site_url();?>/adminKaryawan/addKaryawan/" enctype="multipart/form-data" method="POST">
          <table width="100%">
            <tr>
              <td width="30%"><label form-control-label>Nomor Induk Karyawan</label></td>
              <td style="height: 50px" width="70%">
                <div class="col-lg-12">
                  <input name="nik" type="text" class="form-control" placeholder="Nomor Induk Karyawan" style="width:100%" >
                </div>
              </td>
            </tr>
          <tr>
            <td><label form-control-label>Nomor KTP</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="no_ktp" type="text" class="form-control" placeholder="Nomor KTP (Kartu Tanda Penduduk)" data-msg="Angka pada nomor ktp harus 16 huruf" data-rule="minlen:16">
                <div class="validation_errors"></div>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nama Lengkap</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nama" type="text" class="form-control" placeholder="Nama Karyawan">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Alamat</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="alamat" type="text" class="form-control" placeholder="Alamat Lengkap">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Nomor Telepon</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="no_telp" type="text" class="form-control" placeholder="Nomor Telepon">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Email</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="email" type="text" class="form-control" placeholder="Email">
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Status Karyawan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <select  class="form-control" name="id_status">
                  <option>-- Pilihan --</option>  
                  <?php foreach ($status as $key) { ?>
                    <option><?php echo $key->id_status; ?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Profesi Karyawan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <select  class="form-control" name="id_profesi">
                  <option>-- Pilihan --</option>
                  <?php foreach ($profesi as $key) { ?>
                    <option><?php echo $key->nama_profesi; ?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Golongan Karyawan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <select  class="form-control" name="id_golongan">
                  <option>-- Pilihan --</option>
                  <?php foreach ($golongan as $key) { ?>
                    <option><?php echo $key->id_golongan; ?></option>
                  <?php } ?>
                </select>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Hak Akses Karyawan</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <select  class="form-control" name="level">
                  <option>-- Pilihan --</option>
                  <option>Super Admin</option>
                  <option>admin </option>
                  <option>Karyawan </option>
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