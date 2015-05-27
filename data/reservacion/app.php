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
		while ($row=$class->fetch_array($resultado)) {
			print'<option value="'.$row[0].'">'.$row[1].'</option>';		
		}
	}
?>
