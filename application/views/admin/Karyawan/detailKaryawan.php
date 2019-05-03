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
            <li><a href="#dataPendidikan"> Data Pendidikan</a></li>
            <li><a href="#dataSurat">Data Surat</a></li>
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
                            <td><label form-control-label>TTL</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <input name="ttl" type="text" class="form-control" value="<?php echo $key->ttl;?>">
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
                            <td><label form-control-label>Username</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <?php foreach ($log as $key123) {?>
                                <input name="username" type="text" class="form-control" value="<?php echo $key123->username; ?>">
                              <?php } ?>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><label form-control-label>Password</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                              <?php foreach ($log as $key123) {?>
                                <input name="password" type="password" class="form-control" value="<?php echo $key123->password; ?>">
                              <?php } ?>
                              </div>
                            </td>
                          </tr>
                        
                          <tr>
                            <td><label form-control-label>Profesi</label></td>
                            <td style="height: 50px">
                              <font color="red" size="2">*data profesi, status kepegawaian, golongan dan penempatan dapat diubah sesuai kehendak HRD</font>
                              <div class="col-lg-12">
                                <select  class="form-control" name="id_profesi">
                                  <option><?php echo $key->nama_profesi; ?></option>
                                  <option><strong>Pilihan Lainnya:</strong></option>
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
                                  <option><strong>Pilihan Lainnya:</strong></option>
                                  <?php foreach ($datSta as $key3) { ?>
                                    <option><?php echo $key3->id_status; ?></option>
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
                                  <option><strong>Pilihan Lainnya:</strong></option>
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
                        <div align="center">
                          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
                        </div>
                      </form>
                    <?php } ?>
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
                            <div align="right">
                              <a href="<?php echo site_url(); echo "/adminKaryawan/addPend/";  echo $key->id_karyawan ; ?>">
                                <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                              </a></div>
                          <?php }?>
                        </div>
                      </div>
                    </div>
                    <div class="sparkline8-graph">
                      <div class="static-table-list">
                        <table class="table">
                          <tr>
                            <th>Institusi</th>
                            <th>Jurusan</th>
                            <th>N A</th>
                            <th>Tahun</th>
                            <th>No Ijasah</th>
                            <th>Ver</th>
                            <th>Setting</th>
                          </tr>
                          <?php foreach ($datPen as $key){ ?>
                            <tr>
                              <td><?php echo $key->pendidikan; ?></td>
                              <td><?php echo $key->jurusan; ?></td>
                              <td><?php echo $key->nilai; ?></td>
                              <td><?php echo $key->mulai; echo " - "; echo $key->akhir; ?></td>
                              <td><?php echo $key->nomor_ijazah; ?></td>
                                
                              <td>
                                <?php if(($key->verifikasi) == 1){ ?>
                                  <i class="fa fa-check" style="color: red" title="TELAH TERVERIFIKASI"></i>
                                <?php }else{ ?>
                                  <a href="<?php echo site_url(); echo "/adminKaryawan/verPend/"; echo $key->id;echo "/";echo $key->id_karyawan; ?>">
                                    <button class="btn btn-success waves-effect mg-b-15"><i class="fa fa-check"></i></i></button>
                                  </a>
                                <?php } ?>
                              </td>   
                              <td>
                                <a href="<?php echo site_url('adminKaryawan/editpend/').$key->id ?>">
                                  <button data-toggle="tooltip" title="Edit / Detail" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                </a>
                                <a href="<?php echo site_url('adminKaryawan/delpend/').$key->id; echo "/";echo $key->id_karyawan; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                  <button data-toggle="tooltip" title="Delete" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </a>
                              </td>
                            </tr>
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
                          <div align="right"><a href="<?php echo site_url(); echo "/adminKaryawan/addSurat/";  echo $key->id_karyawan ; ?>">
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
                                <th>Jenis Surat</th>
                                <th>Nomor Surat</th>
                                <th>Gambar</th>
                                <th>Masa Berlaku</th>
                                <th>Keterangan</th>
                                <th>Setting</th>
                              </tr>
                          </thead>
                          <?php foreach ($datSur as $key){ ?>
                          <tbody>
                            <tr>
                              <td><?php echo $key->nama_surat; ?></td>
                              <td><?php echo $key->no_surat; ?></td>
                              <td align="left">
                                <div class="zoomimage">
                                  <?php echo "<img src='".base_url("./assets/dokumen/".$key->file)."' width='75' height='75'>"; ?>
                                </div>
                              </td>
                              <td><?php echo date('d M Y', strtotime($key->tgl_mulai))." <b> - </b> ".date('d M Y', strtotime($key->tgl_akhir)); ?></td>
                              <td>
                              <?php if(strtotime(date('Y-m-d')) < strtotime(date('Y-m-d', strtotime($key->tgl_akhir))) && strtotime(date('Y-m-d')) > strtotime(date('Y-m-d', strtotime($key->tgl_mulai)))){ ?>
                                <i class="fa fa-check"></i> Surat Aktif 
                              <?php }elseif(strtotime(date('Y-m-d', strtotime($key->tgl_mulai))) >= strtotime(date('Y-m-d'))){ ?>
                                <i class="fa fa-times"></i> Belum Aktif
                              <?php }elseif(strtotime(date('Y-m-d', strtotime($key->tgl_akhir))) <= strtotime(date('Y-m-d'))){ ?>
                                <i class="fa fa-times"></i> Kadaluarsa 
                              <?php } ?>
                              </td>
                              <td>
                                <a href="<?php echo site_url('adminKaryawan/editsurat/').$key->id_sipstr ?>">
                                  <button data-toggle="tooltip" title="Edit / Detail" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                </a>
                                <a href="<?php echo site_url('adminKaryawan/delsurat/').$key->id_sipstr; echo "/";echo $key->id_karyawan; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<?php $this->load->view('./footer'); ?>