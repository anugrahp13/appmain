<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Penilaian
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Penilaian</li>
    <li class="active">Lihat Penilaian Peserta</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
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
      <table id="basicDTables" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th class="text-center" style="width:20px">No.</th>
            <th>Kategori</th>
            <th>Indikator Penilaian</th>
            <th class="text-center">Nilai</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 0;
          foreach ($loaddata as $loadkey) {
            $no++;
            $kategoriname = $this->global_model->find_by('m_kategori', array('id_kategori'=>$loadkey['id_kategori']));
            $checknilaibro = $this->global_model->find_by('pkt_nilai', array('id_indikator'=>$loadkey['id_indikator'],'id_profil'=>$idprofilnih));
            $getnilai = 0;
            if($checknilaibro != null){
              $getnilai = $checknilaibro['nilai'];
            }
          ?>
            <tr>
              <td class="text-center"><?php echo $no; ?></td>
              <td><?php echo $kategoriname['nama_kategori']; ?></td>
              <td><?php echo $loadkey['nama_indikator'];?></td>
              <td class="text-center"><?php echo $getnilai; ?></td>
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
