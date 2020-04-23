<?php
  date_default_timezone_set("Asia/Jakarta");
  $tglnow = date("m/d/Y");
  $tglconvert = date("j F Y", strtotime($tglnow));
  $jamsekarang = date("H:i");
  $jammenutampil = "09:00";
  $jamupdate = "17:00";

  if(!empty($loadwaktudasar)){
    if(!empty($loadwaktudasar['jam_buat'])){
      $jammenutampil = $loadwaktudasar['jam_buat'];
    }
    if(!empty($loadwaktudasar['evaluasi_jam'])){
      $jamupdate = $loadwaktudasar['evaluasi_jam'];
    }
  }
?>
<form method="post" action="">
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">
      <?php if(($jamsekarang <= $jammenutampil) || ($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate)){
        $text = "Ubah Rencana";
        if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){
          $text = "Evaluasi Rencana";
        }

        echo $text.','.' '.$tglconvert;
      }
      ?>
    </h3>
    <div class="box-tools pull-right">
      <div class="has-feedback">
        <input type="submit" class="btn btn-default btn-sm" name="btnubah" value="Simpan Data">
      </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <?php if($this->session->flashdata('messageactive') == "ubahagenda"){?>
      <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <label>Informasi ! </label>
        <?php echo $this->session->flashdata('messagetext'); ?>
      </div>
    <?php } ?>
    <table  class="table table-bordered">
      <thead>
        <tr>
          <th style="display:none;"></th>
          <th>Nama Kegiatan</th>
          <th>Dari Jam</th>
          <th>Sampai Jam</th>
          <?php if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){ ?>
          <th>Status</th>
          <th>Keterangan</th>
          <?php }?>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 0;
        foreach ($agenda as $key) {
          $no++;
        ?>
          <tr>
            <td style="display:none;"><input type="form-control" type="text" name="id_aktifitas[]" value="<?php echo $key['id_aktifitas']; ?>"></td>
            <td width="200">
              <?php
                if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){
                  echo $key['kegiatan'];
                }else{ ?>
                  <input class="form-control" type="text" name="kegiatan[]" value="<?php echo $key['kegiatan']; ?>">
              <?php }
              ?>
            </td>
            <td width="80">
              <?php
                if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){
                  echo $key['darijam'];
                }else{ ?>
                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="darijam[]" value="<?php echo $key['darijam'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
              <?php }
              ?>
            </td>
            <td width="100">
              <?php
                if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){
                  echo $key['sampaijam'];
                }else{ ?>
                  <!-- time Picker -->
                  <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="sampaijam[]" value="<?php echo $key['sampaijam'];?>">
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
              <?php }
              ?>
            </td>
            <?php if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){ ?>
            <td width="120">
              <select name="status[]" class="form-control">
                <option value="0" <?php if($key['status'] == 0){echo "selected";} ?>>Belum Dievaluasi</option>
                <option value="1" <?php if($key['status'] == 1){echo "selected";} ?>>Selesai</option>
                <option value="2" <?php if($key['status'] == 2){echo "selected";} ?>>Tidak Selesai</option>
              </select>
            </td>
            <td width="150">
              <input class="form-control" placeholder="optional" type="text" name="keterangan[]" value="<?php echo $key['keterangan']; ?>">
            </td>
            <?php } ?>
          </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /. box -->
</form>
