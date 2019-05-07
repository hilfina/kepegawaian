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
  <img src="Assets/gambar/kopsurat.jpg" style="position: absolute; width: 700px; height: auto;">
  <br><br><br>
  <br><br><br>
  <br><br><br>
  <p align="center" style="size: 13px">
    LAPORAN DATA RIWAYAT <br>
    <b>Golongan Pegawai</b>
  </p>
  <br>
 <table style="width: 40%;">
  <?php foreach ($array as $key): ?>
    <tr>
      <td>NIK</td>
      <td>:</td>
      <td><?php echo $key->nik;?></td>
    </tr>
    <tr>
      <td>NAMA</td>
      <td>:</td>
      <td><?php echo $key->nama;?></td>
    </tr>
    <tr>
      <td>STATUS  </td>
      <td>:</td>
      <td><?php echo $key->id_status;?></td>
    </tr>
    <tr>
      <td>JABATAN  </td>
      <td>:</td>
      <td><?php echo $key->jabatan;?></td>
    </tr>
    <tr>
      <td>GOLONGAN  </td>
      <td>:</td>
      <td><?php echo $key->id_golongan;?></td>
    </tr>
    <tr>
      <td>PROFESI</td>
      <td>:</td>
      <td><?php echo $key->id_profesi;?></td>
    </tr>
     <?php break; endforeach ?>
  </table>

  <br>
  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Nomor SK</th>
      <th>Status</th>
      <th>Masa Berlaku</th>
    </tr>
    <?php $no = 1; foreach ($data as $key): ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $key->nomor_sk; ?></td>
        <td><?php echo $key->id_golongan; ?></td>
        <td><?php 
        echo date('d M Y', strtotime($key->mulai))." - ";
        echo date('d M Y', strtotime($key->akhir)); ?>
        </td>
      </tr>
    <?php endforeach ?>
  </table>
<br><br>
<img src="Assets/gambar/footsurat.jpg" style="position: absolute; width: 800px; height: auto;">
</body>
</html>