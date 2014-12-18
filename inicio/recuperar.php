<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Activacion</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />

		<!--basic styles-->

		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="../assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!--page specific plugin styles-->

		<!--fonts-->

		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />

		<!--ace styles-->

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		
		<div class="main-container container-fluid">
			

			

			<div class="ain-content">				

				<div class="page-content">
					<div class="row-fluid">
						<img src="../assets/empresa/banner2.fw.png">
					</div>
					<div class="row-fluid">
						<div class="span2"></div>
						<div class="span8">							
							<div class="widget-box">
								<div class="widget-header">
									<h4>Información Personal</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="settings">
											<i class="icon-cog"></i>
										</a>

										<a href="#" data-action="reload">
											<i class="icon-refresh"></i>
										</a>

										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>

								</div>
								<?php if (isset($_GET['id'])) {

									require('../admin/class.php');
									$class=new constante();
									$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='".$_GET['id']."' and stado=1");
									$stado=0; $nom=""; $correo="";
									while ($row=$class->fetch_array($resultado)) {
											$existencia=1;											
											//valores a consumir											
											$nom = $row[2];
											$correo = $row[5];
											$stado=1;
									}																	
								}
								?>
								<div class="widget-body">
									<div class="widget-main">
										<form class="form-horizontal" class="span12" id="frm_recuperar" />
											<div class="control-group">
												<label class="control-label" for="form-input-readonly">Nombre y Apellido</label>

												<div class="controls">
													<input readonly="" type="text" id="form-input-readonly" value="<?php if (isset($_GET['id'])){print$nom;}?>" class="span12" />													
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-input-readonly">Correo / Email</label>

												<div class="controls">
													<input readonly="" type="text" id="txt_correo" value="<?php if (isset($_GET['id']))print$correo;?>" class="span12" />													
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-input-readonly">Nueva Contraseña</label>

												<div class="controls">
													<input  type="password" name="txt_pass" id="txt_pass" class="span12" />													
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-input-readonly">Repita nueva contraseña</label>

												<div class="controls">
													<input type="password"  name="txt_repetir" id="txt_repetir" class="span12" />													
												</div>
											</div>
											<div class="control-group">
												
												<h3 class="header smaller lighter green">Felicidades su cuenta se ha activado satisfactoriamente
												
												<div class="icon-ok bigger-230"></div>
												<input class="btn btn-primary icon-desktop" type="submit"></input>
												</h3>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<div class="span2"></div>
					</div>
				</div><!--/.page-content-->
			</div><!--/.main-content-->
		</div><!--/.main-container-->

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only bigger-110"></i>
		</a>

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

		<!--[if lte IE 8]>
		  <script src="../assets/js/excanvas.min.js"></script>
		<![endif]-->

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

		<!--validacion de usuario-->		
	</body>
</html>
<script type="text/javascript">
$(function (){
	$('#frm_recuperar').validate({
		errorElement: 'span',
		errorClass: 'help-inline',
		focusInvalid: false,
		rules: {
			txt_pass: {
				required: true,
				minlength: 8
			},
			txt_repetir: {
				required: true,
				equalTo: "#txt_pass"
			}
		},

		messages: {
			txt_pass: {
				required: "Por favor, Digite password.",
				minlength:'Por favor, Digite minimo 8 caracteres x seguridad'
			},
			txt_repetir: {
				required: "Por favor, Repita password.",				
				equalTo:'Su contraseña no coinciden'
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
                url: 'php/reinicio_contra.php',
				type: 'POST',				
				data: {txt_1: $('#txt_correo').val(),txt_2: $('#txt_pass').val()},				
                success:  function (data) {                	
                	
                	if (data==0) {
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Lo sentimos intente mas tarde.<br><i class="icon-lock red bigger-230"></i>',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
                	};
                	if (data==1) {
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'En hora buena: '+$('#txt_correo').val()+'<br><i class="icon-ok green bigger-230"></i>   tu contraseña a sido reiniciada. <br><i class="icon-spinner icon-spin green bigger-230"></i> : )',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
						$('#frm_recuperar').each (function(){
						  this.reset();
						});	
						redireccionar();
                	};                 	
                	if(data!=0&&data!=1&&data!=2){
                		$.gritter.add({						
							title: '..Mensaje..!',						
							text: 'Lo sentimos: '+$('#txt_correo').val()+'<br><i class=" icon-cogs red bigger-230"></i>   Informe al Administrador . <br><i class="icon-spinner icon-spin red bigger-230"></i> : [',						
							//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
							sticky: false,						
							time: ''
						});
						//redireccionar();
                	};                
                }
        	});
		},
		invalidHandler: function (form) {
			
		}
	});
function redireccionar() {
	setTimeout("location.href='index.php'", 5000);
}
});
</script>