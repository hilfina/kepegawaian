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
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view("footer.php"); ?>