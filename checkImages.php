<?php
include("parametry.php");

	//1	
$link = mysqli_connect("$host", "$user", "$password","$database");
if (!$link)
{
	$message = "<result><status>BAD</status><message>Couldn't connect to DB</message></result>";
	echo $message;
	die ("Couldn't connect to DB");
}

	//2
	mysqli_autocommit($link, FALSE);
	
	$stmt = $link->prepare("UPDATE images SET included=false WHERE elements = ?");
	$stmt->bind_param('d',$_POST['id']); 
	$stmt->execute();
	
if (!$stmt)
{
	$message =  "<result><status>BAD</status><message>cannot update images to false</message></result>";
	echo $message;
	die("cannot update images");
}

	//3
$query = "UPDATE images SET included=true where path in $_POST[query]";
$stmt = mysqli_query($link,$query);
	
if (!$stmt)
{
	$message =  "<result><status>BAD</status><message>cannot update images to true</message></result>";
	echo $message;
	mysqli_rollback($link);
	die("cannot update images");
}
mysqli_commit($link);
$message =  "<result><status>OK</status><message>Images included attribute set true in DB".$query."</message></result>";
echo $message;
mysqli_close($link);
?>