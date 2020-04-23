<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Rencana Kerja
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/rencanakerja">Rencana Kerja</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "tambahrencana"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <form action="" method="post">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Rencana</h3>
        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="submit" class="btn btn-default btn-sm" name="simpan" value="Simpan Data">
          </div>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <label>Nama Pengguna</label>
              <select class="form-control select2" name="id_profil" id="anama" required>
                <option selected disabled>Pilih Peserta</option>
                <?php foreach ($loadpeserta as $loadkey) {?>
                <option value="<?php echo $loadkey['id_profil'];?>"><?php echo $loadkey['nim']." - ".$loadkey['nama_lengkap'];?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Tanggal</label>
              <select class="form-control select2" name="tanggal" id="atanggal" required>
                <option>Pilih Tanggal</option>
              </select>
            </div>
          </div>
        </div>
        <table  class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Nama Kegiatan</th>
              <th>Dari Jam</th>
              <th>Sampai Jam</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=1; $i < 11; $i++) { ?>
              <tr>
                <td class="text-center"><?php echo $i;?></td>
                <td><input class="form-control" type="text" name="kegiatan[]" value=""></td>
                <td>
                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="darijam[]">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                </td>
                <td>
                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="sampaijam[]">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                </td>
              </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </form>
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(function () {
  $('#anama').on('select2:select', function () {
    var nama = $("#anama").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxloadtanggal2',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {id_nama:nama},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#atanggal').html(data);	// mengisi konten
      }
    });
  });
});
</script>
