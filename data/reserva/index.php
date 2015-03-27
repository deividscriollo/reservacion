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
					<div class="row-fluid">
						<div class="span12">
							<div class="widget-main padding-6">
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="smaller">Reservacion directa</h5>

										<div class="widget-toolbar no-border">
											<ul class="nav nav-tabs" id="myTab">
												<li class="active">
													<a data-toggle="tab" href="#reserva">Reserva</a>
												</li>
												<li>
													<a data-toggle="tab" href="#clientes">Clientes</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="widget-body">
										<div class="widget-main padding-6">
											<div class="tab-content padding-4">
												<div id="reserva" class="tab-pane in active">
													<div class="span5">
														<div class="widget-box">
															<div class="widget-header">
																<h4>Reservacion directa</h4>
																<span class="widget-toolbar">
																	<div class="btn btn-info" id="btn_buscar_cliente">
																		<i class="icon-search"></i>
																		Buscar Cliente
																	</div>																
																</span>
															</div>
															<div class="widget-body">
																<div class="widget-main">
																	<form class="form-horizontal" id="form-reserva" />
																		<div class="control-group">
																			<div class="row-fluid">
																				<div class="span2"><label>Cedula:</label></div>																				
																				<div class="span10">
																					<label id="lbl_id_cliente" class="hide"></label>
																					<label id="lbl_ced"></label>
																				</div>
																			</div>
																			<div class="row-fluid">
																				<div class="span2"><label>Nombres:</label></div>
																				<div class="span10"><label id="lbl_nom"></label></div>
																			</div>
																			<div class="row-fluid">
																				<div class="span2"><label>Telefono:</label></div>
																				<div class="span10"><label id="lbl_tel"></label></div>
																			</div>
																			<div class="row-fluid">
																				<div class="span2"><label>Dirección:</label></div>
																				<div class="span10"><label id="lbl_dir"></label></div>
																			</div>

																		</div>
																		<div class="control-group">
																			<label class="control-label" for="platform">Tipo de Reservación</label>
																			<div class="controls">
																				<span class="span12">
																					<select id="selec_tipo"></select>
																				</span>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="platform">Seleccione Servicio</label>
																			<div class="controls">
																				<span class="span12">
																					<select class="" id="selec_servicio" name="selec_servicio">																											
																					</select>
																				</span>
																			</div>
																		</div>
																		<div class="control-group">
																			<label class="control-label" for="platform">Seleccione fecha</label>
																			<div class="controls">
																				<span class="span6">
																					<div class="row-fluid input-append">
																						<input 	class="date-picker span12" type="text" id="txt_fecha_origen" data-date-format="dd-mm-yyyy">																
																						<span class="add-on">
																							<i class="icon-calendar"></i>
																						</span>
																					</div>
																				</span>
																			</div>
																		</div>
																	</form>
																</div>
																<div class="widget-main">
																	<h4 class="smaller lighter green pull-right">
																		<i class="icon-list"></i>
																		Disponibilidad de Horario
																	</h4>
																</div>
																<div class="widget-main">											
																	<div class="row-fluid">
																		<table id="tabla_horas" class="table">
																			<thead>
																				<tr>
																					<th><i class="icon-dashboard"></i></th>
																					<th width="150px"><i class="icon-time green"></i>Hora inicio</th>
																					<th width="150px"><i class="icon-time red"></i>Hora fin</th>
																					<th width="100px"><i class="icon-calendar"></i>fecha</th>	
																					<th >Día</th>														
																				</tr>
																			</thead>											
																			<tbody></tbody>											
																		</table>
																	</div>
																	<div class="row-fluid">
																		<button class="btn btn-success btn-block icon-user danger span12 " id="btn_reservar"> RESERVAR</button>	
																	</div>
																</div>											
															</div>
														</div>
													</div>
													<div class="span7">
														<div class="widget-box" id="obj_procesos_pagar">
															<div class="widget-header">
																<h4>Proceso</h4>
															</div>

															<div class="widget-body">
																<div class="widget-main">
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
																	<div class="row-fluid">
																		<form class="form-horizontal" id="form-guardar">
																			<div class="span8">
																				<div class="control-group">
																					<label class="control-label" for="select">Seleccione Pago</label>
																					<div class="controls">
																						<select class="" id="sel_pago" name="sel_pago">
																							<option value="">Seleccione forma de Pago</option>
																							<option value="EFECTIVO">EFECTIVO</option>
																							<option value="TARJETA">TARJETA</option>														
																						</select>
																					</div>
																				</div>															
																			</div>
																			<div class="span4">
																				<button class="btn btn-small btn-success pull-right" id="btn_guardar_reservacion">
																					<i class="icon-ok"></i>
																					Pagar
																				</button>
																			</div>													
																		</form>																	
																	</div>
																</div>
															</div>
														</div>								
													</div>	
												</div>
												<div id="clientes" class="tab-pane">													
													<div class="span4">
														<form id="frm-registro" id="form-clientes">												
															<div class="control-group">														
																<span class="span12">
																	<label>
																		<span class="block input-icon input-icon-right">
																			<input type="text" class="span12" id="txt_reg_ced" name="txt_reg_ced" placeholder="Cedula" />
																			<i class="icon-barcode"></i>
																		</span>
																	</label>
																</span>														
															</div>
															<div class="control-group">														
																<span class="span12">
																	<label>
																		<span class="block input-icon input-icon-right">
																			<input type="email" class="span12" id="txt_reg_email" name="txt_reg_email" placeholder="email" />
																			<i class="icon-envelope"></i>
																		</span>
																	</label>
																</span>														
															</div>
															<div class="control-group">
																<div class="span12">
																	<label>
																		<span class="block input-icon input-icon-right">
																			<input type="text" class="span12" id="txt_reg_nom_usuario" name="txt_reg_nom_usuario" placeholder="nombre y apellido" />
																			<i class="icon-user" id="icon_b_usuario"></i>
																		</span>
																	</label>
																</div>														
															</div>
															<div class="control-group">
																<div class="span12">
																	<label>
																		<span class="block input-icon input-icon-right">
																			<input type="text" class="span12" id="txt_tel" name="txt_tel" placeholder="telefono" />
																			<i class="icon-user" id="icon_b_usuario"></i>
																		</span>
																	</label>
																</div>														
															</div>													
															<div class="control-group">
																<div class="span12">
																	<label>
																		<span class="block input-icon input-icon-right">
																			<input type="text" class="span12" placeholder="Direccion" id="txt_dir" name="txt_dir" />																			
																		</span>
																	</label>
																</div>
															</div>																														
															<div class="control-group red">
																<div class="span12">															
																	<div class="space-24"></div>

																		<div class="clearfix blue">
																			<button type="reset" class="width-35 pull-left btn btn-small">
																				<i class="icon-refresh"></i>
																				Limpiar
																			</button>

																			<button type="submit" class="width-55 pull-right btn btn-small btn-success">
																				Registrar
																				<i id="icon-derecha" class="icon-arrow-right icon-on-right"></i>
																				
																			</button>																	
																		</div>
																</div>
																
															</div>																									
														</form>
													</div>
													<div class="span8">
														<table id="tbt_mostrar_clientes" class="table table-striped table-bordered table-hover">
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
		<script type="text/javascript" src="index.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>	
		<!--inline scripts related to this page-->
	</body>	
