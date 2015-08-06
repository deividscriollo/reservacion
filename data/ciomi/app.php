<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require('../../admin/class.php');
	$class=new constante();

	if (isset($_POST['obj_tipo_reservacion'])) {
		$resultado = $class->consulta("SELECT * FROM seg.categoria_servicio WHERE STADO1='ACTIVO' AND STADO='1' ORDER BY ID");
		print'<div class="row_fluid">';
		$slim=1;
		$clase = array('','#90BC21','#3085C9','#D6487E','#D15B47','#B2C0CA','#9687BF','#555555' );
		$icono = array('','icon-leaf','icon-tag','icon-flag',' icon-bell-alt','icon-fire','icon-cloud','icon-lightbulb' );
		while ($row=$class->fetch_array($resultado)) {
			print'
				<div class="span2 center dc_hover" id="'.$row[0].'">
					<div class="center easy-pie-chart percentage" data-percent="100" data-color="'.$clase[$slim].'">
						<span class="'.$icono[$slim].'"></span>
					</div>
					<div class="space-2"></div>
					'.$row[1].'
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
			print'<li id="'.$row[0].'">'.$row[1].'</li>';
	 	}
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
			$sum[]= $row[0];
			$sum[]= $row[1];
	 	}
	 	print_r(json_encode($sum));
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
					// aculumador de horas
					for ($i=0;strtotime($horaInicial)<strtotime($horafinal);$i++) {
						if ($j==4) {$j=0;};
						$acumu_horas=sumar_horas($horaInicial,$horalapso);
						$horaInicial=$acumu_horas;
						if (strtotime($horaInicial)<strtotime($horafinal)) {
							$a=1;
							print'<tr>
									<td class="center">'.$m.'</td>
									<td class="center"><label><input type="checkbox" onclick="reconstruir('.$i.')"/><span class="lbl"></span></label></td>
									<td class="center">'.$horaInicial.'</td>
									<td class="center">'.sumar_horas($horaInicial,$horalapso).'</td>
									<td class="center">'.$_POST['f'].'</td>
									<td class="center"><span class="'.$clase[rand(1,8)].'">'.$dia.'</span></td>
									</tr>';
							$j++;$m++;
						};
					}

				}
			}
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