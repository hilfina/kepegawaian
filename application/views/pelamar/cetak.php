<?php 
$this->load->view("header.php");
?>
<br><br><br><br>

     <div class="product-status mg-b-15">
            <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list mt-b-30">
                    <div class="sparkline12-hd">
                    <br>
                        <div class="main-sparkline12-hd">
                            <span><h4 align="center">TAMPILAN CETAK KARTU SELEKSI</h4></span>
                        </div>
                    </div>
                    <br>
                    
                    <div class="sparkline12-graph">
                        <div class="input-knob-dial-wrap">
                            <table width="50%" align="center" border="2" 
                            style="
                                background-color: #b3d9ff;
                                border-color: #0066cc;
                                border-radius: 25px;
                                padding: 10px; 
                                border-collapse: collapse;
                                border-style: hidden;
                            ">
                            <?php foreach ($datasaya as $key) {?>
                                <tr>
                                    <td colspan="2" style="padding: 10px;" > <img src="<?=base_url()?>assets/login/images/logo.png" style="width: 70px"> <b style="
                                    font-size: 24px; 
                                    font-family:  merriweather, serif; "> Rumah Sakit Islam Aisyiyah Malang</b></td>
                                </tr>
                                
                                    <tr>
                                        <td rowspan="3" width="40%" style="padding: 13px;" > <img src="<?php echo base_url()?>Assets/gambar/<?php echo $key->foto;?>" alt="" width="200"/></td>
                                        <td align="center"> <b style="
                                        font-size: 19px; 
                                        font-family:  merriweather, serif;"> Kartu Peserta Seleksi </b> </td>
                                    </tr>
                                    <tr>
                                        <td align="center"> <b <b style="
                                        font-size: 19px; 
                                        font-family:  merriweather, serif;"><?php echo $key->nama;?> </b></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td align="center"><b style="
                                        font-size: 19px; 
                                        font-family:  merriweather, serif;"> No. Seleksi : <?php echo $datsel->id_seleksi;?> </b></td>
                                    </tr>
                                
                              </table>
                        </div>
                        <br><br>
                        <div align="center">
                            <a href="<?php echo site_url(); echo "/pelamar/Laporan/"; echo $datsel->id_karyawan ;?>">
                        <button class="btn btn-primary waves-effect waves-light mg-b-15"><i class="fa fa-print" aria-hidden="true"></i> Cetak Kartu Seleksi</button>

                        </div>
                        
                      </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view("footer.php"); ?>
    