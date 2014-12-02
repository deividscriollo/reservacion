<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if($_SESSION["accesamiento"]!='inicio') {
		header('Location: ../');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Acceso Aplicación</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />
		
		<!--basic styles-->

		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />

		<!--fonts-->

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<!--ace styles-->

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />


		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body class="login-layout">
		<div class="main-container container-fluid">
			<div class="main-content">
				<div class="row-fluid">
					<div class="span12">
						<div class="login-container">
							<div class="row-fluid">
								<div class="center">
									<h4>
										
									</h4>									
								</div>
							</div>

							<div class="space-6"></div>

							<div class="row-fluid">
								<div class="position-relative">
									<div id="login-box" class="login-box visible widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												<h4 class="header blue lighter bigger">
													<i class="icon-coffee green"></i>
													Por favor,Digite tu información
												</h4>

												<div class="space-6"></div>

												<fieldset>
												<form id="form-acceso">
													<div class="control-group">														
														<span class="span12">
															<label>
																<span class="block input-icon input-icon-right">
																	<input type="text" class="span12" id="txt_usuario" name="txt_usuario" placeholder="Digíte usuario " />
																	<i class="icon-user"></i>
																</span>
															</label>
														</span>														
													</div>
													<div class="control-group">														
														<span class="span12">
															<label>
																<span class="block input-icon input-icon-right">
																	<input type="password" class="span12" id="txt_pass" name="txt_pass" placeholder="Digíte Password" />
																	<i class="icon-lock"></i>
																</span>
															</label>
														</span>
													</div>
													<div class="space"></div>
													<div class="control-group red">
														<div class="span12">
															<div class="clearfix blue">
																<button type="submit" class="width-35 pull-right btn btn-small btn-primary">
																	<i class="icon-key"></i>	
																	Acceder
																</button>
															</div>
														</div>
													</div>
												</form>
												</fieldset>

												<div class="social-or-login center">
													<span class="bigger-110">Fabrica Imbabura</span>
												</div>

												<div class="center">
													<img src="../assets/images/user.png">
												</div>
											</div><!--/widget-main-->
											
										</div><!--/widget-body-->
									</div><!--/login-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->
	
		<!--basic scripts-->

		<!--[if !IE]>-->

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

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
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/additional-methods.min.js"></script>		
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>		
		<script src="../assets/js/spin.min.js"></script>
		<script src="../assets/js/blockui.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		
		<!--inline scripts related to this page-->
		
		<script type="text/javascript">
			function show_box(id) {
			 $('.widget-box.visible').removeClass('visible');
			 $('#'+id).addClass('visible');
			}
			$(function(){
				$('#icon-tiempo').hide();
				
			});
		</script>
	</body>
</html>
<script type="text/javascript">
	$('#form-acceso').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_usuario: {
				required: true							
			},
			txt_pass: {
				required:true
			}
		},

		messages: {
			txt_usuario: {
				required: "Por favor, Digite usuario."
			},
			txt_pass: {
				required:"Por favor, Digite su clave / password"
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
				url: 'php/acceso.php',
				type: 'POST',				
				data: {txt_1: $('#txt_usuario').val(),txt_2: $('#txt_pass').val()},
			})
			$.ajax({
                url: 'php/acceso.php',
				type: 'POST',				
				data: {txt_1: $('#txt_usuario').val(),txt_2: $('#txt_pass').val()},                
                success:  function (data) {
                        alert(data)
                }
        	});
		},
		invalidHandler: function (form) {
			
		}
	});
</script>


			