<?php
$i = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$this->session->userdata('tid')));
$gelar = "";
if($i['gelar']!=""){
  $gelar = ", ".$i['gelar'];
}
?>
<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tahun
      <small><?php echo $i['nama_lengkap'].$gelar; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>d.php/sesikuliah"><i class="fa fa-calendar"></i> Sesi Kuliah</a></li>
      <li class="active">Daftar Tahun</li>
    </ol>
  </section>
  <!-- Finish Content Header -->
  <?php if($this->session->userdata('id_divisi') == "1"){ ?>
  <!-- Content Header -->
  <section class="content-header">
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus-square"></i> Tambah</button>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i> Hapus</button>
  </section>
  <!-- Finish Content Header -->
  <?php } ?>

  <!-- Main Content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "sesikuliah"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <form action="<?php echo base_url();?>d.php/sesikuliah/thapus" method="post" id="myform">
        <!-- Box Body -->
        <div class="box-body">
          <!-- Table Bagian Atas -->
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th style="width:20px;">
                  <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
                </th>
                <th width="10">No</th>
                <th>Tahun Ajaran</th>
                <th class="text-center">Banyak Jadwal Kuliah</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loadsesi as $key) {
                  $no++;
              ?>
                <tr class="record">
                  <td id="kode" style="display:none;"><?php echo $key['id_sesi']; ?></td>
                  <td><input type="checkbox" name="check[]" value="<?php echo $key['id_sesi']; ?>"></td>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $key['thn_ajaran']; ?></td>
                  <td class="text-center">
                    <?php
                      $a = count($this->global_model->find_all_by('sesi_data', array('id_sesi'=>$key['id_sesi'])));
                      echo $a;
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="<?php echo base_url(); ?>d.php/sesikuliah/view/<?php echo $key['id_sesi']; ?>" class="btn btn-default btn-xs">Lihat Data</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- Finish Table Bagian Atas -->
        </div>
        <!-- Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal Tambah -->
  <div class="modal fade" id="modal-default">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <form method="post" action="" role="form">
          <div class="modal-body">
            <div class="form-group">
              <label>Tahun Ajaran</label>
              <input type="text" name="thn_ajaran" class="form-control" required onkeypress="return isNumberKey3(event)">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-success" name="simpan" value="Buat">
          </div>
        </form>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Tambah -->

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
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" form="myform" class="btn btn-danger">Hapus</button>
        </div>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Danger -->