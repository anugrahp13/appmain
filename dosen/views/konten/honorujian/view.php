<div class="row">
  <div class="col-md-8">
    <div class="form-group">
      <label>Nama Dosen</label>
      <p class="text-muted no-margin">
        <?php
          $namadosen = $this->global_model->find_by('dosen_profil', array('id_dosen'=>$loaddosen['id_dosen']));
          $plain = $this->global_model->find_by('p_lain',array('id'=>1));
          //Pendidikan
          $np = 0;
          $checkdidik = $this->global_model->find_by('m_pendidikan', array('id_pendidikan'=>$namadosen['pend_akhir']));
          if($checkdidik!=null){
            $np = $checkdidik['nominal'];
          }

          //Praktisi
          $npr = 0;
          $checkpraktisi = $this->global_model->find_by('m_praktisi', array('id_praktisi'=>$namadosen['id_praktisi']));
          if($checkpraktisi!=null){
            $npr = $checkpraktisi['nominal'];
          }

          //Japung
          $nj = 0;
          $checkjapung = $this->global_model->find_by('m_japung', array('id_japung'=>$namadosen['id_japung']));
          if($checkjapung!=null){
            $nj = $checkjapung['nominal'];
          }

          //NIDN
          $nidn = 0;
          if($namadosen['nidn']!=""&&$namadosen['nidn']!="0"){
            $nidn = $plain['nidn'];
          }

          //Masa Kerja
          $birthDate = $namadosen['tgl_kerja'];
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
      		$matakul = $this->global_model->find_by('sesi_dosen', array('id_dosen'=>$loaddosen['id_dosen'], 'thn_ajaran'=>$loaddosen['thn_ajaran']));
      		if(!empty($matakul)){
      			$checknb = $this->global_model->query("select sum(nominal_inggris) as jumlah from sesi_data where id_sesi='".$matakul['id_sesi']."'");
      			if(!empty($checknb)){
      				$nb = $checknb[0]['jumlah'];
      			}
      		}

          //Output Honor
          $honor = intval($np+$npr+$nj+$nidn+$nm+$nb);

          $gelar = "";
          if($namadosen['gelar']!=""){
            $gelar = ", ".$namadosen['gelar'];
          }
          echo $namadosen['nama_lengkap'].$gelar;
        ?>
      </p>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label>Tahun Ajaran</label>
      <p class="text-muted no-margin"><?php echo $loaddosen['thn_ajaran'];?></p>
    </div>
  </div>
  <div class="col-md-2">
    <div class="form-group">
      <label>Tanggal Input</label>
      <p class="text-muted no-margin"><?php echo $loaddosen['tgl'];?></p>
    </div>
  </div>
</div>
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th rowspan="2" style="text-align:center;vertical-align:middle;">Mata Kuliah</th>
      <th rowspan="2" class="text-center" style="text-align:center;vertical-align:middle;">Kelas</th>
      <th rowspan="2" class="text-center" style="text-align:center;vertical-align:middle;">SMT</th>
      <th colspan="3" class="text-center">Koreksi</th>
      <th colspan="3" class="text-center">Pembuatan Soal</th>
      <th colspan="3" class="text-center">Mengawas</th>
      <th rowspan="2" style="text-align:center;vertical-align:middle;">Diterima</th>
    </tr>
    <tr>
      <th class="text-center">Q</th>
      <th class="text-center">Honor</th>
      <th class="text-center">Total</th>
      <th class="text-center">Q</th>
      <th class="text-center">Honor</th>
      <th class="text-center">Total</th>
      <th class="text-center">Q</th>
      <th class="text-center">Honor</th>
      <th class="text-center">Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($loadmatkul as $key) {
        $totalhonor = intval($honor);
        $a = $this->global_model->find_by('m_matakuliah', array('id_matkul'=>$key['id_matkul']));
        $b = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$key['id_konsentrasi']));
        $qkoreksi = $key['qty_koreksi'];
        $qbuat = $key['qty_buat'];
        $qasistensi = $key['qty_asistensi'];
        $tkoreksi = intval($qkoreksi*$plain[$key['tipekoreksi']]);
        $tbuat = intval($qbuat*$plain[$key['tipebuat']]);
        $tmengawas = intval($qasistensi*$totalhonor);
        $total = intval($tkoreksi+$tbuat+$tmengawas);

        $aarray = array(
          '2sks' => 'K:2SKS',
          '4sks' => 'K:4SKS'
        );

        $barray = array(
          'puts' => 'P:UTS',
          'puas' => 'P:UAS'
        );
        $jenisket = $aarray[$key['tipekoreksi']]."/".$barray[$key['tipebuat']];
    ?>

    <tr>
      <td><?php echo $a['nama_matkul']." (".$jenisket.")"; ?></td>
      <td class="text-center"><?php echo $b['kd_konsentrasi']; ?></td>
      <td class="text-center"><?php echo $key['semester']; ?></td>
      <td class="text-center"><?php echo $qkoreksi; ?></td>
      <td class="text-center"><?php echo number_format($plain[$key['tipekoreksi']]); ?></td>
      <td class="text-center"><?php echo number_format($tkoreksi); ?></td>
      <td class="text-center"><?php echo $qbuat; ?></td>
      <td class="text-center"><?php echo number_format($plain[$key['tipebuat']]); ?></td>
      <td class="text-center"><?php echo number_format($tbuat); ?></td>
      <td class="text-center"><?php echo $qasistensi; ?></td>
      <td class="text-center"><?php echo number_format($totalhonor); ?></td>
      <td class="text-center"><?php echo number_format($tmengawas); ?></td>
      <td align="right"><?php echo number_format($total);?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
