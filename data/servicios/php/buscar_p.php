<?php 
require('../../../admin/class.php');
	$class=new constante();
	$pos=$_POST['pos'];
	$id=$_POST['id'];
	$resultado = $class->consulta("SELECT * FROM SERVICIOS WHERE STADO='1' and id='$id'");
	while ($row=$class->fetch_array($resultado)) {		
		if ($row[$pos]=='1') {
			print('OK');
		}elseif ($row[$pos]!='1') {
			print($row[$pos]);
		}
 	}
?>