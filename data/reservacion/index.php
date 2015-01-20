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

		<!--page specific plugin styles-->

		<!--ace styles-->

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
						<div class="widget-box">
							<div class="widget-header">
								<h4>Selecciones Servicio</h4>								
								<span 	class="widget-toolbar tooltip-info icon-animated-vertical"
										id="btn_buscar_servicios" 
										data-rel="popover" data-placement="left" 
										title="" 
										data-content="Digite la búsqueda del servicio y seleccione el servicio." 
										data-original-title="Realizar reservación: PASO 1 !!">
									<span >
										<i class="icon-search"></i>
									</span>
								</span>
							</div>

							<div class="widget-body">
								<div class="widget-main">
									<div class="row-fluid">
										<div class="span6">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="smaller">
														Información
														<small>Disponibilidad de horarios</small>
													</h4>
												</div>

												<div class="widget-body">
													<div class="widget-main">
														<div class="row-fluid">
															<div class="span3">
																<div id="id_servicio" class="hidden"></div>
																<label for="id-date-picker-1">Seleccione fecha:</label>
															</div>
															<div class="span4">																										
																<div class="control-group">																	
																	<div class="row-fluid input-append">
																		<input 	class="span8 date-picker" 
																				id="txt_fecha_origen" 
																				type="text" 
																				data-date-format="dd-mm-yyyy"
																				class="btn btn-success btn-small tooltip-success" 
																				data-rel="popover"
																				data-placement="right" 
																				title="<i class='icon-ok green'></i> Realizar Reservacion: Paso 2" 
																				data-content="Seleccione la fecha: Mostrara las horas disponibles para su reservación"/>
																		<span class="add-on">
																			<i class="icon-calendar"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="span3">
																<div class="row-fluid">
																	<label for="id-date-picker-1">Es el Día:</label>
																</div>
															</div>
															<div class="1">
																<div id="lbl_dia" class="blue"></div>
															</div>
														</div>
														<h4 class="smaller lighter green pull-right">
															<i class="icon-list"></i>
															Disponibilidad de Horario
														</h4>
														<!-- <div class="hr"></div> -->
														<div class="row-fluid">
															<div class="span12">
																<table id="tabla_horas" class="table">
																	<thead>
																		<tr>
																			<th>Nro</th>
																			<th>H. Inicio</th>
																			<th>H. Fin</th>
																			<th>fecha</th>
																			<th>Día</th>
																		</tr>
																	</thead>
																	<tbody>
																		
																	</tbody>
																</table>
															</div>
														</div>
														<div class="row-fluid">															
															<button class="btn btn-success btn-block icon-user danger span12 " href="#modal-reservacion" data-toggle="modal" id="btn_reservar"> RESERVAR</button>																														

														</div>														
													</div>
												</div>
											</div>
										</div><!--/span-->
										<div class="span6">
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="smaller">
														Información
														<small>Días y horarios de atención</small>
													</h4>
												</div>

												<div class="widget-body">
													<div class="widget-main">
														<table id="tabla_h_ser" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
															<thead>
																<tr>
																	<th>Nro</th>
																	<th>Días a reservar</th>
																	<th><i class="icon-time"></i> Inicia</th>
																	<th><i class="icon-time"></i> Finaliza</th>
																</tr>
															</thead>
															<tbody></tbody>
														</table>														
													</div>
												</div>
											</div>
											<div class="widget-box">
												<div class="widget-header">
													<h4 class="smaller">
														Información
														<small>Tarifas / Costos</small>
													</h4>
												</div>

												<div class="widget-body">
													<div class="widget-main">
														<table id="tabla_h_tarifa" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
															<thead>
																<tr>
																	<th>Nro</th>
																	<th>Tarifa</th>
																	<th><i class="icon-time"></i> Precio</th>																	
																</tr>
															</thead>
															<tbody></tbody>
														</table>														
													</div>
												</div>
											</div>
										</div><!--/span-->
										

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
					Horarios Dinámico
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-main" id="obj_contenedor" style="height:350px;">
					</div>					
				</div>									
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
				<button class="btn btn-small btn-success pull-left" data-dismiss="modal">
					<i class="icon-save"></i>
					Guardar
				</button>	
				<div class="pagination pull-center no-margin">
					
					<div class="hidden-phone visible-desktop action-buttons" >
						<a id="btn_m">
							<i class="icon-zoom-in bigger-130 blue pointer"></i>
						</a>
					</div>
						
				</div>												
			</div>
		</div><!--modal horario ENDS-->
		<!-- modal tarifa -->
		<div id="modal-servicio" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Servicios disponibles
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid pull-right">
					<div class="span12 pull-right">
						<form class="form-horizontal" id="form-reservacion">						
							<div class="control-group warning">
								<label class="control-label" for="form-field-1">Digitar Servicio</label>
								<div class="controls">
									<input 	class="icon-animated-vertical" 
											type="text" 
											id="txt_b_servicio"
											placeholder="Nombre del Servicio"
									>
								</div>
							</div>
						</form>								
					</div>					
					<div class="hr hr-dotted"></div>
						<table id="tabla_servicios" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
							<thead>
								<tr>
									<th>Servicio</th>
									<th>Descripción</th>
									<th>Otros</th>
									<th>Acción</th>
								</tr>
							</thead>
							<tbody>							
							</tbody>
						</table>		
				</div>									
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>																		
			</div>
		</div>
		<!-- modal reservacion  -->
		<div id="modal-reservacion" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Servicios de Reservación
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="span12">
						<form class="form-horizontal" id="form-v_reserva">					
							
						</form>									
					</div>	
				</div>
				<div class="row-fluid">
					<div class="span8">
						<table id="tabla_horas_acu" class="table">
							<thead>
								<tr>									
									<th>H. Inicio</th>
									<th>H. Fin</th>
									<th>fecha</th>
									<th>Día</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
					<div class="span4 pull-right">
						<table class="table table-striped">
							<tr><td class="pull-right">SubTotal: $</td><td><label id="lbl_subtotal">00.00</label></td></tr>
							<tr><td class="pull-right">Iva: $</td><td><label id="lbl_iva">00.00</label></td></tr>
							<tr><td class="pull-right">Total: $</td><td><label id="lbl_total">00.00</label></td></tr>
						</table>
					</div>
				</div>								
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-left" id="btn_g_reservar" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
				<button class="btn btn-small btn-success pull-right" id="btn_guardar_reservacion">
					<i class="icon-ok"></i>
					Reservar
				</button>																		
			</div>
		</div>
		<!--PAGE CONTENT ENDS-->
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
		



		<!--personal scripts-->
		<script type="text/javascript" src="index.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>	
		<!--inline scripts related to this page-->
	</body>	
