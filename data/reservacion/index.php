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
				cursor: pointer;
			}
			.dc_text{
				font-size: 100px;				
			}
			.txt_zise{
				font-size: 40px;					
			}
			.dc_padding{
				padding-top: 2%;
			}
			.dc_estandar_usuario{
				font-size: 80px;
				height: 500px;
				padding-top: 10%;
				padding-left: 5px;
				padding-bottom: 20px;
				background: rgba(255,255,255,0.8);
			}
			.dc_estandar_reserva{
				height: 500px;
				padding-top: 5%;
				background: rgba(255,255,255,0.8);
				padding-left: 5%;
				padding-right: 2%;
				padding-bottom: 1px;
			}
			.dcespacio{
				height: 200px;
			}
			.dc_dise_redondo{
				background: rgba(255,255,255,0.6);
				height: 200px;
				border-radius: 200px 200px 200px 200px;
				-moz-border-radius: 200px 200px 200px 200px;
				-webkit-border-radius: 200px 200px 200px 200px;
				border: 0px solid #000000;
				padding-top: 20px;
			}
			.texto p{
				font-size: 50px;
			}
			.texto2 h4{
				font-size: 30px;
			}
			select{
				width: 350px;
				padding-top: 15px;
				/*padding-bottom: 15px;*/
				
			    -webkit-border-radius:4px;
			    -moz-border-radius:4px;
			    border-radius:4px;
			    
			    background: rgba(255,255,255,0.4);
			    color:#888;
			    cursor:pointer;
			    font-size: 18px;
			    height: 63px!important;
			}
			.dc_fecha{

				background: rgba(255,255,255,0.4)!important;
				padding-top: 10px !important;
				padding-bottom: 10px !important;
				padding-left: 10px !important;
				border-radius: 3px !important;
				text-align: center;
			}
			#tabla_horas{
				background: rgba(255,255,255,0.4)!important;
				font-size: 20px;
				color: #3085C9;
			}
		</style>		

	<body >
		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<div class="main-contents">
				<div class="row-fluid dc_padding">
					<div class="span4">
						<div class="dc_estandar_usuario">
							<div class="blue smaller zoom dc_text">								
								Hola,
							</div>
							<br/><br/>
							<i class="icon-user purple  zoom">
								<?php $m=split(' ', $_SESSION['nom']); print $m[0];?>
							</i>												
						</div>
					</div>
					<div class="span8">
						<div class="dc_estandar_reserva">
							<div class="row-fluid" id="obj_1">
								<div class="span12 center">
									<div class="texto blue">
										<h4 class="animated bounceInDown txt_zise">Seleccione tipo de reservación</h4>
									</div>
									<br>
									<div class="row">
										<select id="selec_tipo"></select>	
									</div>																																					
								</div>
							</div>
							<div class="row-fluid" id="obj_2">
								<div class="row center">
									<div class="span4">
										<div id="obj_btn_informacion">
											<div class="row">
												<div class="texto2 blue">
													<h4 class="animated bounceInDown txt_zise">Información</h4>
												</div>
											</div>
											<div class="row">
												<p>
													<button class="btn btn-app btn-danger btn-mini radius-4" id="btn_atras_ob1">
														<i class="icon-angle-left bigger-160"></i>
														Atras												
													</button>
													<button class="btn btn-app btn-info btn-mini radius-4" id="btn_modal_informacion">
														<i class="icon-info bigger-160"></i>
														Servicios												
													</button>
													<button class="btn btn-app btn-success btn-mini radius-4" id="btn_modal_tarifa">
														<i class="icon-money bigger-160"></i>
														Tarifas												
													</button>
													<button class="btn btn-app btn-warning btn-mini radius-4" id="btn_modal_horarios">
														<i class="icon-time bigger-160"></i>
														Horarios											
													</button>
												</p>
											</div>
										</div>
									</div>	
									<div class="span4">
										<div class="row">
											<div class="texto2 blue">
												<h4 class="animated bounceInDown txt_zise">Seleccione fecha</h4>
											</div>
										</div>
										<div class="row">
											<div class="span12">
												<div class="row-fluid input-append">
													<input 	class="dc_fecha date-picker" 
															id="txt_fecha_origen" 
															type="text" 
															data-date-format="dd-mm-yyyy">
															
													<span class="add-on bigger-260">
														<i class="icon-calendar"></i>
													</span>
												</div>
											</div>
											<div id="id_servicio" class="hidden"></div>											
										</div>
									</div>
									<div class="span4">
										<div class="row" id="obj_dia_semana">
											<div class="texto2 blue">
												<h4 class="animated bounceInDown txt_zise">Día de la semana</h4>
											</div>
										</div>
										<div class="row">
											<div class="texto blue">
												<h4 class="animated bounceInDown txt_zise" id="lbl_dia"></h4>
											</div>
										</div>
									</div>														
								</div>
								<h4 class="smaller lighter green pull-right">
									<i class="icon-list"></i>
									Disponibilidad de Horario
								</h4>
								<div class="row" id="obj_tabla_ho_dis">
									<div class="span12">
										<div class="slim-scroll" data-height="300">
										<table id="tabla_horas" class="table">
											<thead style>
												<tr>
													<th>Nro</th>
													<th>H. Inicio</th>
													<th>H. Fin</th>
													<th>fecha</th>
													<th>Día</th>
												</tr>
											</thead>											
											<tbody></tbody>											
										</table>
										</div>

									</div>
								</div>
								<div class="row">
									<button class="btn btn-success btn-block icon-user danger span12 " id="btn_reservar"> RESERVAR</button>									
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>			
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

		<!-- modal tarifa -->
		<div id="modal-tarifa" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Informacion de las Tarifas
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-container-span">
						<div class="widget-box">
							<div class="widget-header header-color-purple">
								<h5 class="bigger lighter">
									<i class="icon-table"></i> Información, Tarifas / Costos													
								</h5>

								<div class="widget-toolbar">														
								</div>
							</div>
							<div class="widget-body">
								<div class="widget-main no-padding">
									<table id="tabla_h_tarifa" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
										<thead>
											<tr>
												<th>Nro</th>
												<th>Categoría</th>
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
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-right" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>																					
			</div>
		</div>
		<!-- modal informacion -->
		<div id="modal-informacion" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Informacion del Servicio
				</div>
			</div>
			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="span12 widget-container-span">
						<div class="widget-box transparent">
							<div class="widget-header">
								<h4 class="lighter">Información del Servicio</h4>

								<div class="widget-toolbar no-border">
									<ul class="nav nav-tabs" id="myTab2">
										<li class="active">
											<a data-toggle="tab" href="#galeria">Galería</a>
										</li>

										<li>
											<a data-toggle="tab" href="#descripcion">Descripción</a>
										</li>

										<li>
											<a data-toggle="tab" href="#otros">Otros</a>
										</li>
									</ul>
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main padding-12 no-padding-left no-padding-right">
									<div class="tab-content padding-4">
										<div id="galeria" class="tab-pane in active">
											<div class="slim-scroll" data-height="250">
												<div class="row-fluid">
													<div class="span12">
														<!--PAGE CONTENT BEGINS-->

														<div class="row-fluid" id="obj_cont_galeria">
															
														</div><!--PAGE CONTENT ENDS-->
													</div><!--/.span-->
												</div>
											</div>
										</div>

										<div id="descripcion" class="tab-pane">
											<div class="slim-scroll" data-height="150">
												<div class="row-fluid">
													<div class="span12">
														<!--PAGE CONTENT BEGINS-->

														<div class="row-fluid" id="obj_cont_descripcion">
															
														</div><!--PAGE CONTENT ENDS-->
													</div><!--/.span-->
												</div>
											</div>
										</div>

										<div id="otros" class="tab-pane">
											<div class="slim-scroll" data-height="150">
												<div class="row-fluid">
													<div class="span12">
														<!--PAGE CONTENT BEGINS-->

														<div class="row-fluid" id="obj_cont_otros">
															
														</div><!--PAGE CONTENT ENDS-->
													</div><!--/.span-->
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
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-right" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>																					
			</div>
		</div>
		<!-- modal tarifa -->
		<div id="modal-horarios" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Informacion de horarios
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="span12 widget-container-span">
						<div class="widget-box">
							<div class="widget-header header-color-red3">
								<h5 class="bigger lighter">
									<i class="icon-table"></i> Información, Días y horarios de atención													
								</h5>

								<div class="widget-toolbar">														
								</div>
							</div>

							<div class="widget-body">
								<div class="widget-main no-padding">
									<table id="tabla_h_ser" class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
										<thead>
											<tr>
												<th>#</th>																			
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
	//mostradon contenido objetos
	$('#obj_dia_semana').show();
	$('#obj_dia_semana').removeClass().addClass('zoomIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
    $('#obj_tabla_ho_dis').show();
    $('#obj_tabla_ho_dis').removeClass().addClass('fadeInUp animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
    $('#obj_btn_informacion').show();
	$('#obj_btn_informacion').removeClass().addClass('zoomInUp animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
          $(this).removeClass();       
    });
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
        {	console.log(data)
        	if (data=='n') {
        		
        	};
        	if (data!='n') {

        		$("#tabla_horas tbody").html(data);
        	}
			
        }	                	        
    });
    //return res;
}
	
});
</script>
