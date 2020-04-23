<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Indikator Penilaian
    <a href="<?php echo base_url(); ?>c.php/admin/indikator/tambah" class="btn btn-default btn-xs"><i class="fa fa-plus-circle"></i> Tambah</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Indikator</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "indikatorpenilaian"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
            <select class="form-control select2" id="abidang" style="width:100%">
              <option disabled selected>Pilih Bidang</option>
              <?php foreach ($loadbidang as $loadkey2) {?>
              <option value="<?php echo $loadkey2['id_bidang']?>"><?php echo $loadkey2['nama_bidang']?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
            <select class="form-control select2" style="width: 100%;" id="akategori">
              <option disabled selected>Pilih Kategori</option>
              <?php foreach ($loadkategori as $loadkey) {?>
              <option value="<?php echo $loadkey['id_kategori']?>"><?php echo $loadkey['nama_kategori']?></option>
            <?php }?>http://localhost/appmain/c.php/admin/indikator
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <button type="button" class="btn btn-default" id="btncari"><i class="fa fa-search"></i> Cari Data</button>
          <button type="button" class="btn btn-default" id="btntim"><i class="fa fa-user"></i> Tim Penilai</button>
        </div>
      </div>
    </div>
    <div class="box-body" id="dataload">
      <table id="example3" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th style="display:none"></th>
            <th class="text-center" width="10">No.</th>
            <th>Nama Bidang</th>
            <th>Nama Kategori</th>
            <th>Nama Indikator</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="6" class="text-center">
              Untuk menampilkan data, filter data terlebih dahulu.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->

<!-- Modal Danger -->
<div class="modal modal-danger fade" id="modal-danger">
  <!-- Modal Dialog -->
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content">
      <form method="post" action="" id="hapusform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Indikator</h4>
        </div>
        <div class="modal-body">
          <p>Apa anda yakin ingin menghapus data tersebut?</p>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-danger" value="Hapus"/>
        </div>
      </form>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>

<div class="modal fade" id="modal-ubah">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
      <form method="post" action="" id="editform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Indikator</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Bidang</label>
            <select class="form-control select2" name="id_bidang" style="width:100%;" id="e_bidang" required>
              <?php foreach ($loadbidang as $loadkey2) {?>
              <option value="<?php echo $loadkey2['id_bidang']?>"><?php echo $loadkey2['nama_bidang']?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label>Kategori Penilaian</label>
            <select class="form-control select2" name="id_kategori" style="width:100%;" id="e_kategori" required>
              <?php foreach ($loadkategori as $loadkey) {?>
              <option value="<?php echo $loadkey['id_kategori']?>"><?php echo $loadkey['nama_kategori']?></option>
              <?php }?>
            </select>
          </div>
          <div class="form-group">
            <label>Nama Indikator</label>
            <textarea name="nama_indikator" class="form-control" rows="5" id="e_indikator" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="simpan" value="Simpan data"/>
        </div>
      </form>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>
<div class="modal fade" id="modal-tim">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
      <form method="post" id="edittim">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tim Penilai</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Tim Penilai</label>
            <input type="text" name="nama_tim" class="form-control" id="tnama" required>
          </div>
          <div class="form-group">
            <label>Jabatan</label>
            <input type="text" name="jabatan_tim" class="form-control" id="tjabatan" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="simpan" value="Simpan"/>
        </div>
      </form>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).on('click', '.btnhapus', function(){
  var record = $(this).parents('.record');
  $("#hapusform").attr("action", "<?php echo base_url()."c.php/admin/hapusindikator/" ?>"+record.find('#kode').html());
  $('#modal-danger').modal('show');
});

$(document).on('click', '.btnedit', function(){
  var record = $(this).parents('.record');
  $.getJSON('<?php echo base_url()."c.php/admin/tampilindikator/" ?>'+record.find('#kode').html(), function(data) {
    $('#e_bidang').val(data.id_bidang).trigger('change');
    $('#e_kategori').val(data.id_kategori).trigger('change');
    $('#e_indikator').val(data.nama_indikator).trigger('change');
  });
  $("#editform").attr("action", "<?php echo base_url()."c.php/admin/ubahindikator/" ?>"+record.find('#kode').html());
  $('#modal-ubah').modal('show');
});

$(function () {
  $('#btncari').on('click', function(){
    var bidang = $("#abidang").val();
    var kategori = $("#akategori").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxloadindikator',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {bidang:bidang,kategori:kategori},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#dataload').html(data);	// mengisi konten
      }
    });
  });

  $('#btntim').on('click', function(){
    var bidang = $("#abidang").val();
    if(bidang !== null){
      $.getJSON('<?php echo base_url()."c.php/admin/tampiltim/" ?>'+bidang, function(data) {
        $("#tnama").val(data.nama_tim);
        $("#tjabatan").val(data.jabatan_tim);
        $('#modal-tim').modal('show');
        $("#edittim").attr("action", "<?php echo base_url()."c.php/admin/ubahtim/" ?>"+bidang);
      });
    }

  });

});
</script>
