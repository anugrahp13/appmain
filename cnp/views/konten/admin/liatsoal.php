<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Soal
    <a href="<?php echo base_url(); ?>c.php/admin/ujian/tambahsoal" class="btn btn-default btn-xs"><i class="fa fa-plus-circle"></i> Tambah</a>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/ujian">Ujian</a></li>
    <li class="active">Soal</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "lihatsoal"){?>
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
          <label>Nama Ujian</label>
          <p class="text-muted">
            <?php if(!empty($loadheader['nama_ujian'])){echo $loadheader['nama_ujian'];}else{echo "-";} ?>
          </p>
        </div>
        <div class="col-md-2">
          <label>Waktu </label>
          <p class="text-muted">
            <?php
            $kuymulai = "-";
            $kuyakhir = "-";
            if(!empty($loadheader['jam_mulai'])){ $kuymulai = $loadheader['jam_mulai'];}
            if(!empty($loadheader['jam_akhir'])){ $kuyakhir = $loadheader['jam_akhir'];}

            echo $kuymulai." s/d ".$kuyakhir;
            ?>
          </p>
        </div>
        <div class="col-md-2">
          <label>Tanggal</label>
          <p class="text-muted">
            <?php if(!empty($loadheader['tgl_ujian'])){echo date("j F Y", strtotime($loadheader['tgl_ujian']));}else{echo "-";} ?>
          </p>
        </div>
        <div class="col-md-3">
          <label>Jumlah Peserta</label>
          <p class="text-muted">
            <?php echo $jumlahpeserta; ?> Peserta
          </p>
        </div>
      </div>
    </div>
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-book"></i></span>
            <select class="form-control select2" id="abab" style="width:100%">
              <option disabled selected>Pilih Bab Soal</option>
              <option value="semua">Semua</option>
              <?php foreach ($loadbab as $keybab) {?>
              <option value="<?php echo $keybab['bab_soal'];?>"><?php echo str_replace('-',' ',$keybab['bab_soal'])." (".$keybab['bobot']."%)";?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <button type="button" class="btnopsi btn btn-default"><i class="fa fa-gear"></i> Opsi</button>
        </div>
      </div>
    </div>
    <div class="box-body" id="dataload">
      <table id="example3" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th style="display:none"></th>
            <th class="text-center" width="10">No.</th>
            <th>Bab Soal</th>
            <th>Teks Soal</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 0;
          foreach ($loaddata as $loadkey) {
            $no++;
          ?>
          <tr class="record">
            <td style="display:none" id="kode"><?php echo $loadkey['id_kontenujian']; ?></td>
            <td class="text-center"><?php echo $no; ?></td>
            <td width="150"><?php echo str_replace('-',' ',$loadkey['bab_soal']);?></td>
            <td><?php echo $loadkey['soal']; ?></td>
            <td width="50" class="text-center">
              <button class="btnedit btn btn-default btn-xs" title="Ubah Soal"><i class="fa fa-pencil"></i></button>
              <button class="btnhapus btn btn-default btn-xs" title="Hapus Soal"><i class="fa fa-trash"></i></button>
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
<div class="modal modal-danger fade" id="modal-danger">
  <!-- Modal Dialog -->
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content">
      <form method="post" action="" id="hapusform">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Soal</h4>
        </div>
        <div class="modal-body">
          <p>Apa anda yakin ingin menghapus soal tersebut?</p>
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
          <h4 class="modal-title">Ubah Soal</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Bab Soal</label>
            <input type="text" name="bab_soal" class="form-control" id="ebab" readonly>
          </div>
          <div class="Soal">
            <label>Soal</label>
            <textarea name="soal" rows="5" class="form-control" id="esoal"></textarea>
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
<!-- Finish Modal Danger -->

<div class="modal fade" id="modal-opsi">
  <!-- Modal Dialog -->
  <div class="modal-dialog modal-sm">
    <!-- Modal Content -->
    <div class="modal-content">
      <form method="post" action="" id="editopsi">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Data Bab Soal</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama BAB</label>
            <input type="text" name="bab_soal" class="form-control" id="obab">
          </div>
          <div class="Soal">
            <label>Bobot</label>
            <input type="text" name="bobot" class="form-control" id="obobot" onkeypress="return isNumberKey(event)">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btnhapusbab btn btn-danger">Hapus</button>
          <input type="submit" class="btn btn-primary" name="ubahbab" value="Perbarui"/>
        </div>
      </form>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>
<!-- Finish Modal Danger -->

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(".btnpeserta").click(function(event) {
  $('#modal-peserta').modal('show');
});
$(".btntambahpeserta").click(function(event) {
  $('#modal-tambahpeserta').modal('show');
});

$(".btnopsi").click(function(event) {
  var bab = $('#abab').val();
  if(bab !== null){
    if(bab !== "semua"){
      var coy = $('#abab').val();
      $.getJSON('<?php echo base_url()."c.php/admin/tampilbab/" ?>'+coy, function(data) {
        $('#obab').val(data.babsoal);
        $('#obobot').val(data.bobot);
      });

      $("#editopsi").attr("action", "<?php echo base_url()."c.php/admin/ubahbab/" ?>"+coy);
      $(".btnhapusbab").attr("formaction", "<?php echo base_url()."c.php/admin/hapusbab/" ?>"+coy);
      $('#modal-opsi').modal('show');
    }
  }
});

$(document).on('click', '.btnhapus', function(){
  var record = $(this).parents('.record');
  $("#hapusform").attr("action", "<?php echo base_url()."c.php/admin/hapussoalujian/" ?>"+record.find('#kode').html());
  $('#modal-danger').modal('show');
});

$(document).on('click', '.btnedit', function(){
  var record = $(this).parents('.record');
  $.getJSON('<?php echo base_url()."c.php/admin/tampilsoalujian/" ?>'+record.find('#kode').html(), function(data) {
    $('#ebab').val(data.babsoal);
    $('#esoal').val(data.soal);
  });
  $("#editform").attr("action", "<?php echo base_url()."c.php/admin/ubahsoalujian/" ?>"+record.find('#kode').html());
  $('#modal-ubah').modal('show');
});

$(function () {
  $('#abab').on('select2:select', function () {
    var babsoal = $("#abab").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxloadsoal',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {babsoal:babsoal},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#dataload').html(data);	// mengisi konten
      }
    });

  });
});
</script>
