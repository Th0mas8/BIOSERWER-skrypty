<?php
  include("parametry.php");
  //byc moze rtzeba zakomenicic
  header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");

  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();

  	$stmt = $link->prepare("UPDATE people SET position=?, researchInterests=?, email=?, webPage=?, name=?, photo=? where id=?");
	$stmt->bind_param('ssssssd',$_POST["position"],$_POST["researchInterests"],$_POST["email"],$_POST["webPage"],$_POST["name"], $_POST["photo"],$_POST["id"]); 
	$stmt->execute();

  mysqli_close($link);
?>