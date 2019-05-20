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
                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Data Pelatihan Karyawan</span>
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
                <h1>Data <span class="table-project-n">Pelatihan Karyawan</span></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <div align="right">
                <a href="<?php echo site_url('adminpelatihan/loadimpor')?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Upload Data</button>
                </a>
                <a href="<?php echo site_url('adminpelatihan/add')?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                </a></div>
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
                  <option value="">Data Table</option>
                </select>
              </div>
              <table id="kepegawaian" data-toggle="table" data-pagination="true" data-search="true" data-show-refresh="true" \data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Profesi</th>
                    <th>Nomor MOU</th>
                    <th>Masa Berlaku</th>
                    <th>Keterangan</th>
                    <th>File</th>
                    <th>Aktif</th>
                    <th>Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=1;?>
                <?php foreach ($array as $key) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $key->nik;?></td>
                    <td><?php echo $key->nama; ?></td>
                    <td><?php echo $key->id_profesi; ?></td>
                    <td><?php echo $key->no_mou; ?></td>
                    <td><?php echo date('d M Y', strtotime($key->tgl_mulai))." - ".date('d M Y', strtotime($key->tgl_akhir)); ?></td>
                    <td><?php echo $key->ket; ?></td>
                    <td>
                    <?php if(($key->file) != NULL){ ?>
                      <a href="<?php echo base_url().'/Assets/dokumen/'.$key->file; ?>" download>
                        <button class="btn btn-default waves-effect" class='submit'><i class="fa fa-download" aria-hidden="true"></i> Unduh File</button>
                      </a>
                    <?php }else{ ?>
                      <font style="color: red">Tidak Ada file</font>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d', strtotime($key->tgl_akhir))) && strtotime(date('Y-m-d')) > strtotime(date('Y-m-d', strtotime($key->tgl_mulai)))){ ?>
                          <i class="fa fa-check"></i> Surat Aktif 
                        <?php }elseif(strtotime(date('Y-m-d', strtotime($key->tgl_mulai))) >= strtotime(date('Y-m-d'))){ ?>
                          <i class="fa fa-check"></i> Belum Aktif
                        <?php }elseif($key->tgl_akhir != "" && date('Y-m-d', strtotime($key->tgl_akhir)) <= strtotime(date('Y-m-d'))){ ?>
                          <i class="fa fa-times"></i> Kadaluarsa 
                      <?php }elseif($key->tgl_akhir == "" && date('Y-m-d', strtotime($key->tgl_akhir)) <= strtotime(date('Y-m-d'))){ ?>
                          <font color="red">Edit tanggal akhir</font>
                        <?php } ?>
                    </td>
                    <td align="center">
                      <a href="<?php echo site_url(); echo "/adminpelatihan/edit/"; echo $key->id ;?>">
                        <button class="btn btn-warning waves-effect">edit</button>
                      </a>
                      <a href="<?php echo site_url(); echo "/adminpelatihan/del/"; echo $key->id;?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <button class="btn btn-danger waves-effect">hapus</button>
                      </a>
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