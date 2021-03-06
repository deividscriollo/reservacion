<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	// if(!isset($_SESSION["pass"])) {

	// 	header('Location: ../../inicio');
	// }
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
											<li>
												<a data-toggle="tab" href="#home">
												<i class="icon-group green" onclick="mostrar_usr();"></i> Usuarios</a>
											</li>
											<li>
												<a data-toggle="tab" href="#profile">
												<i class="icon-unlock blue"></i> Privilegios</a>
											</li>
											<li>
												<a data-toggle="tab" href="#info">
												<i class="icon-envelope red" onclick="mostrar_mensajes();"></i> Mensajes</a>
											</li>
											<li>
												<a data-toggle="tab" href="#privilegios">
												<i class="icon-cogs purple"></i> Configuración Privilegios</a>
											</li>
											<li class="active">
												<a data-toggle="tab" href="#nuevo">
												<i class="icon-user orange"></i> Nuevo</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="widget-body ">
									<div class="widget-main padding-6">
										<div class="tab-content">
											<div id="nuevo" class="tab-pane in active">
												<div class="row-fluid">
													<div class="span6">
														<h3 class="lighter block green">Digíte la siguiente información</h3>
														<form class="form-horizontal" id="form-usuario">
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
													<div class="span6">
														<table id="tbt_mostrar_usuarios" class="table table-striped table-bordered table-hover">
															<thead >
																<tr >
																	<th class="center">Cedula</th>
																	<th>Nombre</th>
																	<th>Telefono</th>
																	<th>Correo</th>
																</tr>
															</thead>
															<tbody>
																
															</tbody>
														</table>
													</div>
												</div>												
											</div>
											<div id="home" class="tab-pane">
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
											<div id="info" class="tab-pane ">
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
																		<div class="span9">
																			<h8 class="header green clearfix">Aquien desea enviar.?</h8>
																			<div class="control-group">
																				<div class="controls">
																					<span class="span12">
																						<label class="blue">
																							<input name="gender" value="1" type="radio" id="btn_todos" />
																							<span class="lbl">  A Todos</span>
																						</label>
																						<label class="blue">
																							<input name="gender" value="2" type="radio" id="btn_usuario" />
																							<span class="lbl"> A Clientes / Usuarios</span>
																						</label>
																						<label class="blue">
																							<input name="gender" value="3" type="radio" id="btn_admin" />
																							<span class="lbl"> Solo Usuarios Administradores</span>
																						</label>
																					</span>
																					<span class="alert-error" id="btn_error_msm">Seleccione una de las opciones</span>
																				</div>
																			</div>																		
																		</div>
																		<div class="span3">																			
																			<div class="span12 btn btn-primary " id="btn_enviar_mensaje"> Enviar </div>
																		</div>																	
																	</div>
																	<div class="row-fluid">
																	<h4 class="header green clearfix">Mensaje</h4>
																	<div class="wysiwyg-editor" id="editor1" name="editor1"></div>
																	<span class="alert-error" id="btn_error_msm2">Por favor, Digíte el Mensaje</span>
																	<div class="hr hr-double dotted"></div>

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
																	<th>Privilegio</th>
																	<th class="center">																		
																	</th>
																</tr>
															</thead>
															<tbody>
																
															</tbody>
														</table>
													</div>
												</div>												
											</div>
											<div  id="privilegios" class="tab-pane">
												<div class="row-fluid">
													<div class="span3">
														
													</div>
													<div class="span5">													
														<form class="form-horizontal" id="form-segmento-usuario">
															<div class="control-group">
																<label class="control-label" for="form-field-1">Digíte Segmento</label>

																<div class="controls">
																	<input type="text" id="txt_1" name="txt_1" placeholder="Nombre Segmento">
																</div>
															</div>
															<div class="form-actions">
																<button class="btn btn-info" type="submit">
																	<i class="icon-ok bigger-110"></i>
																	Enviar
																</button>
																&nbsp; &nbsp; &nbsp;
																<button class="btn" type="reset">
																	<i class="icon-undo bigger-110"></i>
																	Limpiar
																</button>
															</div>
														</form>
													</div>
												</div>
												<div id="con_obj_segmentos">
													<div class="row-fluid">
														<div class="widget-box span4">
															<div class="widget-header header-color-blue2">
																<h4 class="lighter smaller">Admin</h4>
															</div>

															<div class="widget-body">
																<div class="widget-main padding-8">
																	<div id="tree1" class="tree"></div>
																</div>
															</div>
														</div>
														<div class="widget-box span4">
															<div class="widget-header header-color-green2">
																<h4 class="lighter smaller">Administrador</h4>
															</div>

															<div class="widget-body">
																<div class="widget-main padding-8">
																	<div id="tree2" class="tree"></div>
																</div>
															</div>
														</div>
														<div class="widget-box span4">
															<div class="widget-header header-color-green">
																<h4 class="lighter smaller">Cliente Usuario</h4>
															</div>

															<div class="widget-body">
																<div class="widget-main padding-8">
																	<div id="tree3" class="tree"></div>
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




		<script src="../../assets/js/jquery.dataTables.bootstrap.js"></script>
		<script type="text/javascript" src="js/mostrar_usuario.js"></script>
		<script type="text/javascript" src="js/privilegios.js"></script>
		


		<!--ace scripts-->

		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/bootstrap-wysiwyg.min.js"></script>

		<script src="../../assets/js/ace.min.js"></script>
		<script src="../../assets/js/blockui.js"></script>
		<script type="text/javascript" src="js/segmento.js"></script>


		


		<!--inline scripts related to this page-->
		<script type="text/javascript">
	$(function(){
	
		function showErrorAlert (reason, detail) {
			var msg='';
			if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
			else {
				console.log("error uploading file", reason, detail);
			}
			$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
			 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
		}

		//$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

		//but we want to change a few buttons colors for the third style
		$('#editor1').ace_wysiwyg({
			toolbar:
			[
				'font',
				null,
				'fontSize',
				null,
				{name:'bold', className:'btn-info'},
				{name:'italic', className:'btn-info'},
				{name:'strikethrough', className:'btn-info'},
				{name:'underline', className:'btn-info'},
				null,
				{name:'insertunorderedlist', className:'btn-success'},
				{name:'insertorderedlist', className:'btn-success'},
				{name:'outdent', className:'btn-purple'},
				{name:'indent', className:'btn-purple'},
				null,
				{name:'justifyleft', className:'btn-primary'},
				{name:'justifycenter', className:'btn-primary'},
				{name:'justifyright', className:'btn-primary'},
				{name:'justifyfull', className:'btn-inverse'},
				null,
				{name:'createLink', className:'btn-pink'},
				{name:'unlink', className:'btn-pink'},
				null,
				{name:'insertImage', className:'btn-success'},
				null,
				'foreColor',
				null,
				{name:'undo', className:'btn-grey'},
				{name:'redo', className:'btn-grey'}
			],
			'wysiwyg': {
				fileUploadError: showErrorAlert
			}
		}).prev().addClass('wysiwyg-style2');
		$('[data-toggle="buttons-radio"]').on('click', function(e){
			var target = $(e.target);
			var which = parseInt($.trim(target.text()));
			var toolbar = $('#editor1').prev().get(0);
			if(which == 1 || which == 2 || which == 3) {
				toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
				if(which == 1) $(toolbar).addClass('wysiwyg-style1');
				else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
			}
		});

		if ( typeof jQuery.ui !== 'undefined' && /applewebkit/.test(navigator.userAgent.toLowerCase()) ) {			
			var lastResizableImg = null;
			function destroyResizable() {
				if(lastResizableImg == null) return;
				lastResizableImg.resizable( "destroy" );
				lastResizableImg.removeData('resizable');
				lastResizableImg = null;
			}

			var enableImageResize = function() {
				$('.wysiwyg-editor')
				.on('mousedown', function(e) {
					var target = $(e.target);
					if( e.target instanceof HTMLImageElement ) {
						if( !target.data('resizable') ) {
							target.resizable({
								aspectRatio: e.target.width / e.target.height,
							});
							target.data('resizable', true);
							
							if( lastResizableImg != null ) {//disable previous resizable image
								lastResizableImg.resizable( "destroy" );
								lastResizableImg.removeData('resizable');
							}
							lastResizableImg = target;
						}
					}
				})
				.on('click', function(e) {
					if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
						destroyResizable();
					}
				})
				.on('keydown', function() {
					destroyResizable();
				});
		    }
			
			enableImageResize();			
	}


});
		
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
