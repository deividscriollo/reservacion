<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../inicio');
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Reservaciones fabrica imbabura, museo, restaurant">
	<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />
	<meta name="author" content="">

	<title>Reservaciones -  Fabrica Imbabura</title>

	<!-- CSS -->
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="assets/css/simple-line-icons.css" rel="stylesheet" media="screen">
	<link href="assets/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
	<link rel="stylesheet" href="assets/css/jquery.bootstrap-touchspin.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/prettify.css">


	<link href="assets/css/animate.css" rel="stylesheet">
	<link href="assets/css/animate2.css" rel="stylesheet">

	<!-- Custom styles CSS -->
	<link href="assets/css/style.css" rel="stylesheet" media="screen">

	<script type=”text/javascript”>
    var dispositivo = navigator.userAgent.toLowerCase();
      if( dispositivo.search(/iphone|ipod|ipad|android/) > -1 ){
      document.location = 'google.com';  }
  </script>


    <script src="assets/js/modernizr.custom.js"></script>

</head>
<body>

	<!-- Preloader -->

	<div id="preloader">
		<div id="status"></div>
	</div>

	<!-- Home start -->

	<section id="home" class="pfblock-image screen-height">
        <div class="home-overlay"></div>
		<div class="intro">
			<div class="start">Estimado Cliente, Seleccione el servicio a reservar</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<ul class="social-links">
							<li class="wow fadeInUp" data-wow-delay=".1s">
								<a href="#museo" >
									<img src="../servicios/img/" width="50%" id="obj_museo_img">
								</a>
								<div class="dc_texto" id="obj_museo_nom"></div>
							</li>
							<li class="wow fadeInUp" data-wow-delay=".2s">
								<a href="#arrieros" >
									<img src="../servicios/img/" width="50%" id="obj_arrieros_img">
								</a>
								<div class="dc_texto" id="obj_arrieros_nom"></div>
							</li>
							<li class="wow fadeInUp" data-wow-delay=".3s">
								<a href="#posada">
									<img src="../servicios/img/" width="50%" id="obj_posada_img">
								</a>
								<div class="dc_texto" id="obj_posada_nom"></div>
							</li>
							<li class="wow fadeInUp" data-wow-delay=".4s">
								<a href="#club">
									<img src="../servicios/img/" width="50%" id="obj_club_img">
								</a>
								<div class="dc_texto" id="obj_club_nom"></div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

        <a href="#museo">
		<div class="scroll-down">
            <span>
                <i class="fa fa-angle-down fa-2x"></i>
            </span>
		</div>
        </a>

	</section>

	<!-- Home end -->

	<!-- Navigation start -->

	<header class="header">

		<nav class="navbar navbar-custom" role="navigation">

			<div class="container">

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
						<span class="sr-only">Navegación Movil</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html">Fabrica Imbabura</a>
				</div>

				<div class="collapse navbar-collapse" id="custom-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../inicio">Atras</a></li>
						<li><a href="#home">Inicio</a></li>
						<li><a href="#museo" id="obj_menu_museo">museo</a></li>
                        <li><a href="#arrieros" id="obj_menu_arrieros">centro de convenciones</a></li>
                        <li><a href="#posada" id="obj_menu_posada">restaurante</a></li>
						<li><a href="#club" id="obj_menu_club">teatro auditorio</a></li>
					</ul>
				</div>

			</div><!-- .container -->

		</nav>

	</header>

	<!-- Navigation end -->

    <!-- Services start -->

	<section id="museo" class="pfblock pfblock-gray ">
		<div class="ayuda wow zoomInRight btn" id="btn_modal_info">Información Museo <i class="fa fa-info-circle"></i></div>
		<div class="container">
			<div class="row">

				<div class="col-sm-6 col-sm-offset-3">
					<div class="pfblock-header wow fadeInUp">
						<h2 class="pfblock-title" id="obj_title_museo">Museo</h2>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<form id="commentForm" class="form-horizontal">
						<div id="rootwizard" style="height: 450px;">
							<ul>
							  	<li><a href="#tab1" data-toggle="tab">Paso 1</a></li>
								<li><a href="#tab2" data-toggle="tab">Paso 2</a></li>
								<li><a href="#tab3" data-toggle="tab">Paso 3</a></li>
							</ul>
							<div class="tab-content">
							    <div class="tab-pane" id="tab1">
							    	<div class="row">
							    		<div class="col-md-4 col-md-offset-4">
											<div class="iconbox wow slideInRight">
												<h3 class="iconbox-title">Estimado, Deivid seleccione el tipo de reservación</h3>
												<div class="iconbox-desc">
													<div class="form-group">
														<select class="form-control" id="select_tipo_reser_museo" name="select_tipo_reser_museo">
														</select>
													</div>
													<div class="form-group hidden" id="obj_institucion">
													    <label for="exampleInputEmail1">Ingrese nombre de la Intitución</label>
													    <input type="text" class="form-control" id="txt_nom_inst" name="txt_nom_inst" placeholder="Ingrese nombre de la institución">
													</div>
												</div>
											</div>
										</div>
							    	</div>
								</div>
							    <div class="tab-pane" id="tab2">
							    	<div class="row">
								     	<div class="col-md-8 col-md-offset-2">
											<div class="iconbox animated fadeInUp">
												<h3 class="iconbox-title">Seleccione fecha y hora</h3>
												<div class="row">
													<div class="col-md-6 col-md-offset-3">
														<div class="form-group">
											                <div class='input-group date' id='datetimepicker1'>
											                    <input type='text' class="form-control" id="txt_fecha_origen" name="txt_fecha_origen" placeholder="Seleccione fecha de reservación" />
											                    <span class="input-group-addon">
											                        <span class="fa fa-calendar"></span>
											                    </span>
											                </div>
											            </div>
													</div>
												</div>
												<div class="panel panel-default">
												    <table class="table table-condensed" >
												        <thead>
												            <tr>
												                <th>Nro</th>
																<th class="center"><i class="fa fa-check-square-o"></i></th>
																<th>Desde</th>
																<th>Hasta</th>
																<th>fecha</th>
																<th>Día</th>
												            </tr>
												        </thead>
												    </table>
													<div class="div-table-content">
													    <table class="table table-condensed" id="tabla_horas">
													        <tbody>
													        </tbody>
													    </table>
													</div>
												</div>
											</div>
										</div>
									</div>
							    </div>
								<div class="tab-pane" id="tab3">
									<div class="row">
										<div class="col-md-10 col-md-offset-1 ">
											<div class="iconbox wow slideInLeft">
												<div class="row">
													<div class="col-md-8">
														<div id="form-v_reserva">
														</div>
													</div>
													<div class="col-md-4">
														<table class="table table-striped">
															<tr><td class="pull-right">SubTotal: $</td><td><label id="lbl_subtotal">0.00</label></td></tr>
															<tr><td class="pull-right" id="lbl_inf_iva">Iva: $</td><td><label id="lbl_iva">0.00</label></td></tr>
															<tr><td class="pull-right">Total: $</td><td><label id="lbl_total">0.00</label></td></tr>
														</table>
														<div class="btn btn-success" id="btn_guardar_reservacion">Reservar</div>
													</div>
												</div>
												<div class="row">
													<table id="tabla_horas_acu" class="table">
														<thead>
															<tr class="center">
																<th >Nro</th>
																<th>H. Inicio</th>
																<th>H. Fin</th>
																<th>fecha</th>
																<th>Día</th>
															</tr>
														</thead>
														<tbody></tbody>
													</table>
												</div>

											</div>
										</div>
									</div>
							    </div>
								<ul class="pager wizard">
									<li class="previous first" style="display:none;">First</li>
									<li class="previous" id="btn_atras">
										<div class="btn btn-lg btn-default wow fadeInUp">
											<i class="fa fa-chevron-circle-left"></i> Atras
										</div>
									</li>
									<li class="next last" style="display:none;">Las</li>
								  	<li class="next" id="btn_sigiente">
								  		<div class="btn btn-lg btn-default wow fadeInUp">
								  			Siguiente
								  			<i class="fa fa-chevron-circle-right"></i>
								  		</div>
								  	</li>
								</ul>
							</div>
						</div>
						</form>
				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</section>

	<!-- Services end -->
	<!-- Portfolio start -->

	<section id="arrieros" class="pfblock">
		<div class="container">
			<div class="row">

				<div class="col-sm-6 col-sm-offset-3">

					<div class="pfblock-header wow fadeInUp">
						<h2 class="pfblock-title">My works</h2>
						<div class="pfblock-line"></div>
						<div class="pfblock-subtitle">
							No one lights a lamp in order to hide it behind the door: the purpose of light is to create more light, to open people’s eyes, to reveal the marvels around.
						</div>
					</div>

				</div>

			</div><!-- .row -->
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-1.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Crazy <span>Shark</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-2.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Funny <span>Tortoise</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-3.jpg" alt="img01"/>
                            <figcaption>
                                <h2>The <span>Hat</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-4.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Bang <span>Bang</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-5.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Crypton <span>Dude</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="grid wow zoomIn">
                        <figure class="effect-bubba">
                            <img src="assets/images/item-6.jpg" alt="img01"/>
                            <figcaption>
                                <h2>Don't <span>Poke</span></h2>
                                <p>Lily likes to play with crayons and pencils</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>


		</div><!-- .contaier -->

	</section>

	<!-- Portfolio end -->
    <!-- Skills start -->
    <section id="posada" class="pfblock pfblock-gray">
			<div class="container">
				<div class="row skills">
					<div class="row">

                        <div class="col-sm-6 col-sm-offset-3">

                            <div class="pfblock-header wow fadeInUp">
                                <h2 class="pfblock-title">My Skills</h2>
                                <div class="pfblock-line"></div>
                                <div class="pfblock-subtitle">
                                    No one lights a lamp in order to hide it behind the door: the purpose of light is to create more light, to open people’s eyes, to reveal the marvels around.
                                </div>
                            </div>

                        </div>

                    </div><!-- .row -->
					<div class="col-sm-6 col-md-3 text-center">
						<span data-percent="80" class="chart easyPieChart" style="width: 140px; height: 140px; line-height: 140px;">
                            <span class="percent">80</span>
                        </span>
						<h3 class="text-center">Programming</h3>
					</div>
					<div class="col-sm-6 col-md-3 text-center">
						<span data-percent="90" class="chart easyPieChart" style="width: 140px; height: 140px; line-height: 140px;">
                            <span class="percent">90</span>
                        </span>
						<h3 class="text-center">Design</h3>
					</div>
					<div class="col-sm-6 col-md-3 text-center">
						<span data-percent="85" class="chart easyPieChart" style="width: 140px; height: 140px; line-height: 140px;">
                            <span class="percent">85</span>
                        </span>
						<h3 class="text-center">Marketing</h3>
					</div>
					<div class="col-sm-6 col-md-3 text-center">
						<span data-percent="95" class="chart easyPieChart" style="width: 140px; height: 140px; line-height: 140px;">
                            <span class="percent">95</span>
                        </span>
						<h3 class="text-center">UI / UX</h3>
					</div>
				</div><!--End row -->
			</div>
    </section>
    <!-- Skills end -->

	<!-- CallToAction start -->

	<section class="calltoaction">
		<div class="container">

			<div class="row">

				<div class="col-md-12 col-lg-12">
					<h2 class="wow slideInRight" data-wow-delay=".1s">ARE YOU READY TO START?</h2>
					<div class="calltoaction-decription wow slideInRight" data-wow-delay=".2s">
						I'm available for freelance projects.
					</div>
				</div>

				<div class="col-md-12 col-lg-12 calltoaction-btn wow slideInRight" data-wow-delay=".3s">
					<a href="#contact" class="btn btn-lg">Hire Me</a>
				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</section>

	<!-- CallToAction end -->

	<!-- Testimonials start -->

	<section id="club" class="pfblock pfblock-gray">
		<div class="container">
            <div class="row">
				<div class="col-sm-6 col-sm-offset-3">

					<div class="pfblock-header wow fadeInUp">
						<h2 class="pfblock-title">What my clients say</h2>
						<div class="pfblock-line"></div>
						<div class="pfblock-subtitle">
							No one lights a lamp in order to hide it behind the door: the purpose of light is to create more light, to open people’s eyes, to reveal the marvels around.
						</div>
					</div>

				</div>

			</div><!-- .row -->

            <div class="row">

			<div id="cbp-qtrotator" class="cbp-qtrotator">
                <div class="cbp-qtcontent">
                    <img src="assets/images/client-1.jpg" alt="client-1" />
                    <blockquote>
                      <p>Work with John was a pleasure. He understood exactly what I wanted and created an awesome site for my company.</p>
                      <footer>Pino Caruso</footer>
                    </blockquote>
                </div>
                <div class="cbp-qtcontent">
                    <img src="assets/images/client-2.jpg" alt="client-2" />
                    <blockquote>
                      <p>I'm really happy with the results. Get 100% satisfaction is difficult but Alex got it without problems.</p>
                      <footer>Jane Doe</footer>
                    </blockquote>
                </div>
            </div>
            </div><!-- .row -->

		</div><!-- .row -->
	</section>

	<!-- Testimonial end -->


	<!-- Contact start -->

	<section id="contact" class="pfblock">
		<div class="container">
			<div class="row">

				<div class="col-sm-6 col-sm-offset-3">

					<div class="pfblock-header">
						<h2 class="pfblock-title">Drop me a line</h2>
						<div class="pfblock-line"></div>
						<div class="pfblock-subtitle">
							No one lights a lamp in order to hide it behind the door: the purpose of light is to create more light, to open people’s eyes, to reveal the marvels around.
						</div>
					</div>

				</div>

			</div><!-- .row -->

			<div class="row">

				<div class="col-sm-6 col-sm-offset-3">

					<form id="contact-form" role="form">
						<div class="ajax-hidden">
							<div class="form-group wow fadeInUp">
								<label class="sr-only" for="c_name">Name</label>
								<input type="text" id="c_name" class="form-control" name="c_name" placeholder="Name">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".1s">
								<label class="sr-only" for="c_email">Email</label>
								<input type="email" id="c_email" class="form-control" name="c_email" placeholder="E-mail">
							</div>

							<div class="form-group wow fadeInUp" data-wow-delay=".2s">
								<textarea class="form-control" id="c_message" name="c_message" rows="7" placeholder="Message"></textarea>
							</div>

							<button type="submit" class="btn btn-lg btn-block wow fadeInUp" data-wow-delay=".3s">Send Message</button>
						</div>
						<div class="ajax-response"></div>
					</form>

				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</section>

	<!-- Contact end -->

	<!-- modals informacion -->
	<div class="modal fade" id="modal-museo" aria-hidden="true">
        <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Información Museo</h4>
		      </div>
		      <div class="modal-body">
		      	<div class="row">
			      	<div class="col-xs-12 col-sm-8 col-md-8" id="obj_info_museo_alert">			      		
			      	</div>
			      	<div class="col-xs-12 col-sm-4 col-md-4">			      		
			      		<div class="thumbnail">
			      			<div class="caption wow bouceInDown" id="obj_info_museo_nom"></div>
							<img src="" class="wow bounceInUp" alt="Museo" id="obj_info_museo">		
						</div>
			      	</div>
			    </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		</div>

    </div>
	<!-- fin modal informacion -->

	<!-- Footer start -->

	<footer id="footer">
		<div class="container">
			<div class="row">

				<div class="col-sm-12">

					<ul class="social-links">
						<li><a href="index.html#" class="wow fadeInUp"><i class="fa fa-facebook"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".1s"><i class="fa fa-twitter"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".2s"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".4s"><i class="fa fa-pinterest"></i></a></li>
						<li><a href="index.html#" class="wow fadeInUp" data-wow-delay=".5s"><i class="fa fa-envelope"></i></a></li>
					</ul>

					<p class="heart">
                        Made with <span class="fa fa-heart fa-2x animated pulse"></span> in Nottingham
                    </p>
                    <p class="copyright">
                        © 2015 John Doe | Images: <a href="https://unsplash.com/">Unsplash</a> & <a href="http://zoomwalls.com/">Zoomwalls</a>
					</p>

				</div>

			</div><!-- .row -->
		</div><!-- .container -->
	</footer>

	<!-- Footer end -->

	<!-- Scroll to top -->

	<div class="scroll-up">
		<a href="#home"><i class="fa fa-angle-up"></i></a>
	</div>
    <!-- Scroll to top end-->

	<!-- Javascript files -->

	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.bootstrap.wizard.js"></script>
	<script src="assets/js/prettify.js"></script>
	<script src="assets/js/jquery.parallax-1.1.3.js"></script>
	<script src="assets/js/imagesloaded.pkgd.js"></script>
	<script src="assets/js/jquery.sticky.js"></script>
	<script src="assets/js/smoothscroll.js"></script>
	<script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery.easypiechart.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.cbpQTRotator.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/moment-with-locales.js"></script>
	<script src="assets/js/bootstrap-datetimepicker.js"></script>
	<script src="../assets/js/jquery.gritter.min.js"></script>
	<script src="assets/js/jquery.bootstrap-touchspin.js"></script>	
	<script src="../assets/js/jquery.validate.min.js"></script>
	<script src="../assets/js/additional-methods.min.js"></script>
	<script src="assets/js/underscore-1.5.2.min.js"></script>
	<script src="assets/js/jquery.scrollTableBody-1.0.0.js"></script>
	<script src="../assets/js/blockui.js"></script>
	<script src="app.js"></script>
</body>
</html>