</html>


<script type="text/javascript">
$(function(){	

	bus_servicio(''); 
	$('#btn_buscar_servicios').popover('show');
	$('#btn_buscar_servicios').mouseover(function(){		
		$(this).css({'cursor': 'pointer'});
	});

	// #modal-servicio
	$('#btn_buscar_servicios').click(function(){			
		$('#btn_buscar_servicios').popover('hide');		
		$('#modal-servicio').modal('show');
		$('#txt_b_servicio').popover('show');
	});
	$('#txt_fecha_origen').click(function(){
		// console.log($('#txt_fecha_origen'));
		// class="btn btn-success btn-small tooltip-success" 
	});
	$('#txt_b_servicio').click(function(){
		
		var valor=$(this);
		var acu=valor.parent().parent();
		$(acu).removeClass('warning');
		$(acu).addClass('success');

		
	});
	
	
	//$('#modal-servicio').modal('show');  
	$('[data-rel=popover]').popover({html:true});

	$('#my-btn').click(function () {
       
	     $('[data-toggle=popover]').popover('hide'); //EDIT: added this line to hide popover on button click.
	});
	
	// sumando fechas a la actual
	function sumaFecha(d, fecha)
	{
		var Fecha = new Date();
		var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
		var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
		var aFecha = sFecha.split(sep);
		var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
		fecha= new Date(fecha);
		fecha.setDate(fecha.getDate()+parseInt(d));
		var anno=fecha.getFullYear();
		var mes= fecha.getMonth()+1;
		var dia= fecha.getDate();
		mes = (mes < 10) ? ("0" + mes) : mes;
		dia = (dia < 10) ? ("0" + dia) : dia;
		var fechaFinal = dia+sep+mes+sep+anno;
		return (fechaFinal);
	}
	var fec=new Date();
	var acufecha=fec.getDate() + "/" + (fec.getMonth() +1) + "/" + fec.getFullYear();
	
	 var fecha = sumaFecha(5,acufecha);
	 
	$('.date-picker').datepicker({					
		startDate: new Date(),
		endDate: fecha,
		format: 'dd/mm/yyyy',
		weekStart: 1
	});
		
$('#txt_fecha_origen').change(function(){
	var fe=$(this).val()
	$('#lbl_dia').html(dia_semana(fe));
	var campo='';
	var dia=$('#lbl_dia').html();
	var horas=buscar_horas($('#id_servicio').html(),dia);
	var a=horas.split(",");
	if (a=='n') {
		console.log('no existe')
	};
	if (a!='n') {
		var f=$('#txt_fecha_origen').val();
		for (var i = parseInt(a[0]); i <a[1]; i++) {
			var h=i+':00';
			var j=i+1+':00';
			campo=campo+'<tr><td><label><input type="checkbox" /><span class="lbl"></span></label></td><td>'+h+'</td><td>'+j+'</td><td>'+f+'</td><td>'+dia+'</td></tr>';	
		};
	};
	// console.log(horas)
	
	$("#tabla_horas tbody").html(campo);
});
// busca la hora que esta disponible en esa fecha
function buscar_horas(reg,dia){
	var res=':(';
	$.ajax({
        url: "reservacion.php",
        type: "POST",
        async:false,
        data:{buscar_horas:'ok', id:reg,dia:dia},			               
        success: function(data)
        {			
			res=data;
			// $('#tabla_servicios tbody').html(data);
        }	                	        
    });
    return res;
}
	
});
</script>
