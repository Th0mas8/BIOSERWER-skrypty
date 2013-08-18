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
	$seed="0dAfghRqSTgx";
	$query = "SELECT * FROM login WHERE username = ? AND password = ?";
	$stmt = $link->prepare($query);
	$stmt->bind_param('ss',$_POST['u'],sha1($_POST['pold'] . $seed)); 
	$stmt->execute();
	
	if (!$stmt) 
	{
		$message  = 'Invalid query: ' . mysqli_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	
	$i=0;
	while ($stmt->fetch()){		
		$i++;
	}
	
	if ($i!=1) 
	{
		echo "<status>ERRORa</status>";
		mysqli_close($link);
		return true;
	}
	
	
	$pass = $_POST['pnew'];
	
	$query="UPDATE login SET password = ? WHERE username = ?";
	$stmt = $link->prepare($query);
	mysqli_stmt_bind_param($stmt, 'ss', sha1($pass . $seed),$_POST['u']);
	$stmt->execute();
	
	if ($stmt)
	{
		echo "<status>OK</status>";
	} else
	{
		echo "<status>ERROR1</status>";
	}
	mysqli_close($link);
?>