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
						<li class="active">Reportes</li>
					</ul><!--.breadcrumb-->
				</div>
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<div class="widget-box transparent">
								<div class="widget-header">
									<h4 class="lighter">Reportes</h4>

									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs" id="myTab2">
											<li class="active">
												<a data-toggle="tab" href="#home2">
													<i class="icon-print green"></i>
													Servicio más reservado
												</a>
											</li>

											<li>
												<a data-toggle="tab" href="#profile2">
												<i class="icon-print purple"></i>
													Reserva a la Semana
												</a>
											</li>
										</ul>
									</div>
								</div>
								<style type="text/css">
									iframe{
										border:0px;
									}
								</style>
								<div class="widget-body">
									<div class="widget-main padding-12 no-padding-left no-padding-right">
										<div class="tab-content padding-4">
											<div id="home2" class="tab-pane in active">
												<div class="slim-scroll" data-height="590">
													<iframe src="reportes" width="100%" border="0" height="550"></iframe>
												</div>
											</div>

											<div id="profile2" class="tab-pane">
												<div class="slim-scroll" data-height="550">
													<form class="form-horizontal">
									                    <div class="row-fluid">
									                        <div class="span6">
									                            <div class="control-group">
									                                <label class="control-label" for="form-field-1">Seleccione Fechas</label>
									                                <div class="controls">
									                                    <div class="row-fluid input-prepend">
									                                        <span class="add-on">
									                                            <i class="icon-calendar"></i>
									                                        </span>
									                                        <input class="span7" type="text" name="date-range-picker" id="id-date-range-picker-1" />
									                                    </div>
									                                </div>
									                            </div>
									                        </div>
									                        <div class="span6">
									                        	<div class="control-group">
									                                <div class="controls">
									                                    <button class="btn btn-info" type="button">
											                                <i class="icon-ok bigger-110"></i>
											                                Submit
											                            </button>
									                                </div>
									                            </div>
									                        </div>
									                    </div>
									                </form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
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
		<script src="assets/js/jquery.sparkline.min.js"></script>



		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
			$(function() {
				// scrollables
				$('.slim-scroll').each(function () {
					var $this = $(this);
					$this.slimScroll({
						height: $this.data('height') || 100,
						railVisible:true
					});
				});
			});
		</script>

	</body>
</html>
