<?php
$check = $this->global_model->find_by('pkt_profil', array('id_profil'=>$this->session->userdata('idtrigger')));
if($check != null){
  $loadindikator = $this->global_model->query("select id_bidang,id_kategori from m_indikator where id_bidang='".$check['id_bidang']."' group by id_kategori");
}else{
  redirect(site_url('admin/penilaian'));
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Penilaian
    <small>Kelola nilai peserta</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/penilaian">Penilaian</a></li>
    <li class="active">Kelola nilai</li>
    <li class="active"><?php echo $check['nama_lengkap']; ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "kelolanilai"){?>
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
    ?>
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-2">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/image/<?php if(!empty($check['img'])){echo $check['img'];}else{echo "default.png";} ?>" alt="User profile picture">
        </div>
        <div class="col-md-3">
          <label>Nama Lengkap</label>
          <p class="text-muted">
            <?php if(!empty($check['nama_lengkap'])){echo $check['nama_lengkap'] ;}else{echo "-";} ?>
          </p>
          <label>NIM</label>
          <p class="text-muted">
            <?php if(!empty($check['nim'])){echo $check['nim'] ;}else{echo "-";} ?>
          </p>
        </div>
        <div class="col-md-3">
          <label>Bidang</label>
          <p class="text-muted">
            <?php
              $getbidang = $this->global_model->find_by('m_bidang', array('id_bidang'=>$check['id_bidang']));
              if(!empty($getbidang)){
                echo $getbidang['nama_bidang'];
              }
            ?>
          </p>
          <label>Konsentrasi / Semester</label>
          <p class="text-muted">
            <?php
              $getkonsentrasi = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$check['id_konsentrasi']));
              if(!empty($getkonsentrasi)){
                echo $getkonsentrasi['nama_konsentrasi']." / ";
              }
              echo $check['semester'];
            ?>
          </p>
        </div>
        <div class="col-md-3">
          <label>Tahun Ajaran</label>
          <p class="text-muted"><?php echo $check['tahun_ajaran'];?></p>
          <label>Periode</label>
          <p class="text-muted">
            <?php
              echo $check['periode_dari']." - ".$check['periode_sampai'];
            ?>
          </p>
        </div>
      </div>
    </div><br>
    <div class="box-body">
      <?php
      if(!empty($loadindikator)){?>
      <form method="post" action="" class="form-horizontal">
        <?php
          foreach ($loadindikator as $key) {
            $kategori = $this->global_model->find_by('m_kategori', array('id_kategori'=>$key['id_kategori']));
        ?>
        <p class="lead col-sm-offset-2"><?php echo $kategori['nama_kategori']; ?></p>
        <?php
          foreach ($this->global_model->find_all_by('m_indikator', array('id_bidang' => $key['id_bidang'],'id_kategori'=>$key['id_kategori'])) as $lindikator) {
            $nilai = $this->global_model->find_by('pkt_nilai', array('id_indikator'=>$lindikator['id_indikator'],'id_profil'=>$check['id_profil']));
            $getnilai = 0;
            if($nilai != null){
              $getnilai = $nilai['nilai'];
            }
        ?>
        <div class="form-group">
          <label class="col-sm-6 control-label"><?php echo $lindikator['nama_indikator']; ?></label>
          <div class="col-sm-4">
            <input class="form-control" type="number" name="<?php echo $lindikator['id_indikator']; ?>" value="<?php echo $getnilai; ?>">
          </div>
        </div>
        <?php } ?>
      <br><br>
      <?php } ?>
      <div class="form-group">
        <div class="col-sm-offset-6 col-sm-4">
          <input type="submit" class="btn btn-default" name="simpan" value="Simpan data">
        </div>
      </div>
      </form>
    <?php }?>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
