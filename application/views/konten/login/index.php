<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>LP3I Pondok Gede</b></a>
  </div>
  <?php if($this->session->flashdata('messageactive') == "login"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan login terlebih dahulu</p>

    <form action="" method="post">
      <?php $a = $this->session->flashdata('nama_pengguna');?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nama_pengguna" <?php if($a != ""){ echo "value='".$a."'";} ?> placeholder="Nama Pengguna">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="kata_sandi" placeholder="Kata Sandi">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <input class="btn btn-primary btn-block btn-flat" type="submit" name="login" value="Masuk">
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
