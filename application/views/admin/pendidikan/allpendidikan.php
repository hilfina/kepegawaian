<?php 
  $this->load->view('./header');
  $levelku=$this->session->userdata("myLevel");
  $namaku=$this->session->userdata("myLongName");
  $emailku=$this->session->userdata("myEmail");
?><br>
 <div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"></div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="<?php echo site_url('admin/') ?>">Home</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">Data Pendidikan</span>
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
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <h1>Data <span class="table-project-n">Pendidikan</span></h1>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <div align="right"><a href="<?php echo site_url(); echo "/admin/addPend/";?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                </a></div>
              </div>
            </div>
          </div>
          <div class=" container-fluid" id="notif">
          <?php if ($this->session->flashdata('msg')) :?>
            <div class="alert alert-success"> 
            <?php echo $this->session->flashdata('msg')?>
            </div>
          <?php endif; ?>
          </div>
          <div class="sparkline13-graph">
            <div class="datatable-dashv1-list custom-datatable-overright">
              <div id="toolbar">
                <select class="form-control dt-tb">
                  <option value="">Export Basic</option>
                  <option value="all">Export All</option>
                  <option value="selected">Export Selected</option>
                </select>
              </div>
              <table id="kepegawaian" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Gambar Ijazah</th>
                    <th>Nama Karyawan</th>
                    <th>Nomor Ijazah</th>
                    <th>Nama Pendidikan</th>
                    <th>Jurusan</th>
                    <th>Nilai</th>
                    <th>Tahun Pendidikan</th>
                    <th>Verifikasi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1 ?>
                <?php foreach ($pen as $key) { ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td>
                        <a  href="" data-toggle="modal" data-target="#gambarIjasah"><?php echo "<img src='".base_url("./assets/gambar/".$key->file)."' width='100' height='100'>"; ?></a>
                            <div id="gambarIjasah" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-close-area modal-close-df">
                                        <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                      </div>
                                      <div class="modal-body">
                                        <div class="profile-info-inner">
                                          <div class="profile-img">
                                            <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->file;?>" alt=""/>
                                          </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                            </div>        
                        </td>
                        <td><?php echo $key->nama; ?></td>
                        <td><?php echo $key->nomor_ijazah; ?></td>
                        <td><?php echo $key->pendidikan; ?></td>
                        <td><?php echo $key->jurusan; ?></td>
                        <td><?php echo $key->nilai; ?></td>
                        <td><?php echo $key->mulai; echo " - "; echo $key->akhir; ?></td>
                        <td>
                        <?php 
                          if(($key->verifikasi) == 1){ ?>
                           <a href="#"> Terverifikasi</a>
                           <?php }else{ ?>
                            <a href="<?php echo site_url(); echo "/admin/verPend/";  echo $key->id;echo "/";echo $key->id_karyawan; ?>">
                              <button class="btn btn-danger waves-effect mg-b-15"><i class="fa fa-check" ></i> Verifikasi</button>
                            </a>
                          <?php } ?>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('./footer'); ?>