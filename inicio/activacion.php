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
						<img src="../assets/empresa/banner.fw.png">
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
									$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='".$_GET['id']."' and stado=0");
									$stado=0; $nom=""; $correo="";

									while ($row=$class->fetch_array($resultado)) {
											$existencia=1;											
											//valores a consumir											
											$nom = $row[2];
											$correo = $row[5];
											$stado=1;
									}
									$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='".$_GET['id']."' and stado=1");
									while ($row=$class->fetch_array($resultado)) {
											$existencia=1;											
											//valores a consumir											
											$nom = $row[2];
											$correo = $row[5];
											$stado=2;
									}								
								}
								?>
								<div class="widget-body">
									<div class="widget-main">
										<form class="form-horizontal" class="span12" />
											<div class="control-group">
												<label class="control-label" for="form-input-readonly">Nombre y Apellido</label>

												<div class="controls">
													<input readonly="" type="text" id="form-input-readonly" value="<?php if (isset($_GET['id'])){print$nom;}?>" class="span12" />													
												</div>
											</div>
											<div class="control-group">
												<label class="control-label" for="form-input-readonly">Correo / Email</label>

												<div class="controls">
													<input readonly="" type="text" id="form-input-readonly" value="<?php if (isset($_GET['id']))print$correo;?>" class="span12" />													
												</div>
											</div>
											<div class="control-group">
												<?php 
													if (isset($_GET['id']))if($stado==1){ 
													$class->consulta("UPDATE SEG.USUARIO SET stado='1' WHERE ID='".$_GET['id']."'");
													$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
																										"','UPDATE','".
																										$_GET['id'].
																										"','SEG.USUARIO','STADO','".$_GET['id']."','".
																										$class->fecha_hora().
																										"','ACTIVACION CUENTA')");
												?>
												<h3 class="header smaller lighter green">Felicidades su cuenta se ha activado satisfactoriamente
												<?php } if (isset($_GET['id']))if ($stado==2) {?>
												<h3 class="header smaller lighter green">Su cuenta ya está activa le sugerimos acceder a identificarse
												<?php } ?>
												<div class="icon-ok bigger-230"></div>
												<a href="index.php" class="btn btn-primary icon-desktop"> Acceder</a>
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

		<script src="../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.resize.min.js"></script>

		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		
	</body>
</html>
