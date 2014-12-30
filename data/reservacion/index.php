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
						<div class="widget-box">
							<div class="widget-header">
								<h4>Selecciones Servicio</h4>
								<span class="widget-toolbar">
									<a  href="#modal-servicio" data-toggle="modal">
										<i class="icon-search"></i>
									</a>
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
															<div class="span8">
																<div class="row-fluid">
																	<label for="id-date-picker-1">Seleccione fecha:</label>
																</div>
																<div class="control-group">
																	<div class="row-fluid input-append">
																		<input class="span10 date-picker" id="txt_fecha_origen" type="text" data-date-format="dd-mm-yyyy" />
																		<span class="add-on">
																			<i class="icon-calendar"></i>
																		</span>
																	</div>
																</div>
															</div>
															<div class="span4">
																<div class="row-fluid">
																	<label for="id-date-picker-1">Es el Día:</label>
																</div>

																<div class="control-group">
																	<div id="lbl_dia" class="blue"></div>
																</div>
															</div>
														</div>
														<div class="hr"></div>
														<div class="row-fluid">
															<div class="span12">
																<table id="tabla_horas" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
																	<thead>
																		<tr>
																			<th>Nro</th>
																			<th>Accion</th>
																			<th>Hora</th>
																			<th>fecha</th>
																		</tr>
																	</thead>
																	<tbody></tbody>
																</table>
															</div>
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
				<div class="row-fluid">
					<div class="span12">
					Digitar Servicio: <input type="text" id="txt_b_servicio">	
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


		<!--personal scripts-->
		<script type="text/javascript" src="index.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
	

		<!--inline scripts related to this page-->
	</body>
</html>
<tr><td></td></tr>
<script type="text/javascript">
$(function(){
	var campo='';
	for (var i = 0; i <8; i++) {
		campo=campo+'<tr><td><label><input type="checkbox" /><span class="lbl"></span></label></td><td>hola1</td><td>hola2</td><td>hola3</td></tr>';	
	};
	
	$("#tabla_horas tbody").append(campo);
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
	// console.log(dia_semana(fe))
	$('#lbl_dia').html(dia_semana(fe))
})


	//Recibe fecha en formato DD/MM/YYYY  
function dia_semana(fecha){   
    fecha=fecha.split('/');  
    if(fecha.length!=3){  
            return null;  
    }  
    //Vector para calcular día de la semana de un año regular.  
    var regular =[0,3,3,6,1,4,6,2,5,0,3,5];   
    //Vector para calcular día de la semana de un año bisiesto.  
    var bisiesto=[0,3,4,0,2,5,0,3,6,1,4,6];   
    //Vector para hacer la traducción de resultado en día de la semana.  
    var semana=['DOMINGO', 'LUNES', 'MARTES', 'MIÉRCOLES', 'JUEVES', 'VIERNES', 'SÁBADO'];  
    //Día especificado en la fecha recibida por parametro.  
    var dia=fecha[0];  
    //Módulo acumulado del mes especificado en la fecha recibida por parametro.  
    var mes=fecha[1]-1;  
    //Año especificado por la fecha recibida por parametros.  
    var anno=fecha[2];  
    //Comparación para saber si el año recibido es bisiesto.  
    if((anno % 4 == 0) && !(anno % 100 == 0 && anno % 400 != 0))  
        mes=bisiesto[mes];  
    else  
        mes=regular[mes];  
    //Se retorna el resultado del calculo del día de la semana.  
    return semana[Math.ceil(Math.ceil(Math.ceil((anno-1)%7)+Math.ceil((Math.floor((anno-1)/4)-Math.floor((3*(Math.floor((anno-1)/100)+1))/4))%7)+mes+dia%7)%7)];  
} 
// alert(dia_semana('03/12/2014'));  
});
</script>
<?php 

function diaSemana($ano,$mes,$dia)
{
    // 0->domingo     | 6->sabado
    $dia= date("w",mktime(0, 0, 0, $mes, $dia, $ano));
    if ($dia==1) {
    	return 'LUNES';
    }elseif ($dia==1) {
    	return 'LUNES';
    }elseif ($dia==2) {
    	return 'MARTES';
    }elseif ($dia==3) {
    	return 'MIERCOLES';
    }elseif ($dia==4) {
    	return 'JUEVES';
    }elseif ($dia==5) {
    	return 'VIERNES';
    }elseif ($dia==6) {
    	return 'SABADO';
    }elseif ($dia==7) {
    	return 'DOMINGO';
    }
       
}
 
/**
 * Ejemplo de uso
 */
$diaSemana = diaSemana("2014", "12", "03");
// echo $diaSemana;

?>