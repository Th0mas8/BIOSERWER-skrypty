<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");

  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
	$seed="0dAfghRqSTgx";


	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();
  	$stmt = $link->prepare("INSERT INTO login (username,password,email,admin,rulesadmin) VALUES (?, ?, ?, ?, ?)");	
	$stmt->bind_param('sssss',$_POST["username"],sha1($_POST["password"] . $seed),$_POST["email"],$_POST["admin"],$_POST["rulesadmin"]); 
	$stmt->execute();

  mysqli_close($link);
?>