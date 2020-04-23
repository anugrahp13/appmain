<html>
  <head>
    <title>Slip Honor Dosen</title>
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
      font-size: 11pt;
      margin:0;
      padding:0;
    }
    .lead2{
      font-size: 11pt;
      margin:0;
      padding:0;
    }
    .lead3{
      font-size: 8pt;
      margin:0;
      padding:0;
    }
    td{
      font-size: 9pt;
      padding:7px;
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
      border-top: 1px solid #000;
    }
    .borderbawah{
      border-bottom: 1px solid #000;
    }
    </style>
  </head>
  <body>
    <?php
    $dari = $this->session->userdata('periodedari');
    $sampai = $this->session->userdata('periodesampai');
    $thnajaran = $this->session->userdata('thnajaran');
    $plain = $this->global_model->find_by('p_lain', array('id'=>1));
    $backup = $this->session->userdata('backup');
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

      $sqlthnajaran = " and thn_ajaran='".$thnajaran."'";
      $sqldari = " and periode_dari='".$dari."'";
      $sqlsampai = " and periode_sampai='".$sampai."'";

      //Output Honor
      $honor = intval($np+$npr+$nj+$nidn+$nm);

      //Dosen Favorit
      if($databro['dsn_favorit']=="1"){
        $honor = $plain['dsn_favorit'];
      }

      //Hitung Sesi
      $sesicheck = array(
        'id_dosen' => $key['id_dosen'],
        'thn_ajaran' => $thnajaran
      );

      $nt = 0;

      $sesidosen = $this->global_model->find_by('sesi_dosen',$sesicheck);
      if(!empty($sesidosen)){
        $sesi_data = $this->global_model->find_all_by('sesi_data', array('id_sesi'=>$sesidosen['id_sesi']));
        if(!empty($sesidosen)&&!empty($sesi_data)){
          foreach ($sesi_data as $load) {
            foreach ($this->global_model->find_all_by('sesi_d', array('id_sesid'=>$load['id_sesid'])) as $checktransport) {
              $day = date('w', strtotime($checktransport['tgl_sesi']));
              if($day == "6"){
                $nt = $nt+1;
              }
            }

          }
        }
      }

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

      //transport
      $hnt = intval($nt+$ntt);
      $htransport = $hnt*$plain['transport'];

      $pphdsn = $plain['pph_nonpwp'];
      if($databro['npwp']!=""){
        $pphdsn = $plain['pph_npwp'];
      }
    ?>
    <p class="lead">POLITEKNIK LP3I JAKARTA</p>
    <p class="lead">KAMPUS PONDOK GEDE</p><br><br>
    <p class="lead2" align="center"><b>SLIP HONOR DOSEN</b></p><br><br>
    <!-- Table Bagian Atas -->
    <table width="100%" cellscaping="0">
      <tr>
        <td width="75%"><b>NIDN : </b><?php echo $databro['nidn']; ?></td>
        <td><b>Bulan : </b><?php echo $this->session->userdata('bulan')." ".$this->session->userdata('tahun'); ?></td>
      </tr>
      <tr>
        <?php
          $gelar = "";
          if($databro['gelar']!=""){
            $gelar = ", ".$databro['gelar'];
          }
        ?>
        <td><b>Nama : </b><?php echo $databro['nama_lengkap'].$gelar; ?></td>
        <td><b>Thn Ajaran : </b><?php echo $thnajaran; ?></td>
    </table>
    <!-- Finish Table Bagian Atas
         Table Bagian Tengah 1 -->
    <table width="100%" cellspacing="0">
      <tr>
        <th align="left">Keterangan</th>
        <th>Qty</th>
        <th>Honor</th>
        <th>Jumlah</th>
      </tr>
      <?php
      $totalinggris = 0;
      $matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$key['id_dosen'], 'thn_ajaran'=>$this->session->userdata('thnajaran')));
      if(!empty($matakul)){
        $checknb = $this->global_model->query("select id_matkul,nominal_inggris,id_sesid from sesi_data where id_sesi='".$matakul['id_sesi']."' and nominal_inggris !='0'");
        if(!empty($checknb)){
          echo "<tr>";
            echo "<td align='left' colspan='4'>Nominal Inggris</td>";
          echo "</tr>";
          $getd = 0;
          foreach ($checknb as $keynb) {
            $d = $this->global_model->query("select sum(jmlhsesi) as jmlh from sesi_d where (tgl_sesi between '".$dari."' and '".$sampai."') and id_sesid='".$keynb['id_sesid']."'");
            $getd = $d[0]['jmlh'];

            $jmlkey = $keynb['nominal_inggris']*$getd;
            $totalinggris = $totalinggris + $jmlkey;

            $enamamatkul = "-";
            $namamatkul = $this->global_model->find_by('m_matakuliah',array('id_matkul'=>$keynb['id_matkul']));
            if(!empty($namamatkul)){
              $enamamatkul = $namamatkul['nama_matkul'];
            }?>
            <tr>
              <td align="left">-- <?php echo $enamamatkul; ?></td>
              <td align="center"><?php if(empty($getd)){echo "0";}else{echo $getd;} ?>x</td>
              <td align="center"><?php echo number_format($keynb['nominal_inggris']); ?></td>
              <td align="right"><?php echo number_format($jmlkey);?></td>
            </tr>
          <?php }
        }
      }
      ?>

      <?php
      $sesis = 0;
      $get = 0;
      $sesidosen = $this->global_model->find_by('sesi_dosen',$sesicheck);
      if(!empty($sesidosen)){
        $sesi_data = $this->global_model->find_all_by('sesi_data', array('id_sesi'=>$sesidosen['id_sesi']));
        if(!empty($sesi_data)){
          echo "<tr>";
            echo "<td align='left' colspan='4'>Mata Kuliah</td>";
          echo "</tr>";
          foreach ($sesi_data as $load) {
            //Tambah Sesi
            $ts = 0;
            $sqlcheckts = "select sum(banyak_sesi) as jmlh from dosen_sesi where id_dosen='".$sesidosen['id_dosen']."' and id_matkul='".$load['id_matkul']."'".$sqlthnajaran.$sqldari.$sqlsampai;
            $checkts = $this->global_model->query($sqlcheckts);
            if($checkts!=null){
              $ts = $checkts[0]['jmlh'];
            }

            $a = $this->global_model->query("select sum(jmlhsesi) as jmlh from sesi_d where (tgl_sesi between '".$dari."' and '".$sampai."') and id_sesid='".$load['id_sesid']."'");
            $get = $a[0]['jmlh'];
            $sesis = intval($sesis+($get+$ts));

            $enamamatkul = "-";
            $namamatkul = $this->global_model->find_by('m_matakuliah',array('id_matkul'=>$load['id_matkul']));
            if(!empty($namamatkul)){
              $enamamatkul = $namamatkul['nama_matkul'];
            }?>

            <tr>
              <td align="left">-- <?php echo $enamamatkul; ?></td>
              <td align="center"><?php if(empty($get)){ echo "0";}else{echo $get;}?>x</td>
              <td align="center"></td>
              <td align="right"></td>
            </tr>
            <?php if($ts != 0){?>
            <tr>
              <td align="left">---- Sesi Tambahan</td>
              <td align="center"><?php if(empty($ts)){echo "0";}else{echo $ts;}?>x</td>
              <td align="center"></td>
              <td align="right"></td>
            </tr>
            <?php }?>

      <?php    }
        }
      }
      $honorplus = $honor+$totalinggris;
      $hses = $sesis*$honorplus;
      $subtotal = $hses + $htransport + $tkekurangan;
      $a = $pphdsn*10;
      $pphtotal = ($a*$subtotal)/1000;
      $totalhonor = $subtotal - $pphtotal;
      ?>
      <tr>
      <td align="left">Sesi Mengajar</td>
      <td align="center"><?php echo $sesis;?>x</td>
      <td align="center"><?php echo number_format($honorplus); ?></td>
      <td align="right"><?php echo number_format($hses);?></td>
      </tr>
      <tr>
        <td align="left">Transport</td>
        <td align="center"><?php echo $hnt."x"; ?></td>
        <td align="center"><?php echo number_format($plain['transport']); ?></td>
        <td align="right"><?php echo number_format($htransport); ?></td>
      </tr>
      <tr>
        <td align="left">Sisa Kekurangan</td>
        <td align="center"><?php echo $nbanyak."x"; ?></td>
        <td align="center"><?php echo number_format($nnominal); ?></td>
        <td align="right"><?php echo number_format($tkekurangan); ?></td>
      </tr>
      <tr>
        <td colspan="4" style="border-bottom:1px solid #000;"></td>
      </tr>
    </table>
    <!-- Finish Table Bagian Tengah 1
         Table Bagian Tengah 2 -->
    <table width="100%">
      <tr>
        <td><b>Rek : </b>
          <?php
            $nihbank = "";
            if($bank[$databro['bank']]!="")
            {
              $nihbank = $bank[$databro['bank']];
            }
            echo "[".$nihbank."] ".$databro['norekening'];
          ?>
        </td>
        <td align="center"><b>Jumlah</b></td>
        <td align="right"><?php echo number_format($subtotal); ?></b></td>
      </tr>
      <tr>
        <td><b>NPWP : </b><?php echo $databro['npwp']; ?></td>
        <td align="center"><b>Pot PPh 21 </b><?php echo $pphdsn."%"; ?></td>
        <td align="right"><?php echo number_format($pphtotal); ?></b></td>
      </tr>
      <tr>
        <td width="60%"></td>
        <td align="center" style="border-bottom:2px solid #000;"><b>Honor</b></td>
        <td align="right" style="border-bottom:2px solid #000;"><?php echo number_format($totalhonor); ?></b></td>
      </tr>
    </table><br><br>
    <!-- Finish Table Bagian Tengah 2
         Table Bagian Tengah 3 -->
    <table width="100%" cellspacing="0" border="0">
      <tr>
        <td colspan="4"><b>Pondok Gede, </b><?php echo date("j F Y");?></td>
      </tr>
      <tr>
        <td width="30%" colspan="2"><b>Kabid Keuangan & HRD</b></td>
        <td width="30%"></td>
        <td align="center"><b>Penerima</b></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table>
    <!-- Finish Table Bagian Tengah 3 -->
    <br><br>
    <!-- Table Bagian Bawah -->
    <table width="100%">
      <tr>
        <td width="30%" colspan="2" style="border-bottom:2px solid #000;" align="center"></td>
        <td width="30%"></td>
        <td align="center">
          <u>
            <b>
              <?php echo $databro['nama_lengkap'].$gelar; ?>
            </b>
          </u>
        </td>
      </tr>
    </table>
    <!-- Finish Table Bagian Bawah -->
    <div style="page-break-after:always;"></div>
    <?php
    if($backup == 1){
      $store = array(
        'periode' => $dari." - ".$sampai,
        'thn_ajaran' => $thnajaran,
        'jmlhsesi' => $sesis,
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
  } ?>
  </body>
</html>
