<?php
  include("parametry.php");
  //header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
  		$stmt = $link->prepare("DELETE FROM people WHERE id=?");
		$stmt->bind_param('d',$_POST["id"]); 
		$stmt->execute();

  mysqli_close($link);
?>