<?php 
	if(!isset($_SESSION))
		{
		session_start();		
		}
	require('../../admin/class.php');	
	$class=new constante();
	if (isset($_POST['llenar_reservacion'])) {
		$resultado = $class->consulta(
			"SELECT U.CEDULA, U.NOMBRE, TO_CHAR(R.FECHA,'YYYY-MM-DD') AS FECHA, TO_CHAR(R.FECHA,'hh:mm:ss') AS FECHA,S.NOM,RH.HINICIO,RH.HFIN
			FROM RESERVACION R, SERVICIOS S, SEG.USUARIO U, RESERVACION_HORARIOS RH
			WHERE R.ID_SERVICIO=S.ID AND R.ID_USUARIO=U.ID AND RH.ID_RESERVACION=R.ID AND TO_CHAR(R.FECHA,'YYYY-MM-DD')=TO_CHAR(now(),'YYYY-MM-DD')");		
		$acu;
		while ($row=$class->fetch_array($resultado)) {					
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]=$row[5];
			$acu[]=$row[6];
					
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['llenar_clientes'])) {

		$resultado = $class->consulta("SELECT CEDULA,NOMBRE,FONO,DIRECCION,U.ID FROM SEG.USUARIO U,SEG.NIVEL N WHERE NIVEL='Cliente' AND N.ID_USUARIO=U.ID  AND U.STADO='1'");		
		$acu;
		while ($row=$class->fetch_array($resultado)) {					
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]='<button class="btn btn-mini btn-danger" onclick="seleccion_cliente('."'".$row[4]."'".')">
						<i class="icon-arrow-right  icon-on-right"></i>
					</button>									
					';
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['llenar_clientes_datos'])) {

		$resultado = $class->consulta("SELECT CEDULA,NOMBRE,FONO,DIRECCION, ID,CORREO FROM SEG.USUARIO  WHERE ID='".$_POST['id']."'");				
		while ($row=$class->fetch_array($resultado)) {					
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]=$row[5];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['llenar_reservacion_datos'])) {
		$resultado = $class->consulta("SELECT * FROM RESERVACION R, SEG.USUARIO U WHERE U.ID=R.ID_USUARIO AND R.STADO='0' and CEDULA='".$_POST['cedula']."'");				
		while ($row=$class->fetch_array($resultado)) {					
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]=$row[5];
	 	}
	 	print_r(json_encode($acu));
	}
?>
