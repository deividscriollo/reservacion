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
										lower(' <select class=span12 id=select_cost onchange= s_privilegio(event)>
														<option value=admin>admin</option>
														<option value=cliente>cliente</option>
														<option value=administrador>administrador</option>
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
	$valor=strtoupper($_POST['valor']);
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
// guardar datos en segmento
if (isset($_POST['guardar_segmento'])) {
	$id=$class->idz();
	$fecha=$class->fecha_hora();
	$acu=$class->consulta("	INSERT INTO SEG.SEGMENTO VALUES('$id','$_POST[txt_1]','$fecha','1')");
	if (!$acu) {
		print '1';
	}else{
		print '0';
	}

}
// verifica existencia de segmento
if (isset($_POST['existencia_seg'])) {
	$valor=strtoupper($_POST['reg']);
	$resultado = $class->consulta("SELECT * FROM SEG.SEGMENTO WHERE NOM_SEGMENTO='$valor' AND STADO='1'");
	$id=0;
	while ($row=$class->fetch_array($resultado)) {
		$id=1;
	}
	print $id;
}
// muestra los segmentos existentes
if (isset($_POST['mostrar_seg'])) {	
	$resultado = $class->consulta("SELECT * FROM SEG.SEGMENTO WHERE  STADO='1'");
	$id=0; $acu=1;$color1='header-color-red';$color2='header-color-blue2';$color3='header-color-green';
	while ($row=$class->fetch_array($resultado)) {
		if ($acu==1||$acu==4) {
			print'<div class="row-fluid">';
		};
		print'<div class="widget-box span4" id="contenedor_'.$acu.'">
				<div class="widget-header ';
				if ($acu==1||$acu==4) {
					print$color1;
				};
				if ($acu==2||$acu==5) {
					print$color2;
				};
				if ($acu==3||$acu==6) {
					print$color3;
				};print'">
					<h4 class="lighter smaller">'.$row[1].'</h4>
				</div>

				<div class="widget-body">
					<div class="widget-main padding-8">
						<div id="tree'.$acu.'" class="tree"></div>
					</div>
				</div>
			</div>';
		if ($acu==3||$acu==7) {
			print'</div>';
		};
		$acu++;
	}
	if ($acu>=3&&$acu<=7) {
		print'</div>';
	}
	
}

?>

