<?php 
if(!isset($_SESSION))
	{
		session_start();
	}
	require('../../../admin/class.php');

	if (isset($_POST['cambiar_id'])) {
		$_SESSION["id_servicio"]=$_POST['id_servicio'];
	}
	if (isset($_POST['sacar_id']) {
		print$_SESSION["id_servicio"];	
	}
?>