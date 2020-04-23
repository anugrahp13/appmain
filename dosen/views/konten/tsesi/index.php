<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Sesi
      <small>Tambah Sesi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dollar"></i> Tambahan</a></li>
      <li class="active">Tambah Sesi</li>
    </ol>
  </section>
  <!-- Fiish Content Header
       Content Header -->
  <section class="content-header">
    <div class="callout callout-info">
      <label>Informasi!</label>
      Periode tambah sesi di sesuaikan dengan periode cetak honor dosen.
    </div>
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
    <?php if($this->session->flashdata('messageactive') == "tsesi"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <form action="<?php echo base_url();?>d.php/tsesi/hapus" method="post" id="myform">
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
                <th>Nama Dosen</th>
                <th>Mata Kuliah</th>
                <th class="text-center">Banyak Sesi</th>
                <th>Periode</th>
                <?php if($this->session->userdata('id_divisi') == "1"){ ?>
                <th class="text-center">Aksi</th>
                <?php }?>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loadsesi as $key) {
                  $no++;
                  $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=> $key['id_dosen']));
                  if($a != null){
              ?>
              <tr class="record">
                <td id="kode" style="display:none;"><?php echo $key['id_dosensesi'];?></td>
                <td><input type="checkbox" name="check[]" value="<?php echo $key['id_dosensesi'];?>"></td>
                <td><?php echo $no;?></td>
                <td>
                  <?php
                    $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$key['id_dosen']));
                    $gelar = "";
                    if($a['gelar']!=""){
                      $gelar = ", ".$a['gelar'];
                    }
                    if($a['nama_lengkap']!=null){echo $a['nama_lengkap'].$gelar;}else{echo "-";}
                  ?>
                </td>
                <td>
                  <?php
                    $c = $this->global_model->find_by('m_matakuliah', array('id_matkul'=>$key['id_matkul']));
                    if($c['nama_matkul']!=""){
                      echo $c['nama_matkul'];
                    }else{echo "-";}
                  ?>
                </td>
                <td class="text-center"><?php echo $key['banyak_sesi'] ?></td>
                <td>
                  <?php
                    echo date("j F Y", strtotime($key['periode_dari']))." - ".date("j F Y", strtotime($key['periode_sampai']));
                  ?>
                </td>
                <?php if($this->session->userdata('id_divisi') == "1"){ ?>
                <td class="text-center">
                  <button type="button" class="btnedit btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></button>
                </td>
                <?php }?>
              </tr>
              <?php
                }
              }
              ?>
            </tbody>
          </table>
          <!-- Finish Table Bagian Atas -->
        </div>
        <!-- Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish main Content -->

  <!-- Modal Tambah -->
  <div class="modal fade" id="modal-default">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Data</h4>
        </div>
        <form method="post" action="" role="form">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Dosen</label>
                  <select name="id_dosen" class="form-control select2" style="width:100%;">
                    <?php foreach ($loaddosen as $key) {?>
                      <?php
                        $gelar = "";
                        if($key['gelar'] != ""){
                          $gelar = ", ".$key['gelar'];
                        }?>
                      <option value="<?php echo $key['id_dosen'];?>"><?php echo $key['nama_lengkap'].$gelar;?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Mata Kuliah</label>
                  <select name="id_matkul" class="form-control select2" style="width:100%;">
                    <?php foreach ($loadmatkul as $key) {?>
                      <option value="<?php echo $key['id_matkul']?>"><?php echo $key['nama_matkul'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <select name="thn_ajaran" class="form-control select2" style="width:100%;">
                    <?php foreach ($loadthnajaran as $key) {?>
                      <option value="<?php echo $key['thn_ajaran']?>"><?php echo $key['thn_ajaran']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Banyak Sesi</label>
                  <input type="number" name="banyak_sesi" class="form-control" onkeypress="return isNumberKey(event)" required>
                </div>
                <div class="form-group">
                  <label>Dari</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="periode_dari" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Sampai</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker2" name="periode_sampai" required>
                  </div>
                </div>
              </div>
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
          <h4 class="modal-title">Hapus Data sesi</h4>
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

  <!-- Modal Edit -->
  <div class="modal fade" id="modal-default-edit">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah tsesi</h4>
        </div>
        <form method="post" role="form" id="editform">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Dosen</label>
                  <select name="id_dosen" class="form-control select2" style="width:100%;" id="namadosen">
                    <?php foreach ($loaddosen as $key) {?>
                      <?php
                        $gelar = "";
                        if($key['gelar'] != ""){
                          $gelar = ", ".$key['gelar'];
                        }?>
                      <option value="<?php echo $key['id_dosen'];?>"><?php echo $key['nama_lengkap'].$gelar;?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Mata Kuliah</label>
                  <select name="id_matkul" class="form-control select2" style="width:100%;" id="matkul">
                    <?php foreach ($loadmatkul as $key) {?>
                      <option value="<?php echo $key['id_matkul']?>"><?php echo $key['nama_matkul'];?></option>
                    <?php }?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <select name="thn_ajaran" class="form-control select2" style="width:100%;" id="idthnajaran">
                    <?php foreach ($loadthnajaran as $key) {?>
                      <option value="<?php echo $key['thn_ajaran']?>"><?php echo $key['thn_ajaran']?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Banyak sesi</label>
                  <input type="number" name="banyak_sesi" class="form-control" onkeypress="return isNumberKey(event)" required id="bsesi">
                </div>
                <div class="form-group">
                  <label>Dari</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker3" name="periode_dari" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Sampai</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker4" name="periode_sampai" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-success" name="simpan" value="Simpan">
          </div>
        </form>
      </div>
      <!-- inish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Edit -->
  
  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript">
    $(".btnedit").click(function(event) {
        var record = $(this).parents('.record');

        $.getJSON('<?php echo base_url()."d.php/tsesi/tampil/" ?>'+record.find('#kode').html(), function(data) {
        $("#namadosen").val(data.id_dosen).trigger('change');
        $("#idthnajaran").val(data.thn_ajaran).trigger('change');
        $("#matkul").val(data.id_matkul).trigger('change');
        $("#bsesi").val(data.banyak_sesi);
        $("#datepicker3").val(data.periode_dari);
        $("#datepicker4").val(data.periode_sampai);
        $("#editform").attr("action", "<?php echo base_url()."d.php/tsesi/ubah/" ?>"+record.find('#kode').html());
    });
        $('#modal-default-edit').modal('show');
    });
  </script>
