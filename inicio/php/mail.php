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
  function envio_correoReservacion($correo, $tabla, $subtotal,$id) {
    // $]tabla=$_POST['tabla'];
    $link='https://www.paypal.com/cgi-bin/webscr?cmd=_cart&upload=1&business=deividscriollo@gmail.com&currency_code=USD&lc=US&item_name_1=RESERVACION&item_number_1=1&quantity_1=1&amount_1='.$subtotal.'&no_shipping_1=0&no_note_1=1';
      $acus='0';
    // $correo=$_POST['correo'];
    $contenido_html =  '
      <table width="100%" border="0" style="width: 90%;
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
            <td style="color:#E1A401">RESERVACIÓN, FÁBRICA IMBABURA</td>
          </tr>
          <tr>
            <td><table style="float: left;">
                <tbody style="color:#FFFFFF">
                  <tr>
                    <td style="color:#FFFFFF; font-size: 15px;">
                      Estimado/a, para que su reservación sea válida haga clic en los botones de forma de pago que mas le convenga, tenga en cuenta que su reservación tiene una vigencia de 48 horas, después de ese lapso se cancelara automáticamente.
                    </td>
                  </tr>
                </tbody>
              </table>'.$tabla.'
            </td>
          </tr>
          <tr><td align="center" style="color:#FFFFFF;">
              <a href="http://localhost/reservacion/data/paypal/index.php?paypal=ok&id='.$id.'" style="color: #FFFFFF; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #057EC5; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color:#E2A500;">PayPal</a>
              <a href="http://localhost/reservacion/data/reserva_banco/index.php?banco=ok&id='.$id.'" style="color: #FFFFFF; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #BE4A36; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #BE4A36">Depósitos Bancarios</a>
              <a href="http://localhost/reservacion/data/tarjeta/index.php?targeta=ok&id='.$id.'" style="color: #FFFFFF; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #89B019; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #89B019">Tarjeta de Crédito</a>
          </td>
      </tr></tbody>
      </table>
    ';
    $contenido_html=utf8_decode($contenido_html);
    $titulo=utf8_decode('RESERVACIÓN FÁBRICA IMBABURA');
    $titulo2=utf8_decode('FÁBRICA IMBABURA');
    $email = new email();
    if ( $email->enviar( $correo , $titulo2 , $titulo ,  $contenido_html ) )
      // mensaje enviado
       $acus='1';
    else
    {
       // $email->ErrorInfo;
       $acus='2';
    }
    return $acus;
  }
  function envio_correomasivo($correo, $nombre, $mensaje) {      
    // $correo=$_POST['correo'];  
    $contenido_html =  '
      <!doctype html>
       <html xmlns="http://www.w3.org/1999/xhtml">
       <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="initial-scale=1.0" />
        <meta name="format-detection" content="telephone=no" />
        <title></title>
        <style type="text/css">
        body {
          width: 100%;
          margin: 0;
          padding: 0;
          -webkit-font-smoothing: antialiased;
        }
        @media only screen and (max-width: 600px) {
          table[class="table-row"] {
            float: none !important;
            width: 98% !important;
            padding-left: 20px !important;
            padding-right: 20px !important;
          }
          table[class="table-row-fixed"] {
            float: none !important;
            width: 98% !important;
          }
          table[class="table-col"], table[class="table-col-border"] {
            float: none !important;
            width: 100% !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
            table-layout: fixed;
          }
          td[class="table-col-td"] {
            width: 100% !important;
          }
          table[class="table-col-border"] + table[class="table-col-border"] {
            padding-top: 12px;
            margin-top: 12px;
            border-top: 1px solid #E8E8E8;
          }
          table[class="table-col"] + table[class="table-col"] {
            margin-top: 15px;
          }
          td[class="table-row-td"] {
            padding-left: 0 !important;
            padding-right: 0 !important;
          }
          table[class="navbar-row"] , td[class="navbar-row-td"] {
            width: 100% !important;
          }
          img {
            max-width: 100% !important;
            display: inline !important;
          }
          img[class="pull-right"] {
            float: right;
            margin-left: 11px;
                  max-width: 125px !important;
            padding-bottom: 0 !important;
          }
          img[class="pull-left"] {
            float: left;
            margin-right: 11px;
            max-width: 125px !important;
            padding-bottom: 0 !important;
          }
          table[class="table-space"], table[class="header-row"] {
            float: none !important;
            width: 98% !important;
          }
          td[class="header-row-td"] {
            width: 100% !important;
          }
        }
        @media only screen and (max-width: 480px) {
          table[class="table-row"] {
            padding-left: 16px !important;
            padding-right: 16px !important;
          }
        }
        @media only screen and (max-width: 320px) {
          table[class="table-row"] {
            padding-left: 12px !important;
            padding-right: 12px !important;
          }
        }
        @media only screen and (max-width: 600px) {
          td[class="table-td-wrap"] {
            width: 100% !important;
          }
        }
        </style>
       </head>
       <body style="font-family: Arial, sans-serif; font-size:13px; color: #444444; min-height: 200px;" bgcolor="#3085C9" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
       <table width="100%" height="100%" bgcolor="#3085C9" cellspacing="0" cellpadding="0" border="0">
       <tr><td width="100%" align="center" valign="top" bgcolor="#3085C9" style="background-color:#3085C9; min-height: 200px;">
      <table><tr><td class="table-td-wrap" align="center" width="600">
      <table class="table-row" style="table-layout: auto; padding-right: 24px; padding-left: 24px; width: 580px; background-color: transparent;" bgcolor="transparent" width="580" cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr height="50px" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; height: 50px; background-color: transparent;">
         <td class="table-row-td" style="height: 50px; padding-right: 16px; font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; vertical-align: middle;" valign="middle" align="left">
           <a href="#" style="color: #ffffff; text-decoration: none; padding: 0px; font-size: 18px; line-height: 20px; height: 50px; background-color: transparent;">
          Fábrica Imbabura
         </a>
         </td> 
         <td class="table-row-td" style="height: 50px; font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; text-align: right; vertical-align: middle;" align="right" valign="middle">
           <a href="#" style="color: #93cbf9; text-decoration: none; background-color: transparent;">
           www.fabricaimbabura.gob.ec/
         </a>
         </td>
      </tr>
      </tbody>
      </table>


      <table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 580px; background-color: #ffffff;" width="580" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 580px; background-color: #ffffff;" width="580" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

      <table class="table-row" width="580" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 24px; padding-right: 24px;" valign="top" align="left">
       <table class="table-col" align="left" width="532" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="532" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left">  
        <div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;">
          <img src="https://raw.githubusercontent.com/deividscriollo/reservacion/master/data/assets/images/correo.jpg" style="border: 0px none #444444; vertical-align: middle; display: block; padding-bottom: 9px;" hspace="0" vspace="0" border="0">
        </div>
       </td></tr></tbody></table>
      </td></tr></tbody></table>

      <table class="table-row" width="580" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">
         <table class="table-col" align="left" width="508" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="508" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left">
         <table class="header-row" width="508" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="header-row-td" width="508" style="font-size: 28px; margin: 0px; font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #478fca; padding-bottom: 10px; padding-top: 15px;" valign="top" align="left">Saludos estimad@ '.utf8_encode($nombre).',</td></tr></tbody></table>
         <div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px;">'.utf8_decode($mensaje).'</div>
         </td></tr></tbody></table>
      </td></tr></tbody></table>
      <table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0;  background-color: #ffffff;" width="580" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 580px; background-color: #ffffff;" width="580" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

      <table width="100%" cellspacing="0" cellpadding="0" border="0" style="table-layout:fixed;">
      <tbody>
      <tr>
      <td width="100%" align="center"  style="font-family:Arial, sans-serif;line-height:24px;color:#bbbbbb;font-size:13px;font-weight:normal;text-align:center;border-width:1px 0px 0px; " valign="top">
            <a href="http://www.fabricaimbabura.gob.ec/" style="color:#428bca;text-decoration:none;background-color:transparent;" target="_blank" class="">Fábrica Imbabura © 2015</a>
            <br>
            <a href="https://twitter.com/FabricaImbabura" style="color:#ffffff;text-decoration:none;text-align:center;vertical-align:baseline;border:4px solid #6fb3e0;padding:4px 9px;font-size:14px;line-height:19px;background-color:#6fb3e0;" target="_blank">Twitter</a>

            <a href="https://www.facebook.com/EPFabricaImbabura" style="color:#6688a6;text-decoration:none;text-align:center;vertical-align:baseline;border-width:1px 1px 2px;border-style:solid;border-color:#8aafce;padding:6px 12px;font-size:14px;line-height:20px;background-color:#ffffff;" target="_blank">Facebook</a>
            <a href="https://plus.google.com/105022629668662225987/posts?hl=es_419" style="color:#b7837a;text-decoration:none;text-align:center;vertical-align:baseline;border-width:1px 1px 2px;border-style:solid;border-color:#d7a59d;padding:6px 12px;font-size:14px;line-height:20px;background-color:#ffffff;" target="_blank">Google+</a>
            <a href="https://www.youtube.com/user/FabricaImbabura" style="color:#b7837a;text-decoration:none;text-align:center;vertical-align:baseline;border-width:1px 1px 2px;border-style:solid;border-color:#D15B47;padding:6px 12px;font-size:14px;line-height:20px;background-color:#ffffff;" target="_blank">YouTube</a>
          </td></tr></tbody></table>
      <table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 580px; background-color: #3085C9;" width="580" bgcolor="#3085C9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 580px; background-color: #3085C9;" width="580" bgcolor="#3085C9" align="left">&nbsp;</td></tr></tbody></table>
      <table class="table-row" width="580" bgcolor="transparent" style="table-layout: fixed; background-color: transparent;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" height="45px" bgcolor="transparent" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; height: 45px; padding-left: 24px; padding-right: 24px; background-color: transparent;" valign="top" align="left">
       <table class="table-col" align="left" width="532" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="532" align="center" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; text-align: center;" valign="top">
        </td></tr></tbody></table>
      </td></tr></tbody></table>
      </td></tr></table>
      </td></tr>
       </table>
       </body>
       </html>
    ';
    $contenido_html=utf8_decode($contenido_html);

    $email = new email();
    if ( $email->enviar( $correo , 'FABRICA IMBABURA' , 'MENSAJE FABRICA IMBABURA' ,  $contenido_html ) )
      // mensaje enviado
       $acus='1';
    else
    {
       // $email->ErrorInfo;
       $acus='2';
    }
    return $acus;
  }

  function envio_correoReiniciarpass($correo, $nombre, $id_p){
    // $]tabla=$_POST['tabla'];
      $acus='0';
    // $correo=$_POST['correo'];  
    $contenido_html =  '
      <!doctype html>
     <html xmlns="http://www.w3.org/1999/xhtml">
     <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta name="viewport" content="initial-scale=1.0" />
      <meta name="format-detection" content="telephone=no" />
      <title></title>
      <style type="text/css">
      body {
        width: 100%;
        margin: 0;
        padding: 0;
        -webkit-font-smoothing: antialiased;
      }
      @media only screen and (max-width: 600px) {
        table[class="table-row"] {
          float: none !important;
          width: 98% !important;
          padding-left: 20px !important;
          padding-right: 20px !important;
        }
        table[class="table-row-fixed"] {
          float: none !important;
          width: 98% !important;
        }
        table[class="table-col"], table[class="table-col-border"] {
          float: none !important;
          width: 100% !important;
          padding-left: 0 !important;
          padding-right: 0 !important;
          table-layout: fixed;
        }
        td[class="table-col-td"] {
          width: 100% !important;
        }
        table[class="table-col-border"] + table[class="table-col-border"] {
          padding-top: 12px;
          margin-top: 12px;
          border-top: 1px solid #E8E8E8;
        }
        table[class="table-col"] + table[class="table-col"] {
          margin-top: 15px;
        }
        td[class="table-row-td"] {
          padding-left: 0 !important;
          padding-right: 0 !important;
        }
        table[class="navbar-row"] , td[class="navbar-row-td"] {
          width: 100% !important;
        }
        img {
          max-width: 100% !important;
          display: inline !important;
        }
        img[class="pull-right"] {
          float: right;
          margin-left: 11px;
                max-width: 125px !important;
          padding-bottom: 0 !important;
        }
        img[class="pull-left"] {
          float: left;
          margin-right: 11px;
          max-width: 125px !important;
          padding-bottom: 0 !important;
        }
        table[class="table-space"], table[class="header-row"] {
          float: none !important;
          width: 98% !important;
        }
        td[class="header-row-td"] {
          width: 100% !important;
        }
      }
      @media only screen and (max-width: 480px) {
        table[class="table-row"] {
          padding-left: 16px !important;
          padding-right: 16px !important;
        }
      }
      @media only screen and (max-width: 320px) {
        table[class="table-row"] {
          padding-left: 12px !important;
          padding-right: 12px !important;
        }
      }
      @media only screen and (max-width: 458px) {
        td[class="table-td-wrap"] {
          width: 100% !important;
        }
      }
      </style>
     </head>
     <body style="font-family: Arial, sans-serif; font-size:13px; color: #444444; min-height: 200px;" bgcolor="#E4E6E9" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

     <table width="100%" height="100%" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0">
     <tr><td width="100%" align="center" valign="top" bgcolor="#E4E6E9" style="background-color:#E4E6E9; min-height: 200px;">
          <table>
          <tr><td class="table-td-wrap" align="center" width="458">
          <table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0">
          <tbody><tr><td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table>
          <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

          <table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><img src="https://raw.githubusercontent.com/deividscriollo/reservacion/master/data/assets/images/b.jpg" style="border-radius: 5px;" width="100%"></td></tr><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">
            <table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left">
              <table class="header-row" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                <tbody>
                  <tr><td style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #478fca; margin: 0px; font-size: 15px; padding-bottom: 10px; padding-top: 10px;">Estimado/a: '.$nombre.'</td></tr>
                  <tr>
                    <td class="header-row-td" width="378" style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #478fca; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 10px;" valign="top" align="left">
                    ¡Solicitud para reiniciar su contraseña!</td>
                    </tr>
                </tbody>
              </table>
              <div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px;">
                <b style="color: #777777;">Recientemente se ha enviado una solicitud de reinicio de su contraseña para nuestra área de miembros. Si no lo solicito, por favor ignore este correo.</b>
                <br>
                Para reiniciar su contraseña, por favor haga clic en el boton reinicia.
              </div>
            </td></tr></tbody></table>
          </td></tr></tbody></table>
              
          <table class="table-space"n height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
          <table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 450px; padding-left: 16px; padding-right: 16px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="center">&nbsp;<table bgcolor="#E8E8E8" height="0" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td bgcolor="#E8E8E8" height="1" width="100%" style="height: 1px; font-size:0;" valign="top" align="left">&nbsp;</td></tr></tbody></table></td></tr></tbody></table>
          <table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

          <table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">
            <table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left">
              <div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;">
                <a href="http://localhost/reservacion/inicio/recuperar.php?id='.$id_p.'" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #6fb3e0; padding: 4px 9px; font-size: 15px; line-height: 21px; background-color: #6fb3e0;">&nbsp; Reiniciar &nbsp;</a>
              </div>
              <table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
            </td></tr></tbody></table>
          </td></tr></tbody></table>

          <table class="table-space" height="6" style="height: 6px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="6" style="height: 6px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

          <table class="table-row-fixed" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-fixed-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 1px; padding-right: 1px;" valign="top" align="left">
            <table class="table-col" align="left" width="448" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="448" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left">
              <table width="100%" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td width="100%" align="center" bgcolor="#f5f5f5" style="font-family: Arial, sans-serif; line-height: 24px; color: #bbbbbb; font-size: 13px; font-weight: normal; text-align: center; padding: 9px; border-width: 1px 0px 0px; border-style: solid; border-color: #e3e3e3; background-color: #f5f5f5;" valign="top">
                <a href="http://www.fabricaimbabura.gob.ec/" style="color: #428bca; text-decoration: none; background-color: transparent;">Fábrica Imbabura &copy; 2015</a>
                <br>
                <a href="https://twitter.com/FabricaImbabura" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #6fb3e0; padding: 4px 9px; font-size: 14px; line-height: 19px; background-color: #6fb3e0;">Twitter</a>

                <a href="https://www.facebook.com/EPFabricaImbabura" style="color: #6688a6; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #8aafce; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #ffffff;">Facebook</a>
                <a href="https://plus.google.com/105022629668662225987/posts?hl=es_419" style="color: #b7837a; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #d7a59d; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #ffffff;">Google+</a>
                <a href="https://www.youtube.com/user/FabricaImbabura" style="color: #b7837a; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #D15B47; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #ffffff;">YouTube</a>
              </td></tr></tbody></table>
            </td></tr></tbody></table>
          </td></tr></tbody></table>
          <table class="table-space" height="1" style="height: 1px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="1" style="height: 1px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
          <table class="table-space" height="36" style="height: 36px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="36" style="height: 36px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table></td></tr></table>
          </td></tr>
           </table>
           </body>
           </html>   
    ';
    $contenido_html=utf8_decode($contenido_html);
    $titulo=utf8_decode('RECUPERAR PASSWORD / CLAVE FÁBRICA IMBABURA');
    $titulo2=utf8_decode('FÁBRICA IMBABURA');
    $email = new email();
    if ( $email->enviar( $correo , $titulo2 , $titulo ,  $contenido_html ) )
      // mensaje enviado
       $acus='1';
    else
    {
       // echo 'El mensaje no se pudo enviar ';
       // $email->ErrorInfo;
       $acus='0';
    }
    return $acus;
  }
  // nuevo usuario envio correo
  function envio_correoNuevousuario($correo, $nombre, $id_p){
    // $]tabla=$_POST['tabla'];
      $acus='0';
    // $correo=$_POST['correo'];  
    $contenido_html =  '
      <!doctype html>
             <html xmlns="http://www.w3.org/1999/xhtml">
             <head>
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <meta name="viewport" content="initial-scale=1.0" />
              <meta name="format-detection" content="telephone=no" />
              <title></title>
              <style type="text/css">
              body {
                width: 100%;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
              }
              @media only screen and (max-width: 600px) {
                table[class="table-row"] {
                  float: none !important;
                  width: 98% !important;
                  padding-left: 20px !important;
                  padding-right: 20px !important;
                }
                table[class="table-row-fixed"] {
                  float: none !important;
                  width: 98% !important;
                }
                table[class="table-col"], table[class="table-col-border"] {
                  float: none !important;
                  width: 100% !important;
                  padding-left: 0 !important;
                  padding-right: 0 !important;
                  table-layout: fixed;
                }
                td[class="table-col-td"] {
                  width: 100% !important;
                }
                table[class="table-col-border"] + table[class="table-col-border"] {
                  padding-top: 12px;
                  margin-top: 12px;
                  border-top: 1px solid #E8E8E8;
                }
                table[class="table-col"] + table[class="table-col"] {
                  margin-top: 15px;
                }
                td[class="table-row-td"] {
                  padding-left: 0 !important;
                  padding-right: 0 !important;
                }
                table[class="navbar-row"] , td[class="navbar-row-td"] {
                  width: 100% !important;
                }
                img {
                  max-width: 100% !important;
                  display: inline !important;
                }
                img[class="pull-right"] {
                  float: right;
                  margin-left: 11px;
                        max-width: 125px !important;
                  padding-bottom: 0 !important;
                }
                img[class="pull-left"] {
                  float: left;
                  margin-right: 11px;
                  max-width: 125px !important;
                  padding-bottom: 0 !important;
                }
                table[class="table-space"], table[class="header-row"] {
                  float: none !important;
                  width: 98% !important;
                }
                td[class="header-row-td"] {
                  width: 100% !important;
                }
              }
              @media only screen and (max-width: 480px) {
                table[class="table-row"] {
                  padding-left: 16px !important;
                  padding-right: 16px !important;
                }
              }
              @media only screen and (max-width: 320px) {
                table[class="table-row"] {
                  padding-left: 12px !important;
                  padding-right: 12px !important;
                }
              }
              @media only screen and (max-width: 458px) {
                td[class="table-td-wrap"] {
                  width: 100% !important;
                }
              }
              </style>
             </head>
             <body style="font-family: Arial, sans-serif; font-size:13px; color: #444444; min-height: 200px;" bgcolor="#E4E6E9" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">

             <table width="100%" height="100%" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0">
             <tr><td width="100%" align="center" valign="top" bgcolor="#E4E6E9" style="background-color:#E4E6E9; min-height: 200px;">
            <table>
            <tr><td class="table-td-wrap" align="center" width="458">
            <table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0">
            <tbody><tr><td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table>
            <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

            <table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td><img src="https://raw.githubusercontent.com/deividscriollo/reservacion/master/data/assets/images/b.jpg" style="border-radius: 5px;" width="100%"></td></tr><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">
              <table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left">
                <table class="header-row" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                  <tbody>
                    <tr><td style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #478fca; margin: 0px; font-size: 15px; padding-bottom: 10px; padding-top: 10px;">Estimado/a: '.$nombre.'</td></tr>
                    <tr>
                      <td class="header-row-td" width="378" style="font-family: Arial, sans-serif; font-weight: normal; line-height: 19px; color: #478fca; margin: 0px; font-size: 18px; padding-bottom: 10px; padding-top: 10px;" valign="top" align="left">
                      ¡Gracias por registrarte con nosotros!</td>
                      </tr>
                  </tbody>
                </table>
                <div style="font-family: Arial, sans-serif; line-height: 20px; color: #444444; font-size: 13px;">
                  <b style="color: #777777;">Su cuenta de La Fábrica Imbabura ha sido configurada y este correo contiene toda la información que necesitará para comenzar a usar tu cuenta.</b>
                  <br>
                  Por favor confirme su registro para continuar.
                </div>
              </td></tr></tbody></table>
            </td></tr></tbody></table>
                
            <table class="table-space"n height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
            <table class="table-space" height="12" style="height: 12px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="12" style="height: 12px; width: 450px; padding-left: 16px; padding-right: 16px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="center">&nbsp;<table bgcolor="#E8E8E8" height="0" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td bgcolor="#E8E8E8" height="1" width="100%" style="height: 1px; font-size:0;" valign="top" align="left">&nbsp;</td></tr></tbody></table></td></tr></tbody></table>
            <table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

            <table class="table-row" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left">
              <table class="table-col" align="left" width="378" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="378" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left">
                <div style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; text-align: center;">
                  <a href="http://localhost/reservacion/inicio/activacion.php?id='.$id_p.'" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #6fb3e0; padding: 4px 9px; font-size: 15px; line-height: 21px; background-color: #6fb3e0;">&nbsp; Confirmar &nbsp;</a>
                </div>
                <table class="table-space" height="16" style="height: 16px; font-size: 0px; line-height: 0; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="16" style="height: 16px; width: 378px; background-color: #ffffff;" width="378" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
              </td></tr></tbody></table>
            </td></tr></tbody></table>

            <table class="table-space" height="6" style="height: 6px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="6" style="height: 6px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>

            <table class="table-row-fixed" width="450" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-row-fixed-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal; padding-left: 1px; padding-right: 1px;" valign="top" align="left">
              <table class="table-col" align="left" width="448" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td class="table-col-td" width="448" style="font-family: Arial, sans-serif; line-height: 19px; color: #444444; font-size: 13px; font-weight: normal;" valign="top" align="left">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;"><tbody><tr><td width="100%" align="center" bgcolor="#f5f5f5" style="font-family: Arial, sans-serif; line-height: 24px; color: #bbbbbb; font-size: 13px; font-weight: normal; text-align: center; padding: 9px; border-width: 1px 0px 0px; border-style: solid; border-color: #e3e3e3; background-color: #f5f5f5;" valign="top">
                  <a href="http://www.fabricaimbabura.gob.ec/" style="color: #428bca; text-decoration: none; background-color: transparent;">Fábrica Imbabura &copy; 2015</a>
                  <br>
                  <a href="https://twitter.com/FabricaImbabura" style="color: #ffffff; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border: 4px solid #6fb3e0; padding: 4px 9px; font-size: 14px; line-height: 19px; background-color: #6fb3e0;">Twitter</a>

                  <a href="https://www.facebook.com/EPFabricaImbabura" style="color: #6688a6; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #8aafce; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #ffffff;">Facebook</a>
                  <a href="https://plus.google.com/105022629668662225987/posts?hl=es_419" style="color: #b7837a; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #d7a59d; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #ffffff;">Google+</a>
                  <a href="https://www.youtube.com/user/FabricaImbabura" style="color: #b7837a; text-decoration: none; margin: 0px; text-align: center; vertical-align: baseline; border-width: 1px 1px 2px; border-style: solid; border-color: #D15B47; padding: 6px 12px; font-size: 14px; line-height: 20px; background-color: #ffffff;">YouTube</a>
                </td></tr></tbody></table>
              </td></tr></tbody></table>
            </td></tr></tbody></table>
            <table class="table-space" height="1" style="height: 1px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="1" style="height: 1px; width: 450px; background-color: #ffffff;" width="450" bgcolor="#FFFFFF" align="left">&nbsp;</td></tr></tbody></table>
            <table class="table-space" height="36" style="height: 36px; font-size: 0px; line-height: 0; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="table-space-td" valign="middle" height="36" style="height: 36px; width: 450px; background-color: #e4e6e9;" width="450" bgcolor="#E4E6E9" align="left">&nbsp;</td></tr></tbody></table></td></tr></table>
            </td></tr>
             </table>
             </body>
             </html> 
    ';
    $contenido_html=utf8_decode($contenido_html);
    $titulo=utf8_decode('REGISTRO ACTIVACIÓN FÁBRICA IMBABURA');
    $titulo2=utf8_decode('FÁBRICA IMBABURA');
    $email = new email();
    if ( $email->enviar( $correo , $titulo2 , $titulo ,  $contenido_html ) )
      // mensaje enviado
       $acus='1';
    else
    {
       // echo 'El mensaje no se pudo enviar ';
       // $email->ErrorInfo;
       $acus='0';
    }
    return $acus;
  }
  function envio_confirmacion_reservacion($correo, $nombre){
    // $]tabla=$_POST['tabla'];
      $acus='0';
    // $correo=$_POST['correo'];  
    $contenido_html =  '
      <table width="100%" border="0" style="width: 90%;
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
            <td style="color:#E1A401">PROCESO CONFIRMACIÓN</td>
          </tr>
          <tr>
            <td>
              <table style="float: left;">
                  <tbody style="color:#FFFFFF">
                    <tr>
                      <td style="color:#FFFFFF; font-size: 20px;">
                        Estimad@: '.$nombre.'
                      </td>
                    </tr>
                    <tr>
                      <td style="color:#FFFFFF; font-size: 25px;">
                        Felicidades su reservación se ha realizado con éxito, lo esperamos el día de la reserva.
                      </td>
                    </tr>
                  </tbody>
                </table>
            </td>
          </tr>

          <tr><td align="center" style="color:#FFFFFF;">
          </td>
      </tr></tbody>
      </table>
    ';
    $contenido_html=utf8_decode($contenido_html);
    $titulo=utf8_decode('RESPUESTA CONFIRMACIÓN RESERVACIÓN');
    $titulo2=utf8_decode('FÁBRICA IMBABURA');
    $email = new email();
    if ( $email->enviar( $correo , $titulo2 , $titulo ,  $contenido_html ) )
      // mensaje enviado
       $acus='1';
    else
    {
       // echo 'El mensaje no se pudo enviar ';
       // $email->ErrorInfo;
       $acus='0';
    }
    return $acus;
  }
?>
