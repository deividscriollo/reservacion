<?php
if(!isset($_SESSION))
	{
		session_start();
	}
	if(!isset($_SESSION["pass"])) {

		header('Location: ../inicio');
	}
	require('../../admin/class.php');
	$class=new constante();
	$acu=0;
	$id=$class->idz();
	if (isset($_GET['id'])) {

	}else{
		header('Location: ../inicio/');
	}
	$resultado=$class->consulta("SELECT * FROM CONFIRMACION C, RESERVACION R WHERE R.ID=C.ID_RESERVACION AND R.ID='".$_GET['id']."'");
	$identi=0;
	while ($row=$class->fetch_array($resultado)) {
	   $identi=1;
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
		<link rel="stylesheet" href="../assets/css/colorbox.css" />
		<!--page specific plugin styles-->

		<!--ace styles-->

		<link rel="stylesheet" href="../assets/css/fontdc.css" />

		<link rel="stylesheet" href="../assets/css/ace.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-responsive.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/animate.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="../assets/css/ace-ie.min.css" />
		<![endif]-->

		<!--inline styles related to this page-->
		<style type="text/css">
			.dc_spm{
				width: 100%;
				height: 300px;
				background: rgba(255,255,255,0.6);
				float: left;
			}
			.dc_spmx{
				width: 100%;
				height: 300px;
				background: rgba(255,255,255,0.9);
				float: left;
				padding-top: 6%;
				font-size: 16px;
			}
			.dc_btn{
				width: 0;
				height: 0;
				border-style: solid;
				border-width: 66px 100px 0 100px;
				border-color: #007bff transparent transparent transparent;
				display:block!important;
			}
			.dc_btn:hover{
				cursor: pointer;
			}
			.zoom{
				transition: 2.5s ease;
		 		-moz-transition: 2.5s ease; /* Firefox */
		 		-webkit-transition: 2.5s ease; /* Chrome - Safari */
		 		-o-transition: 2.5s ease; /* Opera */
			}
			.zoom:hover{
				transform : scale(1.2);
				-moz-transform : scale(1.2); /* Firefox */
				-webkit-transform : scale(1.2); /* Chrome - Safari */
				-o-transform : scale(1.2); /* Opera */
				-ms-transform : scale(1.2); /* IE9 */
			}
			.dctexto{
				padding-top: 50px;
				padding-left: 10%;
			}
			.dctexto h4{
				font-size: 80px!important;
			}
			.dcm{

				float: right;
				width: 40%;
			}
			.dcespacio{
				height: 200px;
			}
		</style>

	<body >
		<?php require('../inicio/menu.php'); menunav(); ?>

		<div class="main-container container-fluid">
			<a class="menu-toggler" id="menu-toggler" href="#">
				<span class="menu-text"></span>
			</a>
			<div class="main-contents" >
				<?php if ($identi==0) { ?>
				<div class="page-content" style="background: rgba(25,25,25,0.1);!important;">
					<div class="row-fluid">
						<div class="span6">
							<div class="row"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></div>
							<div class="dc_spm">
								<div class="row-fluid">
									<div class="dctexto zoom">
										<h4 class="animated bounceInDown">Hola, </h4>
									</div>
									<div class="dctexto zoom">
										<h4 class="animated bounceInUp"><?php $m=split(' ', $_SESSION['nom']); print $m[0];?></h4>
									</div>
								</div>
							</div>
						</div>
						<div class="span6">
							<div class="widget-box animated bounceInDown">
								<div class="widget-header">
									<h4>Detalle Factura / Realizar Pago</h4>
								</div>

								<div class="widget-body" style="background: rgba(255,255,255,0.9);!important;">
									<div class="widget-main">
										<?php
											$id_reservacion=0;
											$resultado=$class->consulta("SELECT DIA, R.ID FROM RESERVACION_HORARIOS H, RESERVACION R WHERE R.ID=H.ID_RESERVACION AND H.ID_RESERVACION='".$_GET['id']."' AND H.STADO='0'");
											while ($row=$class->fetch_array($resultado)) {
											    $dia = $row[0];
											    $id_reservacion=$row[1];
											}
										?>

										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>Día de Reservación</th>
													<th>Categorias</th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="btn-app btn-primary no-radius center no-radius"><?php if (isset($dia)) {
														print$dia;
													} ?></td>
													<td>
														<table class="table table-striped table-bordered table-hover">
															<thead>
																<tr>
																	<td>Tarifa</td>
																	<td>Precio</td>
																	<td>Cantidad</td>
																	<td>Total</td>
																</tr>
															</thead>
															<tbody>
																<?php
																$valor="";
																$impuesto=0;
																$nombre="";
																$resultado=$class->consulta("SELECT RT.TOTAL, CASE WHEN IMPUESTO='SI' THEN  (PORCENTAJE)::int ELSE 0  END FROM RESERVACION R, SERVICIOS S , RESERVACION_TARIFA RT WHERE R.ID=RT.ID_RESERVACION AND R.ID_SERVICIO=S.ID AND  R.STADO='PETICION_RESERVA' AND R.ID='".$_GET['id']."'");
																while ($row=$class->fetch_array($resultado)) {
																	$impuesto= $row[1];
																    $nombre =$nombre+$row[0];
																}
																$imp=0;
																if ($impuesto!=0) {
																	$imp=($nombre * $impuesto)/100;
																}
																$nombre=$imp+$nombre;
															?>
																<?php
																	$resultado=$class->consulta("SELECT NOM_TARIFA,TA.PRECIO,T.CANTIDAD,round((T.CANTIDAD*TA.PRECIO), 2),CASE WHEN IMPUESTO='SI' THEN  (PORCENTAJE)::int ELSE 0  END AS IMPUESTO
																				FROM RESERVACION R, SERVICIOS S, RESERVACION_TARIFA T, TARIFA TA
																				WHERE R.ID_SERVICIO=S.ID AND T.ID_TARIFA=TA.ID AND T.ID_RESERVACION=R.ID AND T.CANTIDAD!=0 AND ID_RESERVACION='".$_GET['id']."' AND T.STADO='0'");
																	while ($row=$class->fetch_array($resultado)) {
																	    //valores a consumir
																	    $t=$row[3];
																	    print'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td></tr>';
																	}
																?>
															</tbody>
														</table>
													</td>
													<td class="btn-app btn-primary no-radius center"><?php print$nombre; ?></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="widget-main">
										<form class="form-horizontal" id="form-comprobante">
											<div class="row-fluid">
												<div class="span8">
													<div class="control-group">
														<label class="control-label" for="email">Valor a Pagar:</label>

														<div class="controls">
															<div class="span12">
																<input type="text" class="hide" id="txt_id_reservacion" value="<?php print $id_reservacion; ?>" >
																<input type="text" name="txt_valor_pagar" id="txt_valor_pagar" class="center" value="<?php print($nombre); ?>" readonly>
															</div>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="email">Seleccione Tarjeta:</label>
														<div class="controls">
															<div class="span12">
																<select id="sel_tarjeta" name="sel_tarjeta">
																	<option value="">Seleccione Tarjeta</option>
																	<option value="VISA">VISA</option>
																	<option value="MASTERCARD">MASTERCARD</option>
																	<option value="DISCOVER">DISCOVER</option>
																	<option value="DINERS CLUB">DINERS CLUB</option>
																	<option value="BANKCARD">BANKCARD</option>
																	<option value="JCB CARD">JCB CARD</option>
																	<option value="AMEX CARD">AMEX CARD</option>
																</select>
															</div>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="email">Num Tarjeta de crédito:</label>
														<div class="controls">
															<div class="span12">
																<input type="number" name="txt_num_deposito" id="txt_num_deposito" placeholder="Digíte num. comprobante">
															</div>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label" for="email">Valor de Deposito:</label>
														<div class="controls">
															<div class="span4">
																<input type="number" class="span12" name="txt_val_deposito" id="txt_val_deposito" value="<?php print($nombre); ?>" readonly >
															</div>
														</div>
													</div>
												</div>
												<div class="span4 center">
													<button type="submit" class="btn btn-app btn-success no-radius" data-last="Finish ">
														<i class=" icon-usd"></i> Enviar
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<?php } else{ ?> ?>
				<div class="page-content" style="background: rgba(25,25,25,0.1);!important;">
					<div class="row-fluid">
						<div class="span12 dc_spmx">
							<div class="center">
								<h1 class="green">Felicidades!</h1>
								La información ya fue almacenada con éxito.!
								<a href="../inicio">REGRESAR A INICIO</a>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div><!--/.main-content-->
		</div><!--/.main-container-->
		<!-- ventana emergente horario -->
		<!--PAGE CONTENT ENDS-->
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
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/fuelux/fuelux.spinner.min.js"></script>
		<script src="../assets/js/blockui.js"></script>
		<script src="../assets/js/jquery.slimscroll.min.js"></script>
		<script src="../assets/js/jquery.colorbox-min.js"></script>
		<script src="../assets/vegas/jquery.vegas.js"></script>
		



		<!--personal scripts-->
		<script type="text/javascript" src="index.js"></script>
		<!--ace scripts-->

		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>	
		<!--inline scripts related to this page-->
	</body>	
</html>


<script type="text/javascript">
	$.vegas('slideshow', {
  backgrounds:[
    { src:'../assets/images/gallery/dc1.jpg', fade:1000 },
    { src:'../assets/images/gallery/dc2.jpg', fade:1000 },
    { src:'../assets/images/gallery/dc3.jpg', fade:1000 }
  ]
})('overlay', {
  src:'../assets/vegas/overlays/11.png'
});

</script>
