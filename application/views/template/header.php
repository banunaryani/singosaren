<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Meta Tag -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content='pavilan'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Title Tag  -->
	<title><?= $title ?></title>

	<!-- Leaflet -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/leaflet/') ?>leaflet.css">
	<script src="<?= base_url('assets/') ?>vendor/leaflet/leaflet.js"></script>

	<!-- Jquery JS -->
	<script src="<?= base_url('assets/') ?>js/jquery.min.js"></script>

	<!-- Embed Media -->
	<script async charset="utf-8" src="//cdn.embedly.com/widgets/platform.js"></script>

	<!-- Favicon -->
	<link rel="icon" href="<?= base_url('assets/img/') . $deskripsi['favicon'] . '?v=1' ?>">

	<!-- munculkan mouse koordinat-->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/leaflet/') ?>leaflet-mouseposition/L.Control.MousePosition.css">
	<!-- munculkan navigasi pengukuran-->
	<link rel="stylesheet" href="<?= base_url('assets/vendor/leaflet/') ?>leaflet-measure/leaflet-measure.css">

	<!-- Geolocation CSS Library -->
	<link rel="stylesheet" href="https://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.css">

	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Bizwheel Plugins CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/animate.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/cubeportfolio.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/jquery.fancybox.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/magnific-popup.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/owl-carousel.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/slicknav.min.css">

	<!-- Bizwheel Stylesheet -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/reset.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>style.css">
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">

	<!-- Bizwheel Colors -->
	<!--<link rel="stylesheet" href="css/skins/skin-1.css">-->
	<!--<link rel="stylesheet" href="css/skins/skin-2.css">-->
	<!--<link rel="stylesheet" href="css/skins/skin-3.css">-->
	<!--<link rel="stylesheet" href="css/skins/skin-4.css">-->

	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	<style>
		.maps {
			height: 100%;
			width: 100%;
			margin: 0px;
			padding-top: 28px;
		}

		.btn-xl {
			margin-bottom: 10px;
			margin-left: 20px;
			padding: 10px 20px;
			font-size: 30px;
			border-radius: 0px;
			width: 150%;
		}

		.btn-group-vertical .dropdown-menu li.dropdown-item {
			cursor: pointer;
		}
	</style>

</head>

<body id="bg">

	<!-- Boxed Layout -->
	<div id="page" class="site boxed-layout">

		<!-- Preloader -->
		<div class="preeloader">
			<div class="preloader-spinner"></div>
		</div>
		<!--/ End Preloader -->

		<!-- Header -->
		<header class="header">
			<!-- Middle Header -->
			<div class="middle-header">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="middle-inner">
								<div class="row">
									<div class="col-lg-3 col-md-3 col-12">
										<!-- Logo -->
										<div class="logo">
											<!-- Image Logo -->
											<div class="img-logo">
												<a href="<?= base_url() ?>">
													<img src="<?= base_url('assets/img/') . $deskripsi['logo'] . '?v=2' ?>" alt="#" style="margin-bottom: 15px; height: 50px; width: 231px; ">
												</a>
											</div>
										</div>
										<div class="mobile-nav"></div>
									</div>
									<div class="col-lg-9 col-md-9 col-12">
										<div class="menu-area">
											<!-- Main Menu -->
											<nav class="navbar navbar-expand-lg">
												<div class="navbar-collapse">
													<div class="nav-inner">
														<div class="menu-home-menu-container">
															<!-- Naviagiton -->
															<ul id="nav" class="nav main-menu menu navbar-nav">
																<?php

																foreach ($navbar as $key => $n) {

																	if ($n['submenus'] !== null) {

																		$subs = explode(";", $n['submenus']);

																?>
																		<li class="icon-active"><a href="#"><?= $n['menu_nav'] ?></a>
																			<ul class="sub-menu">
																				<?php
																				foreach ($subs as $s) {

																					$a = explode(",", $s);

																				?>
																					<li><a href="<?= $a[1] ?>"><?= $a[0] ?></a></li>
																				<?php
																				}
																				?>
																			</ul>
																		</li>
																	<?php
																	} //end if submenus
																	else {

																	?>

																		<li><a href="<?= base_url() . $n['link'] ?>"><?= $n['menu_nav'] ?></a></li>

																	<?php
																	} //end else
																	?>
																<?php
																}
																?>
															</ul>
															<!--/ End Naviagiton -->
														</div>
													</div>
												</div>
											</nav>
											<!--/ End Main Menu -->
											<!-- Right Bar -->
											<div class="right-bar">
												<!-- Search Bar -->
												<ul class="right-nav">
													<li class="top-search"><a href="#0"><i class="fa fa-search"></i></a></li>
													<li class="bar"><a href="<?= base_url() ?>auth" class="fa fa-sign-in"></a></li>
												</ul>
												<!--/ End Search Bar -->
												<!-- Search Form -->
												<div class="search-top">
													<form action="#" class="search-form" method="get">
														<input type="text" name="s" value="" placeholder="Search here" />
														<button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
													</form>
												</div>
												<!--/ End Search Form -->
											</div>
											<!--/ End Right Bar -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ End Middle Header -->
		</header>
		<!--/ End Header -->