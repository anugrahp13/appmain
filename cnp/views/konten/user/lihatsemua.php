
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Rencana Kerja, <?php echo date("j F Y", strtotime($this->session->userdata('tglcheck'))); ?></h3>
                <div class="box-tools pull-right">
                  <div class="has-feedback">
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <!-- Table Bagian Atas -->
                <table id="example2" class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th style="display:none"></th>
                      <th>Status</th>
                      <th>Kegiatan</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($loaddata as $loadsemua) {
                    ?>
                    <tr class="record">
                      <td style="display:none" id="kode"><?php echo $loadsemua['id_aktifitas']; ?></td>
                      <td>
                        <?php
                          $status = "Belum Dievaluasi";
                          if($loadsemua['status'] == 1){
                            $status = "Selesai";
                          }else if($loadsemua['status'] == 2){
                            $status = "Tidak Selesai";
                          }
                          echo $status;
                        ?>
                      </td>
                      <td><?php echo $loadsemua['kegiatan']; ?></td>
                      <td class="text-center">
                        <button class="btnview btn btn-default btn-xs" title="Lihat Detail"><i class="fa fa-eye"></i></button>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->

            <!-- Modal Danger -->
            <div class="modal fade" id="modal-view">
              <!-- Modal Dialog -->
              <div class="modal-dialog modal-sm">
                <!-- Modal Content -->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detail Rencana</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label>Kegiatan</label>
                      <input type="text" class="form-control" id="e_kegiatan" readonly/>
                    </div>
                    <div class="form-group">
                      <label>Waktu (d/s)</label>
                      <div class="row">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="e_dari" readonly/>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="e_sampai" readonly/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <input type="text" class="form-control" id="e_status" readonly/>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control" readonly id="e_keterangan"></textarea>
                    </div>
                  </div>

                </div>
                <!-- Finish Modal Content -->
              </div>
              <!-- Finish Modal Dialog -->
            </div>
            <!-- Finish Modal Danger -->

            <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
            <script type="text/javascript">
              $(".btnview").click(function(event) {
                  var record = $(this).parents('.record');
                  $.getJSON('<?php echo base_url()."c.php/user/tampil/" ?>'+record.find('#kode').html(), function(data) {
                    $("#e_kegiatan").val(data.kegiatan);
                    $("#e_dari").val(data.darijam);
                    $("#e_sampai").val(data.sampaijam);
                    $("#e_status").val(data.status);
                    $("#e_keterangan").val(data.keterangan);
                  });
                  $('#modal-view').modal('show');
              });
            </script>
