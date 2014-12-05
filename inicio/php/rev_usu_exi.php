<?php
require('../../admin/class.php');
$class=new constante();

$reg=$_POST['reg'];
$reg=strtolower($reg);


$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE CORREO='$reg'");

	$row= pg_num_rows($resultado);
	//$row= pg_num_rows($resultado);
	$existencia=0;
	for ($i=0;$i<$row;$i++){
			$existencia=1;
		}
print($existencia);
?>