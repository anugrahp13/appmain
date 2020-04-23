<form method="post" id="myform" action="<?php echo base_url(); ?>c.php/admin/hapuspkt">
<table id="example3" class="table table-bordered table-striped" width="100%">
  <thead>
    <tr>
      <th style="display:none"></th>
      <th style="width:20px">
        <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
      </th>
      <th class="text-center" style="width:20px">No.</th>
      <th>Nama</th>
      <th class="text-center">Semester</th>
      <th>Konsentrasi</th>
      <th>Bidang</th>
      <th class="text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $no = 0;
      foreach ($loaddata as $load) {
        $no++;
    ?>
    <tr class="record">
      <td style="display:none" id="kode"><?php echo $load['id_profil']; ?></td>
      <td><input type="checkbox" name="check[]" value="<?php echo $load['id_profil']; ?>"></td>
      <td class="text-center"><?php echo $no;?></td>
      <td><?php echo $load['nama_lengkap']; ?></td>
      <td class="text-center"><?php echo $load['semester']; ?></td>
      <td>
        <?php
        $a = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$load['id_konsentrasi']));
        echo $a['nama_konsentrasi'];
        ?>
      </td>
      <td>
        <?php
        $b = $this->global_model->find_by('m_bidang', array('id_bidang'=>$load['id_bidang']));
        echo $b['nama_bidang'];
        ?>
      </td>
      <td class="text-center">
        <a href="<?php echo base_url(); ?>c.php/admin/datapkt/ubah/<?php echo $load['id_profil']; ?>" class="btn btn-default btn-xs" title="Ubah Data"><i class="fa fa-pencil"></i></a>
      </td>
    </tr>
    <?php }?>
  </tbody>
</table>
</form>
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
