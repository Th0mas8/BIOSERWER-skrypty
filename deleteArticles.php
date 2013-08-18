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
		$stmt = $link->prepare("select p.path,e.rodzaj from (elements e INNER JOIN pdfs p ON p.elementid = e.id) JOIN articles a ON e.articleid = a.id where articleid = ?
		UNION ALL
		select i.path,e.rodzaj from (elements e INNER JOIN images i ON i.elements = e.id) JOIN articles a ON e.articleid = a.id where articleid = ?");
		$stmt->bind_param('dd',$idList[$i],$idList[$i]); 
		$stmt->execute();
		$stmt->bind_result($nameoffile,$rodzaj);
	
		while ($stmt->fetch()){		
			if ($rodzaj=="pdf")	unlink("../pdf/" .$nameoffile);
			if ($rodzaj=="textFlow") unlink("../img/" .$nameoffile);
		}
		
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