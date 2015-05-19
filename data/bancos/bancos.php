<?php 
	if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	$class=new constante();

	if(isset($_POST['guardar'])) {			
		
			$idb=$class->idz();
			$fecha=$class->fecha_hora();
			$res=$class->consulta("INSERT INTO BANCOS VALUES('$idb','$_POST[txt_1]','$fecha','1','ACTIVO')");
		
		if (!$res) {
			print 1;
		}else print 0;

	}
	if(isset($_POST['guardar_cuentas'])) {			
		
			$idb=$class->idz();
			$fecha=$class->fecha_hora();
			$res=$class->consulta("INSERT INTO B_CUENTAS VALUES('$idb','$_POST[id]','$_POST[txt_2]','$_POST[txt_1]','$fecha','1','ACTIVO')");
		
		if (!$res) {
			print 1;
		}else print 0;

	}
	if(isset($_POST['mostrar_bancos'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM BANCOS WHERE STADO='1'");
		$data = array();	
		$i=1;
		while ($row=$class->fetch_array($resultado)) {	
			$acu='';
			if ($row[4]=='ACTIVO')
				$acu='<span class="label label-success arrowed arrowed-righ"> ACTIVO </span>';
			else
				$acu='<span class="label label-important arrowed arrowed-righ"> DESACTIVADO </span>';
				print'<tr>
						<td class="center">'.$i++.'</td>
						<td class="center">'.$row[1].'</td>
						<td class="center">'.$row[2].'</td>
						<td class="center">
							'.$acu.'
						</td>
							<td class="center">
							<div class="hidden-phone visible-desktop action-buttons">
								<a class="blue dc_cursor tooltip-info" onclick="dc_bancos_nuevo()" data-rel="tooltip" data-placement="top"  data-original-title="Nuevo">
									<i class="icon-zoom-in bigger-130"></i>
								</a>

								<a class="green dc_cursor tooltip-success" onclick=dc_bancos_modificar("'.$row[0].'") data-rel="tooltip" data-placement="top" data-original-title="Modificar">
									<i class="icon-pencil bigger-130"></i>
								</a>

								<a class="red dc_cursor tooltip-error" onclick=dc_bancos_eliminar("'.$row[0].'") data-rel="tooltip" data-placement="top"  data-original-title="Eliminar">
									<i class="icon-trash bigger-130"></i>
								</a>
							</div>
						</td>
					</tr>';

	 	} 
	}
	if(isset($_POST['mostrar_bancos_select'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM BANCOS WHERE STADO='1'");
		$data = array();	
		$i=1;
		while ($row=$class->fetch_array($resultado)) {	

			print'<option value="'.$row[0].'">'.$row[1].'</option>';
	 	} 
	}
	if(isset($_POST['existencia_ban'])) {
		$valor=strtoupper($_POST['reg']);
		$resultado = $class->consulta("SELECT * FROM BANCOS WHERE NOM='$valor' AND STADO='1'");
		$id=0;
		while ($row=$class->fetch_array($resultado)) {
			$id=1;
		}
		print $id;
	}
	if (isset($_POST['lbl_banco'])) {
		$class->consulta("UPDATE BANCOS  SET NOM=upper('$_POST[value]') WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_stado'])) {
		$class->consulta("UPDATE BANCOS  SET STADO1=upper('$_POST[value]') WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['mostrar_edicion_bancos'])) {
		$resultado = $class->consulta("SELECT * FROM BANCOS WHERE ID='$_POST[id]' AND STADO='1'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
		}
		print_r(json_encode($acu));
	}
	if (isset($_POST['lbl_banco_cuenta'])) {
		$class->consulta("UPDATE B_CUENTAS  SET ID_BANCO='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_cuenta'])) {
		$class->consulta("UPDATE B_CUENTAS  SET NUM='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_estado_cuenta'])) {
		$class->consulta("UPDATE B_CUENTAS  SET STADO1='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_tipo'])) {
		$class->consulta("UPDATE B_CUENTAS  SET tipo='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['buscar_banco'])) {
		$resultado=$class->consulta("SELECT * FROM BANCOS WHERE STADO='1'");
		$acu;
		while ($row=$class->fetch_array($resultado)) {		
			$arr = array('id' => $row[0], 'text' => $row[1]);
			$acu[]=$arr;
		}
		print_r(json_encode($acu));
	}

	if (isset($_POST['mostrar_edicion_cuenta'])) {
		$resultado = $class->consulta("SELECT C.*,B.NOM FROM B_CUENTAS C,BANCOS B WHERE B.ID=C.ID_BANCO AND C.ID='$_POST[id]' AND C.STADO='1'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]=$row[5];
			$acu[]=$row[6];
			$acu[]=$row[7];
		}
		print_r(json_encode($acu));
	}
	
	if (isset($_POST['mostrar_edicion_banco'])) {
		$resultado = $class->consulta("SELECT * FROM BANCOS WHERE ID='$_POST[id]' AND STADO='1'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[4];
		}
		print_r(json_encode($acu));
	}
	
	if(isset($_POST['mostrar_cuentas'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM B_CUENTAS C, BANCOS B WHERE B.ID=C.ID_BANCO AND C.STADO='1'");
		$data = array();	
		$i=1;
		while ($row=$class->fetch_array($resultado)) {	
			if ($row[6]=='ACTIVO')
				$acu='<span class="label label-success arrowed arrowed-righ"> ACTIVO </span>';
			else
				$acu='<span class="label label-important arrowed arrowed-righ"> DESACTIVADO </span>';

			print'<tr>
						<td class="center">'.$i++.'</td>
						<td class="center">'.$row[8].'</td>
						<td class="center">'.$row[3].'</td>
						<td class="center">'.$row[2].'</td>
						<td class="center">'.$row[4].'</td>
						<td class="center">
							'.$acu.'
						</td>
						<td class="center">
						<div class="hidden-phone visible-desktop action-buttons">
							<a class="blue dc_cursor tooltip-info" onclick="dc_cuentas_nuevo()" data-rel="tooltip" data-placement="top"  data-original-title="Nuevo">
								<i class="icon-zoom-in bigger-130"></i>
							</a>

							<a class="green dc_cursor tooltip-success" onclick=dc_cuentas_modificar("'.$row[0].'") data-rel="tooltip" data-placement="top" data-original-title="Modificar">
								<i class="icon-pencil bigger-130"></i>
							</a>

							<a class="red dc_cursor tooltip-error" onclick=dc_cuentas_eliminar("'.$row[0].'") data-rel="tooltip" data-placement="top"  data-original-title="Eliminar">
								<i class="icon-trash bigger-130"></i>
							</a>
						</div>
					</td></tr>';

			
	 	} 
	}
	if (isset($_POST['eliminar_bancos'])) {		
		print $class->consulta("UPDATE BANCOS SET STADO='0' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['eliminar_cuentas'])) {		
		print $class->consulta("UPDATE B_CUENTAS SET STADO='0' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['existencia_bancos'])) {
		$valor=strtoupper($_POST['reg']);
		$resultado = $class->consulta("SELECT * FROM BANCOS WHERE NOM='$valor' AND STADO='1'");
		$id=0;
		while ($row=$class->fetch_array($resultado)) {
			$id=1;
		}
		print $id;
	}
	if (isset($_POST['existencia_cuenta'])) {
		$valor=strtoupper($_POST['reg']);
		$resultado = $class->consulta("SELECT * FROM B_CUENTAS WHERE NUM='$valor' AND STADO='1'");
		$id=0;
		while ($row=$class->fetch_array($resultado)) {
			$id=1;
		}
		print $id;
	}
		
?>
