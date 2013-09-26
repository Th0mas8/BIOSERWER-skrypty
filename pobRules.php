<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=ISO-8859-1');
  
  echo '<?xml version="1.0"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();
  	$stmt = $link->prepare("SELECT id,idperson,rule, idart from peoplerules WHERE idperson = ? ORDER BY id");
	$stmt->bind_param('d',$_POST["idperson"]); 
	$stmt->execute();
  
	$stmt->bind_result($id, $idperson,$rule,$idart);
  $beg = '<articles>';
  $end = '</articles>';

  $query = "";
  $result = mysqli_query($link,$query);
 
  $beg='<rules nazwa="root" id="'.$idperson.'">';
  $end='</rules>';
  echo $beg;
  while($stmt->fetch())
  {
	  echo '<rule id="';
	  echo $id;
	  echo '" ';
	  echo 'rule="';
	  echo $rule;
	  echo '" ';
	  echo 'idart="';
	  echo $idart;
	  echo '" ';
	  echo ' />';
  }
  echo $end;
  //mysql_free_result($result);
  mysqli_close($link);
?>