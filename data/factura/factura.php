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
			,* FROM RESERVACION R, SERVICIOS S, SEG.USUARIO U, RESERVACION_HORARIOS RH
			WHERE R.ID_SERVICIO=S.ID AND R.ID_USUARIO=U.ID AND RH.ID_RESERVACION=R.ID AND RH.FE=TO_CHAR(now(),'DD/MM/YYYY')");
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

		$resultado = $class->consulta("SELECT U.CEDULA,U.NOMBRE,U.FONO,U.DIRECCION, U.ID,U.CORREO FROM SEG.USUARIO U, SEG.NIVEL N   WHERE N.ID_USUARIO=U.ID AND N.NIVEL='CLIENTE' AND U.STADO='1'");
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
		$acu='';;
		$resultado = $class->consulta("SELECT R.ID,CEDULA,S.NOM,HINICIo,HFIN,FE FROM SERVICIOS S, RESERVACION R, SEG.USUARIO U, RESERVACION_HORARIOS RH 
										WHERE R.ID=RH.ID_RESERVACION AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO AND R.STADO='0' and U.ID='".$_POST['id']."'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]='<button class="btn btn-mini btn-danger" onclick="seleccion_reservacion('."'".$row[0]."'".')">
						<i class="icon-arrow-right  icon-on-right"></i>
					</button>';
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['datos_factura_servicios'])) {
		$resultado = $class->consulta("SELECT S.NOM FROM RESERVACION R, SERVICIOS S WHERE R.ID_SERVICIO=S.ID AND R.ID='".$_POST['id']."'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[0];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['datos_factura_tarifa'])) {
		$resultado = $class->consulta("SELECT NOM_TARIFA,TA.PRECIO,T.CANTIDAD,round((T.CANTIDAD*TA.PRECIO), 2),CASE WHEN IMPUESTO='SI' THEN  (PORCENTAJE)::int ELSE 0  END AS IMPUESTO
										FROM RESERVACION R, SERVICIOS S, RESERVACION_TARIFA T, TARIFA TA
										WHERE R.ID_SERVICIO=S.ID AND T.ID_TARIFA=TA.ID AND T.ID_RESERVACION=R.ID AND T.CANTIDAD!=0 AND R.ID='".$_POST['id']."'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}

?>
