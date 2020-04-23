<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PENILAIAN MAHASISWA PRAKTEK KERJA TERPADU</title>
    <style>
    body{
      margin-top: 0;
    }
      *{
        font-family: Arial, Helvetica, sans-serif;
      }
      .tablehead{
        border-collapse: collapse;
        width: 100%;
        font-size: 9pt;
      }
      th, td {
          padding: 5px;
          text-align: left;
      }
      p{
        line-height: 50%;
        font-weight: bold;
        font-size: 10pt;
      }
    </style>
  </head>
  <body>
    <?php
      foreach ($loadpeserta as $keyload) {
    ?>
    <p align="center">PENILAIAN MAHASISWA PRAKTEK KERJA TERPADU</p>
    <p align="center">POLITEKNIK LP3I JAKARTA</p>
    <p align="center">KAMPUS PONDOK GEDE</p>
    <p align="center">TA. <?php if(!empty($keyload['tahun_ajaran'])){ echo $keyload['tahun_ajaran'];}else{ echo "-";} ?></p><br><br>
    <table class="tablehead" border="0" width="100%">
      <tr>
        <td width="100">Nama Mahasiswa</td>
        <td width="10" align="center">:</td>
        <td><?php if(!empty($keyload['nama_lengkap'])){echo $keyload['nama_lengkap'];}else{echo "-";} ?></td>
      </tr>
      <tr>
        <td>Konsentrasi / SMT</td>
        <td width="10" align="center">:</td>
        <?php
        $konsentrasi = "-";
        $semester = "-";
        if(!empty($keyload['id_konsentrasi'])){
          $oi = $this->global_model->find_by('m_konsentrasi',array('id_konsentrasi'=>$keyload['id_konsentrasi']));
          if(!empty($oi)){
            $konsentrasi = $oi['nama_konsentrasi'];
          }
        }
        if(!empty($keyload['semester'])){ $semester = $keyload['semester'];}
        ?>
        <td><?php echo $konsentrasi." / ".$semester ?></td>
      </tr>
      <tr>
        <td width="100">Periode</td>
        <td width="10" align="center">:</td>
        <?php
        $periodedari = "-";
        $periodesampai = "-";
        if(!empty($keyload['periode_dari'])){ $periodedari = $keyload['periode_dari'];}
        if(!empty($keyload['periode_sampai'])){ $periodesampai = $keyload['periode_sampai'];}
        ?>
        <td><?php echo $periodedari." - ".$periodesampai; ?></td>
      </tr>
      <tr>
        <td width="100">Bidang</td>
        <td width="10" align="center">:</td>
        <?php
        $getbidang = "-";
        if(!empty($keyload['id_bidang'])){
          $bidang = $this->global_model->find_by('m_bidang',array('id_bidang'=>$keyload['id_bidang']));
          if(!empty($bidang)){
            $getbidang = $bidang['nama_bidang'];
          }
        }
        ?>
        <td><?php echo $getbidang; ?></td>
      </tr>
    </table><br><br>
    <table border="1" class="tablehead" width="100%">
      <tr>
        <th width="10" align="center">No.</th>
        <th>Faktor Penilaian</th>
        <th width="50" align="center">Nilai</th>
      </tr>
      <?php
      $loadindikator = $this->global_model->query("select id_bidang,id_kategori from m_indikator where id_bidang='".$keyload['id_bidang']."' group by id_kategori");
      $no = 0;
      foreach ($loadindikator as $key) {
        $kategori = $this->global_model->find_by('m_kategori', array('id_kategori'=>$key['id_kategori']));
        $subindikator = $this->global_model->find_all_by('m_indikator', array('id_bidang' => $key['id_bidang'],'id_kategori'=>$key['id_kategori']));
      ?>
      <tr>
        <td colspan="3"><?php echo $kategori['nama_kategori']; ?></td>
      </tr>
      <?php
        foreach ($subindikator as $lindikator) {
          $no = $no+1;
          $getnilai = 0;
          $checknilaibro = $this->global_model->find_by('pkt_nilai', array('id_indikator'=>$lindikator['id_indikator'],'id_profil'=>$keyload['id_profil']));
          if($checknilaibro != null){
            $getnilai = $checknilaibro['nilai'];
          }
      ?>
      <tr>
        <td align="center"><?php echo $no; ?></td>
        <td><?php echo $lindikator['nama_indikator']; ?></td>
        <td align="center"><?php echo $getnilai; ?></td>
      </tr>
      <?php
        }
      }
      ?>
    </table><br><br>
    <table class="tablehead" border="0">
      <tr>
        <td width="60%"></td>
        <?php
        date_default_timezone_set("Asia/Jakarta");
        $tglnow = date("m/d/Y");
        $tglconvert = date("j F Y", strtotime($tglnow));
        ?>
        <td>Pondok Gede, <?php echo $tglconvert;?></td>
      </tr>
      <tr>
        <td>Tim Penilai,</td>
        <td>Mengetahui,</td>
      </tr>
      <tr>
        <td height="40" valign="bottom"><b><u>
          <?php
            $gettim = $this->global_model->find_by('m_indikator', array('id_bidang'=>$keyload['id_bidang']));
            $nama = "";
            $jabatan = "";
            if(!empty($gettim)){
              $nama = $gettim['nama_tim'];
              $jabatan = $gettim['jabatan_tim'];
            }

            echo $nama;
          ?>
        </u></b></td>
        <td height="40" valign="bottom"><b><u><?php echo $kabidcnp['nama_lengkap']; ?></u></b></td>
      </tr>
      <tr>
        <td><?php echo $jabatan; ?></td>
        <td>Kabid. Kerjasama & Penempatan Kerja</td>
      </tr>
    </table>
    <div style="page-break-after:always;"></div>
    <?php }?>
  </body>
</html>
