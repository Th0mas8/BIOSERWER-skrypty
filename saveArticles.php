<?php
  include("parametry.php");
  //header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");;
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
	$idList = explode("$$", $_POST["id"]);
	$nazwaList = explode("$$", $_POST["nazwa"]);
	$podstronyList = explode("$$", $_POST["podstrony"]);
	$rodzajList = explode("$$", $_POST["rodzaj"]);
	$adresList = explode("$$", $_POST["adres"]);

 
  for($i = 0, $size = sizeof($idList); $i < $size; $i++)
	{
	  	$stmt = $link->prepare("UPDATE articles SET nazwa= ?, podstrony= ?, rodzaj= ?, adres=? where id = ?");
		$stmt->bind_param('ssssd',$nazwaList[$i],$podstronyList[$i],$rodzajList[$i],$adresList[$i],$idList[$i]); 
		$stmt->execute();
	
		//$sql = sprintf("UPDATE articles SET nazwa='%s', podstrony='%s', rodzaj='%s' where id = '%s'",$nazwaList[$i],$podstronyList[$i],$rodzajList[$i],$idList[$i]);
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