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
		<link rel="stylesheet" href="../assets/css/bootstrap-editable.css" />

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
						<table id="tabla_usuarios" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th class="center">Nro.</th>
									<th class="center">Cedula</th>
									<th class="center">Nombre</th>
									<th class="center">Correo</th>
									<th class="center">Pass</th>
									<th class="center">Acción</th>
								</tr>
							</thead>

							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

		<!--Modal`s-->
			<div id="modal_nuevo" class="modal hide fade" tabindex="-1">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						REGISTRO NUEVO USUARIO
					</div>
				</div>

				<div class="modal-body">
					<div class="row-fluid">
						<form class="form-horizontal" id="form-nuevo-usuario">
							<div class="control-group">
								<label class="control-label" for="cedula">Cedula:</label>
								<div class="controls">
									<div class="span12">
										<input type="text" name="txt_cedula" id="txt_cedula" class="span8">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="Correo">Correo:</label>
								<div class="controls">
									<div class="span12">
										<input type="email" name="txt_correo" id="txt_correo" class="span8">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="Nombre y Apellido">Nombre y Apellido:</label>
								<div class="controls">
									<div class="span12">
										<input type="text" name="txt_nombre" id="txt_nombre" class="span8">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Password:</label>
								<div class="controls">
									<div class="span12">
										<input type="password" name="txt_pass" id="txt_pass" class="span8">
									</div>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password">Repita Password:</label>
								<div class="controls">
									<div class="span12">
										<input type="password" name="txt_pass1" id="txt_pass1" class="span8">
									</div>
								</div>
							</div>
							<div class="control-group">
								<div class="controls">
									<button type="submit" class="width-55 pull-right btn btn-small btn-success">
										Registrar
										<i id="icon-derecha" class="icon-arrow-right icon-on-right"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div id="modal_editar" class="modal hide fade" tabindex="-1">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						REGISTRO ACTUALIZACIÓN USUARIO
					</div>
				</div>

				<div class="modal-body padding">
					<div class="profile-user-info profile-user-info-striped">
						<div class="profile-info-row">
							<div class="profile-info-name"> Nombre </div>

							<div class="profile-info-value">
								<i class="icon-map-marker text-success icon-user"></i>
								<span class="editable" id="lbl_nombre">alexdoe</span>
							</div>
						</div>

						<div class="profile-info-row">
							<div class="profile-info-name"> Cedula </div>
							<div class="profile-info-value">
								<i class="icon-map-marker text-info icon-barcode"></i>
								<span class="editable" id="lbl_cedula">1004034805</span>
							</div>
						</div>

						<div class="profile-info-row">
							<div class="profile-info-name"> Correo </div>
							<div class="profile-info-value">
								<i class="icon-map-marker text-purple icon-envelope"></i>
								<span class="editable" id="lbl_correo">admin@gmail.com</span>
							</div>
						</div>

						<div class="profile-info-row">
							<div class="profile-info-name"> Password </div>
							<div class="profile-info-value">
								<i class="icon-map-marker text-error icon-icon-cogs"></i>
								<span class="editable" id="lbl_password">*********</span>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div id="modal_privilegio" class="modal hide fade" tabindex="-1">
				<div class="modal-header no-padding">
					<div class="table-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						REGISTRO ACTUALIZACIÓN USUARIO PRIVILEGIOS
					</div>
				</div>

				<div class="modal-body padding">
					<div class="row-fluid" id="obj_privilegio_usuario">
					</div>

				</div>
			</div>

		<!--PAGE CONTENT ENDS-->


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
		<script src="../../assets/js/bootbox.min.js"></script>
		<script src="../../assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="../../assets/js/x-editable/ace-editable.min.js"></script>
		<script src="../../assets/js/fuelux/data/fuelux.tree-sampledata.js"></script>
		<script src="../../assets/js/fuelux/fuelux.tree.min.js"></script>







		<script src="../../assets/js/jquery.dataTables.bootstrap.js"></script>
		<!--ace scripts-->

		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/bootstrap-wysiwyg.min.js"></script>

		<script src="../../assets/js/ace.min.js"></script>
		<script src="../../assets/js/blockui.js"></script>
		<script src="app.js"></script>
	</body>
</html>
