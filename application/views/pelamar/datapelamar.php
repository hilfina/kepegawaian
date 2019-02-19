<?php 
	$this->load->view('./header.php');
	$levelku=$this->session->userdata("myLevel");
	$namaku=$this->session->userdata("myLongName");
	$emailku=$this->session->userdata("myEmail");
	$idku=$this->session->userdata("myId");
 ?>
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
                                    <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">Data Saya</span>
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
      <div class="data-table-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                <h1>Data <span class="table-project-n">Diri</span></h1>
                            </div>
                        </div>
                        <div class="sparkline13-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                
                                <table id="kepegawaian" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                              <thead style="background-color: #fffff0;">
                                <tr>
                                  <th>NIK</th>
                                  <th>NO. KTP</th>
                                  <th>NO. BPJS</th>
                                  <th>NAMA</th>
                                  <th>ALAMAT</th>
                                  <th>NO. TELEPON</th>
                                  <th>EMAIL</th>
                                  <th>PROFESI YANG DILAMAR</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php foreach ($datasaya as $key) { ?>
                                  <tr>
                                    <td><?php echo $key->nik?></td>
                                    <td><?php echo $key->no_ktp?></td>
                                    <td><?php echo $key->no_bpjs?></td>
                                    <td><?php echo $key->nama?></td>
                                    <td><?php echo $key->alamat?></td>
                                    <td><?php echo $key->no_telp?></td>
                                    <td><?php echo $key->email?></td>
                                    <td><?php echo $key->id_profesi?></td>
                                  </tr>
                                 <?php } ?>
                               </tbody>
                            </table>
                          </div>
                        <!-- END DATA TABLE-->
                      </div>
              	</div>
              </div>
            </div>
          </div>  
        </div>
  	  </div>  
</div>

<?php $this->load->view('./footer'); ?>