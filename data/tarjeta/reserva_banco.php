<?php 
	if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	$class=new constante();

	if(isset($_POST['guardar'])) {
		// guardar:'ok',matriz:matriz,acu_fh:acu_fh,subtotal:lbl_subtotal
		$fecha=$class->fecha_hora();
		$id=$class->idz();
		$res=$class->consulta("INSERT INTO CONFIRMACION VALUES('".$id."','$_POST[id]','','$_POST[t]','TARGETA DE CREDITO','$_POST[num_deposito]','$fecha','0')");
		if (!$res) {
			print 1;
		}else{
			print 0;
		}
	}
	if (isset($_POST['validar_targeta'])) {
		//print $_POST['tarjeta'];
		print validar_tarjeta($_POST['tarjeta']);
	}
	function validar_tarjeta($numero) {
		$suma=0;
		for ($i=0; $i<16;$i++) {
			if ($i%2) {
				$j=0;
				$suma+=$numero[$j]; //par
			}else{ //impar
				if($numero[1]!=9) {
					$suma+=2*$numero[2]%9;
				}else{
					$suma += 9;
				}
			}
		}
		if ($suma % 10 == 0 && $suma < 150) {
			return true;
		}else{
			return false;
		}
	}

?>
