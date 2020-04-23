<html>
  <head>
    <title>Slip Honor Dosen Lalu</title>
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
      font-size: 10pt;
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
    $acoy = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$bro['id_dosen']));
    $jumlah1 = intval($bro['jmlhsesi']*$bro['honor']);
    $plain = $this->global_model->find_by('p_lain', array('id'=>1));
    $nominal1 = $bro['transport']*$plain['transport']+$bro['kekurangan'];
    $pphdsn = $bro['pph'];

    $tj = $jumlah1+$nominal1;
    $a = $pphdsn*10;
    $pph = ($a*$tj)/1000;
    $total = $tj-$pph;
    ?>
    <p class="lead">POLITEKNIK LP3I JAKARTA</p>
    <p class="lead">KAMPUS PONDOK GEDE</p><br><br>
    <p class="lead2" align="center"><b>SLIP HONOR DOSEN</b></p><br><br>
    <!-- Table Bagian Atas -->
    <table width="100%" cellscaping="0">
      <tr>
        <td width="65%"><b>NIDN : </b><?php echo $acoy['nidn']; ?></td>
        <td><b>Thn Ajaran : </b><?php echo $bro['thn_ajaran']; ?></td>
      </tr>
      <tr>
        <?php
          $gelar = "";
          if($acoy['gelar']!=""){
            $gelar = ", ".$acoy['gelar'];
          }
        ?>
        <td><b>Nama : </b><?php echo $acoy['nama_lengkap'].$gelar; ?></td>
        <td><b>Periode : </b> <?php echo $bro['periode']; ?></td>
      </tr>
    </table>
    <!-- Finish Table Bagian Atas
         Table Bagian Tengah 1 -->
    <table width="100%" cellspacing="0">
      <tr>
        <th>Keterangan</th>
        <th>Qty</th>
        <th>Honor</th>
        <th>Jumlah</th>
      </tr>
      <tr>
        <td align="center">Sesi Mengajar</td>
        <td align="center"><?php echo $bro['jmlhsesi'];?>x</td>
        <td align="center"><?php echo number_format($bro['honor']); ?></td>
        <td align="right"><?php echo number_format($jumlah1);?></td>
      </tr>
      <tr>
        <td align="center">Lainnya</td>
        <td align="center"></td>
        <td align="center"></td>
        <td align="right"><?php echo number_format($nominal1); ?></td>
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
            if($bank[$acoy['bank']]!="")
            {
              $nihbank = $bank[$acoy['bank']];
            }
            echo "[".$nihbank."] ".$acoy['norekening'];
          ?>
        </td>
        <td align="center"><b>Jumlah</b></td>
        <td align="right"><?php echo number_format($tj); ?></b></td>
      </tr>
      <tr>
        <td><b>NPWP : </b><?php echo $acoy['npwp']; ?></td>
        <td align="center"><b>Pot PPh 21 </b><?php echo $pphdsn."%"; ?></td>
        <td align="right"><?php echo number_format($pph); ?></b></td>
      </tr>
      <tr>
        <td width="60%"></td>
        <td align="center" style="border-bottom:2px solid #000;"><b>Honor</b></td>
        <td align="right" style="border-bottom:2px solid #000;"><?php echo number_format($total); ?></b></td>
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
        <td align="center"><u><b><?php echo $acoy['nama_lengkap'].$gelar; ?></b></u></td>
      </tr>
    </table>
    <!-- Finish Bagian Bawah -->
    <br><br><br>
  </body>
</html>