</html>


<script type="text/javascript">

$('#btn_buscar_cliente').click(function(){
	$('#modal-cliente').modal('show');
});

//$("#btn_inicio").animate({ scrollTop: $('#inicio')[0].scrollHeight}, 500);
$("#btn_inicio").css({'cursor':'pointer'});
$("#btn_inicio").click(function(){
	$('html,body').animate({
		scrollTop:'1000px'},
		1000,
		function(){
		 	$('#btn_buscar_servicios').addClass('animated wobble');
            setTimeout ("renovar1()", 1000);
            $('#btn_buscar_servicios').css({'color':'red'});
		});
	return false;	
});

function renovar3() {
    $('#btn_buscar_servicios').removeClass('animated wobble');        
} 
function reconstruir(i){	
	$("#tabla_horas tbody tr").each(function (index) {
        var campo1, axus=0, campo3;
        $(this).children("td").each(function (index2) {
            switch (index2) {            	        	
                case 0:                	
                    $(this).children().children().removeAttr('checked');                    
                    break;                
            }        
        });       
    });

	$("#tabla_horas tbody tr").each(function (index) {        
        if (i==index) {
        	$(this).children("td").each(function (index2) {
	            switch (index2) {            	        	
	                case 0:                	
	                    $(this).children().children().prop("checked", "checked");                    
	                    break;                
	            }        
	        }); 
        }              
    });
}
// funciones de galeria
$(function() {
	var colorbox_params = {
		reposition:true,
		scalePhotos:true,
		scrolling:false,
		previous:'<i class="icon-arrow-left"></i>',
		next:'<i class="icon-arrow-right"></i>',
		close:'&times;',
		current:'{current} of {total}',
		maxWidth:'100%',
		maxHeight:'100%',
		onOpen:function(){
			document.body.style.overflow = 'hidden';
		},
		onClosed:function(){
			document.body.style.overflow = 'auto';
		},
		onComplete:function(){
			$.colorbox.resize();
		}
	};

	$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
	$("#cboxLoadingGraphic").append("<i class='icon-spinner orange'></i>");//let's add a custom loading icon

	/**$(window).on('resize.colorbox', function() {
		try {
			//this function has been changed in recent versions of colorbox, so it won't work
			$.fn.colorbox.load();//to redraw the current frame
		} catch(e){}
	});*/
})

$(function(){			
	
	
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
	
	 var fecha = sumaFecha(7,acufecha);
	 
	$('.date-picker').datepicker({					
		startDate: new Date(),
		endDate: fecha,
		format: 'dd/mm/yyyy',
		weekStart: 1
	});

	// scrollables
	$('.slim-scroll').each(function () {
		var $this = $(this);
		$this.slimScroll({
			height: $this.data('height') || 100,
			railVisible:true
		});
	});

		
$('#txt_fecha_origen').change(function(){	
	var fe=$(this).val()
	var dia=dia_semana(fe);		
	var id=$('#selec_servicio').val();
	console.log(id+fe+dia);
	buscar_horas(id,dia,fe);	
});
// busca la hora que esta disponible en esa fecha
function buscar_horas(reg,dia,fe){
	var res=':(';
	$.ajax({
        url: "reservacion.php",
        type: "POST",
        
        data:{buscar_horas:'ok', id:reg,dia:dia,f:fe},			               
        success: function(data)
        {	
			$("#tabla_horas tbody").html(data);
        }	                	        
    });
    //return res;
}
$('#tbt_mostrar_clientes').dataTable( {
        language: {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar: ",
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
		}
    });
// generar tableLayout
    $.ajax({
        url:'reservacion.php',
        type:'POST',
        dataType:'json',
        data:{mostrar_clientes:':)'},
        success:function(data){
            var a=1;
            for (var i=0; i<=(data.length); i=i+5) {                
                $('#tbt_mostrar_clientes').dataTable().fnAddData([
                  data[i+0],
                  data[i+1],                  
                  data[i+2],
                  data[i+3],
                  data[i+4],a
                  
                ]);                                    
                a++;
            }
        }
    });
});
</script>
