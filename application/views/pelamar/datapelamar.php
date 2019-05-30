<?php $this->load->view('./header.php');
  $levelku=$this->session->userdata("myLevel");
  $idku=$this->session->userdata("myId");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
  $aktifku=$this->session->userdata("myAktif");
  $statusku=$this->session->userdata("myStatus");
  $profesiku=$this->session->userdata("myProfesi");
  $finalku=$this->session->userdata("myFinalisasi");?>
 <br>

<div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="#">Data Saya</a> <span class="bread-slash">/</span> </li>
                <li><span class="bread-blod"><?php echo $levelku;?></span> </li>
              </ul>
            </div>
          </div>
          <br>
          <div class="alert alert-info"><b>Perhatian !</b><br>
            Ukuran foto profil yang diupload berupa 3x4, berformat jpg/png, maksimal berukuran 2mb.
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
  <form action="<?php echo site_url(); ?>/pelamar/updatedatasaya/" enctype="multipart/form-data" method="post">
    <div class="row">
      <?php foreach ($datasaya as $key){ ?>
        <input type="hidden" name="gambar_old" value="<?php echo $key->foto; ?>">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <div class="profile-info-inner">
            <div class="profile-img">
              <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto?>" alt="" width="120"/>
            </div> <br>
            <div class="file-upload-inner ts-forms">
              <div class="input prepend-big-btn">
                <label class="icon-right" for="prepend-big-btn">
                  <i class="fa fa-download"></i>
                </label>
                <div class="file-button"> Browse
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
            <li><a href="#cv"> Curiculum Vitae</a></li>
          </ul>
          <?php foreach ($datasaya as $key) { ?>
            <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
              <div class="product-tab-list tab-pane fade active in" id="dataPribadi">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-content-section">
                      <div class="row">
                        <div class="col-lg-12">
                          <table width="100%">
                            <tr>
                              <td><label form-control-label>Nomor KTP</label></td>
                              <td style="height: 50px; width: 80%">
                                <div class="col-lg-12">
                                  <input name="no_ktp" type="text" class="form-control" value="<?php echo $key->no_ktp; ?>">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label form-control-label>Nomor BPJS</label></td>
                              <td style="height: 50px; width: 80%">
                                <div class="col-lg-12">
                                  <input name="no_bpjs" type="text" class="form-control" value="<?php echo $key->no_bpjs; ?>">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label form-control-label>Nama Lengkap</label></td>
                              <td style="height: 50px; width: 80%">
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
                                <?php if ($key->jenkel == "") {
                                  echo "<option> -- Pilihan --</option>";
                                }else{
                                  echo "<option>".$key->jenkel."</option>";
                                }?>
                                <option>Laki-laki</option>
                                <option>Perempuan</option>
                              </select>
                              </div>
                            </td>
                          </tr>
                            <tr>
                              <td><label form-control-label>Alamat</label></td>
                              <td style="height: 50px; width: 80%">
                                <div class="col-lg-12">
                                  <input name="alamat" type="text" class="form-control" value="<?php echo $key->alamat;?>">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label form-control-label>Nomor Telepon</label></td>
                              <td style="height: 50px; width: 80%">
                                <div class="col-lg-12">
                                  <input name="no_telp" type="text" class="form-control" value="<?php echo $key->no_telp; ?>">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label form-control-label>Email</label></td>
                              <td style="height: 50px; width: 80%">
                                <div class="col-lg-12">
                                  <input name="email" type="text" class="form-control" value="<?php echo $key->email; ?>">
                                </div>
                              </td>
                            </tr>
                          </table><br>
                          <div class="row mg-b-15">
                            <div class="col-lg-12">
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="skill-title">
                                    <h2>Data Nilai</h2><hr>
                                  </div>
                                </div>
                              </div>
                              <table width="100%">
                                <tr>
                                  <td><label form-control-label>Pendidikan Terakhir</label></td>
                                  <td style="height: 50px; width: 80%">
                                    <div class="col-lg-12">
                                      <select class="form-control" name="pend_akhir">
                                        <option><?php echo $key->pend_akhir; ?></option>
                                        <option>Opsi Pilihan :</option>
                                        <option>SMA/SMK</option>
                                        <option>D1</option>
                                        <option>D3</option>
                                        <option>D4/S1</option>
                                        <option>S2</option>
                                        <option>S3</option>
                                      </select>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td><label form-control-label>Nilai Akhir</label></td>
                                  <td style="height: 50px; width: 80%">
                                    <div class="col-lg-12">
                                      <input name="nilai_akhir" type="text" class="form-control" value="<?php echo $key->nilai_akhir; ?>">
                                    </div>
                                  </td>
                                </tr>
                              </table>
                              <div class="form-group row">
                                <div class="col-sm-4 offset-sm-3">
                                  <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Save changes</button>
                                </div>
                              </div>
                            <?php } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </form>
              <div class="product-tab-list tab-pane fade" id="cv">
                <form action="<?php echo site_url(); ?>/pelamar/updatecv/" enctype="multipart/form-data" method="post">
                  <div class="pdf-viewer-area mg-b-15">
                    <div class="container-fluid">
                      <div class="row"> <br>
                      <div class="container-fluid" role="alert">
                          <?php if ($this->session->flashdata('msg_error')) :?>
                            <div class="alert alert-danger alert-mg-b"> 
                            <?php echo $this->session->flashdata('msg_error')?>
                            </div>
                          <?php endif; ?>
                      </div>

                      <div><b>Ketentuan !</b><br>
                          File yang diupload berupa: <br>
                          1. Surat Lamaran Pekerjaan<br>
                          2. Curiculum Vitae<br>
                          3. Sertifikat kompetensi(jika memiliki)<br>
                          Dijadikan satu file berbentuk pdf berukuran maksimal 2 mb.<br>
                      </div>
                      <br>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"></div>
                        <?php foreach ($datasaya as $key) { ?>
                          <div class="file-upload-inner ts-forms">
                            <div class="input prepend-big-btn">
                              <label class="icon-right" for="prepend-big-btn">
                                <i class="fa fa-download"></i>
                              </label>
                              <div class="file-button">Browse
                                <input type="hidden" name="cv_old" value="<?php echo $key->cv; ?>">
                                <input type="file" name="cvsaya" value="<?php echo $key->cv; ?>" onchange="document.getElementById('prepend-big-btn2').value = this.value;">
                              </div>
                              <input type="text" id="prepend-big-btn2" placeholder="no file selected">
                            </div>
                          </div><br>
                          <div class="form-group row">
                            <div class="col-sm-4 offset-sm-3">
                              <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Save changes</button>
                            </div>
                          </div><br>
                          <div align="center">
                            <div class="pdf-single-pro">
                              <a class="media" href="<?php echo base_url()?>Assets/dokumen/<?php echo $key->cv; ?>"></a>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

<?php $this->load->view('./footer'); ?>