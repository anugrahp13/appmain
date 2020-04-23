<!DOCTYPE html>
<html lang="en" id="home">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <title>Politeknik LP3I Jakarta Kampus Pondok Gede</title>

	    <!--favicon -->
	    <link href="<?php echo base_url();?>assets/admin/skin/img/icon_lp3i.ico" type="image/gif" rel="icon">
	    <!-- Bootstrap -->
	    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <!-- Bootstrap Icon -->
	    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap-social.css" rel="stylesheet">
	    <!-- Font Awesome -->
	    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	    <!-- All -->
	    <link href="<?php echo base_url();?>assets/admin/skin/css/all.min.css" rel="stylesheet">

	    <style type="text/css">
	    .imggelap {
		    -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
		    filter: grayscale(100%);
		}
	    .modal{
	    }
	    .vertical-alignment-helper{
	      display: table;
	      height: 100%;
	      width: 100%;
	    }
	    .vertical-align-center{
	      /* To center vertically*/
	      display: table-cell;
	      vertical-align: middle;
	    }
	    .modal-content{
	      /* Boostrap sets the size of the modal in the modal dialog class, we need to inherit it*/
	      width: inherit;
	      height: inherit;
	      /* To center horizontally*/
	      margin: 0 auto;
	    }
	    </style>

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
    	<!-- Navbar -->
		<nav class="navbar navbar-default navbar-fixed-top">
  			<div class="container-fluid">
	  			<div class="navbar-header">
			      <a class="navbar-brand page-scroll" href="#home">LP3I Pondok Gede</a>
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			    </div>

			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				    <ul class="nav navbar-nav navbar-right">
				    	<li><a href="https://sim.plj.ac.id/" target="_blank">Smart Campus</a></li>
				    	<li><a href="https://mhs.plj.ac.id/" target="_blank">Smart Student</a></li>
				    	<li><a href="https://mail.lp3i.id/" target="_blank">Mail Zimbra</a></li>
				    	<li><a href="#about" class="page-scroll">Tentang</a></li>
				    	<li><a href="#program" class="page-scroll">Program</a></li>
				    	<li class="dropdown">
				    		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url();?>assets/image/<?php echo $this->session->userdata('img'); ?>" class="img-circle" alt="User Image"> <?php echo $this->session->userdata('nama_lengkap');?> <span class="caret"></span></a>
				    		<ul class="dropdown-menu">
				    			<li><a href="<?php echo base_url();?>index.php/login/logout">Sign out</a></li>
				    		</ul>
				    	</li>
				    </ul>
				</div>
  			</div>
  		</nav>
		<!-- Akhir Navbar -->
