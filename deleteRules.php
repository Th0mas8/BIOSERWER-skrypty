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
  	$stmt = $link->prepare("DELETE FROM peoplerules WHERE idperson = ? AND idart = ?");	
	$stmt->bind_param('dd',$_POST["idperson"],$_POST["idart"]); 
	$stmt->execute();

  mysqli_close($link);
?>