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
		<link rel="stylesheet" href="../../assets/css/jquery.gritter.css" />

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
							<h3 class="header smaller lighter blue">Confirmaciones pendientes</h3>
							<div class="table-header">
								Resultado confirmaciones pendientes
							</div>
							<table id="tbt_mensajes" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<td width="10px"><i class="icon-list"></i></td>
										<td>Servicio</td>
										<td>F. Reservación</td>
										<td width="40px">Monto</td>
										<td>Banco</td>
										<td>Tipo</td>
										<td>Cuenta</td>
										<td width="40px">Deposito</td>
										<td>F. R. Deposito</td>
										<td width="30px">Accion</td>
									</tr>
								</thead>
								<tbody>
									
								</tbody>
							</table>
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
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../../assets/js/jquery.dataTables.bootstrap.js"></script>
		<script src="../assets/js/jquery.gritter.min.js"></script>
		<script src="../../assets/js/blockui.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!--inline scripts related to this page-->

		<script type="text/javascript">
		$(function(){
			var table=$('#tbt_mensajes').dataTable( {
				        language: {
						    "sProcessing":     "Procesando...",
						    "sLengthMenu":     "Mostrar _MENU_ registros",
						    "sZeroRecords":    "No se encontraron resultados",
						    "sEmptyTable":     "Ningún dato disponible en esta tabla",
						    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
						    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
						    "sInfoPostFix":    "",
						    "sSearch":         "Buscar: ",
						    "sUrl":            "",
						    "sInfoThousands":  ",",
						    "sLoadingRecords": "Cargando...",
						    "oPaginate": {
						        "sFirst":    "Primero",
						        "sLast":     "Último",
						        "sNext":     "Siguiente",
						        "sPrevious": "Anterior"
						    },
						    "oAria": {
						        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
						    }
						}
				    });
		llenar_tabla()
		});		
		function llenar_tabla(){

				$.ajax({
		 			url:'confirmacion.php',
		 			type:'POST',
		 			dataType: 'json',
		 			data:{mostrar_reservacion:'ok'},
		 			success:function(data){
		 				var a=1;
		 				for (var i = 0; i < data.length; i=i+9) {
		 					$('#tbt_mensajes').dataTable().fnAddData([
		 															a,
		 															data[i+0],
		 															data[i+1],
		 															data[i+2],
		 															data[i+3],
		 															data[i+4],
		 															data[i+5],
		 															data[i+6],
		 															data[i+7],
		 															data[i+8],
		 														]);
		 					a++;
		 				}	
		 			}

		 		});
			}
		 	function correo_envio(a,b,c){
				// console.log(a+b+c)
				$.ajax({
					url:'confirmacion.php',
		 			type:'POST',
		 			data:{confirmar_reservacion:'ok',id:a,correo:c,nombre:b},
		 			beforeSend: function () {
						$.blockUI({
							message:'<i id="icon-tiempo" class="width-10 icon-spinner red icon-spin bigger-125"></i> Espere un momento...',
							css: { 
					            border: 'none', 
					            padding: '15px', 
					            backgroundColor: '#000', 
					            '-webkit-border-radius': '10px', 
					            '-moz-border-radius': '10px', 
					            opacity: .5, 
					            color: '#fff'
					        }
					    })
					}, 
		 			success:function(data){
		 				$.unblockUI();
		 				if (data==0) {
		 					$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'Mensaje Enviado<br><i class="icon-ok green bigger-230"></i>   Satisfactoriamente al cliente : )',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: ''
							});
	                		
	                	};
	                	if (data==1) {
	                		$.gritter.add({						
								title: '..Mensaje..!',						
								text: 'Lo sentimos No pudimos enviar la confirmacion de la reservación.<br><i class="icon-lock red bigger-230"></i>',						
								//image: 'http://a0.twimg.com/profile_images/59268975/jquery_avatar_bigger.png',						
								sticky: false,						
								time: ''
							});
							redireccionar();
	                	}; 
		 			}
				});
				$('#tbt_mensajes').dataTable().fnClearTable();
				llenar_tabla()
			}
		</script>

	</body>
</html>
