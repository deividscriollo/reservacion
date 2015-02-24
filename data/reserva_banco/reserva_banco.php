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
		$fecha=$class->fecha_hora();
		$id=$class->idz();
		$res=$class->consulta("INSERT INTO CONFIRMACION VALUES('".$id."','$_POST[id]','$_POST[num_cuenta]','$_POST[num_deposito]','$fecha','0')");
		if (!$res) {
			print 1;
		}else{
			print 0;
		}
	}
	
	
	if (isset($_POST['select_banco_cuenta'])) {
		$resultado = $class->consulta("SELECT C.ID, NUM, TIPO FROM BANCOS B, B_CUENTAS C WHERE B.ID=C.ID_BANCO AND B.ID='$_POST[id]' AND C.STADO='1'");
		print'<div class="row-fluid">';
		while ($row=$class->fetch_array($resultado)) {			
			print'<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
				
	 	}
	}
	
?>
