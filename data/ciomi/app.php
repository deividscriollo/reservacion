<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();

	if (isset($_POST['obj_tipo_reservacion'])) {
		$resultado = $class->consulta("SELECT C.* FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE T.ID_CATEGORIA=C.ID AND S.ID=T.ID_SERVICIO AND S.ID='20141211160003548a05d39b5c8'");
		$slim=1;
		$clase = array('','#90BC21','#3085C9','#D6487E','#D15B47','#B2C0CA','#9687BF','#555555' );
		$icono = array('','icon-leaf','icon-tag','icon-flag',' icon-bell-alt','icon-fire','icon-cloud','icon-lightbulb' );
		while ($row=$class->fetch_array($resultado)) {
			$acu[]= array($row[0],$row[1]);
	 	}
	 	$acu=array_map("unserialize", array_unique(array_map("serialize", $acu)));
		print'<div class="row_fluid">';
		array_unshift($acu, false); // Add to the start of the array
		$acu = array_values($acu); // Re-number
		// Remove the first index so we start at 1
		$acu = array_slice($acu, 1, count($acu), true);
	 	for ($i=1; $i <= count($acu) ; $i++) {
	 		$id=$acu[$i][0];
	 		$nom=$acu[$i][1];
	 		print'
				<div class="span2 center dc_hover" id="'.$id.'">
					<div class="center easy-pie-chart percentage" data-percent="101" data-color="'.$clase[$slim].'">
						<span class="'.$icono[$slim].'"></span>
					</div>
					<div class="space-2"></div>
					'.$nom.'
				</div>
			';
			if ($slim>5) {
				print'</div>';
				print'<div class="row-fluid">';
			}
			$slim++;
	 	}
	 	print'</div>';
	}
	if (isset($_POST['mostrar_tarifa_servicios'])) {
		$resultado = $class->consulta("SELECT T.ID,T.NOM_TARIFA FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE C.ID=T.ID_CATEGORIA AND S.ID=T.ID_SERVICIO AND C.ID='$_POST[id]' AND S.ID='20141211160003548a05d39b5c8'");
		while ($row=$class->fetch_array($resultado)) {
			print'<li id=nom_"'.$row[0].'">'.$row[1].'</li>';
	 	}
	}
	if (isset($_POST['guardar'])) {
		$horarios=$_POST['horarios'];
		$tarifas=$_POST['tarifas'];

		$id=$class->idz();
		$fecha=$class->fecha_hora();
		$tabla='<table style="float: right;" class="dca" align="right" width="60%" style="padding: 2px;   border:1px #FFFFFF; color:#FFFFFF;">';
		$tabla=$tabla.'<thead style="display: table-header-group;   vertical-align: middle;    border-color: inherit;">
        <tr style="background: #8FBC1D;"><td>SERVICIO</td><td>TARIFA</td><td>cantidad</td><td>precio</td><td>Total</td></tr>
            </thead><tbody style="color:#FFFFFF;">';
        // estableciendo reservacion
		$class->consulta("INSERT INTO RESERVACION VALUES('$id','$_SESSION[id]','20141211160003548a05d39b5c8','0','$fecha','PETICION_RESERVA','')");
		$id_horarios=$class->idz();
		// estableciendo horario de la reserva
		$hi=$horarios[2].' '.$horarios[0];
		$hf=$horarios[2].' '.$horarios[1];
		$class->consulta("INSERT INTO RESERVACION_HORARIOS VALUES('$id_horarios','$id','$hi','$hf','$horarios[2]','$horarios[3]','$fecha','0')");
		$sum=0;
		for ($i=0; $i < count($tarifas); $i++) {
			$precio=$tarifas[$i][1];
			$cantidad=$tarifas[$i][2];
			$subt=$tarifas[$i][3];
			$tabla=$tabla.'<tr><td></td><td>'.$tarifas[$i][0].'</td><td>'.$precio.'</td><td>'.$cantidad.'</td><td>'.$subt.'</td></tr>';
			$sum=$sum+$tarifas[$i][3];
			$id_tar=str_replace('total_', '', $tarifas[$i][4]);
			$id_tarifas=$class->idz();
			$class->consulta("INSERT INTO RESERVACION_TARIFA VALUES('$id_tarifas','$id','$id_tar','$precio','$cantidad','$subt','$fecha','0')");
		}
		$total=$_POST['total']-$sum;
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Sub Total</td><td>'.$sum.'</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Iva</td><td>'.$total.'</td></tr>';
		$tabla=$tabla.'<tr><td></td><td></td><td></td><td>Total</td><td>'.$_POST['total'].'</td></tr>';
		$tabla=$tabla.'<tr style="background: #8FBC1D;"><td></td><td>INICIO H.</td><td>FINAL H.</td><td>FECHA</td><td>DIA</td></tr>';
		$tabla=$tabla.'<tr><td></td><td>'.$horarios[0].'</td><td>'.$horarios[1].'</td><td>'.$horarios[2].'</td><td>'.$horarios[3].'</td></tr>';
		$tabla=$tabla.'</tbody></table>';
		$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='$_SESSION[id]'");
		while ($row=$class->fetch_array($resultado)) {
			envio_correoReservacion($row['correo'],$tabla,$total,$id);
	 	}
		// print_r(json_decode($_POST['tarifas']));
	}
	if (isset($_POST['mostrar_tarifa_servicios2'])) {
		$resultado = $class->consulta("SELECT T.ID,T.PRECIO FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE C.ID=T.ID_CATEGORIA AND S.ID=T.ID_SERVICIO AND C.ID='$_POST[id]' AND S.ID='20141211160003548a05d39b5c8'");
		while ($row=$class->fetch_array($resultado)) {
			print'<li id="pre_'.$row[0].'">'.$row[1].'</li>';
	 	}
	}
	if (isset($_POST['mostrar_tarifa_servicios3'])) {
		$resultado = $class->consulta("SELECT T.ID,T.NOM_TARIFA FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE C.ID=T.ID_CATEGORIA AND S.ID=T.ID_SERVICIO AND C.ID='$_POST[id]' AND S.ID='20141211160003548a05d39b5c8'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]='<li class="dc_no-padding"><input type="text" class="input-mini" id="spi_'.$row[0].'"/></li>';
			$acu[]=$row[0];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_tarifa_servicios4'])) {
		$resultado = $class->consulta("SELECT T.ID,T.NOM_TARIFA,T.PRECIO FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE C.ID=T.
			ID_CATEGORIA AND S.ID=T.ID_SERVICIO AND C.ID='$_POST[id]' AND S.ID='20141211160003548a05d39b5c8'");
		$acu;
		$num=1;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]='<tr>
						<td class="center">'.$num.'</td>
						<td class="center">'.$row[1].'</td>
						<td class="center" id="pre_'.$row[0].'">'.$row[2].'</td>
						<td class="center"><input type="text" class="input-mini" id="spi_'.$row[0].'"/></td>
						<td class="center" id="total_'.$row[0].'">0.00</td>
					</tr>';
			$acu[]=$row[0];
			$num++;
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['obj_informacion_museo'])) {
		$resultado = $class->consulta("SELECT DESCRIPCION FROM SERVICIOS WHERE ID='20141211160003548a05d39b5c8'");
		$acu;
		$num=1;
		while ($row=$class->fetch_array($resultado)) {
			print $row[0];
	 	}
	}

	if (isset($_POST['museo_buscar_horas'])) {
		$dia=$_POST['dia'];
		$resultado = $class->consulta("SELECT horai, horaf, dias, lapso FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='20141211160003548a05d39b5c8' AND STADO ='1';");
		$clase = array('badge badge-warning',
						'badge badge-grey',
						'badge badge-success',
						'badge',
						'badge badge-info',
						'badge badge-purple',
						'badge badge-inverse',
						'badge badge-pink',
						'badge badge-yellow' );
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
					$init=0;
					// aculumador de horas
					for ($i=0;strtotime($horaInicial)<strtotime($horafinal);$i++) {
						if ($j==4) {$j=0;};
						$acumu_horas=sumar_horas($horaInicial,$horalapso);
						$horaInicial=$acumu_horas;
						if (strtotime($horaInicial)<strtotime($horafinal)) {
							$fecha_h=$_POST['f'].' '.$horaInicial;
							if (buscar_horario($fecha_h)!=1) {
								$a=1;
								print'<tr>
										<td class="center">'.$m.'</td>
										<td class="center"><label><input type="checkbox" onclick="reconstruir('.$init.')"/><span class="lbl"></span></label></td>
										<td class="center">'.$horaInicial.'</td>
										<td class="center">'.sumar_horas($horaInicial,$horalapso).'</td>
										<td class="center">'.$_POST['f'].'</td>
										<td class="center"><span class="'.$clase[rand(1,8)].'">'.$dia.'</span></td>
										</tr>';
								$j++;$m++;
								$init++;
							}
						};
					}

				}
			}
		}
	}
	if (isset($_POST['impuesto'])) {
		$acu=0;
		$resultado = $class->consulta("SELECT  CASE WHEN IMPUESTO='SI' THEN  (PORCENTAJE)::int ELSE 0  END  FROM SERVICIOS S WHERE S.ID='20141211160003548a05d39b5c8'");
		while ($row=$class->fetch_array($resultado)) {
			$acu=$row[0];
	 	}
	 	print $acu;
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

	function buscar_horario($f){
		$a=0;
		$class=new constante();
		$resultado = $class->consulta("SELECT to_char(RH.FE, 'DD/MM/YYYY'),to_char(RH.HINICIO, 'HH24:MI'),to_char(RH.HFIN, 'HH24:MI'),RH.* FROM RESERVACION R, RESERVACION_HORARIOS RH, SERVICIOS S 
WHERE R.ID=RH.ID_RESERVACION AND S.ID='20141211160003548a05d39b5c8' AND RH.HINICIO='$f' AND  R.STADO='0'");
		while ($row=$class->fetch_array($resultado)) {
			$a=1;
		}
		return $a;
	}
?>