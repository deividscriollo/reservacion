<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
		<meta charset="utf-8" />
		<title>FABRICA IMBABURA</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/png" href="../assets/empresa/logo/logo.png" />
	<body >

		<div class="main-container container-fluid">

		</div><!--/.main-container-->
		<!-- ventana emergente horario// -->
		<?php

		require('../../admin/class.php');
		$class=new constante();

		$res1=$class->consulta("SELECT S.NOM,TA.NOM_TARIFA,T.PRECIO,T.CANTIDAD
								FROM RESERVACION R, SERVICIOS S, RESERVACION_TARIFA T, TARIFA TA
								WHERE R.ID_SERVICIO=S.ID AND T.ID_RESERVACION=R.ID AND T.CANTIDAD!=0 AND T.ID_TARIFA=TA.ID AND R.ID='$_GET[id]'");
		$items='';
		$x=1;
		while ($row=$class->fetch_array($res1)) {
			$items=$items."&item_name_".$x.'='.$row[0].'-'.$row[1].
					"&item_number_".$x."=".$x.
					"&quantity_".$x."=".$row[3].
					"&amount_".$x."=".$row[2].
					"&on0_".$x."="."RESER.".
					"&os0_".$x."=FABRICA IMBABURA";
			$x++;
	 	}

		if(isset($_GET['id'])){
		?>
		<script type="text/javascript">
			var winpar = "scrollbars,location,resizable,status",
			strn  = "https://www.paypal.com/cgi-bin/webscr?cmd=_cart" +
		   			"&upload=1" +
		        	"&business=" + 'deividscriollo@gmail.com' +
					"&currency_code=USD",
			counter = 1,
			itemsString = <?php print "'".$items."'"; ?>;
			strn = strn + itemsString ;
			window.open (strn, "paypal", winpar);

		</script>
		<?php
		}
		?>
		<!-- modal tarifa -->
		<!-- modal reservacion  -->
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
