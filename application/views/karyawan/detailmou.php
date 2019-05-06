<?php $this->load->view("header.php");?>
<br>
<div class="breadcome-area"><br>
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
<div class="product-status mg-b-15">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="sparkline12-list mt-b-30">
          <div class="sparkline12-hd"> <br>
            <div class="main-sparkline12-hd">
              <span><h4 align="center">DETAIL MOU KARYAWAN</h4></span>
            </div>
          </div><br>
        <?php foreach ($array as $key){ ?>
          <div class="sparkline12-graph">
            <div class="input-knob-dial-wrap">
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <div class="input-mask-title">
                    <label>Nomor Surat</label>
                  </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                  <div class="input-mark-inner">
                    <input type="text" class="form-control" name="no_surat" value="<?php echo $key->no_mou;?>">
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
                        <input type="text" class="form-control" name="tgl_mulai" value="<?php echo $key->tgl_mulai;?>" />
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
                    <label>Unduh Dokumen</label>
                  </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                  <div class="input-mark-inner">
                    <?php if(($key->file) != NULL){?>
                    <a href="<?php echo base_url().'/Assets/dokumen/'.$key->file; ?>" download>
                      <button class="btn btn-default waves-effect" class='submit'><i class="fa fa-download" aria-hidden="true"></i> Unduh File</button>
                    </a>   
                    <?php }?>
                  </div>
                </div>
              </div> <br>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view("footer.php"); ?>
 