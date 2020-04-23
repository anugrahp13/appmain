<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dosen
      <small>Ubah Data Dosen</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>d.php/dosen"><i class="fa fa-male"></i> Dosen</a></li>
      <li class="active">Ubah Data Dosen</li>
      <li class="active">
        <?php
          $gelar = "";
          $namaload = $detail['nama_lengkap'];
          if(!empty($detail['gelar'])){
            $gelar = ", ".$detail['gelar'];
          }

          if(empty($namaload)){echo "-";}else{echo $namaload.$gelar;}
        ?>
      </li>
    </ol>
  </section>
  <!-- Finish Content Header -->
  <!-- Main content -->
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
              <input class="form-control" type="text" name="nama_lengkap" <?php if(!empty($detail['nama_lengkap'])){ echo "value='".$detail['nama_lengkap']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">NIDN</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="nidn" <?php if(!empty($detail['nidn'])){ echo "value='".$detail['nidn']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Jenis Kelamin</label>
            <div class="col-sm-6">
              <select class="form-control" name="jenis_kelamin">
                <option value="l" <?php if($detail['jenis_kelamin'] == "l"){ echo "selected";} ?>>Laki-Laki</option>
                <option value="p" <?php if($detail['jenis_kelamin'] == "p"){ echo "selected";} ?>>Perempuan</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Tempat Lahir</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="tempat_lahir" <?php if(!empty($detail['tempat_lahir'])){ echo "value='".$detail['tempat_lahir']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Tanggal Lahir</label>
            <div class="col-sm-6">
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker2" name="tgl_lahir" <?php if(!empty($detail['tgl_lahir'])){ echo "value='".$detail['tgl_lahir']."'";} ?>>
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Status Perkawinan</label>
            <div class="col-sm-6">
              <select class="form-control" name="status_nikah">
                <option value="la" <?php if($detail['status_nikah'] == "la"){ echo "selected";} ?>>Lajang</option>
                <option value="me" <?php if($detail['status_nikah'] == "me"){ echo "selected";} ?>>Menikah</option>
                <option value="du" <?php if($detail['status_nikah'] == "du"){ echo "selected";} ?>>Duda</option>
                <option value="ja" <?php if($detail['status_nikah'] == "ja"){ echo "selected";} ?>>Janda</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Agama</label>
            <div class="col-sm-6">
              <select class="form-control" name="agama">
                <option value="is" <?php if($detail['agama'] == "is"){ echo "selected";} ?>>Islam</option>
                <option value="pr" <?php if($detail['agama'] == "pr"){ echo "selected";} ?>>Protestan</option>
                <option value="ka" <?php if($detail['agama'] == "ka"){ echo "selected";} ?>>Katolik</option>
                <option value="hi" <?php if($detail['agama'] == "hi"){ echo "selected";} ?>>Hindu</option>
                <option value="bu" <?php if($detail['agama'] == "bu"){ echo "selected";} ?>>Buddha</option>
                <option value="kh" <?php if($detail['agama'] == "kh"){ echo "selected";} ?>>Khonghucu</option>
                <option value="la" <?php if($detail['agama'] == "la"){ echo "selected";} ?>>Lainnya</option>
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
                <option value="sd" <?php if($detail['pend_akhir'] == "sd"){ echo "selected";} ?>>Sekolah Dasar</option>
                <option value="smp" <?php if($detail['pend_akhir'] == "smp"){ echo "selected";} ?>>Sekolah Menengah Pertama</option>
                <option value="sma" <?php if($detail['pend_akhir'] == "sma"){ echo "selected";} ?>>Sekolah Menengah Atas</option>
                <option value="d1" <?php if($detail['pend_akhir'] == "d1"){ echo "selected";} ?>>Diploma 1</option>
                <option value="d2" <?php if($detail['pend_akhir'] == "d2"){ echo "selected";} ?>>Diploma 2</option>
                <option value="d3" <?php if($detail['pend_akhir'] == "d3"){ echo "selected";} ?>>Diploma 3</option>
                <option value="s1" <?php if($detail['pend_akhir'] == "s1"){ echo "selected";} ?>>Sarjana</option>
                <option value="s2" <?php if($detail['pend_akhir'] == "s2"){ echo "selected";} ?>>Magister</option>
                <option value="s3" <?php if($detail['pend_akhir'] == "s3"){ echo "selected";} ?>>Doktoral</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Institusi Pendidikan</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="nama_institusi" <?php if(!empty($detail['nama_institusi'])){ echo "value='".$detail['nama_institusi']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Jurusan</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="jurusan" <?php if(!empty($detail['jurusan'])){ echo "value='".$detail['jurusan']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Gelar</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="gelar" <?php if(!empty($detail['gelar'])){ echo "value='".$detail['gelar']."'";} ?>>
            </div>
          </div><br>

          <p class="lead col-sm-offset-2">Informasi Karir</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">Dosen Favorit</label>
            <div class="col-sm-6">
              <select class="form-control" name="dsn_favorit">
                <option value="0" <?php if($detail['dsn_favorit'] == "0"){ echo "selected";} ?>>Bukan</option>
                <option value="1" <?php if($detail['dsn_favorit'] == "1"){ echo "selected";} ?>>Ya</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Praktisi</label>
            <div class="col-sm-6">
              <select class="form-control" name="id_praktisi">
                <?php foreach ($loadpraktisi as $key) {?>
                <option value="<?php echo $key['id_praktisi'] ?>" <?php if($detail['id_praktisi'] == $key['id_praktisi']){ echo "selected";} ?>><?php echo $key['nama_praktisi']." (Rp ".$key['nominal'].")";?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*Japung</label>
            <div class="col-sm-6">
              <select class="form-control" name="id_japung">
                <?php foreach ($loadjapung as $key) {?>
                <option value="<?php echo $key['id_japung'] ?>" <?php if($detail['id_japung'] == $key['id_japung']){ echo "selected";} ?>><?php echo $key['nama_japung']." (Rp ".$key['nominal'].")";?></option>
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
                <input type="text" class="form-control pull-right" id="datepicker" name="tgl_kerja" <?php if(!empty($detail['tgl_kerja'])){ echo "value='".$detail['tgl_kerja']."'";} ?>>
              </div>
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">Informasi Kontak</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">No. HP</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="no_hp" <?php if(!empty($detail['no_hp'])){ echo "value='".$detail['no_hp']."'";} ?> onkeypress="return isNumberKey(event)">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">No. WA</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="whatsapp" <?php if(!empty($detail['whatsapp'])){ echo "value='".$detail['whatsapp']."'";} ?> onkeypress="return isNumberKey(event)">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">*E-Mail</label>
            <div class="col-sm-6">
              <input class="form-control" type="email" name="email" <?php if(!empty($detail['email'])){ echo "value='".$detail['email']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Alamat Rumah</label>
            <div class="col-sm-6">
              <textarea class="form-control" name="alamat_rumah"><?php if(!empty($detail['alamat_rumah'])){ echo $detail['alamat_rumah'];} ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Nama Kontak Darurat</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="nama_kdarurat" <?php if(!empty($detail['nama_kdarurat'])){ echo "value='".$detail['nama_kdarurat']."'";}?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Telepon Darurat</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="tlp_darurat" <?php if(!empty($detail['tlp_darurat'])){ echo "value='".$detail['tlp_darurat']."'";}?> onkeypress="return isNumberKey(event)">
            </div>
          </div><br>
          <p class="lead col-sm-offset-2">Informasi Lainnya</p>
          <div class="form-group">
            <label class="col-sm-4 control-label">NPWP</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="npwp" <?php if(!empty($detail['npwp'])){ echo "value='".$detail['npwp']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Rekening Bank</label>
            <div class="col-sm-6">
              <select name="bank" class="form-control">
                <option value="bca" <?php if($detail['bank'] == "bca"){ echo "selected";} ?>>BCA</option>
                <option value="bcs" <?php if($detail['bank'] == "bcs"){ echo "selected";} ?>>BCA SYARIAH</option>
                <option value="bni" <?php if($detail['bank'] == "bni"){ echo "selected";} ?>>BNI</option>
                <option value="bbs" <?php if($detail['bank'] == "bbs"){ echo "selected";} ?>>BNI SYARIAH</option>
                <option value="bri" <?php if($detail['bank'] == "bri"){ echo "selected";} ?>>BRI</option>
                <option value="brs" <?php if($detail['bank'] == "brs"){ echo "selected";} ?>>BRI SYARIAH</option>
                <option value="bmd" <?php if($detail['bank'] == "bmd"){ echo "selected";} ?>>MANDIRI</option>
                <option value="bsm" <?php if($detail['bank'] == "bsm"){ echo "selected";} ?>>MANDIRI SYARIAH</option>
                <option value="danamon" <?php if($detail['bank'] == "danamon"){ echo "selected";} ?>>DANAMON</option>
                <option value="cimbniaga" <?php if($detail['bank'] == "cimbniaga"){ echo "selected";} ?>>CIMB NIAGA</option>
                <option value="siabuk" <?php if($detail['bank'] == "siabuk"){ echo "selected";} ?>>SIAGA BUKOPIN</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">No Rekening</label>
            <div class="col-sm-6">
              <input class="form-control" type="text" name="norekening" <?php if(!empty($detail['norekening'])){ echo "value='".$detail['norekening']."'";} ?>>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-4 col-sm-6">
              <input type="submit" class="btn btn-success" name="ubah" value="Ubah data">
            </div>
          </div>
        </div>
        <!--Finish Box Body -->
      </form>
    </div>
    <!-- Finish Default Box -->
  </section>
  <!-- Finish Main Content -->
