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
		<title>FÁBRICA IMBABURA</title>

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
				<div class="page-content">
					<div class="row-fluid">
						<div class="offset1 span10">
							
							<div class="space"></div>

							<form class="form-horizontal" />
								<div class="tabbable">
									<ul class="nav nav-tabs padding-16">
										<li class="active">
											<a data-toggle="tab" href="#edit-basic">
												<i class="green icon-edit bigger-125"></i>
												Basic Info
											</a>
										</li>

										<li>
											<a data-toggle="tab" href="#edit-settings">
												<i class="purple icon-cog bigger-125"></i>
												Settings
											</a>
										</li>

										<li>
											<a data-toggle="tab" href="#edit-password">
												<i class="blue icon-key bigger-125"></i>
												Password
											</a>
										</li>
									</ul>

									<div class="tab-content profile-edit-tab-content">
										<div id="edit-basic" class="tab-pane in active">
											<h4 class="header blue bolder smaller">General</h4>

											<div class="row-fluid">
												<div class="span4">
													<input type="file" />
												</div>

												<div class="vspace"></div>

												<div class="span8">
													<div class="control-group">
														<label class="control-label" for="form-field-username">Username</label>

														<div class="controls">
															<input type="text" id="form-field-username" placeholder="Username" value="alexdoe" />
														</div>
													</div>

													<div class="control-group">
														<label class="control-label" for="form-field-first">Name</label>

														<div class="controls">
															<input class="input-small" type="text" id="form-field-first" placeholder="First Name" value="Alex" />
															<input class="input-small" type="text" id="form-field-last" placeholder="Last Name" value="Doe" />
														</div>
													</div>
												</div>
											</div>

											<hr />
											<div class="control-group">
												<label class="control-label" for="form-field-date">Birth Date</label>

												<div class="controls">
													<div class="input-append">
														<input class="input-small date-picker" id="form-field-date" type="text" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
														<span class="add-on">
															<i class="icon-calendar"></i>
														</span>
													</div>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label">Gender</label>

												<div class="controls">
													<div class="space-2"></div>

													<label class="inline">
														<input name="form-field-radio" type="radio" />
														<span class="lbl"> Male</span>
													</label>

													&nbsp; &nbsp; &nbsp;
													<label class="inline">
														<input name="form-field-radio" type="radio" />
														<span class="lbl"> Female</span>
													</label>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="form-field-comment">Comment</label>

												<div class="controls">
													<textarea id="form-field-comment"></textarea>
												</div>
											</div>

											<div class="space"></div>
											<h4 class="header blue bolder smaller">Contact</h4>

											<div class="control-group">
												<label class="control-label" for="form-field-email">Email</label>

												<div class="controls">
													<span class="input-icon input-icon-right">
														<input type="email" id="form-field-email" value="alexdoe@gmail.com" />
														<i class="icon-envelope"></i>
													</span>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="form-field-website">Website</label>

												<div class="controls">
													<span class="input-icon input-icon-right">
														<input type="url" id="form-field-website" value="http://www.alexdoe.com/" />
														<i class="icon-globe"></i>
													</span>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="form-field-phone">Phone</label>

												<div class="controls">
													<span class="input-icon input-icon-right">
														<input class="input-medium input-mask-phone" type="text" id="form-field-phone" />
														<i class="icon-phone icon-flip-horizontal"></i>
													</span>
												</div>
											</div>

											<div class="space"></div>
											<h4 class="header blue bolder smaller">Social</h4>

											<div class="control-group">
												<label class="control-label" for="form-field-facebook">Facebook</label>

												<div class="controls">
													<span class="input-icon">
														<input type="text" value="facebook_alexdoe" id="form-field-facebook" />
														<i class="icon-facebook"></i>
													</span>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="form-field-twitter">Twitter</label>

												<div class="controls">
													<span class="input-icon">
														<input type="text" value="twitter_alexdoe" id="form-field-twitter" />
														<i class="icon-twitter"></i>
													</span>
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="form-field-gplus">Google+</label>

												<div class="controls">
													<span class="input-icon">
														<input type="text" value="google_alexdoe" id="form-field-gplus" />
														<i class="icon-google-plus"></i>
													</span>
												</div>
											</div>
										</div>

										<div id="edit-settings" class="tab-pane">
											<div class="space-10"></div>

											<div>
												<label class="inline">
													<input type="checkbox" name="form-field-checkbox" />
													<span class="lbl"> Make my profile public</span>
												</label>
											</div>

											<div class="space-8"></div>

											<div>
												<label class="inline">
													<input type="checkbox" name="form-field-checkbox" />
													<span class="lbl"> Email me new updates</span>
												</label>
											</div>

											<div class="space-8"></div>

											<div>
												<label class="inline">
													<input type="checkbox" name="form-field-checkbox" />
													<span class="lbl"> Keep a history of my conversations</span>
												</label>

												<label class="inline">
													<span class="space-2 block"></span>

													for
													<input type="text" class="input-mini" maxlength="3" />
													days
												</label>
											</div>
										</div>

										<div id="edit-password" class="tab-pane">
											<div class="space-10"></div>

											<div class="control-group">
												<label class="control-label" for="form-field-pass1">New Password</label>

												<div class="controls">
													<input type="password" id="form-field-pass1" />
												</div>
											</div>

											<div class="control-group">
												<label class="control-label" for="form-field-pass2">Confirm Password</label>

												<div class="controls">
													<input type="password" id="form-field-pass2" />
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="form-actions">
									<button class="btn btn-info" type="button">
										<i class="icon-ok bigger-110"></i>
										Save
									</button>

									&nbsp; &nbsp; &nbsp;
									<button class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										Reset
									</button>
								</div>
							</form>
						</div><!--/span-->

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
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/flot/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/spin.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/data.js"></script>
		<script src="http://code.highcharts.com/modules/drilldown.js"></script>

		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script src="app.js"></script>
	</body>
</html>
