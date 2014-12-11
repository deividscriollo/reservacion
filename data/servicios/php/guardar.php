<?php
require('../../../admin/class.php');
$class=new constante();
$cont=$class->idz();
$extension = explode(".", $_FILES["txt_archivo"]["name"]);

$extension = end($extension);
$fecha=$class->fecha_hora();
$nombre = basename($_FILES["txt_archivo"]["name"], "." . $extension);
$foto = $cont. '.' . $extension;
move_uploaded_file($_FILES["txt_archivo"]["tmp_name"], "../img/" . $foto);
!$acu=$class->consulta("insert into servicios values('".$cont."','$_POST[txt_servicio]',
 															'$_POST[txt_descripcion]',
 															'$_POST[txt_otros]',
 															'$foto','$fecha',
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
