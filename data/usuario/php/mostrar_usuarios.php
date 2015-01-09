<?php 
require('../../../admin/class.php');
$class=new constante();

if (isset($_POST['mostrar_mensajes'])) {	
	$resultado = $class->consulta("SELECT 
									CEDULA, NOMBRE, CORREO,extract(day from age(now(),edad)),NIVEL,
										lower('<label><input type=checkbox /><span class=lbl></span></label>')		
									FROM SEG.USUARIO U, SEG.NIVEL N WHERE N.ID_USUARIO=U.ID");
	$data = array();	
	while ($row=$class->fetch_array($resultado)) {				
		$output['data'][]= $row;
 	} 	 	
 	echo json_encode($output); 		
}
if (isset($_POST['mostrar'])) {	
	$resultado = $class->consulta("SELECT 
									CEDULA, NOMBRE, FONO, CORREO,extract(day from age(now(),edad)),U.FECHA,NIVEL,
									CASE 
										WHEN U.stado='1' 
										THEN 'ACTIVOS' 
										ELSE 'NO ACTIVO' 
									END
									FROM SEG.USUARIO U, SEG.NIVEL N WHERE N.ID_USUARIO=U.ID");
	$data = array();	
	while ($row=$class->fetch_array($resultado)) {				
		$output['data'][]= $row;
 	} 	 	
 	echo json_encode($output); 		
}
if (isset($_POST['privilegios'])) {
	$string ='hola mundo';
	$resultado = $class->consulta("SELECT 
									U.CEDULA, NOMBRE, FONO, CORREO,extract(year from age(now(),edad)),U.FECHA, 
										CASE 
											WHEN U.stado='1' 
											THEN 'ACTIVOS' 
											ELSE 'NO ACTIVO' 
										END,
										NIVEL,
										lower(' <select class=span12 onchange= s_privilegio(event)>
														<option ></option>
														<option value=ADMIN>Admin</option>
														<option value=ADMINISTRADOR>Administrador</option>
														<option value=CLIENTE>Usuario-Cliente</option>
													</select>')										
									FROM SEG.USUARIO U, SEG.NIVEL N WHERE N.ID_USUARIO=U.ID AND U.STADO=1 ");
	$data = array();	
	while ($row=$class->fetch_array($resultado)) {				
		$output['data'][]= $row;
 	} 	 	
 	echo json_encode($output); 		
}
//indicadores en proceso de modificacion
if (isset($_POST['modificar'])) {
	$cedula=$_POST['ced'];
	$valor=$_POST['valor'];
	$cont=$class->idz();
	$acu=$class->consulta("	UPDATE seg.nivel
						   	SET NIVEL='$valor' 
							WHERE ID_USUARIO=(SELECT ID FROM SEG.USUARIO U WHERE U.CEDULA='$cedula')");
	if (!$acu) {
		print '0';
	}else{
		print '0';
	}

}

?>

