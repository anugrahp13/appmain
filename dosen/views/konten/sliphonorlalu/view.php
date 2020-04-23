<?php
  $no = 0;
  foreach ($load as $key) {
    $no++;
    $dosencheck = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$key['id_dosen']));
    if($dosencheck != null){
?>
<tr>
  <td width="10"><?php echo $no; ?></td>
  <td><?php echo $dosencheck['nama_lengkap']; ?></td>
  <td><?php echo $key['periode']; ?></td>
  <td><?php echo $key['thn_ajaran']; ?></td>
  <td><?php echo $key['jmlhsesi']; ?></td>
  <td><?php echo number_format($key['honor']); ?></td>
  <td><?php echo $key['transport']; ?></td>
  <td><?php echo number_format($key['kekurangan']); ?></td>
  <td><?php echo $key['pph']."%"; ?></td>
  <td class="text-center">
    <a href="<?php echo base_url(); ?>d.php/sliphonorlalu/cetak/<?php echo $key['id_backup']; ?>" target="_blank" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-print"></span></button>
  </td>
</tr>
<?php
    }
  }
?>
