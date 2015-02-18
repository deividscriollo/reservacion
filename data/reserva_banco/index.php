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
	
		<style type="text/css">
			.dc_spm{
				width: 100%;
				height: 300px;
				background: rgba(255,255,255,0.6);
				float: left;
			}
			.dc_btn{
				width: 0;
				height: 0;
				border-style: solid;
				border-width: 66px 100px 0 100px;
				border-color: #007bff transparent transparent transparent;
				display:block!important;
			}
			.dc_btn:hover{
				cursor: pointer;
							
			}
			.zoom{
				transition: 2.5s ease;
		 		-moz-transition: 2.5s ease; /* Firefox */
		 		-webkit-transition: 2.5s ease; /* Chrome - Safari */
		 		-o-transition: 2.5s ease; /* Opera */
			}
			.zoom:hover{
				transform : scale(1.2);
				-moz-transform : scale(1.2); /* Firefox */
				-webkit-transform : scale(1.2); /* Chrome - Safari */
				-o-transform : scale(1.2); /* Opera */
				-ms-transform : scale(1.2); /* IE9 */
			}
			.dctexto{
				padding-top: 50px;
				padding-left: 10%;				
			}
			.dctexto h4{
				font-size: 80px!important;
			}
			.dcm{

				float: right;
				width: 40%;
			}
			.dcespacio{
				height: 200px;
			}
		</style>		

	<body >
		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			
			<div class="main-contents" >
				<div class="page-content" style="background: rgba(25,25,25,0.1);!important;">
					
					<div class="row-fluid">
						<div class="span6">
							<div class="row"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>
							<div class="dc_spm">
								<div class="row-fluid">
									<div class="dctexto zoom">
										<h4 class="animated bounceInDown">Hola, </h4>
									</div>
									<div class="dctexto zoom">										
										<h4 class="animated bounceInUp"><?php $m=split(' ', $_SESSION['nom']); print $m[0];?></h4>
									</div>
								</div>
											
							</div>							
						</div>
						<div class="span6">
							<div class="widget-box">
								<div class="widget-header">
									<h4>Detalle Factura / Realizar Pago</h4>							
									
								</div>

								<div class="widget-body" style="background: rgba(255,255,255,0.9);!important;">
									<div class="widget-main">										
										<h4 class="header green">Detalle de la reservación</h4>
									</div>
									<div class="widget-main">
										<form class="form-horizontal">
										<h4 class="header green">Ingrese la informacion</h4>
										<div class="control-group">
											<label class="control-label" for="email">Valor a Pagar:</label>

											<div class="controls">
												<div class="span12">
												<?php 
													require('../../admin/class.php');
													$class=new constante();
													$acu=0;
													$id=$class->idz();
													$valor="";
													$nombre="";
													$resultado=$class->consulta("SELECT * FROM RESERVACION WHERE ID='".$_GET['id']."'");
													while ($row=$class->fetch_array($resultado)) {
													                       
													    //valores a consumir                      
													    $valor = $row[0];
													    $nombre =$row[3];
													    
													}													 
												?>

													<input type="email" name="text_valor_pagar" id="text_valor_pagar" class="span6" value="<?php print($nombre); ?>">
												</div>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="s2id_autogen1">Banco</label>
											<div class="controls">
												<span class="span12">
													<select>
														<option value=""></option>
														<option value="AL">banco A</option>
														<option value="AK">Banco B</option>
														<option value="AZ">Banco C	</option>
													</select>
												</span>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label" for="s2id_autogen1">Numero de Cuenta</label>
											<div class="controls">
												<span class="span12">
													<select>
														<option value=""></option>
														<option value="AL">024563</option>
														<option value="AK">39753543</option>
														<option value="AZ">5634534	</option>
													</select>
												</span>
											</div>
										</div>
										<div class="control-group">
											<div class="controls">
												<button class="btn btn-success btn-next" data-last="Finish ">
													Enviar Pago
													<i class="icon-arrow-right icon-on-right"></i>
												</button>
											</div>
										</div>
										</form>
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
					SERVICIOS DISPONIBLES
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
					<div class="page-content center" id="obj_contenedor_servicios">
														
					</div>
											
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
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.colorbox-min.js"></script>
		<script src="../assets/vegas/jquery.vegas.js"></script>
		



		<!--personal scripts-->
		<script type="text/javascript" src="index.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>	
		<!--inline scripts related to this page-->
	</body>	
</html>


<script type="text/javascript">

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

$.vegas('slideshow', {
  backgrounds:[
    { src:'../assets/images/gallery/dc1.jpg', fade:1000 },
    { src:'../assets/images/gallery/dc2.jpg', fade:1000 },
    { src:'../assets/images/gallery/dc3.jpg', fade:1000 }
  ]
})('overlay', {
  src:'../assets/vegas/overlays/11.png'
});


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
	bus_servicio(''); 
	$('#btn_buscar_servicios').popover('show');
	$('#btn_buscar_servicios').mouseover(function(){		
		$(this).css({'cursor':'pointer'});
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

	// scrollables
	$('.slim-scroll').each(function () {
		var $this = $(this);
		$this.slimScroll({
			height: $this.data('height') || 100,
			railVisible:true
		});
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
	
	 var fecha = sumaFecha(7,acufecha);
	 
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
	buscar_horas($('#id_servicio').html(),dia,fe);	
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
	
});
</script>
