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
          <div class="sparkline12-hd"><br>
            <div class="main-sparkline12-hd">
              <span><h4 align="center">Tambah Data Pengguna</h4></span>
            </div>
          </div><br>
          <div class="container-fluid" role="alert">
              <?php if ($this->session->flashdata('msg_error')) :?>
                <div class="alert alert-danger alert-mg-b"> 
                <?php echo $this->session->flashdata('msg_error')?>
                </div>
              <?php endif; ?>
          </div>

          <form action="<?php echo site_url(); ?>/adminPengguna/add/" enctype="multipart/form-data" method="post">
            <div class="sparkline12-graph">
              <div class="input-knob-dial-wrap">
              <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title">
                      <label>NIK</label>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <select type="text" class="chosen-select" name="nik">
                        <option> -- Pilihan -- </option>
                       <?php
                          $cari = $this->db->query("SELECT * from karyawan as k inner join login as l on k.id_karyawan = l.id_karyawan where id_status != 'Pelamar' and id_status != 'Calon Karyawan' and level != 'admin' and level != 'Super Admin' group by nik ");
                          $nik = $cari->result();
                          foreach ($nik as $nik) { ?>
                            <?php $carii = $this->db->query("SELECT * FROM login where id_karyawan = '$nik->id_karyawan' and (level = 'admin' OR level = 'Super Admin') ");
                            if (!$carii->row()) { ?>
                              <option> <?php echo $nik->nik."-".$nik->nama ?> </option>
                            <?php }else{} ?>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title">
                      <label>Level Pengguna</label>
                    </div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <select  class="form-control" name="level">
                      <option>--Pilihan--</option>
                      <option>admin</option>
                      <option>Super Admin</option>
                      </select>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="input-mask-title"></div>
                  </div>
                  <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <div class="input-mark-inner">
                      <button type="submit" class="btn btn-primary waves-effect waves-light mg-b-15" value="send" >Tambah Pengguna</button>
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
</div>
<?php $this->load->view('./footer'); ?>