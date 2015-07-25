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
		<link rel="stylesheet" href="../../assets/css/fullcalendar.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />

		<link rel="stylesheet" href="../../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../../assets/css/ace-ie.min.css" />
		<![endif]-->

		<link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />




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
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<div class="row-fluid">

								<div class="span9">
									<div class="space"></div>

									<div id="calendar"></div>
								</div>

								<div class="span3">
									<div class="widget-box transparent">
										<div class="widget-header">
											<h4>Servicios</h4>
										</div>

										<div class="widget-main no-padding">
											<div id="external-events" id="obj_servicios">
												<?php
													require('../../admin/class.php');
													$class=new constante();
													$resultado = $class->consulta("SELECT ID,NOM FROM SERVICIOS WHERE STADO1='1' order by FECHA");
													$acu;
													$clasobj = array('class="external-event label-info" data-class="label-info"',
																		'class="external-event label-success" data-class="label-success"',
																		'class="external-event label-important" data-class="label-important"',
																		'class="external-event label-purple" data-class="label-purple"' );
													$a=0;
													$classervicios = array('MUSEO','CENTRO DE CONVENCIONES','RESTAURANTE "LAS POSADAS"','TEATRO AUDITORIO "CLUB L.I.A."' );
													while ($row=$class->fetch_array($resultado)) {
														print'<div '.$clasobj[$a].' id="'.$row[0].'">
															<i class="icon-move"></i>
															'.$classervicios[$a].'
														</div>';
														$a++;
												 	}
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->

					</div>
				</div>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>


		<!-- modal -->
		<div id="modal_form" class="modal hide fade" tabindex="-1" data-keyboard="false" data-backdrop="static">
		  	<div class="modal-body no-padding">
				<div class="row-fluid no-padding">
					<div class="span12 widget-container-span">
						<div class="widget-box transparent">
							<div class="widget-header widget-hea1der-small header-color-dark">
								<h6>Información Reservación</h6>
							</div>

							<div class="widget-body">
								<div class="widget-main no-padding">
									<div class="widget-main no-padding">
										<div class="tab-content padding-8">
											<div id="buscar" class="tab-pane in active">
												<div class="row-fluid">
													<div class="widget-container-span">
														<div class="span10">
															<form class="form-horizontal" >
																<div class="control-group">
																<label class="control-label">Servicio:</label>
																<div class="controls">
																	<div class="">
																		<input type="hidden" name="id_txt_reservacion" id="id_txt_reservacion" />
																		<input type="hidden" name="id_txt_servicio" id="id_txt_servicio" />
																		<input type="text" name="txt_servicio" id="txt_servicio" class="span12" readonly="no tocar" require />
																	</div>
																</div>
																</div>
																<div class="control-group">
																	<label class="control-label">Cliente:</label>
																	<div class="controls">
																		<div class="input-append">
																			<input type="hidden" name="id_txt_cliente_reserva" id="id_txt_cliente_reserva" class="span12"/>
																			<input type="text" name="txt_cliente_reserva" id="txt_cliente_reserva" class="span12" readonly/>
																			<span class="btn btn-small btn-pink" id="btn_cliente">
																				<i class="icon-search bigger-110"></i>
																				Buscar!
																			</span>
																		</div>
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label">Teléfono:</label>
																	<div class="controls">
																		<span class="block input-icon input-icon-right">
																			<input type="text" class="span12" id="txt_telefono_reserva" name="txt_telefono_reserva" placeholder="Teléfono" readonly/>
																			<i class="icon-phone"></i>
																		</span>
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label">Direccion:</label>
																	<div class="controls">
																		<span class="block input-icon input-icon-right">
																			<input type="text" class="span12" id="txt_direccion_reserva" name="txt_direccion_reserva" placeholder="Dirección" readonly/>
																			<i class="icon-map-marker"></i>
																		</span>
																	</div>
																</div>
															</form>
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
			</div>
			<div class="modal-footer">
			    <button class="btn btn-mini btn-success" data-dismiss="modal" aria-hidden="true">Cerrar</button>
			    <button type="submit" class="btn btn-mini btn-primary">Guardar</button>
			    <button type="submit" class="btn btn-mini btn-danger">Eliminar Reservación</button>
			</div>
		</div>
		<div id="modal-cliente" class="modal hide fade" tabindex="-1" data-keyboard="false" data-backdrop="static">
			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-container-span">
						<div class="widget-box transparent">
							<div class="widget-header">
								<h5 class="smaller"> Información Clientes</h5>
								<div class="widget-toolbar no-border">
									<ul class="nav nav-tabs" id="myTab">
										<li class="active">
											<a data-toggle="tab" href="#btn_buscar" id="btn_buscar_cliente">Buscar</a>
										</li>

										<li>
											<a data-toggle="tab" href="#btn_nuevo">Nuevo</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="widget-body ">
								<div class="widget-main padding-6">
									<div class="tab-content no-padding">
										<div id="btn_buscar" class="tab-pane in active">
											<table id="tbt_clientes" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Cedula</th>
														<th>Nombre</th>
														<th>Telefono</th>
														<th>Direccion</th>
														<th class="center">Accion</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>

										<div id="btn_nuevo" class="tab-pane">
											<div class="row-fluid">
												<div class="widget-container-span">
													<div class="row-fluid">
													<div class="span10">
														<form id="frm-registro" class="form-horizontal">
															<div class="control-group">
																<label class="control-label">Cedula / RUC.:</label>
																<div class="controls">
																	<span class="block input-icon input-icon-right">
																		<input type="text" class="span12" id="txt_reg_ced" name="txt_reg_ced" placeholder="Cedula / Ruc." />
																		<i class="icon-barcode"></i>
																	</span>
																</div>
															</div>
															<div class="control-group">
																<label class="control-label">Correo:</label>
																<div class="controls">
																	<span class="block input-icon input-icon-right">
																		<input type="email" class="span12" id="txt_reg_email" name="txt_reg_email" placeholder="Email" />
																		<i class="icon-envelope"></i>
																	</span>
																</div>
															</div><div class="control-group">
																<label class="control-label">Nombre & Apellido / Intitución:</label>
																<div class="controls">
																	<span class="block input-icon input-icon-right">
																		<input type="text" class="span12" id="txt_reg_nom_usuario" name="txt_reg_nom_usuario" placeholder="Nombre & Apellido / Institución" />
																		<i class="icon-user" id="icon_b_usuario"></i>
																	</span>
																</div>
															</div><div class="control-group">
																<label class="control-label">Teléfono:</label>
																<div class="controls">
																	<span class="block input-icon input-icon-right">
																			<input type="text" class="span12" id="txt_tel" name="txt_tel" placeholder="Teléfono" />
																			<i class="icon-user" id="icon_b_usuario"></i>
																		</span>
																</div>
															</div><div class="control-group">
																<label class="control-label">Dirección:</label>
																<div class="controls">
																	<span class="block input-icon input-icon-right">
																		<input type="text" class="span12" placeholder="Dirección" id="txt_dir" name="txt_dir" />
																	</span>
																</div>
															</div>
															<div class="control-group">
																<div class="span12">
																	<div class="clearfix blue">
																		<button type="submit" class="width-55 pull-right btn btn-small btn-success">
																			Registrar
																			<i id="icon-derecha" class="icon-arrow-right icon-on-right"></i>
																		</button>
																	</div>
																</div>
															</div>
														</form>
													</div>
													</div>
												</div><!--/span-->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-right" id="btn_cerrar_modal_buscar">
					<i class="icon-remove"></i>
					Cerrar
				</button>
			</div>
		</div>


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
		<script src="../assets/js/date-time/moment.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>

		<script src="../../assets/js/fullcalendar.min.js"></script>
		<script src="../../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>
		<script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/additional-methods.min.js"></script>
		<script src="../assets/js/blockui.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>




		<!--ace scripts-->

		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>
		<script src="index.js"></script>

	</body>
</html>
