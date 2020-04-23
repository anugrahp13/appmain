<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Sesi Kuliah
      <small>Rekam sesi perkuliahan dosen</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-calendar"></i> Sesi Kuliah</a></li>
      <li class="active">Daftar Dosen</li>
    </ol>
  </section>
  <!-- Finish Content Header
       Content Header -->
  <section class="content-header">
    <button class="btncheck btn btn-default"><i class="fa fa-search"></i> Check Sesi</button>
  </section>
  <!-- Finish Content Header -->
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
      <form action="<?php echo base_url();?>d.php/sesikuliah/hapussesi" method="post" id="myform">
        <!-- Box Body -->
        <div class="box-body">
          <!-- Table Bagian Atas -->
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th width="10">No</th>
                <th>Nama Dosen</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loaddosen as $key) {
                  $no++;
              ?>
                <tr class="record">
                  <td><?php echo $no; ?></td>
                  <td>
                    <?php
                      $gelar = "";
                      if($key['gelar'] != ""){
                        $gelar = ", ".$key['gelar'];
                      }
                      echo $key['nama_lengkap'].$gelar;
                    ?>
                  </td>
                  <td class="text-center">
                    <a href="<?php echo base_url(); ?>d.php/sesikuliah/t/<?php echo $key['id_dosen']; ?>" class="btn btn-default btn-xs">Lihat Tahun</a>
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

  <!-- Modal Check -->
  <div class="modal fade" id="modal-check">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Check Sesi</h4>
        </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Dosen</label>
                  <select name="nama_dosen" class="form-control select2" style="width:100%;" id="namacheck">
                    <?php foreach ($loaddosen as $load) { ?>
                      <?php
                        $gelar = "";
                        if($load['gelar'] != ""){
                          $gelar = ", ".$load['gelar'];
                        }?>
                    <option value="<?php echo $load['id_dosen']; ?>">
                      <?php echo $load['nama_lengkap'].$gelar; ?> 
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <select name="thn_ajaran" class="form-control select2" style="width:100%;" id="tahuncheck">
                    <?php foreach ($loadmatkul as $loadkey) { ?>
                      <option value="<?php echo $loadkey['thn_ajaran']; ?>">
                        <?php echo $loadkey['thn_ajaran']; ?> 
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Dari</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker" name="dari" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Sampai</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker2" name="sampai" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group" id="appear">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-success" id="mulaicheck">Mulai Check</button>
          </div>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Check -->
  
  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript">
    $(".btncheck").click(function(event) {
        $('#modal-check').modal("show");	// menampilkan dialog modal nya
    });

    $("#mulaicheck").click(function(event) {
      var iddosen = $("#namacheck").val();
      var tahun = $("#tahuncheck").val();
      var dari = $("#datepicker").val();
      var sampai = $("#datepicker2").val();

      $.ajax({
        url: '<?php echo base_url(); ?>d.php/sesikuliah/checksesi',	// set url -> ini file yang menyimpan query tampil detail data siswa
        method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
        data: {id:iddosen,tahun:tahun,dari:dari,sampai:sampai},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
        success:function(data){		// kode dibawah ini jalan kalau sukses
          $('#appear').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
        }
      });
    });
  </script>
