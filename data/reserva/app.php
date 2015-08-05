<?php 
	if(!isset($_SESSION)){
		session_start();
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();

	if (isset($_POST['mostrar_servicios_reservacion'])) {
		$resultado = $class->consulta("SELECT C.ID,C.NOM,T.ID_SERVICIO,R.ID FROM RESERVACION R, TARIFA T, SEG.CATEGORIA_SERVICIO C WHERE R.ID_SERVICIO=T.ID_SERVICIO AND T.ID_CATEGORIA=C.ID AND R.ID='$_POST[id]'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]='<option value="'.$row[0].','.$row[2].','.$row[3].'">'.$row[1].'</option>';
	 	}
	 	$sum=count($acu);
	 	$acu=array_unique($acu);
	 	print_r(implode('', $acu));
	}
	if (isset($_POST['mostrar_tarifa_servicios'])) {
		$acu=split(',', $_POST['id']);
		$resultado = $class->consulta("SELECT T.ID,T.NOM_TARIFA FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE C.ID=T.ID_CATEGORIA AND S.ID=T.ID_SERVICIO AND C.ID='$acu[0]' AND S.ID='$acu[1]'");
		while ($row=$class->fetch_array($resultado)) {
			print'<li id="'.$row[0].'">'.$row[1].'</li>';
	 	}
	}
	if (isset($_POST['mostrar_tarifa_servicios2'])) {
		$acu=split(',', $_POST['id']);
		$resultado = $class->consulta("SELECT T.ID,T.PRECIO FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE C.ID=T.ID_CATEGORIA AND S.ID=T.ID_SERVICIO AND C.ID='$acu[0]' AND S.ID='$acu[1]'");
		while ($row=$class->fetch_array($resultado)) {
			print'<li id="'.$row[0].'">'.$row[1].'</li>';
	 	}
	}
	if (isset($_POST['mostrar_tarifa_servicios3'])) {
		$acu=split(',', $_POST['id']);
		$resultado = $class->consulta("SELECT T.ID,T.NOM_TARIFA FROM SEG.CATEGORIA_SERVICIO C, TARIFA T, SERVICIOS S WHERE C.ID=T.ID_CATEGORIA AND S.ID=T.ID_SERVICIO AND C.ID='$acu[0]' AND S.ID='$acu[1]'");
		while ($row=$class->fetch_array($resultado)) {
			$sum[]= $row[0];
			$sum[]= $row[1];
			$sum[]= $acu[2];
	 	}
	 	print_r(json_encode($sum));
	}
	if (isset($_POST['llenar_clientes_datos'])) {
		$resultado = $class->consulta("SELECT CEDULA,NOMBRE,FONO,DIRECCION, CORREO FROM SEG.USUARIO  WHERE ID='".$_POST['id']."'");
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['llenar_clientes'])) {
		$resultado = $class->consulta("SELECT CEDULA,NOMBRE,FONO,DIRECCION,U.ID FROM SEG.USUARIO U,SEG.NIVEL N WHERE NIVEL='CLIENTE' AND N.ID_USUARIO=U.ID  AND U.STADO='1'");		
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]='<button class="btn btn-mini btn-danger" onclick="seleccion_cliente('."'".$row[4]."'".')">
						<i class="icon-arrow-right  icon-on-right"></i>
					</button>
					';
	 	}
	 	print_r(json_encode($acu));
	}
	if (isset($_POST['mostrar_cliente_reservaciones'])) {
		$resultado = $class->consulta("SELECT S.NOM,RH.HINICIO,RH.HFIN,S.ID, R.ID, S.ID  FROM SEG.USUARIO U, SEG.NIVEL N,RESERVACION R, RESERVACION_HORARIOS RH, SERVICIOS S 
		WHERE N.ID_USUARIO=U.ID AND U.ID=R.ID_USUARIO AND S.ID=R.ID_SERVICIO AND R.ID=RH.ID_RESERVACION AND N.NIVEL='CLIENTE' AND U.ID='".$_POST['id']."' AND R.STADO='0' ORDER BY RH.FECHA");
		while ($row=$class->fetch_array($resultado)) {
			$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
			$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
			$dia = $dias[date("w", strtotime($row[1])-1)];
			$mes = $meses[date('n', strtotime($row[1]))-1];
			$diaf = $dias[date("w", strtotime($row[2])-1)];
			$mesf = $meses[date('n', strtotime($row[2]))-1];
			if ($row[3]=='20141211160003548a05d39b5c8') $clase = array( "label-info",'blue' );
			if ($row[3]=='20141211160155548a0643d0616') $clase = array( "label-success",'green' );
			if ($row[3]=='20141211160521548a07112af84') $clase = array( "label-important",'red' );
			if ($row[3]=='20141211160613548a07457dffd') $clase = array( "label-purple",'purple' );
			print'
					<div class="profile-activity clearfix">
						<div>
							<i class="pull-left thumbicon  icon-coffee '.$clase[0].' no-hover"></i>
							<div class="'.$clase[1].'">'.$row[0].'</div>

							<div class="time pull-left">
								<i class="icon-time bigger-110"></i>
								'.$dia.', '.$mes.' '.date(" j G:i Y", strtotime($row[1])).'
								<i class="icon-download bigger-110"></i>
								'.$diaf.', '.$mesf.' '.date(" j G:i Y", strtotime($row[2])).'
							</div>
							<div class="controls pull-right">
								<label>
									<input name="form-field-radio" id="'.$row[4].','.$row[5].'" type="radio" onclick="accion_reservacion(event)"/>
									<span class="lbl"></span>
								</label>

							</div>
						</div>

						<div class="tools action-buttons">

						</div>
					</div>

			';
	 	}
	}

?>
