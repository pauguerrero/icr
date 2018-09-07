<?php

include dirname(dirname(__FILE__)).'/mail.php';

error_reporting (E_ALL ^ E_NOTICE);

$post = (!empty($_POST)) ? true : false;

if($post)
{
include 'email_validation.php';

$name = stripslashes($_POST['name']);
$email = trim($_POST['email']);
$subject = stripslashes($_POST['subject']);
$message = stripslashes($_POST['message']);


$error = '';

// Check name

if(!$name)
{
$error .= 'Si us plau, escriu el teu nom.<br />';
}

// Check email

if(!$email)
{
$error .= 'Si us plau, escriu el teu correu electronic.<br />';
}

if($email && !ValidateEmail($email))
{
$error .= 'Si us plau, escriu un email vàlid.<br />';
}

// Check message (length)

if(!$message || strlen($message) < 10)
{
$error .= "Si us plau, escriu el teu missatge, ha de tenir com a mínim 10 caracters.<br />";
}


if(!$error)
{
$mail = mail(CONTACT_FORM, $subject, $message,
     "From: ".$name." <".$email.">\r\n"
    ."Reply-To: ".$email."\r\n"
    ."X-Mailer: PHP/" . phpversion());


if($mail)
{
echo 'OK';
}

}
else
{
echo '<div class="notification_error">'.$error.'</div>';
}

}
?>