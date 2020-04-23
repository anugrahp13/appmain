
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Penilaian
    <small>Cetak Penilaian Peserta</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/datapkt">Penilaian</a></li>
    <li class="active">Cetak data</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "cetakpenilaian"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-body">
      <form method="post" action="" class="form-horizontal" target="_blank">
        <p class="lead col-sm-offset-2">Cetak Data</p>
        <div class="form-group">
          <label class="col-sm-4 control-label">Tahun Ajaran</label>
          <div class="col-sm-6">
            <select class="form-control select2" name="tahun_ajaran" id="etahun" required>
              <option disabled selected>Pilih</option>
              <?php foreach ($loadtahun as $keytahun) {?>
                <option value="<?php echo $keytahun['tahun_ajaran']; ?>"><?php echo $keytahun['tahun_ajaran']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Bidang</label>
          <div class="col-sm-6">
            <select class="form-control select2 select2" name="bidang" id="ebidang" required>
              <option disabled selected>Pilih</option>
              <?php foreach ($loadbidang as $keybidang) {?>
                <option value="<?php echo $keybidang['id_bidang']; ?>"><?php echo $keybidang['nama_bidang']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Periode</label>
          <div class="col-sm-6">
            <select class="form-control select2" name="periode" id="eperiode" required>
              <option disabled selected>Pilih</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Peserta</label>
          <div class="col-sm-6">
            <select class="form-control select2" name="nama_peserta" id="epeserta" required>
              <option disabled selected>Pilih</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-6">
            <input type="submit" name="btnsend" value="Mulai Cetak" class="btn btn-default">
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(function () {
  $('#ebidang').on('select2:select', function () {
    var tahunajaran = $("#etahun").val();
    var bidang = $("#ebidang").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxcetakperiode',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {tahun:tahunajaran,bidang:bidang},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#eperiode').html(data);	// mengisi konten
      }
    });
  });

  $('#eperiode').on('select2:select', function () {
    var tahunajaran = $("#etahun").val();
    var bidang = $("#ebidang").val();
    var periode = $("#eperiode").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxcetakpeserta',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {tahun:tahunajaran,bidang:bidang,periode:periode},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#epeserta').html(data);	// mengisi konten
      }
    });
  });

});
</script>
