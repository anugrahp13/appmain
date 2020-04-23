<?php
  $si = array(
    'nama_lengkap' => $this->session->flashdata('nama_lengkap'),
    'nidn' => $this->session->flashdata('nidn'),
    'jenis_kelamin' => $this->session->flashdata('jenis_kelamin'),
    'tgl_lahir' => $this->session->flashdata('tgl_lahir'),
    'tempat_lahir' => $this->session->flashdata('tempat_lahir'),
    'status_nikah' => $this->session->flashdata('status_nikah'),
    'agama' => $this->session->flashdata('agama'),
    'pend_akhir' => $this->session->flashdata('pend_akhir'),
    'nama_institusi' => $this->session->flashdata('nama_institusi'),
    'jurusan' => $this->session->flashdata('jurusan'),
    'gelar' => $this->session->flashdata('gelar'),
    'no_hp' => $this->session->flashdata('no_hp'),
    'whatsapp' => $this->session->flashdata('whatsapp'),
    'email' => $this->session->flashdata('email'),
    'alamat_rumah' => $this->session->flashdata('alamat_rumah'),
    'nama_kdarurat' => $this->session->flashdata('nama_kdarurat'),
    'tlp_darurat' => $this->session->flashdata('tlp_darurat'),
    'tgl_kerja' => $this->session->flashdata('tgl_kerja'),
    'id_praktisi' => $this->session->flashdata('id_praktisi'),
    'id_japung' => $this->session->flashdata('id_japung'),
    'npwp' => $this->session->flashdata('npwp'),
    'bank' => $this->session->flashdata('bank'),
    'norekening' => $this->session->flashdata('norekening'),
    'dsn_favorit' => $this->session->flashdata('dsn_favorit'),
    'pph' => $this->session->flashdata('pph')
  );
