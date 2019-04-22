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
                                    <li><span class="bread-blod">Data Orientasi</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <br><div class="alert alert-info">
                            Menu data orientasi berisi data orientasi yang karyawan tempuh dan disertai dokumen kehadiran.
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
                            <h4>Data Orientasi</h4>
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
                                        <th>Tanggal Mulai Orientasi</th>
                                        <th>Tanggal Berakhir Orientasi</th>
                                        <th>Dokumen Kehadiran</th>
                                    </tr>
                                    <?php $no = 1 ?>
                                    <?php foreach ($array as $key){ ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $key->tgl_mulai; ?></td>
                                        <td><?php echo $key->tgl_akhir; ?></td>
                                        <td>
                                        <?php if(($key->doku_hadir) != NULL){ ?>
                                          <a href="<?php echo base_url().'/Assets/dokumen/'.$key->doku_hadir; ?>" download>
                                            <button class="btn btn-default waves-effect" class='submit'><i class="fa fa-download" aria-hidden="true"></i> Unduh File</button>
                                          </a>
                                        <?php }else{ ?>
                                          <font style="color: red">Tidak Ada file</font>
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