<?php 
	$this->load->view('./header.php');
	$levelku=$this->session->userdata("myLevel");
	$namaku=$this->session->userdata("myLongName");
	$emailku=$this->session->userdata("myEmail");
	$idku=$this->session->userdata("myId");
 ?>
 <br>
    <div class="breadcome-area">
      <br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list single-page-breadcome">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <ul class="breadcome-menu">
                                    <li><a href="#">Data Saya</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">Data Diri</span>
                                    </li>
                                </ul>
                            </div>
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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="profile-info-inner">
                        <div class="profile-img">
                            <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto?>" alt="" width="120"/>
                        </div>
                        <?php if ($key->foto == "") { ?>
                          <div class="file-upload-inner ts-forms">
                          <div class="input prepend-big-btn">
                              <label class="icon-right" for="prepend-big-btn">
                                <i class="fa fa-download"></i>
                              </label>
                              <div class="file-button">
                                  Browse
                                  <input type="file" name="fotosaya" value="<?php echo $key->foto; ?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                              </div>
                              <input type="text" id="prepend-big-btn" placeholder="no file selected"value="<?php echo $key->foto; ?>" >
                          </div>
                        </div>
                        <?php } ?>
                        <div class="profile-details-hr">
                            <div class="row">
                            
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                                    <div class="address-hr">
                                        <h2><b><?php echo $key->nama; ?></b><br /> </h2>
                                    </div>
                                </div>
                              <?php } ?>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                        <div class="row mg-b-15">
                        <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="skill-title">
                                    <h2>Data Diri</h2>
                                    <hr />
                                </div>
                            </div>
                        </div>
                        <?php foreach ($datasaya as $key) { ?>
                        <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                              <div class="row">
                               
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                     <label form-control-label">Nomor KTP</label>
                                                        <input name="no_ktp" type="text" class="form-control" placeholder="Nomor KTP" value="<?php echo $key->no_ktp; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                     <label form-control-label">Nomor BPJS</label>
                                                        <input name="no_bpjs" type="text" class="form-control" placeholder="Nomor BPJS" value="<?php echo $key->no_bpjs; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                     <label form-control-label">Nama Lengkap</label>
                                                        <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="<?php echo $key->nama; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label form-control-label">Alamat</label>
                                                        <input name="alamat" type="text" class="form-control" placeholder="Alamat" value="<?php echo $key->alamat; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label form-control-label">Nomor Telepon</label>
                                                        <input name="no_telp" type="number" class="form-control" placeholder="Nama Lengkap" value="<?php echo $key->no_telp; ?>">
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label form-control-label">Email</label>
                                                        <input name="email" type="text" class="form-control" placeholder="Email" value="<?php echo $key->email; ?>">
                                                    </div>
                                                    <br>
                                                    <div class="row mg-b-15">
                                                    <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="skill-title">
                                                                <h2>Data Nilai</h2>
                                                                <hr />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label form-control-label">Pendidikan Terakhir</label>
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
                                                    <div class="form-group">
                                                        <label form-control-label">Nilai Akhir</label>
                                                        <input name="nilai_akhir" type="text" class="form-control"  value="<?php echo $key->nilai_akhir; ?>">
                                                    </div>
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
              </div>
              </div>
              </div>
              </div>
              </div>
              </div>
              </form>
              </div>
              </div>


              
              


<?php $this->load->view('./footer'); ?>