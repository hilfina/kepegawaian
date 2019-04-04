<?php 
$this->load->view("header.php");
$idku=$this->session->userdata("myId");
?>
<br><br><br><br>
        <div class="container-fluid">
            <div class="row text-center title">
                <div align="center"><span><h3 align="center"><b>PELUANG KARIR</b></h3></span></div>
                <br><br>
            </div>
                <?php foreach ($loker as $key) {?>
                    <div class="col-md-4" >
                    <div class="service" style="height: 450px">
                        <div class="icon-holder">
                            <img src="<?=base_url()?>asset/img/icons/heart-blue.png" alt="" class="icon">
                        </div>
                        <h5 class="heading"><?php echo $key->nama_profesi;?></h5>
                        <font face="Arial">
                            <p class="description">
                            <strong>Mulai :</strong> <?php echo date('d - M - Y', strtotime($key->mulai));?> <br>
                            <strong>Sampai :</strong> <?php echo date('d - M - Y', strtotime($key->akhir));?> <br><br>
                            <strong>Jurusan :</strong> <?php echo $key->jurusan;?><br>
                            <strong>IPK Min :</strong> <?php echo $key->ipkmin;?><br>
                            <?php echo $key->jenkel;?> <br><strong> dengan usia maks </strong> <?php echo $key->usia;?> tahun<br> 

                        <br>
                        <font color="red">
                            <?php if ( date('y-m-d') <= $key->akhir) {
                                echo "Sedang Dibuka <br>"; ?>
                                <a href="<?php echo site_url(); echo "/pelamar/lamar/"; echo $idku ; echo "/"; echo $key->id_profesi; ?>"> <button class='btn-link'>Lamar Sekarang</button></a>

                            <?php 
                        }else{
                                echo "Sudah Ditutup";
                            }
                            ?></font>

                        </p>
                        </font>
                    </div>
                </div>
                <?php } ?>
                </div>
        </div>

<?php $this->load->view("footer.php"); ?>