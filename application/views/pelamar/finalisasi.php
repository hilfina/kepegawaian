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
                            <span><h4 align="center">FINALISASI DATA</h4></span>
                        </div>
                    </div>
                    <br>
                    
                    
                        <div class="alert alert-info">
                            <h4>Pemberitahuan !</h4>
                            <br>
                                Apabila anda memfinalisasi data maka data yang dibutuhkan untuk lamaran tidak dapat diubah kembali. Pastikan data anda telah terisi dan benar.
                        </div>
                        <a href="<?php echo site_url('pelamar/finalisasi2')?>" onclick="return confirm('Apakah anda yakin untuk melakukan finalisasi?');">
                        <button class="btn btn-primary waves-effect waves-light mg-b-15 btn-block" value="send" >FINALISASI DATA</button>
                        </a>
                    

                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("footer.php"); ?>
    