<?php 
$this->load->view("header.php");
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
                                    <li><span class="bread-blod">Nilai</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <?php foreach ($array as $key){ ?>
                        <div class="alert alert-info">
                            Tanggal tes selanjutnya akan diupdate setiap hari. <br>Berikut tanggal tes anda selanjutnya:  <b><?php echo $key->tgl_seleksi?></b>
                        </div>
                        <?php } ?>
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
                        <div class="product-status-wrap">
                            <h4>Hasil Nilai Tes</h4>
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>Nilai Agama</th>
                                        <th>Nilai Kompetensi</th>
                                        <th>Nilai Wawancara</th>
                                        <th>Nilai Tes kesehatan</th>
                                        <th>Nilai Tes PPA</th>
                                        <th>Nilai Tes Psikologi</th>
                                    </tr>
                                    <?php foreach ($array as $key){ ?>
                                    <tr>
                                        <td><?php echo $key->nilai_agama ?></td>
                                        <td><?php echo $key->nilai_kompetensi; ?></td>
                                        <td><?php echo $key->nilai_wawancara; ?></td>
                                        <td><?php echo $key->tes_kesehatan; ?></td>
                                        <td><?php echo $key->tes_ppa; ?></td>
                                        <td><?php echo $key->tes_psikologi; ?></td>
                                    </tr>
                                    <?php }  ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
<?php $this->load->view("footer.php"); ?>