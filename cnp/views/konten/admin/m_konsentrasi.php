<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Konsentrasi
    <small>Daftar Konsentrasi</small>
  </h1>
</section>
<section class="content-header">
  <button class="btntambah btn btn-default btn-sm" title="Tambah Konsentrasi"><i class="fa fa-plus-circle"></i> Tambah</button>
  <button class="btnhapus btn btn-default btn-sm" title="Hapus Konsentrasi"><i class="fa fa-trash"></i> Hapus</button>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Konsentrasi</li>
    <li class="active">Daftar Konsentrasi</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "mkonsentrasi"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-body">
      <form method="post" id="myform" action="<?php echo base_url(); ?>c.php/admin/hapuskonsentrasi">
      <table id="example2" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th style="display:none"></th>
            <th style="width:20px">
              <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
            </th>
            <th class="text-center" style="width:20px">No.</th>
            <th>Nama Konsentrasi</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 0;
          foreach ($loaddata as $keyload) {
            $no++;
          ?>
          <tr class="record">
            <td style="display:none" id="kode"><?php echo $keyload['id_konsentrasi']; ?></td>
            <td><input type="checkbox" name="check[]" value="<?php echo $keyload['id_konsentrasi']; ?>"></td>
            <td class="text-center"><?php echo $no; ?></td>
            <td><?php echo $keyload['nama_konsentrasi']; ?></td>
            <td class="text-center">
              <button class="btnedit btn btn-default btn-xs" title="Ubah data" type="button"><i class="fa fa-pencil"></i></button>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->

<!-- Modal Danger -->
<div class="modal modal-default fade" id="modal-tambah">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
        <form role="form" method="post" action="">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Konsentrasi</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Konsentrasi</label>
              <input type="text" name="nama_konsentrasi" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Data">
          </div>
        </form>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>

<!-- Modal Danger -->
<div class="modal modal-default fade" id="modal-edit">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
      <form role="form" method="post" id="editform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Konsentrasi</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Konsentrasi</label>
            <input type="text" name="nama_konsentrasi" class="form-control" id="enama" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="simpan" class="btn btn-primary" value="Simpan Data">
        </div>
      </form>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>

<!-- Modal Danger -->
<div class="modal modal-danger fade" id="modal-danger">
  <!-- Modal Dialog -->
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data</h4>
        </div>
        <div class="modal-body">
          <p>Apa anda yakin ingin menghapus data tersebut?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" form="myform" class="btn btn-danger">Hapus</button>
        </div>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
  $(".btntambah").click(function(event) {
    $('#modal-tambah').modal('show');
  });
  $(".btnhapus").click(function(event) {
    $('#modal-danger').modal('show');
  });
  $(".btnedit").click(function(event) {
    var record = $(this).parents('.record');
    $.getJSON('<?php echo base_url()."c.php/admin/tampilkonsentrasi/" ?>'+record.find('#kode').html(), function(data) {
      $("#enama").val(data.nama_konsentrasi);
    });
    $("#editform").attr("action", "<?php echo base_url()."c.php/admin/editkonsentrasi/" ?>"+record.find('#kode').html());
    $('#modal-edit').modal('show');
  });

</script>
