<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  echo "\r\n";
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
  	$stmt = $link->prepare("SELECT nazwa from articles where rodzaj = ? order by nazwa");
	$stmt->bind_param('s',$_POST["rodzaj"]); 
	$stmt->execute();
	$stmt->bind_result($nazwa);

  $beg = '<articles>';
  $end = '</articles>';
  echo "$beg\r\n";
  while ($stmt->fetch()){
		echo "\t";
		echo '<names>';
		echo $nazwa;
		echo '</names>';
		echo "\r\n";
	}
	
  echo $end;
  mysqli_close($link);
?>