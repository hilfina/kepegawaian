<?php 
  $this->load->view('./header');
  $levelku=$this->session->userdata("myLevel");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
?><br>
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
                <li><span class="bread-blod">Data Surat</span>
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
                <h1>Data <span class="table-project-n">Surat Karyawan</span></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <div align="right"><a href="<?php echo site_url(); echo "/admin/addsipstr/";?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
          <div class=" container-fluid" id="notif">
          <?php if ($this->session->flashdata('msg')) :?>
            <div class="alert alert-success"> 
            <?php echo $this->session->flashdata('msg')?>
            </div>
          <?php endif; ?>
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
                    <th  data-field="state" data-checkbox="true">Pilih</th>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Profesi</th>
                    <th>Status</th>
                    <th>Nomor Surat</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Berlaku</th>
                    <th>Keaktifan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1 ?>
                <?php foreach ($array as $key) { ?>
                    <tr>
                        <td></td>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $key->nama; ?></td>
                        <td><?php echo $key->id_profesi; ?></td>
                        <td><?php echo $key->id_status; ?></td>
                        <td><?php echo $key->no_surat; ?></td>
                        <td><?php echo $key->nama_surat; ?></td>
                        <td><?php echo date('d M Y', strtotime($key->tgl_mulai)); echo " - "; echo date('d M Y', strtotime($key->tgl_akhir)); ?></td>
                        <td>
                        <?php if(date('d-m-y') <= date('d-m-y', strtotime($key->tgl_akhir)) && date('d-m-y') >= date('d-m-y', strtotime($key->tgl_mulai))){ ?>
                          <i class="fa fa-check"></i> Surat Aktif 
                        <?php }elseif(date('d-m-y') <= date('d-m-y', strtotime($key->tgl_mulai))){ ?>
                          <i class="fa fa-check"></i> Belum Aktif
                        <?php }else{ ?>
                          <i class="fa fa-times"></i> Kadaluarsa 
                        <?php } ?>
                        </td>
                        <td><a href="<?php echo site_url(); echo "/admin/delsurat/"; echo $key->id_sipstr;?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        <button class="btn btn-danger waves-effect">hapus</button>
                      </a></td>
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