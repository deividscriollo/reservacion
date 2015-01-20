<?php 
	if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	$class=new constante();

	if(isset($_POST['guardar'])) {
		// guardar:'ok',matriz:matriz,acu_fh:acu_fh,subtotal:lbl_subtotal
		$mat=$_POST['matriz'];		
		$horario=$_POST['horario'];
		$subtotal=$_POST['subtotal'];
		$fecha=$class->fecha_hora();
		$id=$class->idz();
		$sericio='';

		$res=$class->consulta("INSERT INTO RESERVACION VALUES('$id','$_SESSION[id]','$subtotal','$fecha','0')");
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
				// print('servicio:'.$servicios.'cantidad: '.$cantidad.'tor:'.$t.'precion_canti: '.$p_cantidad.'<br>');
				$res=$class->consulta("INSERT INTO RESERVACION_TARIFA VALUES('$ida','$id','$servicios','$cantidad','$p_cantidad','$t','$fecha','0')");			
		}		
		for ($i=0; $i <count($horario); $i++) {
			$idb=$class->idz(); 			
			$hi=$horario[$i][0];
			$hf=$horario[$i][1];
			$f=$horario[$i][2];
			$d=$horario[$i][3];
			$res=$class->consulta("INSERT INTO RESERVACION_HORARIOS VALUES('$idb','$id','$hi','$hf','$f','$d','$fecha','0')");
		}
		if (!$res) {
			print 1;
		}else print 0;

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
		//$pos=$_POST['pos'];	
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
		
?>
