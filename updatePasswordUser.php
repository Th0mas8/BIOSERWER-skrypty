<?php
	include("parametry.php");
	header('Content-type: text/xml; charset=utf-8');
	$link = mysqli_connect("$host", "$user", "$password", "$database");
	if (!$link) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	$seed="0dAfghRqSTgx";
	
	
	$pass = $_POST['password'];
	
	$query="UPDATE login SET password = ? WHERE loginid = ?";
	$stmt = $link->prepare($query);
	mysqli_stmt_bind_param($stmt, 'sd', sha1($pass . $seed),$_POST['idperson']);
	$stmt->execute();
	
	if ($stmt)
	{
		echo "<status>OK</status>";
	} else
	{
		echo "ERROR with saving password";
	}
	mysqli_close($link);
?>