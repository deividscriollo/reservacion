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
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
		<meta charset="utf-8" />
		<title>FABRICA IMBABURA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />

		<!--Css Especificos-->

		<link rel="stylesheet" href="../assets/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.css" />
		<link rel="stylesheet" href="../assets/css/select2.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-editable.css" />

		<!--basic styles-->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css"  />
		<link rel="stylesheet" href="../assets/css/bootstrap-responsive.min.css"  />
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.css" />
		<link rel="stylesheet" href="../assets/css/datepicker.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="../assets/css/colorpicker.css" />

		
		
		
		



		<link rel="stylesheet" href="../assets/css/fontdc.css" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
	

	<body>
		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php  menu(); ?>

			<div class="main-content">
				<div class="page-content">
					<div class="row-fluid">						
						<div class="span12 widget-container-span">
							<div class="widget-box">
								<div class="widget-header">
									<h5 class="smaller">Proceso Servicios</h5>

									<div class="widget-toolbar no-border">
										<ul class="nav nav-tabs" id="myTab">
											<li>
												<a data-toggle="tab" href="#home" id="btn_perfil">
													<i class="icon-cogs blue"></i>	
													Perfil 
												</a>
											</li>

											<li class="active">
												<a data-toggle="tab" href="#profile" id="btn_profile">
													<i class="icon-edit green"></i>	
													Nuevo 
												</a>
											</li>

											<li >
												<a data-toggle="tab" href="#info" id="btn_servicos">
													<i class="icon-coffee orange"></i>	
													Servicios 
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="widget-body">
									<div class="widget-main padding-6">
										<div class="tab-content">
											<div id="home" class="tab-pane">
												<div class="row-fluid">
													<div class="span4 center">
														<span class="profile-picture" id="img_foto">
															
														</span>
														<div class="space-4"></div>

														<div class="width-80 label label-info label-large arrowed-in arrowed-in-right">
															<div class="inline position-relative">
																
																<i class="icon-circle light-green middle"></i>
																<span class="white middle bigger-120">Sala de Eventos y Convenciones</span>																
															</div>
														</div>
													</div>
													<div class="span8">
														<div class="profile-user-info profile-user-info-striped">
															<div class="profile-info-row">
																<div class="profile-info-name"> Servicios </div>

																<div class="profile-info-value">
																	<span class="editable" id="lbl_servicios">Servicios</span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Descripcion </div>

																<div class="profile-info-value">																	
																	<span class="editable" id="lbl_descripcion"> descripcion</span>
																</div>
															</div>

															<div class="profile-info-row">
																<div class="profile-info-name"> Otros </div>

																<div class="profile-info-value">
																	<span class="editable" id="lbl_otros">otros</span>
																</div>
															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Fecha </div>

																<div class="profile-info-value">
																	<span class="editable" id="lbl_fecha">0000-00-00 00:00:00</span>
																</div>
															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Estado </div>

																<div class="profile-info-value">
																	<span class="editable" id="lbl_stado">--</span>
																</div>
															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Eliminar </div>

																<div class="profile-info-value">
																	<span class="editable" id="lbl_stado">
																		<div class="hidden-phone visible-desktop action-buttons">
																			<a>
																				<i class="icon-trash bigger-230 red" id="btn_eliminar"></i>
																			</a>
																		</div>
																	</span>
																</div>
															</div>
															<div class="profile-info-row">
																<div class="profile-info-name"> Asignar Horarios:</div>

																<div class="profile-info-value">
																	<span class="editable" id="lbl_stado">
																		<div class="hidden-phone visible-desktop action-buttons">
																			<a href="#modal-table" data-toggle="modal">
																				<i class="icon-time bigger-230 blue" id="bootbox-regular" >
																					
																				</i>
																			</a>
																		</div>
																	</span>
																</div>
															</div>
														</div>
													</div>
												</div>
												
											</div>
										
																
													
											
											

											<div id="profile" class="tab-pane in active">
												<div class="row-fluid">
													<div class="span12">														
														<form class="form-horizontal" id="form-servicios" enctype="multipart/form-data"  />
															<div class="row-fluid">
																<div class="span3">
																	<div class="widget-box">
																		<div class="widget-header">
																			<h4>Seleccione Imagen</h4>
																		</div>

																		<div class="widget-body">
																			<div class="widget-main">
																				<div class="row-fluid">
																					<input  type="file" name="txt_archivo" id="txt_archivo"  accept="image/*" /> 
																				</div>
																			</div>
																		</div>
																	</div>																															
																</div>
																<div class="span9">
																	<h4 class="header green">Digíte los campos respectivos</h4>
																	<div class="control-group">

																		<label class="control-label" for="Servicio">Nombre del Servicio:</label>
																		<div class="controls">
																			<div class="span12">
																				<input type="text" name="txt_servicio" id="txt_servicio" class="span6" />
																			</div>
																		</div>
																	</div>
																	<div class="control-group">
																		<label class="control-label" for="password">Descripcion:</label>

																		<div class="controls">
																			<div class="span12">
																				<textarea class="span8" name="txt_descripcion" id="txt_descripcion"></textarea>
																			</div>
																		</div>
																	</div>
																	<div class="control-group">
																		<label class="control-label" for="email">Otros:</label>

																		<div class="controls">
																			<div class="span12">
																				<input type="text" name="txt_otros" id="txt_otros" class="span6" />
																			</div>
																		</div>
																	</div>
																</div>																
															</div>
															<div class="row-fluid wizard-actions">
																<button class="btn btn-success btn-next" type="submit">
																	<i class="icon-save icon-on-right"></i>
																	Guardar
																</button>
															</div>


														</form>
													</div>
												</div>
											</div>
											<div id="info" class="tab-pane">
												<div class="profile-users clearfix" id="mostrar_servicios">
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
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../assets/js/bootbox.min.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../assets/js/jquery.hotkeys.min.js"></script>
		<script src="../assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="../assets/js/select2.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/x-editable/bootstrap-editable.min.js"></script>
		<script src="../assets/js/x-editable/ace-editable.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js"></script>
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
		<script src="../assets/js/jquery.validate.min.js"></script>
		<script src="../assets/js/additional-methods.min.js"></script>


		<!--personal scripts-->
		<script type="text/javascript" src="js/guardar.js"></script>		
		<script type="text/javascript" src="js/servicios.js"></script>
		<script type="text/javascript" src="js/editar.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<script type="text/javascript" src="js/horario.js"></script>

		<!--inline scripts related to this page-->
		<div id="modal-table" class="modal hide fade" tabindex="-1">
			<div class="modal-header no-padding">
				<div class="table-header">
					<div type="button" class="close" data-dismiss="modal">&times;</div>
					Horarios Dinámico
				</div>
			</div>

			<div class="modal-body no-padding">
				<div class="row-fluid">
					<div class="widget-main" id="obj_contenedor" style="height:350px;">
					</div>					
				</div>									
			</div>			
			<div class="modal-footer">
				<button class="btn btn-small btn-danger pull-left" data-dismiss="modal">
					<i class="icon-remove"></i>
					Cerrar
				</button>
				<button class="btn btn-small btn-success pull-left" data-dismiss="modal">
					<i class="icon-save"></i>
					Guardar
				</button>	
				<div class="pagination pull-center no-margin">
					
					<div class="hidden-phone visible-desktop action-buttons" >
						<a id="btn_m">
							<i class="icon-zoom-in bigger-130 blue pointer"></i>
						</a>
					</div>
						
				</div>												
			</div>
		</div><!--PAGE CONTENT ENDS-->

		
	</body>
