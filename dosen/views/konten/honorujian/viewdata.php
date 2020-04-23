<?php
$ab = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$loaddosen['id_dosen']));
$gelar = "";
if($ab['gelar']!=""){
  $gelar = ", ".$ab['gelar'];
}
?>
<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Honor Ujian
      <small><?php echo $ab['nama_lengkap'].$gelar; ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>d.php/honorujian"><i class="fa fa-sheqel"></i> Honor Ujian</a></li>
      <li class="active"><?php echo $loaddosen['thn_ajaran']; ?></li>
      <li class="active"><?php echo $loaddosen['tgl']; ?></li>
    </ol>
  </section>
  <!-- Finish Content Header
       Content Header -->
  <section class="content-header">
    <button class="btn btn-default" id="btnmodal"><i class="fa fa-plus"></i> Tambah</button>
  </section>
  <!-- Finish Content Header -->
  <!-- Main Content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "honorujian"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
        <div class="box-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="10" rowspan="2" style="text-align:center;vertical-align:middle;">No</th>
                <th rowspan="2" style="text-align:center;vertical-align:middle;" >Mata Kuliah</th>
                <th rowspan="2" style="text-align:center;vertical-align:middle;" >Kelas</th>
                <th rowspan="2" style="text-align:center;vertical-align:middle;" >SMT</th>
                <th colspan="2" class="text-center">Koreksi</th>
                <th colspan="2" class="text-center">Pembuatan Soal</th>
                <th rowspan="2" class="text-center" style="text-align:center;vertical-align:middle;">Mengawas</th>
                <th rowspan="2" class="text-center" style="text-align:center;vertical-align:middle;">Aksi</th>
              </tr>
              <tr>
                <td class="text-center">Qty</td>
                <td class="text-center">Tipe Koreksi</td>
                <td class="text-center">Qty</td>
                <td class="text-center">Tipe Soal</td>
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
                    $a = $this->global_model->find_by('m_matakuliah', array('id_matkul'=>$key['id_matkul']));
                    echo $a['nama_matkul'];
                  ?>
                </td>
                <td class="text-center">
                  <?php
                    $b = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$key['id_konsentrasi']));
                    echo $b['kd_konsentrasi'];
                  ?>
                </td>
                <td class="text-center">
                  <?php
                    echo $key['semester'];
                  ?>
                </td>
                <td class="text-center"><?php echo $key['qty_koreksi']; ?></td>
                <td class="text-center">
                  <?php
                    if($key['tipekoreksi']=="2sks"){
                      echo "2 SKS";
                    }else if($key['tipekoreksi']=="4sks"){
                      echo "4 SKS";
                    }
                  ?>
                </td>
                <td class="text-center"><?php echo $key['qty_buat']; ?></td>
                <td class="text-center">
                  <?php
                    if($key['tipebuat']=="puts"){
                      echo "UTS";
                    }else if($key['tipebuat']=="puas"){
                      echo "UAS";
                    }
                  ?>
                </td>
                <td class="text-center"><?php echo $key['qty_asistensi']."x"; ?></td>
                <td class="text-center">
                  <button type="button" class="btnhapus btn btn-default btn-xs" id="<?php echo $key['id_hud']; ?>"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- Finish Box Body -->
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal Tambah -->
  <div class="modal fade" id="modal-tambah">
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
                  <label>Mata Kuliah</label>
                  <select class="form-control select2" style="width:100%;" name="id_matkul">
                    <?php foreach ($loadmatkul as $key) {?>
                    <option value="<?php echo $key['id_matkul']; ?>"><?php echo $key['nama_matkul']; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label>Kelas</label>
                  <select class="form-control select2" style="width:100%;" name="id_konsentrasi">
                    <?php foreach ($loadkonsentrasi as $key) {?>
                      <option value="<?php echo $key['id_konsentrasi']; ?>">
                        <?php 
                          echo $key['kd_konsentrasi']; 
                        ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

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

                <div class="form-group">
                  <label>Koreksi</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="number" name="qty_koreksi" class="form-control" placeholder="Qty Koreksi" required onkeypress="return isNumberKey(event)" min="0" value="0">
                    </div>
                    <div class="col-md-6">
                      <select name="tipekoreksi" class="form-control">
                        <option value="2sks">2 SKS</option>
                        <option value="4sks">4 SKS</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Pembuatan Soal</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="number" name="qty_buat" class="form-control" placeholder="Qty Buat" required onkeypress="return isNumberKey(event)" min="0" value="0">
                    </div>
                    <div class="col-md-6">
                      <select name="tipebuat" class="form-control">
                        <option value="puts">UTS</option>
                        <option value="puas">UAS</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Mengawas</label>
                  <div class="row">
                    <div class="col-md-6">
                      <input type="number" id="qtyawas" name="qty_asistensi" class="form-control" placeholder="Qty" required onkeypress="return isNumberKey(event)">
                    </div>
                    <div class="col-md-6">
                      <input type="number" id="honor" class="form-control" disabled>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="number" class="form-control" id="total" class="form-control" disabled>
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
  <!-- Finish Modal Tambah-->

  <!-- Modal Danger -->
  <div class="modal modal-danger fade" id="modal-danger">
    <!-- Modal Diaolog -->
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
      $("#qtyawas").keyup(function(){
            var val1 = eval($("#qtyawas").val());
            var val2 = eval($("#honor").val());

            var total = val1*val2;

            $("#total").val(total);
     });

    $(".btnhapus").click(function(event) {
        var id = $(this).attr("id");
        $('#modal-danger').modal("show");	// menampilkan dialog modal nya
        $("#myform").attr("action", "<?php echo base_url(); ?>d.php/honorujian/hapus/"+id);
    });
    $("#btnmodal").click(function(event) {
        var record = $(this).parents('.record');

        $.getJSON('<?php echo base_url()."d.php/honorujian/loadhonor/".$loaddosen['id_dosen']; ?>', function(data) {
          $("#honor").val(data.honor);
        });
        $('#modal-tambah').modal('show');
    });

  </script>
