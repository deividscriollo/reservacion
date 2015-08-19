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
	if (isset($_POST['info_reservacion'])) {
		$res = $class->consulta("SELECT U.NOMBRE,CEDULA,CORREO,FONO FROM RESERVACION R, SEG.USUARIO U WHERE U.ID=R.ID_USUARIO AND R.ID='$_POST[id]'");
		$acu= array();
		while ($row=$class->fetch_array($res)) {
			$acu[] = $row[0];
		    $acu[] = $row[1];
		    $acu[] = $row[2];
		    $acu[] = $row[3];
	 	}
	 	$res = $class->consulta("SELECT HINICIO, HFIN FROM RESERVACION_HORARIOS R WHERE R.ID_RESERVACION='$_POST[id]'");
	 	while ($row=$class->fetch_array($res)) {
			$acu[] = $row[0];
		    $acu[] = $row[1];
	 	}
	 	$res = $class->consulta("SELECT CASE WHEN IMPUESTO='SI' THEN  (PORCENTAJE)::int ELSE 0  END AS IMPUESTO, TOTAL
									FROM RESERVACION_TARIFA RT, RESERVACION R, SERVICIOS S
									WHERE RT.ID_RESERVACION=R.ID AND S.ID=R.ID_SERVICIO AND R.ID='$_POST[id]'");
	 	$sum=0;
	 	$impuesto=0;
	 	$total=0;
	 	while ($row=$class->fetch_array($res)) {
			$sum=$sum+$row[1];
			$impuesto=$row[0];
	 	}
	 	if ($impuesto!=0) {
	 		$total=($sum*$impuesto)/100;
	 	}
	 	$acu[]=$total+$sum;
	 	$res = $class->consulta("SELECT COMPROBANTE, B.NOM,BC.TIPO,BC.NUM, C.NUMERO FROM CONFIRMACION C, B_CUENTAS BC, BANCOS B WHERE C.ID_CUENTA=BC.ID AND B.ID=BC.ID_BANCO AND C.ID_RESERVACION='$_POST[id]'");
	 	while ($row=$class->fetch_array($res)) {
	 		if ($row[0]=='0') {
	 			$acu[]='
	 					<div class="profile-user-info">
							<div class="profile-info-row">
								<div class="profile-info-name"> Banco </div>

								<div class="profile-info-value">
									<span>'.$row[1].'</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name">Tipo de Cuenta</div>

								<div class="profile-info-value">
									<span>'.$row[2].'</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name">Nro Cuenta</div>

								<div class="profile-info-value">
									<span>'.$row[3].'</span>
								</div>
							</div>
							<div class="profile-info-row">
								<div class="profile-info-name">Nro Deposito</div>

								<div class="profile-info-value">
									<span>'.$row[4].'</span>
								</div>
							</div>
						</di>
	 					';
	 		};
	 		if ($row[0]!=0) {
	 			$acu[]='<img src="../reserva_banco/img/'.$row[0].'">';
	 		}
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['confirmar_reservacion'])) {
		$class->consulta("UPDATE RESERVACION SET STADO='0' WHERE ID='$_POST[id]'");
		$resultado = $class->consulta("UPDATE CONFIRMACION SET STADO='1' WHERE ID_RESERVACION='$_POST[id]'");
		if (!$resultado) {
			print 1;
		}else{
			print 0;
			envio_confirmacion_reservacion($_POST['correo'], $_POST['nombre']);
		}
	}
	if (isset($_POST['mostrar_reservacion'])) {
		$resultado = $class->consulta("SELECT S.NOM,R.ID
										FROM SERVICIOS S,RESERVACION R,BANCOS B, B_CUENTAS C, CONFIRMACION CON,SEG.USUARIO U
										WHERE S.ID=R.ID_SERVICIO AND CON.ID_RESERVACION=R.ID AND CON.ID_CUENTA=C.ID AND C.ID_BANCO=B.ID AND U.ID=R.ID_USUARIO AND CON.STADO='0'");
		$lista='';
		while ($row=$class->fetch_array($resultado)) {
			$lista[] = $row[0];
		    $lista[] = '<div class="hidden-phone visible-desktop btn-group">
						<button class="btn btn-info btn-mini" onclick="mostrar('."'".$row[1]."'".')">
							Ver información	<i class="icon-ok bigger-120"></i>
						</button>
						</div>';

		}
		echo $lista = json_encode($lista);
	}
?>
