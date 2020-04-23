<table id="advanceDTables" class="table table-bordered table-striped" width="100%">
  <thead>
    <tr>
      <th style="display:none"></th>
      <th class="no-sort">Kegiatan</th>
      <th class="no-sort">Waktu Pelaksanaan</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th class="no-sort text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($loaddata as $loadkey) {
    ?>
    <tr class="record">
      <td style="display:none" id="kode"><?php echo $loadkey['id_aktifitas']; ?></td>
      <td><?php echo $loadkey['kegiatan']; ?></td>
      <td><?php echo $loadkey['darijam']." - ".$loadkey['sampaijam']; ?></td>
      <td><?php echo date("j F Y", strtotime($loadkey['tanggal'])); ?></td>
      <td>
        <?php
          $status = "Belum Dievaluasi";
          if($loadkey['status'] == 1){
            $status = "Selesai";
          }else if($loadkey['status'] == 2){
            $status = "Tidak Selesai";
          }
          echo $status;
        ?>
      </td>
      <td class="text-center">
        <button class="btnedit btn btn-default btn-xs" title="Ubah rencana"><i class="fa fa-pencil"></i></button>
        <button class="btnhapus btn btn-default btn-xs" title="Hapus rencana"><i class="fa fa-trash"></i></button>
      </td>
    </tr>
    <?php } ?>
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
$(function () {
  $('.btnhapus').on('click', function(){
    var record = $(this).parents('.record');
    $("#hapusform").attr("action", "<?php echo base_url()."c.php/admin/hapusrencana/" ?>"+record.find('#kode').html());
    $('#modal-danger').modal('show');
  });

  $('.btnedit').on('click', function(){
    var record = $(this).parents('.record');
    $.getJSON('<?php echo base_url()."c.php/admin/tampilrencana/" ?>'+record.find('#kode').html(), function(data) {
      $('#e_kegiatan').val(data.kegiatan);
      $('#e_dari').val(data.darijam);
      $('#e_sampai').val(data.sampaijam);
      $('#e_keterangan').val(data.keterangan);
      $('#e_status').val(data.status).trigger('change');
    });
    $("#editform").attr("action", "<?php echo base_url()."c.php/admin/ubahrencana/" ?>"+record.find('#kode').html());
    $('#modal-ubah').modal('show');
  });
});
</script>
