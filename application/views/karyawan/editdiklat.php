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
                                    <li><a href="#">Data Diklat</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">Tambah Dokumen</span>
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
                            <span><h4 align="center">DATA DIKLAT KARYAWAN</h4></span>
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
                    <?php foreach ($array as $kei){?>
                    <form action="<?php echo site_url();?>/karyawan/editdiklat/<?php echo $kei->id_diklat?>" enctype="multipart/form-data" method="post">
                    <div class="sparkline12-graph">
                        <div class="input-knob-dial-wrap">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Nomor Sertifikat Diklat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" class="form-control" name="nomor_sertif" value="<?php echo $kei->nomor_sertif?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Nama Diklat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" class="form-control" name="nama_diklat" value="<?php echo $kei->nama_diklat?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Jenis Diklat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" class="form-control" name="jenis_diklat" value="<?php echo $kei->jenis_diklat?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="date-picker-inner">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Tanggal Diklat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control" name="tgl_mulai" value="<?php echo $kei->tgl_mulai?>" />
                                        <span class="input-group-addon">hingga</span>
                                        <input type="text" class="form-control" name="tgl_akhir" value="<?php echo $kei->tgl_akhir?>" />
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="date-picker-inner">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Jam Diklat</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control" name="jam" value="<?php echo $kei->jam?>"><p></p>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="date-picker-inner">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Tahun Diklat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control" name="tahun" value="<?php echo $kei->tahun?>">
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Upload Dokumen</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">

                                    <div class="input-mark-inner">
                                        <div class="file-upload-inner ts-forms">
                                          <div class="input prepend-big-btn">
                                              <label class="icon-right" for="prepend-big-btn">
                                                <i class="fa fa-download"></i>
                                              </label>
                                              <div class="file-button">
                                                  Browse
                                                  <input type="file" name="file_old" value="<?php echo $kei->file?>" hidden>
                                                  <input type="file" name="file" value="<?php echo $kei->file?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                              </div>
                                              <input type="text" id="prepend-big-btn" placeholder="no file selected" value="<?php echo $kei->file?>">
                                              <!-- <font size="2"><a href="#">unduh dokumen</a></font> -->
                                          </div>
                                        </div>
                                        <font size="2">Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2 mb </font>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
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
 