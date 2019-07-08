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
                <li><a href="<?php echo site_url('adminKaryawan/Karyawan') ?>">Data Karyawan</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Detail Karyawan</span>
                </li>
              </ul>
            </div>
          </div>
          <br>
            <div class="alert alert-info"><b>Perhatian !</b><br>
                Pada data pribadi, karyawan hanya dapat mengubah foto profil saja.<br>
                ukuran foto profil maksimal 400x400, berformat jpg/png, tidak lebih dari 2 mb.
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <!-- Single pro tab review Start-->
  <div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
    <div class="container-fluid" role="alert">
        <?php if ($this->session->flashdata('msg_error')) :?>
          <div class="alert alert-danger alert-mg-b"> 
          <?php echo $this->session->flashdata('msg_error')?>
          </div>
        <?php endif; ?>
    </div>
      <form action="<?php echo site_url();?>/karyawan/updatedatasaya/" enctype="multipart/form-data"  method="POST">
        <div class="row">
            <?php foreach ($datDir as $key){ ?>
            <input type="hidden" name="gambar_old" value="<?php echo $key->foto; ?>">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="profile-info-inner">
                        <div class="profile-img">
                            <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto?>" alt="" width="120"/>
                        </div>
                        
                        <div class="file-upload-inner ts-forms">
                          <div class="input prepend-big-btn">
                              <label class="icon-right" for="prepend-big-btn">
                                <i class="fa fa-download"></i>
                              </label>
                              <div class="file-button">
                                  Browse
                                  <input type="file" name="fotosaya" value="<?php echo $key->foto; ?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                              </div>
                              <input type="text" id="prepend-big-btn" placeholder="no file selected">
                          </div>
                        </div>
                        <div class="profile-details-hr">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <h2><b><?php echo $key->nama; ?></b><br /> </h2>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
              <?php } ?>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                <ul id="myTabedu1" class="tab-review-design">
                  <li class="active"><a href="#dataPribadi">Data Pribadi</a></li>
                  <li><a href="#dataRiwayat"> Data Riwayat</a></li>
                  <li><a href="#dataMou"> Data MOU</a></li>
                  <li><a href="#dataUraian"> Uraian Tugas</a></li>
                  <li>
                </ul>
                <div id="myTabContent" class="tab-content custom-product-edit">
                    <div class="product-tab-list tab-pane fade active in" id="dataPribadi">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                <?php foreach ($datDir as $key){ ?>
                                  <input name="id_karyawan" type="hidden" class="form-control" value="<?php echo $key->id_karyawan; ?>" >
                                   
                                  <table width="100%">
                                      <tr>
                                        <td width="20%"><label form-control-label>Nomor Induk</label></td>
                                        <td style="height: 50px" width="80%">
                                          <div class="col-lg-12">
                                            <input name="nik" type="text" class="form-control" value="<?php echo $key->nik; ?>" style="background-color: white ">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Nomor KTP</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="no_ktp" type="text" class="form-control" value="<?php echo $key->no_ktp; ?>" style="background-color: white ">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Nomor BPJS</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input name="no_bpjs" type="text" class="form-control" value="<?php echo $key->no_bpjs; ?>" style="background-color: white ">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Nama Lengkap</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="nama" type="text" class="form-control" value="<?php echo $key->nama;?>">
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
                                        <td><label form-control-label>Jenis kelamin</label></td>
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
                                        <td><label form-control-label>Alamat</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="alamat" type="text" class="form-control" value="<?php echo $key->alamat;?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Nomor Telepon</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="no_telp" type="text" class="form-control" value="<?php echo $key->no_telp; ?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Email</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="email" type="text" class="form-control" value="<?php echo $key->email; ?>">
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
                                    <br>
                                      <tr>
                                        <td><label form-control-label>Profesi</label></td>
                                        <td style="height: 50px">
                                         <font color="red" size="2">*profesi, status kepegawaian, golongan dan penempatan hanya dapat diubah sesuai kehendak HRD</font>
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="email" type="text" class="form-control" value="<?php echo $key->id_profesi; ?>" disabled>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Status Kepegawaian</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="id_status" type="text" class="form-control" value="<?php echo $key->id_status; ?>"  disabled>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Jabatan</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="jabatan" type="text" class="form-control" value="<?php echo $key->jabatan; ?>"  disabled>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Golongan</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="id_golongan" type="text" class="form-control" value="<?php echo $key->id_golongan; ?>" disabled>
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label>Penempatan</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input style="background-color: white " name="ruangan" type="text" class="form-control" value="<?php echo $key->ruangan; ?>" disabled>
                                          </div>
                                        </td>
                                      </tr>
                                    </table><br>
                                    <div align="right">
                                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
                                    </div>
                                 <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab-list tab-pane fade" id="dataRiwayat">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                <div class="panel-group edu-custon-design" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#11">Riwayat Penempatan
                                          </a>
                                        </h4>
                                    </div>
                                    <div id="11" class="panel-collapse panel-ic collapse in">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar riwayat unit yang pernah anda tempati.</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nama Ruangan</th>
                                                            <th>Tanggal Bertugas</th>
                                                            <th>Tanggal Akhir Bertugas</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($datRi as $key){ ?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->ruangan; ?></td>
                                                              <td><?php echo $key->mulai; ?></td> 
                                                              <td><?php echo $key->akhir; ?></td> 
                                                          </tr>
                                                      </tbody>
                                                      <?php } ?>
                                                  </table>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#22">
                                            Riwayat Status</a>
                                        </h4>
                                    </div>
                                    <div id="22" class="panel-collapse panel-ic collapse">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar riwayat status pekerjaan anda</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor SK</th>
                                                            <th>Status Karyawan</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Status Keaktifan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($stat as $key){ ?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->nomor_sk?></td>
                                                              <td><?php echo $key->id_status?></td>
                                                              <td><?php echo $key->mulai?></td>  
                                                              <td><?php echo $key->akhir?></td>
                                                              <td>
                                                              <?php if(($key->aktif) == 1){ ?>
                                                                <b><i class="fa fa-check"></i> Aktif</b> 
                                                              <?php }else{ ?>
                                                                <b style="color: red">Belum Aktif</b>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#33">
                                         Riwayat Golongan</a>
                                        </h4>
                                    </div>
                                    <div id="33" class="panel-collapse panel-ic collapse">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar riwayat golongan karyawan anda.</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor SK</th>
                                                            <th>Status Golongan</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Status Keaktifan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($gol as $key){ ?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->nomor_sk?></td>
                                                              <td><?php echo $key->id_golongan?></td>
                                                              <td><?php echo $key->mulai?></td>  
                                                              <td><?php echo $key->akhir?></td>
                                                              <td>
                                                              <?php if(($key->aktif) == 1){ ?>
                                                                <b><i class="fa fa-check"></i> Aktif</b> 
                                                              <?php }else{ ?>
                                                                <b style="color: red">Belum Aktif</b>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#44">
                                         Riwayat Berkala</a>
                                        </h4>
                                    </div>
                                    <div id="44" class="panel-collapse panel-ic collapse">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar riwayat berkala karyawan anda.</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor SK</th>
                                                            <th>Berkala</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Status Keaktifan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($ber as $key){?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->nomor_sk?></td>
                                                              <td><?php echo $key->berkala?></td>
                                                              <td><?php echo $key->mulai?></td>  
                                                              <td><?php echo $key->akhir?></td>
                                                              <td>
                                                                <?php if(($key->aktif) == 1){ ?>
                                                                <b><i class="fa fa-check"></i> Aktif</b> 
                                                                <?php }else{ ?>
                                                                  <b style="color: red">Belum Aktif</b>
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
                            </div>
                        </div>
                    </div>
                    <div class="product-tab-list tab-pane fade" id="dataMou">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="review-content-section">
                                <div class="panel-group edu-custon-design" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#1">MOU Pendidikan
                                          </a>
                                        </h4>
                                    </div>
                                    <div id="1" class="panel-collapse panel-ic collapse in">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar MOU Pendidikan anda.</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor MOU</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Nominal</th>
                                                            <th>Keterangan</th>
                                                            <th>Status Keaktifan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($mous as $key){?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->no_mou; ?></td>
                                                              <td><?php echo $key->tgl_mulai?></td>  
                                                              <td><?php echo $key->tgl_akhir?></td>
                                                              <td><?php echo $key->beasiswa;?></td>
                                                              <td><?php echo $key->ket?></td>
                                                              <td> 
                                                              <?php if(($key->aktif) == 1){ ?>
                                                                <b><i class="fa fa-check"></i> Aktif</b> 
                                                              <?php }else{ ?>
                                                                <b style="color: red">Belum Aktif</b>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#2">
                                            MOU Kontrak</a>
                                        </h4>
                                    </div>
                                    <div id="2" class="panel-collapse panel-ic collapse">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar MOU Kontrak kerja anda</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor MOU</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Nominal</th>
                                                            <th>Keterangan</th>
                                                            <th>Status Keaktifan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($mouk as $key){?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->no_mou; ?></td>
                                                              <td><?php echo $key->tgl_mulai?></td>  
                                                              <td><?php echo $key->tgl_akhir?></td>
                                                              <td><?php echo $key->gaji;?></td>
                                                              <td><?php echo $key->ket?></td>
                                                              <td> 
                                                              <?php if(($key->aktif) == 1){ ?>
                                                                <b><i class="fa fa-check"></i> Aktif</b> 
                                                              <?php }else{ ?>
                                                                <b style="color: red">Belum Aktif</b>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#3">
                                         MOU Piutang</a>
                                        </h4>
                                    </div>
                                    <div id="3" class="panel-collapse panel-ic collapse">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar MOU Piutang anda.</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor MOU</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Nominal</th>
                                                            <th>Keterangan</th>
                                                            <th>Status Keaktifan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($mouh as $key){?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->no_mou; ?></td>
                                                              <td><?php echo $key->tgl_mulai?></td>  
                                                              <td><?php echo $key->tgl_akhir?></td>
                                                              <td><?php echo $key->nominal;?></td>
                                                              <td><?php echo $key->ket?></td>
                                                              <td> 
                                                              <?php if(($key->aktif) == 1){ ?>
                                                                <b><i class="fa fa-check"></i> Aktif</b> 
                                                              <?php }else{ ?>
                                                                <b style="color: red">Belum Aktif</b>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#4">
                                            MOU Klinis</a>
                                        </h4>
                                    </div>
                                    <div id="4" class="panel-collapse panel-ic collapse">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar MOU Klinis anda</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor MOU</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Keterangan</th>
                                                            <th>Status Keaktifan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($moui as $key){?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->no_mou; ?></td>
                                                              <td><?php echo $key->tgl_mulai?></td>  
                                                              <td><?php echo $key->tgl_akhir?></td>
                                                              <td><?php echo $key->ket?></td>
                                                              <td> 
                                                              <?php if(($key->aktif) == 1){ ?>
                                                                <b><i class="fa fa-check"></i> Aktif</b> 
                                                              <?php }else{ ?>
                                                                <b style="color: red">Belum Aktif</b>
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
                                <div class="panel panel-default">
                                    <div class="panel-heading accordion-head">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#5">
                                            MOU Pelatihan</a>
                                        </h4>
                                    </div>
                                    <div id="5" class="panel-collapse panel-ic collapse">
                                        <div class="panel-body admin-panel-content ">
                                        <p>Berisi daftar MOU Pelatihan anda</p>
                                            <div class="static-table-list">
                                                  <table class="table">
                                                      <thead>
                                                          <tr>
                                                            <th>No.</th>
                                                            <th>Nomor MOU</th>
                                                            <th>Tanggal Mulai</th>
                                                            <th>Tanggal Berakhir</th>
                                                            <th>Keterangan</th>
                                                          </tr>
                                                      </thead>
                                                      <?php $no=1; ?>
                                                      <?php foreach($moup as $key){?>
                                                      <tbody>
                                                          <tr>
                                                              <td><?php echo $no++;?></td>
                                                              <td><?php echo $key->no_mou; ?></td>
                                                              <td><?php echo $key->tgl_mulai?></td>  
                                                              <td><?php echo $key->tgl_akhir?></td>
                                                              <td><?php echo $key->ket?></td>

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
                </div>
            </div>   
                 <div class="product-tab-list tab-pane fade" id="dataUraian">
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="review-content-section">
                          <h4>Data Uraian Tugas</h4><br>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th width="100">Nomor</th>
                                    <th>Download File Uraian Tugas</th>
                                  </tr>
                                </thead>
                                <?php $no=1;?>
                                <?php foreach($urai as $abc){?>
                                <tbody>
                                  <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td>
                                      <a href="<?php echo base_url().'/Assets/dokumen/'.$abc->file_urgas; ?>" download>
                                          <?php echo $abc->file_urgas;?>
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
      </div>              
    </div>
  </form>
</div>
</div>
<br>




<?php $this->load->view('./footer'); ?>