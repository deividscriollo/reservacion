<?php 
if(!isset($_SESSION))
	{
		session_start();		
	}
require('../../admin/class.php');
$class=new constante();	
$nombre='';
if (isset($_POST['name'])) {
	$nombre=$_POST['name'];
}
if ($nombre=='txt_fna') {
	$acu=$class->consulta("UPDATE SEG.USUARIO   SET EDAD='$_POST[value]' WHERE ID='$_SESSION[id]'");
}
if (isset($_POST['verificar_edad'])) {
	$resultado=$class->consulta("SELECT extract(year from age(now(),edad)) FROM SEG.USUARIO WHERE ID='$_SESSION[id]'");
	while ($row=$class->fetch_array($resultado)) {
		print$row[0];
	}
}
?>