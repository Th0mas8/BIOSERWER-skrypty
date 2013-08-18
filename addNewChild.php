<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
  //mysqli_select_db("$database")
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
  $stmt = $link->prepare("INSERT INTO articles (nazwa, rodzaj) VALUES(?, 'child' )");
  $stmt->bind_param('s', $_POST["nazwa"]); 
  $stmt->execute();
  if (!$stmt) 
		{
			$message  = 'Invalid query: ' . mysqli_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		 
		  $stmt->close();
	$idodzyskane = mysqli_insert_id($link);
  echo '<ids>';	
  echo '<id>';	
  echo $idodzyskane;
  echo '</id>';
  echo '</ids>';
  
 
  mysqli_close($link);
?>