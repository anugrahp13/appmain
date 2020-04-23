<?php
  //get segment, untuk aktif menu
  $id = $this->uri->segment(1);

  $session = array(
    'id_akun' => $this->session->userdata('id_akun'),
    'status' => $this->session->userdata('status'),
    'nama_pengguna' => $this->session->userdata('nama_pengguna'),
    'nama_lengkap' => $this->session->userdata('nama_lengkap'),
    'id_divisi' => $this->session->userdata('id_divisi'),
    'id_jabatan' => $this->session->userdata('id_jabatan'),
    'img' => $this->session->userdata('img')
  );

  $idakun = $this->session->userdata('id_akun');
  //$session = $this->global_model->find_by('akun_profil', array('id_akun'=>$idakun));

  $title = array(
    'dash' => 'Dashboard',
    'profil' => 'Profil Saya',
    'dosen' => 'Data Dosen',
    'sesikuliah' => 'Sesi Kuliah',
    'praktisi' => 'Praktisi',
    'pendidikan' => 'Pendidikan',
    'japung' => 'Japung',
    'konsentrasi' => 'Konsentrasi',
    'matakuliah' => 'Mata Kuliah',
    'pengaturanlain' => 'Pengaturan Lainnya',
    'pembuatansoal' => 'Pembuatan Soal',
    'honorujian' => 'Honor Ujian',
    'ttransport' => 'Tambah Transport',
    'tsesi' => 'Tambah Sesi',
    'rekapslip' => 'Rekap Slip Honor Dosen',
    'sliphonor' => 'Slip Honor Dosen',
    'rekapujian' => 'Rekap Slip Ujian Dosen',
    'tinggris' => 'Tambah Inggris',
    'tkekurangan' => 'Tambah Kekurangan',
    'sliphonorlalu' => 'Lihat Slip Honor Lalu'
  );

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dosen | <?php if(empty($title[$id])){ echo "Data Dosen";}else{ echo $title[$id];}?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--favicon -->
  <link href="<?php echo base_url();?>assets/admin/skin/img/icon_lp3i.ico" type="image/gif" rel="icon">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/Ionicons/css/ionicons.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/skins/_all-skins.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

</head>
<body class="hold-transition skin-green-light fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url();?>d.php/dash" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>SN</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">App<b>Dosen</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>assets/image/<?php echo $session['img']; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php if($session['nama_lengkap'] == ""){ echo "-";}else{ echo $session['nama_lengkap'];} ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>assets/image/<?php echo $session['img']; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php if($session['nama_lengkap'] == ""){ echo "-";}else{ echo $session['nama_lengkap'];} ?>
                  <small>
                    <?php
                      $adata = array(
                        '1' => "Kepala Bidang Akademik",
                        '2' => "Staff Akademik",
                        '100' => "Kepala Kampus",
                        '99' => "Wakil Kepala Kampus"
                      );

                      if($adata[$session['id_jabatan']]!= null){echo $adata[$session['id_jabatan']];}
                      else{ echo "-";}
                    ?>
                  </small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <a href="<?php echo base_url(); ?>index.php/login/logout" class="btn btn-default btn-flat">Keluar</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>assets/image/<?php echo $session['img']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php if($session['nama_lengkap'] == ""){ echo "-";}else{ echo $session['nama_lengkap'];} ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Dashboard Kerja</li>
        <li<?php if($id == "dosen") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/dosen"><i class="fa fa-male"></i> <span>Data Dosen</span></a></li>
        <li<?php if($id == "sesikuliah") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/sesikuliah"><i class="fa fa-calendar"></i> <span>Sesi Kuliah</span></a></li>
        <li class="<?php if($id=="honorujian"||$id=="rekapujian"){ echo "active ";} ?>treeview">
          <a href="#">
            <i class="fa fa-sheqel"></i> <span>Honor Ujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li<?php if($id == "honorujian") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/honorujian"><i class="fa fa-circle-o"></i> Slip Honor Ujian</a></li>
            <li<?php if($id == "rekapujian") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/rekapujian"><i class="fa fa-circle-o"></i> Rekap Slip Honor Ujian</a></li>
          </ul>
        </li>
        <li class="<?php if($id=="rekapslip"||$id=="sliphonor"||$id=="sliphonorlalu"){ echo "active ";} ?>treeview">
          <a href="#">
            <i class="fa fa-money"></i> <span>Honor Dosen</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li<?php if($id == "sliphonor") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/sliphonor"><i class="fa fa-circle-o"></i> Slip Honor Dosen</a></li>
            <li<?php if($id == "rekapslip") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/rekapslip"><i class="fa fa-circle-o"></i> Rekap Slip Honor Dosen</a></li>
            <li<?php if($id == "sliphonorlalu") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/sliphonorlalu"><i class="fa fa-circle-o"></i> Lihat Slip Honor Dosen Lalu</a></li>
          </ul>
        </li>
        <li class="<?php if($id=="ttransport"||$id=="tsesi"||$id=="tinggris"||$id=="tkekurangan"){ echo "active ";} ?>treeview">
          <a href="#">
            <i class="fa fa-dollar"></i> <span>Tambahan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li<?php if($id == "ttransport") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/ttransport"><i class="fa fa-circle-o"></i> Tambah Transport</a></li>
            <li<?php if($id == "tsesi") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/tsesi"><i class="fa fa-circle-o"></i> Tambah Sesi</a></li>
            <li<?php if($id == "tkekurangan") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/tkekurangan"><i class="fa fa-circle-o"></i> Tambah Kekurangan</a></li>
          </ul>
        </li>
        <?php if($session['id_jabatan']==1){ ?>
        <li class="header">Master Data</li>
        <li<?php if($id == "praktisi") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/praktisi"><i class="fa fa-send"></i> <span>Praktisi</span></a></li>
        <li<?php if($id == "pendidikan") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/pendidikan"><i class="fa fa-mortar-board"></i> <span>Pendidikan</span></a></li>
        <li<?php if($id == "japung") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/japung"><i class="fa fa-bank"></i> <span>Japung</span></a></li>
        <?php } ?>
        <?php if($session['id_jabatan']==1){ ?>
        <li<?php if($id == "konsentrasi") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/konsentrasi"><i class="fa fa-spinner"></i> <span>Konsentrasi</span></a></li>
        <li<?php if($id == "matakuliah") echo " class='active'"; ?>><a href="<?php echo base_url(); ?>d.php/matakuliah"><i class="fa fa-book"></i> <span>Mata Kuliah</span></a></li>
        <?php } ?>
        <?php if($session['id_jabatan']==1){ ?>
        <li<?php if($id == "pengaturanlain") echo " class='active'"; ?>><a href="<?php echo base_url();?>d.php/pengaturanlain"><i class="fa fa-hourglass-end"></i> <span>Pengaturan Lainnya</span></a></li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
