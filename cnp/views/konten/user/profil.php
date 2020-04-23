
            <div class="box box-primary">
              <div class="box-header with-border">
                <div class="row">
                  <div class="col-md-2">
                    <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url(); ?>assets/image/<?php if(!empty($loaddata['img'])){echo $loaddata['img'];}else{echo "default.png";} ?>" alt="User profile picture">
                  </div>
                  <div class="col-md-3">
                    <label>Nama Lengkap</label>
                    <p class="text-muted">
                      <?php if(!empty($loaddata['nama_lengkap'])){echo $loaddata['nama_lengkap'] ;}else{echo "-";} ?>
                    </p>
                    <label>NIM</label>
                    <p class="text-muted">
                      <?php if(!empty($loaddata['nim'])){echo $loaddata['nim'] ;}else{echo "-";} ?>
                    </p>
                  </div>
                  <div class="col-md-3">
                    <label>Bidang</label>
                    <p class="text-muted">
                      <?php
                        $getbidang = $this->global_model->find_by('m_bidang', array('id_bidang'=>$loaddata['id_bidang']));
                        if(!empty($getbidang)){
                          echo $getbidang['nama_bidang'];
                        }
                      ?>
                    </p>
                    <label>Konsentrasi / Semester</label>
                    <p class="text-muted">
                      <?php
                        $getkonsentrasi = $this->global_model->find_by('m_konsentrasi', array('id_konsentrasi'=>$loaddata['id_konsentrasi']));
                        if(!empty($getkonsentrasi)){
                          echo $getkonsentrasi['nama_konsentrasi']." / ";
                        }
                        echo $loaddata['semester'];
                      ?>
                    </p>
                  </div>
                  <div class="col-md-3">
                    <label>Tahun Ajaran</label>
                    <p class="text-muted"><?php echo $loaddata['tahun_ajaran'];?></p>
                    <label>Periode</label>
                    <p class="text-muted">
                      <?php
                        echo $loaddata['periode_dari']." - ".$loaddata['periode_sampai'];
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
                <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
                  <p class="lead col-sm-offset-2">Informasi Akun</p>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Nama Pengguna</label>
                    <div class="col-sm-6">
                      <?php $getid = $this->global_model->find_by('pkt_akun',array('id_akun'=>$this->session->userdata('id_akun')));?>
                      <input class="form-control" type="text" name="nama_pengguna" <?php if(!empty($getid['nama_pengguna'])){ echo "value='".$getid['nama_pengguna']."'";} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Sandi Saat ini</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="password" name="sandi_ini" placeholder="Isi jika ingin mengganti kata sandi">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Sandi baru</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="password" name="sandi_baru">
                    </div>
                  </div><br>
                  <p class="lead col-sm-offset-2">Informasi Pribadi</p>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Jenis Kelamin</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="jenis_kelamin">
                        <option value="l" <?php if($loaddata['jenis_kelamin'] == "l"){ echo "selected";} ?>>Laki-Laki</option>
                        <option value="p" <?php if($loaddata['jenis_kelamin'] == "p"){ echo "selected";} ?>>Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tempat Lahir</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="text" name="tempat_lahir" <?php if(!empty($loaddata['tempat_lahir'])){ echo "value='".$loaddata['tempat_lahir']."'";} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Tanggal Lahir</label>
                    <div class="col-sm-6">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right datepicker" name="tgl_lahir" <?php if(!empty($loaddata['tgl_lahir'])){ echo "value='".$loaddata['tgl_lahir']."'";} ?>>
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Agama</label>
                    <div class="col-sm-6">
                      <select class="form-control" name="agama">
                        <option value="is" <?php if($loaddata['agama'] == "is"){ echo "selected";}?>>Islam</option>
                        <option value="pr" <?php if($loaddata['agama'] == "pr"){ echo "selected";}?>>Protestan</option>
                        <option value="ka" <?php if($loaddata['agama'] == "ka"){ echo "selected";}?>>Katolik</option>
                        <option value="hi" <?php if($loaddata['agama'] == "hi"){ echo "selected";}?>>Hindu</option>
                        <option value="bu" <?php if($loaddata['agama'] == "bu"){ echo "selected";}?>>Buddha</option>
                        <option value="kh" <?php if($loaddata['agama'] == "kh"){ echo "selected";}?>>Khonghucu</option>
                        <option value="la" <?php if($loaddata['agama'] == "la"){ echo "selected";}?>>Lainnya</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Foto Profil</label>
                    <div class="col-sm-6">
                      <input type="file" name="img">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-6">
                      * Ukuran file maksimal 500kb
                    </div>
                  </div><br>
                  <p class="lead col-sm-offset-2">Informasi Kontak</p>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">No. HP</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="text" name="no_hp"  onkeypress="return isNumberKey(event)" <?php if(!empty($loaddata['no_hp'])){ echo "value='".$loaddata['no_hp']."'";} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">No. WA</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="text" name="no_wa"  onkeypress="return isNumberKey(event)" <?php if(!empty($loaddata['no_wa'])){ echo "value='".$loaddata['no_wa']."'";} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">E-Mail</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="email" name="email" <?php if(!empty($loaddata['email'])){ echo "value='".$loaddata['email']."'";} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Alamat Rumah</label>
                    <div class="col-sm-6">
                      <textarea class="form-control" name="alamat_rumah"><?php if(!empty($loaddata['alamat_rumah'])){ echo $loaddata['alamat_rumah'];} ?></textarea>
                    </div>
                  </div><br>
                  <p class="lead col-sm-offset-2">Informasi Lainnya</p>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Akun FB</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="text" name="akun_fb" <?php if(!empty($loaddata['akun_fb'])){ echo "value='".$loaddata['akun_fb']."'";} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label">Akun Instagram</label>
                    <div class="col-sm-6">
                      <input class="form-control" type="text" name="akun_instagram" <?php if(!empty($loaddata['akun_instagram'])){ echo "value='".$loaddata['akun_instagram']."'";} ?>>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-6">
                      <input type="submit" class="btn btn-primary" name="simpan" value="Simpan data">
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
