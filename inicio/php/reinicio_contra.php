<?php 
	require('../../admin/class.php');
	$class=new constante();
	
	$res=$class->consulta("UPDATE SEG.USUARIO SET pass=md5('".$_POST['txt_2']."') WHERE correo='".$_POST['txt_1']."'");

	$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE correo='".$_POST['txt_1']."' and stado=1");
	$id="";
	while ($row=$class->fetch_array($resultado)) {		
		$id = $row[0];
	}
	//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
	$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
														"','UPDATE','".
														$id.
														"','SEG.USUARIO','PASSWORD','".$id."','".
														$class->fecha_hora().
														"','UPDATE CONTRASEÑA')");
	if (!$res) 
		print $acu=0;
	else 
		print $acu=1;
?>