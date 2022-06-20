<?php
require '../libs/PHPMailer-master/src/PHPMailer.php';
require '../libs/PHPMailer-master/src/SMTP.php';
require '../libs/PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function envoi($receiver,$subject,$body,$attachment){
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = "outlook.office365.com";
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure ="tls";
    $mail->Port = "587";
    $mail->Username = "crepix71@outlook.fr";
    $mail->Password = "azerty71@";


    $mail->SetFrom('crepix71@outlook.fr');
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->addAttachment($attachment);
    $mail->AddAddress( $receiver );

    // $mail->Send();
    if (!$mail->send()) {
        echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
    } else {
        echo 'Le message a été envoyé.';
    }
    $mail->smtpClose();

}
envoi('trokikoo@gmail.com', "Bon de Commande HOM'BURGER", "Ceci est un mail. Coridalement", "./commandes/" . $id . '.pdf');

$table_fournisseur = $_POST['fournisseur'];
$id = $_POST['id'];
envoi($table_fournisseur['MailFourn'], "Bon de Commande HOM'BURGER", "Ceci est un mail. Coridalement", "./commandes/" . $id . '.pdf');


?>