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
             
            </div>
          </div> <br>
          <?php foreach ($datDir as $key){ ?>
            <form>
              <div class="sparkline12-graph">
                <div class="input-knob-dial-wrap">
                  
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
                </div>
              </div>
            </form><br>
            <div align="center">
              <?php foreach ($datSel as $a){ ?>
              <?php if ($a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-") { ?>
                <?php if ($levelku == "Super Admin") {?>
                <a href="<?php echo site_url(); echo "/adminPelamar/editMagang/";  echo $key->id_karyawan ; ?>">
                  <button class="btn btn-success waves-effect mg-b-15" title="Lulus tahap finalisasi"><i class="fa fa-check"></i>Lulus Tahap Finalisasi</button>
                </a>
                <a href="<?php echo site_url(); echo "/adminPelamar/pelamarDitolak/"; echo $key->id_karyawan ;?>">
                  <button class="btn btn-danger waves-effect mg-b-15" title="Gagal tahap finalisasi"><i class="fa fa-times"></i> Tidak Lulus Tahap Finalisasi</button>
                </a>
                <?php } ?>
              <?php } else{}?>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
          <h4 align="center">Riwayat Seleksi</h4>

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