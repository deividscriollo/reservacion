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
	$id=$_SESSION['id'];
	$resultado = $class->consulta("SELECT * FROM SEG.USUARIO U,SEG.INFO I WHERE I.ID_USUARIO=U.ID AND U.ID='$id' and I.stado='0'");
	while ($row=$class->fetch_array($resultado)) {
		header('Location: index2.php');
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
		
		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php  menu(); ?>

			<div class="main-content">
				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Menu Principal</li>
					</ul><!--.breadcrumb-->
				</div>
				<div class="page-content">
					<?php 
						
						$id=$_SESSION['id'];
						$acu=0;
						$cedula='';
						$localizacion='';
						$edad='';
						$fecha='';
						$correo='';
						$telefono='';
						$direccion='';
						$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE id='$id' and stado='1'");	
							while ($row=$class->fetch_array($resultado)) {

								if ($row[3]=="0900000000") {
									$acu++;
								}if ($row[7]=='') {
									$acu++;
								}if ($row[8]=='') {
									$acu++;
								}
								$cedula=$row[1];
								$localizacion=$row[2];
								$edad=$row[4];
								$fecha=$row[9];
								$correo=$row[5];
								$telefono=$row[3];
								$direccion=$row[7];
							}
						//print $edad;
						$v_eda1=split(' ',$edad);
						$v_eda2=split('-',$v_eda1[0]);
						$sum=$v_eda2[2].'-'.$v_eda2[1].'-'.$v_eda2[0];						
						$edad=$class->edad($sum);
						if ($edad<10) {
							$edad='0000-00-00';
						}
						if ($direccion=="") {
							$direccion="-----------------------";
						}
						$acu=(10-$acu)*10;
						if ($acu<100) {	
					?>
					<div class="row-fluid">						
						<h3 class="header smaller lighter green">Hola <a><?php print$_SESSION['nom'].' '; ?></a><i class="icon-user"></i> Te pedimos completar tu información!!! <a href="perfil.php" class="icon-animated-vertical"><i class=" icon-edit"></i> AQUI</a></h3>
						<div class="row-fluid">
							<div class="span12">									
								<div class="row-fluid">
									<div class="span3 center">
										<div class="profile-picture">
											<img src="../assets/avatars/avatar2.png">
										</div>
									</div>
									<div class="span5">
										<div class="profile-user-info profile-user-info-striped">
											<div class="profile-info-row">
												<div class="profile-info-name"> Cedula </div>

												<div class="profile-info-value">
													<span class="editable" id="username"><?php print($cedula); ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Localizacion</div>

												<div class="profile-info-value">
													<i class="icon-map-marker light-orange bigger-110"></i>
													<span class="editable" id="country">Ecuador</span>
													<span class="editable" id="city">Imbabura</span>
													<span class="editable" id="city">Ibarra</span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Edad </div>

												<div class="profile-info-value">
													<span class="editable" id="age"><?php print($edad); ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Fecha Registro </div>

												<div class="profile-info-value">
													<span class="editable" id="signup"><?php print($fecha); ?></span>
												</div>
											</div>

											<div class="profile-info-row">
												<div class="profile-info-name"> Correo </div>

												<div class="profile-info-value">
													<span class="editable" id="login"><?php print($correo); ?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> Telefono </div>

												<div class="profile-info-value">
													<span class="editable" id="login"><?php print($telefono); ?></span>
												</div>
											</div>
											<div class="profile-info-row">
												<div class="profile-info-name"> Direccion </div>

												<div class="profile-info-value">
													<span class="editable" id="login"><?php print($direccion); ?></span>
												</div>
											</div>												
										</div>
									</div>
									<div class="span3 center">									
										<div class="easy-pie-chart percentage" data-percent="<?php print $acu; ?>" data-color="#87B87F">
											<span class="percent"><?php print $acu; ?></span>
											%
										</div>
									</div><!--/span-->
								</div>
							</div><!--/span-->
						</div>
					</div>
					<?php }?>
					<?php if ($_SESSION['nivel']!='CLIENTE') {?>
					<h3 class="header smaller lighter green">Navegación</h3>
					<?php } ?>
					<div class="row-fluid">
						<?php if ($_SESSION['nivel']!='CLIENTE') {?>				
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4>Crear Servicios</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../assets/empresa/servicio.fw.png">
											<a href="../servicios/">
											<button class="btn btn-primary btn-block">Administración Servicios</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } if ($_SESSION['nivel']!='CLIENTE') {?>
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="purple">Agenda</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../assets/empresa/calendario.fw.png" >
											<a href="../agenda/">
											<button class="btn btn-purple btn-block">Administracion Agenda</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } if ($_SESSION['nivel']!='CLIENTE') {?>
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="green">Reservaciones</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../assets/empresa/reservacion.fw.png" >
											<a href="../reservacion/">
											<button class="btn btn-success btn-block">Administracion Reservaciones</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } if ($_SESSION['nivel']!='CLIENTE') {?>
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="orange">Usuario / Correo</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../assets/empresa/usuarios.fw.png" >
											<a href="../usuario/">
											<button class="btn btn-warning btn-block">Administracion Usuario</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php } if ($_SESSION['nivel']!='CLIENTE') {?>
					<div class="row-fluid">
						<div class="span3">
							<div class="widget-box">
								<div class="widget-header">
									<h4 class="orange">Otros</h4>

									<span class="widget-toolbar">
										<a href="#" data-action="collapse">
											<i class="icon-chevron-up"></i>
										</a>

										<a href="#" data-action="close">
											<i class="icon-remove"></i>
										</a>
									</span>
								</div>

								<div class="widget-body">
									<div class="widget-main">										
										
										<div class="row-fluid">
											<img src="../assets/empresa/otros.fw.png" >
											<a href="">
											<button class="btn btn-warning btn-block">Administracion Otros</button>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
				<?php if ($_SESSION['nivel']=='CLIENTE') { ?>
					<div class="page-content">
						<div class="row-fluid">
							<h3 class="header smaller lighter green">Reservaciones En Proceso de pagos Pendientes</h3>
							<h3 class="header smaller lighter green">Reservaciones Realizadas</h3>
							<h3 class="header smaller lighter green">Reservaciones Finalizadas</h3>
						</div>
					</div>
				<?php } ?>
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
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>


		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function(){
				var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());

				$('.easy-pie-chart.percentage').each(function(){
					$(this).easyPieChart({
						barColor: $(this).data('color'),
						trackColor: '#EEEEEE',
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: 8,
						animate: oldie ? false : 1000,
						size:230
					}).css('color', $(this).data('color'));
				});
			});
		</script>
	</body>
</html>
