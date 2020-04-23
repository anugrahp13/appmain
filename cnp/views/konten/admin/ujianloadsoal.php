<table id="example3" class="table table-bordered table-striped" width="100%">
  <thead>
    <tr>
      <th style="display:none"></th>
      <th class="text-center" width="10">No.</th>
      <th>Bab Soal</th>
      <th>Teks Soal</th>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
    foreach ($loaddata as $loadkey) {
      $no++;
    ?>
    <tr class="record">
      <td style="display:none" id="kode"><?php echo $loadkey['id_kontenujian']; ?></td>
      <td class="text-center"><?php echo $no; ?></td>
      <td width="150"><?php echo str_replace('-',' ',$loadkey['bab_soal']);?></td>
      <td><?php echo $loadkey['soal']; ?></td>
      <td width="50" class="text-center">
        <button class="btnedit btn btn-default btn-xs" title="Ubah Soal"><i class="fa fa-pencil"></i></button>
        <button class="btnhapus btn btn-default btn-xs" title="Hapus Soal"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<script>
$(function () {
  $('#example3').DataTable({
    'scrollX': true,
    'paging'      : true,
    'lengthChange': true,
    'searching'   : true,
    'ordering'    : false,
    'info'        : true,
    'autoWidth'   : true,
    'responsive' : true
  });
});

</script>
