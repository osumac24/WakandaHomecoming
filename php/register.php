<?php
// Variables
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$plan = trim($_POST['plan']);

// Email address validation - works with php 5.2+
function is_email_valid($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}


if( isset($name) && isset($email) && isset($plan) && is_email_valid($email) ) {

	// Avoid Email Injection and Mail Form Script Hijacking
	$pattern = "/(content-type|bcc:|cc:|to:)/i";
	if( preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $plan) || preg_match($pattern, $subject) ) {
		exit;
	}

	// Email will be sent to this email id with the following subject
	$to = "author@paperboatdesigns.co";  // Replace with your own email
	$subject = "$name Registered for Conference 2016 from Eventster"; // Default Subject of the mail

	// HTML Elements for Email Body
	$body = <<<EOD
	<strong>Name:</strong> $name <br>
	<strong>Email:</strong> <a href="mailto:$email?subject=feedback" "email me">$email</a> <br> <br>
	<strong>Plan:</strong> $plan <br>
EOD;
//Must end on first column

	$headers = "From: $name <$email>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// PHP email sender
	mail($to, $subject, $body, $headers);
}


?>