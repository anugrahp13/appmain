<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>C & P | Pengelola</title>
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
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url(); ?>c.php/admin/rencanakerja" class="navbar-brand"><b>C & P</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <?php
          //aktif menu
          $getsegment = $this->uri->segment(2);
          $getsegment2 = $this->uri->segment(3);
        ?>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li<?php if($getsegment == "rencanakerja"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/rencanakerja"><i class="fa fa-paper-plane"></i> Rencana Kerja</a></li>
            <li<?php if($getsegment == "penilaian"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/penilaian"><i class="fa fa-book"></i> Penilaian</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-pencil"></i> Ujian <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li<?php if($getsegment == "ujian"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/ujian"><i class="fa fa-edit"></i> Ujian</a></li>
                <li<?php if($getsegment == "reviewjawaban"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/reviewjawaban"><i class="fa fa-file-text"></i> Lihat Jawaban Ujian</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-print"></i> Cetak Data <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li<?php if($getsegment == "cetakpkt"){echo " class='active'"; } ?>><a href="<?php echo base_url();?>c.php/admin/cetakpkt"><i class="fa fa-user"></i> Cetak Peserta PKT</a></li>
                <li<?php if($getsegment == "cetakpenilaian"){echo " class='active'"; } ?>><a href="<?php echo base_url();?>c.php/admin/cetakpenilaian"><i class="fa fa-book"></i> Cetak Penilaian</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-folder-open"></i> Master <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li<?php if($getsegment == "datapkt"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/datapkt"><i class="fa fa-users"></i> Data Peserta PKT</a></li>
                <li<?php if($getsegment == "master" && $getsegment2 == "konsentrasi"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/master/konsentrasi"><i class="fa fa-black-tie"></i> Data Konsentrasi</a></li>
                <li<?php if($getsegment == "master" && $getsegment2 == "bidang"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/master/bidang"><i class="fa fa-briefcase"></i> Data Bidang</a></li>
                <li class="divider"></li>
                <li<?php if($getsegment == "master" && $getsegment2 == "kategoripenilaian"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/master/kategoripenilaian"><i class="fa fa-sitemap"></i> Kategori Penilaian</a></li>
                <li<?php if($getsegment == "indikator"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/indikator"><i class="fa fa-check-square-o"></i> Indikator Penilaian</a></li>
                <li class="divider"></li>
                <li<?php if($getsegment == "kelolaakun"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/kelolaakun"><i class="fa fa-user"></i> Kelola Akun</a></li>
                <li<?php if($getsegment == "p_waktu"){echo " class='active'"; } ?>><a href="<?php echo base_url(); ?>c.php/admin/p_waktu"><i class="fa fa-gears"></i> Pengaturan Waktu</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url(); ?>assets/image/<?php if(!empty($this->session->userdata('img'))){echo $this->session->userdata('img');}else{echo "default.png";} ?>" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $this->session->userdata('nama_lengkap'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>assets/image/<?php if(!empty($this->session->userdata('img'))){echo $this->session->userdata('img');}else{echo "default.png";} ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('nama_lengkap'); ?>
                    <small>
                      <?php
                        $adata = array(
                          '3' => "Kepala Bidang C & P",
                          '4' => "Staff C & P",
                          '100' => "Kepala Kampus",
                          '99' => "Wakil Kepala Kampus"
                        );

                        if($adata[$this->session->userdata('id_jabatan')]!= null){echo $adata[$this->session->userdata('id_jabatan')];}
                        else{ echo "-";}
                      ?>
                    </small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-right">
                    <a href="<?php echo base_url(); ?>index.php/login/logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
