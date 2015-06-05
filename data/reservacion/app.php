<?php 
if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();
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
		$resultado = $class->consulta("SELECT * FROM seg.categoria_servicio ORDER BY NOM");
		$i=0;
		$acu;
		print'<option value="">Seleccionar</option>';
		while ($row=$class->fetch_array($resultado)) {
			print'<option value="'.$row[0].'">'.$row[1].'</option>';		
		}
	}
	if (isset($_POST['museo_buscar_horas'])) {
		$dia=$_POST['dia'];		
		//estructura cada fila con un color diferente en class
		$dis = array("active", "success","warning","danger","info");
		$resultado = $class->consulta("SELECT horai, horaf, dias, lapso FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='20141211160003548a05d39b5c8' AND STADO ='1';");
		while ($row=$class->fetch_array($resultado)) {
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
						if ($j==5) {$j=0;};
						$acumu_horas=sumar_horas($horaInicial,$horalapso);
						$horaInicial=$acumu_horas;
						if (strtotime($horaInicial)<strtotime($horafinal)) {	
							$a=1;
							print'<tr class="'.$dis[$j].'"><td><label><input type="checkbox" onclick="reconstruir('.$i.')"/><span class="lbl"></span></label></td><td>'.$horaInicial.'</td><td>'.sumar_horas($horaInicial,$horalapso).'</td><td>'.$_POST['f'].'</td><td>'.substr($dia, 0, 3).'...</td></tr>';										
							$j++;
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