</html>
<script type="text/javascript">

			$(function() {

				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='light-blue icon-2x icon-spinner icon-spin'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="icon-ok icon-white"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="icon-remove"></i></button>';    
				
				$('#lbl_descripcion').editable();	
			   
				
				
				
				
				// *** editable avatar *** //
				
				
				
			
				//another option is using modals
				$('#avatar2').on('click', function(){
					var modal = 
					'<div class="modal hide fade">\
						<div class="modal-header">\
							<button type="button" class="close" data-dismiss="modal">&times;</button>\
							<h4 class="blue">Change Avatar</h4>\
						</div>\
						\
						<form class="no-margin">\
						<div class="modal-body">\
							<div class="space-4"></div>\
							<div style="width:75%;margin-left:12%;"><input type="file" name="file-input" /></div>\
						</div>\
						\
						<div class="modal-footer center">\
							<button type="submit" class="btn btn-small btn-success"><i class="icon-ok"></i> Submit</button>\
							<button type="button" class="btn btn-small" data-dismiss="modal"><i class="icon-remove"></i> Cancel</button>\
						</div>\
						</form>\
					</div>';
					
					
					var modal = $(modal);
					modal.modal("show").on("hidden", function(){
						modal.remove();
					});
			
					var working = false;
			
					var form = modal.find('form:eq(0)');
					var file = form.find('input[type=file]').eq(0);
					file.ace_file_input({
						style:'well',
						btn_choose:'Click to choose new avatar',
						btn_change:null,
						no_icon:'icon-picture',
						thumbnail:'small',
						before_remove: function() {
							//don't remove/reset files while being uploaded
							return !working;
						},
						before_change: function(files, dropped) {
							var file = files[0];
							if(typeof file === "string") {
								//file is just a file name here (in browsers that don't support FileReader API)
								if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
							}
							else {//file is a File object
								var type = $.trim(file.type);
								if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
										|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
									) return false;
			
								if( file.size > 110000 ) {//~100Kb
									return false;
								}
							}
			
							return true;
						}
					});
			
					form.on('submit', function(){
						if(!file.data('ace_input_files')) return false;
						
						file.ace_file_input('disable');
						form.find('button').attr('disabled', 'disabled');
						form.find('.modal-body').append("<div class='center'><i class='icon-spinner icon-spin bigger-150 orange'></i></div>");
						
						var deferred = new $.Deferred;
						working = true;
						deferred.done(function() {
							form.find('button').removeAttr('disabled');
							form.find('input[type=file]').ace_file_input('enable');
							form.find('.modal-body > :last-child').remove();
							
							modal.modal("hide");
			
							var thumb = file.next().find('img').data('thumb');
							if(thumb) $('#avatar2').get(0).src = thumb;
			
							working = false;
						});
						
						
						setTimeout(function(){
							deferred.resolve();
						} , parseInt(Math.random() * 800 + 800));
			
						return false;
					});
							
				});
			
				
			
				//////////////////////////////
				$('#profile-feed-1').slimScroll({
				height: '250px',
				alwaysVisible : true
				});
			
				$('.profile-social-links > a').tooltip();
			
				$('.easy-pie-chart.percentage').each(function(){
				var barColor = $(this).data('color') || '#555';
				var trackColor = '#E2E2E2';
				var size = parseInt($(this).data('size')) || 72;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size/10),
					animate:false,
					size: size
				}).css('color', barColor);
				});
			  
				///////////////////////////////////////////
			
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter', function(){
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');
			
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $this.offset();
					var w2 = $this.width();
			
					var place = 'left';
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';
					
					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function() {
					return false;
				});
			
			
				///////////////////////////////////////////
				$('#user-profile-3').find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'icon-picture',
					thumbnail:'large',
					droppable:true,
					before_change: function(files, dropped) {
						var file = files[0];
						if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
							if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
						}
						else {//file is a File object
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
									|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
								) return false;
			
							if( file.size > 110000 ) {
								return false;
							}
						}
			
						return true;
					}
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})
				

				$('#txt_archivo').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'icon-picture',
					thumbnail:'large',
					droppable:true,
					before_change: function(files, dropped) {
						var file = files[0];
						if(typeof file === "string") {//files is just a file name here (in browsers that don't support FileReader API)
							if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
						}
						else {//file is a File object
							var type = $.trim(file.type);
							if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
									|| ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android default browser!
								) return false;
			
							
						}
			
						return true;
					}
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})


			});
</script>