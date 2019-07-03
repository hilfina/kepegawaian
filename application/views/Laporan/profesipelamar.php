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
    <b>LAPORAN DATA PELAMAR <?php echo strtoupper($judul->nama_profesi); ?></b><br>
    <b>MASUK TAHAP SELEKSI TAHUN <?php echo date('Y');?></b>
  </H4>

  <br>
  <br>
  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Nama Lengkap</th>
      <th>Jenis Kelamin</th>
      <th>Umur</th> 
      <th>Pendidikan Terakhir</th>
      <th>Nilai Akhir</th>
      <th>Tahun Lulus</th>
    </tr>
    <?php $no = 1; foreach ($array as $key): ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $key->nama; ?></td>
        <td><?php echo $key->jenkel;?></td>
        <td><?php $tdy = date('Y'); $lhr = substr($key->ttl, 0,4); echo $tdy-$lhr; ?></td>
        <td><?php echo $key->pendidikan;   echo " - "; echo $key->pend_akhir; echo " "; echo $key->jurusan ?></td>
        <td><?php echo $key->nilai_akhir; ?></td>
        <td><?php echo $key->akhir; ?></td>
      </tr>
    <?php endforeach ?>
  </table>
<br><br>
</body>
</html>