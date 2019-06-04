<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan</title>
  <link rel="stylesheet" href="">
  <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    .line-title{
      border: 0;
      border-style: inset;
      border-top: 1px solid #000;
    }
  </style>
</head>
<body>

  <br><br><br>
  <br><br><br>
  <H4 align="center" style="size: 13px">
    LAPORAN DATA SELEKSI PELAMAR <br>
    <b>TAHUN <?php echo date('Y');?></b>
  </H4>

  <br>
  <br>
  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Nama Lengkap</th>
      <th>Profesi yang dilamar</th>
      <th>Nilai Wawancara</th>
      <th>Nilai Kompetensi</th>
      <th>Hasil Kesehatan</th>
      <th>Hasil Psikologi</th>
      <th>Nilai Agama</th>
    </tr>
    <?php $no = 1; foreach ($array as $key): ?>
      <tr>
        <td><?php echo $no++ ; ?></td>
        <td><?php echo $key->nama;?></td>
        <td><?php echo $key->nama_profesi;?></td>
        <td><?php echo $key->nilai_wawancara;?></td>
        <td><?php echo $key->nilai_kompetensi;?></td>
        <td><?php echo $key->tes_kesehatan;?></td>
        <td><?php echo $key->tes_psikologi;?></td>
        <td><?php echo $key->nilai_agama;?></td>
      </tr>
    <?php endforeach ?>
  </table>
<br><br>
</body>
</html>