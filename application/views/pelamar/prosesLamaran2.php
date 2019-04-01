<?php 
$this->load->view("pelamar/headerhome.php");
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
                                <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">Administrasi<br>LULUS </td></tr>
                            </table> 
                        <?php }elseif ($key->id_status == "Pelamar Ditolak") { ?>
                            <table border="5" style="border-color:  #FF1000">
                                <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">Administrasi<br>GAGAL</td></tr>
                            </table> 
                        <?php }else { ?>
                           <table border="5" style="border-color: yellow">
                                <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">Administrasi<br>SEDANG DIPROSES</td></tr>
                            </table> 
                    <?php }
                    } ?><br>
                    <?php foreach ($lengkap as $sel) { 
                        if ($sel->nilai_wawancara == "") { ?>
                        <table border="5" style="border-color: yellow">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">WAWANCARA<br>SEDANG DIPROSES</td></tr>
                        </table>
                        <?php }elseif ($sel->nilai_wawancara == "Lulus") { ?>
                            <table border="5" style="border-color: #ADFF2F">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">WAWANCARA<br>LULUS</td></tr>
                        </table>
                        <?php }elseif($sel->nilai_wawancara == "Tidak Lulus") { ?>
                            <table border="5" style="border-color: #FF1000">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">WAWANCARA<br>TIDAK LULUS</td></tr>
                        </table>
                        <?php }else{ ?>
                            <table border="5">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">WAWANCARA<br>BELUM SAMPAI TAHAP INI</td></tr>
                        </table>
                      <?php  }
                    } ?>
                    <br>
                    <?php foreach ($lengkap as $a) { 
                        if ($a->nilai_wawancara == "Lulus" && $a->tes_psikologi == "") { ?>
                        <table border="5" style="border-color: yellow">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES PSOKOLOGI<br>SEDANG DIPROSES</td></tr>
                        </table>
                        <?php }elseif ($a->nilai_wawancara == "Lulus" && $a->tes_psikologi == "Lulus") { ?>
                            <table border="5" style="border-color: #ADFF2F">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES PSOKOLOGI<br>LULUS</td></tr>
                        </table>
                        <?php }elseif($a->nilai_wawancara == "Lulus" && $a->tes_psikologi == "Tidak Lulus") { ?>
                            <table border="5" style="border-color: #FF1000">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES PSOKOLOGI<br>TIDAK LULUS</td></tr>
                        </table>
                        <?php }else{ ?>
                            <table border="5">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES PSIKOLOGI<br>BELUM SAMPAI TAHAP INI</td></tr>
                        </table>
                      <?php  }
                    } ?><br>
                    <?php foreach ($lengkap as $sel) { 
                        if ($sel->tes_psikologi == "Lulus") { ?>
                            <table border="5" style="border-color: YELLOW">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES SELEKSI<br>SEDANG DIPROSES</td></tr>
                        </table>
                        <?php }elseif ($sel->tes_psikologi == "Lulus" && $sel->nilai_agama >= "60" && $sel->nilai_kompetensi >= "60" && $sel->tes_kesehatan == "Lulus") { ?>
                            <table border="5" style="border-color: #ADFF2F">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES SELEKSI<br>LULUS</td></tr>
                        </table>
                        <?php }elseif($sel->tes_psikologi == "Lulus" && $sel->nilai_agama <= "59" && $sel->nilai_kompetensi <= "59" && $sel->tes_kesehatan != "Lulus") { ?>
                            <table border="5" style="border-color: #FF1000">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES SELEKSI<br>TIDAK LULUS</td></tr>
                        </table>
                        <?php }else{ ?>
                            <table border="5">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">TES SELEKSI<br>BELUM SAMPAI TAHAP INI</td></tr>
                        </table>
                      <?php  }
                    } ?><br>
                    <?php foreach ($lengkap as $sel) { 
                        if ($sel->tes_psikologi == "Lulus" && $sel->nilai_agama >= "60" && $sel->nilai_kompetensi >= "60" && $sel->tes_kesehatan == "Lulus") { ?>
                            <table border="5" style="border-color: YELLOW">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">FINALISASI<br> SEDANG DIPROSES</td></tr>
                        </table>
                        <?php }elseif ($sel->id_status == "Magang") { ?>
                            <table border="5" style="border-color: #ADFF2F">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">FINALISASI<br>LULUS</td></tr>
                        </table>
                        <?php }elseif($sel->id_status == "Pelamar" && $sel->id_profesi == "") { ?>
                            <table border="5" style="border-color: #FF1000">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">FINALISASI<br>TIDAK LULUS</td></tr>
                        </table>
                        <?php }else{ ?>
                            <table border="5">
                            <tr><td style="background-color: #FFDAB9; height: 70px; width: 300px" align="center">FINALISASI<br>BELUM SAMPAI TAHAP INI</td></tr>
                        </table>
                      <?php  }
                    } ?>
                        <br>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
<?php $this->load->view("footer.php"); ?>