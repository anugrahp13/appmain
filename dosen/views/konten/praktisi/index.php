<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Praktisi
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-send"></i> Praktisi</a></li>
      <li class="active">Daftar Praktisi</li>
    </ol>
  </section>
  <!-- Finish Content Header
       Content Header -->
  <section class="content-header">
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus-square"></i> Tambah</button>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i> Hapus</button>
  </section>
  <!-- Finish Content Header
       Main Content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "praktisi"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <form action="<?php echo base_url();?>d.php/praktisi/hapus" method="post" id="myform">
        <!-- Box Body -->
        <div class="box-body">
          <!-- Table Bagian Atas -->
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th style="width:20px;">
                  <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
                </th>
                <th width="10">No</th>
                <th>Nama Praktisi</th>
                <th>Nominal</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loadpraktisi as $key) {
                  $no++;
              ?>
              <tr class="record">
                <td id="kode" style="display:none;"><?php echo $key['id_praktisi']; ?></td>
                <td><input type="checkbox" name="check[]" value="<?php echo $key['id_praktisi']; ?>"></td>
                <td><?php echo $no;?></td>
                <td><?php echo $key['nama_praktisi'];?></td>
                <td>Rp. <?php echo number_format($key['nominal']);?></td>
                <td class="text-center">
                  <button type="button" class="btnedit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
          <!-- Finish Table Bagian Atas -->
        </div>
      </form>
      <!-- Finish Box Body -->
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal Tambah -->
  <div class="modal fade" id="modal-default">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Praktisi</h4>
        </div>
        <form method="post" action="" role="form">
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control" placeholder="Nama Praktisi" type="text" name="nama_praktisi" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Nominal" type="number" name="nominal" onkeypress="return isNumberKey(event)" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-success" name="simpan" value="Buat">
          </div>
        </form>
      </div>
      <!-- FInish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Tambah -->

  <!-- Modal Danger -->
  <div class="modal modal-danger fade" id="modal-danger">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Praktisi</h4>
        </div>
        <div class="modal-body">
          <p>Apa anda yakin ingin menghapus data tersebut?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" form="myform" class="btn btn-danger">Hapus</button>
        </div>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Danger -->

  <!-- Modal Edit -->
  <div class="modal fade" id="modal-default-edit">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Praktisi</h4>
        </div>
        <form method="post" action="" role="form" id="editform">
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control" placeholder="Nama Praktisi" type="text" name="nama_praktisi" id="nama" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Nominal" type="number" name="nominal" id="nominal" onkeypress="return isNumberKey(event)" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-success" name="ubah" value="Ubah">
          </div>
        </form>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Edit -->
  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript">
    $(".btnedit").click(function(event) {
        var record = $(this).parents('.record');

        $.getJSON('<?php echo base_url()."d.php/praktisi/tampil/" ?>'+record.find('#kode').html(), function(data) {
        $("#nama").val(data.nama_praktisi);
        $("#nominal").val(data.nominal);
        $("#editform").attr("action", "<?php echo base_url()."d.php/praktisi/ubah/" ?>"+record.find('#kode').html());
    });
        $('#modal-default-edit').modal('show');
    });
  </script>
