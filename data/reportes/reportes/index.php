<!DOCTYPE html>
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
		$(document).ready(function() {
            var options = {
                chart: {
                    renderTo: 'container_amd',
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Servicios Mas reservados'
                },
                tooltip: {
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                    }
                },
                plotOptions: {
                	pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false,
							formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                            }
						},
						showInLegend: true
					}
                },
                series: [{
                    type: 'pie',
                    name: 'Browser share',
                    data: []
                }]
            }            
            $.getJSON("../reportes.php", {servicio_reservado:'ok'} , function(json) {
                options.series[0].data = json;
                chart = new Highcharts.Chart(options);
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
