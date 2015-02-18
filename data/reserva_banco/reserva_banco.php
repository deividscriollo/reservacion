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
		$mat=$_POST['matriz'];		
		$horario=$_POST['horario'];
		$subtotal=$_POST['subtotal'];
		$fecha=$class->fecha_hora();
		$id=$class->idz();
		$sericio='';
		$id_ser=$_POST['id_servicio'];
		$nom_servicio='';
		$res1=$class->consulta("SELECT nom FROM SERVICIOS WHERE ID='$id_ser'");
		while ($row=$class->fetch_array($res1)) {					
					$nom_servicio=$row[0];
	 	}

		$tabla='<table style="float: right;" class="dca" align="right" width="60%" style="padding: 2px;   border:1px #FFFFFF; color:#FFFFFF;">';
		$tabla=$tabla.'<thead style="display: table-header-group;   vertical-align: middle;    border-color: inherit;">
        <tr style="background: #8FBC1D;"><td>SERVICIO</td><td>TARIFA</td><td>cantidad</td><td>precio</td><td>Total</td></tr>
            </thead><tbody style="color:#FFFFFF;">';
		$res=$class->consulta("INSERT INTO RESERVACION VALUES('$id','$_SESSION[id]','$id_ser','$subtotal','$fecha','0')");
		for ($i=0; $i < count($mat); $i++) { 
				$ida=$class->idz();
				$a=$mat[$i][1];
				$acus=split(':', $a);
				$servicios=$acus[1];
				$servicios=ltrim($servicios);
				$servicios=preg_replace("/\r\n+|\r+|\n+|\t+/i", " ", $servicios);
				$b=$mat[$i][0];
				$sum=split(':', $b);
				$cantidad=$sum[1];
				$p_cantidad=$acus[2];
				$c=$mat[$i][2];
				$sum1=split(':', $c);
				$t=$sum1[2];
				if ($i==0) {					
					$tabla=$tabla.'<tr><td>'.$nom_servicio.'</td><td>'.$servicios.'</td><td>'.$cantidad.'</td><td>'.$p_cantidad.'</td><td>'.$t.'</td></tr>';
				}else				
				$tabla=$tabla.'<tr><td></td><td>'.$servicios.'</td><td>'.$cantidad.'</td><td>'.$p_cantidad.'</td><td>'.$t.'</td></tr>';

				$res=$class->consulta("INSERT INTO RESERVACION_TARIFA VALUES('$ida','$id','$servicios','$cantidad','$p_cantidad','$t','$fecha','0')");			
		}		
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Sub Total</td><td>'.$subtotal.'</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Iva</td><td>0.00</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Total</td><td>'.$subtotal.'</td></tr>';
		$tabla=$tabla.'<tr style="background: #8FBC1D;"><td></td><td>INICIO H.</td><td>FINAL H.</td><td>FECHA</td><td>DIA</td></tr>';
		for ($i=0; $i <count($horario); $i++) {
			$idb=$class->idz(); 			
			$hi=$horario[$i][0];
			$hf=$horario[$i][1];
			$f=$horario[$i][2];
			$d=$horario[$i][3];
			$tabla=$tabla.'<tr><td></td><td>'.$hi.'</td><td>'.$hf.'</td><td>'.$f.'</td><td>'.$d.'</td></tr>';
			$res=$class->consulta("INSERT INTO RESERVACION_HORARIOS VALUES('$idb','$id','$hi','$hf','$f','$d','$fecha','0')");
		}		
		if (!$res) {
			print 1;
		}else print 0;
		// envio del correo a la reservacion
		$tabla=$tabla.'</tbody></table>';		
		$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='$_SESSION[id]'");		
		while ($row=$class->fetch_array($resultado)) {					
			envio_correoReservacion($row['correo'],$tabla,$subtotal,$row[0]);				
	 	}


	}
	
	
	if (isset($_POST['select_banco_cuenta'])) {
		$resultado = $class->consulta("SELECT ID_BANCO, NUM, TIPO FROM BANCOS B, B_CUENTAS C WHERE B.ID=C.ID_BANCO AND B.ID='$_POST[id]' AND C.STADO='1'");
		print'<div class="row-fluid">';
		while ($row=$class->fetch_array($resultado)) {			
			print'<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
				
	 	}
	}
	
?>
