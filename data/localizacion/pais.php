<?php 
if(!isset($_SESSION))
{
	session_start();		
}
require('../../admin/class.php');
$class=new constante();
//obtencion d campos usuario y password
if (isset($_POST['pais'])) {
	$resultado = $class->consulta("SELECT ID, NOM_PAIS FROM LOCALIZACION.PAIS WHERE STADO='1'");		
		print'<option ></option>';	
		while($row = $class->fetch_array($resultado)){			
			print'<option value="'.$row[0].'" onclick="msm_cod();">'.$row[1].'</option>';		
		}
		
}
if (isset($_POST['pro'])) {
	$pais=$_POST['registro'];
	$resultado = $class->consulta("SELECT PRO.ID, PRO.NOM_PROVINCIA FROM LOCALIZACION.PAIS P, LOCALIZACION.PROVINCIA PRO WHERE P.ID=PRO.ID_PAIS AND P.ID='$pais' AND PRO.STADO='1'");	
	print'<option ></option>';
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			print'<option value="'.$row[0].'">'.$row[1].'</option>';
	}
}
if (isset($_POST['c'])) {
	$pro=$_POST['registro'];
	$resultado = $class->consulta("SELECT C.ID, C.NOM_CIUDAD FROM LOCALIZACION.PROVINCIA PRO, LOCALIZACION.CIUDAD C WHERE PRO.ID=C.ID_PROVINCIA AND PRO.ID='$pro' AND C.STADO='1'");	
	print'<option ></option>';
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			print'<option value="'.$row[0].'">'.$row[1].'</option>';
	}
}
if (isset($_POST['nom_pais'])) {
	$id=$_POST['registro'];
	$resultado = $class->consulta("SELECT NOM_PAIS FROM LOCALIZACION.PAIS WHERE STADO='1' AND ID='$id'");	
	
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			print$row[0];
	}
}
if (isset($_POST['nom_pro'])) {
	$id=$_POST['registro'];
	$resultado = $class->consulta("SELECT NOM_PROVINCIA FROM LOCALIZACION.PROVINCIA WHERE STADO='1' AND ID='$id'");	
	
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			print$row[0];
	}
}
if (isset($_POST['nom_ciu'])) {
	$id=$_POST['registro'];
	$resultado = $class->consulta("SELECT NOM_CIUDAD FROM LOCALIZACION.CIUDAD WHERE STADO='1' AND ID='$id'");	
	
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			print$row[0];
	}
}
if (isset($_POST['guardar_perfil'])) {
	//$id=$_POST['registro'];
	$acu=$class->hora();
	print $acu=$_POST['txt_2'].' '.$acu;
	//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
	$resultado=$class->consulta("UPDATE SEG.USUARIO SET EDAD='$acu', ID_CIUDAD='$_POST[txt_4]',DIRECCION='$_POST[txt_3]',FONO='$_POST[txt_1]' WHERE ID='$_SESSION[id]'");
	if (!$resultado) {
		print 0;
	}else print 1;
}


?>
