<?php
  $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$loaddosen['id_dosen']));
  $gelar = "";
  if($a['gelar'] != ""){
    $gelar = ", ".$a['gelar'];
  }
?>
<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Jadwal Kuliah
      <small><?php echo $a['nama_lengkap'].$gelar; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>d.php/sesikuliah"><i class="fa fa-calendar"></i> Sesi Kuliah</a></li>
      <li><a href="<?php echo base_url();?>d.php/sesikuliah/t/<?php echo $loaddosen['id_dosen'] ?>"><?php echo $loaddosen['thn_ajaran']; ?></a></li>
      <li class="active">Jadwal Kuliah </li>
    </ol>
  </section>
  <!-- Finish Content Header -->
  <?php if($this->session->userdata('id_divisi') == "1"){ ?>
  <!-- Content Header -->
  <section class="content-header">
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-tambah"><i class="fa fa-plus"></i> Tambah Jadwal Kuliah</button>
  </section>
  <!-- Finish Content Header -->
  <?php }?>
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
        <!-- Box Body -->
        <div class="box-body">
          <!-- Table Bagian Atas -->
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="10">No</th>
                <th>Mata Kuliah</th>
                <th class="text-center">Konsentrasi</th>
                <th class="text-center">SKS</th>
                <th class="text-center">Semester</th>
                <th class="text-center">Jumlah Sesi</th>
                <th class="text-center">Nominal Inggris</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loaddata as $key) {
                  $no++;
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td>
                  <?php
                    $a = $this->global_model->find_by('m_matakuliah', array('id_matkul'=> $key['id_matkul']));
                    if($a != null){echo $a['nama_matkul'];}else{ echo "-";}
                  ?>
                </td>
                <td class="text-center">
                  <?php
                    $b = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=> $key['id_konsentrasi']));
                    if($b != null){echo $b['kd_konsentrasi'];}else{ echo "-";}
                  ?>
                </td>
                <td class="text-center"><?php echo $key['sks'];?></td>
                <td class="text-center"><?php echo $key['semester'];?></td>
                <td class="text-center">
                  <?php
                  $a = $this->global_model->query("select sum(jmlhsesi) as jmlh from sesi_d where id_sesid='".$key['id_sesid']."'");
          				$get = $a[0]['jmlh'];
                  if($get == null){
                    echo "0";
                  }else{
                    echo $get;
                  }
                  ?>
                </td>
                <td align="right"><?php if(!empty($key['nominal_inggris'])){echo $key['nominal_inggris'];} ?></td>
                <td class="text-center">
                  <a href="<?php echo base_url(); ?>d.php/sesikuliah/viewsesi/<?php echo $key['id_sesid']; ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                  <?php if($this->session->userdata('id_divisi') == "1"){ ?>
                  <button type="button" class="btnsesi btn btn-default btn-xs" id="<?php echo $key['id_sesid']; ?>"><i class="fa fa-pencil-square-o"></i></button>&nbsp;&nbsp;|&nbsp;
                  <button type="button" class="btnedit btn btn-default btn-xs" id="<?php echo $key['id_sesid']; ?>"><i class="fa fa-pencil"></i></button>
                  <button type="button" class="btnhapus btn btn-default btn-xs" id="<?php echo $key['id_sesid']; ?>"><i class="fa fa-trash"></i></button>
                  <?php }?>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <!-- Finish Table Bagian Atas -->
        </div>
        <!-- Finish Box  Body -->
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal Tambah -->
  <div class="modal fade" id="modal-tambah">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Mata Kuliah</h4>
        </div>
        <form method="post" action="" role="form">
          <div class="modal-body">
            <div class="form-group">
              <label>Mata Kuliah</label>
              <select class="form-control select2" name="id_matkul" style="width:100%;">
                <?php foreach ($loadmatkul as $key) { ?>
                  <option value="<?php echo $key['id_matkul']; ?>">
                    <?php echo $key['nama_matkul']; ?> 
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <select class="form-control select2" style="width:100%;" name="id_konsentrasi">
                <?php foreach ($loadkonsentrasi as $key) { ?>
                  <option value="<?php echo $key['id_konsentrasi']; ?>">
                    <?php echo $key['kd_konsentrasi']; ?>  
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>SKS</label>
                  <select class="form-control" name="sks">
                    <option value="2">2</option>
                    <option value="4">4</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Semester</label>
                  <select class="form-control" name="semester">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Nominal Bahasa Inggris</label>
              <input type="number" name="nominal_inggris" value="0" min="0" class="form-control" onkeypress="return isNumberKey(event)" required>
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
  <!-- Finish Modal Tambah-->

  <!-- Modal Edit -->
  <div class="modal fade" id="modal-default-edit">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Mata Kuliah</h4>
        </div>
        <form method="post" id="editform" role="form">
          <div class="modal-body">
            <div class="form-group">
              <label>Mata Kuliah</label>
              <select class="form-control select2" name="id_matkul" style="width:100%;" id="ematakuliah">
                <?php foreach ($loadmatkul as $key) {?>
                <option value="<?php echo $key['id_matkul']; ?>"><?php echo $key['nama_matkul']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>Kelas</label>
              <select class="form-control select2" style="width:100%;" name="id_konsentrasi" id="ekelas">
                <?php foreach ($loadkonsentrasi as $key) {?>
                <option value="<?php echo $key['id_konsentrasi']; ?>"><?php echo $key['kd_konsentrasi']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>SKS</label>
                  <select class="form-control" name="sks" id="esks">
                    <option value="2">2</option>
                    <option value="4">4</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Semester</label>
                  <select class="form-control" name="semester" id="esemester">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Nominal Bahasa Inggris</label>
              <input type="number" name="nominal_inggris" value="0" min="0" class="form-control" onkeypress="return isNumberKey(event)" id="enominalinggris" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <input type="submit" class="btn btn-success" name="simpan" value="Simpan">
          </div>
        </form>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Edit -->

  <!-- Modal Sesi -->
  <div class="modal fade" id="modal-sesi">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-sm">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Sesi</h4>
        </div>
        <form method="post" role="form" id="sesiform">
          <div class="modal-body">
            <div class="form-group">
              <label>Tanggal Pertemuan</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker2" name="tgl_sesi" required>
              </div>
              <!-- /.input group -->
            </div>
            <div class="form-group">
              <label>Banyak Sesi</label>
              <input type="number" name="jmlhsesi" class="form-control" onkeypress="return isNumberKey(event)" required>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" placeholder="Optional"></textarea>
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
  <!-- Finish Modal Sesi -->

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
        <form id="myform">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" form="myform" class="btn btn-danger">Hapus</button>
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
    $(".btnhapus").click(function(event) {
        var id = $(this).attr("id");
        $('#modal-danger').modal("show");	// menampilkan dialog modal nya
        $("#myform").attr("action", "<?php echo base_url(); ?>d.php/sesikuliah/hapus/"+id);
    });

    $(".btnsesi").click(function(event) {
        var id = $(this).attr("id");
        $('#modal-sesi').modal("show");	// menampilkan dialog modal nya
        $("#sesiform").attr("action", "<?php echo base_url(); ?>d.php/sesikuliah/sesi/"+id);
    });

    $(".btnedit").click(function(event) {
        var id = $(this).attr("id");
        $.getJSON('<?php echo base_url()."d.php/sesikuliah/tampil/" ?>'+id, function(data) {
        $("#ematakuliah").val(data.id_matkul).trigger('change');
        $("#ekelas").val(data.id_konsentrasi).trigger('change');
        $("#esks").val(data.sks).trigger('change');
        $("#esemester").val(data.semester).trigger('change');
        $("#enominalinggris").val(data.nominal_inggris);
        $("#editform").attr("action", "<?php echo base_url()."d.php/sesikuliah/ubah/" ?>"+id);
    });
        $('#modal-default-edit').modal('show');
    });
  </script>
