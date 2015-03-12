<?php
require('../../admin/class.php');
$class=new constante();

if (isset($_POST['existencia_correo'])) {
	$reg=$_POST['reg'];
	$reg=strtolower($reg);
	$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE CORREO='$reg'");
	$row= pg_num_rows($resultado);
	$existencia=0;
	for ($i=0;$i<$row;$i++){
			$existencia=1;
		}
	print($existencia);
}
if (isset($_POST['existencia_cedula'])) {
	$reg=$_POST['reg'];
	$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE CEDULA='$reg'");
	$row= pg_num_rows($resultado);
	$existencia=0;
	for ($i=0;$i<$row;$i++){
			$existencia=1;
		}
	print($existencia);	
}
?>