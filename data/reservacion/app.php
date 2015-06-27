<?php 
if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();

	// guardando informacion de la 
	if(isset($_POST['guardar'])) {
		// guardar:'ok',matriz:matriz,acu_fh:acu_fh,subtotal:lbl_subtotal
		$mat=$_POST['matriz'];		
		$matX=$_POST['matriz'];	
		$horario=$_POST['horario'];
		$subtotal=$_POST['subtotal'];
		$fecha=$class->fecha_hora();
		$id=$class->idz();
		$sericio='';
		$id_ser="20141211160003548a05d39b5c8";
		$nom_servicio='';
		$instituacion=$_POST['txt_institucion'];
		$res1=$class->consulta("SELECT nom FROM SERVICIOS WHERE ID='$id_ser'");
		while ($row=$class->fetch_array($res1)) {					
					$nom_servicio=$row[0];
	 	}

		$tabla='<table style="float: right;" class="dca" align="right" width="60%" style="padding: 2px;   border:1px #FFFFFF; color:#FFFFFF;">';
		$tabla=$tabla.'<thead style="display: table-header-group;   vertical-align: middle;    border-color: inherit;">
        <tr style="background: #8FBC1D;"><td>SERVICIO</td><td>TARIFA</td><td>cantidad</td><td>precio</td><td>Total</td></tr>
            </thead><tbody style="color:#FFFFFF;">';
		$res=$class->consulta("INSERT INTO RESERVACION VALUES('$id','$_SESSION[id]','$id_ser','$subtotal','$fecha','0','$instituacion')");
		for ($i=0; $i < count($mat); $i++) { 
				$ida=$class->idz();
				$a=$mat[$i][1];
				$acus=split(':', $a);
				$servicios=$matX[$i][3];
				$servicios=ltrim($servicios);
				$servicios=preg_replace("/\r\n+|\r+|\n+|\t+/i", " ", $servicios);
				$cantidad=$matX[$i][0];
				$p_cantidad=split(':', $matX[$i][2]);
				$p_cantidad=$p_cantidad[1];
				$c=$mat[$i][2];
				$t=number_format($p_cantidad*$cantidad, 2, '.', ' ');
				$tabla=$tabla.'<tr><td></td><td>'.$servicios.'</td><td>'.$cantidad.'</td><td>'.$p_cantidad.'</td><td>'.$t.'</td></tr>';

				$res=$class->consulta("INSERT INTO RESERVACION_TARIFA VALUES('$ida','$id','$servicios','$p_cantidad','$cantidad','$t','$fecha','0')");			
		}		
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Sub Total</td><td>'.$subtotal.'</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Iva</td><td>0.00</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Total</td><td>'.$subtotal.'</td></tr>';
		$tabla=$tabla.'<tr style="background: #8FBC1D;"><td></td><td>INICIO H.</td><td>FINAL H.</td><td>FECHA</td><td>DIA</td></tr>';
		//print_r($horario);
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
			envio_correoReservacion($row['correo'],$tabla,$subtotal,$id);				
	 	}


	}
