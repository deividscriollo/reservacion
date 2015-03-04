<?php
require('../../admin/class.php');
$class=new constante();
$acu=0;
$id=$class->idz();

//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
$r=$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
                                                    "','INSERT','".
                                                    $id.
                                                    "','SEG.USUARIO','TODOS','".$id."','".
                                                    $class->fecha_hora().
                                                    "','REGISTRO CUENTA USUARIO')");

if (!$r) 
	$acu=1;
else 
	$acu=0;
  
//envio de correo
if($acu==0){
require 'mail.php';
  $sum=envio_correoNuevousuario($_POST['txt_2'],$_POST['txt_1'],$id);  
    if ($sum==1){

      //Envio valido guardado en la baSE DE DATOS
      $resultado = $class->consulta("INSERT INTO SEG.USUARIO VALUES('".$id
                                                                    ."','".$_POST['txt_0'].
                                                                    "','".$_POST['txt_1'].
                                                                    "','".'0900000000'.
                                                                    "','".$class->fecha_hora().
                                                                    "','".$_POST['txt_2'].
                                                                    "',md5('".$_POST['txt_3'].
                                                                    "'),'".''.
                                                                    "','".'1'.
                                                                    "','".$class->fecha_hora().
                                                                    "','".'0'.
                                                                    "')");
      $resultado = $class->consulta("INSERT INTO SEG.NIVEL VALUES('".$class->idz()
                                                                    ."','".$id.
                                                                    "','".'Cliente'.                                                                    
                                                                    "','".$class->fecha_hora().
                                                                    "','".'1'.
                                                                    "')");
      if (!$resultado) 
        print('0');
      else 
        print('1');
      
    }else{
     print'0';
   }

}else{
	print('2');
}
?>

