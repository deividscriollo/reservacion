<?php
// Inicializar la sesión.
// Si está usando session_name("algo"), ¡no lo olvide ahora!
require('../../admin/class.php');
$class=new constante();
session_start();
$id=$_SESSION['id'];

//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
														"','SALIR','".
														$id.
														"','SEG.USUARIO','TODOS','".$id."','".
														$class->fecha_hora().
														"','CERRAR SESSION')");

// Finalmente, destruir la sesión.
session_destroy();
header('Location: ../../');
?>