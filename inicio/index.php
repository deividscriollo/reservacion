<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(isset($_SESSION["pass"])) {
		header('Location: ../data/');
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
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
			
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

		
		<!--ace styles-->
		<link rel="stylesheet" href="../assets/css/fontdc.css" />
		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />


		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	

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
																	<input type="text" class="span12" id="txt_usuario" name="txt_usuario" placeholder="Digíte email / correo " />
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
											<div class="toolbar clearfix">
												<div>
													<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
														<i class="icon-arrow-left"></i>
														Olvidé mi contraseña
													</a>
												</div>

												<div>
													<a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
														Quiero Registrarme
														<i class="icon-arrow-right"></i>
													</a>
												</div>
											</div>
										</div><!--/widget-body-->
									</div><!--/login-box-->
									<style type="text/css">
										.ayuda{
											position: absolute;
											left: 320px;
											top: 10px;
										}
										.dcbtn{
											background: #C16050;
											color: #F7F7F7;
											padding: 5px;
											border-top-left-radius: 5px;
											border-bottom-left-radius: 5px;
										}
										.ayuda :hover{
											background: #C16050;
											cursor: pointer;
											-moz-transform: scale(1.1);
											-webkit-transform: scale(1.1);
											-o-transform: scale(1.1);
											-ms-transform: scale(1.1);
											transform: scale(1.1)
										}
									</style>
									<div id="forgot-box" class="forgot-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												
												<h4 class="header red lighter bigger">
													<i class="icon-key"></i>
													Recuperar Contraseña
												</h4>

												<div class="space-6"></div>
												<p>
													Ingrese, su email para recibir instrucciones.
												</p>

												<form id="frm-recuperar">
													<div class="control-group">
														<fieldset>
															<label>
																<span class="block input-icon input-icon-right">
																	<input type="email" class="span12" id="txt_rec_email" name="txt_rec_email" placeholder="Email" />
																	<i class="icon-envelope"></i>
																</span>
															</label>

															<div class="clearfix">
																<button type="submit" class="width-35 pull-right btn btn-small btn-danger">
																	<i class="icon-lightbulb"></i>
																	Enviar!
																</button>
															</div>
														</fieldset>
													</div>

												</form>
											</div><!--/widget-main-->

											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													Volver a identificarse
													<i class="icon-arrow-right"></i>
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/forgot-box-->
									<div id="signup-box" class="signup-box widget-box no-border">
										<div class="widget-body">
											<div class="widget-main">
												
												<h4 class="header green lighter bigger">
													<i class="icon-group blue"></i>
													Registrar Nuevo Cliente
												</h4>

												<div class="space-6"></div>
												<p> Digite, su información para comenzar: </p>
												<fieldset>
												<form id="frm-registro">																									
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
																	<input type="password" class="span12" placeholder="password" id="txt_reg_pass" name="txt_reg_pass" data-rel="tooltip" data-placement="top" data-original-title="Políticas de password, debe contener como mínimo 8 dígitos y máximo 16, 1 mayúscula, 1 número, 1 carácter especial." />
																	<a href="#modal-form1" data-toggle="modal" class="btn-small  icon-legal blue" title="Políticas Password"></a>
																</span>
															</label>
														</div>
													</div>
													
													
													<div class="control-group">
														<div class="span12">
															<label>
																<span class="block input-icon input-icon-right">
																	<input type="password" class="span12" placeholder="repita password" id="txt_repetir" name="txt_repetir" />
																	<i class="icon-retweet"></i>
																</span>
															</label>
														</div>
													</div>
													<div class="control-group">
														<div class="span12">
															<label>
																<input type="checkbox" name="agree" id="agree" />
																<span class="lbl">
																	Acepto el
																	<a href="#modal-form" data-toggle="modal">Acuerdo</a>
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
												</fieldset>
											</div>											
											<div class="toolbar center">
												<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
													<i class="icon-arrow-left"></i>
													Volver a identificarse
												</a>
											</div>
										</div><!--/widget-body-->
									</div><!--/signup-box-->
								</div><!--/position-relative-->
							</div>
						</div>
					</div><!--/.span-->
				</div><!--/.row-fluid-->
			</div>
		</div><!--/.main-container-->
		<div id="modal-form" class="modal hide" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Términos y condiciones</h4>
			</div>

			<div class="modal-body overflow-visible">
				<div class="row-fluid">
					<div class="span12" style="text-align: justify;">
						<blockquote>
							<p>
							El  acceso a esta aplicacion y la utilización de la clave autorizada,
							conllevan la aceptación del cliente a todas las estipulaciones de este 
							documento y las condiciones aplicables. Este documento constituye un 
							acuerdo para el acceso ala aplicacion web de reservaciones de la FABRICA IMBABURA, 
							entre el cliente, intermediario o cliente, en adelante denominado el 
							CLIENTE que accede a esta aplicacion web, en adelante FABRICA IMBABURA.</p>
							<small>
								FABRICA IMBABURA
								<cite title="Source Title">Política Empresarial</cite>
							</small>
						</blockquote>										
					</div>
				</div>
			</div>

			<div class="modal-footer">	
				<div class="center">
					<img src="../assets/empresa/logo/logo.png" width="10%">
				</div>
			</div>
		</div>

		<!--Terminos y condiciones password-->
		<div id="modal-form1" class="modal hide" tabindex="-1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="blue bigger">Términos y condiciones</h4>
			</div>

			<div class="modal-body overflow-visible">
				<div class="row-fluid">
					<div class="span12" style="text-align: justify;">
						<blockquote>
							<p>
							La contraseña de acceso, es la prueba irrefutable de que es el cliente quien accedió ala 
							 aplicacion y que todas las operaciones realizadas a través de este 
							 medio han sido aceptadas consciente y voluntariamente por él.  
							 Es por esta razón que el cliente se obliga a no compartir su contraseña con otra persona, 
							 de hacerlo, asumirá la responsabilidad por el uso que esta persona le de, 
							 relevando a FABRICA IMBABURA de toda responsabilidad por tal hecho.
 
								Aspectos importantes sobre la contraseña: <br/> 
								Debe contener como mínimo 8 caracteres y como máximo 16		<br/>						
								Debe estar compuesta por letras mayúsculas, minúsculas y números.	<br/>							
								</p>
							<small>
								FABRICA IMBABURA
								<cite title="Source Title">Política Empresarial</cite>
							</small>
						</blockquote>										
					</div>
				</div>
			</div>

			<div class="modal-footer">	
				<div class="center">
					<img src="../assets/empresa/logo/logo.png" width="10%">
				</div>
			</div>
		</div>
		
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
			$('[data-rel=tooltip]').tooltip();

		</script>
	</body>
</html>

<!--Verificacionm Accesos usuario-->
<script type="text/javascript" src="js/pro_acce.js"></script>

<!--Verificacionm Accesos usuario-->
<script type="text/javascript" src="js/procesos.js"></script>
<!--Verificacionm Accesos usuario-->
<script type="text/javascript" src="js/recuperar.js"></script>
