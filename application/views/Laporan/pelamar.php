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
  <br><br><br>
  <p align="center" style="size: 13px">
    <b>LAPORAN DATA PENILAIAN PEGAWAI</b> <br>
  </p>
  <br>
 <table style="width: 70%;">
  <?php foreach ($array as $key): ?>
    <tr>
      <td style="width: 30%">NIK</td>
      <td style="width: 5%">:</td>
      <td style="width: 65%"><?php echo $key->nik;?></td>
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
      <td>PROFESI</td>
      <td>:</td>
      <td><?php echo $key->id_profesi;?></td>
    </tr>
    <?php foreach ($datDir as $key2): ?>
    <tr>
      <td>TEMPAT</td>
      <td>:</td>
      <td><?php echo $key2->ruangan;?></td>
    </tr>
    <?php break; endforeach ?>
  <?php break; endforeach ?>
  </table>

  <br>
  <br>
  <table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Tanggal Penilaian</th>
      <th>Penilai</th>
      <th>Jenis Penilaian</th>
      <th>Hasil</th>
    </tr>
    <?php $no = 1; foreach ($data as $key): ?>
      <tr>
        <td><?php echo $no++ ; ?></td>
        <td><?php echo date('d M Y', strtotime($key->tanggal));?></td>
        <?php $konek=mysqli_connect("localhost","root","","kepegawaian");
          $x=mysqli_fetch_array(mysqli_query($konek, "select nama from karyawan where id_karyawan = $key->id_penilai")); ?>
        <td><?php echo $x['nama'];?></td>
        <td><?php echo $key->jenis;?></td>
        <td><?php echo $key->hasil;?></td>
      </tr>
    <?php endforeach ?>
  </table>
<br><br>
</body>
</html>