<table id="example3" class="table table-bordered table-striped" width="100%">
  <thead>
    <tr>
      <th style="display:none"></th>
      <th class="text-center" width="10">No.</th>
      <th>Nama Bidang</th>
      <th>Nama Kategori</th>
      <th>Nama Indikator</th>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
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
