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
                                    <li><a href="#">Karyawan</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">Data Diklat</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br><div class="alert alert-info">
                            Menu data kewenangan klinis berisi data pengajuan data klinis berisi dokumen data-data klinis.
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
                            <h4>Data Diklat</h4>
                            <div class="add-product">
                                <a href="<?php echo site_url('karyawan/addkew');?>">Tambah Dokumen</a>
                            </div>
                             <div class=" container-fluid" id="notif">
                              <?php if ($this->session->flashdata('msg')) :?>
                                <div class="alert alert-success"> 
                                <?php echo $this->session->flashdata('msg')?>
                                </div>
                              <?php endif; ?>
                              </div>
                            <div class="asset-inner">
                                <table>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>File Pengajuan</th>
                                        <th>Penilaian</th>
                                        <th>Tanggal Penilaian</th>
                                        <th>File Penilaian</th>
                                        <th>Finalisasi</th>
                                        <th>Tanggal Finalisasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $no = 1 ?>
                                    <?php foreach ($array as $key){ ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $key->tgl_pengajuan; ?></td>
                                        <td>
                                            <?php if(($key->doku_pengajuan) != NULL) {?>
                                             <font style="color: blue">File Tersedia</font>
                                            <?php }else{ ?>
                                              <font style="color: red">Tidak Ada file</font>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $key->penilaian; ?></td>
                                        <td><?php echo $key->tgl_penilaian; ?></td>
                                        <td>
                                            <?php if(($key->doku_penilaian) != NULL) {?>
                                             <font style="color: blue">File Tersedia</font>
                                            <?php }else{ ?>
                                              <font style="color: red">Tidak Ada file</font>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $key->finalisasi; ?></td>
                                        <td><?php echo $key->tgl_finalisasi; ?></td>
                                        <td>
                                        
                                        <a href="<?php echo site_url('karyawan/editkew/').$key->id_kewenangan ?>">
                                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                        <a href="<?php echo site_url('karyawan/hapuskew/').$key->id_kewenangan ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                        </td>
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