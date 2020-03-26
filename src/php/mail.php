<?php

$response = array();

if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
	$response['error'] = true;
	die( json_encode( $response ) );
}


// Форма "Заявка"
if ( isset( $_POST['form-order'] ) ) {
	$name = ( isset( $_POST['name'] ) ) ? $_POST['name'] : null;
	$tel = ( isset( $_POST['tel'] ) ) ? $_POST['tel'] : null;
        $email = ( isset( $_POST['email'] ) ) ? $_POST['email'] : null;


	$name = strip_tags( trim( $name ) );
	$tel = strip_tags( trim( $tel ) );
        $email = strip_tags( trim( $email ) );


	if ( ! $tel ) {
		$response['error'] = true;
		die( json_encode( $response ) );
	}
 
	$em="zayavkanafranshizu@setsushi.ru";
	$to = 'franshiza@setsushi.ru, gareev_tima@mail.ru, fr.setsushi@mail.ru, sasizvekv@yandex.ru';
	
	$subject = '=?utf-8?B?' . base64_encode( 'Заявка со страницы ФРАНШИЗА' ) . '?=';

	$headers = "From: " . $em . "\r\n";
	$headers .= "Reply-To: ". $to . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=utf-8\r\n";

	$message = "<html><body>";
	$message .= "<table style='border-collapse: collapse; border-color: #666;' cellpadding='5'>";
	$message .= "<tr><td><strong>Имя:</strong></td><td>" . $name . "</td></tr>";
	$message .= "<tr><td><strong>Телефон:</strong></td><td>" . $tel . "</td></tr>";
  $message .= "<tr><td><strong>E-mail:</strong></td><td>" . $email . "</td></tr>";
	$message .= "</table>";
	$message .= "</body></html>";
}


$send = mail( $to, $subject, $message, $headers );

if ( $send ) {
	$response['error'] = false;
} else {
	$response['error'] = true;
}

echo json_encode( $response );

?>