<?php 
	$this->load->view('./header.php');
	$levelku=$this->session->userdata("myLevel");
	$namaku=$this->session->userdata("myLongName");
	$emailku=$this->session->userdata("myEmail");
	$idku=$this->session->userdata("myId");
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
                <li><a href="<?php echo site_url('adminPelamar') ?>">Data Pelamar</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Detail Pelamar</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Single pro tab review Start-->
<div class="single-pro-review-area mt-t-30 mg-b-15">
  <div class="container-fluid">
    <div class="row">
      
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <div class="profile-info-inner">
            <div class="profile-img">
              <?php foreach ($datDir as $key){ ?>
                <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto?>" alt=""/>
            </div><br>
            <?php } ?>
            <div align="center">
              <?php foreach ($datDir as $key){ ?>
                <?php foreach ($datLo as $lo){ ?>
                <?php if ($key->id_status == "Pelamar" && $key->id_profesi != "Belum" && $lo->finalisasi == '1' ) { ?>
                  <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDiterima/";  echo $key->id_karyawan ; ?>">
                    <button class="btn btn-success waves-effect mg-b-15" title="Panggil untuk maju ke tahap tes"><i class="fa fa-check"></i>  Panggil</button>
                  </a>
                  <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                    <button class="btn btn-danger waves-effect mg-b-15"><i class="fa fa-times"></i> Tolak</button>
                  </a>
                <?php }?>
                <?php } ?>
              <?php } ?>
              <?php foreach ($datSel as $a){ ?>
              <?php if ($a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-") { ?>
                <a href="<?php echo site_url(); echo "/adminPelamar/editMagang/";  echo $key->id_karyawan ; ?>">
                  <button class="btn btn-success waves-effect mg-b-15" title="Terima untuk menjadi karyawan magang"><i class="fa fa-check"></i> Terima</button>
                </a>
                <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                  <button class="btn btn-danger waves-effect mg-b-15"><i class="fa fa-times"></i> Gagal</button>
                </a>
              <?php } else{}?>
              <?php } ?>
            </div>
          </div>
        </div>
      
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
        <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
          <ul id="myTabedu1" class="tab-review-design">
            <li class="active"><a href="#dataPribadi">Data Pribadi</a></li>
            <li><a href="#cv"> Curiculum Vitae</a></li>
            <li><a href="#dataPendidikan"> Data Pendidikan</a></li>
            <?php foreach ($datDir as $dd) {
              if ($dd->id_profesi == "Dokter" || $dd->id_profesi == "Fisioterapis" || $dd->id_profesi == "Apoteker" || $dd->id_profesi == "Perawat") {
               echo "<li><a href='#dataSurat'>Data Surat</a></li>";
              }if ($dd->id_status == "Calon Karyawan") {
                echo "<li><a href='#dataSeleksi'>Data Seleksi</a></li>";
              }
            } ?>
          </ul>
          <div id="myTabContent" class="tab-content custom-product-edit">
            <div class="product-tab-list tab-pane fade active in" id="dataPribadi">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                  <?php foreach ($datDir as $key){ ?>
                    <form action="<?php echo site_url();?>/adminPelamar/editData/<?php echo $key->id_karyawan ;?>" method="POST">
                      <table width="100%">
                        <tr>
                          <td width="20%"><label form-control-label>Nomor Pelamar</label></td>
                          <td style="height: 50px" width="80%">
                            <div class="col-lg-12">
                              <input name="id_karyawan" type="text" class="form-control" value="<?php echo $key->id_karyawan; ?>" style="width:100%">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Nomor KTP</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <input name="no_ktp" type="text" class="form-control" value="<?php echo $key->no_ktp; ?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Nama Lengkap</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <input name="nama" type="text" class="form-control" value="<?php echo $key->nama;?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Jenis Kelamin</label></td>
                          <td style="height: 50px; width: 80%">
                            <div class="col-lg-12">
                              <input name="jenkel" type="text" class="form-control" value="<?php echo $key->jenkel;?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Tanggal Lahir</label></td>
                          <td style="height: 50px; width: 80%">
                            <div class="col-lg-12">
                              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                <div class="input-daterange input-group" id="datepicker">
                                  <input type="text" class="form-control" name="ttl" placeholder="Tanggal Lahir Pelamar" value="<?php echo date('Y/m/d',strtotime($key->ttl)); ?>"  style="align: left">
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Alamat</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <input name="alamat" type="text" class="form-control" value="<?php echo $key->alamat;?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Nomor Telepon</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <input name="no_telp" type="text" class="form-control" value="<?php echo $key->no_telp; ?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Email</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <input name="email" type="text" class="form-control" value="<?php echo $key->email; ?>">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td><label form-control-label>Posisi Lamaran</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <input name="id_profesi" type="text" class="form-control" value="<?php echo $key->id_profesi; ?>">
                            </div>
                          </td>
                        </tr>
                      </table><br>
                    <?php } ?>
                      <div align="center">
                        <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>    
            <div class="product-tab-list tab-pane fade" id="cv">
              <div class="pdf-viewer-area mg-b-15">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> </div>
                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                      <div class="pdf-single-pro">
                        <?php foreach ($datLo as $key){?>
                          <a class="media" href="<?php echo base_url()?>Assets/dokumen/<?php echo $key->cv; ?>"></a>
                        <?php }?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-tab-list tab-pane fade" id="dataPendidikan">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <div class="col-lg-12">
                      <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                          <?php foreach ($datDir as $key){?>
                          <div align="right"><a href="<?php echo site_url(); echo "/adminPelamar/addPend/";  echo $key->id_karyawan ; ?>">
                            <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                          </a></div>
                        <?php }?>
                        </div>
                      </div>
                      <div class="sparkline8-graph">
                        <div class="static-table-list">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Institusi</th>
                                <th>Jurusan</th>
                                <th>N A</th>
                                <th>Tahun</th>
                                <th>No Ijasah</th>
                                <th>Verifikasi</th>
                                <th>Setting</th>
                              </tr>
                            </thead>
                            <?php foreach ($datPen as $key){ ?>
                            <tbody>
                              <tr>
                                <td><?php echo $key->pendidikan; ?></td>
                                <td><?php echo $key->jurusan; ?></td>
                                <td><?php echo $key->nilai; ?></td>
                                <td><?php echo $key->mulai; echo " - "; echo $key->akhir; ?></td>
                                <td><?php echo $key->nomor_ijazah; ?></td>
                                
                                <td>
                                  <?php 
                                if(($key->verifikasi) == 1){ ?>
                                 <i class="fa fa-check"></i> Terverifikasi
                                 <?php }else{ ?>
                                  <a href="<?php echo site_url(); echo "/adminPelamar/verPend/"; echo $key->id;echo "/";echo $key->id_karyawan; ?>">
                                    <button class="btn btn-success waves-effect mg-b-15" title="Klik untuk memverifikasi"><i class="fa fa-check"></i></i></button>
                                  </a>
                                <?php } ?>
                                  
                                </td>   
                                <td>
                                  <a href="<?php echo site_url('adminPelamar/editpend/').$key->id?>">
                                    <button data-toggle="tooltip" title="Edit / Detail" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                  </a>
                                  <a href="<?php echo site_url('adminPelamar/delpend/').$key->id; echo "/";echo $key->id_karyawan; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                    <button data-toggle="tooltip" title="Delete" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                  </a>
                                </td>
                              </tr>
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
            <div class="product-tab-list tab-pane fade" id="dataSurat">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <div class="col-lg-12">
                      <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                          <?php foreach ($datDir as $key){?>
                            <div align="right">
                              <a href="<?php echo site_url(); echo "/adminPelamar/addSurat/";  echo $key->id_karyawan ; ?>">
                                <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                              </a>
                            </div>
                          <?php }?>
                        </div>
                      </div>
                    </div>
                    <div class="sparkline8-graph">
                      <div class="static-table-list">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Nomor Surat</th>
                              <th>Jenis Surat</th>
                              <th>Masa Berlaku</th>
                              <th>File</th>
                              <th>Keterangan</th>
                            </tr>
                          </thead>
                          <?php foreach ($datSur as $key){ ?>
                          <tbody>
                            <tr>
                              <td><?php echo $key->no_surat; ?></td>
                              <td><?php echo $key->nama_surat; ?></td>
                              <td><?php echo date('d M Y', strtotime($key->tgl_mulai)); echo " - "; echo date('d M Y', strtotime($key->tgl_akhir)); ?></td>
                              <td>
                              <?php if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d', strtotime($key->tgl_akhir))) && strtotime(date('Y-m-d')) > strtotime(date('Y-m-d', strtotime($key->tgl_mulai)))){ ?>
                          <i class="fa fa-check"></i> Surat Aktif 
                        <?php }elseif(strtotime(date('Y-m-d', strtotime($key->tgl_mulai))) >= strtotime(date('Y-m-d'))){ ?>
                          <i class="fa fa-check"></i> Belum Aktif
                        <?php }elseif(strtotime(date('Y-m-d', strtotime($key->tgl_akhir))) <= strtotime(date('Y-m-d'))){ ?>
                          <i class="fa fa-times"></i> Kadaluarsa 
                        <?php } ?>
                              </td>
                              <td>
                              <?php if($key->file != ""){ ?>
                                <i class="fa fa-check"></i> File Ada
                              <?php }else{ ?>
                                <i class="fa fa-times"></i> File Kosong 
                              <?php } ?>
                              </td>
                            </tr>
                          </tbody>
                          <?php } ?>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-tab-list tab-pane fade" id="dataSeleksi">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <form action="<?php echo site_url(); ?>/adminPelamar/editDataSel/" method="POST" enctype="multipart/form-data" >
                      <?php foreach ($datSel as $key){ ?>
                      <table width="100%">
                        
                        <tr>
                          <td width="20%"><label form-control-label>Profesi yang dipilih</label></td>
                          <td style="height: 50px" width="80%">
                            <div class="col-lg-12">
                              <input type="text" class="form-control" value="<?php echo $key->id_profesi; ?>" style="width:100%" disabled>
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td width="20%"><label form-control-label>ID Seleksi</label></td>
                          <td style="height: 50px" width="80%">
                            <div class="col-lg-12">
                              <input name="idSel" type="text" class="form-control" value="<?php echo $key->id_seleksi; ?>" style="width:100%" disabled>
                              <input name="idSel" type="hidden" class="form-control" value="<?php echo $key->id_seleksi; ?>" style="width:100%">
                            </div>
                          </td>
                        </tr>

                        <tr>
                          <td><label form-control-label>Tanggal</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <?php if ($key->tgl_seleksi == "0000-00-00"){ ?>
                                <font color="red" size="2">*Masukkan tanggal untuk tes tulis dan wawancara</font>
                              <?php } elseif (($key->nilai_wawancara >=60 && $key->nilai_kompetensi >=60) && $wawa->tanggal == $key->tgl_seleksi && $key->tes_psikologi == "-" ) {?>
                                <font color="red" size="2">*Masukkan tanggal untuk tes psikologi</font>
                              <?php } elseif (($key->nilai_wawancara >=60 && $key->nilai_kompetensi >= 60) && $wawa->tanggal != $key->tgl_seleksi && $key->tes_psikologi == "-" ) {?>
                              <?php } elseif ($key->tes_psikologi >=60 && $psiko->tanggal == $key->tgl_seleksi) {?>
                                <font color="red" size="2">*Masukkan tanggal untuk tes agama</font>
                              <?php } elseif ($key->nilai_agama >=60 && $baca->tanggal == $key->tgl_seleksi) {?>
                                <font color="red" size="2">*Masukkan tanggal untuk tes kesehatan</font>
                              <?php } ?>
                              <input name="tgl" type="date" class="form-control" value="<?php echo $key->tgl_seleksi; ?>">
                            </div>
                          </td>
                        </tr>

                        <input name="idKSel" type="hidden" class="form-control" value="<?php echo $key->id_karyawan; ?>">

                        <?php if (isset($tulis->hasil)){ ?>
                          <tr>
                            <td><label form-control-label>Tes Tulis</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <?php if ($tulis->hasil == "-") { ?>
                                  <input name="tulis" type="text" class="form-control" placeholder="Persentase hasil tes tulis" >
                                <?php } else { ?>
                                  <input name="tulis" type="text" class="form-control" value="<?php echo $tulis->hasil;?>" >
                                <?php } ?>
                              </div>
                            </td>
                          </tr>
                        <?php }else{?>
                          <input name="tulis" type="hidden" class="form-control" value="<?php echo $semua->nilai_kompetensi;?>" >
                        <?php }?>
                        <?php if ($key->nilai_kompetensi >= 60) { ?>
                          <tr>
                            <td><label form-control-label>Nilai Wawancara</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <?php if ($wawa->hasil == "-") { ?>
                                  <input name="wawancara" type="text" class="form-control" placeholder="Persentase hasil tes wawancara" >
                                <?php } else { ?>
                                  <input name="wawancara" type="text" class="form-control" value="<?php echo $wawa->hasil;?>" >
                                <?php } ?>
                              </div>
                            </td>
                          </tr>
                          <?php } else {?>
                            <input name="wawancara" type="hidden" class="form-control" value="<?php echo $semua->nilai_wawancara;?>" >
                          <?php }?>
                          <?php if (isset($psiko->hasil)) { ?>
                            <tr>
                              <td><label form-control-label>Tes Psikologi</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($psiko->hasil == "-") { ?>
                                    <input name="psikologi" type="text" class="form-control" placeholder="Persentase hasil tes Psikologi" >
                                  <?php } else { ?>
                                    <input name="psikologi" type="text" class="form-control" value="<?php echo $psiko->hasil;?>" >
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } else { ?>
                            <input name="psikologi" type="hidden" class="form-control" value="<?php echo $key->tes_psikologi;?>" >
                          <?php } ?>

                          <?php if (isset($shalat->hasil)) { ?>
                            <tr>
                              <td><label form-control-label>Tes Shalat</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($shalat->hasil == "-") { ?>
                                    <input name="shalat" type="text" class="form-control" placeholder="Persentase hasil tes Shalat" >
                                  <?php } else { ?>
                                    <input name="shalat" type="text" class="form-control" value="<?php echo $shalat->hasil;?>" >
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } else { ?>
                            <input name="shalat" type="hidden" class="form-control" value="<?php echo $key->nilai_agama;?>" >
                          <?php } ?>

                          <?php if (isset($baca->hasil)) { ?>
                            <tr>
                              <td><label form-control-label>Tes Baca Al-Qur'an</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($baca->hasil == "-") { ?>
                                    <input name="baca" type="text" class="form-control" placeholder="Persentase hasil tes Baca Al-Qur'an" >
                                  <?php } else { ?>
                                    <input name="baca" type="text" class="form-control" value="<?php echo $baca->hasil;?>" >
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } else { ?>
                            <input name="baca" type="hidden" class="form-control" value="<?php echo $key->nilai_agama;?>" >
                          <?php } ?>

                          <?php if (isset($doa->hasil)) { ?>
                            <tr>
                              <td><label form-control-label>Tes Doa Sehari-hari</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($doa->hasil == "-") { ?>
                                    <input name="doa" type="text" class="form-control" placeholder="Persentase hasil tes Doa Sehari-hari" >
                                  <?php } else { ?>
                                    <input name="doa" type="text" class="form-control" value="<?php echo $doa->hasil;?>" >
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } else { ?>
                            <input name="doa" type="hidden" class="form-control" value="<?php echo $key->nilai_agama;?>" >
                          <?php } ?>

                          <?php if (isset($bimbing->hasil)) { ?>
                            <tr>
                              <td><label form-control-label>Tes Membimbing Pasien</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($bimbing->hasil == "-") { ?>
                                    <input name="bimbing" type="text" class="form-control" placeholder="Persentase hasil tes Membimbing Pasien" >
                                  <?php } else { ?>
                                    <input name="bimbing" type="text" class="form-control" value="<?php echo $bimbing->hasil;?>" >
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } else { ?>
                            <input name="bimbing" type="hidden" class="form-control" value="<?php echo $key->nilai_agama;?>" >
                          <?php } ?>

                          <?php if (isset($sehat->hasil)) { ?>
                            <tr>
                              <td><label form-control-label>Tes Kesehatan</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($sehat->hasil == "-") { ?>
                                    <input name="kesehatan" type="text" class="form-control" placeholder="Persentase hasil tes Kesehatan" >
                                  <?php } else { ?>
                                    <input name="kesehatan" type="text" class="form-control" value="<?php echo $sehat->hasil;?>" >
                                  <?php } ?>
                                </div>
                              </td>
                            </tr>
                          <?php } else { ?>
                            <input name="kesehatan" type="hidden" class="form-control" value="<?php echo $key->tes_kesehatan;?>" >
                          <?php } ?>
                          
                          <?php if ($key->nilai_agama >= 60 || $key->tes_kesehatan >= 60) { ?>                                                  
                            <tr>
                              <td><label form-control-label>Dokumen ppa</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <font color="red" size="2">*Format dokumen harus dalam bentuk jpg/png. Ukuran file maksimal adalah 2MB </font>
                                  <div class="input-mark-inner">
                                    <div class="file-upload-inner ts-forms">
                                      <div class="input prepend-big-btn">
                                        <label class="icon-right" for="prepend-big-btn"> <i class="fa fa-download"></i> </label>
                                          <div class="file-button">  Browse
                                            <input type="file" name="file" value="" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                          </div>
                                        <input type="text" id="prepend-big-btn" placeholder="no file selected">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2"><br>
                                <?php if ($key->tes_ppa != "-") { ?>
                              <div align="center">
                                <img width="80%" src="<?php echo base_url()?>Assets/dokumen/<?php echo $key->tes_ppa;?>" alt="" />
                              </div>
                            <?php }?>
                              </td>
                            </tr>
                          <?php }?>                          
                      </table>
                    <?php }?><br>
                    <?php if ($semua->tgl_seleksi == "0000-00-00") { ?>
                      <div align="center">
                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Update">
                    </div>
                  </form>
                  <?php }if (isset($tulis->hasil)) {
                    if ($tulis->hasil != "-" && $semua->nilai_kompetensi == "-"){
                      $hasilnya = $tulis->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Tulis/lulus/').$hasilnya."/".$wawa->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Tulis/stop/').$hasilnya."/".$wawa->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($wawa->hasil)) {
                    if ($wawa->hasil != "-" && $semua->nilai_wawancara == "-"){
                      $hasilnya = $wawa->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Wawancara/lulus/').$hasilnya."/".$tulis->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Wawancara/stop/').$hasilnya."/".$tulis->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($psiko->hasil)) {
                    if ($psiko->hasil != "-" && $semua->tes_psikologi == "-"){
                      $hasilnya = $psiko->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Psikologi/lulus/').$hasilnya."/".$psiko->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Psikologi/stop/').$hasilnya."/".$psiko->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($baca->hasil)) {
                    if ($baca->hasil != "-" && $semua->nilai_agama == "-"){
                      $hasilnya = $baca->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Baca/lulus/').$hasilnya."/".$baca->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Baca/stop/').$hasilnya."/".$baca->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($sehat->hasil)) {
                    if ($sehat->hasil != "-" && $semua->tes_kesehatan == "-"){
                      $hasilnya = $sehat->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Kesehatan/lulus/').$hasilnya."/".$sehat->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('adminPelamar/lanjutt/Kesehatan/stop/').$hasilnya."/".$sehat->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>
                  <?php }else{ ?>
                    <div align="center">
                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Update">
                    </div>
                  </form>
                  <?php } ?>


                  <?php }else{ ?>
                    <div align="center">
                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Update">
                    </div>
                  </form>
                  <?php } ?>


                  <?php }else{ ?>
                    <div align="center">
                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Update">
                    </div>
                  </form>
                  <?php } ?>


                  <?php }else{ ?>
                    <div align="center">
                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Update">
                    </div>
                  </form>
                  <?php } ?>


                  <?php }else{ ?>
                    <div align="center">
                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Update">
                    </div>
                  </form>
                  <?php }} ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>




<?php $this->load->view('./footer'); ?>