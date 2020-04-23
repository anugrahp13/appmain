<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
      *{
        font-family: Arial, Helvetica, sans-serif;
      }
      ,container{
        margin : 0 auto;
        width: 80%;
      }
      .tablehead{
        border-collapse: collapse;
        width: 100%;
        font-size: 9pt;
      }
      th, td {
          padding: 7px;
          text-align: left;
      }
      .tablebull{
        border-collapse: collapse;
        width: 100%;
        font-size: 9pt;
      }
      .tablebull td {
          font-size: 10pt;
      }
      hr {
          display: block;
          height: 1px;
          border: 0;
          border-top: 1px solid #ccc;
          margin: 1em 0;
          padding: 0;
      }
    </style>
  </head>
  <body>
    <?php foreach ($loadpeserta as $keypeserta) {
      $getbidang = "-";
      if(!empty($keypeserta['id_bidang'])){
        $bidang = $this->global_model->find_by('m_bidang',array('id_bidang'=>$keypeserta['id_bidang']));
        if(!empty($bidang)){
          $getbidang = $bidang['nama_bidang'];
        }
      }
    ?>
    <h4 align="center">BIODATA PESERTA BIDANG <?php echo $getbidang; ?></h4>
    <h4 align="center">PRAKTEK KERJA TERPADU (PKT)</h4>
    <h4 align="center">TA. <?php if(!empty($keypeserta['tahun_ajaran'])){ echo $keypeserta['tahun_ajaran'];}else{ echo "-";} ?></h4><br>
    <hr>
    <table border="0" class="tablehead">
      <tr>
        <td rowspan="4" width="100" style="padding:0;">
          <?php
            $img = "default.png";
            if(!empty($keypeserta['img'])){
              $img = $keypeserta['img'];
            }
          ?>
          <img src="assets/image/<?php echo $img; ?>" width="100" height="100">
        </td>
        <td><b>Nama Lengkap</b></td>
        <td><b>Bidang</b></td>
        <td><b>Tahun Ajaran</b></td>
      </tr>
      <tr>
        <td><?php if(!empty($keypeserta['nama_lengkap'])){ echo $keypeserta['nama_lengkap'];}else{ echo "-";} ?></td>
        <td><?php echo $getbidang; ?></td>
        <td><?php if(!empty($keypeserta['tahun_ajaran'])){ echo $keypeserta['tahun_ajaran'];}else{ echo "-";} ?></td>
      </tr>
      <tr>
        <td><b>NIM</b></td>
        <td><b>Konsentrasi / SMT</b></td>
        <td><b>Periode</b></td>
      </tr>
      <tr>
        <td><?php if(!empty($keypeserta['nim'])){ echo $keypeserta['nim'];}else{ echo "-";} ?></td>
        <?php
        $konsentrasi = "-";
        $semester = "-";
        if(!empty($keypeserta['id_konsentrasi'])){
          $oi = $this->global_model->find_by('m_konsentrasi',array('id_konsentrasi'=>$keypeserta['id_konsentrasi']));
          if(!empty($oi)){
            $konsentrasi = $oi['nama_konsentrasi'];
          }
        }
        if(!empty($keypeserta['semester'])){ $semester = $keypeserta['semester'];}
        ?>

        <td><?php echo $konsentrasi." / ".$semester ?></td>
        <?php
        $periodedari = "-";
        $periodesampai = "-";
        if(!empty($keypeserta['periode_dari'])){ $periodedari = $keypeserta['periode_dari'];}
        if(!empty($keypeserta['periode_sampai'])){ $periodesampai = $keypeserta['periode_sampai'];}
        ?>
        <td><?php echo $periodedari." - ".$periodesampai; ?></td>
      </tr>
    </table><br><br>
    <hr>
      <table border="0" class="tablebull">
        <tr>
          <td colspan="3" style="font-size:11pt;"><b>Informasi Pribadi</b></td>
        </tr>
        <tr>
          <td align="right" width="40%">Jenis Kelamin</td>
          <td align="center" width="10">:</td>
          <?php
            $kelamin = array(
              'l' => 'Laki - Laki',
              'p' => 'Perempuan'
            );
          ?>
          <td><?php if(!empty($kelamin[$keypeserta['jenis_kelamin']])){echo $kelamin[$keypeserta['jenis_kelamin']];}else{ echo "-";}?></td>
        </tr>
        <tr>
          <td align="right" width="40%">Tempat Lahir</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['tempat_lahir'])){ echo $keypeserta['tempat_lahir'];}else{ echo "-";} ?></td>
        </tr>
        <tr>
          <td align="right" width="40%">Tanggal Lahir</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['tgl_lahir'])){ echo $keypeserta['tgl_lahir'];}else{ echo "-";} ?></td>
        </tr>
        <tr>
          <td align="right" width="40%">Agama</td>
          <td align="center" width="10">:</td>
          <?php
            $agama = array(
              'is' => 'Islam',
              'pr' => 'Protestan',
              'ka' => 'Katolik',
              'hi' => 'Hindu',
              'bu' => 'Buddha',
              'kh' => 'Khonghucu',
              'la' => 'Lainnya'
            );
          ?>
          <td><?php if(!empty($agama[$keypeserta['agama']])){echo $agama[$keypeserta['agama']];}else{ echo "-";}?></td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size:11pt;"><b>Informasi Sosmed</b></td>
        </tr>
        <tr>
          <td align="right" width="40%">Akun FB</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['akun_fb'])){ echo $keypeserta['akun_fb'];}else{ echo "-";} ?></td>
        </tr>
        <tr>
          <td align="right" width="40%">Akun Instagram</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['akun_instagram'])){ echo $keypeserta['akun_instagram'];}else{ echo "-";} ?></td>
        </tr>
        <tr>
          <td colspan="3"></td>
        </tr>
        <tr>
          <td colspan="3" style="font-size:11pt;"><b>Informasi Kontak</b></td>
        </tr>
        <tr>
          <td align="right" width="40%">No. HP</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['no_hp'])){ echo $keypeserta['no_hp'];}else{ echo "-";} ?></td>
        </tr>
        <tr>
          <td align="right" width="40%">No. WA</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['no_wa'])){ echo $keypeserta['no_wa'];}else{ echo "-";} ?></td>
        </tr>
        <tr>
          <td align="right" width="40%">Email</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['email'])){ echo $keypeserta['email'];}else{ echo "-";} ?></td>
        </tr>
        <tr>
          <td align="right" width="40%">Alamat Rumah</td>
          <td align="center" width="10">:</td>
          <td><?php if(!empty($keypeserta['alamat_rumah'])){ echo $keypeserta['alamat_rumah'];}else{ echo "-";} ?></td>
        </tr>
      </table><br><br>
      <div style="page-break-after:always;"></div>
      <?php }?>
  </body>
</html>
