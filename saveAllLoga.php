<?php
  include("parametry.php");
  //header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");;
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
	$idList = explode("$$", $_POST["id"]);
	$positionList = explode("$$", $_POST["position"]);
	$locationList = explode("$$", $_POST["location"]);
	$urlList = explode("$$", $_POST["URL"]);
	$isselectedList = explode("$$", $_POST["isselected"]);

 
  for($i = 0, $size = sizeof($idList) - 1; $i < $size; $i++)
	{
	  	$stmt = $link->prepare("UPDATE logo SET position= ?, location= ?, URL= ?, isselected=? where id = ?");
		$stmt->bind_param('ssssd',$positionList[$i],$locationList[$i],$urlList[$i],$isselectedList[$i],$idList[$i]); 
		$stmt->execute();
	
		//$sql = sprintf("UPDATE articles SET nazwa='%s', podstrony='%s', rodzaj='%s' where id = '%s'",$nazwaList[$i],$podstronyList[$i],$rodzajList[$i],$idList[$i]);
		//$result = mysql_query($sql);
		if (!$stmt) 
		{
			$message  = 'Invalid query: ' . mysqli_error() . "\n";
			$message .= 'Whole query: ' . $query;
			mysqli_close($link);
			die($message);
		}
	}
  mysqli_close($link);
?>