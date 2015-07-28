<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require('../../admin/class.php');
	$class=new constante();

	if (isset($_POST['mostrar_clientes'])) {
		$resultado = $class->consulta("SELECT U.ID,U.CEDULA,U.NOMBRE, U.FONO,U.DIRECCION
										FROM SEG.USUARIO U,SEG.NIVEL N
										WHERE N.NIVEL='CLIENTE' AND N.ID_USUARIO=U.ID  AND U.STADO='1'");
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]='<button class="btn btn-mini btn-danger" onclick="seleccion_cliente('."'".$row[0]."'".')">
						<i class="icon-arrow-right  icon-on-right"></i>
					</button>
					';
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['llenar_clientes_datos'])) {
		$resultado = $class->consulta("SELECT CEDULA,NOMBRE,FONO,DIRECCION, ID FROM SEG.USUARIO  WHERE ID='".$_POST['id']."'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['guardar_cliente'])) {
		$id=$class->idz();
		$resultado = $class->consulta("INSERT INTO SEG.USUARIO VALUES('".$id
                                                                    ."','".$_POST['txt_0'].
                                                                    "','".$_POST['txt_1'].
                                                                    "','".$_POST['txt_4'].
                                                                    "','".$class->fecha_hora().
                                                                    "','".$_POST['txt_2'].
                                                                    "','".
                                                                    "','".$_POST['txt_3'].
                                                                    "','".'1'.
                                                                    "','".$class->fecha_hora().
                                                                    "','".'1'.
                                                                    "')");
      $resultado = $class->consulta("INSERT INTO SEG.NIVEL VALUES('".$class->idz()
                                                                    ."','".$id.
                                                                    "','".'CLIENTE'.
                                                                    "','".$class->fecha_hora().
                                                                    "','".'1'.
                                                                    "')");
        print '1';
	}
	if(isset($_POST['guardar_reservacion'])) {
		// ---------------get data of fron-end--------------------//
		$fecha_evento= $_POST['fecha'];
		$dia= strtoupper($_POST['dia']);
		$hora_inicio = $_POST['hora_inicio']; // Hora actual
		$tot_hora=sumar_horas($hora_inicio,'02:00');

		$servicio=$_POST['servicio'];
		$fecha=$class->fecha_hora();
		// --------------- id reservation-------------//
		$id=$class->idz();
		//------- id time------------//
		$id_time=$class->idz();
		//------------------id information-------------//
		$acu[]=$id;
		//-------------------save information reservation event
		$res=$class->consulta("INSERT INTO RESERVACION VALUES('$id','','$servicio','0','$fecha','0')");
		if (!$res) {
			$acu[]=1;
		}else $acu[]=0;
		// -------------------save information event time----------------------//
		$res=$class->consulta("INSERT INTO RESERVACION_HORARIOS VALUES('$id_time','$id','$hora_inicio','$tot_hora','$fecha_evento','$dia','$fecha','0')");
		if (!$res) {
			$acu[]=1;
		}else $acu[]=0;
		print_r(json_encode($acu));

	}
	if (isset($_POST['actualizar_clientes_reservacion'])) {
		$class->consulta("UPDATE RESERVACION  SET ID_USUARIO='$_POST[id_cliente]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['eliminar_evento'])) {
		$res=$class->consulta("UPDATE RESERVACION  SET STADO='REMOVED' WHERE ID='$_POST[id]'");
		if (!$res) {
			$acu[]=1;
		}else $acu[]=0;
		print_r(json_encode($acu));
	}
	if(isset($_POST['actividades'])) {
		//$pos=$_POST['pos'];
		$resultado = $class->consulta("SELECT NOMBRE, S.NOM FROM RESERVACION R, SEG.USUARIO U, SERVICIOS S WHERE R.ID_USUARIO=U.ID AND R.ID_SERVICIO=S.ID AND R.STADO='0'");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {
				print'<div class="profile-activity clearfix">
						<div>
							<i class="pull-left thumbicon icon-key btn-info no-hover"></i>
							<a class="user" href="#">'.$row[0].' </a>

							RESERVACION DE SERVICIO: '.$row[1].'.
							<div class="time">
								<i class="icon-time bigger-110"></i>
								12 hours ago
							</div>
						</div>

						<div class="tools action-buttons">
							<a href="#" class="blue">
								<i class="icon-pencil bigger-125"></i>
							</a>

							<a href="#" class="red">
								<i class="icon-remove bigger-125"></i>
							</a>
						</div>
					</div>';
		 	}
	}
	if (isset($_POST['buscar_servicio'])) {
		//$pos=$_POST['pos']
		$reg=$_POST['registro'];
		$reg=strtoupper($reg);
		$resultado = $class->consulta("SELECT * FROM servicios WHERE NOM like'%$reg%' AND STADO='1' limit 4 offset 0");

		while ($row=$class->fetch_array($resultado)) {
			print'<tr><td>'.$row[1].'</td><td>'.substr($row[2],0,10).'...</td><td>'.substr($row[3],0,10).'...</td><td>'.
		'<div class="hidden-phone visible-desktop action-buttons" >
							<a onclick=btn_select_servicio("'.$row[0].'")  data-dismiss="modal">
							<i class="icon-zoom-in bigger-130 blue pointer icon-animated-bell"></i>
							</a>
					</div>'.'</td></tr>';
	 	}
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

			$fe=split('/', $row[4]);
			$star=$fe[2].'-'.$fe[1].'-'.$fe[0].' '.$row[2].':00';
			$fs=split('/', $row[4]);
			$end=$fs[2].'-'.$fs[1].'-'.$fs[0].' '.$row[3].':00';
			$acu[$i]= array('id' => $row[0],'title'=>$row[1],'start'=>$star,'end'=>$end,'className'=>$clase,'description'=>'hola men');
			$i++;
	 	}
	 	print_r(json_encode($acu));
	}

// new Date(year, month, day, hours, minutes, seconds, milliseconds)

	//-----------funcion`s required---------//
	function sumar_horas($hora1,$hora2){
		$horaInicial=$hora1;
		$d=split(':', $hora2);
		$minutoAnadir=($d[0]*60)+$d[1];
		$segundos_horaInicial=strtotime($horaInicial);
		$segundos_minutoAnadir=$minutoAnadir*60;
		$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
		return$nuevaHora;
	}
?>
