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
						require('../../admin/class.php');
						$class=new constante();
						$id=$_SESSION['id'];						
						$resultado = $class->consulta("SELECT ID,CEDULA,NOMBRE,
															PG_CATALOG.DATE(EDAD),extract(day from age(now(),edad)),FONO,CORREO,FECHA,DIRECCION FROM SEG.USUARIO WHERE id='$id' and stado='1'");	
						while ($row=$class->fetch_array($resultado)) {

						
				?>
					<div class="row-fluid">
						<div class="tabbable">
							<ul class="nav nav-tabs padding-18">
								<li class="active">
									<a data-toggle="tab" href="#home">
										<i class="green icon-user bigger-120"></i>
										Perfil
									</a>
								</li>

								<!-- <li>
									<a data-toggle="tab" href="#feed">
										<i class="orange icon-rss bigger-120"></i>
										Actividad
									</a>
								</li>

								<li>
									<a data-toggle="tab" href="#friends">
										<i class="blue icon-group bigger-120"></i>
										Historial
									</a>
								</li>

								<li>
									<a data-toggle="tab" href="#pictures">
										<i class="pink icon-picture bigger-120"></i>
										Otros
									</a>
								</li> -->
							</ul>

							<div class="tab-content no-border padding-24">
								<div id="home" class="tab-pane in active">
									<div class="row-fluid">
										<div class="span3 center">
											<span class="profile-picture">
												<img class="editable" alt="Alex's Avatar" id="avatar2" src="../../assets/avatars/avatar2.png" />
											</span>

											<div class="space space-4"></div>
											
										</div><!--/span-->

										<div class="span9">
											<h4 class="blue">
												<span class="middle"><?php print($row[2]); ?></span>

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
								
															<select class="select2 span3" id="sel_pais" placeholder="Seleccione Pais">
																
															</select>														
															<select class="select2 span3" id="sel_provincia" placeholder="Seleccione Provincia">
																
															</select>														
															<select class="select2 span3" id="sel_ciudad" placeholder="Seleccione Ciudad">
																
															</select>														
																										
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> F. Nacimiento</div>													
														<div class="profile-info-value">						  								
															<span class="editable" id="txt_fna"><?php 
																									if ($row[4]!=0) {
																										print($row[3]);	
																									}?>
															</span>
														</div>													
												</div>
												<?php if ($row[4]!=0){?>
													<div class="profile-info-row">
													<div class="profile-info-name"> Edad :</div>													
														<div class="profile-info-value">							  								
															<span id="signup"><?php print($row[4]); ?></span>

														</div>													
													</div>
												<?php } ?>												

												<div class="profile-info-row">
													<div class="profile-info-name"> Telefono </div>
													<div class="profile-info-value">
														<span id="txt_telefono"><?php print($row[5]); ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Dirección: </div>

													<div class="profile-info-value">
														<span id="lbl_pais"></span>
														<span id="lbl_pro"></span>
														<span id="lbl_ciu"></span>
														<span class="editable" id="txt_direccion"><?php print($row[8]); ?></span>
													</div>

												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Correo: </div>

													<div class="profile-info-value">
														<span ><?php print($row[6]); ?></span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> F. Suscripción: </div>

													<div class="profile-info-value">
														<span><?php print($row[7]); ?></span>
													</div>
												</div>
											</div>
											<div class="btn btn-app btn-small btn-success" id="btn_actualizar">Actualizar</div>
											<div class="hr hr-8 dotted"></div>

											
										</div><!--/span-->
									</div><!--/row-fluid-->									
								</div><!--#home-->

								<div id="feed" class="tab-pane">
									<div class="profile-feed row-fluid">
										<div class="span6">
											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="Alex Doe's avatar" src="../assets/avatars/avatar5.png" />
													<a class="user" href="#"> Alex Doe </a>
													changed his profile
													<a href="#">Take a look</a>

													<div class="time">
														<i class="icon-time bigger-110"></i>
														an hour ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="Susan Smith's avatar" src="../assets/avatars/avatar1.png" />
													<a class="user" href="#"> Susan Smith </a>

													is now friends with Alex Doe.
													<div class="time">
														<i class="icon-time bigger-110"></i>
														2 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon icon-ok btn-success no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>
													joined
													<a href="#">Country Music</a>

													group.
													<div class="time">
														<i class="icon-time bigger-110"></i>
														5 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon icon-picture btn-info no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>
													uploaded a new photo.
													<a href="#">Take a look</a>

													<div class="time">
														<i class="icon-time bigger-110"></i>
														5 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="David Palms's avatar" src="../assets/avatars/avatar4.png" />
													<a class="user" href="#"> David Palms </a>

													left a comment on Alex's wall.
													<div class="time">
														<i class="icon-time bigger-110"></i>
														8 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>
										</div><!--/span-->

										<div class="span6">
											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon icon-edit btn-pink no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>
													published a new blog post.
													<a href="#">Read now</a>

													<div class="time">
														<i class="icon-time bigger-110"></i>
														11 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<img class="pull-left" alt="Alex Doe's avatar" src="../assets/avatars/avatar5.png" />
													<a class="user" href="#"> Alex Doe </a>

													upgraded his skills.
													<div class="time">
														<i class="icon-time bigger-110"></i>
														12 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon icon-key btn-info no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>

													logged in.
													<div class="time">
														<i class="icon-time bigger-110"></i>
														12 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon icon-off btn-inverse no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>

													logged out.
													<div class="time">
														<i class="icon-time bigger-110"></i>
														16 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>

											<div class="profile-activity clearfix">
												<div>
													<i class="pull-left thumbicon icon-key btn-info no-hover"></i>
													<a class="user" href="#"> Alex Doe </a>

													logged in.
													<div class="time">
														<i class="icon-time bigger-110"></i>
														16 hours ago
													</div>
												</div>

												<div class="tools action-buttons">
													<a href="#" class="blue">
														<i class="icon-pencil bigger-125"></i>
													</a>

													<a href="#" class="red">
														<i class="icon-remove bigger-125"></i>
													</a>
												</div>
											</div>
										</div><!--/span-->
									</div><!--/row-->

									<div class="space-12"></div>

									<div class="center">
										<a href="#" class="btn btn-small btn-primary">
											<i class="icon-rss bigger-150 middle"></i>

											View more activities
											<i class="icon-on-right icon-arrow-right"></i>
										</a>
									</div>
								</div><!--/#feed-->

								<div id="friends" class="tab-pane">
									<div class="profile-users clearfix">
										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar4.png" alt="Bob Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-online"></span>
															Bob Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Content Editor</div>

														<div class="time">
															<i class="icon-time middle bigger-120 orange"></i>
															<span class="green"> 20 mins ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar1.png" alt="Rose Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-offline"></span>
															Rose Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Graphic Designer</div>

														<div class="time">
															<i class="icon-time middle bigger-120 grey"></i>
															<span class="grey"> 30 min ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar.png" alt="Jim Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-busy"></span>
															Jim Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">SEO &amp; Advertising</div>

														<div class="time">
															<i class="icon-time middle bigger-120 red"></i>
															<span class="grey"> 1 hour ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar5.png" alt="Alex Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-idle"></span>
															Alex Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Marketing</div>

														<div class="time">
															<i class="icon-time middle bigger-120 orange"></i>
															<span class=""> 40 minutes idle </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar2.png" alt="Phil Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-online"></span>
															Phil Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Public Relations</div>

														<div class="time">
															<i class="icon-time middle bigger-120 orange"></i>
															<span class="green"> 2 hours ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar3.png" alt="Susan Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-online"></span>
															Susan Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">HR Management</div>

														<div class="time">
															<i class="icon-time middle bigger-120 orange"></i>
															<span class="green"> 20 mins ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar1.png" alt="Jennifer Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-offline"></span>
															Jennifer Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Graphic Designer</div>

														<div class="time">
															<i class="icon-time middle bigger-120 grey"></i>
															<span class="grey"> 2 hours ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="itemdiv memberdiv">
											<div class="inline position-relative">
												<div class="user">
													<a href="#">
														<img src="../assets/avatars/avatar3.png" alt="Alexa Doe's avatar" />
													</a>
												</div>

												<div class="body">
													<div class="name">
														<a href="#">
															<span class="user-status status-offline"></span>
															Alexa Doe
														</a>
													</div>
												</div>

												<div class="popover">
													<div class="arrow"></div>

													<div class="popover-content">
														<div class="bolder">Accounting</div>

														<div class="time">
															<i class="icon-time middle bigger-120 grey"></i>
															<span class="grey"> 4 hours ago </span>
														</div>

														<div class="hr dotted hr-8"></div>

														<div class="tools action-buttons">
															<a href="#">
																<i class="icon-facebook-sign blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-twitter-sign light-blue bigger-150"></i>
															</a>

															<a href="#">
																<i class="icon-google-plus-sign red bigger-150"></i>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="hr hr10 hr-double"></div>

									<ul class="pager pull-right">
										<li class="previous disabled">
											<a href="#">&larr; Prev</a>
										</li>

										<li class="next">
											<a href="#">Next &rarr;</a>
										</li>
									</ul>
								</div><!--/#friends-->

								<div id="pictures" class="tab-pane">
									<ul class="ace-thumbnails">
										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-1.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-2.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-3.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-4.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-5.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-6.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-1.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>

										<li>
											<a href="#" data-rel="colorbox">
												<img alt="150x150" src="../assets/images/gallery/thumb-2.jpg" />
												<div class="text">
													<div class="inner">Sample Caption on Hover</div>
												</div>
											</a>

											<div class="tools tools-bottom">
												<a href="#">
													<i class="icon-link"></i>
												</a>

												<a href="#">
													<i class="icon-paper-clip"></i>
												</a>

												<a href="#">
													<i class="icon-pencil"></i>
												</a>

												<a href="#">
													<i class="icon-remove red"></i>
												</a>
											</div>
										</li>
									</ul>
								</div><!--/#pictures-->
							</div>
						</div>						
					</div>
				<?php } ?>
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



		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->
		<script type="text/javascript">			
			$(function(){
				//Enviar datos extras
				acupais()	
					
				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    

				//formato pais
				
				
				// $(".select2").chosen();

			
				//formato inicializacion formato entrada telefono
				$('.input-mask-phone').mask('(999) 999-9999');

				//Formato inicializacion fecha de nacimiento campo
				$('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

				$('#txt_fna').editable({
					type: 'date',
					format: 'yyyy-mm-dd',
					viewformat: 'dd/mm/yyyy',
					value: new Date(),
					datepicker: {
						minDate: new Date(),
						endDate: new Date(),
						startDate: '01/12/1950',
						weekStart: 1
					}
				});
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
			function busca_reg_valor(id){
				var regi='';
				$.ajax({
				    url: "../localizacion/pais.php",
				    type: "POST",
				    async:false,
				    data: {nom_pais:'pro',registro:id},        
				    success: function(data)
				    {	
				       regi=data;			       
				    }	        
				});
				return regi;
			}
			function busca_reg_valorp(id){
				var regi='';
				$.ajax({
				    url: "../localizacion/pais.php",
				    type: "POST",
				    async:false,
				    data: {nom_pro:'pro',registro:id},        
				    success: function(data)
				    {	
				       regi=data;			       
				    }	        
				});
				return regi;
			}
			function busca_reg_valorc(id){
				var regi='';
				$.ajax({
				    url: "../localizacion/pais.php",
				    type: "POST",
				    async:false,
				    data: {nom_ciu:'pro',registro:id},        
				    success: function(data)
				    {	
				       regi=data;			       
				    }	        
				});
				return regi;
			}
			function msm_cod(){
				alert('hola')				
			}
			function acupais(){
					$.ajax({
					    url: "../localizacion/pais.php",					   
					    async: false,
					    type: "POST",
					    data:{pais:"pasi"},
					    success: function(data)
					    {			
					    	// console.log(data);
					    	$('#sel_pais').html(data);

					    }					    
					});																		
			}		
			function cargar_pro(id){				
				$.ajax({
				    url: "../localizacion/pais.php",
				    type: "POST",
				    data: {pro:'pro',registro:id},        
				    success: function(data)
				    {	
				       $('#sel_provincia').html(data);				       
				    }	        
				});					
			}
			function cargar_c(id){				
				$.ajax({
				    url: "../localizacion/pais.php",
				    type: "POST",
				    data: {c:'pro',registro:id},        
				    success: function(data)
				    {				    	
				       $('#sel_ciudad').html(data);
				    }	        
				});

			}
		</script>
		
	</body>
</html>
<script type="text/javascript">
	$('#btn_actualizar').click(function(){
		var tele=$('#txt_telefono').html()
		var f_n=$('#txt_fna').html()
		var dir=$('#txt_direccion').html()
		var ciudad=$('#sel_ciudad').val()
		
		$.ajax({
			url: "../localizacion/pais.php",
		    type: "POST",
		    data: {guardar_perfil:'ok',txt_1:tele,txt_2:f_n,txt_3:dir,txt_4:ciudad},        
		    success: function(data)
		    {				    	
		       $.gritter.add({						
				title: '..Mensaje..!',						
				text: 'OK: <br><i class="icon-cloud purple bigger-230"></i>  Sus datos fueron actualizados correctamente. <br><i class="icon-spinner icon-spin green bigger-230"></i>',						
				//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
				sticky: false,						
				time: 2000
			});
		    }	
		});
	});
</script>