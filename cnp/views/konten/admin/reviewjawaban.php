<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lihat Jawaban Ujian
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Lihat Jawaban Ujian</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-default">
    <div class="box-header with-border">
      <div class="row">
        <div class="col-md-5">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-edit"></i></span>
            <select class="form-control select2" id="namaujian" style="width:100%">
              <option disabled selected>Pilih Nama Ujian</option>
              <option value="semua">Semua</option>
              <?php foreach ($loadnamaujian as $loadnama) {?>
                <option value="<?php echo $loadnama['id_headersoal']; ?>"><?php echo $loadnama['tgl_ujian']." - ".$loadnama['nama_ujian']; ?></option>
              <?php }?>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="box-body">
      <form method="post" id="myform" action="<?php echo base_url(); ?>c.php/admin/hapusujian">
      <div id="dataload">
        <table id="advanceDTables" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <td style="display:none"></td>
              <th class="no-sort text-center" width="48">Foto</th>
              <th width="100">NIM</th>
              <th>Nama Peserta</th>
              <th>Tanggal</th>
              <th>Nama Ujian</th>
              <th class="no-sort text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($loadpartisipasi as $keyoke) {
              $headerujian = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$keyoke['id_headersoal']));
              $keypeserta = $this->global_model->find_by('pkt_profil', array('id_profil'=>$keyoke['id_profil']));
              $imgdefault = "default.png";
              if(!empty($keypeserta['img'])){ $imgdefault = $keypeserta['img'];}
            ?>
            <tr class="record" style="height:50px">
              <td style="display:none" id="kode"><?php echo $keypeserta['id_profil']; ?></td>
              <td class="text-center"><img src="<?php echo base_url(); ?>assets/image/<?php echo $imgdefault; ?>" width="42" height="42" /></td>
              <td style="vertical-align:middle;"><?php if(!empty($keypeserta['nim'])){echo $keypeserta['nim'];}else{echo "-";} ?></td>
              <td style="vertical-align:middle;"><?php if(!empty($keypeserta['nama_lengkap'])){echo $keypeserta['nama_lengkap'];}else{echo "-";} ?></td>
              <td style="vertical-align:middle;">
                <?php if(!empty($headerujian['tgl_ujian'])){echo date("j F Y", strtotime($headerujian['tgl_ujian']));}else{echo "-";} ?>
              </td>
              <td style="vertical-align:middle;">
                <?php if(!empty($headerujian['nama_ujian'])){echo $headerujian['nama_ujian'];}else{echo "-";} ?>
              </td>
              <td class="text-center" style="vertical-align:middle;">
                <a href="<?php echo base_url(); ?>c.php/admin/reviewjawaban/<?php echo $keyoke['id_partisipasi']; ?>" class="btn btn-default btn-xs" title="Kelola Peserta"><i class="fa fa-eye"></i></a>
              </td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
$(function () {
  $('#namaujian').on('select2:select', function () {
    var idhead = $("#namaujian").val();

    $.ajax({
      url: '<?php echo base_url(); ?>c.php/admin/ajaxnamaujian',	// set url -> ini file yang menyimpan query tampil detail data siswa
      method: 'post',		// method -> metodenya pakai post. Tahu kan post? gak tahu? browsing aja :)
      data: {idhead:idhead},		// nah ini datanya -> {id:id} = berarti menyimpan data post id yang nilainya dari = var id = $(this).attr("id");
      success:function(data){		// kode dibawah ini jalan kalau sukses
        $('#dataload').html(data);	// mengisi konten
      }
    });
  });

});
</script>
