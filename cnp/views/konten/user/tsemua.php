
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Semua Rencana Kerja</h3>
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
                      <th>Tanggal</th>
                      <th class="text-center">Banyak Rencana</th>
                      <th class="text-center">Selesai</th>
                      <th class="text-center">Tidak Selesai</th>
                      <th class="text-center">Belum Dievaluasi</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Set timezone
                  	date_default_timezone_set('Asia/Jakarta');

                  	// Start date
                  	$date = $pktprofil['periode_dari'];
                  	// End date
                  	$end_date = $pktprofil['periode_sampai'];
                  	while (strtotime($date) <= strtotime($end_date)) {
                      $jrencana = count($this->global_model->find_all_by('u_aktifitas',array('tanggal'=>$date,'id_profil'=>$pktprofil['id_profil'])));
                      $jselesai = count($this->global_model->find_all_by('u_aktifitas',array('tanggal'=>$date,'id_profil'=>$pktprofil['id_profil'],'status'=>1)));
                      $jtselesai = count($this->global_model->find_all_by('u_aktifitas',array('tanggal'=>$date,'id_profil'=>$pktprofil['id_profil'],'status'=>2)));
                      $jbselesai = count($this->global_model->find_all_by('u_aktifitas',array('tanggal'=>$date,'id_profil'=>$pktprofil['id_profil'],'status'=>0)));
                    ?>
                    <tr class="record">
                      <td><?php echo date("j F Y", strtotime($date)); ?></td>
                      <td class="text-center"><?php echo $jrencana; ?></td>
                      <td class="text-center"><?php echo $jselesai; ?></td>
                      <td class="text-center"><?php echo $jtselesai; ?></td>
                      <td class="text-center"><?php echo $jbselesai;  ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url(); ?>c.php/user/semua/lihat/<?php echo str_replace("/","-",$date); ?>" class="btnview btn btn-default btn-xs" title="Lihat daftar rencana"><i class="fa fa-eye"></i></a>
                      </td>
                    </tr>
                    <?php
                      $date = date ("m/d/Y", strtotime("+1 day", strtotime($date)));
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->

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
                  $('#modal-danger').modal('show');
              });
            </script>
