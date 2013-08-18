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
	
	$query = "SELECT email FROM login WHERE username = ?";
	$stmt = $link->prepare($query);
	$stmt->bind_param('s',$_POST['u']); 
	$stmt->execute();
	$stmt->bind_result($email);
	
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
		echo "<status>ERROR</status>";
		mysqli_close($link);
		return true;
	}
	
	$seed="0dAfghRqSTgx";
	$pass = generate_code(10);
	$message = "Your new password is: $pass username: $_POST[u]";
	$subject = "New password bioserver";
	
	$query="UPDATE login SET password = ? WHERE username = ?";
	$stmt = $link->prepare($query);
	mysqli_stmt_bind_param($stmt, 'ss', sha1($pass . $seed),$_POST['u']);
	$stmt->execute();
	
	$from_header = "From: no_reply@Bioserver.cs.put.poznan.pl";
 
	if (mail($email, $subject, $message, $from_header))
	{
		echo "<status>OK</status>";
	} else
	{
		echo "<status>ERROR</status>";
	}
	mysqli_close($link);
	
	function generate_code($length)
	{
		if ($length <= 0)
		{
			return false;
		}
		$code = "";
		$chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
		srand((double)microtime() * 1000000);
		for ($i = 0; $i < $length; $i++)
		{
			$code = $code . substr($chars, rand() % strlen($chars), 1);
		}
		return $code;
	}
?>