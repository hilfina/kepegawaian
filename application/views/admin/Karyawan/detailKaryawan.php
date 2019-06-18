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
                <li><a href="<?php echo site_url('adminKaryawan/Karyawan') ?>">Data Karyawan</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Detail Karyawan</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="single-pro-review-area mt-t-30 mg-b-15">
  <div class="container-fluid">
    <div class="row">
      <?php foreach ($datDir as $key){ ?>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
          <div class="profile-info-inner">
            <div class="profile-img">
              <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto?>" alt=""/>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
        <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
          <ul id="myTabedu1" class="tab-review-design">
            <li class="active"><a href="#dataPribadi">Data Pribadi</a></li>
            <li><a href="#penilaian">Penilaian</a></li>
            <li><a href="#karir">Jenjang Karir</a></li>
            <li><a href="#absensi">Absensi</a></li>
          </ul>
          <div id="myTabContent" class="tab-content custom-product-edit">
            <div class="product-tab-list tab-pane fade active in" id="dataPribadi">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <?php foreach ($datDir as $key){ ?>
                      <form action="<?php echo site_url();?>/adminKaryawan/editData/<?php echo $key->id_karyawan ;?>" method="POST">
                        <table width="100%">
                          <tr>
                            <td width="20%"><label form-control-label>Nomor Induk</label></td>
                            <td style="height: 50px" width="80%">
                              <div class="col-lg-12">
                                <input name="nik" type="text" class="form-control" value="<?php echo $key->nik; ?>" style="width:100%">
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
                            <td><label form-control-label>Nomor BPJS</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <input name="no_bpjs" type="text" class="form-control" value="<?php echo $key->no_bpjs; ?>">
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
                            <td><label form-control-label>Tanggal Lahir</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                              <div class="input-daterange input-group" id="datepicker">
                                <?php if ($key->ttl != "0000-00-00") { ?>
                                 <input name="ttl" type="text" class="form-control" value="<?php echo date('Y/m/d', strtotime($key->ttl));?>">
                                <?php }else{ ?>
                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <div class="input-daterange input-group" id="datepicker">
                                      <input type="text" class="form-control" name="ttl" />
                                    </div>
                                  </div>
                                <?php }?>
                              </div>
                              </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Jenis Kelamin</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <select  class="form-control" name="jenkel">
                              <option><?php echo $key->jenkel;?></option>
                                <option>---Pilih: -----</option>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                              </select>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Status Perkawinan</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <select  class="form-control" name="status">
                                <?php if ($key->status == "") {
                                  echo "<option> -- Pilihan -- </option>";
                                }else{ ?>
                                  <option><?php echo $key->status;?></option>
                                <?php } ?>
                                <option>Sudah Menikah</option>
                                <option>Belum Menikah</option>
                                <option>Janda</option>
                                <option>Duda</option>
                              </select>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Jumlah Anak</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <select  class="form-control" name="anak">
                                <?php if ($key->anak == "") {
                                  echo "<option> -- Pilihan -- </option>";
                                }else{ ?>
                                  <option><?php echo $key->anak;?></option>
                                <?php } ?>
                                <option>Tidak Ada</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>Lebih dari 3</option>
                              </select>
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
                          </table>
                          <table width="100%">
                          <div class="skill-title"> <br>
                          <h2>Data Profesi</h2> <hr />
                          </div>                    
                          <tr>
                            <td><label form-control-label>Profesi</label></td>
                            <td style="height: 50px">                              
                              <div class="col-lg-12">
                                <font color="red" size="2">*profesi, status kepegawaian, golongan dan penempatan dapat diubah sesuai kehendak HRD</font>
                                <select  class="form-control" name="id_profesi">
                                  <option><?php echo $key->nama_profesi; ?></option>
                                  <option>Pilihan Lainnya:</option>
                                  <?php foreach ($array as $key2) { ?>
                                    <option><?php echo $key2->nama_profesi; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Status Kepegawaian</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <select  class="form-control" name="id_status">
                                  <option><?php echo $key->id_status; ?></option>
                                  <option>Pilihan Lainnya:</option>
                                  <?php foreach ($datSta as $key3) { ?>
                                    <option><?php echo $key3->id_status; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Jabatan</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <select  class="form-control" name="jabatan">
                              <option><?php echo $key->jabatan;?></option>
                                <option>---Pilih: -----</option>
                                <?php foreach ($datJab as $jab) { ?>
                                  <option><?php echo $jab->jabatan; ?></option>
                                  <?php } ?>
                              </select>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Golongan</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <select  class="form-control" name="id_golongan">
                                  <option><?php echo $key->id_golongan; ?></option>
                                  <option>Pilihan Lainnya:</option>
                                  <?php foreach ($datGol as $key4) { ?>
                                    <option><?php echo $key4->id_golongan; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Penempatan</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <input name="ruangan" type="text" class="form-control" value="<?php echo $key->ruangan; ?>">
                              </div>
                            </td>
                          </tr>
                        </table><br>

                        <div class="skill-title"> <br>
                          <h2>Data login</h2> <hr />
                        </div>
                        <table width="100%">
                          <tr>
                            <td width="20%"><label form-control-label>Username</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <?php foreach ($log as $key123) {?>
                                <input name="username" type="text" class="form-control" value="<?php echo $key123->username; ?>">
                              <?php break; } ?>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Password</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <?php foreach ($log as $key123) {?>
                                <input name="password" type="text" class="form-control" value="<?php echo $key123->password; ?>">
                              <?php break; } ?>
                              </div>
                            </td>
                          </tr>   
                        </table>
                        <br>
                        <div align="left">
                          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
                        </div>
                      </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="product-tab-list tab-pane fade" id="penilaian">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                  <div class="row mg-b-15">
                    <div class="col-lg-12">
                      <div class="col-lg-6">
                        <div class="sparkline13-hd">
                          <div class="main-sparkline13-hd">
                            <h1>Penilaian<span class="table-project-n"> Karyawan</span></h1>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="sparkline13-hd">
                          <div class="main-sparkline13-hd">
                            <div align="right">
                            <a href="<?php echo site_url(); echo "/adminKaryawan/addnilai/";  echo $id ; ?>">
                              <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data Penilaian</button>
                            </a>
                            <a href="<?php echo site_url(); echo "/adminJP/laporan/";  echo $id ; ?>">
                              <button class="btn btn-primary waves-effect waves-light mg-b-15">Report Data</button>
                            </a>
                            </div>
                          </div>
                        </div>
                      </div> 
                    <br><br><hr/>
                    <div class="sparkline8-graph">
                      <div class="static-table-list">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Tanggal Penilaian</th>
                              <th>Penilai</th>
                              <th>Jenis Penilaian</th>
                              <th>Hasil</th>
                              <th>File Penilaian</th>
                              <th>Pilihan</th>
                            </tr>
                          </thead>
                          <?php $no=1;?>
                          <?php foreach ($datNil as $nilai){ ?>
                          <tbody>
                            <tr>
                              <td><?php echo $no++ ; ?></td>
                              <td><?php echo date('d M Y', strtotime($nilai->tanggal));?></td>
                              <?php $konek=mysqli_connect("localhost","root","","kepegawaian");
                              $x=mysqli_fetch_array(mysqli_query($konek, "select nama from karyawan where id_karyawan = $nilai->id_penilai")); ?>
                              <td><?php echo $x['nama'];?></td>
                              <td><?php echo $nilai->jenis;?></td>
                              <td><?php echo $nilai->hasil;?></td>
                              <td>
                                <?php if(($nilai->file) != NULL){ ?>
                                  <a href="<?php echo base_url().'/Assets/dokumen/'.$nilai->file; ?>" download>
                                    <button class="btn btn-default waves-effect" class='submit'><i class="fa fa-download" aria-hidden="true"></i> Unduh File</button>
                                  </a>
                                <?php }else{ ?>
                                  <font style="color: red">Tidak Ada file</font>
                                <?php } ?>
                              </td>
                              <td>
                                <a href="<?php echo site_url('adminKaryawan/editnilai/').$nilai->id; echo "/";echo $nilai->id_karyawan;?>">
                                  <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                </a>
                                <a href="<?php echo site_url('adminKaryawan/delnilai/').$nilai->id; echo "/";echo $nilai->id_karyawan; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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
                <div class="row mg-b-15">
                  <div class="col-lg-12">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="skill-title"> <br>
                          <h2>Penilaian Agama</h2> <hr />
                        </div>
                      </div>
                    </div>
                    <div class="sparkline8-graph">

                      <?php if ($agama != null) { 
                        $no = 1;?>
                        <div class="static-table-list">
                        <table class="table">
                          <thead>
                            <tr>
                              <td>No</td>
                              <td>Tanggal</td>
                              <td>Jenis Tes</td>
                              <td>Hasil</td>
                              <td>Pilihan</td>           
                            </tr>
                          </thead>
                          <?php foreach ($agama as $key){ ?>
                            <tbody>
                              <tr>
                                <td><?php echo $no++; ?></td>
                              <td><?php echo $key->tanggal; ?></td>
                              <td><?php echo $key->nama_tes; ?></td>
                              <td><?php echo $key->hasil; ?></td>
                              <td>
                                <a href="<?php echo site_url('adminKaryawan/editagama/').$key->id."/".$key->id_karyawan;?>">
                                  <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                </a>
                              </td>
                              </tr>
                            </tbody>
                          <?php } ?>
                        </table>
                      </div>
                      <?php }else{ ?>
                        <form action="<?php echo site_url();?>/adminKaryawan/addAgama/<?php echo $id; ?>" enctype="multipart/form-data" method="POST">
                          <table width="100%">
                          <tr><td colspan=2><h4 align="center"> Nilai Tes Shalat</h4></td></tr>
                          <tr>
                            <td><label form-control-label>Tanggal Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                  <div class="input-daterange input-group" id="datepicker">
                                    <input name="tanggal_agama" type="text" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Hasil Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <input name="hasil_agama" type="text" class="form-control">
                              </div>
                            </td>
                          </tr>
                          <tr><td colspan=2><h4 align="center"> Nilai Tes Doa Sehari-hari</h4></td></tr>
                          <tr>
                            <td><label form-control-label>Tanggal Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                  <div class="input-daterange input-group" id="datepicker">
                                    <input name="tanggal_doa" type="text" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Hasil Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <input name="hasil_doa" type="text" class="form-control">
                              </div>
                            </td>
                          </tr>
                          <tr><td colspan=2><h4 align="center"> Nilai Tes Membimbing Pasien</h4></td></tr>
                          <tr>
                            <td><label form-control-label>Tanggal Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                  <div class="input-daterange input-group" id="datepicker">
                                    <input name="tanggal_bimbing" type="text" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Hasil Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <input name="hasil_bimbing" type="text" class="form-control">
                              </div>
                            </td>
                          </tr>
                          <tr><td colspan=2><h4 align="center"> Nilai Tes Baca Al-Quran</h4></td></tr>
                          <tr>
                            <td><label form-control-label>Tanggal Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                  <div class="input-daterange input-group" id="datepicker">
                                    <input name="tanggal_baca" type="text" class="form-control">
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Hasil Tes</label></td>
                            <td style="height: 50px; width: 80%">
                              <div class="col-lg-12">
                                <input name="hasil_baca" type="text" class="form-control">
                              </div>
                            </td>
                          </tr>
                        </table>
                        <div align="center">
                          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
                        </div>
                      </form>
                    <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
            <div class="product-tab-list tab-pane fade" id="karir">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <div class="col-lg-12">
                      <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                        </div>
                      </div>
                    </div>
                    <div class="sparkline8-graph">
                      <div class="static-table-list">
                        <table class="table">
                          <thead>
                              <tr>
                                <th>Tanggal</th>
                                <th>Aktivitas</th>
                              </tr>
                          </thead>
                          
                          <tbody>
                            <?php foreach ($rPenempatan as $key) { ?>
                              <tr>
                                <td><?php echo date('d M Y', strtotime($key->mulai)); ?></td>
                                <td>Dilakukan rotasi, dan ditempatkan di <?php echo $key->ruangan ?></td>
                              </tr>
                            <?php } ?>
                            <?php foreach ($rGolongan as $key) { ?>
                              <tr>
                                <td><?php echo date('d M Y', strtotime($key->mulai)); ?></td>
                                <td>Lulus Tes Kenaikan Golongan, dan Golongan menjadi <?php echo $key->id_golongan ?></td>
                              </tr>
                            <?php } ?>
                            <?php foreach ($rStatus as $key) { ?>
                              <tr>
                                <td><?php echo date('d M Y', strtotime($key->mulai)); ?></td>
                                <td>Status Karyawan Berubah, dan Menjadi Karyawan <?php echo $key->id_status ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-tab-list tab-pane fade" id="absensi">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <div class="col-lg-12">
                      <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                        </div>
                      </div>
                    </div>
                    <div class="sparkline8-graph">
                      <div class="static-table-list">
                      <?php $tgl = $this->mdl_admin->aKon($id);
                      if ($tgl->tgl != null) { //jika punya data kontrak
                        $sekarang = date('Y-m-d'); //tanggal sekarang
                        $dulu = date('Y-m-d', strtotime($tgl->tgl)); //tanggal karyawan mulai kontrak
                        //1 + (selisih tahun) * 12 -> karena 1 tahun = 12 bulan
                        $numBulan = 1 + (date("Y",strtotime($sekarang)) - date("Y",strtotime($dulu))) *12;
                        //total diatas + 
                        $numBulan += date("m",strtotime($sekarang)) - date("m",strtotime($dulu));

                        if ($dulu != "1970-01-01") {
                          
                        if ($numBulan <= 18) { //jika jarak bulan antara tanggal sekarang dengan awal karyawan tersebut mulai kontrak belum 18 bulan
                          echo "Belum dapat melakukan cuti karena belum 1,5 tahun dimasa kontrak.<hr><br>
                          <font size='2' color='red'>*hanya bisa menambahkan data surat ijin</font>";
                        }else{ //jika sudah 18 bulan
                          if ($cuti->kuota_cuti != NULL){ //berdasarkan profesi karyawan. jika profesi karyawan punya jatah cuti
                            if($cuti->kuota_cuti-$selisih < 0){
                              echo "<h3>Sisa Cuti Tidak Mencukupi </h3><hr>";
                            }else{
                              echo "<h3>Sisa Cuti : "; echo $cuti->kuota_cuti-$selisih." Hari</h3><hr>";
                            }
                          
                          }else{ //jika profesi tersebut tidak berhak cuti maka
                            echo "<h3>Karyawan Tidak Memiliki Jatah Cuti</h3>";
                          }
                        }
                        }else{
                          echo "<h3>Tanggal SK Kontrak Karyawan Belum ditentukan</h3>";
                        }
                      }else{ //jika tidak punya data kontrak berarti dia diinputkan langsung jadi magang/ yg lain
                        if ($cuti->kuota_cuti != NULL){ //jika karyawan 
                          if($cuti->kuota_cuti-$selisih < 0){
                              echo "<h3>Sisa Cuti Tidak Mencukupi </h3><hr>";
                            }else{
                              echo "<h3>Sisa Cuti : "; echo $cuti->kuota_cuti-$selisih." Hari</h3><hr>";
                            }
                          
                        }else{
                          echo "<h3>Karyawan Tidak Memiliki Jatah Cuti</h3>";
                        }
                      }
                      ?>
                      
                      </div>
                    </div>
                    <div class="sparkline8-graph">
                      <div class="static-table-list"><br>
                        <a href="<?php echo site_url('adminKaryawan/addCuti/').$id;?>">
                          <button class="btn btn-primary waves-effect waves-light mg-b-15" >Tambah Data Ijin</button>
                        </a>
                        <table class="table">
                          <thead>
                              <tr>
                                <th>Tanggal Absen</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Surat Ijin</th>
                                <th>Pilihan</th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($Dcuti as $Dcuti) { ?>
                              <tr>
                                <td><?php echo date('d M Y', strtotime($Dcuti->tgl_awal))." sampai ".date('d M Y', strtotime($Dcuti->tgl_akhir)); ?> </td>
                                <td><?php echo abs($Dcuti->selisih)." Hari"; ?> </td>
                                <td><?php echo $Dcuti->ket; ?> </td>
                                <td>
                                <?php if(($Dcuti->file) != NULL) {?>
                                  <font style="color: blue">
                                    <a href="<?php echo base_url().'/Assets/dokumen/'.$Dcuti->file; ?>" download>
                                      <button class="btn btn-default waves-effect" class='submit'>
                                        <i class="fa fa-download" aria-hidden="true"> Unduh File</i>
                                      </button>
                                    </a>
                                  </font>
                                  <?php }else{ ?>
                                    <font style="color: red">Tidak Ada file</font>
                                  <?php } ?>
                                </td>
                                <td>
                                  <a href="<?php echo site_url('adminKaryawan/editCuti/').$Dcuti->id; echo "/";echo $Dcuti->id_karyawan;?>">
                                  <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                </a>
                                </td>
                              </tr>
                            <?php } ?>
                          </tbody>
                        </table>
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
  </div>
</div>
<br>
<?php $this->load->view('./footer'); ?>