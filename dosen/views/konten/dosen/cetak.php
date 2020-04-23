<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <style>
      table{
        border-collapse: collapse;
      }
      td{
        font-size: 8pt;
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
        font-size: 10pt;
        font-weight: bold;
        margin:0;
        padding:0;
      }
      .teksputih{
        color:white;
      }
      .tbl{
        border:1px solid #d1d1d1;
        border-top: 0px;
      }
      .tbl td{
        padding:5pt;
      }
      .txt-td {
        font-size: 9pt;
        font-weight: bold;
      }
      .txt-mrg {
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <?php
      foreach ($load as $view) {
        if(!empty($view)){
          $c = $view['pend_akhir'];

          //Pendidikan
          $cdata = array(
            'sd' => 'Sekolah Dasar',
            'smp' => 'Sekolah Menengah Pertama',
            'sma' => 'Sekolah Menengah Atas',
            'd1' => 'Diploma 1',
            'd2' => 'Diploma 2',
            'd3' => 'Diploma 3',
            's1' => 'Sarjana',
            's2' => 'Magister',
            's3' => 'Doktoral'
          );

          //Agama
          $adata = array(
            'is' => 'Islam',
            'pr' => 'Protestan',
            'ka' => 'Katolik',
            'hi' => 'Hindu',
            'bu' => 'Buddha',
            'kh' => 'Khonghucu',
            'la' => 'Lainnya'
          );

          //Status
          $bdata = array(
            'la' => 'Lajang',
            'me' => 'Menikah',
            'du' => 'Duda',
            'ja' => 'Janda'
          );

          //Bank
          $bank = array(
            'bca' => 'BCA',
            'bcs' => 'BCA SYARIAH',
            'bni' => 'BNI',
            'bbs' => 'BNI SYARIAH',
            'bri' => 'BRI',
            'brs' => 'BRI SYARIAH',
            'bmd' => 'MANDIRI',
            'bsm' => 'MANDIRI SYARIAH',
            'danamon' => 'DANAMON',
            'cimbniaga' => 'CIMB NIAGA'
          );
          //Untuk ngitung honor dosen
          $plain = $this->global_model->find_by('p_lain', array('id'=>1));
          
          //Pendidikan
          $np = 0;
          $checkdidik = $this->global_model->find_by('m_pendidikan', array('id_pendidikan'=>$view['pend_akhir']));
          if(!empty($checkdidik)){
            $np = $checkdidik['nominal'];
          }

          //Praktisi
          $npr = 0;
          $checkpraktisi = $this->global_model->find_by('m_praktisi', array('id_praktisi'=>$view['id_praktisi']));
          if(!empty($checkpraktisi)){
            $npr = $checkpraktisi['nominal'];
          }

          //Japung
          $nj = 0;
          $checkjapung = $this->global_model->find_by('m_japung', array('id_japung'=>$view['id_japung']));
          if(!empty($checkjapung)){
            $nj = $checkjapung['nominal'];
          }

          //NIDN
          $nidn = 0;
          if(!empty($view['nidn'])){
            $nidn = $plain['nidn'];
          }

          //Masa Kerja
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
          $matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$view['id_dosen'], 'thn_ajaran'=>$inithnajaran));
          if(!empty($matakul)){
            $checknb = $this->global_model->query("select sum(nominal_inggris) as jumlah from sesi_data where id_sesi='".$matakul['id_sesi']."'");
            if(!empty($checknb)){
              $nb = $checknb[0]['jumlah'];
            }
          }
          //output honor
          $honor = intval($np+$npr+$nj+$nidn+$nm+$nb);
          //dsn_favorit
          if($view['dsn_favorit']=="1"){
            $honor = $plain['dsn_favorit'];
          }

          $imgname = "default.png";
          if(!empty($view['img'])){
            $imgname = $view['img'];
          }
    ?>
    <p class="lead">POLITEKNIK LP3I JAKARTA</p>
    <p class="lead">KAMPUS PONDOK GEDE</p>
    <br><br>
    <p align="center" class="lead2">DATA PRIBADI DOSEN</p><br><br>
    <!-- Table Bagian Atas -->
    <table width="100%" bgcolor="#00a65a">
      <tr>
        <td rowspan="4" width="45" height="35" align="center">
          <img src="assets/image/<?php echo $imgname; ?>" width="48" height="60"/>
        </td>
        <td></td>
      </tr>
      <tr>
        <td class="teksputih" style="font-size:13pt;">
          <?php
            $gelar = "";
            $namaload = $view['nama_lengkap'];
            if(!empty($view['gelar'])){
              $gelar = ", ".$view['gelar'];
            }

            if(empty($namaload)){echo "-";}else{echo $namaload.$gelar;}
          ?>
        </td>
      </tr>
      <tr>
        <td class="teksputih" style="font-size:9pt;">Honor Dosen Rp. <?php echo $honor; ?></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table>
    <!-- Finish Table Bagian Atas
         Table Bagian Tengah 1 -->
    <table width="100%" class="tbl">
      <tr>
        <td colspan="2" class="txt-td"><u>DATA DIRI</u></td>
        <td colspan="2" class="txt-td txt-mrg"><u>KARIR</u></td>
        <td colspan="2" class="txt-td"><u>NPWP & BANK</u></td>
      </tr>
      <tr>
        <td><b>Jenis Kelamin</b></td>
        <td>
          <?php
          $a = $view['jenis_kelamin'];
          if($a == "l"){
            echo "Laki - Laki";
          }else if($a == "p"){
            echo "Perempuan";
          }else{ echo "-";}
          ?>
        </td>
        <td><b>NIDN</b></td>
        <td>
          <?php if(empty($view['nidn'])){echo "-";}else{echo $view['nidn'];} ?>
        </td>
        <td><b>NPWP</b></td>
        <td><?php if(empty($view['npwp'])){echo "-";}else{echo $view['npwp'];}?></td>
      </tr>
      <tr>
        <td><b>Tempat Lahir</b></td>
        <td><?php if(empty($view['tempat_lahir'])){echo "-";}else{echo $view['tempat_lahir'];}?></td>
        <td><b>Dosen Favorit</b></td>
        <td>
          <?php
            $pr = $view['dsn_favorit'];
            if($pr == 0){
              echo "Bukan";
            }else{
              echo "Ya";
            }
          ?>
        </td>
        <td><b>Bank</b></td>
        <td><?php if(empty($bank[$view['bank']])){echo "-";}else{echo $bank[$view['bank']];}?></td>
      </tr>
      <tr>
        <td><b>Tanggal Lahir</b></td>
        <td><?php if(empty($view['tgl_lahir'])){echo "-";}else{echo $view['tgl_lahir'];}?></td>
        <td><b>Praktisi</b></td>
        <td>
          <?php
            $pr = $view['id_praktisi'];
            $caripr = $this->global_model->find_by('m_praktisi', array('id_praktisi'=>$pr));
            if($caripr == null){
              echo "-";
            }else{
              echo $caripr['nama_praktisi'];
            }
          ?>
        </td>
        <td><b>No Rekening</b></td>
        <td><?php if(empty($view['norekening'])){echo "-";}else{echo $view['norekening'];}?></td>
      </tr>
      <tr>
        <td><b>Agama</b></td>
        <td>
          <?php
            $a = $view['agama'];
            if(empty($adata[$a])){echo "-";}else{echo $adata[$a];}
          ?>
        </td>
        <td><b>Japung</b></td>
        <td>
          <?php
            $jp = $view['id_japung'];
            $carijp = $this->global_model->find_by('m_japung', array('id_japung'=>$jp));
            if($carijp == null){
              echo "-";
            }else{
              echo $carijp['nama_japung'];
            }
          ?>
        </td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td><b>Status Perkawinan</b></td>
        <td>
          <?php
            $b = $view['status_nikah'];
            if(empty($bdata[$b])){echo "-";}else{echo $bdata[$b];}
          ?>
        </td>
        <td><b>Mulai Kerja</b></td>
        <td><?php if($view['tgl_kerja']==null){echo "-";}else{echo $view['tgl_kerja'];}?></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2" class="txt-td margin"><u>KONTAK</u></td>
        <td colspan="2" class="txt-td"><u>PENDIDIKAN</u></td>
        <td colspan="2" class="txt-td"><u>ALAMAT</u></td>
      </tr>
      <tr>
        <td><b>No HP</b></td>
        <td><?php if(empty($view['no_hp'])){echo "-";}else{echo $view['no_hp'];}?></td>
        <td><b>Pendidikan Terakhir</b></td>
        <td><?php if(empty($cdata[$c])){echo "-";}else{echo $cdata[$c];} ?></td>
        <td colspan="2"><b>Alamat Rumah</b></td>
      </tr>
      <tr>
        <td><b>No. WA</b></td>
        <td><?php if(empty($view['whatsapp'])){echo "-";}else{echo $view['whatsapp'];}?></td>
        <td><b>Nama Institusi</b></td>
        <td><?php if(empty($view['nama_institusi'])){echo "-";}else{echo $view['nama_institusi'];}?></td>
        <td colspan="2" rowspan="4" style="vertical-align:top;">
          <?php if(empty($view['alamat_rumah'])){echo "-";}else{echo $view['alamat_rumah'];}?>
        </td>
      </tr>
      <tr>
        <td><b>Email</b></td>
        <td><?php if(empty($view['email'])){echo "-";}else{echo $view['email'];}?></td>
        <td><b>Jurusan</b></td>
        <td><?php if(empty($view['jurusan'])){echo "-";}else{echo $view['jurusan'];}?></td>
      </tr>
      <tr>
        <td><b>Nama Kontak Darurat</b></td>
        <td><?php if(empty($view['nama_kdarurat'])){echo "-";}else{echo $view['nama_kdarurat'];}?></td>
        <td><b>Gelar</b></td>
        <td><?php if(empty($view['gelar'])){echo "-";}else{echo $view['gelar'];}?></td>
      </tr>
      <tr>
        <td><b>Telepon Darurat</b></td>
        <td><?php if(empty($view['tlp_darurat'])){echo "-";}else{echo $view['tlp_darurat'];}?></td>
        <td></td>
        <td></td>
      </tr>
    </table>
    <?php
        }
      }
    ?>
  </body>
</html>
