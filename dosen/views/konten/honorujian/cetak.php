<html>
  <head>
    <title>Slip Honor Ujian</title>
    <style>
    body{
      font-family: arial, sans-serif;
    }
    .table {
      border-collapse: collapse;
      width: 100%;
    }
    .table2{
      border-collapse: collapse;
      width: 100%;
    }
    .txtcenter{
      text-align: center;
    }
    .tdheaderlight{
      background-color: #27ae60;
      text-align: center;
      color: #fff;
      width: 100px;
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
    td{
      font-size: 8pt;
    }
    .header{
      text-align: center;
      border: 1px solid #000;
      height: 50px;
    }
    th{
      font-size: 8pt;
      padding:8px;
      border: 1px solid black;
    }
    .borderbawah{
      padding:8px;
    }
    </style>
  </head>
  <body>
    <?php
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
        'cimbniaga' => 'CIMB NIAGA',
        'siabuk' => 'SIAGA BUKOPIN'
      );
      foreach ($loaddosen as $key) {
    ?>
      <?php
        $databro = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$key['id_dosen']));
        if($databro != null){
          $plain = $this->global_model->find_by('p_lain', array('id'=>1));
          //Pendidikan
          $np = 0;
          $checkdidik = $this->global_model->find_by('m_pendidikan', array('id_pendidikan'=>$databro['pend_akhir']));
          if($checkdidik!=null){
            $np = $checkdidik['nominal'];
          }

          //Praktisi
          $npr = 0;
          $checkpraktisi = $this->global_model->find_by('m_praktisi', array('id_praktisi'=>$databro['id_praktisi']));
          if($checkpraktisi!=null){
            $npr = $checkpraktisi['nominal'];
          }

          //Japung
          $nj = 0;
          $checkjapung = $this->global_model->find_by('m_japung', array('id_japung'=>$databro['id_japung']));
          if($checkjapung!=null){
            $nj = $checkjapung['nominal'];
          }

          //NIDN
          $nidn = 0;
          if($databro['nidn']!=""&&$databro['nidn']!="0"){
            $nidn = $plain['nidn'];
          }

          //Masa Kerja
          $birthDate = $databro['tgl_kerja'];
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

          //Bahasa Inggris
      		$nb = 0;
      		$matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$key['id_dosen'], 'thn_ajaran'=>$key['thn_ajaran']));
      		if(!empty($matakul)){
      			$checknb = $this->global_model->query("select sum(nominal_inggris) as jumlah from sesi_data where id_sesi='".$matakul['id_sesi']."'");
      			if(!empty($checknb)){
      				$nb = $checknb[0]['jumlah'];
      			}
      		}

          //Output Honor
          $honordsn = intval($np+$npr+$nj+$nidn+$nm+$nb);
          //Dosen Favorit
          if($databro['dsn_favorit']=="1"){
            $honordsn = $plain['dsn_favorit'];
          }
      ?>
      <p class="lead">POLITEKNIK LP3I JAKARTA</p>
      <p class="lead">KAMPUS PONDOK GEDE</p>
      <br>
      <p align="center" class="lead2">SLIP HONOR UJIAN</p><br><br>
      <!-- Table Bagian Atas -->
      <table width="100%">
        <tr>
          <td colspan="2"><b>NIDN : </b>
            <?php
              $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$key['id_dosen']));
              if($a['nidn'] == ""){echo "-";}else{echo $a['nidn'];};
            ?>
          </td>
        </tr>
        <tr>
          <td width="80%"><b>Rek : </b>
            <?php
              $nihbank = "";
              if($bank[$a['bank']]!="")
              {
                $nihbank = $bank[$a['bank']];
              }
              echo "[".$nihbank."] ".$a['norekening'];
            ?>
          </td>
          <td><b>Bulan : </b><?php echo $this->session->userdata('bulan')." ".$this->session->userdata('tahun'); ?></td>
        </tr>
        <tr>
          <td><b>Nama : </b>
            <?php
              $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$key['id_dosen']));
              $gelar = "";
              if($a['gelar']!=""){
                $gelar = ", ".$a['gelar'];
              }
              if($a['nama_lengkap'] == ""){echo "-";}else{echo $a['nama_lengkap'].$gelar;};
            ?>
          </td>
          <td><b>Tahun Ajaran : </b><?php if($key['thn_ajaran'] == ""){echo "-";}else{echo $key['thn_ajaran'];}; ?></td>
        </tr>
      </table>
      <!-- Finish Table Bagian Atas -->
      <br>
      <!-- Table Bagian Tengah 1 -->
      <table class="table">
        <thead>
          <tr>
            <th rowspan="2" style="text-align:center;vertical-align:middle;" width="120">Mata Kuliah</th>
            <th rowspan="2" style=="text-align:center;vertical-align:middle;">KLS</th>
            <th rowspan="2" style=="text-align:center;vertical-align:middle;">SMT</th>
            <th colspan="3" align="center">Koreksi</th>
            <th colspan="3" align="center">Pembuatan Soal</th>
            <th colspan="3" align="center">Mengawas</th>
            <th rowspan="2" style="text-align:center;vertical-align:middle;">Diterima</th>
          </tr>
          <tr>
            <th align="center">Q</th>
            <th align="center">Honor</th>
            <th align="center">Total</th>
            <th align="center">Q</th>
            <th align="center">Honor</th>
            <th align="center">Total</th>
            <th align="center">Q</th>
            <th align="center">Honor</th>
            <th align="center">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $gtotal = 0;
            foreach ($this->global_model->find_all_by('hu_data', array('id_hudosen'=>$key['id_hudosen'])) as $matkul) {
              $totalhonor = intval($honordsn);
              $matkulujian = $this->global_model->find_by('m_matakuliah',array('id_matkul'=>$matkul['id_matkul']));
              $konsentrasi = $this->global_model->find_by('m_konsentrasi',array('id_konsentrasi'=>$matkul['id_konsentrasi']));
              $qkoreksi = $matkul['qty_koreksi'];
              $qbuat = $matkul['qty_buat'];
              $qasistensi = $matkul['qty_asistensi'];
              $honor = $this->global_model->find_by('p_lain',array('id'=>1));
              $tkoreksi = intval($qkoreksi*$honor[$matkul['tipekoreksi']]);
              $tbuat = intval($qbuat*$honor[$matkul['tipebuat']]);
              $tmengawas = intval($qasistensi*$totalhonor);
              $total = intval($tkoreksi+$tbuat+$tmengawas);
              $gtotal = $gtotal + $total;

              $aarray = array(
                '2sks' => 'K:2SKS',
                '4sks' => 'K:4SKS'
              );

              $barray = array(
                'puts' => 'P:UTS',
                'puas' => 'P:UAS'
              );
              $jenisket = $aarray[$matkul['tipekoreksi']]."/".$barray[$matkul['tipebuat']];
          ?>

          <tr>
            <td class="borderbawah"><?php echo $matkulujian['nama_matkul']." (".$jenisket.")"; ?></td>
            <td align="center" class="borderbawah"><?php echo $konsentrasi['kd_konsentrasi'];?></td>
            <td align="center" class="borderbawah"><?php echo $matkul['semester'];?></td>
            <td align="center" class="borderbawah"><?php echo $qkoreksi; ?></td>
            <td align="center" class="borderbawah"><?php echo number_format($honor[$matkul['tipekoreksi']]); ?></td>
            <td align="center" class="borderbawah"><?php echo number_format($tkoreksi); ?></td>
            <td align="center" class="borderbawah"><?php echo $qbuat; ?></td>
            <td align="center" class="borderbawah"><?php echo number_format($honor[$matkul['tipebuat']]); ?></td>
            <td align="center" class="borderbawah"><?php echo number_format($tbuat); ?></td>
            <td align="center" class="borderbawah"><?php echo $qasistensi;?></td>
            <td align="center" class="borderbawah"><?php echo number_format($totalhonor);?></td>
            <td align="center" class="borderbawah"><?php echo number_format($tmengawas);?></td>
            <td align="right" class="borderbawah"><?php echo number_format($total);?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <!-- Finish Table Bagian Tengah 1
           Table Bagian Tengah 2 -->
      <table class="table2">
        <tr>
          <td width="80%" style="border-top:1px solid black;"></td>
          <td style="border-bottom:1px solid black; border-top:1px solid black;"><b>Total :</b></td>
          <td align="right" style="padding:8px;border-bottom:1px solid black;border-top:1px solid black;"><?php echo number_format($gtotal);?></td>
        </tr>
      </table>
      <!-- Finish Table Bagian Tengah 2
           Table Bagian Tengah 3 -->
      <table width="100%" cellspacing="0">
        <tr>
          <td colspan="4"><b>Bekasi, </b><?php echo date("j F Y");?></td>
        </tr>
        <tr>
          <td width="30%" colspan="2"><b>Kabid Keuangan & HRD</b></td>
          <td width="30%"></td>
          <td align="center"><b>Penerima</b></td>
        </tr>
        <tr>
          <td height="20"></td>
        </tr>
      </table>
      <!-- Finish Table Bagian Tengah 3 -->
      <br><br>
      <!-- Table Bagian Tengah 4 -->
      <table width="100%">
        <tr>
          <td width="30%" colspan="2" style="border-bottom:1px solid #000;" align="center"></td>
          <td width="30%"></td>
          <td align="center"><u><b><?php if($a['nama_lengkap'] == ""){echo "-";}else{echo $a['nama_lengkap'].$gelar;}; ?></b></u></td>
        </tr>
      </table>
      <!-- Finish Table Bagian Tengah 4 -->
       <div style="page-break-after:always;"></div>
    <?php
      }
    }
    ?>
  </body>
</html>
