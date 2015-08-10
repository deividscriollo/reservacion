<?php 
if(!isset($_SESSION))
	{
		session_start();
	}
	require('../../../admin/class.php');
	$class=new constante();

	if (isset($_POST['cambiar_id'])) {
		$_SESSION["id_servicio"]=$_POST['id_servicio'];
	}
	if (isset($_POST['sacar_id'])) {
		print$_SESSION["id_servicio"];	
	}
	if (isset($_POST['campos_servicios'])) {
		$resultado = $class->consulta("SELECT * FROM SERVICIOS WHERE ID='$_POST[id]' AND STADO='1'");
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[2];
			$acu[]=$row[3];
			$acu[]=$row[4];
			$acu[]=$row[5];
			$acu[]=$row[6];
			$acu[]=$row[7];
			$acu[]=$row[8];
			$acu[]=$row[9];
		}
		print_r(json_encode($acu));
	}
	if (isset($_POST['modificar_categorias_1'])) {
		$resultado = $class->consulta("SELECT * FROM SEG.CATEGORIA_SERVICIO WHERE ID='$_POST[id]' AND STADO='1'");
		$acu;
		while ($row=$class->fetch_array($resultado)) {
			$acu[]=$row[1];
			$acu[]=$row[3];
		}
		print_r(json_encode($acu));
	}
	if (isset($_FILES['file_img']['name'])) {		
	 	$id=$class->idz();
	 	$fecha=$class->fecha_hora();

	 	$allowed =  array('gif','png' ,'jpg');
		$filename = $_FILES['file_img']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
	    //obtenemos el archivo a subir
	    $file = $_FILES['file_img']['name'];
	    $localizacion='../img/'.$id.'.'.$ext;
	    //comprobamos si existe un directorio para subir el archivo	       
	    //comprobamos si el archivo ha subido
	    if ($file && move_uploaded_file($_FILES['file_img']['tmp_name'],$localizacion))
	    {
	        $result=$class->consulta("UPDATE SERVICIOS  SET NOMIMG='$localizacion' WHERE ID='$_POST[txt_id_servicio]'");
		    if (!$result) {
		    	print'0';
		    }else
		    print'1'.';'.$localizacion;
	    }
	}
	if (isset($_POST['lbl_servicio'])) {
		$class->consulta("UPDATE SERVICIOS  SET NOM='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_categoria'])) {
		$class->consulta("UPDATE SEG.CATEGORIA_SERVICIO  SET NOM=upper('$_POST[value]') WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_horario'])) {
		print $class->consulta("UPDATE SERVICIOS  SET FORMATO='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_iva'])) {
		$class->consulta("UPDATE SERVICIOS  SET IMPUESTO='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_porcentaje'])) {
		$class->consulta("UPDATE SERVICIOS  SET PORCENTAJE='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_capacidad'])) {
		$class->consulta("UPDATE SERVICIOS  SET CAPACIDAD='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_descripcion'])) {
		$class->consulta("UPDATE SERVICIOS  SET DESCRIPCION='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_stado'])) {
		$class->consulta("UPDATE SERVICIOS  SET STADO1='$_POST[value]' WHERE ID='$_POST[id]'");
	}
	if (isset($_POST['lbl_stado_categoria'])) {
		$class->consulta("UPDATE SEG.CATEGORIA_SERVICIO  SET STADO1='$_POST[value]' WHERE ID='$_POST[id]'");
	}

?>