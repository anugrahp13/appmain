<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Kelola Akun
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user"></i> Kelola Akun</a></li>
      <li class="active">Daftar Akun</li>
    </ol>
  </section>
  <section class="content-header">
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus-square"></i> Tambah</button>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i> Hapus</button>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "kelolaakun"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default box -->
    <div class="box">
      <form action="<?php echo base_url();?>index.php/kelolaakun/hapus" method="post" id="myform">
        <div class="box-body">
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th style="width:20px;">
                  <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
                </th>
                <th width="10">No</th>
                <th width="30">Foto</th>
                <th>Nama Dosen</th>
                <th>Nama Pengguna</th>
                <th>Jabatan</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loadakun as $key) {
                  $no++;
              ?>
              <tr class="record">
                <td id="kode" style="display:none;"><?php echo $key['id_akun'];?></td>
                <td><input type="checkbox" name="check[]" value="<?php echo $key['id_akun'];?>"></td>
                <td><?php echo $no;?></td>
                <td class="text-center">
                  <?php
                  $imgname = "default.png";
                  if(!empty($key['img'])){
                    $imgname = $key['img'];
                  }
                  ?>
                  <img src="<?php echo base_url(); ?>assets/image/<?php echo $imgname; ?>" width="36" height="36" />
                </td>
                <td>
                  <?php echo $key['nama_lengkap']; ?>
                </td>
                <td><?php echo $key['nama_pengguna']; ?></td>
                <td>
                  <?php
                    $adata = array(
                      '100' => 'Kepala Kampus',
                      '99' => 'Wakil Kepala Kampus',
                      '1' => "Kepala Bidang Akademik",
                      '2' => "Staff Akademik",
                      '3' => "Kepala Bidang CNP",
                      '4' => "Staff CNP",
                      '5' => "Kepala Bidang ICT",
                      '6' => "Kepala Koordinator ICT",
                      '7' => "Staff ICT",
                      '8' => "Kepala Bidang Personalia & Finance",
                      '9' => "Staff Personalia",
                      '10' => "Staff Finance",
                      '11' => "Kepala Bidang Marketing",
                      '12' => "Staff Marketing",
                    );

                    if($adata[$key['id_jabatan']]!= null){echo $adata[$key['id_jabatan']];}
                    else{ echo "-";}
                  ?>
                </td>
                <td class="text-center">
                  <button type="button" class="btnedit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </form>
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Akun</h4>
      </div>
      <form method="post" action="" role="form" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" required>
              </div>
              <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" class="form-control" name="nama_pengguna" required>
              </div>
              <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" class="form-control" name="kata_sandi" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Divisi</label>
                <select name="id_divisi" class="form-control" required>
                  <option value="0">Kepala Kampus</option>
                  <option value="1">Akademik</option>
                  <option value="2">CNP</option>
                  <option value="3">ICT</option>
                  <option value="4">Finance</option>
                  <option value="5">Marketing</option>
                  <option value="6">Personalia</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jabatan</label>
                <select name="id_jabatan" class="form-control" required>
                  <option value="100">Kepala Kampus</option>
                  <option value="99">Wakil Kepala Kampus</option>
                  <option value="1">Kepala Bidang Akademik</option>
                  <option value="2">Staff Akademik</option>
                  <option value="3">Kepala Bidang CNP</option>
                  <option value="4">Staff CNP</option>
                  <option value="5">Kepala Bidang ICT</option>
                  <option value="6">Kepala Koordinator ICT</option>
                  <option value="7">Staff ICT</option>
                  <option value="8">Kepala Bidang Personalia & Finance</option>
                  <option value="9">Staff Finance</option>
                  <option value="10">Staff Personalia</option>
                  <option value="11">Kepala Bidang Marketing</option>
                  <option value="12">Staff Marketing</option>
                </select>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" name="img">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <input type="submit" class="btn btn-primary" name="simpan" value="Buat">
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal modal-danger fade" id="modal-danger">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Akun</h4>
      </div>
      <div class="modal-body">
        <p>Apa anda yakin ingin menghapus data tersebut?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" form="myform" class="btn btn-danger">Hapus</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="modal-default-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Akun</h4>
      </div>
      <form method="post" role="form" id="editform" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" required id="namal">
              </div>
              <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" class="form-control" name="nama_pengguna" required id="namap">
              </div>
              <div class="form-group">
                <label>Kata Sandi</label>
                <input type="password" class="form-control" name="kata_sandi" id="kata_sandi" placeholder="isi, bila ingin dirubah">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Divisi</label>
                <select id="edivisi" name="id_divisi" class="form-control" required>
                  <option value="0">Kepala Kampus</option>
                  <option value="1">Akademik</option>
                  <option value="2">CNP</option>
                  <option value="3">ICT</option>
                  <option value="4">Personalia</option>
                  <option value="5">Finance</option>
                  <option value="6">Marketing</option>
                </select>
              </div>
              <div class="form-group">
                <label>Jabatan</label>
                <select id="ejabatan" name="id_jabatan" class="form-control" required>
                  <option value="100">Kepala Kampus</option>
                  <option value="99">Wakil Kepala Kampus</option>
                  <option value="1">Kepala Bidang Akademik</option>
                  <option value="2">Staff Akademik</option>
                  <option value="3">Kepala Bidang CNP</option>
                  <option value="4">Staff CNP</option>
                  <option value="5">Kepala Bidang ICT</option>
                  <option value="6">Kepala Koordinator ICT</option>
                  <option value="7">Staff ICT</option>
                  <option value="8">Kepala Bidang Personalia & Finance</option>
                  <option value="10">Staff Finance</option>
                  <option value="9">Staff Personalia</option>
                  <option value="11">Kepala Bidang Marketing</option>
                  <option value="12">Staff Marketing</option>
                </select>
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" name="img">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
  $(".btnedit").click(function(event) {
      var record = $(this).parents('.record');

      $.getJSON('<?php echo base_url()."index.php/kelolaakun/tampil/" ?>'+record.find('#kode').html(), function(data) {
      $("#namal").val(data.nama_lengkap);
      $("#namap").val(data.nama_pengguna);
      $("#ejabatan").val(data.id_jabatan).trigger('change');
      $("#edivisi").val(data.id_divisi).trigger('change');
      $("#editform").attr("action", "<?php echo base_url()."index.php/kelolaakun/ubah/" ?>"+record.find('#kode').html());
  });
      $('#modal-default-edit').modal('show');
  });

</script>
