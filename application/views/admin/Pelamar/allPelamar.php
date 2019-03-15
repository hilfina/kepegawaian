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
                <li><span class="bread-blod">Data Pelamar</span>
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
                <h1>Data <span class="table-project-n">Pelamar</span></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <div align="right"><a href="<?php echo site_url('admin/addPelamar')?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Pelamar</button>
                </a></div>
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
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>E-Mail</th>
                    <th>Pilihan Profesi</th>
                    <th>Pendidikan Terakhir</th>
                    <th>Jurusan</th>
                    <th>Nilai Akhir</th>
                    <th>Status</th>
                    <th>Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($array as $key) { ?>
                  <tr>
                    <td><?php echo $key->id_karyawan; ?></td>
                    <td><?php echo "<img src='".base_url("./assets/gambar/".$key->foto)."' width='100' height='100'>"; ?></td>
                    <td><?php echo $key->nama; ?></td>
                    <td><?php echo $key->email; ?></td>
                    <td><?php echo $key->id_profesi; ?></td>
                    <td><?php echo $key->pend_akhir; echo " - "; echo $key->pendidikan;  echo $key->jurusan ?></td>
                    <td><?php echo $key->nilai_akhir; ?></td>
                    <td><?php echo $key->id_status; ?></td>
                    <td align="center">
                      <?php if ($key->id_status == "Pelamar") { ?>
                        <a href="<?php echo site_url(); echo "/admin/pelamarDiterima/";  echo $key->id_karyawan ; ?>">
                          <button class="btn btn-success waves-effect mg-b-15" title="TERIMA"><i class="fa fa-check"></i></button>
                        </a>
                        <a href="<?php echo site_url(); echo "/admin/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                          <button class="btn btn-danger waves-effect mg-b-15" title="TOLAK"><i class="fa fa-times"></i></button>
                        </a>
                        <a href="<?php echo site_url(); echo "/admin/pelamarDetail/"; echo $key->id_karyawan ;?>">
                          <button class="btn btn-primary waves-effect waves-light mg-b-15">Detail</button>
                        </a>
                      <?php }else if ($key->id_status == "Calon Karyawan") { ?>
                        <a href="<?php echo site_url(); echo "/admin/pelamarDetail/"; echo $key->id_karyawan ;?>">
                          <button class="btn btn-primary waves-effect waves-light mg-b-15">Detail Seleksi</button>
                        </a>
                      <?php }else if ($key->id_status == "Pelamar Ditolak") { ?>
                        <a href="<?php echo site_url(); echo "/admin/pelamarDetail/"; echo $key->id_karyawan ;?>">
                          <button class="btn btn-warning waves-effect waves-light mg-b-15">Detail</button>
                        </a>
                      <?php } ?>
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