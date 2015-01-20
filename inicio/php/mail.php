<?php
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
  function envio_correoReservacion($correo,$tabla) {  
  // $]tabla=$_POST['tabla'];
    $acus='0';
  // $correo=$_POST['correo'];  
  $contenido_html =  '
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  
  <meta charset="utf-8" />

  <style type="text/css">
    .sm{
      width: 100%;
      height: 250px;
      text-align: center;
    }
  </style>
  <div class="sm">
    <img src="https://pbs.twimg.com/profile_images/433244544574832641/95i7f8n-.jpeg" width: "80%"">
  </div>
  <p>Hola, te saluda <em><strong>FABRICA IMBABURA</strong></em> '.$tabla.'<br>Accede a este link para realizar 
  tu pago y tu recervacion sea valida <a href="">AQUI</a>. </p>';

  $email = new email();
  if ( $email->enviar( $correo , 'FABRICA IMBABURA' , 'RESERVACION FABRICA IMBABURA' ,  $contenido_html ) )
    // mensaje enviado
     $acus='1';
  else
  {
     // echo 'El mensaje no se pudo enviar ';
     // $email->ErrorInfo;
     $acus='2';
  }
  return $acus;
}
?>