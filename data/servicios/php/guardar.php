<?php
require('../../../admin/class.php');
$class=new constante();
$cont=$class->idz();
$extension = explode(".", $_FILES["txt_archivo"]["name"]);
$porcentaje='';
if ($_POST['txt_iva']=='si') {
	$porcentaje=$_POST['txt_porcentaje'];
}else{
	$porcentaje=0;	
}

$extension = end($extension);
$fecha=$class->fecha_hora();
$nombre = basename($_FILES["txt_archivo"]["name"], "." . $extension);
$foto = $cont. '.' . $extension;
move_uploaded_file($_FILES["txt_archivo"]["tmp_name"], "../img/" . $foto);
$acu=$class->consulta("INSERT INTO servicios VALUES('".$cont."','$_POST[txt_servicio]',
 															'$_POST[txt_descripcion]',
 															'$foto',
 															'$fecha',
 															'$_POST[txt_otros]',
 															'$_POST[txt_iva]',
 															'$porcentaje',
 															'$_POST[txt_capacidad]','1',
 															'1'
 															)");
if(!$acu)
{
	print('1');
}
else{
	print('0');
}
?>
