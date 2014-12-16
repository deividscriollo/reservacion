<?php 
require('../../../admin/class.php');
	$class=new constante();
$resultado = $class->consulta("SELECT * FROM SERVICIOS WHERE STADO='1'");
	$stado=0; $nom=""; $correo="";
	$id="";
	while ($row=$class->fetch_array($resultado)) {			
			
		
?>
<div class="itemdiv memberdiv">
	<div class="inline position-relative">
		<div class="user">
			<a data-toggle="tab" href="#home">
				<img src="img/<?php print($row[4]); ?>" alt="<?php print($row[1]); ?>" onclick="guardar_id('<?php print($row[0]); ?>')" />
			</a>
		</div>

		<div class="body">
			<div class="name">
					<span class="user-status status-online"></span>
					<?php print($row[1]); ?>
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
<?php } ?>