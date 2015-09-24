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
	if (isset($_POST['reservado_semana'])) {
		$resultado = $class->consulta("SELECT ID_BANCO, NUM, TIPO FROM BANCOS B, B_CUENTAS C WHERE B.ID=C.ID_BANCO AND B.ID='$_POST[id]' AND C.STADO='1'");
		print'<div class="row-fluid">';
		while ($row=$class->fetch_array($resultado)) {
			print'<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
	 	}
	}
	if (isset($_POST['mostrar_resultados_extranjeros'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("SELECT R.FECHA,upper('extrangero') as na,upper(NOM_PAIS),S.NOM, upper(U.NOMBRE) FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P 
		WHERE R.ID_USUARIO=I.ID_USUARIO AND P.ID=I.PAIS AND PAIS!='20150326104209551428d175961' AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO
				AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."'");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_resultados_nacionales'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("	SELECT R.FECHA,upper('extrangero') as na,upper(NOM_PAIS),S.NOM, upper(U.NOMBRE) 
								FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P 
								WHERE R.ID_USUARIO=I.ID_USUARIO 
								AND P.ID=I.PAIS 
								AND PAIS='20150326104209551428d175961' 
								AND S.ID=R.ID_SERVICIO 
								AND U.ID=R.ID_USUARIO
								AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."'");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_resultados_nacionales_provincia'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("	SELECT R.FECHA,PRO.NOM_PROVINCIA,upper(NOM_PAIS),S.NOM, upper(U.NOMBRE)
								FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P, LOCALIZACION.PROVINCIA PRO, LOCALIZACION.CIUDAD C 
								WHERE R.ID_USUARIO=I.ID_USUARIO 
								AND P.ID=I.PAIS 
								AND C.ID_PROVINCIA=PRO.ID
								AND C.ID=U.ID_CIUDAD
								AND PAIS='20150326104209551428d175961' 
								AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO 
								AND PRO.ID_PAIS=P.ID
								AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."' ORDER BY NOM_PROVINCIA");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_resultados_nacionales_ciudad'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("	SELECT R.FECHA,PRO.NOM_PROVINCIA,C.NOM_CIUDAD,S.NOM, upper(U.NOMBRE)
								FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P, LOCALIZACION.PROVINCIA PRO, LOCALIZACION.CIUDAD C 
								WHERE R.ID_USUARIO=I.ID_USUARIO 
								AND P.ID=I.PAIS 
								AND C.ID_PROVINCIA=PRO.ID
								AND C.ID=U.ID_CIUDAD
								AND PAIS='20150326104209551428d175961' 
								AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO 
								AND PRO.ID_PAIS=P.ID
								AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."' ORDER BY NOM_PROVINCIA");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_resultados_forma_pago_paypal'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("	SELECT R.FECHA,S.NOM, upper(U.NOMBRE),FP.FORMA_PAGO,
									CASE WHEN PAIS='20150326104209551428d175961' THEN 'Nacional'
								            ELSE 'Extrangero'
									END
								FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P, FORMA_PAGO FP
								WHERE R.ID_USUARIO=I.ID_USUARIO 
								AND P.ID=I.PAIS
								AND R.ID=FP.ID_RESERVACION
								AND PAIS='20150326104209551428d175961'
								AND FORMA_PAGO='PAYPAL' 
								AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO 
								AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."'");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_resultados_forma_pago_efectivo'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("	SELECT R.FECHA,S.NOM, upper(U.NOMBRE),FP.FORMA_PAGO,
									CASE WHEN PAIS='20150326104209551428d175961' THEN 'Nacional'
								            ELSE 'Extrangero'
									END
								FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P, FORMA_PAGO FP
								WHERE R.ID_USUARIO=I.ID_USUARIO 
								AND P.ID=I.PAIS
								AND R.ID=FP.ID_RESERVACION
								AND PAIS='20150326104209551428d175961'
								AND FORMA_PAGO='EFECTIVO' 
								AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO 
								AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."'");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_resultados_forma_pago_deposito'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("	SELECT R.FECHA,S.NOM, upper(U.NOMBRE),FP.FORMA_PAGO,
									CASE WHEN PAIS='20150326104209551428d175961' THEN 'Nacional'
								            ELSE 'Extrangero'
									END
								FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P, FORMA_PAGO FP
								WHERE R.ID_USUARIO=I.ID_USUARIO 
								AND P.ID=I.PAIS
								AND R.ID=FP.ID_RESERVACION
								AND PAIS='20150326104209551428d175961'
								AND FORMA_PAGO='DEPOSITO' 
								AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO 
								AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."'");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_resultados_forma_pago_tarjeta'])) {
		$inicio = $_POST['inicio'];
		$fin = $_POST['fin'];
		$res=$class->consulta("	SELECT R.FECHA,S.NOM, upper(U.NOMBRE),FP.FORMA_PAGO,
									CASE WHEN PAIS='20150326104209551428d175961' THEN 'Nacional'
								            ELSE 'Extrangero'
									END
								FROM SEG.USUARIO U, RESERVACION R,SERVICIOS S, SEG.INFO I, LOCALIZACION.PAIS P, FORMA_PAGO FP
								WHERE R.ID_USUARIO=I.ID_USUARIO 
								AND P.ID=I.PAIS
								AND R.ID=FP.ID_RESERVACION
								AND PAIS='20150326104209551428d175961'
								AND FORMA_PAGO='T.CREDITO' 
								AND S.ID=R.ID_SERVICIO AND U.ID=R.ID_USUARIO 
								AND R.FECHA BETWEEN '".$inicio."' AND '".$fin."'");
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_provincias'])) {
		$res=$class->consulta("SELECT * FROM LOCALIZACION.PROVINCIA");
		print'<option value=""></option>';
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			print'<option value="'.$row[0].'">'.$row[2].'</option>';
	 	}
	}
	if (isset($_POST['mostrar_ciudad'])) {
		$res=$class->consulta("SELECT * FROM LOCALIZACION.CIUDAD WHERE ID_PROVINCIA='".$_POST['id']."'");
		print'<option value=""></option>';
		while ($row=$class->fetch_array($res)) {
			// iniciativas
			print'<option value="'.$row[0].'">'.$row[2].'</option>';
	 	}
	}

?>