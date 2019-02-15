<?php $this->load->view('header');?>
<?php 
$username = ($this->session->userdata['logged_in']['username']);
$level = ($this->session->userdata['logged_in']['level']);


 ?>
  
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Home <small>different form elements</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                   <h1> Welcome To Perpustakaan  <?php echo "$username"; ?></h1>
                    
                    <br>

                   <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count">179</div>
                  <h3>User </h3>
                  <p>User Yang Terdaftar</p>
                </div>
              </div>

               <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-tags"></i></div>
                  <div class="count">179</div>
                  <h3>Peminjaman</h3>
                  <p>Total Peminjaman</p>
                </div>
              </div>

               <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-tag"></i></div>
                  <div class="count">179</div>
                  <h3>Pengembalian</h3>
                  <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
              </div>

               <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-book"></i></div>
                  <div class="count">179</div>
                  <h3>Buku</h3>
                  <p>Lorem ipsum psdea itgum rixt.</p>
                </div>
              </div>

              



                    </form>
                  </div>
                </div>
              </div>
            </div>
<?php $this->load->view('footer');?>
            
          
	 