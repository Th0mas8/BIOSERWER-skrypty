<?php
include("parametry.php");
$to = $mail;
$from = "no-reply@email.com";
$subject = "Contact from BIOSERVER";
$msg ="Name: ".$_POST['name']."\nEmail: ".$_POST['email']."\nMessage: ".$_POST['msg'];
if(mail($to, $subject, $msg, "from:$from")) echo "ok";
else echo "error";
?>
