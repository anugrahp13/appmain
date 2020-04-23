<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ujian
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/ujian">Ujian</a></li>
    <li class="active">Tambah Soal</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "tambahsoal"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <form action="" method="post">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Soal</h3>
        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="submit" class="btn btn-default btn-sm" name="simpan" value="Simpan Data">
          </div>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>Bab Soal</label>
              <input type="text" name="bab_soal" class="form-control">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>Bobot</label>
              <input type="text" name="bobot" class="form-control" onkeypress="return isNumberKey(event)">
            </div>
          </div>
        </div>
        <table  class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th class="text-center" style="width:10px;">No.</th>
              <th>Teks Soal</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=1; $i < 11; $i++) { ?>
              <tr>
                <td class="text-center"><?php echo $i;?></td>
                <td><input class="form-control" type="text" name="soal[]" value=""></td>
              </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </form>
</section>
<!-- /.content -->
