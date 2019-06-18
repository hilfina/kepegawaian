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
                                    <li><a href="#">Data Surat</a> <span class="bread-slash">/</span>
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
                            <span><h4 align="center">DATA SURAT IZIN PRAKTEK / SURAT TANDA REGISTRASI</h4></span>
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
                    <?php foreach ($array as $key){ ?>
                    <form action="<?php echo site_url(); ?>/karyawan/editsurat/<?php echo $key->id_sipstr?>" enctype="multipart/form-data" method="post">
                    <div class="sparkline12-graph">
                        <div class="input-knob-dial-wrap">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Jenis Surat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <select type="text" class="chosen-select" name="nama_surat">
                                            <option><?php echo $key->nama_surat; ?></option>
                                            <option>---Pilih----</option>
                                             <?php
                                                $konek = mysqli_connect("localhost","root","","kepegawaian");
                                                $query = "select nama_surat from jenis_surat";
                                                $hasil = mysqli_query($konek, $query);
                                                while ($data=mysqli_fetch_array($hasil)) {?>
                                            ?>
                                                <option> <?php echo $data['nama_surat']?> </option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Nomor Surat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" class="form-control" name="no_surat" value="<?php echo $key->no_surat;?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="date-picker-inner">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Tanggal Surat</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                  <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control" name="tgl_mulai"
                                        value="<?php echo $key->tgl_mulai;?>" />
                                        <span class="input-group-addon">hingga</span>
                                        <input type="text" class="form-control" name="tgl_akhir" value="<?php echo $key->tgl_akhir;?>"/>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Foto Scan Dokumen</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">

                                    <font size="2" color="red">Format dokumen harus dalam bentuk pdf. Ukuran file maksimal adalah 2 mb </font>
                                        <div class="file-upload-inner ts-forms">
                                          <div class="input prepend-big-btn">
                                              <label class="icon-right" for="prepend-big-btn">
                                                <i class="fa fa-download"></i>
                                              </label>
                                              <div class="file-button">
                                                  Browse
                                                  <input type="hidden" name="file_old" value="<?php echo $key->file; ?>">
                                                  <input type="file" name="file" value="<?php echo $key->file?>" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                              </div>
                                              <input type="text" id="prepend-big-btn" placeholder="no file selected"  value="<?php echo $key->file?>">
                                          </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="pdf-viewer-area mg-b-15">
                                        <div class="container-fluid">
                                          <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"> </div>
                                            <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11">
                                              <div class="pdf-single-pro">
                                                <a class="media" href="<?php echo base_url()?>Assets/dokumen/<?php echo $key->file; ?>"></a>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
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
 