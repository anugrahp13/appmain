<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pengaturan Lainnya
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-hourglass-end"></i> Pengaturan Lainnya</a></li>
      <li class="active">Daftar Pengaturan Lainnya</li>
    </ol>
  </section>
  <!-- Finish Content Header
       Main Content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "pengaturanlain"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <form class="form-horizontal" action="" method="post">
        <!-- Box Body -->
        <div class="box-body">
          <p class="lead col-sm-offset-2">Masa Kerja</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">0 - 3 Tahun</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="0_3thn" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['0_3thn']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">3 - 5 Tahun</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="3_5thn" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['3_5thn']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">5 - 10 Tahun</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="5_10thn" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['5_10thn']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">10 - 15 Tahun</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="10_15thn" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['10_15thn']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">> 15 Tahun</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="l15thn" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['l15thn']; ?>" required>
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">Koreksi Soal</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">2 SKS</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="2sks" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['2sks']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">4 SKS</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="4sks" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['4sks']; ?>" required>
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">Pembuatan Soal</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">UTS</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="puts" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['puts']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">UAS</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="puas" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['puas']; ?>" required>
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">PPh 21 (%)</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">Ada NPWP</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" step="0.01" name="pph_npwp" placeholder="Persentase" onkeypress="return isNumberKey2(event)" value="<?php echo $loaddata['pph_npwp']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Tidak Ada NPWP</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" step="0.01" name="pph_nonpwp" placeholder="Persentase" onkeypress="return isNumberKey2(event)" value="<?php echo $loaddata['pph_nonpwp']; ?>" required>
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">Lainnya</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">Transport</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="transport" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['transport']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">NIDN</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="nidn" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['nidn']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Dosen Favorit</label>
            <div class="col-sm-5">
              <input class="form-control" type="number" name="dsn_favorit" onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['dsn_favorit']; ?>" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-5">
              <input type="submit" class="btn btn-success" name="simpan" value="Simpan data">
            </div>
          </div>
        </div>
        <!-- Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->

  </section>
  <!-- Finish Main Content -->
