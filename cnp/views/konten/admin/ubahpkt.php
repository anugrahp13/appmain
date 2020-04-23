
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    PKT
    <small>Ubah Peserta PKT</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/datapkt">PKT</a></li>
    <li class="active">Ubah data</li>
    <li class="active"><?php echo $loaddata['nama_lengkap']; ?></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "ubahpkt"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-body"><br>
      <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/image/<?php if(!empty($loaddata['img'])){echo $loaddata['img'];}else{echo "default.png";} ?>" alt="User profile picture">
      <br>
      <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
        <p class="lead col-sm-offset-2">Informasi Pribadi</p>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Nama Lengkap</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="nama_lengkap" value="<?php echo $loaddata['nama_lengkap']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*NIM</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="nim" value="<?php echo $loaddata['nim']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Jenis Kelamin</label>
          <div class="col-sm-6">
            <select class="form-control" name="jenis_kelamin">
              <option value="l" <?php if($loaddata['jenis_kelamin'] == "l"){ echo "selected";} ?>>Laki-Laki</option>
              <option value="p" <?php if($loaddata['jenis_kelamin'] == "p"){ echo "selected";} ?>>Perempuan</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Tempat Lahir</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="tempat_lahir" value="<?php echo $loaddata['tempat_lahir']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Tanggal Lahir</label>
          <div class="col-sm-6">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir" value="<?php echo $loaddata['tgl_lahir'];?>">
            </div>
            <!-- /.input group -->
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Agama</label>
          <div class="col-sm-6">
            <select class="form-control" name="agama">
              <option value="is" <?php if($loaddata['agama'] == "is"){ echo "selected";}?>>Islam</option>
              <option value="pr" <?php if($loaddata['agama'] == "pr"){ echo "selected";}?>>Protestan</option>
              <option value="ka" <?php if($loaddata['agama'] == "ka"){ echo "selected";}?>>Katolik</option>
              <option value="hi" <?php if($loaddata['agama'] == "hi"){ echo "selected";}?>>Hindu</option>
              <option value="bu" <?php if($loaddata['agama'] == "bu"){ echo "selected";}?>>Buddha</option>
              <option value="kh" <?php if($loaddata['agama'] == "kh"){ echo "selected";}?>>Khonghucu</option>
              <option value="la" <?php if($loaddata['agama'] == "la"){ echo "selected";}?>>Lainnya</option>
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
        </div><br>
        <p class="lead col-sm-offset-2">Informasi Karir</p>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Konsentrasi</label>
          <div class="col-sm-6">
            <select class="form-control select2" name="id_konsentrasi" required>
              <?php foreach ($loadkonsentrasi as $loadkonsen) {?>
                <option <?php if($loaddata['id_konsentrasi'] == $loadkonsen['id_konsentrasi']){ echo "selected";}?> value="<?php echo $loadkonsen['id_konsentrasi'] ?>"><?php echo $loadkonsen['nama_konsentrasi']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Bidang</label>
          <div class="col-sm-6">
            <select class="form-control select2" name="id_bidang" required>
              <?php foreach ($loadbidang as $loadbid) {?>
                <option <?php if($loaddata['id_bidang'] == $loadbid['id_bidang']){ echo "selected";}?> value="<?php echo $loadbid['id_bidang'] ?>"><?php echo $loadbid['nama_bidang']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Semester</label>
          <div class="col-sm-6">
            <select class="form-control" name="semester" required>
              <option value="1" <?php if($loaddata['semester'] == "1"){ echo "selected";}?>>1</option>
              <option value="2" <?php if($loaddata['semester'] == "2"){ echo "selected";}?>>2</option>
              <option value="3" <?php if($loaddata['semester'] == "3"){ echo "selected";}?>>3</option>
              <option value="4" <?php if($loaddata['semester'] == "4"){ echo "selected";}?>>4</option>
              <option value="5" <?php if($loaddata['semester'] == "5"){ echo "selected";}?>>5</option>
              <option value="6" <?php if($loaddata['semester'] == "6"){ echo "selected";}?>>6</option>
              <option value="7" <?php if($loaddata['semester'] == "7"){ echo "selected";}?>>7</option>
              <option value="8" <?php if($loaddata['semester'] == "8"){ echo "selected";}?>>8</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Tahun Ajaran</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="tahun_ajaran" value="<?php echo $loaddata['tahun_ajaran']; ?>" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Periode</label>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" placeholder="Dari" name="periode_dari" value="<?php echo $loaddata['periode_dari']; ?>" required>
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-sm-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" placeholder="Sampai" name="periode_sampai" value="<?php echo $loaddata['periode_sampai']; ?>" required>
                </div>
                <!-- /.input group -->
              </div>
            </div>
          </div>
        </div>
        <br>
        <p class="lead col-sm-offset-2">Informasi Kontak</p>
        <div class="form-group">
          <label class="col-sm-4 control-label">No. HP</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="no_hp"  onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['no_hp']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">No. WA</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="no_wa"  onkeypress="return isNumberKey(event)" value="<?php echo $loaddata['no_wa']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">E-Mail</label>
          <div class="col-sm-6">
            <input class="form-control" type="email" name="email" value="<?php echo $loaddata['email']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Alamat Rumah</label>
          <div class="col-sm-6">
            <textarea class="form-control" name="alamat_rumah"><?php echo $loaddata['alamat_rumah']; ?></textarea>
          </div>
        </div><br>
        <p class="lead col-sm-offset-2">Informasi Lainnya</p>
        <div class="form-group">
          <label class="col-sm-4 control-label">Akun FB</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="akun_fb" value="<?php echo $loaddata['akun_fb']; ?>">
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Akun Instagram</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="akun_instagram" value="<?php echo $loaddata['akun_instagram']; ?>">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-6">
            <input type="submit" class="btn btn-default" name="simpan" value="Simpan data">
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
