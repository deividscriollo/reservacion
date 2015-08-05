<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../inicio');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
		<meta charset="utf-8" />
		<title>FABRICA IMBABURA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />

		<!--Css Especificos-->

		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="../assets/css/select2.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-editable.css" />

		<!--basic styles-->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css"  />
		<link rel="stylesheet" href="../assets/css/bootstrap-responsive.min.css"  />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />
		<link rel="stylesheet" href="../assets/css/colorbox.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />



		<!--page specific plugin styles-->

		<!--ace styles-->

		<link rel="stylesheet" href="../assets/css/fontdc.css" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/animate.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<body >
		<?php require('../inicio/menu.php'); menunav(); ?>
		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<?php menu(); ?>
			<div class="main-content">
				<div class="page-content">
					<div class="page-header position-relative">
						<h1>
							Adición Reserva / Cliente
							<small>
								<i class="icon-double-angle-right"></i>
								Adicionar servicios a la reservación
							</small>
						</h1>
					</div><!--/.page-header-->
					<div class="row-fluid">
						<div class="span6">
							<div class="row-fluid">
								<div class="widget-box transparent no-padding">
									<div class="widget-header">
										<h4>Información Cliente</h4>
										<span class="widget-toolbar">
											<div class="btn btn-info" id="btn_buscar_cliente">
												<i class="icon-search"></i>
												Buscar
											</div>
										</span>
									</div>
								</div>
							</div>
							<div class="row-fluid">
								<div class="profile-user-info ">
									<div class="profile-info-row ">
										<div class="profile-info-name"> Cedula: </div>
										<span id="lbl_id_cliente" class="hide"></span>
										<div class="profile-info-value">
											<span id="lbl_ced">00000000-0</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Nombre: </div>

										<div class="profile-info-value">
											<span id="lbl_nom">Cliente</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Dirección: </div>

										<div class="profile-info-value">
											<i class="icon-map-marker light-orange bigger-110"></i>
											<span id="lbl_dir">Atuntaqui</span>
										</div>
									</div>
									<div class="profile-info-row">
										<div class="profile-info-name"> Correo: </div>

										<div class="profile-info-value">
											<span id="lbl_cor">correo@live.com</span>
										</div>
									</div>

									<div class="profile-info-row">
										<div class="profile-info-name"> Teléfono: </div>

										<div class="profile-info-value">
											<span id="lbl_tel">098-7113-522</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="widget-box transparent">
								<div class="widget-header">
									<h4>Información Reservación</h4>
									<div class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>
									</div>

								</div>
								<div class="widget-body">
									<div class="widget-main" id="obj_reservaciones">
									</div>
								</div>
							</div>
						</div>
					</div>

					<h3 class="header smaller lighter blue">
						Servicios Adicionales
					</h3>

					<div class="row-fluid">
						<div class="span3">
							<label for="form-field-select-3">Seleccione Categoría</label>
							<select class="chzn-select" id="select_categoria" data-placeholder="Seleccione Categoría"></select>
						</div>
						<div class="span9">
							<div class="row-fluid">
								<div class="span4 pricing-span-header">
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
													<li> 00.00 </li>
												</ul>
											</div>
											<div>
												<ul class="unstyled list-striped center">
													<li> 00.00 </li>
												</ul>
											</div>
											<div class="widget-header header-color-green">
												<h5 class="bigger center"> 00.00</h5>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.main-container-->
		<!-- ventana emergente horario -->
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

		<!--PAGE CONTENT ENDS-->
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
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.hotkeys.min.js"></script>
		<script src="../assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="../assets/js/select2.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="../assets/js/x-editable/ace-editable.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js"></script>
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
		<script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/additional-methods.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/blockui.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.colorbox-min.js"></script>
		<script src="../assets/vegas/jquery.vegas.js"></script>
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.js"></script>





		<!--personal scripts-->
		<script type="text/javascript" src="app.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<!--inline scripts related to this page-->
	</body>
</html>
<style type="text/css">#modal-cliente{width: 700px;}</style>