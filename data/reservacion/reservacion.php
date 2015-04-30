<?php 
	if(!isset($_SESSION))
	{
		session_start();		
	}
	require('../../admin/class.php');
	require('../../inicio/php/mail.php');
	$class=new constante();
	if (isset($_POST['obj_informacion'])) {
		$resultado = $class->consulta(" SELECT CASE 
										WHEN P.ID='20150326104209551428d175961' THEN upper('nacional')
										ELSE upper('extranjero')
										END 
										FROM SEG.USUARIO U, SEG.INFO I, LOCALIZACION.PAIS P WHERE I.ID_USUARIO=U.ID AND I.PAIS=P.ID AND U.ID='$_SESSION[id]'");
		while ($row=$class->fetch_array($resultado)) {				
			// para nacionales
			if ($row[0]=='NACIONAL') {
				$res = $class->consulta("SELECT CEDULA,NOMBRE,FONO,CONVENCIONAL,SEXO,upper(nom_pais) AS PAIS,CORREO,P.NOM_PAIS||', '||PRO.NOM_PROVINCIA||', '||C.NOM_CIUDAD as localidad,DIRECCION,CASE 
										 WHEN P.ID='20150326104209551428d175961' THEN upper('nacional')
										 ELSE upper('extranjero')
										 END ,*
										 FROM SEG.USUARIO U, SEG.INFO I, LOCALIZACION.PAIS P, LOCALIZACION.PROVINCIA PRO,LOCALIZACION.CIUDAD C 
										 WHERE U.ID_CIUDAD=C.ID AND PRO.ID=C.ID_PROVINCIA AND I.ID_USUARIO=U.ID AND I.PAIS=P.ID AND PRO.ID_PAIS=P.ID AND U.ID='$_SESSION[id]' ");
				while ($row1=$class->fetch_array($res)) {
					print '<h3 class="header smaller lighter purple pull-rigth">
								Información
								<small>CLIENTE</small>
							</h3>
							<div class="row-fluid" >
								<blockquote>
									<p>'.$row1[1].'</p>

									<p>
										C.I.: '.$row1[0].'
									</p>
								</blockquote>
							</div>

							<address>
								<strong>Nacionalidad: '.$row[0].', Localización</strong>

								<br />
								'.$row1[7].'
								<br />
								'.$row1[8].'
								<br />
								<abbr title="Phone">Teléfonos: <i class="icon-mobile-phone green"></i> '.$row1['fono'].', <i class="icon-phone orange"></i> '.$row1['convencional'].'</abbr>
														
							</address>

							<address>
								<strong>Correo Electrónico</strong>

								<br />
								<a href="mailto:#">'.$row1['correo'].'</a>
							</address>';	
				}
			// para internacionales
			}else{
				$res = $class->consulta("SELECT CEDULA,NOMBRE,FONO,CONVENCIONAL,SEXO,upper(nom_pais) AS PAIS,CORREO,CASE 
									WHEN P.ID='20150326104209551428d175961' THEN upper('nacional')
									ELSE upper('extranjero')
									END AS NACIONALIDAD
									FROM SEG.USUARIO U, SEG.INFO I, LOCALIZACION.PAIS P WHERE I.ID_USUARIO=U.ID AND I.PAIS=P.ID AND U.ID='$_SESSION[id]'");
				while ($row1=$class->fetch_array($res)) {
					print '<h3 class="header smaller lighter purple pull-rigth">
								Información
								<small>CLIENTE</small>
							</h3>
							<div class="row-fluid" >
								<blockquote>
									<p>'.$row1[1].'</p>

									<p>
										C.I.: '.$row1[0].'
									</p>
								</blockquote>
							</div>

							<address>
								<strong>Nacionalidad: '.$row[0].', Localización</strong>

								<br />
								'.$row1[5].'
								<br />
								Caranqui
								<br />
								<abbr title="Phone">Teléfonos: <i class="icon-mobile-phone green"></i> '.$row1[2].', <i class="icon-phone orange"></i> '.$row1[3].'</abbr>
														
							</address>

							<address>
								<strong>Correo Electrónico</strong>

								<br />
								<a href="mailto:#">'.$row1[6].'</a>
							</address>';	
				}
			}
		}
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
		$resultado = $class->consulta("SELECT * FROM SEG.USUARIO WHERE ID='$_SESSION[id]'");		
		while ($row=$class->fetch_array($resultado)) {					
			envio_correoReservacion($row['correo'],$tabla,$subtotal,$id);				
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
	if(isset($_POST['cargar_tipo'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT * FROM SEG.CATEGORIA_SERVICIO WHERE  STADO='1'");
			$acu=1;
			print'<option value>Tipo de reservación</option>';
			while ($row=$class->fetch_array($resultado)) {					
				print '<option value="'.$row[0].'">'.ucwords(strtolower($row[1])).'</option>';				
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
		$resultado = $class->consulta("SELECT * FROM servicios WHERE STADO='1'");
		print'<option value="">Seleccionar servicio</option>';
		while ($row=$class->fetch_array($resultado)) {			
			print'<option value="'.$row[0].'">'.ucwords(strtolower($row[1])).'</option>';	
	 	}
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
		if ($_POST['id']=='20141211160003548a05d39b5c8') {
			$resultado = $class->consulta("SELECT horai, horaf, dias, lapso FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO ='1';");
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
						// aculumador de horas
						for ($i=0;strtotime($horaInicial)<strtotime($horafinal);$i++) { 							
							//
							$acumu_horas=sumar_horas($horaInicial,$horalapso);
							$horaInicial=$acumu_horas;
							if (strtotime($horaInicial)<strtotime($horafinal)) {	
								$a=1;
								print'<tr><td><label><input type="checkbox" onclick="reconstruir('.$i.')"/><span class="lbl"></span></label></td><td>'.$horaInicial.'</td><td>'.sumar_horas($horaInicial,$horalapso).'</td><td>'.$_POST['f'].'</td><td>'.$dia.'</td></tr>';										
							}
							
						}

					}
				}				
			}
			if ($a!=1) {
					print 0;
				}
		}else{
			$resultado = $class->consulta("SELECT horai, horaf, dias, lapso FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO ='1';");
			$ak='';
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
						// aculumador de horas
						for ($i=0;strtotime($horaInicial)<strtotime($horafinal);$i++) { 							
							$acumu_horas=sumar_horas($horaInicial,$horalapso);
							$horaInicial=$acumu_horas;
							if (strtotime($horaInicial)<strtotime($horafinal)) {	
								$ak=1;
								print'<tr><td><label><input type="checkbox" onclick="reconstruir2('.$i.')"/><span class="lbl"></span></label></td><td>'.$horaInicial.'</td><td>'.sumar_horas($horaInicial,$horalapso).'</td><td>'.$_POST['f'].'</td><td>'.$dia.'</td></tr>';										
							}							
						}
					}
				}
			}
			if ($ak!=1) {
				print 0;
			}
		}
	}
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
