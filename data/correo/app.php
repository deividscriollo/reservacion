<?php
if(!isset($_SESSION))
	{
		session_start();		
	}

require('../../../admin/class.php');
$class=new constante();
$acu=0;
$id=$class->idz();

//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
$resultado=$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
                                                    "','CORREO MASIVO','".
                                                    $_SESSION['id'].
                                                    "','SEG.USUARIO','PASSWORD','".$_SESSION['id']."','".
                                                    $class->fecha_hora().
                                                    "','ENVIO CORREO MASIVO')");
if (!$resultado) 
	$acu=1;
else 
	$acu=0;


if($acu==0){
require '../../../utilidades/PHPMailer/PHPMailerAutoload.php';
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

$contenido_html =  '<style type="text/css">
	.sm{
		width: 100%;
		height: 250px;
		text-align: center;
	}
</style>
<div class="sm">
	<img src="https://pbs.twimg.com/profile_images/433244544574832641/95i7f8n-.jpeg" width: "100%"">
</div>
'.$_POST['html'];

$email = new email();
if ( $email->enviar( $_POST['correo'] , 'FABRICA IMBABURA' , 'PUBLICIDAD INFORMATIVA' ,  $contenido_html ) )
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