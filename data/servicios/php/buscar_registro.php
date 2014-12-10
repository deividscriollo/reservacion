<?php
require('../../../admin/class.php');
$class=new constante();

$reg=$_POST['reg'];
$reg=strtoupper($reg);


$resultado = $class->consulta("SELECT * FROM SERVICIOS WHERE NOM='$reg'");
$existencia=0;
	while ($row=$class->fetch_array($resultado)) {			
			$existencia=1;
	}	
print($existencia);
?>