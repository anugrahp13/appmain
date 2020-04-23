
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Daftar Tes</h3>
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
                      <th class="text-center" width="10">No.</th>
                      <th>Nama Ujian</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Waktu Pelaksanaan</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0;
                    $loaddata = $this->global_model->find_all_by('partisipasi_ujian', array('id_profil'=>$id_profilbro));
                    foreach ($loaddata as $loadoc) {
                      $no++;
                      $loadnow = $this->global_model->find_by('header_ujian',array('id_headersoal'=>$loadoc['id_headersoal']));
                      if(!empty($loadnow)){
                    ?>
                    <tr class="record">
                      <td class="text-center"><?php echo $no; ?></td>
                      <td><?php echo $loadnow['nama_ujian']; ?></td>
                      <td class="text-center"><?php echo $loadnow['tgl_ujian']; ?></td>
                      <td class="text-center"><?php echo $loadnow['jam_mulai']." - ".$loadnow['jam_akhir']; ?></td>
                      <td class="text-center">
                        <?php
                          date_default_timezone_set("Asia/Jakarta");
                          $tglnow = date("m/d/Y");
                          $jamsekarang = date("H:i");

                          $status = 0;
                          $checktable = $this->global_model->find_by('j_pesertaujian',array('id_headersoal'=>$loadnow['id_headersoal'],'id_profil'=>$id_profilbro));
                          if(!empty($checktable)){
                            $status = 3;
                          }else if(strtotime($loadnow['tgl_ujian']) == strtotime($tglnow)){
                            if($jamsekarang >= $loadnow['jam_mulai'] && $jamsekarang <= $loadnow['jam_akhir']){
                              $status = 1;
                            }
                          }else if(strtotime($tglnow) < strtotime($loadnow['tgl_ujian'])){
                            $status = 2;
                          }

                          if($status == 0){
                            echo "Tidak Mengikuti";
                          }else if($status == 2){
                            echo "Belum dimulai";
                          }else if($status == 3){?>
                            <a class="btn btn-default btn-xs" href="<?php echo base_url();?>c.php/user/review/<?php echo $loadnow['id_headersoal']; ?>">Lihat Jawaban</a>
                          <?php }
                          else if($status == 1){?>
                            <a class="btn btn-default btn-xs" href="<?php echo base_url();?>c.php/user/tes/<?php echo $loadnow['id_headersoal']; ?>">Mulai Tes</a>
                        <?php }
                        ?>
                      </td>
                    </tr>
                    <?php }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
