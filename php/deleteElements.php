<?php
  include("parametry.php");
  //zakomenac?
  header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password", "$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
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
  mysqli_close($link);
?>