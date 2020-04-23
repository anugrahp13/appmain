<table id="advanceDTables" class="table table-bordered table-striped" width="100%">
  <thead>
    <tr>
      <th>Nama Peserta</th>
      <th>Nama Ujian</th>
      <th>Tanggal Ujian</th>
      <th>Bidang</th>
      <th>Periode</th>
      <th class="no-sort text-center">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 0;
    foreach ($loaddata as $key1):
      $no++;
      $key = $this->global_model->find_by('partisipasi_ujian',array('id_headersoal'=>$key1['id_headersoal']));
      if(!empty($key)){
    ?>
    <tr>
      <td>
        <?php
        $pkt = $this->global_model->find_by('pkt_profil', array('id_profil'=>$key['id_profil']));
        if(!empty($pkt)){
          echo $pkt['nama_lengkap'];
        }else{
          echo "-";
        }
        ?>
      </td>
      <td>
        <?php
        $header = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$key['id_headersoal']));
        if(!empty($header)){
          echo $header['nama_ujian'];
        }else{
          echo "-";
        }
        ?>
      </td>
      <td>
        <?php
        $header = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$key['id_headersoal']));
        if(!empty($header)){
          echo $header['tgl_ujian'];
        }else{
          echo "-";
        }
        ?>
      </td>
      <td>
        <?php
        $header = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$key['id_headersoal']));
        $bidang = "-";
        if(!empty($header)){
          $getbidang = $this->global_model->find_by('m_bidang', array('id_bidang'=>$header['id_bidang']));
          if(!empty($getbidang)){
            $bidang = $getbidang['nama_bidang'];
          }
        }else{
          $bidang = "-";
        }
        echo $bidang;
        ?>
      </td>
      <td>
        <?php
        $header = $this->global_model->find_by('header_ujian', array('id_headersoal'=>$key['id_headersoal']));
        if(!empty($header)){
          echo $header['periode'];
        }else{
          echo "-";
        }
        ?>
      </td>
      <td class="text-center">
        <a href="<?php echo base_url(); ?>c.php/admin/reviewjawaban/<?php echo $key['id_partisipasi']; ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
      </td>
    </tr>
    <?php
      }
      endforeach;
    ?>
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
