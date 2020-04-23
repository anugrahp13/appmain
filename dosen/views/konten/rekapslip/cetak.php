<html>
  <head>
    <title>Rekap Honor Dosen</title>
    <style>
    body{
      font-family: arial, sans-serif;
    }
    *{
      color: black;
    }
    table{
      border-collapse: collapse;
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
      font-size: 8pt;
      padding:5px;
    }
    .header{
      text-align: center;
      border: 1px solid #000;
      height: 50px;
    }
    th{
      font-size: 8pt;
      padding:8px;
      border-bottom: 1px solid #000;
    }
    .borderbawah{
      border-bottom: 1px solid #000;
    }
    </style>
    <style type="text/css" media="print">
   table thead
   {
    display: table-header-group;
   }
</style>
  </head>
  <body>
    <?php
    $plain = $this->global_model->find_by('p_lain', array('id'=>1));
    //kolektif data table biar gk load db terus
    //Pendidikan
    $lpendidikan = $this->global_model->find_all('m_pendidikan');
    $dpendidikan = array_column($lpendidikan, 'nominal', 'id_pendidikan');

    //Praktisi
    $lpraktisi = $this->global_model->find_all('m_praktisi');
    $dpraktisi = array_column($lpraktisi, 'nominal', 'id_praktisi');

    //Japung
    $ljapung = $this->global_model->find_all('m_japung');
    $djapung = array_column($ljapung, 'nominal', 'id_japung');


    $dari = $this->session->userdata('periodedari');
    $sampai = $this->session->userdata('periodesampai');
    $thnajaran = $this->session->userdata('thnajaran');
    $backup = $this->session->userdata('backup');

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
    $gtotal = 0;
    //$ttotal = 0;
    $tpph = 0;
    $tjumlah2 = 0;
    $tjumlah1 = 0;
    $nodata = 0;


    $jmlhdata = count($loaddosen);
    $kertas = intval($jmlhdata / 10);

    //jika jmldata < 10
    if(intval($jmlhdata / 10) == 0){
      $kertas = 1;
    }

    //jika memungkinkan mod utk penambahan kertas
    //dari sisa pembagian jmlhdata
    if($kertas > 1){
      if(($jmlhdata % 10) > 0){
        $kertas = $kertas + 1;
      }
    }

    $kuku = 0;
    $noloop = 0;
    while($kuku < $kertas){ ?>
    <p class="lead" align="center">POLITEKNIK LP3I JAKARTA KAMPUS PONDOK GEDE</p><br><br>
    <p class="lead2" align="center"><i>REKAPITULASI HONOR DOSEN</i></p><br><br>
    <p class="lead3"><b>Priode : </b> <?php echo date("j F Y", strtotime($this->session->userdata('periodedari'))). " - " .date("j F Y", strtotime($this->session->userdata('periodesampai')));?></p><br>
    <p class="lead3"><b>Bulan&nbsp; : </b> <?php echo $this->session->userdata('bulan'). " ".$this->session->userdata('tahun'); ?></p><br><br>

    <!-- Table bagian Atas -->
    <table width="100%">
      <tr>
        <th width="150">Nama</th>
        <th width="30">Sesi</th>
        <th width="50">Honor</th>
        <th width="50">Jumlah</th>
        <th width="120">Keterangan</th>
        <th>Nominal</th>
        <th width="50">Jumlah</th>
        <th colspan="2">PPh 21</th>
        <th width="60">Total</th>
      </tr>
      <?php foreach (array_slice($loaddosen,$noloop,10) as $key) {
        $noloop = $noloop+1;

        //Profil
        $gelar = "";
        if($key['gelar']!=""){
          $gelar = ", ".$key['gelar'];
        }

        //Pendidikan
        $np = 0;
        $checkdidik = $dpendidikan[$key['pend_akhir']];
        if(!empty($checkdidik)){
          $np = $checkdidik;
        }

        //Praktisi
        $npr = 0;
        $checkpraktisi = $dpraktisi[$key['id_praktisi']];
        if(!empty($checkpraktisi)){
          $npr = $checkpraktisi;
        }

        //Japung
        $nj = 0;
        $checkjapung = $djapung[$key['id_japung']];
        if(!empty($checkjapung)){
          $nj = $checkjapung;
        }

        //NIDN
        $nidn = 0;
        if($key['nidn']!=""&&$key['nidn']!="0"){
          $nidn = $plain['nidn'];
        }

        //Masa Kerja
        $birthDate = $key['tgl_kerja'];
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

        $sqlthnajaran = " and thn_ajaran='".$thnajaran."'";
        $sqldari = " and periode_dari='".$dari."'";
        $sqlsampai = " and periode_sampai='".$sampai."'";

        //Bahasa Inggris
        $totalinggris = 0;
        $matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$key['id_dosen'], 'thn_ajaran'=>$this->session->userdata('thnajaran')));
        if(!empty($matakul)){
          $checknb = $this->global_model->query("select id_matkul,nominal_inggris,id_sesid from sesi_data where id_sesi='".$matakul['id_sesi']."' and nominal_inggris !='0'");
          if(!empty($checknb)){
            $getd = 0;
            foreach ($checknb as $keynb) {
              $d = $this->global_model->query("select sum(jmlhsesi) as jmlh from sesi_d where (tgl_sesi between '".$dari."' and '".$sampai."') and id_sesid='".$keynb['id_sesid']."'");
              $getd = $d[0]['jmlh'];

              $jmlkey = $keynb['nominal_inggris']*$getd;
              $totalinggris = $totalinggris + $jmlkey;

            }

          }
        }

        //Output Honor
        $honor = intval($np+$npr+$nj+$nidn+$nm+$totalinggris);
        //Dosen Favorit
        if($key['dsn_favorit']=="1"){
          $honor = $plain['dsn_favorit'];
        }

        //Hitung Sesi
        $sesicheck = array(
          'id_dosen' => $key['id_dosen'],
          'thn_ajaran' => $thnajaran
        );
        $sesi = 0;
        $nt = 0;
        $ts = 0;
        $sesidosen = $this->global_model->find_by('sesi_dosen',$sesicheck);
        if(!empty($sesidosen)){
          $sesi_data = $this->global_model->find_all_by('sesi_data', array('id_sesi'=>$sesidosen['id_sesi']));
          if(!empty($sesi_data)){
            foreach ($sesi_data as $load) {
              $a = $this->global_model->query("select sum(jmlhsesi) as jmlh from sesi_d where (tgl_sesi between '".$dari."' and '".$sampai."') and id_sesid='".$load['id_sesid']."'");
              $get = $a[0]['jmlh'];
              $sesi = intval($sesi+$get);

              //Tambah Sesi
              $sqlcheckts = "select sum(banyak_sesi) as jmlh from dosen_sesi where id_dosen='".$sesidosen['id_dosen']."' and id_matkul='".$load['id_matkul']."'".$sqlthnajaran.$sqldari.$sqlsampai;
              $checkts = $this->global_model->query($sqlcheckts);
              if($checkts!=null){
                $ts = $checkts[0]['jmlh'];
              }


              foreach ($this->global_model->find_all_by('sesi_d', array('id_sesid'=>$load['id_sesid'])) as $checktransport) {
                $day = date('w', strtotime($checktransport['tgl_sesi']));
                if($day == "6"){
                  $nt = $nt+1;
                }
              }

            }
          }
        }

        //Keterangan Transport atau apa gitu
        //Transport Tambah
        $ntt = 0;
        $sqlcheck2 = "select sum(banyak_transport) as jmlh from dosen_transport where id_dosen='".$key['id_dosen']."'".$sqlthnajaran.$sqldari.$sqlsampai;
        $checktransport = $this->global_model->query($sqlcheck2);
        if($checktransport!=null){
          $ntt = $checktransport[0]['jmlh'];
        }

        //Tambah Kekurangan
        $nbanyak = 0;
        $nnominal = 0;
        $sqlcheckk = "select *from dosen_kekurangan where id_dosen='".$key['id_dosen']."'".$sqlthnajaran.$sqldari.$sqlsampai;
        $checkkekurangan = $this->global_model->query($sqlcheckk);
        if($checkkekurangan!=null){
          $nbanyak = $checkkekurangan[0]['banyak'];
          $nnominal = $checkkekurangan[0]['nominal_satuan'];
        }

        $tkekurangan = $nbanyak*$nnominal;

        //Tambah Sesi
        $jmlsesi = $sesi+$ts;

        //Jumlah1
        $jumlah1 = $jmlsesi*$honor;

        $hnt = intval($nt+$ntt);
        $nominal1 = $hnt*$plain['transport']+$tkekurangan;
        $jumlah2 = $jumlah1+$nominal1;

        $pphdsn = $plain['pph_nonpwp'];
        if($key['npwp']!=""){
          $pphdsn = $plain['pph_npwp'];
        }
        $a = $pphdsn*10;
        $pph = ($a*$jumlah2)/1000;

        $total = $jumlah2-$pph;

        //Keterangan Text
        $tekstransport = $hnt." x Transport";
        $tekskekurangan = "Kurang ".$nbanyak."x".$nnominal;
        $txt = "";
        $list1 = array($hnt,$nbanyak);
        $list2 = array($tekstransport,$tekskekurangan);
        for ($i=0; $i < count($list1) ; $i++) {
          if($list1[$i] > 0){
            $txt = $txt."+".$list2[$i];
          }
        }

        $txt = ltrim($txt, '+');

        if($backup == 1){
          $store = array(
            'periode' => $dari." - ".$sampai,
            'thn_ajaran' => $thnajaran,
            'jmlhsesi' => $jmlsesi,
            'transport' => $hnt,
            'kekurangan' => $tkekurangan,
            'id_dosen' => $key['id_dosen'],
            'honor' => $honor,
            'pph' => $pphdsn
          );

          $checkstore = array(
            'periode' => $dari." - ".$sampai,
            'thn_ajaran' => $thnajaran
          );

          $checkbros = count($this->global_model->query("select *from backup_honordosen where periode='".$checkstore['periode']."' and thn_ajaran='".$checkstore['thn_ajaran']."' and id_dosen='".$key['id_dosen']."'"));
          if($checkbros > 0){
            $this->global_model->update('backup_honordosen', $store, array('id_dosen'=>$key['id_dosen']));
          }else{
            $this->global_model->create('backup_honordosen', $store);
          }
        }

        $tpph = $tpph + $pph;
        $tjumlah2 = $tjumlah2 + $jumlah2;
        $tjumlah1 = $tjumlah1 + $jumlah1;
        //$ttotal = $ttotal + $total;

      ?>
      <tr>
        <td><?php echo $key['nama_lengkap'].$gelar; ?></td>
        <td align="center" width="10"><?php echo $jmlsesi; ?></td>
        <td align="center"><?php echo number_format($honor); ?></td>
        <td align="center"><?php echo number_format($jumlah1); ?></td>
        <td><?php echo $txt; ?></td>
        <td align="center"><?php echo number_format($nominal1); ?></td>
        <td align="center"><?php echo number_format($jumlah2); ?></td>
        <td><?php echo $pphdsn."%"; ?></td>
        <td><?php echo number_format($pph); ?></td>
        <td align="center"><?php echo number_format($total); ?></td>
      </tr>
      <tr>
        <td colspan="3" class="borderbawah"><b>NPWP : </b><?php echo $key['npwp']; ?></td>
        <td colspan="7" class="borderbawah"><b>Rek : </b>
          <?php
            $nihbank = "";
            if($bank[$key['bank']]!="")
            {
              $nihbank = $bank[$key['bank']];
            }
            echo "[".$nihbank."] ".$key['norekening'];
          ?>
        </td>
      </tr>
    <?php
    }
    //$gtotal = $gtotal+$ttotal;
    ?>
    </table>
    <div style="page-break-after:always;"></div>
    <?php
    $kuku++;
    }
    ?>
    <!-- Finish Table Bagian Atas
         Table Bagian Tengah 1 -->
    <table width="100%">
      <tr>
        <th width="150">Nama</th>
        <th width="30">Sesi</th>
        <th width="50">Honor</th>
        <th width="50">Jumlah</th>
        <th width="120">Keterangan</th>
        <th>Nominal</th>
        <th width="50">Jumlah</th>
        <th colspan="2">PPh 21</th>
        <th width="60">Total</th>
      </tr>
    </table>
    <table width="100%">
      <tr>
        <td width="270"><b>Grand Total</b></td>
        <td width="260"><?php echo number_format($tjumlah1);?></td>
        <td width="70"><?php echo number_format($tjumlah2);?></td>
        <td align="center" width="68"><?php echo number_format($tpph);?></td>
        <td align="center"><?php
        $n = $tjumlah2-$tpph;
        if($n < 0){
          $n = 0;
        }
        echo number_format($n);
        ?></td>
      </tr>
    </table><br><br><br>
    <!-- Finish Table Bagian Tengah 1
         Table Bagian Tengah 2 -->
    <table width="100%">
      <tr>
        <td>Pondok Gede, <?php echo date("j F Y");?></td>
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
