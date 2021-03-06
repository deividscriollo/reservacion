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
		<link href="../../assets/css/font-awesome.min.css" rel="stylesheet" />
		<link href="../../assets/css/jquery.gritter.css" rel="stylesheet"  />
		<link href="../assets/css/animate.css" rel="stylesheet"  />

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />


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
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="widget-box">
								<div class="widget-header">
									<h5 class="smaller">Proceso Usuario</h5>
									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs" id="myTab">
											<li class="active">
												<a data-toggle="tab" href="#info">
												<i class="icon-envelope red"></i> Mensajes</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="widget-body ">
									<div class="widget-main padding-6">
										<div class="tab-content">
											<div id="info" class="tab-pane in active">
												<div class="row-fluid">
													<div class="span4">
														<div class="widget-box">
															<div class="widget-header">
																<h4>
																	<i class="icon-tint"></i>
																	FORMULARIO ENVIO CORREO
																</h4>
															</div>
															<div class="widget-body">
																<div class="widget-main">
																<form id="form-mensajes">
																	<div class="row-fluid">
																	<h4 class="header green clearfix">Mensaje</h4>
																	<div class="wysiwyg-editor" id="editor1" name="editor1"></div>
																	</div>
																	<div class="row-fluid">
																		<input type="submit" class="span12 btn btn-primary " value="Enviar">
																	</div>
																</form>
																</div>
															</div>
														</div>
													</div>
													<div class="span8">
														<table id="tbt_mensajes" class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<th class="center">Cedula</th>
																	<th>Nombre</th>
																	<th>Correo</th>
																	<th class="center">Edad</th>
																	<th></th>
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

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		
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
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../../assets/js/markdown/markdown.min.js"></script>
		<script src="../../assets/js/markdown/bootstrap-markdown.min.js"></script>
		<script src="../../assets/js/jquery.hotkeys.min.js"></script>
		<script src="../../assets/js/fuelux/data/fuelux.tree-sampledata.js"></script>
		<script src="../../assets/js/fuelux/fuelux.tree.min.js"></script>
		<script src="../../assets/js/jquery.validate.min.js"></script>
		<script src="../../assets/js/additional-methods.min.js"></script>
		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.hotkeys.min.js"></script>
		<script src="../assets/js/select2.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="../assets/js/x-editable/ace-editable.min.js"></script>
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
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/bootstrap-wysiwyg.min.js"></script>




		<script src="../../assets/js/jquery.dataTables.bootstrap.js"></script>
		<!--ace scripts-->

		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/bootstrap-wysiwyg.min.js"></script>

		<script src="../../assets/js/ace.min.js"></script>
		<script src="../../assets/js/blockui.js"></script>
		<script src="app.js"></script>


	</body>
</html>
