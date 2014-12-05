<?php   
include_once("conex.php");
include("constante.php");
class constante
{
   private $login;
   private $contrasena;
   private $cedula;
   private $tipo;
   private $status;
   
   
   public function consulta($q)
   {      
      $BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);//declarar el objeto de la clase base de dato
      $result=$BaseDato->Consultas($q);
      return $result;
   }
   public function fetch_array($consulta){
      return pg_fetch_array($consulta);
     }

     public function num_rows($consulta){
      return pg_num_rows($consulta);
     }

     public function getTotalConsultas(){
      return $this->total_consultas; 
     }
   public function sqlcon($q)
   {      
      $BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);//declarar el objeto de la clase base de dato     
      $result=$BaseDato->Consultas($q);          
      if(pg_affected_rows($result)>=0)
      return 1;
      else
      return 0;
   }
   //generador de id unicos
    function idz(){
      date_default_timezone_set('America/Guayaquil');
      $fecha=date("YmdHis");
      return($fecha.uniqid());  
    }

   function client_ip() {
      $ipaddress = '';
      if ($_SERVER['HTTP_CLIENT_IP'])
          $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
      else if($_SERVER['HTTP_X_FORWARDED_FOR'])
          $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
      else if($_SERVER['HTTP_X_FORWARDED'])
          $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
      else if($_SERVER['HTTP_FORWARDED_FOR'])
          $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
      else if($_SERVER['HTTP_FORWARDED'])
          $ipaddress = $_SERVER['HTTP_FORWARDED'];
      else if($_SERVER['REMOTE_ADDR'])
          $ipaddress = $_SERVER['REMOTE_ADDR'];
      else
          $ipaddress = 'UNKNOWN';
      return $ipaddress;
  }
   public function idx($TABLA)
   {             
      $acu=1;
      $BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);//declarar el objeto de la clase base de dato
      $query="SELECT * FROM ".$TABLA;  
      $result=$BaseDato->Consultas($query);
      $row = pg_fetch_array ($result, 0);  
      while($row= pg_fetch_array($result))
      {
         $acu=$acu+1;
      }     
      return $acu; 
   }
   //Verificar la existencia de un registro X
   public function existenciap($CAMPO,$TABLA,$REGISTRO,$id_proveedor)
   {  
      $h=0;
      $BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);//declarar el objeto de la clase base de dato
      $query="SELECT nom_producto FROM producto WHERE nom_producto='$REGISTRO' and id_proveedor=$id_proveedor";  
      $resultado=$BaseDato->Consultas($query);
      while($row= pg_fetch_array($resultado))
      {
         $h=1;
      }
      return $h;
   }
   //Verificar la existencia de un registro X
   public function registrox($CAMPO,$TABLA,$REGISTRO)
   {  
      $valor="hola";
      $BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);//declarar el objeto de la clase base de dato
      $query="SELECT $CAMPO FROM ".$TABLA." WHERE $CAMPO='$REGISTRO'";  
     while ($row=$BaseDato->fetch_array($query)) {            
           //$valor=$row[$CAMPO];
      $valor1='hola';
     }
     return $valor;
   }
   //Verificar la existencia de un registro X
   public function acceso_usu($USU,$PASS)
   {  
      $BaseDato=new BaseDeDato(SERVIDOR,PUERTO,BD,USUARIO,CLAVE);//declarar el objeto de la clase base de dato
      $query="SELECT * FROM USUARIO WHERE USUARIO='$USU' and PASSSWORD='$PASS'";  
      $resultado=$BaseDato->Consultas($query);
      $Datos=@pg_fetch_all($resultado);//Devuelve los datos en forma de arreglo
      $filas=pg_num_rows($resultado);       
      return $filas;//If res = 1 => Ok
   }
   
  

   public function fecha(){
     $fecha=date("d-m-Y");
     return $fecha;
    } 
    public function fecha_hora(){
    date_default_timezone_set('America/Guayaquil');
    $fecha=date("Y-m-d H:i:s");
    return $fecha;
    } 
   public function fecha2(){
     $fecha=date("Y-m-d");
     return $fecha;
    } 
}
?>


  