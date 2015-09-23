<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require('../../admin/class.php');
	$class=new constante();
	//mostrar datos usuarios
	if (isset($_POST['mostrar_usuarios'])) {
		$resultado = $class->consulta("	SELECT U.ID, U.CEDULA,U.NOMBRE, U.CORREO FROM SEG.USUARIO U, SEG.NIVEL N 
										WHERE U.ID=N.ID_USUARIO AND NIVEL!='CLIENTE' AND U.STADO='1'
									  ");
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]='<button class="btn btn-mini btn-success" onclick="seleccion_usuario_nuevo()">
						<i class="icon-zoom-in bigger-130"></i>
					</button>
					<button class="btn btn-mini btn-info" onclick="seleccion_usuario_editar('."'".$row[0]."'".')">
						<i class="icon-pencil bigger-130"></i>
					</button>
					<button class="btn btn-mini btn-danger" onclick="seleccion_usuario_eliminar('."'".$row[0]."'".')">
						<i class="icon-trash bigger-130"></i>
					</button>
					<button class="btn btn-mini btn-purple" onclick="seleccion_privilegio('."'".$row[0]."'".')">
						<i class="icon-dashboard bigger-130"></i>
					</button>
					';
	 	}
	 	print_r(json_encode($acu));
	}
	// informacion de registro unico usr
	if (isset($_POST['info_usuario'])) {
		$resultado = $class->consulta("	SELECT ID, CEDULA,NOMBRE, CORREO,PASS FROM SEG.USUARIO WHERE ID='$_POST[id]'");
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	// mostrar informacion privilegio usuario
	if (isset($_POST['mostrar_privilegio_usuario'])) {
		$resultado = $class->consulta("SELECT ACCESOS FROM SEG.SEGMENTO S, SEG.USUARIO U WHERE U.ID=S.ID_USUARIO AND U.ID='$_POST[id]'");
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$titulo = array('ACCESO A SERVICIOS', 'ACCESO A BANCOS','ACCESO A AGENDA','ACCESO A CORREO','ACCESO A RESERVA','ACCESO A REPORTES','ACCESO A CONFIRMACION','ACCESO A USR','ACCESO A FACTURA','PETICION','SPT');
			$btn = array('btn_servicios', 'btn_bancos', 'btn_agenda','btn_correo', 'btn_reserva', 'btn_reportes', 'btn_confirmacion', 'btn_usr', 'btn_factura','btn_peticion','btn_spt');
			$acu=str_replace('{', '', $row[0]);
			$acu=str_replace('}', '', $acu);
			$acu=split(',', $acu);
			for ($i=0; $i < 11; $i++) {
				$sum=$acu[$i];
				$sum=split(':',$sum);
				$var='';
				if ($sum[1]=='TRUE') {
					$var='checked';
				}else{
					$var='';
				}
				print'
						<h5 class="row-fluid header smaller lighter blue">
								<span class="span7">
									<i class="icon-tag blue"></i>
									'.$titulo[$i].'
								</span><!--/span-->
								<span class="span5">
									<label class="pull-right inline">
										<small class="muted"></small>
										<input id="'.$btn[$i].'"  '.$var.' type="checkbox" class="ace-switch ace-switch-5"/>
										<span class="lbl"></span>
									</label>
								</span><!--/span-->
							</h5>
				';
			}
	 	}
	}
	// guardar datos en usuario
	if (isset($_POST['guardar_usuario'])) {
		$id=$class->idz();
		$fecha=$class->fecha_hora();
		$acu=$class->consulta("	INSERT INTO SEG.USUARIO VALUES('$id',
															'$_POST[cedula]',
															'$_POST[nombre]',
															'','$fecha',
															'$_POST[correo]',
															MD5('$_POST[pass]'),
															'','',
															'$fecha'
															,'1')");
		$acu=$class->consulta("	INSERT INTO SEG.NIVEL VALUES('".$class->idz()."','$id','ADMIN','$fecha','1')");
		$acu=$class->consulta("	INSERT INTO SEG.INFO VALUES('".$class->idz()."','$id','','$fecha','0')");
		$acu=$class->consulta("	INSERT INTO SEG.SEGMENTO VALUES('".$class->idz()."','$id','{0,0,0,0,0,0,0,0,0,0}','$fecha','1')");
		if (!$acu) {
			print '1';
		}else{
			print '0';
		}
	}
	//eliminar registro tabla usuarios
	if (isset($_POST['eliminar_usuario'])) {
		$acu=$class->consulta("UPDATE SEG.USUARIO  SET STADO='0' WHERE ID='$_POST[id]'");
		if (!$acu) {
			print '1';
		}else{
			print '0';
		}
	}
	// edicion de registro de usurios
	if (isset($_POST['name'])) {
		if ($_POST['name']=='actualizar_usuario_nombre') {
			$acu=$class->consulta("UPDATE SEG.USUARIO  SET NOMBRE='$_POST[value]' WHERE ID='$_POST[pk]'");
			if (!$acu) {
				print '1';
			}else{
				print '0';
			}
		}
	}
	//actualizacion procesos de privilegios
	if (isset($_POST['btn_privilegios'])) {
		$pos=$_POST['pos'];
		$acu=$class->consulta("UPDATE SEG.SEGMENTO SET ACCESOS[$pos] = '$_POST[pro]' WHERE ID_USUARIO='$_POST[id]'");
		if (!$acu) {
			print '1';
		}else{
			print '0';
		}
	}
?>