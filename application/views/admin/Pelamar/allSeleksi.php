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
          <div class="sparkline13-hd">
            <div class="main-sparkline13-hd">
              <h1><span class="table-project-n">Data</span>Seleksi</h1>
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
              <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true"data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Agama</th>
                    <th>Kompetensi</th>
                    <th>Wawancara</th>
                    <th>PPA</th>
                    <th>Psikologi</th>
                    <th>Kesehatan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($array as $key){?>
                    <tr>
                      <td><?php echo $key->id_karyawan;?></td>
                      <td><?php echo $key->nama;?></td>
                      <td><?php echo $key->tgl_seleksi;?></td>
                      <td><?php echo $key->nilai_agama;?></td>
                      <td><?php echo $key->nilai_kompetensi;?></td>
                      <td><?php echo $key->nilai_wawancara;?></td>
                      <td><?php echo $key->tes_ppa;?></td>
                      <td><?php echo $key->tes_psikologi;?></td>
                      <td><?php echo $key->tes_kesehatan;?></td>
                      <td>
                        <a href="<?php echo site_url(); echo "/admin/editSeleksi/"; echo $key->id_karyawan ;?>">
                          <button class="btn btn-primary waves-light">Edit</button>
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