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
                <div align="right">
                <a href="<?php echo site_url(); echo "/adminPendidikan/loadimpor/";?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Upload Data</button>
                </a>
                <a href="<?php echo site_url(); echo "/adminPendidikan/addPend/";?>">
                  <button class="btn btn-primary waves-effect waves-light mg-b-15">Tambah Data</button>
                </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class=" container-fluid" id="notif">
            <?php if ($this->session->flashdata('msg')) :?>
              <div class="alert alert-success"> 
              <?php echo $this->session->flashdata('msg')?>
              </div>
            <?php endif; ?>
            </div>
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
                    <th>Nama Karyawan</th>
                    <th>Nomor Ijazah</th>
                    <th>Nama Institusi</th>
                    <th>Jurusan</th>
                    <th>Periode</th>
                    <th>Nilai IPK</th>
                    <th>File Ijasah</th>
                    <th>Status</th>
                    <th>Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1 ?>
                <?php foreach ($pen as $key) { ?>
                  <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $key->nama; ?></td>
                      <td><?php echo $key->nomor_ijazah; ?></td>
                      <td><?php echo $key->pendidikan; ?></td>
                      <td><?php echo $key->jurusan; ?></td>
                      <td><?php echo $key->mulai; echo " - "; echo $key->akhir; ?></td>
                      <td><?php echo $key->nilai; ?></td>
                      <td>
                        <?php if(($key->file) != NULL){ ?>
                          <a href="<?php echo base_url().'/Assets/dokumen/'.$key->file; ?>" download>
                            <button class="btn btn-default waves-effect" class='submit'><i class="fa fa-download" aria-hidden="true"></i> Unduh File</button>
                          </a>
                        <?php }else{ ?>
                          <font style="color: red">Tidak Ada file</font>
                        <?php } ?>
                      </td>
                      <td>
                        <?php 
                        if(($key->verifikasi) == 1){ ?>
                         <p style="color: blue"> terverifikasi</p> 
                         <?php }else{ ?>
                          <a href="<?php echo site_url(); echo "/admin/verPend/";  echo $key->id;echo "/";echo $key->id_karyawan; ?>">
                            <button class="btn btn-danger waves-effect" title="VERIFIKASI DATA" ><i class="fa fa-check" ></i></button>
                          </a>
                        <?php } ?>
                      </td>
                      <td><a href="<?php echo site_url(); echo "/adminPendidikan/editPend/";  echo $key->id ; ?>">
                      <button title="Edit / Detail" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                      <a href="<?php echo site_url(); echo "/adminPendidikan/delPend/";  echo $key->id ; ?>"  onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                      <button title="Hapus Data" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</button>
                      </a>
                
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