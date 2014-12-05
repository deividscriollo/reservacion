<?php
require('../../admin/class.php');
$class=new constante();
$acu=0;
$id=$class->idz();

$resultado = $class->consulta("INSERT INTO SEG.USUARIO VALUES('".$id
																	."','".$_POST['txt_1'].
                                  "','".'0900000000'.
																	"','".$_POST['txt_2'].
																	"',md5('".$_POST['txt_3'].
																	"'),'".$class->fecha_hora().
																	"','".'0'.
																	"')");

//ID !! PROCESOS !! USUARIO !! TABLA !! CAMPO !! ID REGISTRO !! FECHA !! OTROS
$class->consulta("INSERT INTO SEG.AUDITORIA VALUES('".$class->idz().
                                                    "','INSERT','".
                                                    $id.
                                                    "','SEG.USUARIO','TODOS','".$id."','".
                                                    $class->fecha_hora().
                                                    "','REGISTRO CUENTA USUARIO')");
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

$contenido_html =  '<p>Hola, te saluda <em><strong>FABRICA IMBABURA</strong></em> te has regristrado y te pedimos 
que actives tu cuenta accediendo <a href="http://localhost/reservacion/inicio/activacion.php?id='.$id.'">AQUI</a>. </p>';

$email = new email();
if ( $email->enviar( $_POST['txt_2'] , 'FABRICA IMBABURA' , 'PROCESO DE REGISTRO' ,  $contenido_html ) )
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

