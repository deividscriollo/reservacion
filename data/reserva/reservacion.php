<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();

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
                                                                    "','".'Cliente'.
                                                                    "','".$class->fecha_hora().
                                                                    "','".'1'.
                                                                    "')");
        print '1';
	}
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
		$res=$class->consulta("INSERT INTO RESERVACION VALUES('$id','$_POST[id_cliente]','$id_ser','$subtotal','$fecha','0')");
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

				$res=$class->consulta("INSERT INTO RESERVACION_TARIFA VALUES('$ida','$id','$servicios','$p_cantidad','$cantidad','$t','$fecha','0')");			
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
		$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='$_POST[id_cliente]'");		
		while ($row=$class->fetch_array($resultado)) {					
			//envio_correoReservacion($row['correo'],$tabla,$subtotal,$id);				
	 	}


	}
	if(isset($_POST['obj_tarifa'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT nom_tarifa, precio FROM SERVICIOS S, TARIFA T, SEG.CATEGORIA_SERVICIO C WHERE
 S.ID=T.ID_SERVICIO AND T.ID_CATEGORIA=C.ID AND S.ID='$_POST[id]' AND C.ID='$_POST[tipo]' AND T.STADO ='1';");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print $row[0].','.$row[1].',';				
		 	}
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
	if (isset($_POST['mostrar_clientes'])) {
		$resultado = $class->consulta("SELECT CEDULA,NOMBRE,FONO,DIRECCION,U.ID,upper(P.NOM_PAIS),CASE 
													WHEN P.ID='20150326104209551428d175961' 
														THEN 'NACIONAL' 
														ELSE 'EXTRANJERO' 
													END
										FROM SEG.USUARIO U,SEG.NIVEL N, SEG.INFO I, LOCALIZACION.PAIS P 
										WHERE I.ID_USUARIO=U.ID AND I.PAIS=P.ID AND NIVEL='CLIENTE' AND N.ID_USUARIO=U.ID  AND U.STADO='1'");		
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
	if (isset($_POST['llenar_clientes_datos'])) {

		$resultado = $class->consulta("SELECT CEDULA,NOMBRE,FONO,DIRECCION, ID FROM SEG.USUARIO  WHERE ID='".$_POST['id']."'");				
		while ($row=$class->fetch_array($resultado)) {					
			$acu[]=$row[0];
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]=$row[5];
	 	}
	 	print_r(json_encode($acu));
	}
	if(isset($_POST['cargar_tipo'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM SEG.CATEGORIA_SERVICIO WHERE  STADO='1'");
			$acu=1;
			print'<option value="">Tipo de reservación</option>';
			while ($row=$class->fetch_array($resultado)) {					
				print '<option value="'.$row[0].'">'.$row[1].'</option>';				
		 	}
	}
	if(isset($_POST['cargar_servicios'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM SERVICIOS WHERE  STADO='1'");
			$acu=1;
			print'<option value="">Seleccione Servicio</option>';
			while ($row=$class->fetch_array($resultado)) {					
				print '<option value="'.$row[0].'">'.$row[1].'</option>';				
		 	}
	}
	if(isset($_POST['mostrar_galeria'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM SERVICIOS S WHERE  S.ID='$_POST[id]' ");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print '<ul class="ace-thumbnails">
						<li>
							<a href="../servicios/img/'.$row[4].'" data-rel="colorbox" class="cboxElement">
								<img alt="150x150" src="../servicios/img/'.$row[4].'">
								<div class="text">
									<div class="inner">'.$row[1].'</div>
								</div>
							</a>
						</li>
					</ul>';				
		 	}
	}
	if(isset($_POST['mostrar_galeria'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM SERVICIOS S WHERE  S.ID='$_POST[id]' ");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print '<ul class="ace-thumbnails">
						<li>
							<a href="../servicios/img/'.$row[4].'" data-rel="colorbox" class="cboxElement">
								<img alt="150x150" src="../servicios/img/'.$row[4].'">
								<div class="text">
									<div class="inner">'.$row[1].'</div>
								</div>
							</a>
						</li>
					</ul>';				
		 	}
	}
	if(isset($_POST['mostrar_descripcion'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM SERVICIOS S WHERE  S.ID='$_POST[id]' ");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print '<div class="pull-left alert alert-success inline no-margin">
							<button type="button" class="close" data-dismiss="alert">
								<i class="icon-remove"></i>
							</button>

							<i class="icon-umbrella bigger-120 blue"></i>
							'.$row[2].'
						</div>';				
		 	}
	}
	if(isset($_POST['mostrar_otros'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM SERVICIOS S WHERE  S.ID='$_POST[id]' ");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print '<div class="pull-left alert alert-success inline no-margin">
							<button type="button" class="close" data-dismiss="alert">
								<i class="icon-remove"></i>
							</button>

							<i class="icon-umbrella bigger-120 blue"></i>
							'.$row[3].'
						</div>';			
		 	}
	}
	
	if (isset($_POST['buscar_servicio'])) {
		//$pos=$_POST['pos'];	
		$reg=$_POST['registro'];
		$reg=strtoupper($reg);
		$resultado = $class->consulta("SELECT * FROM servicios WHERE NOM like'%$reg%' AND STADO='1' limit 8 offset 0");
		$a=0;
		print'<div class="row-fluid">';
		while ($row=$class->fetch_array($resultado)) {			
			print'<div class="span3">
						<ul class="ace-thumbnails">											
							<li>
								<div data-rel="colorbox">
									<img alt="150x150" src="../servicios/img/'.$row[4].'">
									<div class="text">
										<div class="inner">'.$row[1].'</div>
									</div>
								</div>

								<a class="tools tools-bottom" id="ob_dc_seleccion">
									<div onclick=btn_select_servicio("'.$row[0].'")>
										<i class="icon-share-alt"></i>
									</div>
								</a>
							</li>																			
						</ul>
				</div>';
			if ($a==3) {
				print'</div><div class="hr hr-18 "></div><div class="row-fluid">';	
			}
			$a++;	
	 	}
	 	print'</div>';
	}
	if(isset($_POST['buscar_inf_serv_h'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT DIAS, HORAi, HORAF FROM SERVICIOS S, HORARIO_SERVICIOS H
		WHERE S.ID=H.ID_SERVICIO AND S.ID='$_POST[id]' AND H.STADO ='1'");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print'<tr><td>'.$acu++.'</td><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td></tr>';			
		 	}
	}
	if(isset($_POST['buscar_inf_serv_h2'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT nom_tarifa, precio, C.NOM,* FROM SERVICIOS S, TARIFA T, SEG.CATEGORIA_SERVICIO C WHERE
 S.ID=T.ID_SERVICIO AND T.ID_CATEGORIA=C.ID AND S.ID='$_POST[id]' AND C.ID='$_POST[tipo]' AND T.STADO ='1';");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {
				$x=number_format($row[1],2);
				print'<tr><td>'.$acu++.'</td><td>'.$row[2].'</td><td>'.$row[0].'</td><td class="text-error"> $ '.$x.'</td></tr>';		
		 	}
	}
	if(isset($_POST['buscar_horas'])) {
		$dia=$_POST['dia'];
		$sum=0;
		$a='';
		$resultado = $class->consulta("SELECT horai, horaf, dias, lapso FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO ='1';");				
		while ($row=$class->fetch_array($resultado)) {
			$encontrar=1;							
			$acu=split(",", $row[2]);				
			for ($i=0; $i < count($acu); $i++) {
				$dc=strtoupper((String)$acu[$i]);
				if((string)$dc==$dia){						
					
					$b=split(":", $row[0]);
					$c=split(":", $row[1]);
					$d=split(":", $row[3]);					
					if ($sum==0) {
						$max_i=0;
						$horaInicial=$b[0].':'.$b[1];
						$dc_sum=0;
						for ($i=$b[0]; $i < 20; $i++) {
							if ($max_i==0)
							$horaInicial=$b[0].':'.$b[1];
							$minutoAnadir=($d[0]*60)+$d[1];
							$segundos_horaInicial=strtotime($horaInicial);
							$segundos_minutoAnadir=$minutoAnadir*60;
							$nuevaHora=date("H:i",$segundos_horaInicial+$segundos_minutoAnadir);
							if ($max_i==0) {								
								if (buscar_horario($horaInicial,$nuevaHora)==0) {
									print'<tr><td><label><input type="checkbox" onclick="reconstruir(0)"/><span class="lbl"></span></label></td><td>'.$horaInicial.'</td><td>'.$nuevaHora.'</td><td>'.$_POST['f'].'</td><td>'.$dia.'</td></tr>';										
								}
							};
							if ($max_i>=0){
								$sb=buscar_horario($horaInicial,$nuevaHora);
								if($sb==0) {
									$dc_sum=$dc_sum+1;
									print'<tr><td><label><input type="checkbox" onclick="reconstruir('.$dc_sum.')"/><span class="lbl"></span></label></td><td>'.$horaInicial.'</td><td>'.$nuevaHora.'</td><td>'.$_POST['f'].'</td><td>'.$dia.'</td></tr>';	
								}
							}
							$horaInicial=$nuevaHora;							
							$max_i++;
							$n=split(':',$horaInicial);
							$n[0];
							$c[0]-2;
							if($n[0]>=$c[0]){break;}
						}
					}
					$sum=1;											
				}
			}		
		}
		if ($sum==1) {
			print($a);
		}else print('NO DISPONEMOS HORARIOS EN ESTE DIA');
	}
function buscar_horario($inicio,$fin){
	$a=0;
	print('gb'.$inicio.$fin);
	$class=new constante();
	$resultado = $class->consulta("SELECT * FROM RESERVACION_HORARIOS WHERE hinicio='$inicio' and hfin='$fin' AND STADO='0'");
	while ($row=$class->fetch_array($resultado)) {		
		$a=1;		
	}
	return $a;
}	
?>
