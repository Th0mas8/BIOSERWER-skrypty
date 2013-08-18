<?php
  include("parametry.php");
	//zakomenac?
	//header('Content-type: text/xml; charset=utf-8');
	$link = mysqli_connect("$host", "$user", "$password", "$database");
	if (!$link) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
		
	$query="SELECT path FROM images WHERE elements = ?";
	$stmt = $link->prepare($query);
	$stmt->bind_param('d',$_POST["id"]); 
	$stmt->execute();
	$stmt->bind_result($nameoffile);
	
	if (!$stmt) 
	{
		$message  = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	while ($stmt->fetch()){		
		unlink("../img/" .$nameoffile);
	}
	
	$query="SELECT path FROM pdfs WHERE elementid = ?";
	$stmt = $link->prepare($query);
	$stmt->bind_param('d',$_POST["id"]); 
	$stmt->execute();
	$stmt->bind_result($nameoffile);
	
	while ($stmt->fetch()){		
		unlink("../pdf/" .$nameoffile);
	}
	
	if (!$stmt) 
	{
		$message  = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	$stmt = $link->prepare("DELETE FROM elements WHERE id = ?");
	$stmt->bind_param('d',$_POST["id"]); 
	$stmt->execute();

	if (!$stmt) 
	{
		$message  = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	/*
	$stmt = $link->prepare("DELETE FROM images WHERE elements = ?");
	$stmt->bind_param('d',$_POST["id"]); 
	$stmt->execute();

	if (!$stmt) 
	{
		$message  = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	
	$stmt = $link->prepare("DELETE FROM pdfs WHERE elementid = ?");
	$stmt->bind_param('d',$_POST["id"]); 
	$stmt->execute();

	if (!$stmt) 
	{
		$message  = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	*/
	mysqli_close($link);
?>