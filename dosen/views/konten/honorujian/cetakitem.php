<html>
<head>
  <title>Cetak Honor Ujian</title>
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
  <p class="lead">POLITEKNIK LP3I JAKARTA</p>
  <p class="lead">KAMPUS PONDOK GEDE</p>
  <br>
  <p align="center" class="lead2">SLIP HONOR UJIAN</p><br><br>
  <table width="100%">
    <tr>
      <td width="80%"><b>NIDN : </b>
        <?php
          $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$loaddosen['id_dosen']));
          if($a['nidn'] == ""){echo "-";}else{echo $a['nidn'];};
        ?>
      </td>
      <td><b>Bulan : </b><?php echo $loaddosen['bulan']." ".$loaddosen['tahun']; ?></td>
    </tr>
    <tr>
      <td><b>Rek : </b>-</td>
      <td><b>Semester : </b>
        <?php if($loaddosen['semester'] == ""){echo "-";}else{echo $loaddosen['semester'];}; ?>
      </td>
    </tr>
    <tr>
      <td><b>Nama : </b>
        <?php
          $a = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$loaddosen['id_dosen']));
          $gelar = "";
          if($a['gelar']!=""){
            $gelar = ", ".$a['gelar'];
          }
          if($a['nama_lengkap'] == ""){echo "-";}else{echo $a['nama_lengkap'].$gelar;};
        ?>
      </td>
      <td><b>Tahun Ajaran : </b><?php if($loaddosen['thn_ajaran'] == ""){echo "-";}else{echo $loaddosen['thn_ajaran'];}; ?></td>
    </tr>
  </table>
  <br>
  <table class="table">
    <thead>
      <tr>
        <th rowspan="2" style="text-align:center;vertical-align:middle;" width="120">Mata Kuliah</th>
        <th rowspan="2" style=="text-align:center;vertical-align:middle;">Kls</th>
        <th colspan="3" align="center">Koreksi</th>
        <th colspan="3" align="center">Pembuatan Soal</th>
        <th colspan="3" align="center">Mengawas</th>
        <th rowspan="2" style="text-align:center;vertical-align:middle;">Di terima</th>
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
        foreach ($loadmatkul as $key) {
          $matkul = $this->global_model->find_by('m_matakuliah',array('id_matkul'=>$key['id_matkul']));
          $konsentrasi = $this->global_model->find_by('m_konsentrasi',array('id_konsentrasi'=>$key['id_konsentrasi']));
          $qkoreksi = $key['qty_koreksi'];
          $qbuat = $key['qty_buat'];
          $qasistensi = $key['qty_asistensi'];
          $honor = $this->global_model->find_by('p_lain',array('id'=>1));
          $tkoreksi = intval($qkoreksi*$honor[$key['tipekoreksi']]);
          $tbuat = intval($qbuat*$honor[$key['tipebuat']]);
          $tmengawas = intval($qasistensi*$honor['mengawas']);
          $total = intval($tkoreksi+$tbuat+$tmengawas);
          $gtotal = $gtotal + $total;
      ?>

      <tr>
        <td class="borderbawah"><?php echo $matkul['nama_matkul']; ?></td>
        <td align="center" class="borderbawah"><?php echo $konsentrasi['kd_konsentrasi'];?></td>
        <td align="center" class="borderbawah"><?php echo $qkoreksi; ?></td>
        <td align="center" class="borderbawah"><?php echo $honor[$key['tipekoreksi']]; ?></td>
        <td align="center" class="borderbawah"><?php echo $tkoreksi; ?></td>
        <td align="center" class="borderbawah"><?php echo $qbuat; ?></td>
        <td align="center" class="borderbawah"><?php echo $honor[$key['tipebuat']]; ?></td>
        <td align="center" class="borderbawah"><?php echo $tbuat; ?></td>
        <td align="center" class="borderbawah"><?php echo $qasistensi; ?></td>
        <td align="center" class="borderbawah"><?php echo $honor['mengawas']; ?></td>
        <td align="center" class="borderbawah"><?php echo $tmengawas;?></td>
        <td align="right" class="borderbawah"><?php echo number_format($total);?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <table class="table2">
    <tr>
      <td width="80%" style="border-top:1px solid black;"></td>
      <td style="border-bottom:1px solid black; border-top:1px solid black;"><b>Total :</b></td>
      <td align="right" style="padding:8px;border-bottom:1px solid black;border-top:1px solid black;"><?php echo number_format($gtotal);?></td>
    </tr>
  </table>
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
  <br><br>
  <table width="100%">
    <tr>
      <td width="30%" colspan="2" style="border-bottom:1px solid #000;" align="center"></td>
      <td width="30%"></td>
      <td align="center"><u><b><?php if($a['nama_lengkap'] == ""){echo "-";}else{echo $a['nama_lengkap'].$gelar;}; ?></b></u></td>
    </tr>
  </table>
  <br><br><br>
</body>
</html>
