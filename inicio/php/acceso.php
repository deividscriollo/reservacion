<?php
if(!isset($_SESSION))
{
	session_start();		
}

require('../../admin/class.php');
$class=new constante();
if (isset($_POST['validar_acceso'])) {
//obtencion d campos usuario y password
$usu=$_POST['u'];
$pass=$_POST['p'];
$existencia=0;

$resultado = $class->consulta("SELECT * FROM SEG.USUARIO U, SEG.NIVEL N WHERE correo='$usu' and pass=md5('$pass') AND U.ID=N.ID_USUARIO AND U.stado='1'");	
	while ($row=$class->fetch_array($resultado)) {
		$existencia=1;			
		//Dando valor a variables de session
		$_SESSION['id'] = $row[0];
		$_SESSION['nom'] = $row[2];
		$_SESSION['usu'] = $row[5];
		$_SESSION['pass'] = $row[6];
		$_SESSION['nivel'] = $row['nivel'];
	}
	$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE correo='$usu' and pass=md5('$pass') and stado='0'");
	//md5('$pass' || 'SALT2 %&/323* *')	
	while ($row=$class->fetch_array($resultado)) {
		$existencia=2;						
	}
	print($existencia);
	}
if (isset($_POST['servicios'])) {
	print'<option value>Seleccione Servicio</option>';
	$resultado = $class->consulta("SELECT * FROM SEG.CATEGORIA_SERVICIO WHERE STADO='1'");	
	while ($row=$class->fetch_array($resultado)) {
		print'<option value="'.$row[0].'">'.$row[1].'</option>';
	}
}

?>
