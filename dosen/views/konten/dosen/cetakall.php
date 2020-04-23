<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      table{
        border-collapse: collapse;
        width:100%;
      }
      table, th, td {
          border: 1px solid black;
      }
      th{
        background-color: #00a65a;
        color:white;
      }
      th,td{
        padding:8px;
        font-size:8pt;
      }
      *{
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      }
      .lead{
        font-size: 11pt;
        font-weight: bold;
        margin:0;
        padding:0;
      }
      .lead2{
        font-size: 11pt;
        font-weight: bold;
        margin:0;
        padding:0;
      }
      .teksputih{
        color:white;
      }
    </style>
  </head>
  <body>
    <p class="lead">POLITEKNIK LP3I JAKARTA</p>
    <p class="lead">KAMPUS PONDOK GEDE</p>
    <p class="lead">TAHUN AJARAN <?php echo $inithnajaran; ?></p>
    <br><br>
    <p align="center" class="lead2">REKAP DATA DOSEN</p><br><br>
    <table width="100%">
      <tr>
        <th>Nama Dosen</th>
        <th>Mata Kuliah</th>
        <th>SKS</th>
        <th>SMT</th>
        <th>Aspek Pendidikan</th>
        <th>Praktisi</th>
        <th>Japung</th>
        <th>NIDN</th>
        <th>Masa Kerja</th>
        <th>B.Inggris</th>
        <th>Total Honor</th>
        <th colspan="2">NPWP</th>
      </tr>
      <?php
        foreach ($load as $view) {
          if(!empty($view)){
            //untuk ngitung honor dosen
            $plain = $this->global_model->find_by('p_lain', array('id'=>1));
            //pendidikan
            $np = 0;
            $checkdidik = $this->global_model->find_by('m_pendidikan', array('id_pendidikan'=>$view['pend_akhir']));
            if(!empty($checkdidik)){
              $np = $checkdidik['nominal'];
            }

            //praktisi
            $npr = 0;
            $checkpraktisi = $this->global_model->find_by('m_praktisi', array('id_praktisi'=>$view['id_praktisi']));
            if(!empty($checkpraktisi)){
              $npr = $checkpraktisi['nominal'];
            }

            //japung
            $nj = 0;
            $checkjapung = $this->global_model->find_by('m_japung', array('id_japung'=>$view['id_japung']));
            if(!empty($checkjapung)){
              $nj = $checkjapung['nominal'];
            }

            //nidn
            $nidn = 0;
            if(!empty($view['nidn'])){
              $nidn = $plain['nidn'];
            }

            //masakerja
            $birthDate = $view['tgl_kerja'];
            //explode the date to get month, day and year
            $birthDate = explode("/", $birthDate);
            //get age from date or birthdate
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
              ? ((date("Y") - $birthDate[2]) - 1)
              : (date("Y") - $birthDate[2]));

            $masakerja = 0;
            if($age > 0 ){
              $masakerja = $age;
            }

            $nm = 0;
            if($masakerja > 0 && $masakerja <= 3){
              $nm = $plain['0_3thn'];
            }else if($masakerja > 3 && $masakerja <= 5){
              $nm = $plain['3_5thn'];
            }else if($masakerja > 5 && $masakerja <= 10){
              $nm = $plain['5_10thn'];
            }else if($masakerja > 10 && $masakerja <= 15){
              $nm = $plain['10_15thn'];
            }else if($masakerja > 15){
              $nm = $plain['l15thn'];
            }

            //bahasa inggris
            $nb = 0;
            $matakulc = 0;
            $matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$view['id_dosen'], 'thn_ajaran'=>$inithnajaran));
            if(!empty($matakul)){
              $matakulsesi = $this->global_model->find_all_by('sesi_data', array('id_sesi'=>$matakul['id_sesi']));
              $checknb = $this->global_model->query("select sum(nominal_inggris) as jumlah from sesi_data where id_sesi='".$matakul['id_sesi']."'");

              if(!empty($checknb)){
                $nb = $checknb[0]['jumlah'];
              }

              if(!empty($matakulsesi)){
                $matakulc = 1;
              }
            }

            //output honor
            $honor = intval($np+$npr+$nj+$nidn+$nm+$nb);
            //dsn_favorit
            if($view['dsn_favorit']=="1"){
              $honor = $plain['dsn_favorit'];
            }


            $pphdsn = $plain['pph_nonpwp'];
            if(!empty($view['npwp'])){
              $pphdsn = $plain['pph_npwp'];
            }
      ?>

      <?php if($matakulc == 0){ ?>
      <tr>
        <td width="85">
          <?php
            $gelar = "";
            $namaload = $view['nama_lengkap'];
            if(!empty($view['gelar'])){
              $gelar = ", ".$view['gelar'];
            }

            if(empty($namaload)){echo "-";}else{echo $namaload.$gelar;}
          ?>
        </td>
        <td></td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="right"><?php echo number_format($np); ?></td>
        <td align="right"><?php echo number_format($npr); ?></td>
        <td align="right"><?php echo number_format($nj); ?></td>
        <td align="right"><?php echo number_format($nidn); ?></td>
        <td align="right"><?php echo number_format($nm); ?></td>
        <td align="right"><?php echo number_format($nb);?></td>
        <td align="right"><?php echo number_format($honor); ?></td>
        <td align="center" width="10"><?php echo $pphdsn."%"; ?></td>
        <td align="left" width="85"><?php if(!empty($view['npwp'])){echo $view['npwp'];}?></td>
      </tr>
    <?php }else{
      $no = 0;
      foreach ($matakulsesi as $loadkey) {
        $no++;
    ?>
      <tr>
        <?php if($no == 1){ ?>
        <td width="85" rowspan="<?php echo count($matakulsesi);?>">
          <?php
            $gelar = "";
            $namaload = $view['nama_lengkap'];
            if(!empty($view['gelar'])){
              $gelar = ", ".$view['gelar'];
            }

            if(empty($namaload)){echo "-";}else{echo $namaload.$gelar;}

            $matkulcoy = "-";
            $matakuliahcoy = $this->global_model->find_by('m_matakuliah', array('id_matkul'=>$loadkey['id_matkul']));
            if(!empty($matakuliahcoy)){
              $matkulcoy = $matakuliahcoy['nama_matkul'];
            }
          ?>
        </td>
        <?php } ?>
        <td><?php echo $matkulcoy; ?></td>
        <td align="center"><?php if(!empty($loadkey['sks'])){echo $loadkey['sks'];}else{ echo "-";} ?></td>
        <td align="center"><?php if(!empty($loadkey['semester'])){echo $loadkey['semester'];}else{ echo "-";} ?></td>
        <td align="right"><?php if($no == 1){ echo number_format($np); }?></td>
        <td align="right"><?php if($no == 1){ echo number_format($npr); }?></td>
        <td align="right"><?php if($no == 1){ echo number_format($nj); }?></td>
        <td align="right"><?php if($no == 1){ echo number_format($nidn); }?></td>
        <td align="right"><?php if($no == 1){ echo number_format($nm); }?></td>
        <td align="right"><?php if($no == 1){ echo number_format($nb);}?></td>
        <td align="right"><?php if($no == 1){ echo number_format($honor); }?></td>
        <td align="center" width="10"><?php if($no == 1){echo $pphdsn."%"; }?></td>
        <td align="left" width="85"><?php if($no == 1){if(!empty($view['npwp'])){echo $view['npwp'];}}?></td>
      </tr>
    <?php }} ?>
      <?php
          }
        }
      ?>
    </table>
  </body>
</html>
