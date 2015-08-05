<?php
if(!isset($_SESSION))
	{
		session_start();
	}

require('../../admin/class.php');
require('../../inicio/php/mail.php');
$class=new constante();

// mostrando cliente en la tabla
if (isset($_POST['mostrar_clientes'])) {
  $resultado = $class->consulta("SELECT CEDULA, NOMBRE, CORREO, EXTRACT(DAY FROM age(now(),EDAD)), lower('<label><input type=checkbox /><span class=lbl></span></label>') FROM seg.usuario U, seg.nivel n WHERE N.ID_USUARIO=U.ID AND N.NIVEL='CLIENTE' AND U.STADO='1'");
  $data;
  while ($row=$class->fetch_array($resultado)) {
    $data[]= $row[0];
    $data[]= $row[1];
    $data[]= $row[2];
    $data[]= $row[3];
    $data[]= $row[4];
  }
  echo json_encode($data);
}

if (isset($_POST['envio_mensajes'])) {
  print envio_correomasivo($_POST['correo'], $_POST['nombre'], $_POST['mensaje']);
}

?>