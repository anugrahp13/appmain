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
    <?php
    $no = 0;
    foreach ($loaddata as $loadkey) {
      $no++;
    ?>
    <tr class="record">
      <td style="display:none" id="kode"><?php echo $loadkey['id_indikator']; ?></td>
      <td class="text-center"><?php echo $no; ?></td>
      <td>
        <?php
          $a = $this->global_model->find_by('m_bidang', array('id_bidang'=>$loadkey['id_bidang']));
          echo $a['nama_bidang'];
        ?>
      </td>
      <td>
        <?php
          $a = $this->global_model->find_by('m_kategori', array('id_kategori'=>$loadkey['id_kategori']));
          echo $a['nama_kategori'];
        ?>
      </td>
      <td><?php echo $loadkey['nama_indikator']; ?></td>
      <td class="text-center">
        <button class="btnedit btn btn-default btn-xs" title="Ubah indikator"><i class="fa fa-pencil"></i></button>
        <button class="btnhapus btn btn-default btn-xs" title="Hapus indikator"><i class="fa fa-trash"></i></button>
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
