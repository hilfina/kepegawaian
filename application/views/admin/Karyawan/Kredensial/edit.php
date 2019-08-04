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
                                    <li><a href="#">Data Kredensial</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">Edit Dokumen</span>
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
                <div class="sparkline12-list mt-b-30">
                    <div class="sparkline12-hd">
                    <br>
                        <div class="main-sparkline12-hd">
                            <span><h4 align="center">EDIT DATA KREDENSIAL</h4></span>
                        </div>
                    </div>
                    <br>
                    <div class="container-fluid" role="alert">
                        <?php if ($this->session->flashdata('msg_error')) :?>
                          <div class="alert alert-danger alert-mg-b"> 
                          <?php echo $this->session->flashdata('msg_error')?>
                          </div>
                        <?php endif; ?>
                    </div>
                    <?php foreach($array as $key){?>
                    <form action="<?php echo site_url();?>/adminKew/edit/<?php echo $key->id_kewenangan;?>" enctype="multipart/form-data" method="post">
                    <div class="sparkline12-graph">
                        <div class="input-knob-dial-wrap">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>NIK</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" name="nik" value="<?php echo $key->nik;?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Tanggal Pengajuan</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" value="<?php echo date('Y/d/m', strtotime($key->tgl_pengajuan)); ?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Dokumen Pengajuan</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" value="<?php echo $key->doku_pengajuan;?>" class="form-control" disabled>
                                    </div>
                                <br>
                                    <div align="center">
                                      <div class="pdf-single-pro">
                                        <a class="media" href="<?php echo base_url()?>Assets/dokumen/<?php echo $key->doku_pengajuan; ?>"></a>
                                      </div>
                                    </div><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Jenjang Klinik</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="input-mark-inner">
                                        <select name="pk" class="form-control">
                                        <option><?php echo $key->pk;?></option>
                                        <option>---Pilihan---</option>
                                            <option>Pra PK</option>
                                            <option>PK 1</option>
                                            <option>PK 2</option>
                                            <option>PK 3</option>
                                            <option>PK 4</option>
                                            <option>Pratama</option>
                                            <option>Madya</option>
                                            <option>Utama</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Kredensial</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="input-mark-inner">
                                        <Select type="text" class="form-control" name="penilaian">
                                            <option><?php echo $key->penilaian;?></option>
                                            <option>---Pilih---</option>
                                            <option>Belum</option>
                                            <option>Proses</option>
                                            <option>Selesai</option>
                                        </Select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="date-picker-inner">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                  <div class="input-mask-title">
                                    <label>Tanggal Berlaku</label>
                                  </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <div class="input-daterange input-group" id="datepicker">
                                      <input type="text" class="form-control" name="tgl_mulai" value="<?php echo $key->tgl_mulai; ?>" />
                                      <span class="input-group-addon">hingga</span>
                                      <input type="text" class="form-control" name="tgl_akhir" value=" <?php echo$key->tgl_akhir; ?>" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Upload Dokumen Kredensial</label>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <font size="2" color="red">Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2 mb </font>
                                    <div class="input-mark-inner">
                                        <div class="file-upload-inner ts-forms">
                                          <div class="input prepend-big-btn">
                                              <label class="icon-right" for="prepend-big-btn">
                                                <i class="fa fa-download"></i>
                                              </label>
                                              <div class="file-button">
                                                  Browse
                                                  <input type="text" name="file_old" value="<?php echo $key->doku_penilaian?>" hidden>
                                                  <input type="file" name="doku_penilaian" value="" onchange="document.getElementById('prepend-big-btn2').value = this.value;">
                                              </div>
                                              <input type="text" id="prepend-big-btn2" placeholder="no file selected" value="<?php echo $key->doku_penilaian;?>">
                                          </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title"></div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="pdf-viewer-area mg-b-15">
                                      <div class="container-fluid">
                                        <div class="row">
                                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> </div>
                                          <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                            <div class="pdf-single-pro">
                                              <a class="media" href="<?php echo base_url()?>Assets/dokumen/<?php echo $key->doku_penilaian; ?>"></a>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div class="input-mask-title">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="input-mark-inner">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Save changes</button>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("footer.php"); ?>

 