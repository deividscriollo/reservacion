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
	</div>
</div>
<?php } ?>