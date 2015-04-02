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

		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		
		<div class="navbar">
			<div class="red navbar-inner">
				<div class="container-fluid">
					<a href="../inicio/" class="brand">
						<small>
							<i class="icon-home"></i>
							Fabrica Imbabura
						</small>
					</a><!--/.brand-->
					<ul class="nav ace-nav pull-right">
						
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<span class="user-info">
									<small>Bienvenido,</small>
									<?php print (strtoupper($_SESSION["nom"]));?>
								</span>
							</a>							
						</li>						
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			

			<div class="main-contents">
				
				<div class="page-conten">
					<?php 
						require('../../admin/class.php');
						$class=new constante();	
					?>
					<div class="row-fluid dc_padding">
						<div class="span5"></div>
						<div class="span3">
										<div class="widget-box">
											<div class="widget-header">
												<h4>Información Adicional</h4>

												<span class="widget-toolbar">
													
													
												</span>
											</div>

											<div class="widget-body">
												<div class="widget-main center">
													<form class="form-horizontal" novalidate="novalidate" id="form-guardar">														
														<div class="control-group">														
															<span class="span12">
																<select class="chzn-select" id="select_pais" name="select_pais" data-placeholder="Seleccione Pais" >
																	<?php 
																		$resultado = $class->consulta("SELECT * FROM LOCALIZACION.PAIS WHERE stado='1'");
																		print'<option value=""></option>';
																		while ($row=$class->fetch_array($resultado)) {
																			print'<option value="'.$row[0].'">'.$row[1].'</option>';
																		}
																		$archivo='dc.txt';
																		$abrir =fopen($archivo,'r+');
																		$contenido = fread($abrir , filesize($archivo));  	
																		fclose($abrir);	
																		$contenido2 = explode("\r\n", $contenido);				
																		for ($i=0; $i < 9; $i++) {
																			$fecha=$class->fecha_hora();
																			$id=$class->idz();
																			$class->consulta("INSERT INTO LOCALIZACION.CIUDAD VALUES('".$id."','20150326115500551439e48ff9d','".$contenido2[$i]."','".$fecha."','1')");
																		}
																	?>
																</select>																
															</span>														
														</div>																																								
														<div class="obj_contenedor">
															<div class="control-group">																
																<span class="span12">																
																	<select id="select_provincia" name="select_provincia">															
																	</select>
																</span>																														
															</div>
															<div class="control-group">
																<span class="span12">	
																	<select id="select_ciudad" name="select_ciudad">																		
																	</select>
																</span>
															</div>
														</div>
														<div class="control-group">
															<div class="span12">
																<input class="date-picker span9" id="txt_fecha" type="text" name="txt_fecha"  placeholder="Digite, dia/mes/año" data-date-format="dd-mm-yyyy">																	
															</div>
														</div>
														<div class="control-group">
															<div class="span12">
																<input type="text" id="txt_tel" name="txt_tel" placeholder="Digíte teléfono movil">
															</div>
														</div>
														<div class="control-group">
															<div class="span12">
																<input type="text" id="txt_con" name="txt_con" placeholder="Digíte teléfono convencional">
															</div>
														</div>
														<div class="control-group">

															<div class="span12">
																<input type="text" id="txt_dir" name="txt_dir" placeholder="Digíte Dirección">
															</div>
														</div>
														<div class="space-4"></div>
														<div class="row-fluid">
															<input type="submit" value="Guardar" class="btn btn-info btn-block">
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
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../assets/vegas/jquery.vegas.js"></script>



		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">

			$(function() {	

				// app sistem
				$.vegas('slideshow', {
				  backgrounds:[
				    { src:'../assets/images/gallery/dc1.jpg', fade:1000 },
				    { src:'../assets/images/gallery/dc2.jpg', fade:1000 },
				    { src:'../assets/images/gallery/dc3.jpg', fade:1000 }
				  ]
				})('overlay', {
				  src:'../assets/vegas/overlays/11.png'
				});
				// proceso aplicacion
				$('.obj_contenedor').hide();
				$('#select_pais').change(function(){
					var pais=$(this).val();					
					if (pais=='20150326104209551428d175961') {
						$('.obj_contenedor').show();
					}else{
						$('.obj_contenedor').hide();
					}
				});
				$.ajax({
					url:'../localizacion/pais.php',
					type:'POST',
					data:{pro:':)',registro:'20150326104209551428d175961'},
					success:function(data){
						$('#select_provincia').html(data)
					}
				});			

				$('#select_provincia').change(function(){		
					$.ajax({
						url:'../localizacion/pais.php',
						type:'POST',
						data:{ciu:':)',registro:$('#select_provincia').val()},
						success:function(data){
							$('#select_ciudad').html(data)
						}
					});	
				});
				$(".chzn-select").chosen(); 
				$('.date-picker').datepicker({
					startDate: '01/01/1950',
					endDate: new Date(),
					format: 'yyyy-mm-dd',
					startView: 2
					//language: 'es'
				});
				


				$('#form-guardar').validate({
					errorElement: 'span',
					errorClass: 'help-inline',
					focusInvalid: false,
					rules: {
						select_pais: {
							required: true
						},
						select_provincia: {
							required: true
						},
						select_ciudad: {
							required: true
						},
						txt_fecha: {
							required: true
						},
						txt_tel: {
							required: false,
							number:true,
							minlength: 8,
							maxlength: 15,
						},
						txt_con: {
							required: false,
							number:true,
							minlength: 8,
							maxlength: 15,
						},
						txt_dir: {
							required:true
						}					
					},
			
					messages: {
						select_pais: {
							required: "Por favor, Seleccione Pais",
						},
						select_provincia: {
							required: "Por favor, Seleccione Provincia",
						},
						select_ciudad: {
							required: "Por favor, Seleccione Ciudad",
						},
						txt_fecha: {
							required: "Seleccione fecha de nacimiento"							
						},
						txt_dir: {
							required: "Por favor, Digite Dirección"							
						},
						txt_tel: {
							required: "Por favor, Digite su teléfono",
							number: "Por favor, Digite solo numeros",
							minlength: "Por favor, minimo 8 caracteres",
							maxlength: "Por favor, maximo 15 caracteres",
						},
						txt_con: {
							required: "Por favor, Digite su teléfono convencional ",
							number: "Por favor, Digite solo numeros",
							minlength: "Por favor, minimo 8 caracteres",
							maxlength: "Por favor, maximo 15 caracteres",
						}
					},
			
					invalidHandler: function (event, validator) { //display error alert on form submit   
						$('.alert-error', $('.login-form')).show();
					},
			
					highlight: function (e) {
						$(e).closest('.control-group').removeClass('info').addClass('error');
					},
			
					success: function (e) {
						$(e).closest('.control-group').removeClass('error').addClass('info');
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
							data:{actualizar_info:':)',sel_1:$('#select_pais').val(),sel_2:$('#select_provincia').val(),sel_3:$('#select_ciudad').val(),fec:$('#txt_fecha').val(),tel:$('#txt_tel').val(),dir:$('#txt_dir').val(),con:$('#txt_con').val()},
							success:function(data){
								console.log(data);
								if (data==0) {
			                		$.gritter.add({						
											title: '..Mensaje..!',						
											text: 'Tenemos inconvenientes intente mas tarde.',						
											//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
											sticky: false,						
											time: ''
										});
			                		redireccionar();
				                	};
			                	if (data==1) {
			                		$.gritter.add({						
										title: '..Mensaje..!',						
										text: 'En hora buena: Por favor dame unos segundos para acceder a la aplicación. <br><i class="icon-spinner icon-spin green bigger-230"></i> : )',						
										//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
										sticky: false,						
										time: ''
									});
									redireccionar();
			                	};
							}
						});
					}					
				});	
			});
			function redireccionar() {
				setTimeout("location.href='../inicio/'",1000);
			}
		</script>

	</body>
</html>
