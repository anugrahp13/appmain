<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dosen
      <small>Daftar Dosen</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-male"></i> Dosen</a></li>
      <li class="active">Daftar Dosen</li>
    </ol>
  </section>
  <section class="content-header">
    <?php if($this->session->userdata('id_divisi') == "1"){ ?>
    <a class="btn btn-default" href="<?php echo base_url(); ?>d.php/dosen/tambah"><i class="fa fa-plus-square"></i> Tambah</a>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i> Hapus</button>
    <?php }?>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-cetak"><i class="fa fa-print"></i> Cetak</button>
  </section>

  <!-- Main Content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "dosen"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
      <!-- Default Box -->
      <div class="box">
        <!-- Box Body -->
        <div class="box-body">
          <form method="post" id="myform" action="<?php echo base_url();?>d.php/dosen/hapus">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="display:none;"></th>
                  <th style="width:20px;">
                    <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
                  </th>
                  <th width="10">No</th>
                  <th>Nama Dosen</th>
                  <th>Praktisi</th>
                  <th>Japung</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $no = 0;
                  foreach ($loaddosen as $key) {
                    $no++;

                    if(!empty($key)){
                ?>
                <tr class="record">
                  <td id="kode" style="display:none;"><?php echo $key['id_dosen']; ?></td>
                  <td><input type="checkbox" name="check[]" value="<?php echo $key['id_dosen']; ?>"></td>
                  <td><?php echo $no;?></td>
                  <td>
                    <?php
                      $gelar = "";
                      $namaload = $key['nama_lengkap'];
                      if(!empty($key['gelar'])){
                        $gelar = ", ".$key['gelar'];
                      }

                      if(empty($namaload)){echo "-";}else{echo $namaload.$gelar;}
                    ?>
                  </td>
                  <td>
                    <?php
                      $a = $this->global_model->find_by('m_praktisi', array('id_praktisi' => $key['id_praktisi']));
                      if(empty($a['nama_praktisi'])){echo "-";}else{echo $a['nama_praktisi'];}
                    ?>
                  </td>
                  <td>
                    <?php
                      $a = $this->global_model->find_by('m_japung', array('id_japung' => $key['id_japung']));
                      if(empty($a['nama_japung'])){echo "-";}else{echo $a['nama_japung'];}
                    ?>
                  </td>
                  <td class="text-center">
                    <a class="btn btn-default btn-xs" href="<?php echo base_url();?>d.php/dosen/view/<?php echo $key['id_dosen']; ?>"><i class="fa fa-eye"></i></a>
                    <?php if($this->session->userdata('id_divisi') == "1"){ ?>
                    <a class="btn btn-default btn-xs" href="<?php echo base_url();?>d.php/dosen/ubah/<?php echo $key['id_dosen']; ?>"><i class="fa fa-pencil"></i></a>
                    <?php }?>
                  </td>
                </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </form>
        </div>
        <!-- Finish Box Body -->
      </div>
      <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal -->
  <div class="modal modal-danger fade" id="modal-danger">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Dosen</h4>
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
  <!-- Finish Modal -->

  <!-- Modal -->
  <div class="modal fade" id="modal-cetak">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Data Dosen</h4>
        </div>
        <form method="post" action="<?php echo base_url(); ?>d.php/dosen/cetak" role="form" target="_blank">
          <div class="modal-body">
            <div class="form-group">
              <label>Nama Dosen</label>
              <!-- Select Option -->
              <select name="id_dosen" class="form-control select2" style="width:100%;">
                <option value="all">Semua</option>
                <?php foreach ($loaddosen as $key)
                {
                  $gelar = "";
                  $namaload = $key['nama_lengkap'];
                  if(!empty($key['gelar'])){
                    $gelar = ", ".$key['gelar'];
                  }
                ?>
                  <!-- Option -->
                  <option value="<?php echo $key['id_dosen'] ?>">
                    <?php 
                      if(empty($namaload)){
                        echo "-";
                      }else{
                        echo $namaload.$gelar;
                      } 
                    ?>
                  </option>
                  <!-- Finish Option -->
                <?php } ?>
              </select>
              <!-- Finish Select Option -->
            </div>
            <div class="form-group">
              <label>Tahun Ajaran</label>
              <select name="thnajaran" class="form-control select2" style="width:100%;">
                <?php foreach ($tahunajaran as $loadtahun){?>
                  <option value="<?php echo $loadtahun['thn_ajaran'] ?>">
                    <?php echo $loadtahun['thn_ajaran']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Tipe cetakan</label>
              <div class="radio">
                <label>
                  <input name="tipecetakan" value="single" checked type="radio">
                  Single
                </label>
              </div>
              <div class="radio">
                <label>
                  <input name="tipecetakan" value="rekap" type="radio">
                  Rekap
                </label>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-success" name="simpan" value="Cetak">
          </div>
        </form>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish  Modal Dialog -->
  </div>
  <!-- Finish Modal -->
