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



		
		



		<link rel="stylesheet" href="../assets/css/fontdc.css" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	

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
						<div class="span12 widget-container-span">
							<div class="widget-box">
								<div class="widget-header">
									<h5 class="smaller">Proceso Servicios</h5>

									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs" id="myTab">
											<li>
												<a data-toggle="tab" href="#home" id="btn_perfil">
													<i class="icon-cogs blue"></i>	
													Configuración
												</a>
											</li>

											<li class="active">
												<a data-toggle="tab" href="#profile" id="btn_profile">
													<i class="icon-edit green"></i>	
													Nuevo 
												</a>
											</li>

											<li >
												<a data-toggle="tab" href="#info" id="btn_servicos">
													<i class="icon-coffee orange"></i>	
													Servicios
												</a>
											</li>
											<li >
												<a data-toggle="tab" href="#categoria" id="btn_categoria">
													<i class="icon-th-large purple"></i>	
													Categoría
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="widget-body">
									<div class="widget-main padding-6">
										<div class="tab-content">
											<div id="home" class="tab-pane">												
												<div class="row-fluid">
													<div class="span6 center">	
														<div class="row-fluid">
															<div class="widget-box">
																<div class="widget-header widget-header-small header-color-dark">
																	<h6 class="smaller" id="lbl_servicios"></h6>
																	<span id="lbl_id_servicio" class="hide"></span>
																	<div class="widget-toolbar">																			
																		<span class="badge badge-info" id="lbl_fecha">info</span>
																		<span class="badge badge-success"><i class="icon-ok"></i></span>
																	</div>
																</div>

																<div class="widget-body">
																	<div class="widget-main">
																		<div class="row-fluid">
																			<div class="span3"></div>
																			<div class="span6">
																				<span class="profile-picture" id="img_foto"></span>
																				<div class="space-4"></div>																
																			</div>
																			<div class="span3"></div>																														
																		</div>
																		<div class="alert alert-info" id="lbl_descripcion"></div>
																	</div>
																</div>
															</div>
														</div>															
													</div>
													<div class="span6">
														<div class="row-fluid">
															<div class="span12">
																<div class="row-fluid">
																	<div class="span12">
																		<div class="widget-box">
																			<div class="widget-header header-color-green">
																				<h5 class="bigger lighter">
																					Asignación de Horarios
																				</h5>																				
																				<div class="widget-toolbar">
																					<a href="#" data-action="collapse">
																						<i class="1 icon-chevron-up"></i>
																					</a>
																					<a href="#modal-table" data-action="settings" data-toggle="modal" id="btn_modal_hora">
																						<i class="icon-time"></i>
																					</a>																																										
																				</div>
																			</div>
																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<table id="tabla_horario" class="table table-striped table-bordered table-hover">
																						<thead>								<tr>
																							<th>#</th>
																							<th>Dias</th>
																							<th><i class="icon-time bigger-110"></i> Inicio</th>
																							<th><i class="icon-time bigger-110"></i> Final</th>
																							<th><i class="icon-time bigger-110"></i> Lapso</th>
																							<th>Acción</th>
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
																<div class="row-fluid">
																	<div class="span12">
																		<div class="widget-box">
																			<div class="widget-header header-color-blue">
																				<h5 class="bigger lighter">
																					Asignación de Tarita / Precios
																				</h5>																				
																				<div class="widget-toolbar">
																					<a href="#" data-action="collapse">
																						<i class="1 icon-chevron-up"></i>
																					</a>
																					<a href="#modal-tarifa" data-action="settings" data-toggle="modal" id="btn_modal_tarifa">
																						<i class="icon-money"></i>
																					</a>																																										
																				</div>
																			</div>
																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<table id="tabla_tarifa" class="table table-striped table-bordered table-hover">
																						<thead>
																							<tr>
																								<th>Num</th>
																								<th>
																									<i class="icon-list bigger-110"></i>
																									Categoría
																								</th>
																								<th>Nombre Tarifa</th>
																								<th><i class="icon-money bigger-110"></i>Precio</th>																								
																								<th>Acción</th>
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
																<!-- <div class="row-fluid">
																	<div class="span12">
																		<div class="widget-box">
																			<div class="widget-header header-color-red3">
																				<h5 class="bigger lighter">
																					Galería Imagenes
																				</h5>																				
																				<div class="widget-toolbar">
																					<a href="#" data-action="collapse">
																						<i class="1 icon-chevron-up"></i>
																					</a>
																					<a href="#modal-galeria" data-action="settings" data-toggle="modal" id="btn_modal_hora">
																						<i class="icon-time"></i>
																					</a>																																										
																				</div>
																			</div>
																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<table id="tabla_horario" class="table table-striped table-bordered table-hover">
																						<thead>								<tr>
																							<th>#</th>
																							<th>Dias</th>
																							<th><i class="icon-time bigger-110"></i> Inicio</th>
																							<th><i class="icon-time bigger-110"></i> Final</th>
																							<th><i class="icon-time bigger-110"></i> Lapso</th>
																							<th>Acción</th>
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
																<div class="row-fluid">
																	<div class="span12">
																		<div class="widget-box">
																			<div class="widget-header header-color-dark">
																				<h5 class="bigger lighter">
																					Descripciones
																				</h5>																				
																				<div class="widget-toolbar">
																					<a href="#" data-action="collapse">
																						<i class="1 icon-chevron-up"></i>
																					</a>
																					<a href="#modal-descripcion" data-action="settings" data-toggle="modal" id="btn_modal_hora">
																						<i class="icon-time"></i>
																					</a>																																										
																				</div>
																			</div>
																			<div class="widget-body">
																				<div class="widget-main no-padding">
																					<table id="tabla_horario" class="table table-striped table-bordered table-hover">
																						<thead>								<tr>
																							<th>#</th>
																							<th>Dias</th>
																							<th><i class="icon-time bigger-110"></i> Inicio</th>
																							<th><i class="icon-time bigger-110"></i> Final</th>
																							<th><i class="icon-time bigger-110"></i> Lapso</th>
																							<th>Acción</th>
																						</tr>
																					</thead>
																						<tbody>																						
																							
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																</div> -->
															</div>
														</div>
													</div>													
												</div>
											</div>
										
																
													
											
											

											<div id="profile" class="tab-pane in active">
												<div class="row-fluid">
													<div class="span6">
														<div class="widget-box light-border">
															<div class="widget-header header-color-dark">
																<h5 class="smaller">Formulario Servicios</h5>

																<div class="widget-toolbar">
																	<span class="badge badge-important">Los campos son obligatorios</span>
																</div>
															</div>

															<div class="widget-body">
																<div class="widget-main padding-6">
																	<form class="form-horizontal" id="form-servicios" enctype="multipart/form-data"  />
																		<div class="row-fluid">
																			<input  type="file" name="txt_archivo" id="txt_archivo"  accept="image/*" /> 
																		</div>
																		<div class="row-fluid">																
																			<div class="span12">																	
																				<div class="control-group">
																					<label class="control-label" for="Servicio">Nombre del Servicio:</label>
																					<div class="controls">
																						<div class="span12">
																							<input type="text" name="txt_servicio" id="txt_servicio" class="span12" />
																						</div>
																					</div>
																				</div>
																				<div class="control-group">
																					<label class="control-label" for="password">Descripcion:</label>

																					<div class="controls">
																						<div class="span12">
																							<textarea class="span12" name="txt_descripcion" id="txt_descripcion"></textarea>
																						</div>
																					</div>
																				</div>
																				<div class="control-group">
																					<label class="control-label" for="email">Otros:</label>

																					<div class="controls">
																						<div class="span12">
																							<input type="text" name="txt_otros" id="txt_otros" class="span12" />
																						</div>
																					</div>
																				</div>
																			</div>																
																		</div>
																		<div class="row-fluid wizard-actions">
																			<button class="btn btn-success btn-next" type="submit">
																				<i class="icon-save icon-on-right"></i>
																				Guardar
																			</button>
																		</div>
																	</form>		
																</div>
															</div>
														</div>
													</div>
													<div class="span6">
														<div class="widget-box">
															<div class="widget-header header-color-blue3">
																<h5 class="bigger lighter">
																	<i class="icon-table"></i>
																	Tabla Información Servicios
																</h5>															
															</div>

															<div class="widget-body">
																<div class="widget-main no-padding">
																	<table id="tbl_servicios" class="table table-striped table-bordered table-hover">
																		<thead>
																			<tr>
																				<th><i class="icon-dashboard"></i></th>
																				<th><i class="icon-picture"></th>
																				<th>Categoría</th>
																				<th class="hidden-480">Estado</th>
																				<th class="hidden-480">Acción</th>																				
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
											<div id="info" class="tab-pane">
												<div class="profile-users clearfix" id="mostrar_servicios">
												</div>
											</div>
											<div id="categoria" class="tab-pane ">
												<div class="row-fluid">
													<div class="span6">
														<div class="widget-box light-border">
															<div class="widget-header header-color-dark">
																<h5 class="smaller">Formulario categoría</h5>

																<div class="widget-toolbar">
																	<span class="badge badge-important">Digíte los campos respectivos</span>
																</div>
															</div>

															<div class="widget-body">
																<div class="widget-main padding-6">
																	<form class="form-horizontal" id="form-categoria">
																		<div class="row-fluid">																
																			<div class="span12">
																				<label id="lbl_id_categoria" class="hide"></label>
																				<div class="control-group">
																					<label class="control-label" for="Servicio">Nombre Categoría:</label>
																					<div class="controls">
																						<div class="span12">
																							<input type="text" name="txt_categoria" id="txt_categoria" class="span6" />
																						</div>
																					</div>
																				</div>																				
																			</div>																
																		</div>
																		<div class="row-fluid wizard-actions">																			
																			<button class="btn btn-success btn-next" type="submit" id="btn_modificar_categoria">
																				<i class="icon-save icon-on-right"></i>
																				Guardar
																			</button>
																		</div>


																	</form>
																</div>
															</div>
														</div>														
													</div>
													<div class="span6">
														<div class="widget-box">
															<div class="widget-header header-color-purple">
																<h5 class="bigger lighter">
																	<i class="icon-table"></i>
																	Tabla Información categoría
																</h5>															
															</div>

															<div class="widget-body">
																<div class="widget-main no-padding">
																	<table id="tbl_categoria" class="table table-striped table-bordered table-hover">
																		<thead>
																			<tr>
																				<th><i class="icon-coffe"></i>Nro</th>
																				<th>Categoría</th>
																				<th class="hidden-480">Fecha</th>
																				<th class="hidden-480">Estado</th>
																				<th class="hidden-480">Acción</th>																				
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
						</div>
					</div>
				</div>
			</div><!--/.main-content-->
		</div><!--/.main-container-->
		<!-- ventana emergente horario -->
		<div id="modal-table" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Asignacion de Horarios
				</div>
			</div>

			<div class="modal-body no-padding">				
				<div class="row-fluid">
					<form class="form-horizontal" id="form-horario"/>
						<div class="center">
							<h3 class="lighter block green">Todos los campos son obligatorios</h3>																							
						</div>

						<div class="row-fluid">
							<div class="span12">
								<div class="control-group">
									<label class="control-label" for="Servicio">Seleccione Dias:</label>
									<div class="controls">
										<div class="span12" id="obj_select_dias">
											<!-- <select multiple="" class="select2" id="txt_1_horario" name="txt_1_horario"> -->
											<select multiple="" class="select2" id="txt_0_horario" name="txt_0_horario" style="Border:blue;" data-placeholder="Seleccione">												

											</select>										
										</div>
									</div>
								</div>
							</div>								
						</div>
						<div class="row-fluid">
							<div class="span8">
								<div class="control-group">
									<label class="control-label" for="Servicio">Lapso de Hora:</label>
									<div class="controls">
										<div class="span3 input-append bootstrap-timepicker">
											<input id="txt_1_horario" name="txt_1_horario" type="text" class="input-small" />
											<span class="add-on">
												<i class="icon-time"></i>
											</span>
										</div>
									</div>
								</div>
								


								<div class="control-group">								
									<label class="control-label" for="Servicio">Hora inicio:</label>
									<div class="controls">
										<div class="input-append bootstrap-timepicker">
											<input id="txt_2_horario" name="txt_2_horario" type="text" class="input-small" />
											<span class="add-on">
												<i class="icon-time"></i>
											</span>
										</div>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="Servicio">Hora Fin:</label>
									<div class="controls">
										<div class="input-append bootstrap-timepicker">
											<input id="txt_3_horario" name="txt_3_horario" type="text" class="input-small" />
											<span class="add-on">
												<i class="icon-time"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="span4">
								<span id="reloj"></span>
							</div>	
						</div>							
						<div class="control-group">
							<div class="controls">
								<button class="btn btn-small btn-success" type="submit">
									<i class="icon-save"></i>
									Guardar
								</button>
							</div>
						</div>							
					</form>															
				</div>									
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-rigth" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>								
			</div>
		</div><!--modal horario ENDS-->
		<!-- modal tarifa -->
		<div id="modal-tarifa" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Tarifa de serivicio
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-main">
						<form class="form-horizontal" id="form-tarifa"/>
							<div class="row-fluid">
								<div class="span8">
									<div class="control-group">
										<label class="control-label" for="Servicio">Seleccione Categoría:</label>
										<div class="controls">
											<div class="span12" id="sel_categoria_mostrar">
												<!-- <select multiple="" class="select2" id="txt_1_horario" name="txt_1_horario"> -->
																						
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="name">TARIFA:</label>
										<div class="controls">
											<span class="span12">
												<input class="span12" type="text" id="t_nombre" name="t_nombre" />
											</span>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" for="name">PRECIO:</label>
										<div class="controls">
											<span class="span12">
												<input class="span12" type="text" id="t_precio" name="t_precio" />
											</span>
										</div>									
									</div>
									<div class="controls">
										<button class="btn btn-small btn-success" type="submit">
											<i class="icon-save"></i>
											Guardar
										</button>
									</div>	
								</div>
							</div>
						</form>
					</div>					
				</div>									
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-rigth" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
																	
			</div>
		</div>
		


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




		<!--personal scripts-->
		<script type="text/javascript" src="js/guardar.js"></script>		
		<script type="text/javascript" src="js/servicios.js"></script>
		<script type="text/javascript" src="js/editar.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script type="text/javascript" src="js/horario.js"></script>
		<script type="text/javascript" src="js/tarifa.js"></script>

		<!--inline scripts related to this page-->
	</body>
