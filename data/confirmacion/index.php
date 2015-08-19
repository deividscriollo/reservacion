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
		<link rel="stylesheet" href="../../assets/css/jquery.gritter.css" />

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
							<div class="table-header">
								Resultado confirmaciones pendientes
							</div>
							<table id="tbt_mensajes" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="10px"><i class="icon-list"></i></th>
										<th>Servicio</th>
										<th width="30px">Accion</th>
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
		<div id="modal-form" class="modal hide" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Información de la Reservación</h4>
			</div>

			<div class="modal-body overflow-visible">
				<div class="row-fluid">
					<div class="span6">
						<div class="profile-user-info">
							<div class="profile-info-row">
								<inpu type="hidden" id="txt_id_reservacion">
								<div class="profile-info-name"> Cliente </div>

								<div class="profile-info-value">
									<span id="lbl_cliente">.</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name">Cedula</div>

								<div class="profile-info-value">
									<span id="lbl_cedula">.</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name">Correo</div>

								<div class="profile-info-value">
									<span id="lbl_correo">.</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name">Teléfono</div>

								<div class="profile-info-value">
									<span id="lbl_telefono">.</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Hora I. </div>

								<div class="profile-info-value">
									<span id="lbl_inicio">.</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name"> Hora F. </div>

								<div class="profile-info-value">
									<span id="lbl_fin">.</span>
								</div>
							</div>

							<div class="profile-info-row">
								<div class="profile-info-name"> Monto a  Pagar </div>

								<div class="profile-info-value">
									<span id="lbl_monto">.</span>
								</div>
							</div>
						</div>

					</div>
					<div class="span6">
						<div class="row-fluid" id="obj_deposito"></div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button class="btn btn-small btn-important" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cancelar
				</button>
				<button class="btn btn-small btn-success" id="btn_confirmar">
					<i class="icon-ok"></i>
					Confirmar Deposito
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

		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../../assets/js/jquery.dataTables.bootstrap.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../../assets/js/blockui.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>

		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script src="app.js"></script>
	</body>
</html>
<style type="text/css">
	#modal-form{
		position: relative;
		top: -200px;
		width: 900px; /* SET THE WIDTH OF THE MODAL */
		margin: -120px 0 0 -450px;
	}
</style>
