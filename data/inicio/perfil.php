<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../../index.php');
	}
	require('../../admin/class.php');
	$class=new constante();
	if (isset($_POST['btn_perfil'])) {
		$extension = explode(".", $_FILES["id-input-file-2"]["name"]);
		$extension = end($extension);
		$fecha=$class->fecha_hora();
		$cont=$class->idz();
		$nombre = basename($_FILES["id-input-file-2"]["name"],".".$extension);
		$foto = $cont.'.'.$extension;
		move_uploaded_file($_FILES["id-input-file-2"]["tmp_name"],"img/".$foto);
		$acu=$class->consulta("INSERT INTO SEG.IMG values('".$cont."','$_SESSION[id]',
 															'$foto',
 															'$fecha',
 															'1'
 															)");
		if (!$acu) {
			?>

			<?php
		}else{
			?>

			<?php
		}
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

		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />


		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="../assets/css/fontdc.css" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />

		
		<link rel="stylesheet" href="../assets/css/chosen.css"/>
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />
		<link rel="stylesheet" href="../assets/css/select2.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-editable.css" />




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
				<div class="page-content">

				<?php 
						
						$id=$_SESSION['id'];
						$fotografia='';	
						$resultado = $class->consulta("SELECT * FROM SEG.IMG WHERE ID_USUARIO='$_SESSION[id]'");
						while ($row=$class->fetch_array($resultado)) {
							$fotografia=$row[2];
						}										
						
						$x=0;
						$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='$_SESSION[id]' AND ID_CIUDAD='1'");
						while ($row=$class->fetch_array($resultado)) {
							$x=1;

						}
						if ($x!=1) {
							$resultado = $class->consulta("SELECT U.ID,CEDULA,NOMBRE,
											PG_CATALOG.DATE(EDAD),extract(year from age(now(),edad)),FONO,CORREO,U.FECHA,DIRECCION ,NOM_CIUDAD,NOM_PROVINCIA, NOM_PAIS,P.ID,C.ID,I.CONVENCIONAl
											FROM SEG.USUARIO U,LOCALIZACION.CIUDAD C, LOCALIZACION.PROVINCIA P, LOCALIZACION.PAIS PA,SEG.INFO I  WHERE U.id='$_SESSION[id]' 
																				AND C.ID=U.ID_CIUDAD 
																				AND U.ID=I.ID_USUARIO
																				AND P.ID=C.ID_PROVINCIA
																				AND PA.ID=P.ID_PAIS 
																				AND U.stado='1'");
							while ($row=$class->fetch_array($resultado)) {
								?>
								<div class="row-fluid">
									<div class="tabbable">
										<ul class="nav nav-tabs padding-18">
											<li class="active">
												<a data-toggle="tab" href="#home">
													<i class="green icon-user bigger-120"></i>
													Perfil Cliente
												</a>
											</li>
											<li >
												<a data-toggle="tab" href="#clave">
													<i class="orange icon-user bigger-120"></i>
													Cambiar Password / Clave
												</a>
											</li>
											<li >
												<a data-toggle="tab" href="#historial">
													<i class="blue icon-user bigger-120"></i>
													Historial de Reservaciones
												</a>
											</li>
										</ul>

										<div class="tab-content no-border padding-24">
											<div id="home" class="tab-pane in active">
												<div class="row-fluid">
													<div class="span2 center">
														<form action="perfil.php" method="POST" enctype="multipart/form-data">
															<span class="profile-picture">
																<?php 
																	if ($fotografia=='') {
																		print'<img src="img/avatar2.png"/>';
																	}else{
																		print'<img src="img/'.$fotografia.'" />';
																	} 
																?>
																
															</span>
															<input type="file" name="id-input-file-2" id="id-input-file-2" accept="image/*" required/>
															<input class="btn btn-primary" type="submit" value="Guardar" name="btn_perfil">
														</form>

														<div class="space space-4"></div>
														
													</div><!--/span-->
													<div class="span5">
														<h4 class="blue">
															<span class="middle">Perfil</span>

															<span class="label label-success arrowed-in-right">
																<i class="icon-circle smaller-80"></i>
																enlinea
															</span>
														</h4>
														<div class="profile-user-info">
															<div class="profile-info-row">
																<div class="profile-info-name"> Cedula: </div>

																<div class="profile-info-value">
																	<span><?php print($row[1]); ?></span>
																</div>
															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Nombre </div>

																<div class="profile-info-value">
																	<span><?php print($row[2]); ?></span>
																</div>
															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Localizacion </div>
																<div class="profile-info-value">														
																	<span id="lbl_pais"><?php print($row[11]); ?></span>
																	<span id="lbl_pro"><?php print($row[10]); ?></span>
																	<span id="lbl_ciu"><?php print($row[9]); ?></span>
																</div>
																	
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> F. Nacimiento</div>													
																	<div class="profile-info-value">						  								
																		<span id="txt_fna" class="editable_fecha"><?php 
																												if ($row[4]!=0) {
																													print($row[3]);	
																												}?>
																		</span>
																	</div>													
															</div>												
															
														</div>
													</div><!--/span-->
													<div class="span5">
														<h4 class="blue">
															<span class="middle"></span>
															<span class="label label-success">													
															</span>
														</h4>
														<div class="profile-user-info">
															
															<?php print $row[4];if ($row[4]!=0){?>
																<div class="profile-info-row">
																<div class="profile-info-name"> Edad :</div>													
																	<div class="profile-info-value">							  								
																		<span id="signup"><?php print($row[4].' Años'); ?></span>
																	</div>													
																</div>
															<?php } ?>												

															<div class="profile-info-row">
																<div class="profile-info-name"> Teléfono Movil </div>
																<div class="profile-info-value">
																	<span id="txt_telefono"><?php print($row[5]); ?></span>
																</div>
															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Tel. Convencional: </div>

																<div class="profile-info-value">														
																	<span class="editable" id="txt_direccion"><?php print($row[14]); ?></span>
																</div>

															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Dirección: </div>

																<div class="profile-info-value">														
																	<span class="editable" id="txt_direccion"><?php print($row[8]); ?></span>
																</div>

															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Correo: </div>

																<div class="profile-info-value">
																	<span ><?php print($row[6]); ?></span>
																</div>
															</div>
															
														</div>
													</div><!--/span-->
												</div><!--/row-fluid-->									
											</div><!--#home-->

											<div id="clave" class="tab-pane">
												<div class="span3"></div>
												<div class="span5">
													<div class="widget-box">
														<div class="widget-header">
															<h5>Cambiar Password / Clave</h5>											
														</div>

														<div class="widget-body">
															<div class="widget-main">
																<form class="form-horizontal" id="form-perfil-pass">
																	<div class="control-group">
																		<label class="control-label" for="form-field-1">Clave Actual</label>
																		<div class="controls">
																			<input type="password" id="txt_1" name="txt_1" placeholder="Clave / Actual Actual">
																		</div>
																	</div>
																	<div class="control-group">
																		<label class="control-label" for="form-field-1">Nuevo Password</label>
																		<div class="controls">
																			<input type="password" id="txt_2" name="txt_2" placeholder="Digíte Password">
																		</div>
																	</div>
																	<div class="control-group">
																		<label class="control-label" for="form-field-1">Repita Password</label>
																		<div class="controls">
																			<input type="password" id="txt_3" name="txt_3" placeholder="Repita Password">
																		</div>
																	</div>
																	<div class="control-group pull-rigth">
																		<div class="controls">																
																			<input class="btn btn-info icon-ok bigger-110" type="submit" value="Guardar">
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>									
											</div><!--/#feed-->

											<div id="historial" class="tab-pane">
												
											</div><!--/#friends-->
										</div>
									</div>						
								</div>
								<?php
							}
						}else{
							$resultado = $class->consulta("SELECT U.ID,CEDULA,NOMBRE,PG_CATALOG.DATE(EDAD),extract(year from age(now(),edad)),FONO,CORREO,U.FECHA,DIRECCION,NOM_PAIS,I.CONVENCIONAl FROM SEG.USUARIO U, SEG.INFO I, LOCALIZACION.PAIS P WHERE U.ID='$_SESSION[id]' AND U.ID=I.ID_USUARIO AND I.PAIS=P.ID");
							while ($row=$class->fetch_array($resultado)) {
							?>
							<div class="row-fluid">
								<div class="tabbable">
									<ul class="nav nav-tabs padding-18">
										<li class="active">
											<a data-toggle="tab" href="#home">
												<i class="green icon-user bigger-120"></i>
												Perfil Cliente
											</a>
										</li>
										<li >
											<a data-toggle="tab" href="#clave">
												<i class="orange icon-user bigger-120"></i>
												Cambiar Password / Clave
											</a>
										</li>
										<li >
											<a data-toggle="tab" href="#historial">
												<i class="blue icon-user bigger-120"></i>
												Historial de Reservaciones
											</a>
										</li>
									</ul>

									<div class="tab-content no-border padding-24">
										<div id="home" class="tab-pane in active">
											<div class="row-fluid">
												<div class="span2 center">
													<form action="perfil.php" method="POST" enctype="multipart/form-data">
														<span class="profile-picture">
															<?php 
																if ($fotografia=='') {
																	print'<img src="img/avatar2.png"/>';
																}else{
																	print'<img src="img/'.$fotografia.'" />';
																} 
															?>
															
														</span>
														<input type="file" name="id-input-file-2" id="id-input-file-2" accept="image/*" required/>
														<input class="btn btn-primary" type="submit" value="Guardar" name="btn_perfil">
													</form>

													<div class="space space-4"></div>
													
												</div><!--/span-->
												<div class="span5">
													<h4 class="blue">
														<span class="middle">Perfil</span>

														<span class="label label-success arrowed-in-right">
															<i class="icon-circle smaller-80"></i>
															enlinea
														</span>
													</h4>
													<div class="profile-user-info">
														<div class="profile-info-row">
															<div class="profile-info-name"> Cedula: </div>

															<div class="profile-info-value">
																<span><?php print($row[1]); ?></span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Nombre </div>

															<div class="profile-info-value">
																<span><?php print($row[2]); ?></span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Localizacion </div>
															<div class="profile-info-value">														
																<span id="lbl_pais"><?php print($row[9].' / EXTRANGERO'); ?></span>
															</div>
																
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> F. Nacimiento</div>													
																<div class="profile-info-value">						  								
																	<span id="txt_fna"><?php 
																											if ($row[4]!=0) {
																												print($row[3]);	
																											}?>
																	</span>
																</div>													
														</div>												
														
													</div>
												</div><!--/span-->
												<div class="span5">
													<h4 class="blue">
														<span class="middle"></span>
														<span class="label label-success">													
														</span>
													</h4>
													<div class="profile-user-info">
														
														<?php if ($row[4]!=0){?>
															<div class="profile-info-row">
															<div class="profile-info-name"> Edad :</div>													
																<div class="profile-info-value">							  								
																	<span id="signup"><?php print($row[4].' Años'); ?></span>

																</div>													
															</div>
														<?php } ?>												

														<div class="profile-info-row">
															<div class="profile-info-name"> Teléfono Movil</div>
															<div class="profile-info-value">
																<span id="txt_telefono"><?php print($row[5]); ?></span>
															</div>
														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Tel. Convencional</div>
															<div class="profile-info-value">
																<span id="txt_telefono"><?php print($row[10]); ?></span>
															</div>
														</div>

														<div class="profile-info-row">
															<div class="profile-info-name"> Dirección: </div>

															<div class="profile-info-value">														
																<span class="editable" id="txt_direccion"><?php print($row[8]); ?></span>
															</div>

														</div>
														<div class="profile-info-row">
															<div class="profile-info-name"> Correo: </div>

															<div class="profile-info-value">
																<span ><?php print($row[6]); ?></span>
															</div>
														</div>
														
													</div>
												</div><!--/span-->
											</div><!--/row-fluid-->									
										</div><!--#home-->

										<div id="clave" class="tab-pane">
											<div class="span3"></div>
											<div class="span5">
												<div class="widget-box">
													<div class="widget-header">
														<h5>Cambiar Password / Clave</h5>											
													</div>

													<div class="widget-body">
														<div class="widget-main">
															<form class="form-horizontal" id="form-perfil-pass">
																<div class="control-group">
																	<label class="control-label" for="form-field-1">Clave Actual</label>
																	<div class="controls">
																		<input type="password" id="txt_1" name="txt_1" placeholder="Clave / Actual Actual">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="form-field-1">Nuevo Password</label>
																	<div class="controls">
																		<input type="password" id="txt_2" name="txt_2" placeholder="Digíte Password">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="form-field-1">Repita Password</label>
																	<div class="controls">
																		<input type="password" id="txt_3" name="txt_3" placeholder="Repita Password">
																	</div>
																</div>
																<div class="control-group pull-rigth">
																	<div class="controls">																
																		<input class="btn btn-info icon-ok bigger-110" type="submit" value="Guardar">
																	</div>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>									
										</div><!--/#feed-->

										<div id="historial" class="tab-pane">
											
										</div><!--/#friends-->
									</div>
								</div>						
							</div>
							<?php } 
						} ?>
					
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
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
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
		<script src="../assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="../assets/js/x-editable/ace-editable.min.js"></script>
		<script src="../assets/js/select2.min.js"></script>
		<script src="../assets/js/jquery.hotkeys.min.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../../assets/js/jquery.validate.min.js"></script>
		<script src="../../assets/js/additional-methods.min.js"></script>



		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
		<script type="text/javascript">			
			$(function(){
				//Enviar datos extras
				$('#id-input-file-2').ace_file_input({
					no_file:'Seleccionar',
					btn_choose:'Ver',
					btn_change:'Cambiar',
					droppable:false,
					onchange:null,
					thumbnail:false, //| true | large
					whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});

				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" onli  class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    

				//formato pais
				
				
				// $(".select2").chosen();

				$('#btn_aceptar').click(function(){
					console.log('gola')
				});
				//formato inicializacion formato entrada telefono
				$('.input-mask-phone').mask('(999) 999-9999');

				//Formato inicializacion fecha de nacimiento campo
				$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				function sumaFecha(d, fecha)
					{
					 var Fecha = new Date();
					 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
					 var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
					 var aFecha = sFecha.split(sep);
					 var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
					 fecha= new Date(fecha);
					 fecha.setDate(fecha.getDate()-parseInt(d));
					 var anno=fecha.getFullYear();
					 var mes= fecha.getMonth()+1;
					 var dia= fecha.getDate();
					 mes = (mes < 10) ? ("0" + mes) : mes;
					 dia = (dia < 10) ? ("0" + dia) : dia;
					 var fechaFinal = dia+sep+mes+sep+anno;
					 return (fechaFinal);
					 } 
				
				var f = new Date();
				var afecha=f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear();

				$('#txt_fna').editable({
					type: 'date',
					format: 'yyyy-mm-dd',
					pk:    1,
                    name:  'txt_fna',
                    url:   'app.php',
                    data:{devian:'hola'},
					viewformat: "yyyy-mm-dd",
					validate: function(value) {
					    if($.trim(value) == '') {
					        return 'El formato no es correcto verifique la información';
					    }
					},
					success: function(v) {
						$.ajax({
							url:'app.php',
							type:'POST',
							data:{verificar_edad:'ok'},
							success:function(data){
								$('#signup').html(data+' Años')
							}
						});
					},
					datepicker: {
						startView: 2,
						startDate: '1950/01/01',
						endDate: new Date()						
					}					
					
				});				
				function dc_actualizacion(){
						alert($('#txt_fna').html())
					}
				$('#txt_direccion').editable({
			           type: 'text',
			           name: 'txt_direccion'
			    });

				$('#txt_telefono').editable({
				    type: 'text',
				    name: 'txt_telefono',
				    tpl: '<input type="text" id ="zipiddemo" class="mask form-control    input-sm dd" style="padding-right: 24px;">'
				});

				$(document).on("focus", ".mask", function () {
				    $(this).mask("(999) 999-9999");
				});
				
				$('#txt_ direccion').editable({
					type: 'text',
				    name: 'txt_direccion',
				});
				// Llamar carga de datos en select pais				
				$('#sel_pais').change(function(){					
					var pais=$('#sel_pais').val();
					cargar_pro(pais);
					$('#lbl_pais').html(busca_reg_valor(pais));	
					//console.log($('#sel_pais').options.length)
				});
				$('#sel_provincia').change(function(){
					var pro=$('#sel_provincia').val();
					$('#lbl_pro').html(busca_reg_valorp(pro));	
					cargar_c(pro);
				});
				$('#sel_ciudad').change(function(){
					var ciu=$('#sel_ciudad').val();
					$('#lbl_ciu').html(busca_reg_valorc(ciu));						
				});
			});
			
			// verificacion robustes de contraseña
			function pass_seguro(reg){			
				var result = "" ; 					
				$.ajax({
					url:'../../utilidades/cedula.php',
		            async :  false ,   
		            type:  'post',
		            data: {registro:reg, pass:reg},
		            success : function ( data )  {	
		            	result=data; 
				    } 
				});	
				return result ; 
			}
			//Validación pass robusto
				jQuery.validator.addMethod("pass_r", function (value, element) {
					
					var reg=$('#txt_2').val();
					if (pass_seguro(reg)==0) {						
						return false;
					};
					if (pass_seguro(reg)!=0) {						
						return true;
					};
					//return false;		
				}, "Password no seguro!!!. :(, Debe contener al menos una letra Mayuscula, minusculas, caracteres especiales y numeros, minimo 8 caracteres y maximo 16");

			function buscando(registro){			
				var result = "" ; 					
				$.ajax({
			            url:'../localizacion/pais.php',
			            async :  false ,   
			            type:  'post',
			            data: {existencia_seg:':)',reg:registro},            
			            success : function ( data )  {
					         result = data ;  
					    } 		                
			    	});
				return result ; 
			}
			//Validación Existencia correo electronico
			jQuery.validator.addMethod("existe_seg", function (value, element) {
				var a=value;
				var reg=$('#txt_1').val();					
				if (buscando(reg,0)==0) {						
					return true;
				};
				if(buscando(reg,0)!=0){						
					return false;
				};
			}, "Por favor, Digite otro segmento ya existe!!!.");
			//almacenando informacion del nuevo pass
			$('#form-perfil-pass').validate({
				errorElement: 'span',
				errorClass: 'help-inline',
				focusInvalid: false,
				rules: {			
					txt_1: {
						required: true,
						existe_seg:true
					},
					txt_2: {
						required: true,
						pass_r:true,
						minlength: 8,
						maxlength: 16
					},
					txt_3: {
						required: true,
						equalTo: "#txt_2"
					}
				},

				messages: {
					txt_1: {
						required:'Por favor, Digite su password actual',
						existe_seg:'Su password no es el correcto'
					},
					txt_2: {
						required: 'Por favor, Ingrese nuevo password',
						//existe_seg:true,
						minlength: 'Por favor, Digíte minimo 8 caracteres',
						minlength: 'Por favor, Digíte maximo 16 caracteres'
					},
					txt_3: {
						required: 'Por favor, Digite la informacion solicitada',
						equalTo: "Su password no coincide"

					},			
				},

				invalidHandler: function (event, validator) { //display error alert on form submit   
					$('.alert-error', $('.login-form')).show();
				},

				highlight: function (e) {
					$(e).closest('.control-group').removeClass('success').addClass('error');
				},

				success: function (e) {
					$(e).closest('.control-group').removeClass('error').addClass('success');
					$(e).remove();
				},

				errorPlacement: function (error, element) {
					if(element.is(':checkbox') || element.is(':radio')) {
						var controls = element.closest('.controls');
						if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
						else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
					}
					else if(element.is('.select2')) {
						error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
					}
					else if(element.is('.chzn-select')) {
						error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
					}
					else error.insertAfter(element);
				},

				submitHandler: function (form) {
					$.ajax({
						url:'../localizacion/pais.php',
						type:'POST',
						data:{guardar_pass:'ok',txt_1:$('#txt_2').val()},
						success:function(data){
							console.log(data);
							if (data==1) {
		                        $.gritter.add({                     
		                            title: '..Mensaje..!',                      
		                            text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos se almacenaron con exito. <br><i class="icon-spinner icon-spin green bigger-230"></i>',                      
		                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
		                            sticky: false,                      
		                            time: 2000
		                        });
		                        $('#form-perfil-pass').each (function(){
			                        this.reset();
			                    });
		                    };
		                     if(data!=1){
		                         $.gritter.add({                     
		                            title: '..Mensaje..!',                      
		                            text: 'Lo sentimos: <br><i class=" icon-cogs red bigger-230"></i>   Intente mas Tarde . <br><i class="icon-spinner icon-spin red bigger-230"></i>',                       
		                            //image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',                        
		                            sticky: false,                      
		                            time: ''
		                        });
		                     };
		                    
						}
					});
				}		
			});

			
		</script>
		
	</body>
</html>
