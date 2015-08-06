<?php
if(!isset($_SESSION))
	{
		session_start();
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../../index.php');
	}
	require('../../admin/class.php');
	$class=new constante();
	$id=$_SESSION['id'];
	$resultado = $class->consulta("SELECT * FROM SEG.USUARIO U,SEG.INFO I WHERE I.ID_USUARIO=U.ID AND U.ID='$id' and I.stado='0'");
	while ($row=$class->fetch_array($resultado)) {
		header('Location: index2.php');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>FABRICA IMBABURA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />

		<!--basic styles-->

		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />


		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>

		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php  menu(); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Menu Principal</li>
					</ul><!--.breadcrumb-->
				</div>
				<?php if ($_SESSION['nivel']!='CLIENTE') { ?>
					<div class="page-content">
					<div class="page-header position-relative">
						<!-- <h1>
							UI Elements
							<small>
								<i class="icon-double-angle-right"></i>
								Common UI Features &amp; Elements
							</small>
						</h1> -->
					</div><!--/.page-header-->

					<div class="row-fluid">
						<div class="span12">
							<div class="tabbable tabs-right">
								<ul class="nav nav-tabs" id="myTab4">
									<li class="active">
										<a data-toggle="tab" href="#home4">Home</a>
									</li>

									<li>
										<a data-toggle="tab" href="#profile4">Profile</a>
									</li>

									<li>
										<a data-toggle="tab" href="#dropdown14">More</a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="home4" class="tab-pane in active">
										<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
										<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
									</div>

									<div id="profile4" class="tab-pane">
										<p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
										<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
									</div>

									<div id="dropdown14" class="tab-pane">
										<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade.</p>
										<p>Raw denim you probably haven't heard of them jean shorts Austin.</p>
									</div>
								</div>
							</div>
						</div><!--/span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->

				<?php } ?>
				<?php if ($_SESSION['nivel']=='CLIENTE') { ?>
					<div class="page-content">
						<div class="row-fluid">
							<h3 class="header smaller lighter green">Reservaciones En Proceso de pagos Pendientes</h3>
							<h3 class="header smaller lighter green">Reservaciones Realizadas</h3>
							<h3 class="header smaller lighter green">Reservaciones Finalizadas</h3>
						</div>
					</div>
				<?php } ?>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--basic scripts-->

		<!--[if !IE]>-->


		<!--<![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="../assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/spin.min.js"></script>


		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script src="app.js"></script>
	</body>
</html>
