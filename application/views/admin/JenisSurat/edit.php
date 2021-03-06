<?php 
  $this->load->view('./header');
  $levelku=$this->session->userdata("myLevel");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
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
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Home</a> 
                  <span class="bread-slash">/</span>
                </li>
                <li><a href="<?php echo site_url('admin/pelamar') ?>">Edit Data Jenis Surat</a> 
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    
<div class="data-table-area mg-b-15">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="sparkline13-list">
          <br>
          <div class="sparkline13-hd">
              <div class="main-sparkline13-hd" align="center">
                <h1> Edit Data <span class="table-project-n">Edit Jenis Surat</span></h1><br>
              </div>
          </div>
        <div class="container-fluid" style="padding-right: 10%; padding-left: 10%">
        <?php foreach ($array as $kun) {?>
          <form action="<?php echo site_url();?>/adminJenSurat/edit/<?php echo $kun->id_surat?>" enctype="multipart/form-data" method="POST">
          
            <table width="100%">
          <tr>
            <td><label form-control-label>Nama Status</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="jenis_surat" type="text" class="form-control" value="<?php echo $kun->jenis_surat ?>" readonly>
              </div>
            </td>
          </tr>
          <tr>
            <td><label form-control-label>Kuota Cuti</label></td>
            <td style="height: 50px">
              <div class="col-lg-12">
                <input name="nama_surat" type="text" class="form-control" value="<?php echo $kun->nama_surat ?>">
              </div>
            </td>
          </tr>
        </table>
          
          <br>
        <div align="center">
          <input type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="Simpan">
        </div>
        </form><?php } ?>
        </div>                            
        </div>
      </div>
    </div>
  </div>
</div>


<?php $this->load->view('./footer'); ?>