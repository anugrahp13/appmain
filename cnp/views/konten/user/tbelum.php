
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Rencana kerja yang belum dievaluasi</h3>
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
                      <th>Tanggal</th>
                      <th>Kegiatan</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($loaddata as $loadnow) {
                    ?>
                    <tr class="record">
                      <td style="display:none" id="kode"><?php echo $loadnow['id_aktifitas']; ?></td>
                      <td><?php echo date("j F Y", strtotime($loadnow['tanggal'])); ?></td>
                      <td><?php echo $loadnow['kegiatan']; ?></td>
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
                      <textarea class="form-control" disabled style="resize:none;" id="e_kegiatan"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Waktu (d/s)</label>
                      <div class="row">
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="e_dari" disabled/>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="e_sampai" disabled/>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Tanggal</label>
                      <input type="text" class="form-control" id="e_tgl" disabled/>
                    </div>
                    <div class="form-group">
                      <label>Keterangan</label>
                      <textarea class="form-control" disabled style="resize:none;" id="e_keterangan"></textarea>
                    </div>
                  </div>

                </div>
                <!-- Finish Modal Content -->
              </div>
              <!-- Finish Modal Dialog -->
            </div>

            <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
            <script type="text/javascript">
              $(".btnview").click(function(event) {
                  var record = $(this).parents('.record');
                  $.getJSON('<?php echo base_url()."c.php/user/tampil/" ?>'+record.find('#kode').html(), function(data) {
                    $("#e_kegiatan").val(data.kegiatan);
                    $("#e_dari").val(data.darijam);
                    $("#e_sampai").val(data.sampaijam);
                    $("#e_tgl").val(data.tanggal);
                    $("#e_keterangan").val(data.keterangan);
                  });
                  $('#modal-view').modal('show');
              });
            </script>