?>
<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dosen
      <small>Tambah Data Dosen</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>d.php/dosen"><i class="fa fa-male"></i> Dosen</a></li>
      <li class="active">Tambah Data Dosen</li>
    </ol>
  </section>
  <!-- Finish Content Header -->
  <!-- Main Content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "dosen"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default Box -->
    <div class="box">
      <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
        <!-- Box Body -->
        <div class="box-body">
          <p class="lead col-sm-offset-2">Informasi Pribadi</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Nama Lengkap</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="nama_lengkap" <?php if(!empty($si['nama_lengkap'])){ echo "value='".$si['nama_lengkap']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">NIDN</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="nidn" <?php if(!empty($si['nidn'])){ echo "value='".$si['nidn']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Jenis Kelamin</label>
            <div class="col-sm-6">
              <select class="form-control" name="jenis_kelamin">
                <option value="l" <?php if($si['jenis_kelamin'] == "l"){ echo "selected";} ?>>Laki-Laki</option>
                <option value="p" <?php if($si['jenis_kelamin'] == "p"){ echo "selected";} ?>>Perempuan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Tempat Lahir</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="tempat_lahir" <?php if(!empty($si['tempat_lahir'])){ echo "value='".$si['tempat_lahir']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Tanggal Lahir</label>
            <div class="col-sm-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker2" name="tgl_lahir" <?php if(!empty($si['tgl_lahir'])){ echo "value='".$si['tgl_lahir']."'";} ?>>
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Status Perkawinan</label>
            <div class="col-sm-6">
              <select class="form-control" name="status_nikah">
                <option value="la" <?php if($si['status_nikah'] == "la"){ echo "selected";} ?>>Lajang</option>
                <option value="me" <?php if($si['status_nikah'] == "me"){ echo "selected";} ?>>Menikah</option>
                <option value="du" <?php if($si['status_nikah'] == "du"){ echo "selected";} ?>>Duda</option>
                <option value="ja" <?php if($si['status_nikah'] == "ja"){ echo "selected";} ?>>Janda</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Agama</label>
            <div class="col-sm-6">
              <select class="form-control" name="agama">
                <option value="is" <?php if($si['agama'] == "is"){ echo "selected";} ?>>Islam</option>
                <option value="pr" <?php if($si['agama'] == "pr"){ echo "selected";} ?>>Protestan</option>
                <option value="ka" <?php if($si['agama'] == "ka"){ echo "selected";} ?>>Katolik</option>
                <option value="hi" <?php if($si['agama'] == "hi"){ echo "selected";} ?>>Hindu</option>
                <option value="bu" <?php if($si['agama'] == "bu"){ echo "selected";} ?>>Buddha</option>
                <option value="kh" <?php if($si['agama'] == "kh"){ echo "selected";} ?>>Khonghucu</option>
                <option value="la" <?php if($si['agama'] == "la"){ echo "selected";} ?>>Lainnya</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Foto Profil</label>
            <div class="col-sm-6">
              <input type="file" name="img">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
              * Ukuran file maksimal 500kb
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Pendidikan Terakhir</label>
            <div class="col-sm-6">
              <select class="form-control" name="pend_akhir">
                <option value="sd" <?php if($si['pend_akhir'] == "sd"){ echo "selected";} ?>>Sekolah Dasar</option>
                <option value="smp" <?php if($si['pend_akhir'] == "smp"){ echo "selected";} ?>>Sekolah Menengah Pertama</option>
                <option value="sma" <?php if($si['pend_akhir'] == "sma"){ echo "selected";} ?>>Sekolah Menengah Atas</option>
                <option value="d1" <?php if($si['pend_akhir'] == "d1"){ echo "selected";} ?>>Diploma 1</option>
                <option value="d2" <?php if($si['pend_akhir'] == "d2"){ echo "selected";} ?>>Diploma 2</option>
                <option value="d3" <?php if($si['pend_akhir'] == "d3"){ echo "selected";} ?>>Diploma 3</option>
                <option value="s1" <?php if($si['pend_akhir'] == "s1"){ echo "selected";} ?>>Sarjana</option>
                <option value="s2" <?php if($si['pend_akhir'] == "s2"){ echo "selected";} ?>>Magister</option>
                <option value="s3" <?php if($si['pend_akhir'] == "s3"){ echo "selected";} ?>>Doktoral</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Institusi Pendidikan</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="nama_institusi" <?php if(!empty($si['nama_institusi'])){ echo "value='".$si['nama_institusi']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Jurusan</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="jurusan" <?php if(!empty($si['jurusan'])){ echo "value='".$si['jurusan']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Gelar</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="gelar" <?php if(!empty($si['gelar'])){ echo "value='".$si['gelar']."'";} ?>>
            </div>
          </div><br>

          <p class="lead col-sm-offset-2">Informasi Karir</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">Dosen Favorit</label>
            <div class="col-sm-6">
              <select class="form-control" name="dsn_favorit">
                <option value="0" <?php if($si['dsn_favorit'] == "0"){ echo "selected";} ?>>Bukan</option>
                <option value="1" <?php if($si['dsn_favorit'] == "1"){ echo "selected";} ?>>Ya</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Praktisi</label>
            <div class="col-sm-6">
              <select class="form-control" name="id_praktisi">
                <?php foreach ($loadpraktisi as $key) {?>
                <option value="<?php echo $key['id_praktisi'] ?>" <?php if($si['id_praktisi'] == $key['id_praktisi']){ echo "selected";} ?>><?php echo $key['nama_praktisi']." (Rp ".$key['nominal'].")";?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Japung</label>
            <div class="col-sm-6">
              <select class="form-control" name="id_japung">
                <?php foreach ($loadjapung as $key) {?>
                <option value="<?php echo $key['id_japung'] ?>" <?php if($si['id_japung'] == $key['id_japung']){ echo "selected";} ?>><?php echo $key['nama_japung']." (Rp ".$key['nominal'].")";?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Tgl Mulai Kerja</label>
            <div class="col-sm-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="tgl_kerja" <?php if(!empty($si['tgl_kerja'])){ echo "value='".$si['tgl_kerja']."'";} ?>>
              </div>
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">Informasi Kontak</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">No. HP</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="no_hp" <?php if(!empty($si['no_hp'])){ echo "value='".$si['no_hp']."'";} ?> onkeypress="return isNumberKey(event)">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">No. WA</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="whatsapp" <?php if(!empty($si['whatsapp'])){ echo "value='".$si['whatsapp']."'";} ?> onkeypress="return isNumberKey(event)">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*E-Mail</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="email" <?php if(!empty($si['email'])){ echo "value='".$si['email']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Alamat Rumah</label>
            <div class="col-sm-6">
              <textarea class="form-control" name="alamat_rumah"><?php if(!empty($si['alamat_rumah'])){ echo $si['alamat_rumah'];} ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Nama Kontak Darurat</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="nama_kdarurat" <?php if(!empty($si['nama_kdarurat'])){ echo "value='".$si['nama_kdarurat']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Telepon Darurat</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="tlp_darurat" <?php if(!empty($si['tlp_darurat'])){ echo "value='".$si['tlp_darurat']."'";} ?> onkeypress="return isNumberKey(event)">
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">Informasi Lainnya</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">NPWP</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="npwp" <?php if(!empty($si['npwp'])){ echo "value='".$si['npwp']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Rekening Bank</label>
            <div class="col-sm-6">
              <select name="bank" class="form-control">
                <option value="bca" <?php if($si['bank'] == "bca"){ echo "selected";} ?>>BCA</option>
                <option value="bcs" <?php if($si['bank'] == "bcs"){ echo "selected";} ?>>BCA SYARIAH</option>
                <option value="bni" <?php if($si['bank'] == "bni"){ echo "selected";} ?>>BNI</option>
                <option value="bbs" <?php if($si['bank'] == "bbs"){ echo "selected";} ?>>BNI SYARIAH</option>
                <option value="bri" <?php if($si['bank'] == "bri"){ echo "selected";} ?>>BRI</option>
                <option value="brs" <?php if($si['bank'] == "brs"){ echo "selected";} ?>>BRI SYARIAH</option>
                <option value="bmd" <?php if($si['bank'] == "bmd"){ echo "selected";} ?>>MANDIRI</option>
                <option value="bsm" <?php if($si['bank'] == "bsm"){ echo "selected";} ?>>MANDIRI SYARIAH</option>
                <option value="danamon" <?php if($si['bank'] == "danamon"){ echo "selected";} ?>>DANAMON</option>
                <option value="cimbniaga" <?php if($si['bank'] == "cimbniaga"){ echo "selected";} ?>>CIMB NIAGA</option>
                <option value="siabuk" <?php if($si['bank'] == "siabuk"){ echo "selected";} ?>>SIAGA BUKOPIN</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">No Rekening</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="norekening" <?php if(!empty($si['norekening'])){ echo "value='".$si['norekening']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
              <input type="submit" class="btn btn-success" name="simpan" value="Simpan data">
            </div>
          </div>
        </div>
        <!-- Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content-->
