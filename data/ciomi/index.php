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
											<span id="">Otros</span>
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
														<span class="title">Contenido Tarifa</span>
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
															<h3 class="lighter block green center">Estimado/a, <?php print$_SESSION['nom']; ?> seleccione el servicio</h3>
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
																				Su reservación tendrá una vigencia de 48 horas para la activación, caso contrario se cancelará automáticamente.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Para la activación de su cuenta siga los pasos que se indica y que se han enviado a su correo electrónico.
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
																				El día de la visita, presente su cédula para verificar información y dar validez a su respectiva de su reservación.
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
														<span class="title">Contenido Tarifa</span>
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
														<div class="span12">
															<h3 class="lighter block green center">Estimado/a, <?php print$_SESSION['nom']; ?> seleccione el servicio</h3>
														</div>
													</div>
													<div class="row-fluid">
														<!-- <div id="obj_categoria_teatro_auditorio"> </div> -->
														<div class="span4">
															<div class="widget-box pricing-box">
																<div class="widget-header header-color-blue">
																	<h5 class="bigger lighter">Teatro Auditorio "CLUB L.I.A."</h5>
																</div>

																<div class="widget-body">
																	<div class="widget-main no-padding">
																		<img src="../assets/images/teatro_audi.fw.png" width="100%">
																	</div>

																	<div>
																		<button class="btn btn-primary btn_teatro btn-block" id="20141211160613548a07457dffd">RESERVAR</button>
																	</div>
																</div>
															</div>
														</div>
														<div class="span4">
															<div class="widget-box pricing-box">
																<div class="widget-header header-color-green">
																	<h5 class="bigger lighter">Restaurante "LA POSADA"</h5>
																</div>

																<div class="widget-body">
																	<div class="widget-main no-padding">
																		<img src="../assets/images/restaurante.fw.png" width="100%">
																	</div>
																	<div>
																		<button class="btn btn-success no-radius btn_restaurante btn-block " id="20141211160521548a07112af84">RESERVAR</button>
																	</div>
																</div>
															</div>
														</div>
														<div class="span4">
															<div class="widget-box pricing-box">
																<div class="widget-header header-color-dark">
																	<h5 class="bigger lighter">Centro de Convensiones</h5>
																</div>

																<div class="widget-body">
																	<div class="widget-main no-padding">
																		<img src="../assets/images/centro.fw.png" width="100%">
																	</div>
																	<div>
																		<button class="btn btn-inverse btn_centro btn-block" id="20141211160155548a0643d0616">RESERVAR</button>
																	</div>
																</div>
															</div>
														</div>
														<input type="hidden" id="txt_nom_otros_servicios">
													</div>
												</div>
												<div class="step-pane" id="step22">
													<div class="row-fluid">
														<div class="span10"><h3 class="lighter block green center">Estimado/a, <?php print$_SESSION['nom']; ?> seleccione horario</h3></div>
														<div class="span2">
															<a href="#modal-otros" data-toggle="modal" id="btn_modal_otros" class="btn btn-mini btn-danger">
																<i class=" icon-info-sign"></i> Información
															</a>
														</div>
													</div>
													<div class="row-fluid">
														<div class="span4">
															<label for="id-date-range-picker-1">Rango de fecha</label>

															<div class="control-group">
																<div class="row-fluid input-prepend">
																	<span class="add-on">
																		<i class="icon-calendar"></i>
																	</span>
																	<input class="span10" type="text" name="date-range-picker" id="id-date-range-picker-1" data-date-format="dd-mm-yyyy"/>
																</div>
															</div>
														</div>
														<div class="span4">
															<label for="id-date-range-picker-1">Horario Inicio</label>
															<div class="control-group">
																<div class="input-append bootstrap-timepicker">
																	<input id="txt_time_inicio" type="text" class="input-small timer_picker" />
																	<span class="add-on">
																		<i class="icon-time"></i>
																	</span>
																</div>
															</div>

														</div>
														<div class="span4">
															<label for="id-date-range-picker-1">Horario Final</label>
															<div class="control-group">
																<div class="input-append bootstrap-timepicker">
																	<input id="txt_time_final" type="text" class="input-small timer_picker" />
																	<span class="add-on">
																		<i class="icon-time"></i>
																	</span>
																</div>
															</div>

														</div>
													</div>
												</div>

												<div class="step-pane" id="step32">
													<div class="row-fluid">
														<div class="span12">
															<div class="widget-box transparent">
																<div class="widget-header widget-header-flat">
																	<h4 class="lighter">
																		<i class="icon-time orange"></i>
																		Precio / Paquetes 
																	</h4>

																</div>

																<div class="widget-body">
																	<div class="widget-main no-padding">
																		<table class="table table-bordered table-striped" id="tabla_paquetes">
																			<thead>
																				<tr>
																					<th>
																						<i class="icon-caret-right blue"></i> Nro
																					</th>
																					<th class="hidden-phone">
																						<i class="icon-caret-right blue"></i>
																						Paquetes
																						<i class="icon-time orange"></i>
																					</th>
																					<th class="hidden-phone">
																						<i class="icon-caret-right blue"></i>
																						Precio
																						<i class="icon-time orange"></i>
																					</th>
																					<th>
																						<i class="icon-caret-right blue"></i>	<i class="icon-ok green"></i>
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
													</div>
												</div>
												<div class="step-pane" id="step42">
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
																					<span id="lbl_otros">OTROS</span>
																					<input type="hidden" id="txt_id_paquete_tarifa">
																				</div>
																			</div>

																			<div class="profile-info-row">
																				<div class="profile-info-name"> Rango de Fecha: </div>

																				<div class="profile-info-value">
																					<span id="lbl_fecha_final_otros">JUEVES, Septiembre 17 del 2015</span>
																				</div>
																			</div>
																			<div class="profile-info-row">
																				<div class="profile-info-name"> Días: </div>

																				<div class="profile-info-value">
																					<span id="lbl_dias_otros">JUEVES, Septiembre 17 del 2015</span>
																				</div>
																			</div>
																			<div class="profile-info-row">
																				<div class="profile-info-name"> Rango de Hora: </div>
																				<div class="profile-info-value">
																					<span id="lbl_hora_otros">10:00</span>
																				</div>
																			</div>
																			<div class="profile-info-row">
																				<div class="profile-info-name"> Paquete: </div>
																				<div class="profile-info-value">
																					<span id="lbl_paquete_otros">10:00</span>
																				</div>
																			</div>
																			<div class="profile-info-row">
																				<div class="profile-info-name"> Monto Total: </div>

																				<div class="profile-info-value">
																					<span id="lbl_total_otros"> 22.40</span>
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
																		Estimado/a, <?php print$_SESSION['nom']; ?>  Tenga en cuenta las siguientes notas.
																	</h4>

																</div>

																<div class="widget-body">
																	<div class="widget-main">
																		<ul class="unstyled spaced">
																			<li>
																				<i class="icon-ok green"></i>
																				Su reservación tendrá una vigencia de 48 horas para la activación,caso contrario se cancelará automáticamente.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Para la activación siga los pasos que se indica y que se han enviado a su correo electrónico.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Los pagos los puede realizar en el Banco Guayaquil en la cuenta Nro. 1209345 a nombre de Fábrica Imbabura.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				Estar presente al menos 30 minutos antes que inicie el turno de su reservación.
																			</li>
																			<li>
																				<i class="icon-ok green"></i>
																				El día de la visita, presente su cédula para verificar información y dar validez a su respectiva de su reservación.
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
		<div id="modal-otros" class="modal hide fade" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Información</h4>
			</div>

			<div class="modal-body overflow-visible">
				<div class="row-fluid" id="obj_informacion_otros"></div>
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
		<script src="../assets/js/jquery.maskedinput.min.js"></script>




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