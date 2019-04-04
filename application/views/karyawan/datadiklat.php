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
                            Menu data diklat berisi data diklat yang karyawan tempuh dan disertai scan sertifikat diklat.
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
                                <a href="<?php echo site_url('karyawan/adddiklat');?>">Tambah Dokumen</a>
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
                                        <th>Nomor Sertifikat</th>
                                        <th>Nama Diklat</th>
                                        <th>Jenis Diklat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Tahun Diklat</th>
                                        <th>Waktu /jam</th>
                                        <th>Sertifikat Diklat</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $no = 1 ?>
                                    <?php foreach ($array as $key){ ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $key->nomor_sertif; ?></td>
                                        <td><?php echo $key->nama_diklat; ?></td>
                                        <td><?php echo $key->jenis_diklat; ?></td>
                                        <td><?php echo $key->tgl_mulai; ?></td>
                                        <td><?php echo $key->tgl_akhir; ?></td>
                                        <td><?php echo $key->tahun; ?></td>
                                        <td><?php echo $key->jam; ?></td>
                                        <td>
                                            <?php if(($key->file) != NULL) {?>
                                             <font style="color: blue">File Tersedia</font>
                                            <?php }else{ ?>
                                              <font style="color: red">Tidak Ada file</font>
                                            <?php } ?>
                                        </td>
                                        <td>
                                        
                                        <a href="<?php echo site_url('karyawan/editdiklat/').$key->id_diklat ?>">
                                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                        <a href="<?php echo site_url('karyawan/hapusdiklat/').$key->id_diklat ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?');">
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