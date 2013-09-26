<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");

  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();
  	$stmt = $link->prepare("UPDATE login SET email=? WHERE loginid=?");	
	$stmt->bind_param('sd',$_POST["email"],$_POST["idperson"]); 
	$stmt->execute();

  mysqli_close($link);
?>