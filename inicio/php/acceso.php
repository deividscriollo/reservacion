<?php
if(!isset($_SESSION))
{
	session_start();		
}

require('../../admin/class.php');
$class=new constante();
//obtencion d campos usuario y password
$usu=$_POST['txt_1'];
$pass=$_POST['txt_2'];

$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE USUARIO='$usu' and pass='$pass'");
//md5('$pass' || 'SALT2 %&/323* *')
	
	$existencia=0;
	while ($row=$class->fetch_array($resultado)) {
		$existencia=1;
			print'salio'.$row[1];
			//Dando valor a variables de session
			print $_SESSION['nom'] = $row[1].' '.$row[2];
			print $_SESSION['usu'] = $row[4];
			print $_SESSION['pass'] = $row[5];
	}


//print($existencia);

?>