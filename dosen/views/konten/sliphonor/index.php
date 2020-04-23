<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Honor Dosen
      <small>Cetak Slip Honor Dosen</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-money"></i> Honor Dosen</a></li>
      <li class="active"><a href="#">Slip Honor Dosen</a></li>
    </ol>
  </section>
  <!-- Content Header
       Main content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "sliphonor"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <form class="form-horizontal" action="<?php echo base_url(); ?>d.php/sliphonor/cetak" method="post" target="_blank">
        <!-- Box Body -->
        <div class="box-body">
          <br><br>
          <p class="lead col-sm-offset-2">Kriteria Laporan</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">Cetak Untuk Bulan</label>
            <div class="col-sm-3">
              <select name="bulan" class="form-control">
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                <option value="April">April</option>
                <option value="Mei">Mei</option>
                <option value="Juni">Juni</option>
                <option value="Juli">Juli</option>
                <option value="Agustus">Agustus</option>
                <option value="September">September</option>
                <option value="Oktober">Oktober</option>
                <option value="November">November</option>
                <option value="Desember">Desember</option>
              </select>
            </div>
            <div class="col-sm-2">
              <input type="number" name="tahun" class="form-control" placeholder="Tahun" onkeypress="return isNumberKey(event)" required>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Nama Dosen</label>
            <div class="col-sm-5">
              <select class="form-control select2" name="id_dosen">
                <option value="all">Semua</option>
                <?php foreach ($loaddosen as $key) { ?>
                  <?php
                    $gelar = "";
                    if($key['gelar'] != ""){
                      $gelar = ", ".$key['gelar'];
                    }?>
                  <option value="<?php echo $key['id_dosen']; ?>">
                    <?php echo $key['nama_lengkap'].$gelar; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Tahun Ajaran</label>
            <div class="col-sm-5">
              <select class="form-control" name="thn_ajaran">
                <?php foreach ($loaddata as $key) { ?>
                  <option value="<?php echo $key['thn_ajaran'] ?>">
                    <?php echo $key['thn_ajaran'] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Dari Tanggal</label>
            <div class="col-sm-5">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="periode_dari">
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Sampai Tanggal</label>
            <div class="col-sm-5">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker2" name="periode_sampai">
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
              <div class="checkbox">
                <label>
                  <input type="checkbox" checked name="rekamcetak" value="1">
                  Rekam cetak laporan
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
              <input type="submit" class="btn btn-success" name="cetak" value="Mulai Cetak">
            </div>
          </div>
          <br><br>
        </div>
        <!-- Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->

  </section>
  <!-- Finish Main Content -->