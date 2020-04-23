<?php
  $c = $view['pend_akhir'];
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

  $adata = array(
    'is' => 'Islam',
    'pr' => 'Protestan',
    'ka' => 'Katolik',
    'hi' => 'Hindu',
    'bu' => 'Buddha',
    'kh' => 'Khonghucu',
    'la' => 'Lainnya'
  );

  $bdata = array(
    'la' => 'Lajang',
    'me' => 'Menikah',
    'du' => 'Duda',
    'ja' => 'Janda'
  );

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
  //untuk ngitung honor dosen
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

  //Output Honor
  $honor = intval($np+$npr+$nj+$nidn+$nm);
  //Dosen Favorit
  if($view['dsn_favorit']=="1"){
    $honor = $plain['dsn_favorit'];
  }
?>
<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dosen
      <small>Detail Data Dosen</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>d.php/dosen"><i class="fa fa-male"></i> Dosen</a></li>
      <li class="active">Detail Data Dosen</li>
    </ol>
  </section>
  <!-- Finish Content Header -->
  <!-- Main Content -->
  <section class="content">
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-green">
        <div class="widget-user-image">
          <?php
            $imgname = "default.png";
            if(!empty($view['img'])){
              $imgname = $view['img'];
            }
          ?>
          <img class="img-square" style="width: 65px; height: 65px;" src="<?php echo base_url(); ?>assets/image/<?php echo $imgname; ?>" alt="User Avatar">
        </div>
        <!-- Widget User Image -->
        <h3 class="widget-user-username" style="margin-top: 0px; margin-bottom: 2px;">
          <?php
            $gelar = "";
            $namaload = $view['nama_lengkap'];
            if(!empty($view['gelar'])){
              $gelar = ", ".$view['gelar'];
            }

            if(empty($namaload)){
              echo "-";
            }else{
              echo $namaload.$gelar;
            }
          ?>
        </h3>
        <!-- Finish Widget User Image -->
        <h5 class="widget-user-desc" style="margin-bottom: 5px;">Honor Dosen Rp. <?php echo $honor; ?></h5>
        <?php
          $textket = "pendidikan, nidn, praktisi, japung, dan masa kerja";
          if($view['dsn_favorit']=="1"){
            $textket = "Dosen Favorit";
          }
        ?>
        <h6 class="widget-user-desc"><i>(Honor didapat dari <?php echo $textket; ?>)</i></h6>
      </div>
      <!-- Box Footer -->
      <div class="box-footer">
        <div class="row">
          <div class="col-md-4">
            <h4 class="lead page-header" style="font-size: 12pt;"><i class="fa fa-user"></i> Data Diri</h4>
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label">Jenis Kelamin</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php
                      $a = $view['jenis_kelamin'];
                      if($a == "l"){
                        echo "Laki - Laki";
                      }else if($a == "p"){
                        echo "Perempuan";
                      }else{ 
                        echo "-";
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Tempat Lahir</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['tempat_lahir'])){
                        echo "-";
                      }else{
                        echo $view['tempat_lahir'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Tanggal Lahir</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['tgl_lahir'])){
                        echo "-";
                      }else{
                        echo $view['tgl_lahir'];
                      }
                    ?> 
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Agama</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php
                      $a = $view['agama'];
                      if(empty($adata[$a])){
                        echo "-";
                      }else{
                        echo $adata[$a];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Status Perkawinan</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php
                      $b = $view['status_nikah'];
                      if(empty($bdata[$b])){
                        echo "-";
                      }else{
                        echo $bdata[$b];
                      }
                    ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 class="lead page-header" style="font-size: 12pt;"><i class="fa fa-briefcase"></i> Karir</h4>
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label">NIDN</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['nidn'])){
                        echo "-";
                      }else{
                        echo $view['nidn'];
                      } 
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Dosen Favorit</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php
                      $pr = $view['dsn_favorit'];
                      if($pr == 0){
                        echo "Bukan";
                      }else{
                        echo "Ya";
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Praktisi</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php
                      $pr = $view['id_praktisi'];
                      $caripr = $this->global_model->find_by('m_praktisi', array('id_praktisi'=>$pr));
                      if($caripr == null){
                        echo "-";
                      }else{
                        echo $caripr['nama_praktisi'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Japung</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php
                      $jp = $view['id_japung'];
                      $carijp = $this->global_model->find_by('m_japung', array('id_japung'=>$jp));
                      if($carijp == null){
                        echo "-";
                      }else{
                        echo $carijp['nama_japung'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Mulai Kerja</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if($view['tgl_kerja']==null){
                        echo "-";
                      }else{
                        echo $view['tgl_kerja'];
                      }
                    ?>    
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 class="lead page-header" style="font-size: 12pt;"><i class="fa fa-bank"></i> NPWP & Bank</h4>
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label">NPWP</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['npwp'])){
                        echo "-";
                      }else{
                        echo $view['npwp'];
                      }
                    ?> 
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Bank</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($bank[$view['bank']])){
                        echo "-";
                      }else{
                        echo $bank[$view['bank']];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">No. Rekening</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['norekening'])){
                        echo "-";
                      }else{
                        echo $view['norekening'];
                      }
                    ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div><br>
        <div class="row">
          <div class="col-md-4">
            <h4 class="lead page-header" style="font-size: 12pt;"><i class="fa fa-mortar-board"></i> Pendidikan</h4>
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label">Pendidikan Terakhir</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($cdata[$c])){
                        echo "-";
                      }else{
                        echo $cdata[$c];
                      }
                    ?>    
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Nama Institusi</label>
                <div class="col-sm-5">
                  <label class="lead" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['nama_institusi'])){
                        echo "-";
                      }else{
                        echo $view['nama_institusi'];
                      }
                    ?> 
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Jurusan</label>
                <div class="col-sm-5">
                  <label class="lead" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['jurusan'])){
                        echo "-";
                      }else{
                        echo $view['jurusan'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Gelar</label>
                <div class="col-sm-5">
                  <label class="lead" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['gelar'])){
                        echo "-";
                      }else{
                        echo $view['gelar'];
                      }
                    ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 class="lead page-header" style="font-size: 12pt;"><i class="fa fa-book"></i> Kontak</h4>
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-4 control-label">No. HP</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['no_hp'])){
                        echo "-";
                      }else{
                        echo $view['no_hp'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">No. WA</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['whatsapp'])){
                        echo "-";
                      }else{
                        echo $view['whatsapp'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">E-mail</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['email'])){
                        echo "-";
                      }else{
                        echo $view['email'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Nama Kontak Darurat</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['nama_kdarurat'])){
                        echo "-";
                      }else{
                        echo $view['nama_kdarurat'];
                      }
                    ?>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-4 control-label">Telepon Darurat</label>
                <div class="col-sm-5">
                  <label class="lead control-label" style="font-size: 11pt;">
                    <?php 
                      if(empty($view['tlp_darurat'])){
                        echo "-";
                      }else{
                        echo $view['tlp_darurat'];
                      }
                    ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <h4 class="lead page-header" style="font-size: 12pt;"><i class="fa fa-map"></i> Alamat</h4>
            <div class="form-group">
              <label class="control-label">Alamat Rumah</label><br>
              <label class="lead control-label" style="font-size: 11pt;">
                <?php 
                  if(empty($view['alamat_rumah'])){
                    echo "-";
                  }else{
                    echo $view['alamat_rumah'];
                  }
                ?>
                </label>
            </div>
          </div>
        </div>
      </div>
      <!-- Finish Box Footer -->
    </div>
  </section>
  <!-- Finish Main Content-->