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
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Data Pelamar</a> <span class="bread-slash">/</span>
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
          <?php foreach ($datDir as $key){ ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="profile-info-inner">
                <div class="profile-img">
                  <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto?>" alt=""/>
                </div><br>
                <div align="center">
                  <?php if ($key->id_status == "Pelamar" && $key->id_profesi != "Belum") { ?>
                        <a href="<?php echo site_url(); echo "/admin/pelamarDiterima/";  echo $key->id_karyawan ; ?>">
                          <button class="btn btn-success waves-effect mg-b-15" title="TERIMA"><i class="fa fa-check"></i> Terima </button>
                        </a>
                        <a href="<?php echo site_url(); echo "/admin/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                          <button class="btn btn-danger waves-effect mg-b-15" title="TOLAK"><i class="fa fa-times"></i> Tolak</button>
                        </a>
                      <?php } else{}?>
                </div>
              </div>
            </div>
          <?php } ?>
            

            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                <ul id="myTabedu1" class="tab-review-design">
                  <li class="active"><a href="#dataPribadi">Data Pribadi</a></li>
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
                                 <form action="<?php echo site_url();?>/admin/editDataPel/<?php echo $key->id_karyawan ;?>" method="POST">
                                   <?php foreach ($datDir as $key){ ?>
                                  <table width="100%">
                                      <tr>
                                        <td width="20%"><label form-control-label">Nomor Pelamar</label></td>
                                        <td style="height: 50px" width="80%">
                                          <div class="col-lg-12">
                                            <input name="id_karyawan" type="text" class="form-control" value="<?php echo $key->id_karyawan; ?>" style="width:100%">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nomor KTP</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="no_ktp" type="text" class="form-control" value="<?php echo $key->no_ktp; ?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nama Lengkap</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="nama" type="text" class="form-control" value="<?php echo $key->nama;?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Alamat</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="alamat" type="text" class="form-control" value="<?php echo $key->alamat;?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nomor Telepon</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="no_telp" type="text" class="form-control" value="<?php echo $key->no_telp; ?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Email</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="email" type="text" class="form-control" value="<?php echo $key->email; ?>">
                                          </div>
                                        </td>
                                      </tr>
                                    </table><br>
                                    <div align="center">
                                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
                                    </div>
                                 <?php } ?>
                                 </form>
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
                                        <div align="right"><a href="<?php echo site_url(); echo "/admin/addPend/";  echo $key->id_karyawan ; ?>">
                                          <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                                        </a></div>
                                      <?php }?>
                                      </div>
                                    </div>
                                  </div>
                                    <div class="sparkline8-graph">
                                      <div class="static-table-list">
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                    <th>Gambar</th>
                                                    <th>Institusi</th>
                                                    <th>Jurusan</th>
                                                    <th>Tahun Pendidikan</th>
                                                    <th>No Ijasah</th>
                                                    <th>Verifikasi</th>
                                                  </tr>
                                              </thead>
                                              <?php foreach ($datPen as $key){ ?>
                                              <tbody>
                                                  <tr>
                                                      <td>
                                                         <a  href="" data-toggle="modal" data-target="#gambarIjasah"><?php echo "<img src='".base_url("./assets/gambar/".$key->file)."' width='100' height='100'>"; ?></a>
                                                         <div id="gambarIjasah" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-close-area modal-close-df">
                                                                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <div class="profile-info-inner">
                                                                      <div class="profile-img">
                                                                        <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->file;?>" alt=""/>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                        </div>        
                                                      </td>
                                                      <td><?php echo $key->pendidikan; ?></td>
                                                      <td><?php echo $key->jurusan; ?></td>
                                                      <td><?php echo $key->mulai; echo " - "; echo $key->akhir; ?></td>
                                                      <td><?php echo $key->nomor_ijazah; ?></td>
                                                      
                                                      <td>
                                                        <?php 
                                                      if(($key->verifikasi) == 1){ ?>
                                                       <a href="#"> Terverifikasi</a>
                                                       <?php }else{ ?>
                                                        <a href="<?php echo site_url(); echo "/admin/verPend/";  echo $key->id;echo "/";echo $key->id_karyawan; ?>">
                                                          <button class="btn btn-success waves-effect mg-b-15"><i class="fa fa-check"></i> Verifikasi</button>
                                                        </a>
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
                    <div class="product-tab-list tab-pane fade" id="dataSurat">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                  <div class="col-lg-12">
                                    <div class="sparkline13-hd">
                                      <div class="main-sparkline13-hd">
                                         <?php foreach ($datDir as $key){?>
                                        <div align="right"><a href="<?php echo site_url(); echo "/admin/addSurat/";  echo $key->id_karyawan ; ?>">
                                          <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                                        </a></div>
                                      <?php }?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="sparkline8-graph">
                                      <div class="static-table-list">
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                    <th>Gambar</th>
                                                      <th>Jenis Surat</th>
                                                      <th>Nomor Surat</th>
                                                    <th>Masa Berlaku</th>
                                                  </tr>
                                              </thead>
                                              <?php foreach ($datSur as $key){ ?>
                                              <tbody>
                                                  <tr>
                                                    <td>
                                                      <a  href="#" data-toggle="modal" data-target="#gambarSurat"><?php echo "<img src='".base_url("./assets/gambar/".$key->file)."' width='100' height='100'>"; ?></a>
                                                         <div id="gambarSurat" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-close-area modal-close-df">
                                                                          <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                          <div class="profile-info-inner">
                                                                            <div class="profile-img">
                                                                              <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->file;?>" alt=""/>
                                                                            </div>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                              </div></td>
                                                      <td><?php echo $key->nama_surat; ?></td>
                                                      <td><?php echo $key->no_surat; ?></td>
                                                      <td><?php echo $key->tgl_mulai." Sampai ".$key->tgl_akhir; ?></td>
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
                                 <form action="<?php echo site_url(); ?>/admin/editDataSel/" method="POST">
                                 <?php foreach ($datSel as $key){ ?>
                                  <table width="100%">
                                    <?php foreach ($datDir as $dir) { ?>
                                      <tr>
                                        <td width="20%"><label form-control-label">Profesi yang dipilih</label></td>
                                        <td style="height: 50px" width="80%">
                                          <div class="col-lg-12">
                                            <input name="idSel" type="text" class="form-control" value="<?php echo $dir->id_profesi; ?>" style="width:100%" disabled>
                                          </div>
                                        </td>
                                      </tr>
                                    <?php } ?>
                                      <tr>
                                        <td width="20%"><label form-control-label">ID Seleksi</label></td>
                                        <td style="height: 50px" width="80%">
                                          <div class="col-lg-12">
                                            <input name="idSel" type="text" class="form-control" value="<?php echo $key->id_seleksi; ?>" style="width:100%" disabled>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Tanggal Wawancara</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="tglSel" type="date" class="form-control" value="<?php echo $key->tgl_seleksi; ?>">
                                          </div>
                                        </td>
                                      </tr>                                      
                                      <input name="idKSel" type="hidden" class="form-control" value="<?php echo $key->id_karyawan; ?>">
                                      <?php if ($key->tgl_seleksi != "0000-00-00"){ ?>
                                       <tr>
                                        <td><label form-control-label">Nilai Wawancara</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <?php if ($key->nilai_wawancara == "") { ?>
                                              <select name="nwSel" type="text" class="form-control">
                                              <option>-- Pilihan --</option>
                                              <option>Lulus</option>
                                              <option>Tidak Lulus</option>
                                            </select>
                                            <?php } else { ?>
                                              <input name="nwSel" type="text" class="form-control" value="<?php echo $key->nilai_wawancara;?>" >
                                            <?php } ?>
                                          </div>
                                        </td>
                                      </tr>
                                      <?php if ($key->nilai_wawancara == "Lulus") { ?>
                                        <tr>
                                          <td><label form-control-label">Tes Psikologi</label></td>
                                          <td style="height: 50px">
                                            <div class="col-lg-12">
                                              <?php if ($key->tes_psikologi == "") { ?>
                                                <select name="tpsSel" type="text" class="form-control">
                                                <option>-- Pilihan --</option>
                                                <option>Lulus</option>
                                                <option>Tidak Lulus</option>
                                              </select>
                                              <?php } else { ?>
                                                <input name="tpsSel" type="text" class="form-control" value="<?php echo $key->tes_psikologi;?>" >
                                              <?php } ?>
                                            </div>
                                          </td>
                                        </tr>
                                      <?php } else {} ?>
                                      <?php if ($key->tes_psikologi == "Lulus") { ?>
                                        <tr>
                                        <td><label form-control-label">Nilai Agama</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="naSel" type="text" class="form-control" value="<?php echo $key->nilai_agama;?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nilai Kompetensi</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="nkSel" type="text" class="form-control" value="<?php echo $key->nilai_kompetensi;?>" >
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Tes Kesehatan</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <?php if ($key->tes_kesehatan == "") { ?>
                                                <select name="tkSel" type="text" class="form-control">
                                                <option>-- Pilihan --</option>
                                                <option>Lulus</option>
                                                <option>Tidak Lulus</option>
                                              </select>
                                              <?php } else { ?>
                                                <input name="tkSel" type="text" class="form-control" value="<?php echo $key->tes_kesehatan;?>" >
                                              <?php } ?>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Tes PPA</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="tpSel" type="text" class="form-control" value="<?php echo $key->tes_ppa; ?>" >
                                          </div>
                                        </td>
                                      </tr>
                                      <?php } else {} }?>
                                    </table>
                                    <input name="" type="submit" class="form-control" value="Update">
                                 <?php } ?>
                                 </form>
                                </div>
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