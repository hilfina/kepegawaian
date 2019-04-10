<?php 
$this->load->view("header.php");
$idku=$this->session->userdata("myId");
?>
<div class="breadcome-area"><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list single-page-breadcome"> <br>
                    <div class="alert alert-warning" align="center">
                    <span><h3><b>PROSES LAMARAN</b></h3></span><br>
                    <?php foreach ($datDir as $key) { 
                        if ($key->id_status == "Calon Karyawan") { ?>
                            <table border="5" style="border-color: #ADFF2F">
                                <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">ADMINISTRASI<br>LULUS </td></tr>
                            </table> 
                        <?php }elseif ($key->id_status == "Pelamar Ditolak") { ?>
                            <table border="5" style="border-color:  #FF1000">
                                <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">ADMINISTRASI<br>GAGAL</td></tr>
                            </table> 
                        <?php }else { ?>
                           <table border="5" style="border-color: yellow">
                                <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">ADMINISTRASI<br>SEDANG DIPROSES</td></tr>
                            </table> 
                    <?php }
                    } ?>
                    <br>
                        <table border="5">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">WAWANCARA<br>BELUM SAMPAI TAHAP INI</td></tr>
                        </table>
                        <br>
                        <table border="5">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES SELEKSI<br>BELUM SAMPAI TAHAP INI</td></tr>
                        </table>
                        <br>
                        <table border="5">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">FINALISASI<br>BELUM SAMPAI TAHAP INI</td></tr>
                        </table><br>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
<?php $this->load->view("footer.php"); ?>