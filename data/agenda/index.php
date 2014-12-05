<?php
if(!isset($_SESSION))
	{
		session_start();		
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../../inicio');
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>FABRICA IMBABURA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../../assets/empresa/logo/logo.png" />

		<!--basic styles-->

		<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../../assets/css/font-awesome.min.css" />

		<link rel="stylesheet" href="../../assets/css/fontdc.css" />
		<link rel="stylesheet" href="../../assets/css/fullcalendar.css" />

		<link rel="stylesheet" href="../../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../../assets/css/ace-ie.min.css" />
		<![endif]-->

		<link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />




		<!--inline styles related to this page-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

	<body>
		<div class="navbar">
			<div class="red navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							<i class="icon-home"></i>
							Fabrica Imbabura
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="../../assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Bienvenido,</small>
									<?php print$_SESSION['nom'] ?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										Configurar
									</a>
								</li>

								<li>
									<a href="#">
										<i class="icon-user"></i>
										Perfil
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="../inicio/salir.php">
										<i class="icon-off"></i>
										Cerrar  Session
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>

			<?php require('../inicio/menu.php'); menu(); ?>

			<div class="main-content">
				<div class="page-content">
					<div class="row-fluid">
						<div class="span12">
							<!--PAGE CONTENT BEGINS-->

							<div class="row-fluid">
								<div class="span9">
									<div class="space"></div>

									<div id="calendar"></div>
								</div>

								<div class="span3">
									<div class="widget-box transparent">
										<div class="widget-header">
											<h4>Draggable events</h4>
										</div>

										<div class="widget-main">
											<div id="external-events">
												<div class="external-event label-grey" data-class="label-grey">
													<i class="icon-move"></i>
													My Event 1
												</div>

												<div class="external-event label-success" data-class="label-success">
													<i class="icon-move"></i>
													My Event 2
												</div>

												<div class="external-event label-important" data-class="label-important">
													<i class="icon-move"></i>
													My Event 3
												</div>

												<div class="external-event label-purple" data-class="label-purple">
													<i class="icon-move"></i>
													My Event 4
												</div>

												<div class="external-event label-yellow" data-class="label-yellow">
													<i class="icon-move"></i>
													My Event 5
												</div>

												<div class="external-event label-pink" data-class="label-pink">
													<i class="icon-move"></i>
													My Event 6
												</div>

												<div class="external-event label-info" data-class="label-info">
													<i class="icon-move"></i>
													My Event 7
												</div>

												<label>
													<input type="checkbox" class="ace-checkbox" id="drop-remove" />
													<span class="lbl"> Remove after drop</span>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!--PAGE CONTENT ENDS-->
						</div><!--/.span-->

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
			window.jQuery || document.write("<script src='../../assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!--<![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../../assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../assets/js/bootstrap.min.js"></script>

		<!--page specific plugin scripts-->

		<!--[if lte IE 8]>
		  <script src="../../assets/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="../../assets/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../../assets/js/jquery.easy-pie-chart.min.js"></script>
		<script src="../../assets/js/jquery.sparkline.min.js"></script>
		<script src="../../assets/js/flot/jquery.flot.min.js"></script>
		<script src="../../assets/js/flot/jquery.flot.pie.min.js"></script>
		<script src="../../assets/js/flot/jquery.flot.resize.min.js"></script>
		<script src="../assets/js/date-time/moment.min.js"></script>
		<script src="../assets/js/date-time/bootstrap-datepicker.min.js"></script>
		
		<script src="../../assets/js/fullcalendar.min.js"></script>

		

		<!--ace scripts-->

		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>
		<script src="../assets/js/lang-all.js"></script>

		<!--inline scripts related to this page-->
		<script type="text/javascript">
			$(function() {

			/* initialize the external events
				-----------------------------------------------------------------*/

				$('#external-events div.external-event').each(function() {

					// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
					// it doesn't need to have a start or end
					var eventObject = {
						title: $.trim($(this).text()) // use the element's text as the event title
					};

					// store the Event Object in the DOM element so we can get to it later
					$(this).data('eventObject', eventObject);

					// make the event draggable using jQuery UI
					$(this).draggable({
						zIndex: 999,
						revert: true,      // will cause the event to go back to its
						revertDuration: 0  //  original position after the drag
					});
					
				});




				/* initialize the calendar
				-----------------------------------------------------------------*/

				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();

				
				var calendar = $('#calendar').fullCalendar({
					lang: 'es',
					 buttonText: {
						prev: '<i class="icon-chevron-left"></i>',
						next: '<i class="icon-chevron-right"></i>'
					},
				
					header: {
						left: 'prev,next today',
						center: 'title',
						right: 'month,agendaWeek,agendaDay'
					},
					events: [
					{
						title: 'All Day Event',
						start: new Date(y, m, 1),
						className: 'label-important'
					},
					{
						title: 'Long Event',
						start: new Date(y, m, d-5),
						end: new Date(y, m, d-2),
						className: 'label-success'
					},
					{
						title: 'Some Event',
						start: new Date(y, m, d-3, 16, 0),
						allDay: false
					}]
					,
					editable: true,
					droppable: true, // this allows things to be dropped onto the calendar !!!
					drop: function(date, allDay) { // this function is called when something is dropped
					
						// retrieve the dropped element's stored Event Object
						var originalEventObject = $(this).data('eventObject');
						var $extraEventClass = $(this).attr('data-class');
						
						
						// we need to copy it, so that multiple events don't have a reference to the same object
						var copiedEventObject = $.extend({}, originalEventObject);
						
						// assign it the date that was reported
						copiedEventObject.start = date;
						copiedEventObject.allDay = allDay;
						if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
						
						// render the event on the calendar
						// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
						$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
						
						// is the "remove after drop" checkbox checked?
						if ($('#drop-remove').is(':checked')) {
							// if so, remove the element from the "Draggable Events" list
							$(this).remove();
						}
						
					}
					,
					selectable: true,
					selectHelper: true,
					select: function(start, end, allDay) {
						
						bootbox.prompt("titulo nueva reservacion:", function(title) {
							if (title !== null) {
								calendar.fullCalendar('renderEvent',
									{
										title: title,
										start: start,
										end: end,
										allDay: allDay
									},
									true // make the event "stick"
								);
							}
						});
						

						calendar.fullCalendar('unselect');
						
					}
					,
					eventClick: function(calEvent, jsEvent, view) {

						var form = $("<form class='form-inline'><label>Change event name &nbsp;</label></form>");
						form.append("<input autocomplete=off type=text value='" + calEvent.title + "' /> ");
						form.append("<button type='submit' class='btn btn-small btn-success'><i class='icon-ok'></i> Save</button>");
						
						var div = bootbox.dialog(form,
							[
							{
								"label" : "<i class='icon-trash'></i> Delete Event",
								"class" : "btn-small btn-danger",
								"callback": function() {
									calendar.fullCalendar('removeEvents' , function(ev){
										return (ev._id == calEvent._id);
									})
								}
							}
							,
							{
								"label" : "<i class='icon-remove'></i> Close",
								"class" : "btn-small"
							}
							]
							,
							{
								// prompts need a few extra options
								"onEscape": function(){div.modal("hide");}
							}
						);
						
						form.on('submit', function(){
							calEvent.title = form.find("input[type=text]").val();
							calendar.fullCalendar('updateEvent', calEvent);
							div.modal("hide");
							return false;
						});
						
					
						//console.log(calEvent.id);
						//console.log(jsEvent);
						//console.log(view);

						// change the border color just for fun
						//$(this).css('border-color', 'red');

					}
					
				});


			})
					</script>

		
	</body>
</html>
