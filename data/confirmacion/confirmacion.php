<?php 
	if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();

	if(isset($_POST['guardar'])) {
		// guardar:'ok',matriz:matriz,acu_fh:acu_fh,subtotal:lbl_subtotal	
	}
	
	
	if (isset($_GET['servicio_reservado'])) {
		$resultado = $class->consulta("SELECT S.NOM, COUNT(S.NOM) FROM RESERVACION R, SERVICIOS S WHERE R.ID_SERVICIO=S.ID GROUP BY S.NOM HAVING count(S.nom) >=1 limit 5");
		$acu= array();
		$sum=1;
			while ($row=$class->fetch_array($resultado)) {				
				$x[0] = $row[0];
			    $x[1] = $row[1];
			    array_push($acu,$x);	
		 	}
		 	print json_encode($acu, JSON_NUMERIC_CHECK);
	}
	if (isset($_POST['confirmar_reservacion'])) {
		$resultado = $class->consulta("UPDATE CONFIRMACION SET STADO='1' WHERE ID='$_POST[id]'");
		if (!$resultado) {
			print 1;
		}else{
			print 0;
			envio_confirmacion_reservacion($_POST['correo'], $_POST['nombre']);
		}
	}
	if (isset($_POST['mostrar_reservacion'])) {
		$resultado = $class->consulta("SELECT S.NOM,R.FECHA,R.SUBTOTAL,B.NOM,C.TIPO,C.NUM,CON.COMPROBANTE,CON.FECHA, CON.ID,U.NOMBRE,U.CORREO FROM 
										SERVICIOS S,RESERVACION R,BANCOS B, B_CUENTAS C, CONFIRMACION CON,SEG.USUARIO U
										WHERE
										S.ID=R.ID_SERVICIO AND CON.ID_RESERVACION=R.ID AND CON.ID_CUENTA=C.ID AND C.ID_BANCO=B.ID AND U.ID=R.ID_USUARIO AND CON.STADO='0'");
		
		while ($row=$class->fetch_array($resultado)) {			
			$lista[] = $row[0];
		    $lista[] = $row[1];
		    $lista[] = $row[2];
		    $lista[] = $row[3];
		    $lista[] = $row[4];
		    $lista[] = $row[5];
		    $lista[] = $row[6];
		    $lista[] = $row[7];
		    $lista[] = '<div class="hidden-phone visible-desktop btn-group">
					<button class="btn btn-success" onclick="correo_envio('."'".$row[8]."'".','."'".$row[9]."'".','."'".$row[10]."'".')">
						<i class="icon-ok bigger-120"> Reservaciones</i>
					</button>
					</div>';
		}
		echo $lista = json_encode($lista);
	}
	
?>
