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
                                    <li><span class="bread-blod">Data Pendidikan</span>
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
        <div class="product-status mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="product-status-wrap">
                            <h4>Daftar Pendidikan</h4>
                            <div class="add-product">
                                <a href="#">Tambah Dokumen</a>
                            </div>
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nomor Ijazah</th>
                                        <th>Nama Pendidikan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Verifikasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php foreach ($array as $key){ ?>
                                    <tr>
                                    <?php $no = 1 ?>
                                        <td><?php echo $no ?></td>
                                        <td><img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->file; ?>" alt="" /></td>
                                        <td><?php echo $key->nomor_ijazah; ?></td>
                                        <td><?php echo $key->pendidikan; ?></td>
                                        <td><?php echo $key->mulai; ?></td>
                                        <td><?php echo $key->akhir; ?></td>
                                        <td><?php echo $key->verifikasi; ?></td>
                                        <td>
                                            <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                    <?php }  ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
<?php $this->load->view("footer.php"); ?>