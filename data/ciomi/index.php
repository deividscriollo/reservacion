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

		<!--basic styles-->

		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/animate.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />


		<!--[if IE 7]>
		  <link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<link rel="stylesheet" href="../assets/css/select2.css" />

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
				<?php if ($_SESSION['nivel']!='CLIENTE') { ?>
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="tabbable tabs-right">
								<ul class="nav nav-tabs" id="myTab4">
									<li class="active">
										<a data-toggle="tab" href="#home4">
											<i class="blue icon-dashboard bigger-110"></i>
											<span id="">MUSEO</span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#profile4">
											<i class="green  icon-fire bigger-110"></i>
											<span id="">TEATRO AUDITORIO</span>
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="#dropdown14">
											<i class="orange icon-coffee bigger-110"></i>
											RESTAURANTE
										</a>
									</li>
									<li>
										<a data-toggle="tab" href="">
											<i class="red icon-dashboard bigger-110"></i>
											<span>CENTRO DE CONVEN..</span>
										</a>
									</li>
								</ul>

								<div class="tab-content">
									<div id="home4" class="tab-pane in active">
										<div class="row-fluid">
													<div id="fuelux-wizard" class="row-fluid hide" data-target="#step-container">
														<ul class="wizard-steps">
															<li data-target="#step1" class="active">
																<span class="step">1</span>
																<span class="title">Seleccionar Categoría</span>
															</li>

															<li data-target="#step2">
																<span class="step">2</span>
																<span class="title">Fecha y Horarios</span>
															</li>

															<li data-target="#step3">
																<span class="step">3</span>
																<span class="title">Contenido Terifa</span>
															</li>

															<li data-target="#step4">
																<span class="step">4</span>
																<span class="title">Reservar</span>
															</li>
														</ul>
													</div>

													<hr />
													<div class="step-content row-fluid position-relative" id="step-container">
														<div class="step-pane active" id="step1">
															<h3 class="lighter block green center">Estimado, <?php print$_SESSION['nom']; ?> seleccione el tipo de reservación</h3>
															<div id="obj_tipo_reservacion">
															</div>
															<input type="hidden" id="txt_categoria">
														</div>

														<div class="step-pane" id="step2">
															<div class="row-fluid">
																<div class="span4">
																	<div class="row-fluid">
																		<div class="control-group">
																			<div class="row-fluid input-append">
																				<input class="span11 date-picker" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" />
																				<span class="add-on">
																					<i class="icon-calendar"></i>
																				</span>
																			</div>
																		</div>
																	</div>
																	<div class="row-fluid">
																		<div class="widget-container-span">
																			<div class="widget-box transparent">
																				<div class="widget-header">
																					<h4 class="lighter">Fecha Día</h4>
																				</div>

																				<div class="widget-body">
																					<div class="widget-main padding-6 no-padding-left no-padding-right">
																						<blockquote id="info_fecha"></blockquote>

																					</div>
																				</div>
																				<div class="row-fluid">
																					<h3 class="header smaller lighter grey pull-right">
																						<i class="icon-spinner icon-spin orange bigger-125"></i>
																					</h3>

																				</div>
																			</div>
																		</div>


																	</div>
																</div>
																<div class="span8">
																	<div class="widget-box transparent">
																		<div class="widget-header widget-header-flat">
																			<h4 class="lighter">
																				<i class="icon-time orange"></i>
																				Disponibilidad de Horarios
																			</h4>

																		</div>

																		<div class="widget-body">
																			<div class="widget-main no-padding">
																				<table class="table table-bordered table-striped" id="tabla_horas">
																					<thead>
																						<tr>
																							<th>
																								<i class="icon-caret-right blue"></i> Nro
																							</th>

																							<th>
																								<i class="icon-caret-right blue"></i>	<i class="icon-ok green"></i>
																							</th>

																							<th class="hidden-phone">
																								<i class="icon-caret-right blue"></i>
																								H. Inicio
																								<i class="icon-time orange"></i>
																							</th>
																							<th class="hidden-phone">
																								<i class="icon-caret-right blue"></i>
																								H. Fin
																								<i class="icon-time orange"></i>
																							</th>
																							<th class="hidden-phone">
																								<i class="icon-caret-right blue"></i>
																								Fecha
																								<i class="icon-calendar purple"></i>
																							</th>
																							<th class="hidden-phone center">
																								<i class="icon-caret-right blue"></i>
																								Dia
																								<!-- <i class="icon-calendar purple"></i> -->
																							</th>
																						</tr>
																					</thead>

																					<tbody>
																					</tbody>
																				</table>
																			</div><!--/widget-main-->
																		</div><!--/widget-body-->
																	</div><!--/widget-box-->

																</div>
																<div class="span2"></div>
															</div>
														</div>

														<div class="step-pane" id="step3">
															<div class="center">
																<div class="row-fluid">
																	<div class="span5 pricing-span-header">
																		<div class="widget-box transparent">
																			<div class="widget-header">
																				<h5 class="bigger lighter">Servicio Tarifa</h5>
																			</div>
																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<ul class="unstyled list-striped pricing-table-header" id="obj_tarifas_nombre">
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="span2 pricing-span ">
																		<div class="widget-box pricing-box-small">
																			<div class="widget-header header-color-orange">
																				<h5 class="bigger lighter">Precio </h5>
																			</div>

																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<ul class="unstyled list-striped pricing-table" id="obj_tarifas_precio">
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="span3 pricing-span">
																		<div class="widget-box pricing-box-small">
																			<div class="widget-header header-color-blue">
																				<h5 class="bigger center">Cantidad</h5>
																			</div>
																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<ul class="unstyled list-striped pricing-table" id="obj_tarifas_cantidad">

																					</ul>
																					<div>
																					<ul class="unstyled list-striped center">
																							<li> SUBTOTAL </li>
																						</ul>
																					</div>
																					<div>
																						<ul class="unstyled list-striped center">
																							<li> IVA </li>
																						</ul>
																					</div>
																					<div class="widget-header header-color-blue">
																						<h5 class="bigger center">Total:</h5>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="span3 pricing-span">
																		<div class="widget-box pricing-box-small">
																			<div class="widget-header header-color-green">
																				<h5 class="bigger lighter">Total</h5>
																			</div>

																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<ul class="unstyled list-striped pricing-table" id="obj_tarifas_total">
																					</ul>
																				</div>
																				<div>
																					<ul class="unstyled list-striped center">
																						<li id="lbl_subtotal"> 00.00 </li>
																					</ul>
																				</div>
																				<div>
																					<ul class="unstyled list-striped center" >
																						<li id="lbl_iva"> 00.00 </li>
																					</ul>
																				</div>
																				<div class="widget-header header-color-green" id="lbl_total">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>

														<div class="step-pane" id="step4">
															<div class="center">
																<h3 class="green">Congrats!</h3>
																Your product is ready to ship! Click finish to continue!
															</div>
														</div>
													</div>

													<hr />
													<div class="row-fluid wizard-actions">
														<button class="btn btn-prev">
															<i class="icon-arrow-left"></i>
															Atras
														</button>

														<button class="btn btn-success btn-next" data-last="Finish ">
															Adelante
															<i class="icon-arrow-right icon-on-right"></i>
														</button>
													</div>
												</div>

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

		<script src="../assets/js/fuelux/fuelux.wizard.min.js"></script>
		<script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/additional-methods.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js"></script>
		<script src="../assets/js/select2.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-timepicker.min.js"></script>
		<script src="../assets/js/date-time/moment.min.js"></script>
		<script src="../assets/js/date-time/daterangepicker.min.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>




		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>


		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script src="app.js"></script>
	</body>
</html>
