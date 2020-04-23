
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    PKT
    <small>Tambah Peserta PKT</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/datapkt">PKT</a></li>
    <li class="active">Tambah data</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "tambahpkt"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <div class="box box-default">
    <div class="box-body">
      <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
        <p class="lead col-sm-offset-2">Informasi Pribadi</p>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Nama Lengkap</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="nama_lengkap" <?php if(!empty($this->session->flashdata('nama_lengkap'))){ echo "value='".$this->session->flashdata('nama_lengkap')."'";} ?> required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*NIM</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="nim" <?php if(!empty($this->session->flashdata('nim'))){ echo "value='".$this->session->flashdata('nim')."'";} ?> required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Jenis Kelamin</label>
          <div class="col-sm-6">
            <select class="form-control" name="jenis_kelamin">
              <option value="l" <?php if($this->session->flashdata('jenis_kelamin') == "l"){ echo "selected";} ?>>Laki-Laki</option>
              <option value="p" <?php if($this->session->flashdata('jenis_kelamin') == "p"){ echo "selected";} ?>>Perempuan</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Tempat Lahir</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="tempat_lahir" <?php if(!empty($this->session->flashdata('tempat_lahir'))){ echo "value='".$this->session->flashdata('tempat_lahir')."'";} ?>>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Tanggal Lahir</label>
          <div class="col-sm-6">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" id="datepicker" name="tgl_lahir" <?php if(!empty($this->session->flashdata('tgl_lahir'))){ echo "value='".$this->session->flashdata('tgl_lahir')."'";} ?>>
            </div>
            <!-- /.input group -->
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Agama</label>
          <div class="col-sm-6">
            <select class="form-control" name="agama">
              <option value="is" <?php if($this->session->flashdata('agama') == "is"){ echo "selected";}?>>Islam</option>
              <option value="pr" <?php if($this->session->flashdata('agama') == "pr"){ echo "selected";}?>>Protestan</option>
              <option value="ka" <?php if($this->session->flashdata('agama') == "ka"){ echo "selected";}?>>Katolik</option>
              <option value="hi" <?php if($this->session->flashdata('agama') == "hi"){ echo "selected";}?>>Hindu</option>
              <option value="bu" <?php if($this->session->flashdata('agama') == "bu"){ echo "selected";}?>>Buddha</option>
              <option value="kh" <?php if($this->session->flashdata('agama') == "kh"){ echo "selected";}?>>Khonghucu</option>
              <option value="la" <?php if($this->session->flashdata('agama') == "la"){ echo "selected";}?>>Lainnya</option>
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
                <option <?php if($this->session->flashdata('id_konsentrasi') == $loadkonsen['id_konsentrasi']){ echo "selected";}?> value="<?php echo $loadkonsen['id_konsentrasi'] ?>"><?php echo $loadkonsen['nama_konsentrasi']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Bidang</label>
          <div class="col-sm-6">
            <select class="form-control select2" name="id_bidang" required>
              <?php foreach ($loadbidang as $loadbid) {?>
              <option <?php if($this->session->flashdata('id_bidang') == $loadbid['id_bidang']){ echo "selected";}?> value="<?php echo $loadbid['id_bidang'] ?>"><?php echo $loadbid['nama_bidang']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Semester</label>
          <div class="col-sm-6">
            <select class="form-control" name="semester" required>
              <option value="1" <?php if($this->session->flashdata('semester') == "1"){ echo "selected";}?>>1</option>
              <option value="2" <?php if($this->session->flashdata('semester') == "2"){ echo "selected";}?>>2</option>
              <option value="3" <?php if($this->session->flashdata('semester') == "3"){ echo "selected";}?>>3</option>
              <option value="4" <?php if($this->session->flashdata('semester') == "4"){ echo "selected";}?>>4</option>
              <option value="5" <?php if($this->session->flashdata('semester') == "5"){ echo "selected";}?>>5</option>
              <option value="6" <?php if($this->session->flashdata('semester') == "6"){ echo "selected";}?>>6</option>
              <option value="7" <?php if($this->session->flashdata('semester') == "7"){ echo "selected";}?>>7</option>
              <option value="8" <?php if($this->session->flashdata('semester') == "8"){ echo "selected";}?>>8</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">*Tahun Ajaran</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="tahun_ajaran" <?php if(!empty($this->session->flashdata('tahun_ajaran'))){ echo "value='".$this->session->flashdata('tahun_ajaran')."'";} ?> required>
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
                  <input type="text" class="form-control pull-right datepicker" placeholder="Dari" name="periode_dari" <?php if(!empty($this->session->flashdata('periode_dari'))){ echo "value='".$this->session->flashdata('periode_dari')."'";} ?> required>
                </div>
                <!-- /.input group -->
              </div>
              <div class="col-sm-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" placeholder="Sampai" name="periode_sampai" <?php if(!empty($this->session->flashdata('periode_sampai'))){ echo "value='".$this->session->flashdata('periode_sampai')."'";} ?> required>
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
            <input class="form-control" type="text" name="no_hp"  onkeypress="return isNumberKey(event)" <?php if(!empty($this->session->flashdata('no_hp'))){ echo "value='".$this->session->flashdata('no_hp')."'";} ?>>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">No. WA</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="no_wa"  onkeypress="return isNumberKey(event)" <?php if(!empty($this->session->flashdata('no_wa'))){ echo "value='".$this->session->flashdata('no_wa')."'";} ?>>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">E-Mail</label>
          <div class="col-sm-6">
            <input class="form-control" type="email" name="email" <?php if(!empty($this->session->flashdata('email'))){ echo "value='".$this->session->flashdata('email')."'";} ?>>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Alamat Rumah</label>
          <div class="col-sm-6">
            <textarea class="form-control" name="alamat_rumah"><?php if(!empty($this->session->flashdata('alamat_rumah'))){ echo $this->session->flashdata('alamat_rumah');} ?></textarea>
          </div>
        </div><br>
        <p class="lead col-sm-offset-2">Informasi Lainnya</p>
        <div class="form-group">
          <label class="col-sm-4 control-label">Akun FB</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="akun_fb" <?php if(!empty($this->session->flashdata('akun_fb'))){ echo "value='".$this->session->flashdata('akun_fb')."'";} ?>>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label">Akun Instagram</label>
          <div class="col-sm-6">
            <input class="form-control" type="text" name="akun_instagram" <?php if(!empty($this->session->flashdata('akun_instagram'))){ echo "value='".$this->session->flashdata('akun_instagram')."'";} ?>>
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
