<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Rencana Kerja
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/rencanakerja">Rencana Kerja</a></li>
    <li class="active">Lihat Rencana Kerja Peserta</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "rencanakerja"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <?php
    $tahunajaran = "-";
    $periodedari = "-";
    $periodesampai = "-";
    $peserta = "-";

    $selectpkt = $this->global_model->find_by('pkt_profil', array('id_profil'=>$idprofilnih));
    ?>
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-2">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/image/<?php if(!empty($selectpkt['img'])){echo $selectpkt['img'];}else{echo "default.png";} ?>" alt="User profile picture">
        </div>
        <div class="col-md-3">
          <label>Nama Lengkap</label>
          <p class="text-muted">
            <?php if(!empty($selectpkt['nama_lengkap'])){echo $selectpkt['nama_lengkap'] ;}else{echo "-";} ?>
          </p>
          <label>NIM</label>
          <p class="text-muted">
            <?php if(!empty($selectpkt['nim'])){echo $selectpkt['nim'] ;}else{echo "-";} ?>
          </p>
        </div>
        <div class="col-md-3">
          <label>Bidang</label>
          <p class="text-muted">
            <?php
              $getbidang = $this->global_model->find_by('m_bidang', array('id_bidang'=>$selectpkt['id_bidang']));
              if(!empty($getbidang)){
                echo $getbidang['nama_bidang'];
              }
            ?>
          </p>
          <label>Konsentrasi / Semester</label>
          <p class="text-muted">
            <?php
              $getkonsentrasi = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$selectpkt['id_konsentrasi']));
              if(!empty($getkonsentrasi)){
                echo $getkonsentrasi['nama_konsentrasi']." / ";
              }
              echo $selectpkt['semester'];
            ?>
          </p>
        </div>
        <div class="col-md-3">
          <label>Tahun Ajaran</label>
          <p class="text-muted"><?php echo $selectpkt['tahun_ajaran'];?></p>
          <label>Periode</label>
          <p class="text-muted">
            <?php
              echo $selectpkt['periode_dari']." - ".$selectpkt['periode_sampai'];
            ?>
          </p>
        </div>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-md-2">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <select class="form-control select2" id="atanggal" style="width:100%">
              <option disabled selected>Pilih Tanggal</option>
              <?php
              // Set timezone
            	date_default_timezone_set('Asia/Jakarta');

            	// Start date
            	$date = $selectpkt['periode_dari'];
            	// End date
            	$end_date = $selectpkt['periode_sampai'];

              while (strtotime($date) <= strtotime($end_date)) {
                            echo "<option value='".$date."'>".$date."</option>";
                            $date = date ("m/d/Y", strtotime("+1 day", strtotime($date)));
            	}
              ?>
            </select>
          </div>
        </div>
      </div><br>
      <div id="dataload">
        <table id="advanceDTables" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th style="display:none"></th>
              <th class="no-sort">Kegiatan</th>
              <th class="no-sort">Waktu Pelaksanaan</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th class="no-sort text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($loaddata as $loadkey) {
            ?>
            <tr class="record">
              <td style="display:none" id="kode"><?php echo $loadkey['id_aktifitas']; ?></td>
              <td><?php echo $loadkey['kegiatan']; ?></td>
              <td><?php echo $loadkey['darijam']." - ".$loadkey['sampaijam']; ?></td>
              <td><?php echo date("j F Y", strtotime($loadkey['tanggal'])); ?></td>
              <td>
                <?php
                  $status = "Belum Dievaluasi";
                  if($loadkey['status'] == 1){
                    $status = "Selesai";
                  }else if($loadkey['status'] == 2){
                    $status = "Tidak Selesai";
                  }
                  echo $status;
                ?>
              </td>
              <td class="text-center">
                <button class="btnedit btn btn-default btn-xs" title="Ubah rencana"><i class="fa fa-pencil"></i></button>
                <button class="btnhapus btn btn-default btn-xs" title="Hapus rencana"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
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
          <h4 class="modal-title">Hapus Rencana</h4>
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
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content">
      <form method="post" action="" id="editform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Rencana</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Kegiatan</label>
                <input type="text" class="form-control" name="kegiatan" id="e_kegiatan" required/>
              </div>
              <div class="form-group">
                <label>Waktu (d/s)</label>
                <div class="row">
                  <div class="col-md-6">
                    <!-- time Picker -->
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control timepicker" name="darijam" id="e_dari" required>
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                        <!-- /.input group -->
                      </div>
                      <!-- /.form group -->
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!-- time Picker -->
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control timepicker" name="sampaijam" id="e_sampai" required>
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
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status" id="e_status" required>
                  <option value="0">Belum Dievaluasi</option>
                  <option value="1">Selesai</option>
                  <option value="2">Tidak Selesai</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Keterangan</label>
                <textarea class="form-control" style="resize:none;" name="keterangan" id="e_keterangan"></textarea>
              </div>
            </div>
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
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(function () {
  $('.btnhapus').on('click', function(){
    var record = $(this).parents('.record');
    $("#hapusform").attr("action", "<?php echo base_url()."c.php/admin/hapusrencana/" ?>"+record.find('#kode').html());
    $('#modal-danger').modal('show');
  });

  $('#atanggal').on('select2:select', function () {
    var tanggal = $("#atanggal").val();

      $.ajax({
        url: '<?php echo base_url(); ?>c.php/admin/ajaxloadrencana',	// set url -> ini file yang menyimpan query tampil detail data siswa
        method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
        data: {tanggal:tanggal,id_profil:<?php echo $idprofilnih; ?>},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
        success:function(data){		// kode dibawah ini jalan kalau sukses
          $('#dataload').html(data);	// mengisi konten
        }
      });

  });

  $('.btnedit').on('click', function(){
    var record = $(this).parents('.record');
    $.getJSON('<?php echo base_url()."c.php/admin/tampilrencana/" ?>'+record.find('#kode').html(), function(data) {
      $('#e_kegiatan').val(data.kegiatan);
      $('#e_dari').val(data.darijam);
      $('#e_sampai').val(data.sampaijam);
      $('#e_keterangan').val(data.keterangan);
      $('#e_status').val(data.status).trigger('change');
    });
    $("#editform").attr("action", "<?php echo base_url()."c.php/admin/ubahrencana/" ?>"+record.find('#kode').html());
    $('#modal-ubah').modal('show');
  });
});
</script>
