<?php
  include("parametry.php");
  //byc moze trzeba bedzi header i echo zakomencic
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysql_connect_error());
  exit();
}

	$idList = explode("a", $_POST["id"]);
	
	
	for($i = 0, $size = sizeof($idList); $i < $size; $i++)
	{
		echo $i;
		$stmt = $link->prepare("DELETE FROM articles WHERE id = ?");
		$stmt->bind_param('d',$idList[$i]); 
		$stmt->execute();
  
		//$sql = sprintf("DELETE FROM articles WHERE id = '%s'",$idList[$i]);
		//$result = mysql_query($sql);
		if (!$stmt) 
		{
			$message  = 'Invalid query: ' . mysqli_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
	}  
  mysqli_close($link);
?>