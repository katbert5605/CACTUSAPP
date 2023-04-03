<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/phpmailer/src/Exception.php';
require '/phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->IsHTML(true);

$mail->setFrom('og@cactusappliance.com', 'New ticket');
$mail->addAddress('tickets@cactusappliance.com');
$mail->Subject = 'You have one new ticket';

$body = '<h1>You have new ticket!</h1>';

if (trim(!empty($_POST['name']))){
    $body.='<p><strong>Name:</strong> ' .$_POST['name'].'</p>'
}
if (trim(!empty($_POST['phone']))){
    $body.='<p><strong>Phone:</strong> ' .$_POST['phone'].'</p>'
}
if (trim(!empty($_POST['email']))){
    $body.='<p><strong>E-mail:</strong> ' .$_POST['email'].'</p>'
}

$mail->Body = $body;

if (!$mail->send()) {
    $message = 'Error!';
} else {
    $message = 'All good!';
}

$responce = ['message' => $message];

header('Content-type: application/json');
echo json_encode($responce);

?>