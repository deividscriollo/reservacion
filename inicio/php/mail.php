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
  function envio_correoReservacion($correo, $tabla, $subtotal) {  
  // $]tabla=$_POST['tabla'];
    $acus='0';
  // $correo=$_POST['correo'];  
  $contenido_html =  '<table width="100%" border="0" style="width: 90%;
        padding-top: 8px;
        padding-bottom: 15px;
        margin: 0 auto 20px auto;
        background: #3085C9;
         border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        color: #446bb3;">
    <tbody class="dc">
      <tr>
        <td align="center">
          <img src="https://raw.githubusercontent.com/deividscriollo/reservacion/master/data/assets/images/b.jpg" style="border-radius: 5px;">
        </td>
      </tr>
      <tr>
        <td style="color:#E1A401">RESERVACION, FABRICA IMBABURA</td>
      </tr>
      <tr>
        <td><table style="float: left;">
            <tbody style="color:#FFFFFF">
              <tr>
                <td style="color:#FFFFFF; font-size: 20px;">
                  Hola, para que tu reservación sea válida accedo aquí para realizar el pago respectivo de tu reservación 
                </td>
              </tr>
            </tbody>
          </table>'.$tabla.'
        </td>
      </tr>

      <tr><td align="center" style="color:#FFFFFF;">
          Realizar pago con 
          <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_cart&upload=1&business=deividscriollo@gmail.com&currency_code=USD&lc=US&item_name_1=RESERVACION&item_number_1=1&quantity_1=1&amount_1='.$subtotal.'&no_shipping_1=0&no_note_1=1">
          <img alt = "comprar ahora con PayPal" border = "0" src = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_buynow_pp_142x27.png" />
          </a>
      </td>
  </tr></tbody>
  </table>
  <script type="text/javascript">
  alert(hola mundo)
</script>
  ';
  $contenido_html=utf8_decode($contenido_html);

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

