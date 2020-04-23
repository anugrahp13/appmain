<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Penilaian
    <button class="btntambah btn btn-default btn-xs" title="Kelola nilai peserta"><i class="fa fa-plus-circle"></i> Kelola nilai</button>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Penilaian</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "penilaian"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-2">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
            <select class="form-control select2" id="atahun" style="width:100%">
              <option disabled selected>Pilih Tahun</option>
              <option value="semua">Semua</option>
              <?php foreach ($loadtahun as $loadkey) {?>
                <option value="<?php echo $loadkey['tahun_ajaran']; ?>"><?php echo $loadkey['tahun_ajaran']; ?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
            <select class="form-control select2" id="abidang" style="width:100%">
              <option disabled selected>Pilih Bidang</option>
              <option value="semua">Semua</option>
              <?php foreach ($loadbidang as $keybidang) {?>
                <option value="<?php echo $keybidang['id_bidang']; ?>"><?php echo $keybidang['nama_bidang']; ?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <select class="form-control select2" id="aperiode" style="width:100%">
              <option disabled selected>Pilih Periode</option>
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <button type="button" class="btn btn-default" id="btncari"><i class="fa fa-search"></i> Cari Data</button>
        </div>
      </div>
    </div>
    <div class="box-body" id="dataload">
      <table id="advanceDTables" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th>NIM</th>
            <th>Nama Peserta</th>
            <th>Bidang</th>
            <th>Tahun Ajaran</th>
            <th>Periode</th>
            <th class="no-sort text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($loadpeserta as $keypeserta) {
          ?>
          <tr>
            <td><?php if(!empty($keypeserta['nim'])){echo $keypeserta['nim'];}else{echo "-";} ?></td>
            <td><?php if(!empty($keypeserta['nama_lengkap'])){echo $keypeserta['nama_lengkap'];}else{echo "-";} ?></td>
            <td>
              <?php
                $getbidang = $this->global_model->find_by('m_bidang', array('id_bidang'=>$keypeserta['id_bidang']));
                if(!empty($getbidang)){
                  echo $getbidang['nama_bidang'];
                }
              ?>
            </td>
            <td><?php if(!empty($keypeserta['tahun_ajaran'])){echo $keypeserta['tahun_ajaran'];}else{echo "-";} ?></td>
            <td>
              <?php
              $periodedari = "-";
              $periodesampai = "-";
              if(!empty($keypeserta['periode_dari'])){$periodedari =  $keypeserta['periode_dari'];}
              if(!empty($keypeserta['periode_sampai'])){$periodesampai =  $keypeserta['periode_sampai'];}
              echo $periodedari." - ".$periodesampai;
              ?>
            </td>
            <td class="text-center">
              <?php
              $url = "#";
              if(!empty($keypeserta['id_profil'])){
                $url = base_url()."c.php/admin/penilaian/peserta/".$keypeserta['id_profil'];
              }else{$url = "#";}
              ?>
              <a href="<?php echo $url; ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
            </td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->


<div class="modal modal-default fade" id="modal-tambah">
  <!-- Modal Dialog -->
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content">
      <form action="<?php echo base_url(); ?>c.php/admin/penilaian/kelola" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Kelola Nilai</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Peserta</label>
            <select class="form-control select2" name="namapeserta" style="width:100%" required>
              <option selected disabled>Pilih</option>
              <?php foreach ($loadpeserta as $loadp) {?>
                <option value="<?php echo $loadp['id_profil']; ?>"><?php echo $loadp['nim']." - ".$loadp['nama_lengkap']; ?></option>
              <?php }?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" name="btnsimpan" value="Kelola nilai" class="btn btn-primary">
        </div>
      </form>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(document).on('click', '.btntambah', function(){
  $('#modal-tambah').modal('show');
});

$(function () {
  $('#atahun').on('select2:select', function () {
    var tahunajaran = $("#atahun").val();
    var bidang = $("#abidang").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxperiode',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {tahun_ajaran:tahunajaran,bidang:bidang},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#aperiode').html(data);	// mengisi konten
      }
    });
  });

  $('#abidang').on('select2:select', function () {
    var tahunajaran = $("#atahun").val();
    var bidang = $("#abidang").val();

      $.ajax({
        url: '<?php echo base_url(); ?>c.php/admin/ajaxperiode',	// set url -> ini file yang menyimpan query tampil detail data siswa
        method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
        data: {tahun_ajaran:tahunajaran,bidang:bidang},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
        success:function(data){		// kode dibawah ini jalan kalau sukses
          $('#aperiode').html(data);	// mengisi konten
        }
      });

  });

  $('#btncari').on('click', function(){
    var tahunajaran = $("#atahun").val();
    var bidang = $("#abidang").val();
    var periode = $("#aperiode").val();
    var active = "penilaian";

      $.ajax({
        url: '<?php echo base_url(); ?>c.php/admin/ajaxloadData',	// set url -> ini file yang menyimpan query tampil detail data siswa
        method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
        data: {tahun:tahunajaran,bidang:bidang,periode:periode,active:active},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
        success:function(data){		// kode dibawah ini jalan kalau sukses
          $('#dataload').html(data);	// mengisi konten
        }
      });
  });

});
</script>
