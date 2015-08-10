<?php
require('../../../admin/class.php');
$class=new constante();
//guardando tarifa
if (isset($_POST['guardar'])) {
	$id=$class->idz();
	$fecha=$class->fecha_hora();

	$acu=$class->consulta("INSERT INTO TARIFA VALUES('".$id."','$_POST[id]','$_POST[cat]','$_POST[tarifa]',
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
// guardando valores en tabla categoria
if (isset($_POST['guardar_cat'])) {
	$id=$class->idz();
	$fecha=$class->fecha_hora();
	$valor=strtoupper($_POST['txt_1']);
	$acu=$class->consulta("INSERT INTO seg.categoria_servicio VALUES('".$id."',
																	'$valor',
		 															'$fecha','ACTIVO','1')");
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

	$acu=$class->consulta("INSERT INTO horario_servicios VALUES('".$id."','$_POST[id_servicio]',
																'$_POST[lapso]',		
																'$_POST[dias]',
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


if (isset($_POST['mostrar_tarifa'])) {

	$resultado = $class->consulta("SELECT * FROM TARIFA T, SEG.CATEGORIA_SERVICIO C WHERE C.ID=T.ID_CATEGORIA AND  ID_SERVICIO='$_POST[id]' AND T.STADO='1' ORDER BY C.NOM");
	$id=1;	
	while ($row=$class->fetch_array($resultado)) {
		$x=number_format($row[4],2);
		print'<tr><td>'.$id++.'</td><td class="text-success">'.$row[8].'</td><td class="text-info">'.$row[3].'</td><td class="text-error">'.$x.'</td><td>'.
		'<div class="hidden-phone visible-desktop action-buttons" >
							<a class="green" onclick=modificar_tarifa("'.$row[0].'")>
								<i class="icon-pencil bigger-130"></i>
							</a>						
							<a onclick=t_eliminar("'.$row[0].'")>
								<i class="icon-trash bigger-130 blue pointer"></i>
							</a>
					</div>'.'</td></tr>';
	}
}

if (isset($_POST['edicion_tarifa_categoria'])) {
	$resultado=$class->consulta("SELECT * FROM seg.categoria_servicio WHERE STADO='1'");
	$acu;
	while ($row=$class->fetch_array($resultado)) {		
		$arr = array('id' => $row[0], 'text' => $row[1]);
		$acu[]=$arr;
	}
	print_r(json_encode($acu));
}
if (isset($_POST['modificar_tarifax'])) {
	$resultado=$class->consulta("SELECT C.NOM, NOM_TARIFA, PRECIO FROM TARIFA T, SEG.CATEGORIA_SERVICIO C WHERE T.STADO='1' AND T.ID_CATEGORIA=C.ID AND T.ID='$_POST[id]'");
	$acu;
	while ($row=$class->fetch_array($resultado)) {		
		$acu[]=$row[0];
		$acu[]=$row[1];
		$acu[]=$row[2];
	}
	print_r(json_encode($acu));
}

if(isset($_POST['editable_tarifa_categoria'])) {
	$resultado = $class->consulta("UPDATE TARIFA SET id_categoria='$_POST[valor]' WHERE ID='$_POST[id]'");	
	if (!$resultado) {
		print('0');
	}else{
		print('1');
	}		
}
if(isset($_POST['editable_nombre_categoria'])) {

	$resultado = $class->consulta("UPDATE TARIFA SET nom_tarifa=upper('$_POST[valor]') WHERE ID='$_POST[id]'");	
	if (!$resultado) {
		print('0');
	}else{
		print('1');
	}		
}
if(isset($_POST['editable_precio_categoria'])) {
	$resultado = $class->consulta("UPDATE TARIFA SET precio='$_POST[valor]' WHERE ID='$_POST[id]'");	
	if (!$resultado) {
		print('0');
	}else{
		print('1');
	}		
}

if (isset($_POST['existencia_categoria'])) {
	$valor=strtoupper($_POST['reg']);
	$resultado = $class->consulta("SELECT * FROM SEG.CATEGORIA_SERVICIO WHERE NOM='$valor' AND STADO='1'");
	$id=0;
	while ($row=$class->fetch_array($resultado)) {
		$id=1;
	}
	print $id;
}
if (isset($_POST['existencia_tarifa'])) {
	$valor=strtoupper($_POST['reg']);
	$resultado = $class->consulta("SELECT * FROM TARIFA WHERE ID_SERVICIO='$_POST[id_ser]' AND ID_CATEGORIA='$_POST[id]' AND NOM_TARIFA='$valor' and STADO='1'");
	$id=0;
	while ($row=$class->fetch_array($resultado)) {
		$id=1;
	}
	print $id;
}
if (isset($_POST['existencia_ser'])) {
	$valor=strtoupper($_POST['reg']);
	$resultado = $class->consulta("SELECT * FROM SERVICIOS WHERE NOM='$valor' AND STADO='1'");
	$id=0;
	while ($row=$class->fetch_array($resultado)) {
		$id=1;
	}
	print $id;
}

if (isset($_POST['mostrar_categoria'])) {

	$resultado = $class->consulta("SELECT * FROM SEG.CATEGORIA_SERVICIO WHERE STADO='1'");
	$sum=0; $acu='INACTIVO';
	while ($row=$class->fetch_array($resultado)) {
		if ($row[3]=='ACTIVO')
			$acu='<span class="label label-success arrowed-in arrowed-in-right">ACTIVO</span>';
		else
			$acu='<span class="label label-important arrowed-in arrowed-in-right">DESACTIVADO</span>';
			$acux=$row[1];
		print
			'<tr>
				<td>'.$sum++.'</td>
				<td class="blue">'.$row[1].'</td>
				<td>'.$row[2].'</td>

				<td class="hidden-480">
					'.$acu.'
				</td>
				<td class="td-actions ">
					<div class="hidden-phone visible-desktop action-buttons">

						<a class="green" onclick=modificar_categoria("'.$row[0].'")>
							<i class="icon-pencil bigger-130"></i>
						</a>

						<a class="red" onclick=eliminar_categoria("'.$row[0].'")>
							<i class="icon-trash bigger-130"></i>
						</a>
					</div>
				</td>
			</tr>';
	}
}

if (isset($_POST['mostrar_categoria_select'])) {
	print'<select class="chzn-select" id="sel_categoria" name="sel_categoria" data-placeholder="Seleccione">';
	$resultado = $class->consulta("SELECT * FROM SEG.CATEGORIA_SERVICIO WHERE STADO='1'");
	$sum=0; $acu='INACTIVO';
	while ($row=$class->fetch_array($resultado)) {
		print'<option value="'.$row[0].'">'.$row[1].'</option>';
	}
	print'</select>';
}
if (isset($_POST['mostrar_servicios'])) {

	$resultado = $class->consulta("SELECT ID, NOM, STADO1,NOMIMG FROM SERVICIOS WHERE STADO='1'");
	$sum=0; $acu='INACTIVO';
	while ($row=$class->fetch_array($resultado)) {
		if($row[2]=='ACTIVO')
			$acu='<span class="label label-success arrowed-in arrowed-in-right">ACTIVO</span>';
		else
			$acu='<span class="label label-important arrowed-in arrowed-in-right">DESACTIVADO</span>';
		print
			'<tr>
				<td>'.$sum++.'</td>
				<td width="10"><img src="img/'.$row[3].'" width="100%"></td>
				<td class="blue">'.$row[1].'</td>
				<td class="hidden-480">
					'.$acu.'
				</td>
				<td class="td-actions ">
					<div class="hidden-phone visible-desktop action-buttons">						

						<a class="green" onclick=modificar_servicios("'.$row[0].'")>
							<i class="icon-pencil bigger-130"></i>
						</a>

						<a class="red" onclick=eliminar_servicios("'.$row[0].'")>
							<i class="icon-trash bigger-130"></i>
						</a>
					</div>				
				</td>
			</tr>';
		

	}
}
if (isset($_POST['eliminar'])) {
	print $class->consulta("UPDATE TARIFA SET STADO='0' WHERE ID='$_POST[id]'");	
}
if (isset($_POST['eliminar_categoria'])) {
	$a=$class->consulta("UPDATE SEG.CATEGORIA_SERVICIO SET STADO='0' WHERE ID='$_POST[id]'");	
	if (!$a) {
		print(0);
	}else print(1);
}
if (isset($_POST['eliminar_servicios'])) {
	$a=$class->consulta("UPDATE SERVICIOS SET STADO='0' WHERE ID='$_POST[id]'");	
	if (!$a) {
		print(0);
	}else print(1);
}
if (isset($_POST['modificar_cat'])) {
	$valor=strtoupper($_POST['txt_1']);
	$a=$class->consulta("UPDATE SEG.CATEGORIA_SERVICIO SET NOM='$valor' WHERE ID='$_POST[id]'");	
	if (!$a) {
		print(0);
	}else print(1);
}

// mostrar imprecion de tabla de horario para  cada servicio
if (isset($_POST['mostrar_horario'])) {
	$resultado = $class->consulta("SELECT * FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO='1'");
	$id=1;
	while ($row=$class->fetch_array($resultado)) {
		print'<tr><td>'.$id++.'</td><td>'.$row[3].
							  '</td><td>'.$row[4].
							  '</td><td>'.$row[5].'</td><td>'.$row[2].'</td><td>'.
		'<div class="hidden-phone visible-desktop action-buttons" >
												
							<a onclick=h_eliminar("'.$row[0].'")>
								<i class="icon-trash bigger-130 blue pointer"></i>
							</a>
					</div>'.'</td></tr>';
	}
}


if (isset($_POST['mostrar_d_disponibles'])) {
	$resultado = $class->consulta("SELECT * FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO='1'");
	$acus='';
	while ($row=$class->fetch_array($resultado)) {
		$acus=$acus.','.$row['dias'];	
	}
	$a=split(',', $acus);
	print'<select multiple="" class="select2" id="txt_0_horario" name="txt_0_horario" style="Border:blue;" data-placeholder="Seleccione">';
	if (in_array('LUNES', $a)) {
	}else{
		print'<option value="LUNES">LUNES</option>';
	}
	if (in_array('MARTES', $a)) {
	}else{
		print'<option value="MARTES">MARTES</option>';
	}
	if (in_array('MIERCOLES', $a)) {
	}else{
		print'<option value="MIERCOLES">MIERCOLES</option>';
	}
	if (in_array('JUEVES', $a)) {
	}else{
		print'<option value="JUEVES">JUEVES</option>';
	}
	if (in_array('VIERNES', $a)) {
	}else{
		print'<option value="VIERNES">VIERNES</option>';
	}
	if (in_array('SABADO', $a)) {
	}else{
		print'<option value="SABADO">SABADO</option>';
	}
	if (in_array('DOMINGO', $a)) {
	}else{
		print'<option value="DOMINGO">DOMINGO</option>';
	}
	print'</select>';
}



if (isset($_POST['h_eliminar'])) {
	print $class->consulta("UPDATE HORARIO_SERVICIOS SET STADO='0' WHERE ID='$_POST[id]'");	
}
if (isset($_POST['eliminar_servicio'])) {
	$acu=$class->consulta("UPDATE SERVICIOS SET STADO='0' WHERE ID='$_POST[id]'");
	if(!$acu)
		print(0);
	else
		print(1);
}

?>
