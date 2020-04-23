<?php
  date_default_timezone_set("Asia/Jakarta");
  $tglnow = date("Y/m/d");
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
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Rencana Kerja, <?php echo $tglconvert;  ?></h3>
                <div class="box-tools pull-right">
                  <div class="has-feedback">
                    <?php if($jamsekarang <= $jammenutampil){ ?>
                      <a href="<?php echo base_url();?>c.php/user/tambah" class="btn btn-default btn-sm"><i class="fa fa-plus-square"></i> Tambah</a>
                    <?php } ?>
                    <?php if(($jamsekarang <= $jammenutampil && count($agendasekarang)>0) || ($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate && count($agendasekarang)>0)){
                      $text = "Ubah";
                      if($jamsekarang >= $jammenutampil && $jamsekarang <= $jamupdate){
                        $text = "Evaluasi";
                      }
                    ?>
                    <a href="<?php echo base_url();?>c.php/user/ubah" class="btn btn-default btn-sm"><i class="fa fa-pencil-square-o"></i> <?php echo $text; ?></a>
                    <?php } ?>
                    
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('messageactive') == "agenda"){?>
                  <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <label>Informasi ! </label>
                    <?php echo $this->session->flashdata('messagetext'); ?>
                  </div>
                <?php } ?>
                <!-- Table Bagian Atas -->
                <table id="example2" class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th style="display:none"></th>
                      <th class="text-center">No.</th>
                      <th>Kegiatan</th>
                      <th class="text-center">Waktu</th>
                      <th class="text-center">Status</th>
                      <?php if($jamsekarang <= $jammenutampil){ ?>
                      <th class="text-center">Aksi</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    foreach ($agendasekarang as $loadnow) {
                      $no++;
                    ?>
                    <tr class="record">
                      <td style="display:none" id="kode"><?php echo $loadnow['id_aktifitas']; ?></td>
                      <td class="text-center"><?php echo $no;?></td>
                      <td><?php echo $loadnow['kegiatan'];?></td>
                      <td class="text-center"><?php echo $loadnow['darijam'].' - '.$loadnow['sampaijam'];?></td>
                      <td class="text-center">
                        <?php
                          $status = "Belum Dievaluasi";
                          if($loadnow['status'] == 1){
                            $status = "Selesai";
                          }else if($loadnow['status'] == 2){
                            $status = "Tidak Selesai";
                          }
                          echo $status;
                        ?>
                      </td>
                      <?php if($jamsekarang <= $jammenutampil){ ?>
                      <td class="text-center">
                        <button type="button" class="btnhapus btn btn-default btn-xs" title="Hapus data"><i class="fa fa-trash"></i></button>
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

            <!-- Modal Danger -->
            <div class="modal modal-danger fade" id="modal-danger">
              <!-- Modal Dialog -->
              <div class="modal-dialog">
                <!-- Modal Content -->
                <div class="modal-content">
                  <form method="post" action="" id="hapusform">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Hapus Rencana</h4>
                    </div>
                    <div class="modal-body">
                      <p>Apa anda yakin ingin menghapus data tersebut?</p>
                    </div>
                    <div class="modal-footer">
                      <input type="submit" class="btn btn-danger" value="Hapus"/>
                    </div>
                  </form>
                </div>
                <!-- Finish Modal Content -->
              </div>
              <!-- Finish Modal Dialog -->
            </div>
            <!-- Finish Modal Danger -->

            <!-- Modal Danger -->
            <div class="modal fade" id="modal-info">
              <!-- Modal Dialog -->
              <div class="modal-dialog">
                <!-- Modal Content -->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Informasi</h4>
                  </div>
                  <div class="modal-body">
                    <ol>
                      <li>Rencana kerja di buat sebelum mengerjakan tugas di masing-masing divisi dan dikirim maksimal <b>pukul 09.00 WIB</b></li>
                      <li>Realisasi dari rencana kerja di kirim maksimal <b>pukul 17.00 WIB (jika ada)</b></li>
                      <li>Rencana kerja di buat sebelum mengerjakan tugas di masing-masing divisi dan dikirim maksimal pukul 09.00</li>
                      <li>Apabila tidak membuat rencana kerja dan mengirim realisasi dari rencana kerja maka akan mengurangi nilai PKT</li>
                    </ol>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Oke, mengerti</button>
                  </div>
                </div>
                <!-- Finish Modal Content -->
              </div>
              <!-- Finish Modal Dialog -->
            </div>
            <!-- Finish Modal Danger -->

            <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
            <script type="text/javascript">
              $(".btnhapus").click(function(event) {
                  var record = $(this).parents('.record');
                  $("#hapusform").attr("action", "<?php echo base_url()."c.php/user/hapus/" ?>"+record.find('#kode').html());
                  $('#modal-danger').modal('show');
              });
            </script>
