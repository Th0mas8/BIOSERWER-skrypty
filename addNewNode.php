<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
 // mysql_select_db("$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
  $sql = sprintf("INSERT INTO articles (nazwa, rodzaj) VALUES('Podstrona', 'child' )");
  $result = mysqli_query($link,$sql);
  
  if (!$result) 
		{
			$message  = 'Invalid query1: ' . mysqli_error($link) . "\n";
			$message .= 'Whole query1: ' . $query;
			die($message);
		}
	mysqli_free_result($result);
	$idChildodzyskane = mysqli_insert_id($link);
  echo '<ids>';	
  echo '<idChild>';	
  echo $idChildodzyskane;
  echo '</idChild>';
  
  $stmt = $link->prepare("INSERT INTO articles (nazwa, rodzaj) VALUES( ?, 'node' )");
  $stmt->bind_param('s',$_POST["nazwa"]); 
  $stmt->execute();
  
  if (!$stmt) 
		{
			$message  = 'Invalid query: ' . mysqli_error($link) . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	  $stmt->close();
	$idNodeodzyskane = mysqli_insert_id($link);
  
  echo '<idNode>';	
  echo $idNodeodzyskane;
  echo '</idNode>';
  
  echo '</ids>';
  
  mysqli_close($link);
?>