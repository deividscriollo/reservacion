<?php
if(!isset($_SESSION))
	{
		session_start();
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../../index.php');
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

		<!--[if IE 7]>
		  <link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

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
						<li class="active">Reportes</li>
					</ul><!--.breadcrumb-->
				</div>
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="widget-box transparent">
								<div class="widget-header">
									<h4 class="lighter">Reportes</h4>

									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs" id="myTab2">
											<li class="active">
												<a data-toggle="tab" href="#home2">
													<i class="icon-print green"></i>
													Servicio más reservado
												</a>
											</li>

											<li>
												<a data-toggle="tab" href="#profile2">
												<i class="icon-print purple"></i>
													+ Reportes
												</a>
											</li>
										</ul>
									</div>
								</div>
								<style type="text/css">
									iframe{
										border:0px;
									}
								</style>
								<div class="widget-body">
									<div class="widget-main padding-12 no-padding-left no-padding-right">
										<div class="tab-content padding-4">
											<div id="home2" class="tab-pane">
												<div class="slim-scroll" data-height="590">
													<iframe src="reportes" width="100%" border="0" height="550"></iframe>
												</div>
											</div>

											<div id="profile2" class="tab-pane in active">
												<div class="row-fluid">
												<div class="span4">
													<div class="widget-box">
														<div class="widget-header">
															<h4>Requerimientos por procesos</h4>

															<span class="widget-toolbar">
																<a href="#" data-action="settings">
																	<i class="icon-cog"></i>
																</a>

																<a href="#" data-action="reload">
																	<i class="icon-refresh"></i>
																</a>

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
																	<label for="id-date-range-picker-1">Rango de fecha</label>
																</div>

																<div class="control-group">
																	<div class="row-fluid input-prepend">
																		<span class="add-on">
																			<i class="icon-calendar"></i>
																		</span>
																		<input class="span10" type="text" name="date-range-picker" id="id-date-range-picker-1" value="2015-07-27 / 2016-01-07" />
																	</div>
																</div>
																<div class="row-fluid">
																	<label for="id-date-range-picker-1">Privincia</label>
																	<select  id="sel_provincia" class="span12">
																		<option value="" />
																		<option value="AL" />Alabama
																	</select>
																</div>
																<div class="row-fluid">
																	<label for="id-date-range-picker-1">Ciudad</label>
																	<select id="sel_ciudad" class="span12">
																		<option value="" />
																		<option value="" />Primero Seleccione Provincia
																	</select>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="span4">
													<div class="widget-box">
														<div class="widget-header">
															<h4>Proceso</h4>

															<span class="widget-toolbar">
																<a href="#" data-action="settings">
																	<i class="icon-cog"></i>
																</a>

																<a href="#" data-action="reload">
																	<i class="icon-refresh"></i>
																</a>

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
																	<label for="id-date-range-picker-1">Seleccione proceso</label>
																</div>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_turista_extranjero">Turista Extrangero</button>
																</p>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_turista_nacionales">Turista nacional</button>
																</p>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_turista_nacionales_provincia">Turista nacional provincia</button>
																</p>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_turista_nacionales_ciudad">Turista nacional ciudad</button>
																</p>
															</div>
														</div>
													</div>
												</div>
												<div class="span4">
													<div class="widget-box">
														<div class="widget-header">
															<h4>Proceso</h4>

															<span class="widget-toolbar">
																<a href="#" data-action="settings">
																	<i class="icon-cog"></i>
																</a>

																<a href="#" data-action="reload">
																	<i class="icon-refresh"></i>
																</a>

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
																	<label for="id-date-range-picker-1">Seleccione Procesos</label>
																</div>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_pago_paypal">Pago Paypal</button>
																</p>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_pago_efectivo">Pago Efectivo</button>
																</p>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_pago_deposito">Pago Deposito</button>
																<p>
																	<button class="btn btn-danger btn-block" id="btn_pago_tarjeta">Tarjeta de Crédito</button>
																</p>
															</p>
														</div>
													</div>
												</div>
											</div>
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
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/date-time/moment.min.js"></script>
		<script src="../../assets/js/date-time/daterangepicker.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/chosen.jquery.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="../assets/js/date-time/moment.min.js"></script>
		<script src="../assets/js/date-time/daterangepicker.min.js"></script>
		<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="../assets/js/jquery.knob.min.js"></script>
		<script src="../assets/js/jquery.autosize-min.js"></script>
		<script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js"></script>
		<script src="../assets/js/bootstrap-tag.min.js"></script>






		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<script src="../factura/js/jspdf.min.js"></script>
		<script src="app.js"></script>

		<!--inline scripts related to this page-->

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				// scrollables
				$('.slim-scroll').each(function () {
					var $this = $(this);
					$this.slimScroll({
						height: $this.data('height') || 100,
						railVisible:true
					});
				});
				
			});
		</script>

	</body>
</html>
