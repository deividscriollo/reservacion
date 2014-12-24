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
		<link rel="stylesheet" href="../../assets/css/jquery.gritter.css" />
		

		<link rel="stylesheet" href="../../assets/css/fontdc.css" />

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
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="#">Usuario</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Menu Principal</li>
					</ul><!--.breadcrumb-->
				</div>

				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="widget-box">
								<div class="widget-header">
									<h5 class="smaller">Proceso Usuario</h5>

									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs" id="myTab">
											<li class="active">
												<a data-toggle="tab" href="#home">
												<i class="icon-user green" onclick="mostrar_usr();"></i> Usuarios</a>
											</li>

											<li>
												<a data-toggle="tab" href="#profile">
												<i class="icon-unlock blue"></i> Privilegios</a>
											</li>

											<li>
												<a data-toggle="tab" href="#info">
												<i class="icon-envelope red"></i> Mensajes</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="widget-body">
									<div class="widget-main padding-6">
										<div class="tab-content">
											<div id="home" class="tab-pane in active">
												<table id="tbt_mostrar_usuarios" class="table table-striped table-bordered table-hover">
													<thead >
														<tr >
															<th class="center">Cedula</th>
															<th >Nombre</th>
															<th>Telefono</th>
															<th>Correo</th>
															<th class="center">Edad</th>
															<th>Fecha Reg.</th>
															<th>Privilegio</th>
															<th>Estado</th>															
														</tr>
													</thead>

													<tbody>
														
													</tbody>
												</table>

											</div>

											<div id="profile" class="tab-pane">
												<table id="tbt_privilegios" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th class="center">Cedula</th>
															<th>Nombre</th>
															<th>Telefono</th>
															<th>Correo</th>
															<th class="center">Edad</th>
															<th>Fecha Reg.</th>
															<th>Estado</th>
															<th>Privilegio</th>
															<th>Configurar</th>
														</tr>
													</thead>

													<tbody>
														
													</tbody>
												</table>
											</div>

											<div id="info" class="tab-pane">
												<table id="tbt_mensajes" class="table table-striped table-bordered table-hover">
													<thead>
														<tr>
															<th class="center">Cedula</th>
															<th>Nombre</th>
															<th>Telefono</th>
															<th>Correo</th>
															<th class="center">Edad</th>
															<th>Fecha Reg.</th>
															<th>Estado</th>															
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

		<script src="../../assets/js/jquery.dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="js/mostrar_usuario.js"></script>
		<script type="text/javascript" src="js/privilegios.js"></script>
		


		<!--ace scripts-->

		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
		<script type="text/javascript">

			
			//envio a cambiar usuario en estado

			$(document).ready(function() {

				function cargar_mensajes(){
					var table=$('#tbt_mensajes').dataTable( {
				        language: {
						    "sProcessing":     "Procesando...",
						    "sLengthMenu":     "Mostrar _MENU_ registros",
						    "sZeroRecords":    "No se encontraron resultados",
						    "sEmptyTable":     "Ningún dato disponible en esta tabla",
						    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
						    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						    "sInfoPostFix":    "",
						    "sSearch":         "Buscar:",
						    "sUrl":            "",
						    "sInfoThousands":  ",",
						    "sLoadingRecords": "Cargando...",
						    "oPaginate": {
						        "sFirst":    "Primero",
						        "sLast":     "Último",
						        "sNext":     "Siguiente",
						        "sPrevious": "Anterior"
						    },
						    "oAria": {
						        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
						    }
						},					
				        ajax: { "url": "php/mostrar_usuarios.php"}
				    });	
				}			
			    //cargar_mensajes();
			} );
		</script>
		
		
	</body>
</html>
