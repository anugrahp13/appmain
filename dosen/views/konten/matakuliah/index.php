<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Mata Kuliah
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-book"></i> Mata Kuliah</a></li>
      <li class="active">Daftar Mata Kuliah</li>
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
    <?php if($this->session->flashdata('messageactive') == "matakuliah"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <form method="post" action="<?php echo base_url();?>d.php/matakuliah/hapus" id="myform">
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
                <th>Nama Mata Kuliah</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loadkuliah as $key) {
                  $no++;
              ?>
              <tr class="record">
                <td id="kode" style="display:none;"><?php echo $key['id_matkul'];?></td>
                <td><input type="checkbox" name="check[]" value="<?php echo $key['id_matkul'];?>"></td>
                <td><?php echo $no;?></td>
                <td><?php echo $key['nama_matkul'];?></td>
                <td class="text-center">
                  <button type="button" class="btnedit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- Finish Table Bagian Atas -->
        </div>
        <!-- Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal Default -->
  <div class="modal fade" id="modal-default">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Mata Kuliah</h4>
        </div>
        <form method="post" action="">
          <div class="modal-body">
            <input class="form-control" placeholder="Mata Kuliah" type="text" name="nama_matkul">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-success" name="simpan" value="Buat">
          </div>
        </form>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Default -->

  <!-- Modal Danger -->
  <div class="modal modal-danger fade" id="modal-danger">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Mata Kuliah</h4>
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
    <!-- MOdal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Matakuliah</h4>
        </div>
        <form method="post" id="editform">
          <div class="modal-body">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Nama Matakuliah" name="nama_matkul" id="nama_matkul" required>
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

        $.getJSON('<?php echo base_url()."d.php/matakuliah/tampil/" ?>'+record.find('#kode').html(), function(data) {
        $("#nama_matkul").val(data.nama_matkul);
        $("#editform").attr("action", "<?php echo base_url()."d.php/matakuliah/ubah/" ?>"+record.find('#kode').html());
    });
        $('#modal-default-edit').modal('show');
    });

  </script>
