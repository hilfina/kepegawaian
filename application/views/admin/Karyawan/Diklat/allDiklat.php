<?php $this->load->view('./header'); ?><br>
 <div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="<?php echo site_url('admin/') ?>">Home</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Data Diklat Karyawan</span>
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
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <h1>Data <span class="table-project-n">Diklat Karyawan</span></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
<<<<<<< HEAD:application/views/admin/Karyawan/Diklat/allDiklat.php
<<<<<<< HEAD:application/views/admin/Karyawan/Diklat/allDiklat.php
                <div align="right"><a href="<?php echo site_url('adminDiklat/addDiklat')?>">
=======
=======
>>>>>>> parent of 49576eb... Revert "SubhanAllah":application/views/admin/Karyawan/detailDiklat.php
                <div align="right">
                <?php foreach ($array as $key) { ?>
                <a href="<?php echo site_url(); echo "/adminDiklat/addDiklat/";  echo $key->id_karyawan; echo "/";echo $key->id_karyawan; ?>">
                <?php } ?>
<<<<<<< HEAD:application/views/admin/Karyawan/Diklat/allDiklat.php
>>>>>>> parent of 49576eb... Revert "SubhanAllah":application/views/admin/Karyawan/detailDiklat.php
=======
>>>>>>> parent of 49576eb... Revert "SubhanAllah":application/views/admin/Karyawan/detailDiklat.php
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                </a>
                </div>
                <div class=" container-fluid" id="notif">
                    <?php if ($this->session->flashdata('msg')) :?>
                        <div class="alert alert-success"> 
                    <?php echo $this->session->flashdata('msg')?>
                        </div>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
          <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
              <div id="toolbar">
                <select class="form-control dt-tb">
                  <option value="">Export Basic</option>
                  <option value="all">Export All</option>
                  <option value="selected">Export Selected</option>
                </select>
              </div>
              <table id="kepegawaian" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nomor Sertifikat</th>
                    <th>Nama Diklat</th>
                    <th>Jenis Diklat</th>
                    <th>Tanggal</th>
                    <th>Tahun</th>
                    <th>Waktu</th>
                    <th>Sertifikat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=1;?>
                <?php foreach ($array as $key) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $key->nomor_sertif; ?></td>
                    <td><?php echo $key->nama_diklat; ?></td>
                    <td><?php echo $key->jenis_diklat; ?></td>
                    <td><?php echo date('d M Y', strtotime($key->tgl_mulai))." - ".date('d M Y', strtotime($key->tgl_akhir)); ?></td>
                    <td><?php echo $key->tahun; ?></td>
                    <td><?php echo substr($key->jam, 0,2)." Jam"; ?></td>
                    <td>
                      <?php if(($key->file) != NULL) {?>
                       <font style="color: blue">File Tersedia</font>
                      <?php }else{ ?>
                        <font style="color: red">Tidak Ada file</font>
                      <?php } ?>
                    </td>
<<<<<<< HEAD:application/views/admin/Karyawan/Diklat/allDiklat.php
                    <td>
                    <a href="<?php echo site_url('adminDiklat/editdiklat/').$key->id_diklat ?>">
                    <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                    <a href="<?php echo site_url('adminDiklat/hapusdiklat/').$key->id_diklat ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">
                    <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
=======
                    <td align="center">
                      <a href="<?php echo site_url(); echo "/adminDiklat/edit/"; echo $key->id_diklat; echo "/";echo $key->id_karyawan; ?>">
                        <button class="btn btn-warning waves-effect">edit</button>
                      </a>
                      <a href="<?php echo site_url(); echo "/adminDiklat/del/"; echo $key->id_diklat; echo "/";echo $key->id_karyawan; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <button class="btn btn-danger waves-effect">hapus</button>
                      </a>
>>>>>>> parent of 49576eb... Revert "SubhanAllah":application/views/admin/Karyawan/detailDiklat.php
                    </td>
                  </tr>
                <?php }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./footer'); ?>