<?php 
$this->load->view("header.php");
?>
<br>
<div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="#">Data Orientasi</a> <span class="bread-slash">/</span></li>
                <li><span class="bread-blod">Tambah Dokumen</span></li>
              </ul>
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
          <div class="sparkline12-hd"> <br>
            <div class="main-sparkline12-hd">
              <span><h4 align="center">EDIT DATA ORIENTASI KARYAWAN</h4></span>
            </div>
          </div> <br>
          <div class="container-fluid" style="margin-right: 10%; margin-left: 10%">
            <?php foreach ($dato as $key) { ?>
              <form action="<?php echo site_url();?>/karyawan/editori/<?php echo $key->id_orientasi?>" enctype="multipart/form-data" method="post">
                <div class="sparkline12-graph">
                  <div class="input-knob-dial-wrap">
                    <div class="row">
                      <div class="date-picker-inner">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                          <div class="input-mask-title">
                            <label>Tanggal Orientasi</label>
                          </div>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                          <div class="form-group data-custon-pick data-custom-mg" id="data_5">
                            <div class="input-daterange input-group" id="datepicker">
                                <input type="text" class="form-control" name="tgl_mulai" value="<?php echo $key->tgl_mulai ?>" />
                                <span class="input-group-addon">hingga</span>
                                <input type="text" class="form-control" name="tgl_akhir" value="<?php echo $key->tgl_akhir ?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><br>
                    <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      <div class="input-mask-title">
                        <label>Upload Dokumen Kehadiran</label>
                      </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                      <div class="input-mark-inner">
                        <div class="file-upload-inner ts-forms">
                          <div class="input prepend-big-btn">
                            <label class="icon-right" for="prepend-big-btn"> <i class="fa fa-download"></i> </label>
                            <div class="file-button"> Browse
                              <input type="file" name="doku_hadir" value="" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                            </div>
                              <input type="text" id="prepend-big-btn" value="<?php echo $key->doku_hadir ?>">
                          </div>
                        </div>
                        <font size="2" color="red">*Format dokumen harus dalam bentuk docx / pdf / jpg. Ukuran file maksimal adalah 2 mb </font>
                      </div>
                    </div>
                    </div> <br>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <br>
                        <?php if($key->doku_hadir != ""){?>
                          <table style="width: 100%;">
                              <tr><td style="width: 100%; background-color: #e6f2ff; padding-left: 3%; padding-top: 3%; padding-bottom: 3%; padding-right: 3%;"><img src="<?php echo base_url()?>Assets/dokumen/<?php echo $key->doku_hadir?>" width="100%"/>   </td></tr>
                          </table>
                        <?php }else{}?>
                      </div>
                    </div><br>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="input-mark-inner">
                          <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Save changes</button>
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
  </div>
</div>
<?php $this->load->view("footer.php"); ?>