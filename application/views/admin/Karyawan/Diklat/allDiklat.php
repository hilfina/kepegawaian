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
                <div align="right">
                <a href="<?php echo site_url(); echo "/adminDiklat/loadimpor/";?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Upload Data</button>
                </a>
                <a href="<?php echo site_url(); echo "/adminDiklat/add/";?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                </a>
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
                    <th>NIK</th>
                    <th>Nama Karyawan</th>
                    <th>Profesi</th>
                    <th>Status</th>
                    <th>Unit</th>
                    <th>Total Waktu</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=1;?>
                <?php foreach ($array as $key) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $key->nik; ?></td>
                    <td><?php echo $key->nama; ?></td>
                    <td><?php echo $key->id_profesi; ?></td>
                    <td><?php echo $key->id_status; ?></td>
                    <td><?php echo $key->ruangan?></td>
                    <td><?php echo substr($key->jam, 0,2)." jam ".substr($key->jam, 2,2)." menit /20 Jam"; ?></td>
                    <td>
                      <a href="<?php echo site_url('adminDiklat/detailDiklat/').$key->id_karyawan ?>">
                      <button class="btn btn-primary waves-effect waves-light mg-b-15">Detail</button>
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