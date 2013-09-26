<?php
  include("parametry.php");
  //byc moze trzeba bedzie zakomentowac header
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
	$stmt = $link->prepare("UPDATE login SET username= ? where loginid = ?");
	$stmt->bind_param('sd',$_POST["newlogin"],$_POST["idperson"]); 
	
	$stmt->execute();
  
	if (!$stmt) 
	{
		$message  = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	echo 'OK';
	$stmt->close();
  mysqli_close($link);
?>