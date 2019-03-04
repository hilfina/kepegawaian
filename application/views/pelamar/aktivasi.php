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
                               
                            </div>
                        </div>
                        <br>
                        <div class="alert alert-warning">
                        <h4>Pemberitahuan !</h4>
                        <br>
                            Akun Anda belum aktif! Silakan buka buka email Anda dan klik link aktivasi. Hal ini perlu dilakukan karena pemberitahuan interview dan seterusnya melalui notifikasi email. 
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
                            <span><h4 align="center">AKTIVASI AKUN</h4></span>
                        </div>
                    </div>
                    <br>
                    
                    <form action="<?php echo site_url(); ?>/pelamar/aktivasi/" id="loginForm" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>
                            <input type="email" placeholder="example@gmail.com" required="" name="email" class="form-control">
                            <span class="help-block small">Email yang Anda masukkan akan selalu di gunakan</span>
                        </div>

                        <button class="btn btn-primary waves-effect waves-light mg-b-15 btn-block" value="send" >Kirim Ulang Email</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("footer.php"); ?>
    