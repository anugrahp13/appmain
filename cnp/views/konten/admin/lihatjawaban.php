<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lihat Jawaban Peserta
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url();?>c.php/admin/reviewjawaban">Lihat Jawaban Ujian</a></li>
    <li class="active">Peserta</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <div class="row">
        <?php
        $loadprofil = $this->global_model->find_by('pkt_profil', array('id_profil'=>$idnih));
        ?>
        <div class="col-md-2">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/image/<?php if(!empty($loadprofil['img'])){echo $loadprofil['img'];}else{echo "default.png";} ?>" alt="User profile picture">
        </div>
        <div class="col-md-3">
          <label>Nama Peserta</label>
          <p class="text-muted">
            <?php if(!empty($loadprofil['nama_lengkap'])){echo $loadprofil['nama_lengkap'];}else{ echo "-";} ?>
          </p>
          <label>NIM</label>
          <p class="text-muted">
            <?php if(!empty($loadprofil['nim'])){echo $loadprofil['nim'];}else{ echo "-";} ?>
          </p>
        </div>
        <div class="col-md-3">
          <label>Nama Ujian</label>
          <p class="text-muted">
            <?php if(!empty($loadheader['nama_ujian'])){echo $loadheader['nama_ujian'];}else{ echo "-";} ?>
          </p>
          <label>Tanggal</label>
          <p class="text-muted">
            <?php if(!empty($loadheader['tgl_ujian'])){echo $loadheader['tgl_ujian'];}else{ echo "-";} ?>
          </p>
        </div>
        <div class="col-md-2">
          <label>Waktu Pelaksanaan</label>
          <p class="text-muted">
            <?php
              $jammulai = "-";
              $jamakhir = "-";
              if(!empty($loadheader['jam_mulai'])){
                $jammulai = $loadheader['jam_mulai'];
              }
              if(!empty($loadheader['jam_akhir'])){
                $jamakhir = $loadheader['jam_akhir'];
              }
              echo $jammulai." s/d ".$jamakhir;
            ?>
          </p>
        </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="col-md-10 col-sm-offset-1">
          <?php
            $loadbab = $this->global_model->query("select id_headersoal,bab_soal,bobot from konten_ujian where id_headersoal='".$loadheader['id_headersoal']."' group by bab_soal");
            foreach ($loadbab as $keybab) {
          ?>
          <p class="lead"><?php echo str_replace('-',' ',$keybab['bab_soal'])." (".$keybab['bobot']."%)"; ?></p>
          <?php
            $no = 0;
            foreach ($this->global_model->find_all_by('konten_ujian', array('bab_soal'=>$keybab['bab_soal'])) as $keysub) {
              $no++;
          ?>
          <label class="control-label"><?php echo $no.". ".$keysub['soal']; ?></label><br>
          <p class="text-muted">Jawaban : </p>
          <p class="text-muted">
            <?php
              $jawaban = $this->global_model->find_by('j_pesertaujian', array('id_kontenujian'=>$keysub['id_kontenujian'],'id_profil'=>$loadprofil['id_profil']));
              if(!empty($jawaban)){
                echo $jawaban['jawaban'];
              }else{
                echo "-";
              }
            ?>
          </p><br>
          <?php
              }
            }
          ?>
        </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /. box -->
</section>
<!-- /.content -->
