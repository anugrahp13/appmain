<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Peserta Ujian
    <button class="btntambah btn btn-default btn-xs" title="Tambah Ujian"><i class="fa fa-plus-circle"></i> Tambah</button>
    <button class="btnhapus btn btn-default btn-xs" title="Hapus Ujian"><i class="fa fa-trash"></i> Hapus</button>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/ujian">Ujian</a></li>
    <li class="active">Daftar Peserta</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "ujianpeserta"){?>
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
    <div class="box-body">
      <form method="post" id="myform" action="">
        <table id="advanceDTables" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <td style="display:none"></td>
              <th class="no-sort text-center" style="width:20px">
                <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
              </th>
              <th class="no-sort text-center" width="48">Foto</th>
              <th width="100">NIM</th>
              <th>Nama Peserta</th>
              <th>Bidang</th>
              <th>Periode</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($loadpeserta as $keyoke) {
              $keypeserta = $this->global_model->find_by('pkt_profil', array('id_profil'=>$keyoke['id_profil']));
              $imgdefault = "default.png";
              if(!empty($keypeserta['img'])){ $imgdefault = $keypeserta['img'];}
            ?>
            <tr class="record" style="height:50px">
              <td style="display:none" id="kode"><?php echo $keypeserta['id_profil']; ?></td>
              <td class="text-center" style="vertical-align:middle;"><input type="checkbox" name="check[]" value="<?php echo $keypeserta['id_profil']; ?>"></td>
              <td class="text-center"><img src="<?php echo base_url(); ?>assets/image/<?php echo $imgdefault; ?>" width="42" height="42" /></td>
              <td style="vertical-align:middle;"><?php if(!empty($keypeserta['nim'])){echo $keypeserta['nim'];}else{echo "-";} ?></td>
              <td style="vertical-align:middle;"><?php if(!empty($keypeserta['nama_lengkap'])){echo $keypeserta['nama_lengkap'];}else{echo "-";} ?></td>
              <td style="vertical-align:middle;">
                <?php
                  $getbidang = $this->global_model->find_by('m_bidang', array('id_bidang'=>$keypeserta['id_bidang']));
                  if(!empty($getbidang)){
                    echo $getbidang['nama_bidang'];
                  }
                ?>
              </td>
              <td style="vertical-align:middle;">
                <?php
                $periodedari = "-";
                $periodesampai = "-";
                if(!empty($keypeserta['periode_dari'])){$periodedari =  $keypeserta['periode_dari'];}
                if(!empty($keypeserta['periode_sampai'])){$periodesampai =  $keypeserta['periode_sampai'];}
                echo $periodedari." - ".$periodesampai;
                ?>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->

<div class="modal modal-default fade" id="modal-peserta">
  <!-- Modal Dialog -->
  <div class="modal-dialog">
    <!-- Modal Content -->
    <div class="modal-content">
      <form role="form" method="post" action="">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Peserta Ujian</h4>
        </div>
        <div class="modal-body" style="max-height:200px; overflow: auto;">
          <select name="tambahpeserta[]" class="form-control select2" multiple="multiple" style="width: 100%;" required>
            <?php foreach ($loadpkt as $keycuyy) {?>
                <option value="<?php echo $keycuyy['id_profil']; ?>"><?php echo $keycuyy['nim']." - ".$keycuyy['nama_lengkap']; ?></option>
            <?php }?>
          </select>
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
          <button type="submit" name="hapuskuy" value="Hapus" form="myform" class="btn btn-danger">Hapus</button>
        </div>
    </div>
    <!-- Finish Modal Content -->
  </div>
  <!-- Finish Modal Dialog -->
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
  $(".btntambah").click(function(event) {
    $('#modal-peserta').modal('show');
  });

  $(".btnhapus").click(function(event) {
    $('#modal-danger').modal('show');
  });
</script>
