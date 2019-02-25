<?php 
	$this->load->view('./header.php');
	$levelku=$this->session->userdata("myLevel");
	$namaku=$this->session->userdata("myLongName");
	$emailku=$this->session->userdata("myEmail");
	$idku=$this->session->userdata("myId");
 ?>
 <br><br><br>
  <!-- Single pro tab review Start-->
  <div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
      <form>
        <div class="row">
          <?php foreach ($array as $key){ ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="profile-info-inner">
                <div class="profile-details-hr">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-6">
                      <div class="address-hr">
                        <h1><b><?php echo $key->nama; ?></b><br /> </h1>
                      </div>
                    </div><?php } ?>
                  </div>
                </div>
                <div class="profile-img">
                  <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto?>" alt=""/>
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
                            <h2>Data Pribadi</h2>
                            <hr/>
                          </div>
                        </div>
                      </div>
                      <?php foreach ($array as $key) { ?>
                      <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="review-content-section">
                                <div class="row">
                                  <div class="col-lg-12"> 
                                    <table width="100%">
                                      <tr>
                                        <td width="20%"><label form-control-label">Nomor Pelamar</label></td>
                                        <td style="height: 50px" width="80%">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->id_karyawan; ?>" style="width:100%">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nomor KTP</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->no_ktp; ?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nama Lengkap</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->nama;?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Alamat</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->alamat;?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nomor Telepon</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->no_telp; ?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Email</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->email; ?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Profesi Lamaran</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->id_profesi?>">
                                          </div>
                                        </td>
                                      </tr>
                                    </table>
                                    </div>        
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                      </div>
                    </div>
                    </div>
                <?php if($key->id_status != "Calon Karyawan"){?>
                
                <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                  <div class="row mg-b-15">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="skill-title">
                            <h2>Data Pendidikan</h2>
                            <hr/>
                          </div>
                        </div>
                      </div>
                      <?php foreach ($array as $key) { ?>
                      <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="review-content-section">
                                <div class="row">
                                  <div class="col-lg-12"> 
                                    <table width="100%">
                                      <tr>
                                        <td style="width: 20%"><label form-control-label">Pendidikan Terakhir</label></td>
                                        <td style="height: 50px; width: 80%">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->pend_akhir; echo " - "; echo $key->pendidikan;?>" style="width:100%">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Tahun Pendidikan</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo substr($key->mulai, 0,4); echo " - "; echo substr($key->akhir, 0,4); ?>">
                                          </div>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td><label form-control-label">Nilai Akhir</label></td>
                                        <td style="height: 50px">
                                          <div class="col-lg-12">
                                            <input type="text" class="form-control" value="<?php echo $key->nilai_akhir;?>">
                                          </div>
                                        </td>
                                      </tr>
                                    </table>
                                    </div> 
                                     <?php if($key->id_status == "Pelamar"){?>
                                     <div align="right">
                                        <a href="<?php echo site_url(); echo "/admin/pelamar";?>">
                                          <button class="btn btn-primary waves-effect mg-b-15">kembali</button>
                                        </a>
                                      
                                        <a href="<?php echo site_url(); echo "/admin/pelamarDiterima/"; echo $key->id_karyawan ; ?>">
                                          <button class="btn btn-success waves-effect mg-b-15">Terima</button>
                                        </a>
                                      
                                        <a href="<?php echo site_url(); echo "/admin/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                                          <button class="btn btn-danger waves-effect mg-b-15">Tolak</button>
                                        </a> 
                                            
                                        <?php } else if($key->id_status == "Pelamar Ditolak"){?>
                                          <a href="<?php echo site_url(); echo "/admin/pelamar";?>">
                                            <button class="btn btn-primary waves-effect mg-b-15">kembali</button>
                                          </a>
                                     </div>
                                <?php } ?>       
                                  </div>
                                </div>
                              </div>
                            </div>
                        
                        </div>
                      <?php } ?>
                      </div>
                    </div>
                 </div>
                </div>
              <?php } else if($key->id_status == "Calon Karyawan"){?>
                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                  <div class="row mg-b-15">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="skill-title">
                            <h2>Data Seleksi</h2>
                            <hr/>
                          </div>
                        </div>
                      </div>
                      <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                        <div class="product-tab-list tab-pane fade active in" id="description">
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                              <div class="review-content-section">
                                <div class="row">
                                  <div class="col-lg-12"> 
                                    <table class="table table-hover myfont" id="item" width="100%">
                                      <thead>
                                        <tr>
                                          <th width="13%">Agama</th>
                                          <th width="13%">Kompetensi</th>
                                          <th width="13%">PPA</th>
                                          <th width="13%">Psikologi</th>
                                          <th width="13%">Kesehatan</th>
                                          <th width="13%">Wawancara</th>
                                        </tr>
                                      </thead>
                                    
                                      <tbody>
                                        <?php foreach ($seleksi as $ki) { ?>
                                          <tr>
                                            <td><?php echo $ki['nilai_agama']?></td>
                                            <td><?php echo $ki['nilai_kompenetsi']?></td>
                                            <td><?php echo $ki['tes_ppa']?></td>
                                            <td><?php echo $ki['tes_psikologi']?></td>
                                            <td><?php echo $ki['tes_kesehatan']?></td>
                                            <td><?php echo $ki['nilai_wawancara']?></td>
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
                    </div><br><br>
                    <table>
                          <tr>
                            <td style="width: 130px;">
                              <a href="<?php echo site_url(); echo "/admin/pelamar";?>">
                                <div class="grid-item griddaftarr" style="font-size: 15px;" >Kembali</div>
                              </a>
                            </td>
                            <td style="width: 200px;">
                              <a href="<?php echo site_url(); echo "/admin/pelamar/editSeleksi";?>">
                                <div class="grid-item griddaftarr" style="font-size: 15px;" >Update Data Seleksi</div>
                              </a>
                            </td>
                          </tr>
                    </table>
                  </div>
                </div>
                <?php } ?>
              </div>
            </form>
          </div>
        </div>
        </div>
        </form>
        </div>
<br>
<?php $this->load->view('./footer'); ?>