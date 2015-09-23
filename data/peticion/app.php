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
		$res = $class->consulta("SELECT S.NOM,U.NOMBRE,CEDULA,CORREO,FONO FROM RESERVACION R, SEG.USUARIO U, SERVICIOS S WHERE U.ID=R.ID_USUARIO AND S.ID=R.ID_SERVICIO AND R.ID='$_POST[id]'");
		$acu= array();
		while ($row=$class->fetch_array($res)) {
			$acu[] = $row[0];
		    $acu[] = $row[1];
		    $acu[] = $row[2];
		    $acu[] = $row[3];
		    $acu[] = $row[4];
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
		$resultado=$class->consulta("UPDATE RESERVACION SET STADO='PETICION_RESERVA' WHERE ID='$_POST[id]'");
		if (!$resultado) {
			print 1;
		}else{
			print 0;
		}
		$tabla='<table style="float: right;" class="dca" align="right" width="60%" style="padding: 2px;   border:1px #FFFFFF; color:#FFFFFF;">';
		$tabla=$tabla.'<thead style="display: table-header-group;   vertical-align: middle;    border-color: inherit;">
        <tr style="background: #8FBC1D;"><td>SERVICIO</td><td>TARIFA</td><td>Precio</td><td>Cantidad</td><td>Total</td></tr>
            </thead><tbody style="color:#FFFFFF;">';

		$resultado = $class->consulta("SELECT S.NOM,NOM_TARIFA,RT.CANTIDAD, RT.PRECIO,RT.TOTAL,TOTAL AS SUBTOTAL,
	CASE WHEN IMPUESTO='SI' THEN  (PORCENTAJE)::int ELSE 0  END AS IMPUESTO,
	(total*cast(PORCENTAJE as int)/100) as IVA,(total+(total*cast(PORCENTAJE as int)/100)) astotal_suma,
	to_char(HINICIO, 'HH12:MI:SS'),to_char(HFIN, 'HH12:MI:SS'),to_char(FE,'YYYY-MM-DD'),DIA,RH
	FROM RESERVACION R, SERVICIOS S, RESERVACION_HORARIOS RH, RESERVACION_TARIFA RT, TARIFA T
	WHERE RT.ID_RESERVACION=R.ID AND RH.ID_RESERVACION=R.ID AND T.ID=RT.ID_TARIFA AND S.ID=R.ID_SERVICIO AND R.ID='$_POST[id]'");
		while ($row=$class->fetch_array($resultado)) {
			$tabla=$tabla.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td></tr>';
			$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Sub Total</td><td>'.$row[5].'</td></tr>';
			$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Iva '.$row[6].'</td><td>'.round($row[7]*1, 2).'</td></tr>';
			// print $row[8];
			$mt=round($row[8]*1, 2);
			$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Total</td><td>'.$mt.'</td></tr>';
			$tabla=$tabla.'<tr style="background: #8FBC1D;"><td></td><td>INICIO H.</td><td>FINAL H.</td><td>FECHA</td><td>DIA</td></tr>';
			$tabla=$tabla.'<tr><td></td><td>'.$row[9].'</td><td>'.$row[10].'</td><td>'.$row[11].'</td><td>'.$row[12].'</td></tr>';
			$tabla=$tabla.'</tbody></table>';
			envio_correoReservacion($_POST['correo'],$tabla,round($row[8], 2),$_POST['id']);
	 	}
	 	// print $tabla;
	}
	if (isset($_POST['reservacion_eventos'])) {
		$resultado = $class->consulta("SELECT R.ID, S.NOM,H.HINICIO,H.HFIN,H.FE,S.ID FROM SERVICIOS S,RESERVACION R, RESERVACION_HORARIOS H WHERE S.ID=R.ID_SERVICIO AND R.ID=H.ID_RESERVACION AND R.STADO='0'");
		$acu = array(); //create new array
		$i=0;
		while ($row=$class->fetch_array($resultado)) {
			// -----------information class style-------------------//
			$clase='';
			if ($row[5]=='20141211160003548a05d39b5c8') $clase="label-info";
			if ($row[5]=='20141211160155548a0643d0616') $clase="label-success";
			if ($row[5]=='20141211160521548a07112af84') $clase="label-important";
			if ($row[5]=='20141211160613548a07457dffd') $clase="label-purple";
			$acu[$i]= array('id' => $row[0],'title'=>$row[1],'start'=>$row[2],'end'=>$row[3],'className'=>$clase,'description'=>'procesando');
			$i++;
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['confirmar_reservacion_otros'])){
		$res=$class->consulta("UPDATE RESERVACION SET STADO='RESERVACION_NEGADA' WHERE ID='$_POST[id]'");
		if (!$res) {
			$acu[]=0;
		}else{
			$acu[]=1;
			envio_correorespuesta_peticion($_POST['correo'],$_POST['mensaje']);
		}
		print_r(json_encode($acu));
		//"PETICION_RESERVA"
	}
	if (isset($_POST['mostrar_reservacion'])) {
		$resultado = $class->consulta("SELECT R.ID,S.NOM,HINICIO,HFIN,DIA FROM RESERVACION R, SERVICIOS S, RESERVACION_HORARIOS RH WHERE RH.ID_RESERVACION=R.ID AND S.ID=R.ID_SERVICIO AND R.STADO='PETICION_RESERVA_OTROS'");
		$lista='';
		while ($row=$class->fetch_array($resultado)) {
			$lista[] = $row[1];
			$lista[] = $row[2];
			$lista[] = $row[3];
			$lista[] = $row[4];
		    $lista[] = '<div class="hidden-phone visible-desktop btn-group">
						<button class="btn btn-info btn-mini" onclick="mostrar('."'".$row[0]."'".')">
							Ver Petición	<i class="icon-ok bigger-120"></i>
						</button>
						</div>';

		}
		echo $lista = json_encode($lista);
	}
?>
