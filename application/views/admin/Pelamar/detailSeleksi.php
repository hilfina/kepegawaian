<?php 
  $this->load->view('./header');
  $levelku=$this->session->userdata("myLevel");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
?><br><br>
<div class="breadcome-area">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Detail Data Seleksi</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="product-status mg-b-15">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="sparkline12-list mt-b-30">
          <div class="sparkline12-hd"><br>
            <div class="main-sparkline12-hd" align="center">
              <span><h4 align="center">Detail Seleksi Pelamar</h4></span>
              <hr style="border: solid 2px; width: 250px; background-color: black">
              <hr style="border: solid 1px; width: 200px; background-color: black">
            </div>
          </div> <br>
          <?php foreach ($datDir as $key){ ?>
            <form>
              <div class="sparkline12-graph">
                <div class="input-knob-dial-wrap">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="input-mask-title">
                        <label>ID Seleksi Pelamar</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="input-mark-inner">
                        <?php
                          $konek = mysqli_connect("localhost","root","","kepegawaian");
                          $query = "select id_seleksi from seleksi where id_karyawan = '$key->id_karyawan'";
                          $hasil = mysqli_fetch_array(mysqli_query($konek, $query));
                        ?>
                        <input type="text" name="" class="form-control" value="<?php echo $hasil['id_seleksi'];?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="input-mask-title">
                        <label>Nama Pelamar</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="input-mark-inner">
                        <input type="text" name="" class="form-control" value="<?php echo $key->nama;?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                      <div class="input-mask-title">
                        <label>Profesi yang dipilih</label>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="input-mark-inner">
                        <?php
                          $konek = mysqli_connect("localhost","root","","kepegawaian");
                          $query = "select nama_profesi from jenis_profesi where id_profesi = '$key->id_profesi'";
                          $hasil = mysqli_fetch_array(mysqli_query($konek, $query));
                        ?>
                        <input type="text" name="" class="form-control" value="<?php echo $hasil['nama_profesi'];?>" readonly>
                      </div>
                    </div>
                  </div><br><br>
                  <div class="row" align="center">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <?php foreach ($datSel as $a){ ?>
                        <?php if ($a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-") { ?>
                          <a href="<?php echo site_url(); echo "/adminPelamar/editMagang/";  echo $key->id_karyawan ; ?>">
                            <button class="btn btn-success waves-effect mg-b-15" title="Lulus tahap finalisasi"><i class="fa fa-check"> Lulus Tahap Finalisasi</i></button>
                          </a>
                          <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                            <button class="btn btn-danger waves-effect mg-b-15" title="Gagal tahap finalisasi"><i class="fa fa-times">Tidak Lulus Tahap Finalisasi</i></button>
                          </a>
                        <?php } else{}?>
                        <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </form><br>
          <?php } ?>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
          <ul id="myTabedu1" class="tab-review-design" align="center" >
            <li class="active"><a href="#dataSeleksi">Edit Hasil Seleksi</a></li>
            <li><a href="#riwayatSeleksi"> Riwayat Seleksi</a></li>
          </ul>
          <div id="myTabContent" class="tab-content custom-product-edit">
            <div class="product-tab-list tab-pane fade active in" id="dataSeleksi">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <form action="<?php echo site_url(); ?>/admin/editDataSel/" method="POST" enctype="multipart/form-data" >
                      <?php foreach ($datSel as $key){ ?>
                        <input name="idSel" type="hidden" class="form-control" value="<?php echo $key->id_seleksi;?>" >
                      <table width="80%" style="margin-left: 10%">
                        <tr>
                          <td><label form-control-label>Tanggal</label></td>
                          <td style="height: 50px">
                            <div class="col-lg-12">
                              <?php if ($key->tgl_seleksi == "-"){ ?>
                                <font color="red" size="2">*Masukkan tanggal untuk tes tulis dan wawancara</font>

                              <?php } elseif (($key->nilai_wawancara == "Lulus" || $key->nilai_kompetensi == "Lulus") && $wawa->tanggal == $key->tgl_seleksi && $key->tes_psikologi == "-" ) {?>
                                <font color="red" size="2">*Masukkan tanggal untuk tes psikologi</font>
                              <?php } elseif (($key->nilai_wawancara == "Lulus" || $key->nilai_kompetensi == "Lulus") && $wawa->tanggal != $key->tgl_seleksi && $key->tes_psikologi == "-" ) {?>
                              <?php } elseif ($key->tes_psikologi == "Lulus" && $psiko->tanggal == $key->tgl_seleksi) {?>
                                <font color="red" size="2">*Masukkan tanggal untuk tes agama dan kesehatan</font>
                              <?php } elseif ($key->tes_psikologi == "Lulus" && $psiko->tanggal != $key->tgl_seleksi && $key->nilai_agama == "-" ) {?>
                              <?php } ?>
                              <input name="tglSel" type="date" class="form-control" value="<?php echo $key->tgl_seleksi; ?>">
                            </div>
                          </td>
                        </tr>

                        <input name="idKSel" type="hidden" class="form-control" value="<?php echo $key->id_karyawan; ?>">

                        <?php if ($key->tgl_seleksi != "-"){ ?>

                          <tr>
                            <td><label form-control-label>Tes Tulis</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <?php if ($key->nilai_kompetensi == "-") { ?>
                                  <select name="nkSel" type="text" class="form-control">
                                  <option>-- Pilihan --</option>
                                  <option>Lulus</option>
                                  <option>Tidak Lulus</option>
                                </select>
                                <?php } else { ?>
                                  <input name="nkSel" type="text" class="form-control" value="<?php echo $key->nilai_kompetensi;?>" >
                                <?php } ?>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td><label form-control-label>Nilai Wawancara</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <?php if ($key->nilai_wawancara == "-") { ?>
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
                        <?php }elseif ($key->tgl_seleksi == "-") { ?>
                          <tr>
                            <td><label form-control-label>Tes Tulis</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <input name="nkSel" type="text" class="form-control" value="<?php echo $key->nilai_kompetensi;?>" readonly>
                              </div>
                            </td>
                          </tr>

                          <tr>
                            <td><label form-control-label>Nilai Wawancara</label></td>
                            <td style="height: 50px">
                              <div class="col-lg-12">
                                <input name="nwSel" type="text" class="form-control" value="<?php echo $key->nilai_wawancara;?>" readonly>
                              </div>
                            </td>
                          </tr>
                        <?php } ?> 
                          <?php if (($key->nilai_wawancara == "Lulus" || $key->nilai_kompetensi == "Lulus") && $wawa->tanggal != $key->tgl_seleksi) { ?>
                            <tr>
                              <td><label form-control-label>Tes Psikologi</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($key->tes_psikologi == "-") { ?>
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
                          <?php } else { ?>
                            <tr>
                              <td><label form-control-label>Tes Psikologi</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <input name="tpsSel" type="text" class="form-control" value="<?php echo $key->tes_psikologi;?>" readonly>
                                </div>
                              </td>
                            </tr>
                          <?php } ?> 
                          <?php if ($key->tes_psikologi == "Lulus" && $psiko->tanggal != $key->tgl_seleksi) { ?>
                            <tr>
                              <td><label form-control-label>Nilai Agama</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($key->nilai_agama == "-") { ?>
                                      <select name="naSel" type="text" class="form-control">
                                      <option>-- Pilihan --</option>
                                      <option>Lulus</option>
                                      <option>Tidak Lulus</option>
                                    </select>
                                    <?php } else { ?>
                                      <input name="naSel" type="text" class="form-control" value="<?php echo $key->nilai_agama;?>" >
                                    <?php } ?>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label form-control-label>Tes Kesehatan</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <?php if ($key->tes_kesehatan == "-") { ?>
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
                          <?php }else{?>
                            <tr>
                              <td><label form-control-label>Nilai Agama</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <input name="naSel" type="text" class="form-control" value="<?php echo $key->nilai_agama;?>" readonly>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td><label form-control-label>Tes Kesehatan</label></td>
                              <td style="height: 50px">
                                <div class="col-lg-12">
                                  <input name="tkSel" type="text" class="form-control" value="<?php echo $key->tes_kesehatan;?>" readonly>
                                </div>
                              </td>
                            </tr>  
                          <?php } ?>
                          <?php if ($key->nilai_agama == "Lulus" || $key->tes_kesehatan == "Lulus") { ?>
                                                  
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
                    <div align="center">
                      <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Update">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="product-tab-list tab-pane fade" id="riwayatSeleksi">
            <div class="row">
              <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="margin-left: 15%">
                <div class="review-content-section">
                  <div class="sparkline8-graph">
                    <div class="static-table-list">
                      <table  class="table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jenis Seleksi</th>
                            <th>Hasil</th>
                          </tr>
                        </thead>
                        <?php $n=1; foreach ($datRSel as $key){ ?>
                        <tbody>
                          <tr>
                            <td><?php echo $n++; ?></td>
                            <td><?php echo date('d - M - Y', strtotime($key->tanggal)); ?></td>
                            <td><?php echo $key->nama_tes; ?></td>
                            <td><?php echo $key->hasil; ?></td>
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
<?php $this->load->view('./footer'); ?>