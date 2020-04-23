<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Lihat Slip Honor Lalu
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-bank"></i> Lihat Slip Honor Lalu</a></li>
      <li class="active">Daftar Slip Honor Lalu</li>
    </ol>
  </section>
  <!-- Finish Content Header
       Content Header -->
  <section class="content-header">
    <div class="row">
      <div class="col-md-4">
        <select id="namadosen" class="form-control">
          <option value="">Semua</option>
          <?php
          foreach ($loaddosen as $key) {
            $gelar = "";
            if($key['gelar']!=""){
              $gelar = ", ".$key['gelar'];
            }
          ?>
          <option value="<?php echo $key['id_dosen']; ?>"><?php echo $key['nama_lengkap'].$gelar; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-2">
        <select id="thn_ajaran" class="form-control">
          <option value="">Semua</option>
          <?php
          foreach ($thnajaran as $key) {
          ?>
          <option value="<?php echo $key['thn_ajaran']; ?>"><?php echo $key['thn_ajaran']; ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
  </section>
  <!-- Finish Content Header
       Main Content -->
  <section class="content">
    <!-- Default Box -->
    <div class="box">
      <!-- Box Body -->
      <div class="box-body">
        <!-- Table Bagian Atas -->
        <table id="example1" class="table table-bordered">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Nama Dosen</th>
              <th>Periode</th>
              <th width="100">Tahun Ajaran</th>
              <th width="100">Jumlah Sesi</th>
              <th>Honor</th>
              <th width="50">Transport</th>
              <th>Kekurangan</th>
              <th>Pph 21</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody id="datahonorlalu">
          </tbody>
        </table>
        <!-- Finish Table Bagian Atas -->
      </div>
      <!-- Finish Box Body -->
    </div>
    <!-- Finish Default Bbox -->
  </section>
  <!-- Finish Main Content -->

  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript">
    $("#namadosen").change(function() {
        var id = $(this).val();
        var thn = $('#thn_ajaran').val();

        $.ajax({
  				url: '<?php echo base_url(); ?>d.php/sliphonorlalu/loaddata',	// set url -> ini file yang menyimpan query tampil detail data siswa
  				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
  				data: {id:id,thn:thn},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
  				success:function(data){		// kode dibawah ini jalan kalau sukses
  					$('#datahonorlalu').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
  				}
  			});
    });
  </script>