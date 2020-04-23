<?php
  $a = $this->global_model->find_by('sesi_dosen', array('id_sesi' => $loadsesidata['id_sesi']));
  $dosenprofil = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$a['id_dosen']));
  $gelar = "";
  if($dosenprofil['gelar']!=""){
    $gelar = ", ".$dosenprofil['gelar'];
  }



?>
<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Rincian Sesi
      <small><?php echo $dosenprofil['nama_lengkap'].$gelar; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>d.php/sesikuliah"><i class="fa fa-calendar"></i> Sesi Kuliah</a></li>
      <li><a href="<?php echo base_url();?>d.php/sesikuliah/view/<?php echo $loadsesidata['id_sesi']; ?>">Jadwal Kuliah</a></li>
      <li class="active">
        <?php
          $a = $this->global_model->find_by('m_matakuliah', array('id_matkul'=>$loadsesidata['id_matkul']));
          echo $a['nama_matkul'];
        ?>
      </li>
      <li class="active"><?php
        $b = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$loadsesidata['id_konsentrasi']));
        echo $b['kd_konsentrasi'];
      ?></li>
    </ol>
  </section>
  <!-- Finish Conten Header
       Main content -->
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
        <table id="example1" class="table table-bordered">
          <thead>
            <tr>
              <th width="10">No</th>
              <th width="20%">Tanggal Pertemuan</th>
              <th class="text-center" width="20%">Banyak Sesi</th>
              <th>Keterangan</th>
              <?php if($this->session->userdata('id_divisi') == "1"){ ?>
              <th class="text-center">Aksi</th>
              <?php }?>
            </tr>
          </thead>
          <tbody>
            <?php
              $no = 0;
              foreach ($loaddata as $key) {
                $no++;
            ?>
            <tr class="record">
              <td><?php echo $no;?></td>
              <td><?php if(date("j F Y", strtotime($key['tgl_sesi']))==""){echo "-";}else{echo date("j F Y", strtotime($key['tgl_sesi']));}?></td>
              <td class="text-center"><?php if($key['jmlhsesi']==""){echo "0";}else{echo $key['jmlhsesi'];}?></td>
              <td><?php if($key['keterangan']==""){echo "-";}else{echo $key['keterangan'];}?></td>
              <?php if($this->session->userdata('id_divisi') == "1"){ ?>
              <td class="text-center">
                <button type="button" class="btnhapus btn btn-default btn-xs" id="<?php echo $key['id_d']; ?>"><i class="fa fa-trash"></i></button>
              </td>
            <?php } ?>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        <!-- Finish Table Bagian Atas -->
      </div>
      <!-- Finish Box Body -->
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

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
        $("#myform").attr("action", "<?php echo base_url(); ?>d.php/sesikuliah/hapussesid/"+id);
    });
  </script>
