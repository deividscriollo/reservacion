<?php 
require('../../../admin/class.php');
	$class=new constante();
	$pos=$_POST['pos'];
	$id=$_POST['id'];
	$resultado = $class->consulta("SELECT * FROM SERVICIOS WHERE STADO='1' and id='$id'");
	while ($row=$class->fetch_array($resultado)) {		
		
		if ($pos=='2') {
			$acu=split(';', $row[2]);
			
			$alert=array(0 => "orange", 1 => "pink", 2 => "green",3 => "blue",4 => "red",5=>"red");
			for ($i=0; $i < count($acu); $i++) { 
				$ran=mt_rand(0,5);
				if ($i%2==0) 
					print('<div class="alert alert-info "><i class="icon-spinner icon-spin '.$alert[$ran].'" bigger-125"></i> 
						<i class="icon-angle-right green"></i> '.$acu[$i].'</div>');
				else
					print('<div class="alert alert-success "><i class="icon-spinner icon-spin '.$alert[$ran].'" bigger-125"></i> 
						<i class="icon-angle-right blue"></i> '.$acu[$i].'</div>');

			}						
		
		}else{
			print($row[$pos]);
		}
 	}
?>