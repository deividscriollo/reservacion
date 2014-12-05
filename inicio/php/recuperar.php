<?php
require('../../admin/class.php');
$class=new constante();
$acu=0;
$id=$class->idz();
$valor="";
$nombre="";
$resultado=$class->consulta("SELECT * FROM SEG.USUARIO WHERE CORREO='".$_POST['txt_1']."'");
while ($row=$class->fetch_array($resultado)) {
                       
    //valores a consumir                      
    $valor = $row[0];
    $nombre =$row[1];
    
}

//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
$resultado=$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
                                                    "','SELECT','".
                                                    $valor.
                                                    "','SEG.USUARIO','PASSWORD','".$valor."','".
                                                    $class->fecha_hora().
                                                    "','RECUPERAR CONTRASEÑA')");
if (!$resultado) 
	$acu=1;
else 
	$acu=0;


if($acu==0){
require '../../utilidades/PHPMailer/PHPMailerAutoload.php';
/**
* Clase email que se extiende de PHPMailer
*/
class email  extends PHPMailer{

    //datos de remitente
    var $tu_email = 'deividscriollo@gmail.com';
    var $tu_nombre = 'FABRICA IMBABURA';
    var $tu_password ='CROnos_1021';

    /**
 * Constructor de clase
 */
    public function __construct()
    {
      //configuracion general
     $this->IsSMTP(); // protocolo de transferencia de correo
     $this->Host = 'smtp.gmail.com';  // Servidor GMAIL
     $this->Port = 465; //puerto
     $this->SMTPAuth = true; // Habilitar la autenticación SMTP
     $this->Username = $this->tu_email;
     $this->Password = $this->tu_password;
     $this->SMTPSecure = 'ssl';  //habilita la encriptacion SSL
     //remitente
     $this->From = $this->tu_email;
    $this->FromName = $this->tu_nombre;
    }

    /**
 * Metodo encargado del envio del e-mail
 */
    public function enviar( $para, $nombre, $titulo , $contenido)
    {
       $this->AddAddress( $para ,  $nombre );  // Correo y nombre a quien se envia
       $this->WordWrap = 50; // Ajuste de texto
       $this->IsHTML(true); //establece formato HTML para el contenido
       $this->Subject =$titulo;
       $this->Body    =  $contenido; //contenido con etiquetas HTML
       $this->AltBody =  strip_tags($contenido); //Contenido para servidores que no aceptan HTML
       //envio de e-mail y retorno de resultado
       return $this->Send() ;
   }

}//--> fin clase

/* == se emplea la clase email == */

$contenido_html =  '
<h2>Estimado '.$nombre.'</h2>
<p>Hola, te saluda <em><strong>FABRICA IMBABURA</strong></em> Para reiniciar tu contraseña, por favor has click: <a href="http://localhost/reservacion/inicio/recuperar.php?id='.$valor.'">AQUI</a>.</p>';

$email = new email();
if ( $email->enviar( $_POST['txt_1'] , 'FABRICA IMBABURA' , 'RECUPERACION DE CONTRASEÑA' ,  $contenido_html ) )
   print '1';
else
{
   print'0';
   $email->ErrorInfo;
}
}else{
	print('2');
}

?>

