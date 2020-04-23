
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-md-5">
                    <label>Nama Ujian</label>
                    <p class="text-muted">
                      <?php if(!empty($loadheader['nama_ujian'])){echo $loadheader['nama_ujian'];}else{ echo "-";} ?>
                    </p>
                  </div>
                  <div class="col-md-4">
                    <label>Tanggal Ujian</label>
                    <p class="text-muted">
                      <?php if(!empty($loadheader['tgl_ujian'])){echo date("j F Y", strtotime($loadheader['tgl_ujian']));}else{ echo "-";} ?>
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
                <form method="post" action="">
                  <div class="col-md-10 col-sm-offset-1">
                    <?php
                      $loadbab = $this->global_model->query("select id_headersoal,bab_soal,bobot from konten_ujian where id_headersoal='".$loadheader['id_headersoal']."' group by bab_soal");
                      foreach ($loadbab as $keybab) {
                    ?>
                    <p class="lead"><?php echo $keybab['bab_soal']." (".$keybab['bobot']."%)"; ?></p>
                    <?php
                      $no = 0;
                      foreach ($this->global_model->find_all_by('konten_ujian', array('bab_soal'=>$keybab['bab_soal'])) as $keysub) {
                        $no++;
                    ?>
                    <label class="control-label"><?php echo $no.". ".$keysub['soal']; ?></label><br>
                    <textarea name="<?php echo $keysub['id_kontenujian'] ?>" rows="5" class="form-control" placeholder="Jawab Soal"></textarea><br>
                    <?php
                        }
                      }
                    ?>
                    <div class="form-group">
                      <div class="col-sm-6 col-sm-offset-5">
                        <input type="submit" class="btn btn-primary" name="simpan" value="Selesai">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
