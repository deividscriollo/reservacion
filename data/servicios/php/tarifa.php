<?php
require('../../../admin/class.php');
$class=new constante();
//guardando tarifa
if (isset($_POST['guardar'])) {
	$id=$class->idz();
	$fecha=$class->fecha_hora();

	$acu=$class->consulta("INSERT INTO TARIFA VALUES('".$id."','$_POST[id]','$_POST[tarifa]',
	 															'$_POST[precio]',
	 															'$fecha','1')");
	if(!$acu)
	{
		print('1');
	}
	else{
		print('0');
	}
}
// guardando horario
if (isset($_POST['g_horario'])) {
	$id=$class->idz();
	$fecha=$class->fecha_hora();

	$acu=$class->consulta("INSERT INTO horario_servicios VALUES('".$id."','$_POST[id_servicio]','$_POST[dias]',
	 															'$_POST[horai]',
	 															'$_POST[horaf]',
	 															'$fecha','1')");
	if(!$acu)
	{
		print('1');
	}
	else{
		print('0');
	}
}
if (isset($_POST['mostrar'])) {

	$resultado = $class->consulta("SELECT * FROM TARIFA WHERE ID_SERVICIO='$_POST[id]' AND STADO='1'");
	$id=1;
	while ($row=$class->fetch_array($resultado)) {
		print'<tr><td>'.$id++.'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.
		'<div class="hidden-phone visible-desktop action-buttons" >						
							<a onclick=t_eliminar("'.$row[0].'")>
							<i class="icon-trash bigger-130 blue pointer"></i>
							</a>
					</div>'.'</td></tr>';
	}
}
if (isset($_POST['eliminar'])) {
	print $class->consulta("UPDATE TARIFA SET STADO='0' WHERE ID='$_POST[id]'");	
}
// mostrar imprecion de tabla de horario para  cada servicio
if (isset($_POST['mostrar_horario'])) {
	$resultado = $class->consulta("SELECT * FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO='1'");
	$id=1;
	while ($row=$class->fetch_array($resultado)) {
		print'<tr><td>'.$id++.'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.
		'<div class="hidden-phone visible-desktop action-buttons" >						
							<a onclick=h_eliminar("'.$row[0].'")>
							<i class="icon-trash bigger-130 blue pointer"></i>
							</a>
					</div>'.'</td></tr>';
	}
}
if (isset($_POST['h_eliminar'])) {
	print $class->consulta("UPDATE HORARIO_SERVICIOS SET STADO='0' WHERE ID='$_POST[id]'");	
}
?>
