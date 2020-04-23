<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ujian
    <small>Daftar Ujian</small>
  </h1>
</section>
<section class="content-header">
  <button class="btntambah btn btn-default btn-sm" title="Tambah Ujian"><i class="fa fa-plus-circle"></i> Tambah</button>
  <button class="btnhapus btn btn-default btn-sm" title="Hapus Ujian"><i class="fa fa-trash"></i> Hapus</button>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Ujian</li>
    <li class="active">Daftar Ujian</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "ujian"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-body">
      <form method="post" id="myform" action="<?php echo base_url(); ?>c.php/admin/hapusujian">
      <table id="example2" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th style="display:none"></th>
            <th style="width:20px">
              <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
            </th>
            <th>Nama Ujian</th>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Jumlah Peserta</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($loaddata as $keyload) {
          ?>
          <tr class="record">
            <td style="display:none" id="kode"><?php echo $keyload['id_headersoal']; ?></td>
            <td><input type="checkbox" name="check[]" value="<?php echo $keyload['id_headersoal']; ?>"></td>
            <td>
              <?php if(!empty($keyload['nama_ujian'])){echo $keyload['nama_ujian'];}else{echo "-";} ?>
            </td>
            <td>
              <?php if(!empty($keyload['tgl_ujian'])){echo date("j F Y", strtotime($keyload['tgl_ujian']));}else{echo "-";} ?>
            </td>
            <td>
              <?php
              $kuymulai = "-";
              $kuyakhir = "-";
              if(!empty($keyload['jam_mulai'])){ $kuymulai = $keyload['jam_mulai'];}
              if(!empty($keyload['jam_akhir'])){ $kuyakhir = $keyload['jam_akhir'];}

              echo $kuymulai." - ".$kuyakhir;
              ?>
            </td>
            <td>
              <?php
              $kdata = count($this->global_model->find_all_by('partisipasi_ujian', array('id_headersoal'=>$keyload['id_headersoal'])));
              echo $kdata." peserta";
              ?>
            </td>
            <td class="text-center">
              <a href="<?php echo base_url(); ?>c.php/admin/ujian/peserta/<?php echo $keyload['id_headersoal']; ?>" class="btn btn-default btn-xs" title="Kelola Peserta"><i class="fa fa-user"></i></a>
              <a href="<?php echo base_url(); ?>c.php/admin/ujian/soal/<?php echo $keyload['id_headersoal']; ?>" class="btn btn-default btn-xs" title="Kelola Soal"><i class="fa fa-book"></i></a>
              <button type="button" class="btnuujian btn btn-default btn-xs" title="Ubah data ujian"><i class="fa fa-edit"></i></button>
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
            <h4 class="modal-title">Tambah Ujian</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Ujian</label>
              <input type="text" name="nama_ujian" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Tanggal Ujian</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="datepicker form-control pull-right" name="tgl_ujian" required>
              </div>
            </div>
            <div class="form-group">
              <label>Waktu Mulai</label>
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_mulai" required>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
            </div>
            <div class="form-group">
              <label>Waktu Selesai</label>
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_akhir" required>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
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

<!-- Modal Danger -->
<div class="modal modal-default fade" id="modal-ujian">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Data Ujian</h4>
        </div>
        <form action="" method="post" id="editform">
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Ujian</label>
              <input type="text" name="nama_ujian" class="form-control" id="enama" required>
            </div>
            <div class="form-group">
              <label>Tanggal Ujian</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="datepicker form-control pull-right" id="etgl" name="tgl_ujian" required>
              </div>
            </div>
            <div class="form-group">
              <label>Waktu Mulai</label>
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_mulai" id="emulai" required>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
            </div>
            <div class="form-group">
              <label>Waktu Selesai</label>
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_akhir" id="eakhir" required>
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="submit" name="ubahujian" class="btn btn-primary" value="Simpan Data">
          </div>
        </form>
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

  $(".btnuujian").click(function(event) {
    var record = $(this).parents('.record');
    $.getJSON('<?php echo base_url()."c.php/admin/ajaxujian/" ?>'+record.find('#kode').html(), function(data) {
      $("#enama").val(data.nama_ujian);
      $("#etgl").val(data.tgl_ujian);
      $("#emulai").val(data.jam_mulai);
      $("#eakhir").val(data.jam_akhir);
    });
    $("#editform").attr("action", "<?php echo base_url()."c.php/admin/eujian/" ?>"+record.find('#kode').html());

    $('#modal-ujian').modal('show');
  });
</script>
