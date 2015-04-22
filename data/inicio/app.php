<?php 
if(!isset($_SESSION))
	{
		session_start();		
	}
require('../../admin/class.php');
$class=new constante();	
$nombre='';
if (isset($_POST['name'])) {
	$nombre=$_POST['name'];
}
if ($nombre=='txt_fna') {
	$acu=$class->consulta("UPDATE SEG.USUARIO   SET EDAD='$_POST[value]' WHERE ID='$_SESSION[id]'");
}
if ($nombre=='txt_telefono') {
	$acu=$class->consulta("UPDATE SEG.USUARIO   SET FONO='$_POST[value]' WHERE ID='$_SESSION[id]'");
}
if ($nombre=='txt_convencional') {
	$acu=$class->consulta("UPDATE SEG.INFO   SET CONVENCIONAL='$_POST[value]' WHERE ID_USUARIO='$_SESSION[id]'");
}
if ($nombre=='txt_direccion') {
	$acu=$class->consulta("UPDATE SEG.USUARIO   SET DIRECCION='$_POST[value]' WHERE ID='$_SESSION[id]'");
}

if (isset($_POST['verificar_edad'])) {
	$resultado=$class->consulta("SELECT extract(year from age(now(),edad)) FROM SEG.USUARIO WHERE ID='$_SESSION[id]'");
	while ($row=$class->fetch_array($resultado)) {
		print$row[0];
	}
}
if (isset($_POST['buscar_pro'])) {
	$resultado=$class->consulta("SELECT * FROM LOCALIZACION.PROVINCIA WHERE ID_PAIS='20150326104209551428d175961'");
	$acu;
	while ($row=$class->fetch_array($resultado)) {		
		$arr = array('id' => $row[0], 'text' => $row[2]);
		$acu[]=$arr;
	}
	print_r(json_encode($acu));
}
if (isset($_POST['buscar_ciu'])) {
	$resultado=$class->consulta("SELECT * FROM LOCALIZACION.CIUDAD WHERE ID_PROVINCIA='$_POST[id]'");
	$acu;
	while ($row=$class->fetch_array($resultado)) {		
		$arr = array('id' => $row[0], 'text' => $row[2]);
		$acu[]=$arr;
	}
	print_r(json_encode($acu));
}
if (isset($_POST['guardar_ciudad'])) {
	if ($_POST['id_act_ciu']!='true') {
		$acu=$class->consulta("UPDATE SEG.USUARIO  SET ID_CIUDAD='$_POST[id_act_ciu]' WHERE ID='$_SESSION[id]'");	
	}
	
}
if (isset($_FILES['file_img']['name'])) {		
 	$id=$class->idz();
 	$fecha=$class->fecha_hora();

 	$allowed =  array('gif','png' ,'jpg');
	$filename = $_FILES['file_img']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
    //obtenemos el archivo a subir
    $file = $_FILES['file_img']['name'];
    $localizacion="img/".$id.'.'.$ext;
    //comprobamos si existe un directorio para subir el archivo
    //si no es así, lo creamos
    if(!is_dir("img/")) 
        mkdir("img/", 0777);     
    //comprobamos si el archivo ha subido
    if ($file && move_uploaded_file($_FILES['file_img']['tmp_name'],$localizacion))
    {
       $result=$class->consulta("INSERT INTO SEG.IMG  VALUES ('$id','$_SESSION[id]','$localizacion','$fecha','1')");
	    if (!$result) {
	    	print'0';
	    }else
	    print'1'.';'.$localizacion;
    }
}

?>