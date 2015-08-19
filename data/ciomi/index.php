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
				<?php if ($_SESSION['nivel']=='CLIENTE') { ?>
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
										<a data-toggle="tab" href="#dc_convencion1">
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
													<div class="row-fluid">
														<div class="span10">
															<h3 class="lighter block green center">Estimado/a, <?php print$_SESSION['nom']; ?> seleccione el tipo de reservación</h3>
														</div>
														<div class="span2">
															<a href="#modal-museo" data-toggle="modal" class="btn btn-mini btn-danger">
																<i class=" icon-info-sign"></i> Información
															</a>
														</div>
													</div>
													<div class="row-fluid">
														<div id="obj_tipo_reservacion"></div>
														<input type="hidden" id="txt_categoria">
													</div>
												</div>

												<div class="step-pane" id="step2">
													<div class="row-fluid">
														<div class="span4">
															<div class="row-fluid">
																<div class="control-group success">
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
															<div class="widget-box transparent">
																<div class="widget-header widget-header-flat">
																	<h4 class="lighter">
																		<i class="icon-star orange"></i>
																		Servicio
																	</h4>
																</div>

																<div class="widget-body">
																	<div class="widget-main no-padding">
																		<div class="row-fluid">
																			<table class="table table-bordered table-striped" id="tabla_info_tarifa">
																				<thead>
																					<tr>
																						<th class="center">
																							<i class=" icon-circle-blank blue"></i>
																							Nro
																						</th>

																						<th class="center">
																							<i class="icon-coffee blue"></i>
																							Servicio Tarifa
																						</th>

																						<th class="center">
																							<i class="icon-legal orange"></i>
																							Precio
																						</th>
																						<th class="center">
																							<i class="icon-cloud-upload red"></i>
																							Cantidad
																						</th>
																						<th class="center">
																							<i class="icon-caret-right green"></i>
																							Total
																						</th>
																					</tr>
																				</thead>
																				<tbody>
																				</tbody>
																			</table>
																		</div>
																		<div class="row-fluid">
																			<div class="span5  pull-right">
																				<table class="table table-bordered table-striped">
																					<tr>
																						<th class="center">
																							<i class="icon-caret-right green"></i>
																							SubTotal
																						</th>
																						<th class="center" id="lbl_subtotal">
																							<i class="icon-caret-right green"></i>
																							0.00
																						</th>
																					</tr>
																					<tr>
																						<th class="center" id="lbl_valor_iva">
																							<i class="icon-caret-right green"></i>
																							Iva
																						</th>
																						<th class="center" id="lbl_iva">
																							<i class="icon-caret-right green"></i>
																							0.00
																						</th>
																					</tr>
																					<tr>
																						<th class="center">
																							<i class="icon-caret-right green"></i>
																							Total
																						</th>
																						<th class="center" id="lbl_total">
																							<i class="icon-caret-right green"></i>
																							0.00
																						</th>
																					</tr>
																				<tbody>
																				</tbody>
																			</table>
																			</div>
																		</div>
																	</div><!--/widget-main-->
																</div><!--/widget-body-->
															</div><!--/widget-box-->

														</div>
													</div>
												</div>

												<div class="step-pane" id="step4">
													<div class="row-fluid">
														<div class="span6">
															<div class="widget-box transparent">
																<div class="widget-header widget-header-small">
																	<h4 class="smaller">
																		<i class="icon-check bigger-110"></i>
																		Resumen de la reservación
																	</h4>
																</div>

																<div class="widget-body">
																	<div class="widget-main">
																		<div class="profile-user-info">
																			<div class="profile-info-row">
																				<div class="profile-info-name"> A nombre de: </div>

																				<div class="profile-info-value">
																					<span><?php print$_SESSION['nom']; ?></span>
																				</div>
																			</div>

																			<div class="profile-info-row">
																				<div class="profile-info-name"> Servicio: </div>
																				<div class="profile-info-value">
																					<span>MUSEO</span>
																				</div>
																			</div>

																			<div class="profile-info-row">
																				<div class="profile-info-name"> Para la fecha: </div>

																				<div class="profile-info-value">
																					<span id="lbl_fecha_final"></span>
																				</div>
																			</div>

																			<div class="profile-info-row">
																				<div class="profile-info-name"> Hora inicio: </div>
																				<div class="profile-info-value">
																					<span id="lbl_info_hora_inicio">20/06/2010</span>
																				</div>
																			</div>
																			<div class="profile-info-row">
																				<div class="profile-info-name"> Hora Fin: </div>
																				<div class="profile-info-value">
																					<span id="lbl_info_hora_fin">20/06/2010</span>
																				</div>
																			</div>

																			<div class="profile-info-row">
																				<div class="profile-info-name"> Monto Total: </div>

																				<div class="profile-info-value">
																					<span id="lbl_info_total"></span>
																				</div>
																			</div>
																		</div>

																	</div>
																</div>
															</div>
														</div>
														<div class="span6">
															<div class="widget-box transparent">
																<div class="widget-header widget-header-small">
																	<h4 class="smaller">
																		<i class="icon-check bigger-110"></i>
																		Estimado/a, <?php print$_SESSION['nom']; ?> Tenga en cuenta las siguientes notas.
																	</h4>

																</div>

																<div class="widget-body">
																	<div class="widget-main">
																		<ul class="unstyled spaced">
																			<li>
																				<i class="icon-ok green"></i>
																				Su reservación tendrá una vigencia de 48 horas para la activación o se cancelara automáticamente.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Para la activación sigas los pasos que se indica y que se han enviado a su correo electrónico.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Los pagos los puede realizar en el Banco Guayaquil en la cuenta Nro. 1209345 a nombre de Fábrica Imbabura.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Estar presente al menos 10 minutos antes que inicie el turno de su reservación.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Día de la reservación, Presente su cedula para verificar información y dar validez de su reservación.
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>

													</div>
												</div>
											</div>

											<hr />
											<div class="row-fluid wizard-actions">
												<button class="btn btn-prev">
													<i class="icon-arrow-left"></i>
													Atras
												</button>
												<button class="btn btn-success btn-next" data-last="Reservar ">
													Adelante
													<i class="icon-arrow-right icon-on-right"></i>
												</button>
											</div>
										</div>
									</div>

									<div id="profile4" class="tab-pane">
										<div class="row-fluid">
											<div id="fuelux-wizard2" class="row-fluid hide" data-target="#step-container2">
												<ul class="wizard-steps">
													<li data-target="#step12" class="active">
														<span class="step">1</span>
														<span class="title">Seleccionar Categoría</span>
													</li>

													<li data-target="#step22">
														<span class="step">2</span>
														<span class="title">Fecha y Horarios</span>
													</li>

													<li data-target="#step32">
														<span class="step">3</span>
														<span class="title">Contenido Terifa</span>
													</li>

													<li data-target="#step42">
														<span class="step">4</span>
														<span class="title">Reservar</span>
													</li>
												</ul>
											</div>
											<hr />
											<div class="step-content row-fluid position-relative" id="step-container2">
												<div class="step-pane active" id="step12">
													<div class="row-fluid">
														<div class="span10">
															<h3 class="lighter block green center">Estimado/a, <?php print$_SESSION['nom']; ?> seleccione el tipo de reservación</h3>
														</div>
														<div class="span2">
															<a href="#modal-museo" data-toggle="modal" class="btn btn-mini btn-danger">
																<i class=" icon-info-sign"></i> Información
															</a>
														</div>
													</div>
													<div class="row-fluid">
														<div id="obj_categoria_teatro_auditorio"> </div>
													</div>
												</div>

												<div class="step-pane" id="step22">
												h2
												</div>

												<div class="step-pane" id="step32">
												h3
												</div>

												<div class="step-pane" id="step42">
												h4
												</div>
											</div>

											<hr />
											<div class="row-fluid wizard-actions">
												<button class="btn btn-prev">
													<i class="icon-arrow-left"></i>
													Atras
												</button>

												<button class="btn btn-success btn-next" data-last="Reservar ">
													Adelante
													<i class="icon-arrow-right icon-on-right"></i>
												</button>
											</div>
										</div>
									</div>

									<div id="dropdown14" class="tab-pane">
									restaurant

										<div class="row-fluid">
											<div id="fuelux-wizard3" class="row-fluid hide" data-target="#step-container3">
												<ul class="wizard-steps">
													<li data-target="#step13" class="active">
														<span class="step">1</span>
														<span class="title">Seleccionar Categoría</span>
													</li>

													<li data-target="#step23">
														<span class="step">2</span>
														<span class="title">Fecha y Horarios</span>
													</li>

													<li data-target="#step33">
														<span class="step">3</span>
														<span class="title">Contenido Terifa</span>
													</li>

													<li data-target="#step43">
														<span class="step">4</span>
														<span class="title">Reservar</span>
													</li>
												</ul>
											</div>
											<hr />
											<div class="step-content row-fluid position-relative" id="step-container3">
												<div class="step-pane active" id="step12">
												h1
												</div>

												<div class="step-pane" id="step23">
												h2
												</div>

												<div class="step-pane" id="step33">
												h3
												</div>

												<div class="step-pane" id="step43">
												h4
												</div>
											</div>

											<hr />
											<div class="row-fluid wizard-actions">
												<button class="btn btn-prev">
													<i class="icon-arrow-left"></i>
													Atras
												</button>

												<button class="btn btn-success btn-next" data-last="Reservar ">
													Adelante
													<i class="icon-arrow-right icon-on-right"></i>
												</button>
											</div>
										</div>
									</div>
									<div id="dc_convencion1" class="tab-pane">
										<div class="row-fluid">
											<div id="fuelux-wizard4" class="row-fluid hide" data-target="#step-container4">
												<ul class="wizard-steps">
													<li data-target="#step14" class="active">
														<span class="step">1</span>
														<span class="title">Seleccionar Categoría</span>
													</li>

													<li data-target="#step24">
														<span class="step">2</span>
														<span class="title">Fecha y Horarios</span>
													</li>

													<li data-target="#step34">
														<span class="step">3</span>
														<span class="title">Contenido Terifa</span>
													</li>

													<li data-target="#step44">
														<span class="step">4</span>
														<span class="title">Reservar</span>
													</li>
												</ul>
											</div>
											<hr />
											<div class="step-content row-fluid position-relative" id="step-container4">
												<div class="step-pane active" id="step14">
												h1
												</div>

												<div class="step-pane" id="step24">
												h2
												</div>

												<div class="step-pane" id="step34">
												h3
												</div>

												<div class="step-pane" id="step44">
												h4
												</div>
											</div>

											<hr />
											<div class="row-fluid wizard-actions">
												<button class="btn btn-prev">
													<i class="icon-arrow-left"></i>
													Atras
												</button>

												<button class="btn btn-success btn-next" data-last="Reservar ">
													Adelante
													<i class="icon-arrow-right icon-on-right"></i>
												</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!--/span-->
					</div><!--/.row-fluid-->
				</div><!--/.page-content-->
				<?php } ?>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>
		<div id="modal-museo" class="modal hide fade" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Información</h4>
			</div>

			<div class="modal-body overflow-visible">
				<div class="row-fluid" id="obj_informacion_museo"></div>
			</div>

			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
			</div>
		</div><!--PAGE CONTENT ENDS-->


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
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/blockui.js"></script>




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
<script type="text/javascript">
	$('#modal-museo').modal({
        backdrop: true,
        keyboard: true,
        show:false
    }).css({
       'width': function () {
           return ($(document).width() * .7) + 'px';  
       },
       'margin-left': function () { 
           return -($(this).width() / 2); 
       }
});
</script>