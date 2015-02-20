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
	
?>
