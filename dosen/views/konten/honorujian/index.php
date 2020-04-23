<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Honor Ujian
      <small>Slip Honor Ujian</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-sheqel"></i> Honor Ujian</a></li>
      <li class="active">Data Honor Ujian</li>
    </ol>
  </section>
  <!-- Finish Content Header
       Content Header -->
  <section class="content-header">
    <?php if($this->session->userdata('id_divisi') == "1"){ ?>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus-square"></i> Tambah</button>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i> Hapus</button>
    <?php } ?>
    <button class="btn btn-default" data-toggle="modal" data-target="#modal-cetak"><i class="fa fa-print"></i> Cetak</button>
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
      <form method="post" action="<?php echo base_url();?>d.php/honorujian/hapusujian" id="myform">
        <div class="box-body">
          <table id="example1" class="table table-bordered">
            <thead>
              <tr>
                <th style="display:none;"></th>
                <th style="width:20px;">
                  <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
                </th>
                <th width="10">No</th>
                <th>Nama Dosen</th>
                <th class="text-center">Tahun Ajaran</th>
                <th>Tanggal</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $no = 0;
                foreach ($loaddata as $key) {
                  $no++;
                  $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=> $key['id_dosen']));
                  if($a != null){
              ?>
              <tr class="record">
                <td id="kode" style="display:none;"><?php echo $key['id_hudosen']; ?></td>
                <td><input type="checkbox" name="check[]" value="<?php echo $key['id_hudosen']; ?>"></td>
                <td><?php echo $no;?></td>
                <td>
                  <?php
                    $a = $this->global_model->find_by('dosen_profil',array('id_dosen'=>$key['id_dosen']));
                    $gelar = "";
                    if($a['gelar']!=""){
                      $gelar = ", ".$a['gelar'];
                    }
                    echo $a['nama_lengkap'].$gelar;
                  ?>
                </td>
                <td class="text-center"><?php echo $key['thn_ajaran']; ?></td>
                <td><?php echo $key['tgl'];?></td>
                <td class="text-center">
                  <button type="button" class="viewdata btn btn-default btn-xs" id="<?php echo $key['id_hudosen']; ?>"><i class="fa fa-eye"></i></button>
                  <?php if($this->session->userdata('id_divisi') == "1"){ ?>
                  <a class="btn btn-default btn-xs" href="<?php echo base_url();?>d.php/honorujian/viewdata/<?php echo $key['id_hudosen']; ?>"><i class="fa fa-pencil"></i></a>
                <?php }?>
                </td>
              </tr>

            <?php
                }
              }
            ?>
            </tbody>
          </table>
        </div>
        <!-- Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->

  <!-- Modal Default -->
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
              <label>Nama Dosen</label>
              <select class="form-control select2" name="id_dosen" style="width:100%;">
                <?php foreach ($loaddosen as $key) {?>
                  <?php
                    $gelar = "";
                    if($key['gelar'] != ""){
                      $gelar = ", ".$key['gelar'];
                    }?>
                <option value="<?php echo $key['id_dosen']; ?>"><?php echo $key['nama_lengkap'].$gelar; ?></option>
              <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label>Tahun Ajaran</label>
              <select class="form-control select2" name="thn_ajaran" style="width:100%;">
                <?php foreach ($loadthnajaran as $keycuy) {?>
                <option value="<?php echo $keycuy['thn_ajaran']; ?>"><?php echo $keycuy['thn_ajaran']; ?></option>
              <?php }?>
              </select>
            </div>
            <div class="form-group">
              <label>Tanggal Input</label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="tgl" required>
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
  <!-- Finish Modal Default -->

  <!-- Modal View -->
  <div class="modal fade" id="modal-view">
    <!-- Modal Dialog -->
    <div class="modal-dialog modal-lg">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Honor Ujian</h4>
        </div>
          <div class="modal-body" id="data_honor"></div>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal View -->

  <!-- Modal Cetak -->
  <div class="modal fade" id="modal-cetak">
    <!-- Modal Dialog -->
    <div class="modal-dialog">
      <!-- Modal Content -->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Cetak Honor Ujian</h4>
        </div>
        <form method="post" action="<?php echo base_url(); ?>d.php/honorujian/cetak" role="form" target="_blank">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Data Dosen</label>
                  <select class="form-control select2" name="id_dosen" style="width:100%;">
                    <option value="all">Semua</option>
                    <?php foreach ($loaddosen as $key) {?>
                      <?php
                        $gelar = "";
                        if($key['gelar'] != ""){
                          $gelar = ", ".$key['gelar'];
                        }?>
                    <option value="<?php echo $key['id_dosen'] ?>"><?php echo $key['nama_lengkap'].$gelar;?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tahun Ajaran</label>
                  <select name="thn_ajaran" class="form-control select2" style="width:100%;">
                    <option value="all">Semua</option>
                    <?php foreach ($loadthnajaran as $key) {?>
                      <option value="<?php echo $key['thn_ajaran'] ?>"><?php echo $key['thn_ajaran'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Cetak Untuk Bulan : </label>
                  <div class="row">
                    <div class="col-md-6">
                      <select name="bulan" class="form-control">
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <input type="number" class="form-control" placeholder="Tahun" name="tahun" onkeypress="return isNumberKey(event)" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
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
            <input type="submit" class="btn btn-success" name="simpan" value="Cetak">
          </div>
        </form>
      </div>
      <!-- Finish Modal Content -->
    </div>
    <!-- Finish Modal Dialog -->
  </div>
  <!-- Finish Modal Cetak -->

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

  <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript">
    $(".viewdata").click(function(event) {
        var id = $(this).attr("id");

        $.ajax({
  				url: '<?php echo base_url(); ?>d.php/honorujian/view',	// set url -> ini file yang menyimpan query tampil detail data siswa
  				method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
  				data: {id:id},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
  				success:function(data){		// kode dibawah ini jalan kalau sukses
  					$('#data_honor').html(data);	// mengisi konten dari -> <div class="modal-body" id="data_siswa">
  					$('#modal-view').modal("show");	// menampilkan dialog modal nya
            $("#link").attr("href", "<?php echo base_url(); ?>d.php/honorujian/cetakhonor/"+id);
            $("#link").attr("target",'_blank');
  				}
  			});
    });

  </script>
