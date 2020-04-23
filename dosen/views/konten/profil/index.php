<!-- =============================================== -->
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Profil Saya
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url();?>d.php/dash"><i class="fa fa-dashboard"></i> Halaman Awal</a></li>
      <li class="active">Profil Saya</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <?php if($this->session->flashdata('messageactive') == "profil"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <!-- Default box -->
    <div class="box">
      <div class="box-body">
        <div class="row">
          <div class="col-md-9">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <div class="form-group">
                <label class="col-sm-3 control-label">Nama Lengkap</label>
                <div class="col-sm-7">
                  <input class="form-control" type="text" value="<?php if($profil[0]['nama_lengkap']!=""){echo $profil[0]['nama_lengkap'];} ?>" name="nama_lengkap" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Nama Pengguna</label>
                <div class="col-sm-4">
                  <input class="form-control" type="text" value="<?php if($profil[0]['nama_pengguna']!=""){echo $profil[0]['nama_pengguna'];} ?>" name="nama_pengguna" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-7">
                  <input class="form-control" type="email" value="<?php if($profil[0]['email']!=""){echo $profil[0]['email'];} ?>" name="email">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">No Telp</label>
                <div class="col-sm-4">
                  <input class="form-control" type="text" value="<?php if($profil[0]['no_tlp']!=""){echo $profil[0]['no_tlp'];} ?>" name="no_tlp">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Foto Profil</label>
                <div class="col-sm-7">
                  <input type="file" name="img">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <p>* Ukuran file maksimal 500kb</p>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Kata sandi</label>
                <div class="col-sm-5">
                  <input class="form-control" type="text" name="kata_sandi">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <p>* isi kata sandi jika ingin mengubah kata sandi</p>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <input type="submit" class="btn btn-default" name="simpan" value="Perbarui Profil">
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-3">
            <img class="img-square img-responsive" src="<?php echo base_url();?>assets/image/<?php echo $profil[0]['img']; ?>" width="200" height="200">
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
