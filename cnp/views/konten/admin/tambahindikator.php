<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Indikator Penilaian
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>c.php/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo base_url(); ?>c.php/admin/indikator">Indikator Penilaian</a></li>
    <li class="active">Tambah</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <?php if($this->session->flashdata('messageactive') == "tambahindikator"){?>
    <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
      <label>Informasi ! </label>
      <?php echo $this->session->flashdata('messagetext'); ?>
    </div>
  <?php } ?>
  <form action="" method="post">
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Data</h3>
        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="submit" class="btn btn-default btn-sm" name="simpan" value="Simpan Data">
          </div>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Bidang</label>
              <select class="form-control select2" name="nama_bidang" required>
                <?php foreach ($loadbidang as $loadkey) {?>
                <option value="<?php echo $loadkey['id_bidang'];?>"><?php echo $loadkey['nama_bidang'];?></option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Kategori</label>
              <select class="form-control select2" name="nama_kategori" required>
                <?php foreach ($loadkategori as $loadkey1) {?>
                <option value="<?php echo $loadkey1['id_kategori'];?>"><?php echo $loadkey1['nama_kategori'];?></option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
        <table  class="table table-bordered" width="100%">
          <thead>
            <tr>
              <th class="text-center" style="width:10px;">No.</th>
              <th>Nama Indikator</th>
            </tr>
          </thead>
          <tbody>
            <?php for ($i=1; $i < 11; $i++) { ?>
              <tr>
                <td class="text-center"><?php echo $i;?></td>
                <td><input class="form-control" type="text" name="nama_indikator[]" value=""></td>
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
