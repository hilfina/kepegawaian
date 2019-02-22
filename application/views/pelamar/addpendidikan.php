<!-- PENDIDIKAN YANG DILAKUKAN-->
    <div class="tab">
      <span><h4 align="center">DATA RIWAYAT PENDIDIKAN</h4></span>
    <br>
    <?php foreach ($last as $key) { ?>
    <input type="hidden" name="id_karyawan" value="<?php echo $key['id_karyawan']+1?>">
    <?php } ?>
    <div class="form-group row">
      <label class="col-sm-3 form-control-label">Pendidikan :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="pendidikan"  placeholder="Pendidikan">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Tahun Mulai Pendidikan :</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="mulai">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Tahun Akhir Pendidikan :</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="akhir">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Nomor Ijazah :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="nomor_ijazah">
        </div>
      </div> 
      <div class="form-group row">
        <label class="col-sm-3 form-control-label">Masukkan Gambar Ijazah :</label>
        <div class="col-sm-9">
          <input type="file" class="form-control" name="pendidikanfile" />
          <p>*maximal ukuran gambar adalah 20mb</p>
        </div>
      </div> 
      
      <br> 
    </div>

    <!-- SIP STR -->
    <div class="tab">
      <span><h5 align="center">DATA SURAT IZIN PRAKTEK / SURAT TANDA REGISTRASI</h5></span>
    <br>
    <?php foreach ($last as $key) { ?>
    <input type="hidden" name="id_karyawan" value="<?php echo $key['id_karyawan']+1?>">
    <?php } ?>
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Jenis Surat:</label>
        <div class="col-sm-9">
          <select type="text" class="form-control" id="id_surat" name="id surat">
           <?php
              $konek = mysqli_connect("localhost","root","","kepegawaian");
              $query = "select nama_surat from jenis_surat";
              $hasil = mysqli_query($konek, $query);
              while ($data=mysqli_fetch_array($hasil)) {?>
              ?>
                <option> <?php echo $data['nama_surat']?> </option>
            <?php }?>
          </select>
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Tanggal Mulai Surat :</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="tgl_mulai">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Tanggal Akhir Surat :</label>
        <div class="col-sm-9">
          <input type="date" class="form-control" name="tgl_akhir">
        </div>
      </div> 
      <div class="form-group row">
      <label class="col-sm-3 form-control-label">Nomor Surat :</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="no_surat">
        </div>
      </div> 
      <div class="form-group row">
        <label class="col-sm-3 form-control-label">Masukkan Gambar Surat :</label>
        <div class="col-sm-9">
          <input type="file" class="form-control" name="suratfile" />
          <p>*maximal ukuran gambar adalah 20mb</p>
        </div>
      </div> 
      <br> 
    </div>
 