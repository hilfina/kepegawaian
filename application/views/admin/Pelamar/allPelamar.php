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
                if ($judul->akhir <= $tdy && $karyawan->id_status != 'Calon Karyawan' && $levelku == 'Super Admin') { ?>
                  <a href="<?php echo site_url(); echo"/adminPelamar/acc/"; echo $judul->id_profesi; ?>" >
                    <button class="btn btn-success waves-effect"><i class="fa fa-check"></i> Telah disetujui</button>
                  </a>
                  <a href="<?php echo site_url(); echo"/adminPelamar/cetak/"; echo $np; ?>" >
                    <button class="btn btn-primary waves-effect"><i class="fa fa-print" aria-hidden="true"></i> Cetak Daftar Pelamar</button>
                  </a>
                <?php }elseif ($karyawan->id_status == 'Calon Karyawan') { 
                  $caridataseleksi = $this->db->query("SELECT * from seleksi where id_karyawan = '$karyawan->id_karyawan'");
                  $dataseleksi = $caridataseleksi->row();
                  $caridatarseleksi = $this->db->query("SELECT count(id_seleksi) as id from riwayat_seleksi where id_seleksi = '$dataseleksi->id_seleksi' AND nama_tes = 'Tes Kesehatan'");
                  $datars = $caridatarseleksi->row();
                  $caridatarseleksi2 = $this->db->query("SELECT count(id_seleksi) as id from riwayat_seleksi where id_seleksi = '$dataseleksi->id_seleksi' AND nama_tes = 'Tes Psikologi'");
                  $datars2 = $caridatarseleksi2->row();
                  if ($dataseleksi->tgl_seleksi == "0000-00-00" && $dataseleksi->nilai_kompetensi == "-") { //jika tanggal belum ditambahkan ?>
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
                  <?php }elseif ($dataseleksi->tgl_seleksi != "0000-00-00" && $dataseleksi->nilai_kompetensi == "-") {//jika belum ada nilai tes tulis dan wawancara ?>
                    <a href="<?php echo site_url(); echo"/adminPelamar/report/"; echo $np; ?>" >
                    <button class="btn btn-primary waves-effect waves-light mg-b-15"><i class="fa fa-print" aria-hidden="true"></i> Cetak Daftar Pelamar</button>
                  </a>
                  <?php } elseif($nol == null && $dataseleksi->tes_kesehatan == "-" && $dataseleksi->tgl_seleksi != "0000-00-00" && $levelku == 'Super Admin' && $datars->id == 0 ){?>
                   <a href="<?php echo site_url(); echo"/adminPelamar/acc2/"; echo $judul->id_profesi."/Tulis"; ?>" >
                      <button class="btn btn-success waves-effect waves-light mg-b-15"><i class="fa fa-check"></i> Telah disetujui</button>
                    </a>
                    <a href="<?php echo site_url(); echo"/adminPelamar/report/"; echo $np; ?>" >
                    <button class="btn btn-primary waves-effect waves-light mg-b-15"><i class="fa fa-print" aria-hidden="true"></i> Cetak Daftar Pelamar</button>
                  </a>
                   <?php } elseif($dataseleksi->tgl_seleksi == "0000-00-00" && $dataseleksi->nilai_kompetensi != "-" && $dataseleksi->nilai_wawancara != "-" && $dataseleksi->nilai_agama != "-" && $dataseleksi->tes_kesehatan == "-") { //jika tanggal belum ditambahkan ?>
                    <form action="<?php echo site_url();?>/adminPelamar/edittglsel/<?php echo $karyawan->id_profesi; ?>" method="POST">
                      <table>
                        <tr>
                          <td colspan="2"><font color="red" size="2">Tanggal Tes Kesehatan</font></td>
                        </tr>
                        <tr>
                          <td style="width: 70%"><input type="date" class="form-control" name="tgl" style="width: 100%"></td>
                          <td><button class="btn btn-success waves-effect ">Simpan</button></td>
                        </tr>
                      </table>
                    </form>
                    <?php } elseif($nol2 == null && $dataseleksi->tes_kesehatan != "-" && $dataseleksi->tgl_seleksi != "0000-00-00" && $dataseleksi->tes_psikologi == "-" && $levelku == 'Super Admin' && $datars2->id == 0){?>
                   <a href="<?php echo site_url(); echo"/adminPelamar/acc2/"; echo $judul->id_profesi."/Kesehatan"; ?>" >
                      <button class="btn btn-success waves-effect waves-light mg-b-15"><i class="fa fa-check"></i> Telah disetujui</button>
                    </a>
                    <a href="<?php echo site_url(); echo"/adminPelamar/report/"; echo $np; ?>" >
                    <button class="btn btn-primary waves-effect waves-light mg-b-15"><i class="fa fa-print" aria-hidden="true"></i> Cetak Daftar Pelamar</button>
                  </a>
                  <?php } elseif($dataseleksi->tgl_seleksi == "0000-00-00" && $dataseleksi->nilai_kompetensi != "-" && $dataseleksi->nilai_wawancara != "-" && $dataseleksi->nilai_agama != "-" && $dataseleksi->tes_kesehatan != "-") { //jika tanggal belum ditambahkan ?>
                    <form action="<?php echo site_url();?>/adminPelamar/edittglsel2/<?php echo $karyawan->id_profesi; ?>" method="POST">
                      <table>
                        <tr>
                          <td colspan="2"><font color="red" size="2">Tanggal Tes Psikologi</font></td>
                        </tr>
                        <tr>
                          <td style="width: 70%"><input type="date" class="form-control" name="tgl" style="width: 100%"></td>
                          <td><button class="btn btn-success waves-effect ">Simpan</button></td>
                        </tr>
                      </table>
                    </form>
                    <?php } elseif($nol3 == null && $dataseleksi->tes_psikologi != "-" && $dataseleksi->tgl_seleksi != "0000-00-00" && $levelku == 'Super Admin'){?>
                   <a href="<?php echo site_url(); echo"/adminPelamar/acc3/"; echo $judul->id_profesi; ?>" >
                      <button class="btn btn-success waves-effect waves-light mg-b-15"><i class="fa fa-check"></i> Jadi Karyawan</button>
                    </a>
                    <a href="<?php echo site_url(); echo"/adminPelamar/report/"; echo $np; ?>" >
                    <button class="btn btn-primary waves-effect waves-light mg-b-15"><i class="fa fa-print" aria-hidden="true"></i> Cetak Daftar Pelamar</button>
                  </a>
                   <?php } ?>  
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
              
              <table id="kepegawaian" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
              <?php if ($karyawan->id_status != 'Calon Karyawan') {?>
              <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
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
                <?php $no = 1;
                $tdy = date('Y-m-d');?>
                <?php foreach ($array as $key) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo "<img src='".base_url("./assets/gambar/".$key->foto)."' width='60'>"; ?></td>
                    <td><?php echo $key->nama; ?></td>
                    <td><?php echo $key->jenkel;?></td>
                    <td><?php $tdy = date('Y'); $lhr = substr($key->ttl, 0,4); echo $tdy-$lhr; ?></td>
                    <td><?php echo $key->pendidikan;   echo " - "; echo $key->jenjang; echo " "; echo $key->jurusan ?></td>
                    <td><?php echo $key->nilai; ?></td>
                    <td><?php echo $key->akhir; ?></td>
                    <td align="center">
                     <?php if($levelku == "Super Admin" && $judul->akhir <= date('Y-m-d')){ ?>
                      
                    <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDitolak/"; echo $judul->id_profesi ; echo "/"; echo $key->id_karyawan ;?>">
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
                
              <?php }elseif ($karyawan->id_status == 'Calon Karyawan'){ ?>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Tes Tulis</th>
                    <th>Tes Wawancara</th>
                    <th>Tes Agama</th>
                    <th>Tes Kesehatan</th>
                    <th>Tes Psikologi</th>
                    <th>Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1;?>
                <?php foreach ($selek as $key2) { ?>
                  <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $key2->nama; ?></td>
                    <td><?php echo $key2->nilai_kompetensi;?></td>
                    <td><?php echo $key2->nilai_wawancara; ?></td>
                    <td><?php echo $key2->nilai_agama;?></td>
                    <td><?php echo $key2->tes_kesehatan;?></td>
                    <td><?php echo $key2->tes_psikologi;?></td>
                    <td align="center">
                     <?php if($levelku == "Super Admin"){ ?>
                      <!-- <a href="<?php //echo site_url(); echo "/adminPelamar/pelamarDiterima/";  echo $key->id_karyawan ; ?>">
                      <button class="btn btn-success waves-effect" title="TERIMA"><i class="fa fa-check"></i></button>
                    </a> -->
                    <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDitolak/"; echo $judul->id_profesi ; echo "/"; echo $key2->id_karyawan ;?>">
                      <button class="btn btn-danger waves-effect" title="TOLAK"><i class="fa fa-times"></i></button>
                    </a>
                    <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDetail/"; echo $key2->id_karyawan ;?>">
                      <button class="btn btn-primary waves-effect waves-light">Detail</button>
                    </a>
                    <a href="<?php echo site_url(); echo "/admin/detSeleksi/"; echo $key2->id_karyawan ;?>">
                      <button class="btn btn-primary waves-effect waves-light">Detail Selekssi</button>
                    </a>
                    <?php } else {?>
                    <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDetail/"; echo $key2->id_karyawan ;?>">
                      <button class="btn btn-primary waves-effect waves-light">Detail</button>
                    </a>
                    <a href="<?php echo site_url(); echo "/admin/detSeleksi/"; echo $key2->id_karyawan ;?>">
                      <button class="btn btn-primary waves-effect waves-light">Detail Selekssi</button>
                    </a>
                    <?php }?>
                    </td>
                  </tr>
                <?php }?>
                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./footer'); ?>