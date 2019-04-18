<?php 
$this->load->view("header.php");
$idku=$this->session->userdata("myId");
?><br>
<div class="breadcome-area"><br>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        <div class="breadcome-list single-page-breadcome">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
              <h3 align="center"><b>Proses Seleksi Anda Sebagai <?php foreach ($datDir as $k) {echo $k->id_profesi; } ?></b></h3>
              <hr style="border: solid 2px; width: 250px; background-color: black">
              <hr style="border: solid 1px; width: 200px; background-color: black">
            </div>            
          </div><br>          

          <?php foreach ($datDir as $key) { 
            if ($key->id_status == "Calon Karyawan") { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">SELEKSI ADMINISTRASI</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($key->id_status == "Pelamar Ditolak") { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">SELEKSI ADMINISTRASI</font></b><hr style="width: 90%">GAGAL
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">SELEKSI ADMINISTRASI</font></b><hr style="width: 90%"><?php foreach ($lengkap as $key) { echo $key->tgl_seleksi;  } ?>
              </div> 
            <?php }
          } ?><br>
          <?php foreach ($lengkap as $a) { 
            if ($a->nilai_kompetensi == "-" && $a->id_status == "Calon Karyawan") { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES TULIS</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { echo $key->tgl_seleksi;  } ?>
              </div>
            <?php }elseif ($a->nilai_kompetensi == "Lulus") { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">TES TULIS</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->nilai_kompetensi == "Tidak Lulus") { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">TES TULIS</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES TULIS</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>          
          <br>
          <?php foreach ($lengkap as $a) { 
            if ($a->nilai_wawancara == "-" && $a->nilai_kompetensi == "Lulus") { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES WAWANCARA</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { echo $key->tgl_seleksi;  } ?>
              </div>
            <?php }elseif ($a->nilai_wawancara == "Lulus") { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">TES WAWANCARA</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->nilai_wawancara == "Tidak Lulus") { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">TES WAWANCARA</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES WAWANCARA</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>          
          <br>
          <?php foreach ($lengkap as $a) { 
            if ($a->tes_psikologi == "-" && $a->nilai_wawancara == "Lulus") { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES PSIKOLOGI</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { echo $key->tgl_seleksi;  } ?>
              </div>
            <?php }elseif ($a->tes_psikologi == "Lulus") { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">TES PSIKOLOGI</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->tes_psikologi == "Tidak Lulus") { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">TES PSIKOLOGI</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES PSIKOLOGI</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>          
          <br>
          <?php foreach ($lengkap as $a) { 
            if ($a->nilai_agama == "-" && $a->tes_kesehatan == "-" && $a->tes_psikologi == "Lulus") { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES AGAMA DAN KESEHATAN</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { echo $key->tgl_seleksi;  } ?>
              </div>
            <?php }elseif ($a->nilai_agama == "Lulus" || $a->tes_kesehatan == "Lulus") { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">TES AGAMA DAN KESEHATAN</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->nilai_agama == "Tidak Lulus" || $a->tes_kesehatan == "Tidak Lulus") { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">TES AGAMA DAN KESEHATAN</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES AGAMA DAN KESEHATAN</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>          
          <br> 
          <?php foreach ($lengkap as $a) { 
            if ($a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->id_status == "Calon Karyawan") { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">FINALISASI AKHIR</font></b><hr style="width: 90%">SEDANG DIPROSES
              </div>
            <?php }elseif ($a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->id_status == "Magang") { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">FINALISASI AKHIR</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->nilai_agama != "-" && $a->id_status == "Pelamar") { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">FINALISASI AKHIR</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">FINALISASI AKHIR</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>          
          <br>          
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view("footer.php"); ?>