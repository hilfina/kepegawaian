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
                                    <li><a href="#">Data Diri</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">Ubah Kata Sandi</span>
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
                            <span><h4 align="center">UBAH KATA SANDI</h4></span>
                        </div>
                    </div>
                    <br>
                    
                    <form action="<?php echo site_url(); ?>/pelamar/ubahpass/" method="post">
                    <div class="sparkline12-graph">
                        <div class="input-knob-dial-wrap">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Kata Sandi Lama</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="text" class="form-control" name="password" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Kata Sandi Baru</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="password" class="form-control" name="pw_baru" ><?= form_error('pw_baru'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="input-mask-title">
                                        <label>Konfirmasi Kata Sandi Baru</label>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <div class="input-mark-inner">
                                        <input type="password" class="form-control" name="cpw_baru" ><?= form_error('cpw_baru'); ?>
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
                                            <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Ubah Kata Sandi</button>
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
    