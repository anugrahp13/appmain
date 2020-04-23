<?php
  date_default_timezone_set("Asia/Jakarta");
  $tglnow = date("m/d/Y");
  $tglconvert = date("j F Y", strtotime($tglnow));
?>
<form method="post" action="<?php echo base_url(); ?>c.php/user/tambah">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Tambah Rencana, <?php echo $tglconvert;  ?></h3>
    <div class="box-tools pull-right">
      <div class="has-feedback">
        <input type="submit" class="btn btn-default btn-sm" name="simpan" value="Simpan Data">
      </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <?php if($this->session->flashdata('messageactive') == "tambahagenda"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <table  class="table table-bordered">
      <thead>
        <tr>
          <th class="text-center">No.</th>
          <th>Nama Kegiatan</th>
          <th>Dari Jam</th>
          <th>Sampai Jam</th>
        </tr>
      </thead>
      <tbody>
        <?php for ($i=1; $i < 11; $i++) { ?>
          <tr>
            <td class="text-center"><?php echo $i;?></td>
            <td><input class="form-control" type="text" name="kegiatan[]" value=""></td>
            <td>
              <!-- time Picker -->
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="darijam[]">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
            </td>
            <td>
              <!-- time Picker -->
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control timepicker" name="sampaijam[]">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
            </td>
          </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /. box -->
</form>
