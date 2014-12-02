<?php
if(!isset($_SESSION))
	{
		session_start();
	}
//Clase 
require('admin/class.php');
$class=new constante();
//variables Auditoria

$id=$class->idx('auditoria.inicio');
$idunico=md5(uniqid(rand(), true));
$query=$class->consulta("INSERT INTO AUDITORIA.INICIO VALUES('".$id
																."','".$idunico
																."','".$class->fecha()
																."','".date("H:i:s")
																."','".$_SERVER['REMOTE_ADDR']																
																."','".$class->client_ip()
																."')");
if(!$query){
	print'Precentamos Inconvenietes... le sugerimos recargar la pagina o intentarlo mas tarde';
}else{
	print('Iniciando');
}
?>