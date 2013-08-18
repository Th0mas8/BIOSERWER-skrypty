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

$query="SELECT distinct rodzaj from articles order by rodzaj";
$wynik = mysqli_query($link,$query);
  
  $beg = '<articles>';
  $end = '</articles>';
  echo "$beg\r\n";
  while ($row = mysqli_fetch_assoc($wynik)){
	echo "\t";
	echo '<rodzaje>';
	echo $row['rodzaj'];
	echo '</rodzaje>';
	echo "\r\n";
	}	
  echo $end;

  mysqli_close($link);
?>