<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../../inicio');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>FABRICA IMBABURA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../../assets/empresa/logo/logo.png" />

		<!--basic styles-->

		<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../../assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="../../assets/css/fontdc.css" />

		<link rel="stylesheet" href="../../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		
		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php menu(); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-check check-icon"></i>
							<a href="#">Reservación</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Menu Principal</li>
					</ul><!--.breadcrumb-->
				</div>
				<div class="page-content">
					<div class="row-fluid">
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4>Crear Servicios</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../../assets/empresa/servicio.fw.png">

											<button class="btn btn-primary btn-block">Administración Servicios</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="purple">Agenda</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../../assets/empresa/calendario.fw.png" >

											<button class="btn btn-purple btn-block">Administracion Agenda</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="green">Reservaciones</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../../assets/empresa/reservacion.fw.png" >

											<button class="btn btn-success btn-block">Administracion Reservaciones</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="orange">Otros</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../../assets/empresa/otros.fw.png" >

											<button class="btn btn-warning btn-block">Administracion Otros</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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
			window.jQuery || document.write("<script src='../../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="../../assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="../../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../../assets/js/jquery.sparkline.min.js"></script>
		<script src="../../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../../assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		
	</body>
</html>
