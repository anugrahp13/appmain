<?php
  $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
  if(!empty($akun)){
    if(!empty($akun['id_profil'])){
      $pktprofil = $this->global_model->find_by('pkt_profil', array('id_profil'=>$akun['id_profil']));
    }
  }

  $jrencana = count($this->global_model->find_all_by('u_aktifitas',array('id_profil'=>$pktprofil['id_profil'])));
  $jselesai = count($this->global_model->find_all_by('u_aktifitas',array('id_profil'=>$pktprofil['id_profil'],'status'=>1)));
  $jtselesai = count($this->global_model->find_all_by('u_aktifitas',array('id_profil'=>$pktprofil['id_profil'],'status'=>2)));
  $jbselesai = count($this->global_model->find_all_by('u_aktifitas',array('id_profil'=>$pktprofil['id_profil'],'status'=>0)));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PKT Aktifitas</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--favicon -->
    <link href="<?php echo base_url();?>assets/admin/skin/img/icon_lp3i.ico" type="image/gif" rel="icon">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/iCheck/flat/blue.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/timepicker/bootstrap-timepicker.min.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

    <!-- Google Font -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 <style>
 textarea{
   resize:none;
 }
 </style>
  </head>
  <body style="background-image:url('<?php echo base_url();?>assets/paisley.png');">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          C & P
          <small>PKT Aktifitas</small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-solid">
              <!-- /.box-header -->
              <div class="box-header with-border">
                <div class="user-panel">
                  <div class="pull-left image">
                    <img src="<?php echo base_url(); ?>assets/image/<?php if(!empty($pktprofil['img'])){echo $pktprofil['img'];}else{echo "default.png";} ?>" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                    <p><?php echo $pktprofil['nama_lengkap']; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
                </div>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li<?php if($this->uri->segment(2) == "profil"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/user/profil"><i class="fa fa-user"></i> Profil Saya</a></li>
                  <li><a href="<?php echo base_url(); ?>index.php/login/logout"><i class="fa fa-sign-out"></i> Keluar</a></li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>

            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Rencana Kerja</h3>

                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body no-padding">
                <?php
                  date_default_timezone_set("Asia/Jakarta");
                  $tglnow = date("m/d/Y");
                  //aktif menu
                  $getsegment = $this->uri->segment(2);
                  $akun = $this->global_model->find_by('pkt_akun', array('id_akun'=>$this->session->userdata('id_akun')));
                  $idprofil = "";
                  $tutup = 0;
                  if(!empty($akun)){
                    if(!empty($akun['id_profil'])){
                      $idprofil = $this->global_model->find_by('pkt_profil', array('id_profil'=>$akun['id_profil']));
                    }
                  }

                  if(!empty($idprofil)){
                    if(!empty($idprofil['periode_dari'] || !empty($idprofil['periode_sampai']))){
                      if(strtotime($tglnow) > strtotime($idprofil['periode_dari']) && strtotime($tglnow) > strtotime($idprofil['periode_sampai'])){
                        $tutup = 1;
                      }
                    }
                  }
                ?>
                <ul class="nav nav-pills nav-stacked">
                  <?php if($tutup == 0 ){?>
                  <li<?php if($getsegment == "dash" || $getsegment == "ubah" || $getsegment == "tambah" || $getsegment == ""){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/user"><i class="fa fa-clock-o"></i> Hari Ini</a></li>
                  <?php } ?>
                  <li<?php if($getsegment == "semua"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/user/semua"><i class="fa fa-calendar"></i> Semua <span class="label label-primary pull-right"><?php echo $jrencana; ?></span></a></li>
                  <li<?php if($getsegment == "selesai"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/user/selesai"><i class="fa fa-check-square-o"></i> Selesai <span class="label label-success pull-right"><?php echo $jselesai;?></span></a></li>
                  <li<?php if($getsegment == "tidakselesai"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/user/tidakselesai"><i class="fa fa-calendar-times-o "></i> Tidak Selesai <span class="label label-danger pull-right"><?php echo $jtselesai; ?></span></a></li>
                  <li<?php if($getsegment == "belumevaluasi"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/user/belumevaluasi"><i class="fa fa-edit "></i> Belum Dievaluasi <span class="label label-warning pull-right"><?php echo $jbselesai;?></span></a></li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Lainnya</h3>

                <div class="box-tools">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li<?php if($getsegment == "tes"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/user/tes"><i class="fa fa-book"></i> Tes Saya</a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
