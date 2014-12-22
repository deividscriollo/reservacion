<?php 
require('../../admin/class.php');
$class=new constante();
//obtencion d campos usuario y password
if (isset($_POST['pais'])) {
	$resultado = $class->consulta("SELECT ID, NOM_PAIS FROM LOCALIZACION.PAIS WHERE STADO='1'");
		$existencia=1;
		$sum="{";		
		$i=0;		
		while($row = $class->fetch_array($resultado)){			
			if ($i%2==0) {
				$sum=$sum.'"'.$row[0].'"'.':'.'"'.$row[1].'",';
			};
			if ($i%2!=0) {
				$sum=$sum.'"'.$row[0].'"'.':'.'"'.$row[1].'"';
			}			
		}
		$sum=substr($sum, 0, -1);
		$sum=$sum."}";
	echo $sum;
}
if (isset($_POST['pro'])) {
	$pais=$_POST['registro'];
	$resultado = $class->consulta("SELECT PRO.ID, PRO.NOM_PROVINCIA FROM LOCALIZACION.PAIS P, LOCALIZACION.PROVINCIA PRO WHERE P.ID=PRO.ID_PAIS AND P.ID='$pais' AND PRO.STADO='1'");	
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			print'<option value="'.$row[0].'">'.$row[1].'</option>';
	}
}
if (isset($_POST['c'])) {
	print $pro=$_POST['registro'];
	$resultado = $class->consulta("SELECT C.ID, C.NOM_CIUDAD FROM LOCALIZACION.PROVINCIA PRO, LOCALIZACION.CIUDAD C WHERE PRO.ID=C.ID_PROVINCIA AND PRO.ID='$pro' AND C.STADO='1'");	
	while ($row=$class->fetch_array($resultado)) {
			$existencia=1;			
			print'<option value="'.$row[0].'">'.$row[1].'</option>';
	}
}

?>
