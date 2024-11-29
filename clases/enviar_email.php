<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '21031400@itcelaya.edu.mx';
    $mail->Password   = 'edxp pfjp mxbx lhjf'; // Mejor usar variables de entorno
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('21031400@itcelaya.edu.mx', 'BOKEN SHOP');
    $mail->addAddress('21031400@itcelaya.edu.mx', 'BOKEN SHOP');

    $mail->isHTML(true);
    $mail->Subject = 'Detalles de su compra';
    $cuerpo  = '<h4> Gracias por su compra</h4>';
    $cuerpo .= '<p>El Id de su compra es <b>' . $id_transaccion . '</b></p>';
    $mail->Body    = utf8_decode($cuerpo);
    $mail->AltBody = "Gracias por su compra. El Id de su compra es " . $id_transaccion;

    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

    $mail->send();
    echo "Correo enviado exitosamente.";
} catch (Exception $e) {
    echo "Error al enviar el correo de compra: {$mail->ErrorInfo}";
    //exit;
}
