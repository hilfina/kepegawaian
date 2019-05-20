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
                <li><span class="bread-blod">Data Seleksi</span>
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
                <h1>Data <span class="table-project-n">Seleksi</span></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <div align="right">
                <?php foreach ($array as $key){ ?>
                  <?php if($key->id_seleksi == NULL): ?>
                  <a href="<?php echo site_url('adminPelamar/report') ?>">
                    <button class="btn btn-primary waves-effect waves-light mg-b-15">Print Report Data Seleksi</button>
                  </a>
                <?php endif; ?>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
              <div id="toolbar">
                
              </div>
              <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-refresh="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th>Id Seleksi</th>
                    <th>Nama</th>
                    <th>Tanggal Tes Terakhir</th>
                    <th>Jenis Tes</th>
                    <th>Hasil</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($array as $key){ ?>
                    <tr>
                      <td><?php echo $key->id_seleksi;?></td>
                      <td><?php echo $key->nama;?></td>
                      <td><?php echo date('d M Y', strtotime($key->tgl_seleksi)); ?></td>
                      <td><?php echo $key->nama_tes;?></td>
                      <td><?php echo $key->hasil;?></td>
                      <td>                        
                        <a href="<?php echo site_url(); echo "/admin/detSeleksi/"; echo $key->id_karyawan ;?>"><button class="btn btn-primary ">Detail</button></i></a>
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