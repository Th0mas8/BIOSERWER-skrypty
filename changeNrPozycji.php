<?php
  include("parametry.php");
  //byc moze trzeba bedzie zakomentowac header
  header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
	$idList = explode("a", $_POST["id"]);
	$nrPozycjiList = explode("a", $_POST["nrpozycji"]);
	
	
	for($i = 0, $size = sizeof($idList); $i < $size; $i++)
	{
		$stmt = $link->prepare("UPDATE elements SET nrporzadkowy= ? where id = ?");
		$stmt->bind_param('ss',$nrPozycjiList[$i],$idList[$i]); 
		$stmt->execute();
  
		//$sql = sprintf("UPDATE elements SET nrporzadkowy='%s' where id = '%s'",$nrPozycjiList[$i],$idList[$i]);
		//$result = mysql_query($sql);
		if (!$stmt) 
		{
			$message  = 'Invalid query: ' . mysqli_error() . "\n";
			$message .= 'Whole query: ' . $query;
			die($message);
		}
		$stmt->close();
	}
  mysqli_close($link);
?>