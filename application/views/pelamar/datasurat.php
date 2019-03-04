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
                                    <li><span class="bread-blod">Data Surat</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <div class="alert alert-info">
                            Perhatian! Data surat harus diisi apabila anda mendaftar sebagai perawat, dan apoteker!
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
                            <h4>Daftar Surat</h4>
                            <div class="add-product">
                                <a href="<?php echo site_url('pelamar/addpend');?>">Tambah Dokumen</a>
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
                                        <th>Nomor Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Berakhir</th>
                                        <th>Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $no = 1 ?>
                                    <?php foreach ($array as $key){ ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $key->no_surat; ?></td>
                                        <td><?php echo $key->id_surat; ?></td>
                                        <td><?php echo $key->tgl_mulai; ?></td>
                                        <td><?php echo $key->tgl_akhir; ?></td>
                                        <td>
                                        <?php if(($key->aktif) == 1){ ?>
                                            <button class="pd-setting"><i class="fa fa-check"></i> Surat Aktif</button> 
                                          <?php }else{ ?>
                                            <button class="ds-setting">Surat Kadaluarsa</button>
                                          <?php } ?>
                                          
                                        </td>
                                        <td>
                                        <?php if(($key->aktif) == 1){ ?>
                                        <a href="<?php echo site_url('pelamar/detailpend/').$key->id_sipstr ?>">   
                                        <button data-toggle="tooltip" title="detail" class="pd-setting-ed"><i class="fa fa-eye"></i>   Detail</button> </a>
                                        <?php }else{ ?>
                                        <a href="<?php echo site_url('pelamar/editpend/').$key->id_sipstr ?>">
                                        <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
                                        <a href="<?php echo site_url('pelamar/hapuspend/').$key->id_sipstr ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>
                                        <?php } ?>
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