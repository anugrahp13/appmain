<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    PKT
    <small>Daftar Peserta PKT</small>
  </h1>
</section>
<section class="content-header">
  <a href="<?php echo base_url(); ?>c.php/admin/datapkt/tambah" class="btn btn-default btn-sm" title="Tambah Data"><i class="fa fa-plus-circle"></i> Tambah</a>
  <button class="btnhapus btn btn-default btn-sm" title="Hapus Data"><i class="fa fa-trash"></i> Hapus</button>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">PKT</li>
    <li class="active">Daftar Peserta</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "datapkt"){?>
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
    <form method="post" id="myform" action="<?php echo base_url(); ?>c.php/admin/hapuspkt">
    <div class="box-body" id="dataload">
      <table id="advanceDTables" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <td style="display:none"></td>
            <th style="width:20px" class="no-sort">
              <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
            </th>
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
          <tr class="record">
            <td style="display:none" id="kode"><?php echo $keypeserta['id_profil']; ?></td>
            <td><input type="checkbox" name="check[]" value="<?php echo $keypeserta['id_profil']; ?>"></td>
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
                $url = base_url()."c.php/admin/datapkt/ubah/".$keypeserta['id_profil'];
              }else{$url = "#";}
              ?>
              <a href="<?php echo $url; ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
            </td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </form>
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
$(document).on('click', '.btnhapus', function(){
  $('#modal-danger').modal('show');
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
    var active = "datapkt";

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
