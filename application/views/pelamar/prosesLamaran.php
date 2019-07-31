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
              <h3 align="center"><b>Proses Seleksi Anda Sebagai <?php foreach ($datDir as $k) { $nama=$k->id_profesi; } 
              $konek = mysqli_connect("localhost","root","","kepegawaian");
                $data2=mysqli_fetch_array(mysqli_query($konek,"select nama_profesi from jenis_profesi as j inner join karyawan as k on k.id_profesi=j.id_profesi where k.id_profesi = '$nama' "));
                echo $data2['nama_profesi'];;?></b></h3>
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
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">SELEKSI ADMINISTRASI</font></b><hr style="width: 90%">MASIH DIPROSES
              </div><br>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES TULIS DAN WAWANCARA</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
              <br>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES AGAMA</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
              <br>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES KESEHATAN</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
              <br>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES PSIKOLOGI</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
              <br>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">FINALISASI AKHIR</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div>  
            <?php }
          } ?><br>
          <?php foreach ($lengkap as $a) { 
            if ($a->nilai_kompetensi == "-" && $a->nilai_wawancara == "-" && $a->id_status == "Calon Karyawan") { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES TULIS DAN WAWANCARA</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { 
                if ($a->tgl_seleksi == "0000-00-00") {echo "Belum Ditentukan";}else{echo date('d M Y', strtotime($key->tgl_seleksi));}} ?>
              </div>
            <?php }elseif ($a->nilai_kompetensi >= 30 && $a->nilai_wawancara >= 30 ){ ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">TES TULIS DAN WAWANCARA</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->nilai_kompetensi >= 30 && $a->nilai_wawancara >= 30) { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">TES TULIS DAN WAWANCARA</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES TULIS DAN WAWANCARA</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>          
          <br>
          <?php foreach ($lengkap as $a) { 
            if ($a->nilai_agama == "-" && $a->nilai_kompetensi >= 30 && $a->nilai_wawancara >= 30) { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES AGAMA</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { echo date('d M Y', strtotime($key->tgl_seleksi));  } ?>
              </div>
            <?php }elseif ($a->nilai_agama >= 30) { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">TES AGAMA</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->nilai_agama < 30 && $a->nilai_agama != "-") { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">TES AGAMA</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES AGAMA</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>
          <br>
          <?php foreach ($lengkap as $a) { 
            if ($a->nilai_agama >= 30 && $a->tes_kesehatan == "-") { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES KESEHATAN</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { echo date('d M Y', strtotime($key->tgl_seleksi));  } ?>
              </div>
            <?php }elseif($a->tes_kesehatan == "Lulus") { ?>
              <div class="lulus container-fluid" align="center">
                <br><b><font size="2">TES KESEHATAN</font></b><hr style="width: 90%">LULUS
              </div>
            <?php }elseif ($a->tes_kesehatan == "Tidak Lulus" ) { ?>
              <div class="gagal container-fluid" align="center">
                <br><b><font size="2">TES KESEHATAN</font></b><hr style="width: 90%">TIDAK LULUS
              </div>
            <?php }else { ?>
              <div class="belom container-fluid" align="center">
                <br><b><font size="2">TES KESEHATAN</font></b><hr style="width: 90%">BELUM SAMPAI TAHAP INI
              </div> 
            <?php }
          } ?>    
          <br>
          <?php foreach ($lengkap as $a) { 
            if ($a->tes_psikologi == "-" && $a->tes_kesehatan >= 30) { ?>
              <div class="masih container-fluid" align="center">
                <br><b><font size="2">TES PSIKOLOGI</font></b><hr style="width: 90%">Tanggal Seleksi : <?php foreach ($lengkap as $key) { echo date('d M Y', strtotime($key->tgl_seleksi));  } ?>
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