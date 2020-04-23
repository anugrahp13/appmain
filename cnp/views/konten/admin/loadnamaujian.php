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
<script>
$('#advanceDTables').DataTable({
  'scrollX': true,
  'paging'      : true,
  'lengthChange': true,
  'searching'   : true,
  'ordering'    : true,
  'info'        : true,
  'autoWidth'   : true,
  'responsive' : true,
  'columnDefs' : [
        { "orderable": false, "targets": 'no-sort' }
    ]
});
</script>
