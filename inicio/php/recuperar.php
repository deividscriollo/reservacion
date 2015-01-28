<?php
require('../../admin/class.php');
$class=new constante();
$acu=0;
$id=$class->idz();
$valor="";
$nombre="";
$resultado=$class->consulta("SELECT * FROM SEG.USUARIO WHERE CORREO='".$_POST['txt_1']."'");
while ($row=$class->fetch_array($resultado)) {
                       
    //valores a consumir                      
    $valor = $row[0];
    $nombre =$row[2];
    
}

//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
$resultado=$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
                                                    "','SELECT','".
                                                    $valor.
                                                    "','SEG.USUARIO','PASSWORD','".$valor."','".
                                                    $class->fecha_hora().
                                                    "','RECUPERAR CONTRASEÑA')");
if (!$resultado) 
	$acu=1;
else 
	$acu=0;


if($acu==0){
require 'mail.php';
print 'salio esto:'.envio_correoReiniciarpass($_POST['txt_1'],$nombre,$valor);
}
?>

