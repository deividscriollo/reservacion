<!DOCTYPE html>
<html>
	<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../../assets/css/jquery-ui-1.10.3.custom.min.css" />
        <link rel="stylesheet" href="../../assets/css/chosen.css" />
        <link rel="stylesheet" href="../../assets/css/datepicker.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="../../assets/css/daterangepicker.css" />
        <link rel="stylesheet" href="../../assets/css/colorpicker.css" />
        <link rel="stylesheet" href="../../assets/css/ace.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
        <script src="../../assets/js/fuelux/fuelux.spinner.min.js"></script>
        <script src="../../assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="../../assets/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="../../assets/js/date-time/moment.min.js"></script>
        <script src="../../assets/js/date-time/daterangepicker.min.js"></script>
        <script src="../../assets/js/bootstrap-colorpicker.min.js"></script>
        <script src="../../assets/js/jquery.knob.min.js"></script>
        <script src="../../assets/js/jquery.autosize-min.js"></script>
        <script src="../../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="../../assets/js/jquery.maskedinput.min.js"></script>
        <script src="../../assets/js/bootstrap-tag.min.js"></script>

        <!--ace scripts-->

        <script src="../../assets/js/ace-elements.min.js"></script>
        <script src="../../assets/js/ace.min.js"></script>




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
                    text: 'Reservacion pór fechas'
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
    <div class="space-4"></div>
    <center>
        <div class="row-fluid">
            <div class="span12">
                <form class="form-horizontal">
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label class="control-label" for="form-field-1">Seleccione rango de fecha</label>
                                <div class="controls">
                                    <div class="row-fluid input-prepend">
                                        <span class="add-on">
                                            <i class="icon-calendar"></i>
                                        </span>

                                        <input class="span10" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="span6">
                            <button class="btn btn-info" type="button">
                                <i class="icon-ok bigger-110"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </center>


	<div id="container_amd" style="width: 800px; height: 400px; margin: 0 auto">

	</div>


</body>
</html>
