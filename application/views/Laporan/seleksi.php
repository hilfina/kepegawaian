<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Laporan</title>
  <link href="https://fonts.googleapis.com/css?family=merriweather:100,300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>Assets/template/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>

  </style>
</head>
<body>
  <table width="100%" align="center" border="2" 
  style="
      background-color: #b3d9ff;
      border-color: blue;
      border-radius: 25px;
      padding: 10px;
      border-collapse: collapse;
      border-style: hidden;
  ">
  <?php foreach ($datasaya as $key):?>
      <tr>
          <td colspan="2" style="padding: 10px;" > <img src="assets/login/images/logo.png" style="width: 50px"> <b style="
          font-size: 24px; 
          font-padding-bottom: 20px;
          font-weight: 20px;
          font-family:  merriweather, serif; "><b> Rumah Sakit Islam Aisyiyah Malang</b></td>
      </tr>
      
          <tr>
              <td rowspan="3" width="40%" style="padding: 2px;" > <img src="Assets/gambar/<?php echo $key->foto;?>" alt="" width="160"/></td>
              <td align="center"> <b style="
              font-size: 19px; 
              font-family:  merriweather, serif;"> Kartu Peserta Seleksi </b> </td>
          </tr>
          <tr>
              <td align="center"> <b <b style="
              font-size: 19px; 
              font-family:  merriweather, serif;"><?php echo $key->nama;?> </b></td>
          </tr>
          <?php break; endforeach ?>
          <tr>
              <td align="center"><b style="
              font-size: 19px; 
              font-family:  merriweather, serif;"> No. Seleksi : <?php echo $datsel->id_seleksi;?> </b></td>
          </tr>   
    </table>
</body>
</html>