<table id="advanceDTables" class="table table-bordered table-striped" width="100%">
  <thead>
    <tr>
      <?php if($activedi == "datapkt"){?>
        <td style="display:none"></td>
        <th style="width:20px" class="no-sort">
          <input type="checkbox" onclick="for(c in document.getElementsByName('check[]')) document.getElementsByName('check[]').item(c).checked =  this.checked">
        </th>
      <?php } ?>
      <th>NIM</th>
      <th>Nama Peserta</th>
      <th>Bidang</th>
      <th>Tahun Ajaran</th>
      <th>Periode</th>
      <th class="no-sort text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
    foreach ($loadpeserta as $keypeserta) {
      $no++;?>
    <tr <?php if($activedi == "datapkt"){echo "class='record'";} ?>>
      <?php if($activedi == "datapkt"){?>
        <td style="display:none" id="kode"><?php echo $keypeserta['id_profil']; ?></td>
        <td><input type="checkbox" name="check[]" value="<?php echo $keypeserta['id_profil']; ?>"></td>
      <?php } ?>
      <td><?php if(!empty($keypeserta['nim'])){echo $keypeserta['nim'];}else{echo "-";} ?></td>
      <td><?php if(!empty($keypeserta['nama_lengkap'])){echo $keypeserta['nama_lengkap'];}else{echo "-";} ?></td>
      <td>
        <?php
          $getbidang = $this->global_model->find_by('m_bidang', array('id_bidang'=>$keypeserta['id_bidang']));
          if(!empty($getbidang)){
            echo $getbidang['nama_bidang'];
          }
        ?>
      </td>
      <td><?php if(!empty($keypeserta['tahun_ajaran'])){echo $keypeserta['tahun_ajaran'];}else{echo "-";} ?></td>
      <td>
        <?php
        $periodedari = "-";
        $periodesampai = "-";
        if(!empty($keypeserta['periode_dari'])){$periodedari =  $keypeserta['periode_dari'];}
        if(!empty($keypeserta['periode_sampai'])){$periodesampai =  $keypeserta['periode_sampai'];}
        echo $periodedari." - ".$periodesampai;
        ?>
      </td>
      <td class="text-center">
        <?php
        $url = "#";
        if(!empty($keypeserta['id_profil'])){
          $url = base_url()."c.php/admin/".$activedi."/"."peserta/".$keypeserta['id_profil'];
        }else{$url = "#";}
        ?>

        <?php if($activedi == "datapkt"){?>
          <a href="<?php echo base_url()."c.php/admin/datapkt/ubah/".$keypeserta['id_profil']; ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
        <?php }else{?>
          <a href="<?php echo $url; ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
        <?php } ?>
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