</html>

<script type="text/javascript">




$(function(){
	$('#txt_1_horario').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false
	});
	$('#txt_2_horario').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false
	});
	$('#txt_3_horario').timepicker({
		minuteStep: 1,
		showSeconds: true,
		showMeridian: false
	});		
	$('#btn_perfil').hide();
	  
	 
});

window.onload=show5;
function show5(){
	if (!document.layers&&!document.all&&!document.getElementById)
		return
		var Digital=new Date();
		var hours=Digital.getHours();
		var minutes=Digital.getMinutes();
		var seconds=Digital.getSeconds();
		var dn="PM";
		if (hours<12)
			dn="AM"
		if (hours>12)
			hours=hours-12
		if (hours==0)
			hours=12
		if (minutes<=9)
			minutes="0"+minutes
		if (seconds<=9)
			seconds="0"+seconds
		//change font size here to your desire
		myclock="<font size='5' face='Arial' ><b><font size='2'>Hora actual:</font></br>"+hours+":"+minutes+":"
		 +seconds+" "+dn+"</b></font>"
		if (document.layers){
			document.layers.liveclock.document.write(myclock)
			document.layers.liveclock.document.close()
		}
		else if (document.all)
			liveclock.innerHTML=myclock
		else if (document.getElementById)
			document.getElementById("reloj").innerHTML=myclock
		setTimeout("show5()",1000)
 }




                      

	function modificar_categoria(id, nombre){
		$('#btn_modificar_categoria').html('<i class="icon-edit icon-on-right"></i> Modificar');	
		$('#lbl_id_categoria').html(id);
		$('#txt_categoria').val(nombre);
		//$('#form-categoria').removeAttr('id');
		$('#form-categoria').prop('id','form-categoria-modificar');
		$('#btn_modificar_categoria').removeAttr('type');
		//console.log(frm_categoria);

	}
	$('#btn_modificar_categoria').click(function(){
		
	})

	function eliminar_servicios(id,nombre){
		bootbox.confirm("<h1>Seguro desea eliminar<h1>", function(result) {
			if(result) {
				$.ajax({
					url:'php/tarifa.php',
					type:'POST',
					data:{eliminar_servicios:'ok', id:id, nom:nombre},
					success:function(data){
						mostrar_servicios();               						
						if (data==1) {
							$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  '+nombre+' fue eliminado. <br><i class="icon-spinner icon-spin green bigger-230"></i>',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: 2000
							});	
						};
						if (data!=1) {
							$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'TENEMOS INCONVENIENTES INTENTE MAS TARDE<br><i class="icon-cloud purple bigger-230"></i> comuniquese con el administrador <br><i class="icon-spinner icon-spin purple bigger-230"></i> : [',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: ''
							});
						}
						

					}
				});
			}
		});	
	}
	function eliminar_categoria(id,nombre){
		bootbox.confirm("<h1>Seguro desea eliminar<h1>", function(result) {
			if(result) {
				$.ajax({
					url:'php/tarifa.php',
					type:'POST',
					data:{eliminar_categoria:'ok', id:id, nom:nombre},
					success:function(data){
						mostrar_categoria();               						
						if (data==1) {
							$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  '+nombre+' fue eliminado. <br><i class="icon-spinner icon-spin green bigger-230"></i>',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: 2000
							});	
						};
						if (data!=1) {
							$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'TENEMOS INCONVENIENTES INTENTE MAS TARDE<br><i class="icon-cloud purple bigger-230"></i> comuniquese con el administrador <br><i class="icon-spinner icon-spin purple bigger-230"></i> : [',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: ''
							});
						}
						

					}
				});
			}
		});			
	}
			$(function() {
								
				
			
				//another option is using modals
				$('#avatar2').on('click', function(){				
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click para seleccionar una imagen',
						btn_change:null,
						no_icon:'icon-picture',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						before_change: function(files, dropped) {
							var file = files[0];
							if(typeof file === "string") {
								//file is just a file name here (in browsers that don't support FileReader API)
								if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
							}
							else {//file is a File object
								var type = $.trim(file.type);
								if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
										|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
									) return false;
			
								if( file.size > 110000 ) {//~100Kb
									return false;
								}
							}
			
							return true;
						}
					});
			
					form.on('submit', function(){
						if(!file.data('ace_input_files')) return false;
						
						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='icon-spinner icon-spin bigger-150 orange'></i></div>");
						
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							
							modal.modal("hide");
			
							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#avatar2').get(0).src = thumb;
			
							working = false;
						});
						
						
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
			
						return false;
					});
							
				});
			
			
			
				///////////////////////////////////////////
				

				$('#txt_archivo').ace_file_input({
					style:'well',
					btn_choose:'Seleccionar Imagen',
					btn_change:null,
					no_icon:'icon-picture',
					thumbnail:'large',
					droppable:true,
					before_change: function(files, dropped) {
						var file = files[0];
						if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
							if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
						}
						else {//file is a File object
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
									|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
								) return false;
			
							
						}
			
						return true;
					}
				})

				$('#txt_archivo1').ace_file_input({
					style:'well',
					btn_choose:'Seleccionar Imagen',
					btn_change:null,
					no_icon:'icon-picture',
					thumbnail:'large',
					
					before_change: function(files, dropped) {
						var file = files[0];
						if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
							if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
						}
						else {//file is a File object
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
									|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
								) return false;
			
							
						}
			
						return true;
					}
				})


			});
</script>