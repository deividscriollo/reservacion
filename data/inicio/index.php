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

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/animate.css" />


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
				<?php if ($_SESSION['nivel']!='CLIENTE') { ?>
				<div class="page-content">
					<div class="row-fluid">
						<div class="span9">
							<div class="error-container">
								<div class="well">
									<h1 class="grey lighter smaller">
										<span class="blue bigger-125">
											<i class="icon-user"></i>
											<?php print$_SESSION['nom']; ?>
										</span>
									</h1>

									<hr />
									<h3 class="lighter smaller">
										Estimado/a <?php print$_SESSION['nom']; ?> le damos la bienvenida a la aplicación de reservación de la Fábrica Imbabura :)
									</h3>

									<div class="space"></div>

									<div>
										<h4 class="lighter smaller">Información Inicial</h4>

										<ul class="unstyled spaced inline bigger-110">
											<li>
												<i class="icon-hand-right blue"></i>
												 En hora buena su inicio de sesión fue satisfactorio, el uso de esta aplicación está bajo su control y a la vez la información que realice esta será almacenada automáticamente bajo su perfil de configuración.
											</li>
										</ul>
									</div>

									<hr />
									<div class="space"></div>
								</div>
							</div>
						</div><!--/span-->
						<div class="span3 widget-container-span">
							<div class="widget-box">
								<div class="widget-header">
									<h5 class="smaller">Informaciòn usuario</h5>

									<div class="widget-toolbar">
										<span class="label label-success">
											Estado
											<i class="icon-ok"></i>
										</span>
									</div>
								</div>

								<div class="widget-body">
									<div class="widget-main padding-6">
										<div class="alert alert-info">El Perfil de usuario solo es tratado por un SúperAdmin…</div>
										<img src="../assets/images/block.png" width="100%">
									</div>
								</div>
							</div>
						</div>

					</div><!--/.row-fluid-->
					<div class="row-fluid">
						<div class="span12">
							<img src="../assets/images/banner_admin.fw.png" width="100%">
						</div>
					</div>
				</div><!--/.page-content-->

				<?php } ?>
				<?php if ($_SESSION['nivel']=='CLIENTE') { ?>
					<div class="page-content">
						<div class="row-fluid">
							<div class="span6">
									<h3 class="header smaller lighter green">
										<i class="icon-bullhorn"></i>
										Alertas
									</h3>
									<?php
										$id_usr=$_SESSION['id'];
										$resultado=$class->consulta("SELECT * FROM  RESERVACION R WHERE R.ID_USUARIO='$id_usr' AND R.STADO='PETICION_RESERVA'");
										while ($row=$class->fetch_array($resultado)) {
											$id_reser=$row[0];
											$existencia=0;
											$res=$class->consulta("SELECT * FROM CONFIRMACION C WHERE C.ID_RESERVACION='$id_reser'");
											while ($row=$class->fetch_array($res)) {
												$existencia=1;
											}
											if ($existencia==0) {
											?>
										<div class="alert alert-block alert-success">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>
											<p>
												<strong>
													<i class="icon-ok"></i>
													Reservación sin cancelar
												</strong>
												Usted puede realizar el pago correspondiente por los siguientes medios
											</p>
											<p>
												<a href="../paypal/index.php?paypal=ok&id=<?php print $id_reser; ?>" target="_blank" class="btn btn-small btn-success btn-warning">Paypal</a>
												<a href="../reserva_banco/index.php?banco=ok&id=<?php print $id_reser; ?>" target="_blank" class="btn btn-small btn-info btn-info">Depositos Bancarios</a>
												<a href="../tarjeta/index.php?targeta=ok&id=<?php print $id_reser; ?>" target="_blank" class="btn btn-small btn-success btn-info">Tarjeta de Crédito</a>
											</p>
										</div>
									<?php } } ?>
								</div><!--/span-->
								<div class="span6">
									<div class="center">
										<h3 class="green">Bienvenido!</h3>
										<img src="img/fab.jpg">
									</div>
								</div>
						</div>
						<hr>
						<div class="row-fluid">
							<div class="span12">
								<img src="../assets/images/banner_index.fw.png">
							</div>
						</div>
						<!-- <div class="row-fluid">
							<h3 class="header smaller lighter green">Accesos Directos</h3>
							<div class="center"></div>
							<p class="center">
								<a href="perfil.php" class="btn btn-app no-radius ">
									<i class="icon-cog bigger-230"></i>
									Perfil
								</a>

								<a href="../ciomi" class="btn btn-app btn-primary no-radius">
									<i class="icon-edit bigger-230"></i>
									Reservar
								</a>

								<a href="#" class="btn btn-app btn-success no-radius ">
									<i class="icon-refresh bigger-230"></i>
									Servicios
								</a>

								<button class="btn btn-app btn-warning no-radius " >
									<i class="icon-undo bigger-230"></i>
									Facturas
								</button>

								<a href="#" class="btn btn-app btn-info no-radius animated bounceInDown">
									<i class="icon-envelope bigger-200"></i>
									Contacto
								</a>

								<button class="btn btn-app btn-danger no-radius animated">
									<i class="icon-trash bigger-200"></i>
									Cancelar
								</button>

								<button class="btn btn-app btn-purple  no-radius animated">
									<i class="icon-cloud-upload bigger-200"></i>
									Historial
								</button>

								<button class="btn btn-app btn-pink  no-radius ">
									<i class=" icon-info-sign bigger-200"></i>
									Ayuda
								</button>

								<button class="btn btn-app btn-inverse no-radius animated rollIn" id="btn_salir">
									<i class="icon-lock bigger-160"></i>
									Salir
								</button>
							</p>
						</div> -->

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
		<script src="../assets/js/spin.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>



		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script src="app.js"></script>
	</body>
</html>
