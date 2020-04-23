<html>
  <head>
    <title>Rekap Honor Ujian</title>
    <style>
    body{
      font-family: arial, sans-serif;
    }
    *{
      color: black;
    }
    table{
      border-collapse: collapse;
      page-break-inside: auto;
    }
    tr {
      page-break-inside: avoid;
      page-break-after: auto;
    }
    .table {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #000;
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
      font-size: 12pt;
      font-weight: bold;
      margin:0;
      padding:0;
    }
    .lead2{
      font-size: 9pt;
      margin:0;
      padding:0;
    }
    .lead3{
      font-size: 9pt;
      margin:0;
      padding:0;
    }
    td{
      font-size: 9pt;
      padding:5px;
    }
    .header{
      text-align: center;
      border: 1px solid #000;
      height: 50px;
    }
    th{
      font-size: 10pt;
      padding:8px;
      border-bottom: 1px solid #000;
    }
    .borderbawah{
      border-bottom: 1px solid #000;
    }
    </style>
  </head>
  <body>
    <p class="lead" align="center">POLITEKNIK LP3I JAKARTA KAMPUS PONDOK GEDE</p><br><br>
    <p class="lead2" align="center"><i>REKAPITULASI HONOR UJIAN DOSEN</i></p><br><br>
    <p class="lead3"><b>Priode : </b> <?php echo date("j F Y", strtotime($this->session->userdata('periodedari'))). " - " .date("j F Y", strtotime($this->session->userdata('periodesampai')));?></p><br>
    <p class="lead3"><b>Bulan&nbsp; : </b> <?php echo $this->session->userdata('bulan'). " ".$this->session->userdata('tahun'); ?></p><br><br>
    <!-- Finish Table Bagian Atas -->
    <table width="100%">
      <tr>
        <th width="150">Nama</th>
        <th width="180">Mata Kuliah</th>
        <th width="20">Kelas</th>
        <th width="20">SMT</th>
        <th colspan="3">Koreksi</th>
        <th colspan="3">Pembuatan Soal</th>
        <th colspan="3">Mengawas</th>
        <th>Jumlah</th>
      </tr>
      <?php
        $ggtotal = 0;

        //Session Paraf
        $session = array(
          'nama_lengkap' => $this->session->userdata('nama_lengkap'),
          'id_divisi' => $this->session->userdata('id_divisi'),
          'id_jabatan' => $this->session->userdata('id_jabatan'),
        );

        $datacetak = array(
          '1' => "Kepala Bidang Akademik",
          '2' => "Staff Akademik",
          '100' => "Kepala Kampus",
          '99' => "Wakil Kepala Kampus"
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
          'cimbniaga' => 'CIMB NIAGA',
          'siabuk' => 'SIAGA BUKOPIN'
        );
        foreach ($loaddosen as $key) {
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
        		$matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$key['id_dosen'], 'thn_ajaran'=>$this->session->userdata('thnajaran')));
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

            $gelar = "";
            if($databro['gelar']!=""){
              $gelar = ", ".$databro['gelar'];
            }

            $no = 0;
            $gtotal = 0;
            $ktotal = 0;
            $ptotal = 0;
            $mtotal = 0;
            $datamatkul = $this->global_model->find_all_by('hu_data', array('id_hudosen'=>$key['id_hudosen']));
            foreach ($datamatkul as $loadmatkul) {
              $totalhonor = intval($honordsn);
              $no = $no+1;
              $matkul = $this->global_model->find_by('m_matakuliah', array('id_matkul'=>$loadmatkul['id_matkul']));
              $kls = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$loadmatkul['id_konsentrasi']));
              $qkoreksi = $loadmatkul['qty_koreksi'];
              $qbuat = $loadmatkul['qty_buat'];
              $qasistensi = $loadmatkul['qty_asistensi'];
              $honor = $this->global_model->find_by('p_lain',array('id'=>1));
              $tkoreksi = intval($qkoreksi*$honor[$loadmatkul['tipekoreksi']]);
              $tbuat = intval($qbuat*$honor[$loadmatkul['tipebuat']]);
              $tmengawas = intval($qasistensi*$totalhonor);
              $total = intval($tkoreksi+$tbuat+$tmengawas);
              $gtotal = $gtotal + $total;
              $ktotal = $ktotal + $qkoreksi;
              $ptotal = $ptotal + $qbuat;
              $mtotal = $mtotal + $qasistensi;

              $aarray = array(
                '2sks' => 'K:2SKS',
                '4sks' => 'K:4SKS'
              );

              $barray = array(
                'puts' => 'P:UTS',
                'puas' => 'P:UAS'
              );
              $jenisket = $aarray[$loadmatkul['tipekoreksi']]."/".$barray[$loadmatkul['tipebuat']];
      ?>
      <tr>
        <?php if($no==1){?>
        <td rowspan="<?php echo count($datamatkul); ?>"><?php echo $databro['nama_lengkap'].$gelar; ?></td>
        <?php } ?>
        <td><?php echo $matkul['nama_matkul']." (".$jenisket.")"; ?></td>
        <td align="center"><?php echo $kls['kd_konsentrasi']; ?></td>
        <td align="center"><?php echo $loadmatkul['semester']; ?></td>
        <td><?php echo $qkoreksi; ?></td>
        <td><?php echo number_format($honor[$loadmatkul['tipekoreksi']]); ?></td>
        <td><?php echo number_format($tkoreksi); ?></td>
        <td><?php echo $qbuat; ?></td>
        <td><?php echo number_format($honor[$loadmatkul['tipebuat']]); ?></td>
        <td><?php echo number_format($tbuat); ?></td>
        <td><?php echo $qasistensi; ?></td>
        <td><?php echo number_format($totalhonor); ?></td>
        <td><?php echo number_format($tmengawas); ?></td>
        <td align="right"><?php echo number_format($total);?></td>
      </tr>
      <?php }
        $ggtotal = $ggtotal + $gtotal;
      ?>
      <tr>
        <td style="border-top:1px solid black;border-bottom:1px solid black;"><b>NPWP : </b><?php echo $databro['npwp'];?></td>
        <td colspan="3" style="border-top: 1px solid black; border-bottom: 1px solid black;"><b>Rek : </b>
          <?php
            $nihbank = "";
            if($bank[$databro['bank']]!="")
            {
              $nihbank = $bank[$databro['bank']];
            }
            echo "[".$nihbank."] ".$databro['norekening'];
          ?>
        </td>
        <td colspan="3" style="border-top:1px solid black;border-bottom:1px solid black;"><?php echo $ktotal;?></td>
        <td colspan="3" style="border-top:1px solid black;border-bottom:1px solid black;"><?php echo $ptotal;?></td>
        <td colspan="3" style="border-top:1px solid black;border-bottom:1px solid black;"><?php echo $mtotal;?></td>
        <td style="border-top:1px solid black;border-bottom:1px solid black;" align="right"><?php echo number_format($gtotal);?></td>
      </tr>
      <?php
        }
      }
      ?>
    </table><br><br>
    <!-- Finish Table Bagian Atas
         Table Bagian Tengah 1 -->
    <table width="100%">
      <tr>
        <td width="90%"><b>Grand Total</b></td>
        <td align="right"><?php echo number_format($ggtotal);?></td>
      </tr>
    </table><br><br>
    <!-- Finish Table Bagian Tengah 1
         Table Bagian Tengah 2 -->
    <table width="100%">
      <tr>
        <td>Bekasi : <?php echo date("j F Y");?></td>
      </tr>
      <tr>
        <td width="320">Dibuat oleh,</td>
        <td width="300">Mengetahui</td>
        <td width="300">Menyetujui</td>
      </tr>
    </table><br><br><br><br><br>
    <!-- Finish Table Bagian Tengah 2
         Table Bagian Bawah -->
    <table width="100%">
      <tr>
        <td width="290"><?php if($session['nama_lengkap'] == ""){ echo "-";}else{ echo $session['nama_lengkap'];} ?></td>
        <td width="320"><?php echo $this->session->userdata('nkbidang'); ?></td>
        <td width=""><?php echo $this->session->userdata('nkepala'); ?></td>
      </tr>
      <tr>
        <td><i><?php if($datacetak[$session['id_jabatan']]!= null){ echo $datacetak[$session['id_jabatan']];}else{ echo "-";}?></i></td>
        <td><i><?php echo $this->session->userdata('jkbidang'); ?></i></td> 
        <td><i><?php echo $this->session->userdata('jkepala');  ?></i></td>
      </tr>
    </table>
    <!-- Finish Bagian Bawah -->
  </body>
</html>
