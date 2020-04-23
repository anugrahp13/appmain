<!-- Modal Login Box -->
<div class="login-box">
  <!-- Login Logo -->
  <div class="login-logo">
    <a href="#"><b>App</b>Dosen</a>
  </div>
  <!-- Finish Login Logo -->

  <?php if($this->session->flashdata('messageactive') == "login"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>

  <!-- Login Box Body -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan masuk untuk memulai sesi Anda</p>

    <form action="" method="post">
      <?php $a = $this->session->flashdata('nama_pengguna');?>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nama_pengguna" <?php if($a != ""){ echo "value='".$a."'";} ?> placeholder="Nama pengguna">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="kata_sandi" placeholder="Kata sandi">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <!-- Row -->
      <div class="row">
        <div class="col-xs-8">
        </div>
        <div class="col-xs-4">
          <input class="btn btn-primary btn-block btn-flat" type="submit" name="login" value="Masuk">
        </div>
      </div>
      <!-- Finish Row -->
    </form>
  </div>
  <!-- Finish Login Box Body -->
</div>
<!-- Finish Login Box -->