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
   public function edad($fecha){
    $dias = explode("-", $fecha, 3);
    $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
    $edad = (int)((time()-$dias)/31556926 );
    return $edad;
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


  