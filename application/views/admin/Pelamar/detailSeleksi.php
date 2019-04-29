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
                    <a href="<?php echo site_url('admin/lanjutt/Tulis/lulus/').$hasilnya."/".$wawa->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('admin/lanjutt/Tulis/stop/').$hasilnya."/".$wawa->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($wawa->hasil)) {
                    if ($wawa->hasil != "-" && $semua->nilai_wawancara == "-"){
                      $hasilnya = $wawa->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('admin/lanjutt/Wawancara/lulus/').$hasilnya."/".$tulis->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('admin/lanjutt/Wawancara/stop/').$hasilnya."/".$tulis->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($psiko->hasil)) {
                    if ($psiko->hasil != "-" && $semua->tes_psikologi == "-"){
                      $hasilnya = $psiko->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('admin/lanjutt/Psikologi/lulus/').$hasilnya."/".$psiko->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('admin/lanjutt/Psikologi/stop/').$hasilnya."/".$psiko->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($baca->hasil)) {
                    if ($baca->hasil != "-" && $semua->nilai_agama == "-"){
                      $hasilnya = $baca->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('admin/lanjutt/Baca/lulus/').$hasilnya."/".$baca->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('admin/lanjutt/Baca/stop/').$hasilnya."/".$baca->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
                  </div>


                  <?php }elseif (isset($sehat->hasil)) {
                    if ($sehat->hasil != "-" && $semua->tes_kesehatan == "-"){
                      $hasilnya = $sehat->hasil; ?>
                  </form>
                  <div align="center">
                    <a href="<?php echo site_url('admin/lanjutt/Kesehatan/lulus/').$hasilnya."/".$sehat->id_seleksi ?>"><input type="submit" class="btn btn-success" value="Lanjut"></a>
                    <a href="<?php echo site_url('admin/lanjutt/Kesehatan/stop/').$hasilnya."/".$sehat->id_seleksi ?>"><input type="submit" class="btn btn-danger" value="Eliminasi"></a>
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