// llamado inicial de servicio 
	if (isset($_POST['obj_img_servicios'])) {
		$resultado = $class->consulta("SELECT * FROM SERVICIOS ORDER BY NOM");
		$i=0;
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]=$row[5];
			$acu[]=$row[6];
			$acu[]=$row[7];
			$acu[]=$row[8];
			$acu[]=$row[9];
			$acu[]=$row[10];
		}
		print_r(json_encode($acu));
	}
	if (isset($_POST['cargar_categoria_servicios'])) {
		$resultado = $class->consulta("SELECT * FROM seg.categoria_servicio WHERE STADO1='ACTIVO' AND STADO='1' ORDER BY ID");
		$i=0;
		$acu;
		print'<option value="">Seleccionar</option>';
		while ($row=$class->fetch_array($resultado)) {
			print'<option value="'.$row[0].'">'.$row[1].'</option>';		
		}
	}	
	if (isset($_POST['impuesto_museo'])) {
		$resultado = $class->consulta("select impuesto, porcentaje from servicios where id='20141211160003548a05d39b5c8'");
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[0];
			$acu[]=$row[1];
		}
		print_r(json_encode($acu));
	}
	if (isset($_POST['museo_buscar_horas'])) {
		$dia=$_POST['dia'];		
		//estructura cada fila con un color diferente en class
		$dis = array("success","warning","danger","info");
		$resultado = $class->consulta("SELECT horai, horaf, dias, lapso FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='20141211160003548a05d39b5c8' AND STADO ='1';");
		while ($row=$class->fetch_array($resultado)) {
			$m=1;
			$acu=split(",", $row[2]);
			for ($i=0; $i < count($acu); $i++) {
				$dc=strtoupper((String)$acu[$i]);
				if((string)$dc==$dia){
					// hora inicial del dia
					$b=split(":", $row[0]);
					// finalizacion horario de trabajo
					$c=split(":", $row[1]);
					// intervalo de hora
					$d=split(":", $row[3]);
					$horaInicial=$b[0].':'.$b[1];
					$horafinal=$c[0].':'.$c[1];
					$horalapso=$d[0].':'.$d[1];	
					//$horafinal=sumar_horas($horafinal,$horalapso);	
					$horaInicial=restar_horas($horaInicial,$horalapso);	
					$j=0;
					// aculumador de horas
					for ($i=0;strtotime($horaInicial)<strtotime($horafinal);$i++) { 							
						if ($j==4) {$j=0;};
						$acumu_horas=sumar_horas($horaInicial,$horalapso);
						$horaInicial=$acumu_horas;
						if (strtotime($horaInicial)<strtotime($horafinal)) {	
							$a=1;
							print'<tr><td>'.$m.'</td><td><label><input type="checkbox" onclick="reconstruir('.$i.')"/><span class="lbl"></span></label></td><td>'.$horaInicial.'</td><td>'.sumar_horas($horaInicial,$horalapso).'</td><td>'.$_POST['f'].'</td><td>'.$dia.'</td></tr>';										
							$j++;$m++;
						};					
						
					}

				}
			}	
		}
	}
	// permi establecer busquedar dependiente a la categoria seleccionada
	if(isset($_POST['obj_tarifa'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT nom_tarifa, precio FROM SERVICIOS S, TARIFA T, SEG.CATEGORIA_SERVICIO C WHERE
 S.ID=T.ID_SERVICIO AND T.ID_CATEGORIA=C.ID AND S.ID='20141211160003548a05d39b5c8' AND C.ID='$_POST[tipo]' AND T.STADO ='1';");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print $row[0].','.$row[1].',';				
		 	}
	}
	// requerimiento de funciones 
	function sumar_horas($hora1,$hora2){	
		$horaInicial=$hora1;
		$d=split(':', $hora2);
		$minutoAnadir=($d[0]*60)+$d[1];
		$segundos_horaInicial=strtotime($horaInicial);
		$segundos_minutoAnadir=$minutoAnadir*60;
		$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
		return$nuevaHora;
	}
	function restar_horas($hora1,$hora2){	
		$horaInicial=$hora1;
		$d=split(':', $hora2);
		$minutoAnadir=($d[0]*60)+$d[1];
		$segundos_horaInicial=strtotime($horaInicial);
		$segundos_minutoAnadir=$minutoAnadir*60;
		$nuevaHora=date("H:i",$segundos_horaInicial-$segundos_minutoAnadir);
		return$nuevaHora;
	}

	function buscar_horario($inicio,$fin){
		$a=0;
		//print('gb'.$inicio.$fin);
		$class=new constante();
		$resultado = $class->consulta("SELECT * FROM RESERVACION_HORARIOS WHERE hinicio='$inicio' and hfin='$fin' AND STADO='0'");
		while ($row=$class->fetch_array($resultado)) {		
			$a=1;		
		}
		return $a;
	}	
?>
