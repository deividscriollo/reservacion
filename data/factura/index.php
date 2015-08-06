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

		<link rel="stylesheet" href="../assets/css/fontdc.css" />

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
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="widget-box transparent">
								<div class="widget-header">
									<h4 class="lighter">Proceso de Facturación</h4>

									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs" id="myTab2">
											<li class="active">
												<a data-toggle="tab" href="#factura">
													<i class="icon-print green"></i>
													Factura
												</a>
											</li>

											<li>
												<a data-toggle="tab" href="#reservaciones">
												<i class="icon-print purple"></i>
													Reservaciones del día de hoy
												</a>
											</li>
										</ul>
									</div>
								</div>
								<div class="widget-body">
									<div class="widget-main padding-12 no-padding-left no-padding-right">
										<div class="tab-content padding-4">
											<div id="factura" class="tab-pane in active">
												<div class="row-fluid">
													<div class="span5">
														<div class="widget-box transparent">
															<div class="widget-header">
																<h4>Información Cliente</h4>
																<span class="widget-toolbar">
																	<div class="btn btn-info" id="btn_buscar_cliente">
																		<i class="icon-search"></i>
																		Buscar Cliente
																	</div>
																</span>
															</div>
															<div class="widget-body">
																<div class="widget-main">
																	<div class="profile-user-info">
																		<div class="profile-info-row ">
																			<div class="profile-info-name"> Cedula </div>
																			<div class="profile-info-value">
																				<label id="lbl_id_cliente" class="hide"></label>
																				<span class="editable" id="lbl_ced">0999999999</span>
																			</div>
																		</div>
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Nombre </div>

																			<div class="profile-info-value">
																				<span class="editable" id="lbl_nom">Cliente</span>
																			</div>
																		</div>
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Correo </div>
																			<div class="profile-info-value">
																				<span class="editable" id="lbl_cor">ejemplo@.com</span>
																			</div>
																		</div>
																		<div class="profile-info-row">
																			<div class="profile-info-name"> Telefono </div>
																			<div class="profile-info-value">
																				<span class="editable" id="lbl_tel">(09) 000-000</span>
																			</div>
																		</div>

																		<div class="profile-info-row">
																			<div class="profile-info-name"> Dirección </div>

																			<div class="profile-info-value">
																				<span class="editable" id="lbl_dir">Direccion</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="row-fluid">
															<div class="span12">
															</div>
														</div>
													</div>
													<div class="span7">
														<table id="reservacion_cliente" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th>Servicio</th>
																	<th>Horario</th>
																	<th>fecha</th>
																	<th width="10px;">Accion</th>
																</tr>
															</thead>
															<tbody>
															</tbody>
														</table>
													</div>
												</div>
											</div>
											<div id="reservaciones" class="tab-pane">
												<table id="tbl_reservaciones" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th>Nro</th>
															<th>Cedula</th>
															<th>Nombre</th>
															<th>Fecha</th>
															<th>Hora</th>
															<th>Servicio</th>
															<th>H. Inicio</th>
															<th>H. Fin</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
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

		<!-- modal cliente -->

		<div id="modal-cliente" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Informacion Cliente
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-container-span">
						<div class="span12">
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
					</div><!--/span-->
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-right" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
			</div>
		</div>
		<style type="text/css">#modal-cliente{width: 700px;}</style>
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
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>


		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script src="index.js"></script>
		<script src="js/jspdf.min.js"></script>
		<!--inline scripts related to this page-->
		<script src="app.js"></script>
	</body>
</html>
