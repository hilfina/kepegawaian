<?php 
$this->load->view("header.php");
$idku=$this->session->userdata("myId");
?><br>
<div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center"><br>
              <h3 align="center"><b>Sistem Kepegawaian RSI Aisyiyah</b></h3>
              <hr style="width: 70%">
            </div>          
          </div><br>
            <div class="alert alert-info"><b>SELAMAT DATANG PADA SISTEM INFORMASI KEPEGAWAIAN RSI AISYIYAH</b><br><br>
                Sistem Informasi Kepegawaian RSI Aisyiyah berguna untuk menunjang akreditasi rumah sakit.<br>
                pada sistem ini kalian dapat mengupload file file kepegawaian anda juga mendapatkan notifikasi file kadaluarsa.<BR>
                Untuk pertanyaan seputar tentang sistem anda dapat menkontak email bagian SDI RSI Aisyiyah dengan alamat sdirsiamalang@gmail.com
            </div> 
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view("footer.php"); ?>