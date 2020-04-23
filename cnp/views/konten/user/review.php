
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-md-5">
                    <label>Nama Ujian</label>
                    <p class="text-muted">
                      <?php if(!empty($loadheader['nama_ujian'])){echo $loadheader['nama_ujian'];}else{ echo "-";} ?>
                    </p>
                  </div>
                  <div class="col-md-3">
                    <label>Tanggal Ujian</label>
                    <p class="text-muted">
                      <?php if(!empty($loadheader['tgl_ujian'])){echo $loadheader['tgl_ujian'];}else{ echo "-";} ?>
                    </p>
                  </div>
                  <div class="col-md-3">
                    <label>Waktu Pelaksanaan</label>
                    <p class="text-muted">
                      <?php
                        $jammulai = "-";
                        $jamakhir = "-";
                        if(!empty($loadheader['jam_mulai'])){
                          $jammulai = $loadheader['jam_mulai'];
                        }
                        if(!empty($loadheader['jam_akhir'])){
                          $jamakhir = $loadheader['jam_akhir'];
                        }
                        echo $jammulai." - ".$jamakhir;
                      ?>
                    </p>
                  </div>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('messageactive') == "profil"){?>
                  <div class='alert alert-<?php echo $this->session->flashdata('messagemode'); ?> fade in'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                    <label>Informasi ! </label>
                    <?php echo $this->session->flashdata('messagetext'); ?>
                  </div>
                <?php } ?>
                <br>
                  <div class="col-md-10 col-sm-offset-1">
                    <?php
                      $loadbab = $this->global_model->query("select id_headersoal,bab_soal,bobot from konten_ujian where id_headersoal='".$loadheader['id_headersoal']."' group by bab_soal");
                      foreach ($loadbab as $keybab) {
                    ?>
                    <p class="lead"><?php echo str_replace('-',' ',$keybab['bab_soal'])." (".$keybab['bobot']."%)"; ?></p>
                    <?php
                      $no = 0;
                      foreach ($this->global_model->find_all_by('konten_ujian', array('bab_soal'=>$keybab['bab_soal'])) as $keysub) {
                        $no++;
                    ?>
                    <label class="control-label"><?php echo $no.". ".$keysub['soal']; ?></label><br>
                    <p class="text-muted">Jawaban : </p>
                    <p class="text-muted">
                      <?php
                        $jawaban = $this->global_model->find_by('j_pesertaujian', array('id_kontenujian'=>$keysub['id_kontenujian']));
                        if(!empty($jawaban)){
                          echo $jawaban['jawaban'];
                        }else{
                          echo "-";
                        }
                      ?>
                    </p><br>
                    <?php
                        }
                      }
                    ?>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
