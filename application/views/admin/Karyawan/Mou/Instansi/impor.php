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
                                    <li><a href="#">Data Instansi</a> <span class="bread-slash">/</span>
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
                            <span><h4 align="center">Upload Data Instansi </h4></span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <div class="input-mask-title">
                              <label>Download Format Excel :</label>
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <a href="<?php echo base_url().'Assets/format/instansi.xlsx' ?>" download>
                                <button class="btn btn-default waves-effect" class='submit'><i class="fa fa-download" aria-hidden="true"></i> Unduh Format</button>
                            </a>
                        </div>
                    </div>
                    <form action="<?=site_url(); ?>/adminInstansi/impor/" enctype="multipart/form-data" method="post">
                    <div class="sparkline12-graph">
                        <div class="input-knob-dial-wrap">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Upload Excel</label>
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
                                                  <input type="file" name="file" onchange="document.getElementById('prepend-big-btn').value = this.value;" required accept=".xls, .xlsx">
                                              </div>
                                              <input type="text" id="prepend-big-btn" placeholder="no file selected">
                                          </div>
                                        </div>
                                        <font size="2">Format dokumen harus dalam bentuk .xls / .xlxs, Apabila ada data yang memang kosong isi dengan tanda - atau angka 0</font>
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
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("footer.php"); ?>
    