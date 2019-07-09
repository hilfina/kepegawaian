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
                <li><a href="<?php echo site_url('adminPelamar/') ?>">Home</a> <span class="bread-slash">/</span>
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
<div class="data-table-area">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="sparkline13-list">
          <div class="col-lg-4">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <h1>Data <span class="table-project-n">Pelamar <?php echo $judul->nama_profesi; ?></td></span></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <div align="right">
                  
                <?php  $tdy = date('Y-m-d');
                if ($judul->akhir <= $tdy && $karyawan->id_status != 'Calon Karyawan') { ?>
                  <a href="<?php echo site_url(); echo"/adminPelamar/acc/"; echo $judul->id_profesi; ?>" >
                    <button class="btn btn-success waves-effect"><i class="fa fa-check"></i> Telah disetujui</button>
                  </a>
                  <a href="<?php echo site_url(); echo"/adminPelamar/cetak/"; echo $np; ?>" >
                    <button class="btn btn-primary waves-effect"><i class="fa fa-print" aria-hidden="true"></i> Cetak Daftar Pelamar</button>
                  </a>
                <?php }elseif ($karyawan->id_status == 'Calon Karyawan') { 
                  $caridataseleksi = $this->db->query("SELECT * from seleksi where id_karyawan = '$karyawan->id_karyawan'");
                  $dataseleksi = $caridataseleksi->row();
                  if ($dataseleksi->tgl_seleksi == "0000-00-00") { //jika tanggal belum ditambahkan ?>
                    <form action="<?php echo site_url();?>/adminPelamar/addtglsel/<?php echo $karyawan->id_profesi; ?>" method="POST">
                      <table>
                        <tr>
                          <td colspan="2"><font color="red" size="2">Tanggal Tes Tulis dan wawancara</font></td>
                        </tr>
                        <tr>
                          <td style="width: 70%"><input type="date" class="form-control" name="tgl" style="width: 100%"></td>
                          <td><button class="btn btn-success waves-effect ">Simpan</button></td>
                        </tr>
                      </table>
                    </form>
                  <?php }elseif ($dataseleksi->tgl_seleksi != "0000-00-00" && $dataseleksi->nilai_kompetensi == "-" && $dataseleksi->nilai_wawancara == "-") {//jika belum ada nilai tes tulis dan wawancara ?>
                    <form action="<?php echo site_url();?>/adminPelamar/addtglsel/<?php echo $karyawan->id_profesi; ?>" method="POST">
                      <table>
                        <tr>
                          <td style="width: 70%">
                            <div class="input-mark-inner">
                              <div class="file-upload-inner ts-forms">
                                <div class="input prepend-big-btn">
                                  <label class="icon-right" for="prepend-big-btn">
                                    <i class="fa fa-download"></i>
                                  </label>
                                  <div class="file-button"> Browse
                                    <input type="file" name="file" value="" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                  </div>
                                  <input type="text" id="prepend-big-btn" placeholder="Hasil Tes">
                                </div>
                              </div>
                            </div>
                          </td>
                          <td><button class="btn btn-primary waves-effect ">Simpan</button></td>
                        </tr>
                      </table>
                    </form>
                  <?php } ?>                  
                <?php } ?>

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
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th> 
                    <th>Pendidikan Terakhir</th>
                    <th>Nilai Akhir</th>
                    <th>Tahun Lulus</th>
                    <th>Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1;?>
                <?php foreach ($array as $key) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $key->nama; ?></td>
                    <td><?php echo $key->jenkel;?></td>
                    <td><?php $tdy = date('Y'); $lhr = substr($key->ttl, 0,4); echo $tdy-$lhr; ?></td>
                    <td><?php echo $key->pendidikan;   echo " - "; echo $key->pend_akhir; echo " "; echo $key->jurusan ?></td>
                    <td><?php echo $key->nilai_akhir; ?></td>
                    <td><?php echo $key->akhir; ?></td>
                    <td align="center">
                     <?php if($levelku == "Super Admin"){ ?>
                      <!-- <a href="<?php //echo site_url(); echo "/adminPelamar/pelamarDiterima/";  echo $key->id_karyawan ; ?>">
                      <button class="btn btn-success waves-effect" title="TERIMA"><i class="fa fa-check"></i></button>
                    </a> -->
                    <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                      <button class="btn btn-danger waves-effect" title="TOLAK"><i class="fa fa-times"></i></button>
                    </a>
                    <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDetail/"; echo $key->id_karyawan ;?>">
                      <button class="btn btn-primary waves-effect waves-light">Detail</button>
                    </a>
                    <?php } else {?>
                    <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDetail/"; echo $key->id_karyawan ;?>">
                      <button class="btn btn-primary waves-effect waves-light">Detail</button>
                    </a>
                    <?php }?>
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