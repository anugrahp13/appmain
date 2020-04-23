<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Pengaturan Waktu
    <button class="btnwaktu btn btn-default btn-sm" title="atur Waktu Dasar"><i class="fa fa-clock-o"></i> Atur Waktu Dasar</button>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pengaturan Waktu</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "pwaktu"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Atur Waktu Rencana Kerja Peserta</h3>
      <div class="box-tools pull-right">
        <div class="has-feedback">
          <button class="btntambah btn btn-default btn-sm" title="Tambah Waktu"><i class="fa fa-plus-circle"></i> Tambah</button>
        </div>
      </div>
    </div>
    <div class="box-body">
      <table id="example2" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th style="display:none"></th>
            <th class="text-center" style="width:20px">No.</th>
            <th>Nama Peserta</th>
            <th>Tanggal</th>
            <th>Batas buat rencana</th>
            <th>Batas evaluasi rencana</th>
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
            <td style="display:none" id="kode"><?php echo $keyload['id_pwaktu']; ?></td>
            <td class="text-center"><?php echo $no; ?></td>
            <td>
              <?php
                $namacheck = $this->global_model->find_by('pkt_profil', array('id_profil'=>$keyload['id_profil']));
                $namatext = "-";
                if(!empty($namacheck)){
                  $namatext = $namacheck['nama_lengkap'];
                }
                echo $namatext;
              ?>
            </td>
            <td>
              <?php
                $tglconvert = "-";
                if(!empty($keyload['tanggal'])){
                  $tglconvert = date("j F Y", strtotime($keyload['tanggal']));
                }
                echo $tglconvert;
              ?>
            </td>
            <td>
              <?php
                $batasjaminput = "-";
                if(!empty($keyload['jam_buat'])){
                  $batasjaminput = $keyload['jam_buat'];
                }
                echo $batasjaminput;
              ?>
            </td>
            <td>
              <?php
                $batasjameval = "-";
                if(!empty($keyload['evaluasi_jam'])){
                  $batasjameval = $keyload['evaluasi_jam'];
                }
                echo $batasjameval;
              ?>
            </td>
            <td class="text-center">
              <button class="btnedit btn btn-default btn-xs" title="Ubah data" type="button"><i class="fa fa-pencil"></i></button>
              <button class="btnhapus btn btn-default btn-xs" title="Ubah data" type="button"><i class="fa fa-trash"></i></button>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
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
            <h4 class="modal-title">Atur waktu rencana kerja</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Peserta</label>
              <select class="form-control select2" name="id_profil" id="tnama" style="width:100%;" required>
                <option disabled selected>Pilih Peserta</option>
                <?php foreach ($loadpeserta as $key1) {?>
                  <option value="<?php echo $key1['id_profil']; ?>"><?php echo $key1['nama_lengkap']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal</label>
              <select class="form-control select2" name="tanggal" id="ttanggal" style="width:100%;" required>
                <option disabled selected>Pilih Tanggal</option>
              </select>
            </div>
            <div class="form-group">
              <label>Batas Jam Buat</label>
              <!-- time Picker -->
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="jam_buat" required>
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
              <label>Batas Jam Evaluasi</label>
              <!-- time Picker -->
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="evaluasi_jam" required>
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
<div class="modal modal-default fade" id="modal-edit">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
      <form role="form" method="post" id="editform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Waktu</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Batas buat rencana</label>
            <!-- time Picker -->
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="jam_buat" id="ebrencana" required>
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
            <label>Batas evaluasi rencana</label>
            <!-- time Picker -->
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="evaluasi_jam" id="ebevaluasi" required>
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
<div class="modal modal-default fade" id="modal-waktu">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
      <form role="form" method="post" action="<?php echo base_url(); ?>c.php/admin/waktuawal">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Atur Waktu Dasar</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Batas buat rencana</label>
            <!-- time Picker -->
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="jam_buat" value="<?php echo $loadwaktudasar['jam_buat'];?>" required>
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
            <label>Batas evaluasi rencana</label>
            <!-- time Picker -->
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control timepicker" name="evaluasi_jam" value="<?php echo $loadwaktudasar['evaluasi_jam'];?>" required>
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
      <form method="post" action="" id="hapusform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Data</h4>
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

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
  $(".btntambah").click(function(event) {
    $('#modal-tambah').modal('show');
  });
  $(".btnwaktu").click(function(event) {
    $('#modal-waktu').modal('show');
  });
  $(".btnhapus").click(function(event) {
    var record = $(this).parents('.record');
    $("#hapusform").attr("action", "<?php echo base_url()."c.php/admin/hapusaturwaktu/" ?>"+record.find('#kode').html());
    $('#modal-danger').modal('show');
  });

  $(".btnedit").click(function(event) {
    var record = $(this).parents('.record');
    $.getJSON('<?php echo base_url()."c.php/admin/tampilatur/" ?>'+record.find('#kode').html(), function(data) {
      $("#ebrencana").val(data.jam_buat);
      $("#ebevaluasi").val(data.evaluasi_jam);
    });

    $("#editform").attr("action", "<?php echo base_url()."c.php/admin/editatur/" ?>"+record.find('#kode').html());
    $('#modal-edit').modal('show');
  });

$(function () {
  $('#tnama').on('select2:select', function () {
    var nama = $("#tnama").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxloadtanggal2',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {id_nama:nama},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#ttanggal').html(data);	// mengisi konten
      }
    });
  });
});


</script>
