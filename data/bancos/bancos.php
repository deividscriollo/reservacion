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
			$res=$class->consulta("INSERT INTO BANCOS VALUES('$idb','$_POST[txt_1]','$fecha','1')");
		
		if (!$res) {
			print 1;
		}else print 0;

	}
	if(isset($_POST['guardar_cuentas'])) {			
		
			$idb=$class->idz();
			$fecha=$class->fecha_hora();
			$res=$class->consulta("INSERT INTO B_CUENTAS VALUES('$idb','$_POST[id]','$_POST[txt_2]','$_POST[txt_1]','$fecha','1')");
		
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

			print'<tr><td class="center">'.$i++.'</td><td class="center">'.$row[1].'</td><td class="center">'.$row[2].'</td><td class="center"><span class="label label-success arrowed arrowed-righ"> ACTIVO </span></td>
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
											</td></tr>';
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
	
	if(isset($_POST['mostrar_cuentas'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM B_CUENTAS C, BANCOS B WHERE B.ID=C.ID_BANCO AND C.STADO='1'");
		$data = array();	
		$i=1;
		while ($row=$class->fetch_array($resultado)) {	

			print'<tr><td class="center">'.$i++.'</td><td class="center">'.$row[7].'</td><td class="center">'.$row[3].'</td><td class="center">'.$row[2].'</td><td class="center">'.$row[4].'</td><td class="center"><span class="label label-success arrowed arrowed-righ"> ACTIVO </span></td>
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
		
?>
