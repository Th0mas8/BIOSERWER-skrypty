<?php
  include("parametry.php");
  //byc moze trzeba zakomencic
  header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");

  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
 //$opis= str_replace("'", "\'", $_POST["opis"]);
 //$tresc= str_replace("'", "\'", $_POST["tresc"]);

  //$sql = sprintf("UPDATE elements SET opis='%s', tresc='%s' where id = '%s'",$opis,$tresc,$_POST["id"]);
  //$result = mysql_query($sql);
  
  $jezykZap = $link->prepare("SET NAMES utf8");
  $jezykZap->execute();
  $stmt = $link->prepare("UPDATE elements SET opis=?, tresc=?, treschtml=? where id = ?;");
  $stmt->bind_param('sssd',$_POST["opis"],$_POST["tresc"],$_POST["texthtml"],$_POST["id"]); 
  $stmt->execute();
	
  if (!$stmt) 
		{
			$message  = 'Invalid query: ' . mysqli_error($link) . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
  
  
  mysqli_close($link);
   printf("Zmiana zakonczyla sie sukcesem");
?>