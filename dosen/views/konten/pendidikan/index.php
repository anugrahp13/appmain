<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pendidikan
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-mortar-board"></i> Pendidikan</a></li>
      <li class="active">Daftar Pendidikan</li>
    </ol>
  </section>
  <!-- Finish Content Header
       Main content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "pendidikan"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <!-- Box Body -->
      <div class="box-body">
        <!-- Table Bagian Atas -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="display:none;"></th>
              <th width="10">No</th>
              <th>Jenjang Pendidikan</th>
              <th>Nominal</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              foreach ($loaddata as $key) {
                $no++;
            ?>
            <tr class="record">
              <td id="kode" style="display:none;"><?php echo $key['id_pendidikan']; ?></td>
              <td><?php echo $no;?></td>
              <td><?php echo $key['nama_pendidikan'];?></td>
              <td>Rp. <?php echo number_format($key['nominal']);?></td>
              <td class="text-center">
                <button type="button" class="btnedit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <!-- Finish Bagian Atas -->
      </div>
      <!-- Finish Box Body -->
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal Edit -->
  <div class="modal fade" id="modal-default-edit">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Nominal Jenjang</h4>
        </div>
        <form method="post" id="editform">
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control" type="text" name="nama_jenjang" id="nama" disabled>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Nominal" type="number" name="nominal" id="nominal" required onkeypress="return isNumberKey(event)">
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

      $.getJSON('<?php echo base_url()."d.php/pendidikan/tampil/" ?>'+record.find('#kode').html(), function(data) {
      $("#nama").val(data.nama_pendidikan);
      $("#nominal").val(data.nominal);
      $("#editform").attr("action", "<?php echo base_url()."d.php/pendidikan/ubah/" ?>"+record.find('#kode').html());
  });
      $('#modal-default-edit').modal('show');
  });
</script>