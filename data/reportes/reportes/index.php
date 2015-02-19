<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	   <title>Estadisticas con Jquery | Jquery Easy</title>
		<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="js/highcharts.js"></script>
		<!-- Este archivo es para darle un estilo (Este archivo es Opcional) -->
	    <script type="text/javascript" src="js/themes/grid.js"></script>
		<!-- Este archivo es para poder exportar losd atos que obtengamos -->
		<script type="text/javascript" src="js/modules/exporting.js"></script>
	
		<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container_amd',
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Servicios más reservados'
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
				    series: [{
						type: 'pie',
						name: 'SERVICIOS FABRICA IMBABURA',
						data: [
							{
								name:'MUSEO',
								y:45.0,
								sliced: true,
								selected: true
							},
							['CENTRO DE CONVENCIONES “LOS ARRIEROS”',       26.8],							
							['RESTAURANTE “LAS POSADAS”',    8.5],
							['TEATRO AUDITORIO “CLUB L.I.A.”',     6.2]							
						]
					}]
				});
			});
				
		</script>
		
	</head>
<body>


	
	
	
	<center><img src="../b_reportes.fw.png"></center>
	<div id="container_amd" style="width: 800px; height: 400px; margin: 0 auto">
		
	</div>
		
		
</body>
</html>
