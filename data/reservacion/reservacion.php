<?php 
	require('../../admin/class.php');
	$class=new constante();

	if(isset($_POST['obj_tarifa'])) {
		//$pos=$_POST['pos'];			
		$resultado = $class->consulta("SELECT nom_tarifa, precio FROM SERVICIOS S, TARIFA T
										WHERE S.ID=T.ID_SERVICIO AND S.ID='$_POST[id]' AND T.STADO ='1';");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print $row[0].','.$row[1].',';
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
							<i class="icon-zoom-in bigger-130 blue pointer"></i>
							</a>
					</div>'.'</td></tr>';			
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
		$resultado = $class->consulta("SELECT nom_tarifa, precio FROM SERVICIOS S, TARIFA T
										WHERE S.ID=T.ID_SERVICIO AND S.ID='$_POST[id]' AND T.STADO ='1';");
			$acu=1;
			while ($row=$class->fetch_array($resultado)) {					
				print'<tr><td>'.$acu++.'</td><td>'.$row[0].'</td><td>'.$row[1].'</td></tr>';		
		 	}
	}
	if(isset($_POST['buscar_horas'])) {
		$dia=$_POST['dia'];
		$sum=0;
		$a='';
		$resultado = $class->consulta("SELECT horai, horaf, dias FROM HORARIO_SERVICIOS WHERE ID_SERVICIO='$_POST[id]' AND STADO ='1';");				
		while ($row=$class->fetch_array($resultado)) {
			$encontrar=1;							
			$acu=split(",", $row[2]);				
			for ($i=0; $i < count($acu); $i++) {
				$dc=strtoupper((String)$acu[$i]);
				if((string)$dc==$dia){						
					$b=split(":", $row[0]);
					$c=split(":", $row[1]);
					$a=$b[0].','.$c[0];
					$sum=1;											
				}
			}		
		}
		if ($sum==1) {
			print($a);
		}else print('n');
	}	
?>
