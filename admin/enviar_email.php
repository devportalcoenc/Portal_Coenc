<?php

function enviar_email($to,$subject,$body){
	require 'class.phpmailer.php';
	$from = "";// email remetente
	$mail = new PHPMailer();
	$mail->CharSet  = "UTF-8";  
	$mail->IsSMTP(true); // SMTP
	$mail->SMTPAuth   = true;  // SMTP authentication
	$mail->Mailer = "smtp";
	$mail->Host= 'ssl://......'; // host do server de email
	$mail->Port = 465;  // SMTP Port
	$mail->Username = "";  // SMTP  Username
	$mail->Password = "";  // SMTP Password
	$mail->SetFrom($from, 'Nome do remetente');
	$mail->Subject = $subject;
	$mail->MsgHTML($body);
	$address = $to;
	$mail->AddAddress($address, $address);
	$mail->Send();

}

?>