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
  	$stmt = $link->prepare("SELECT id from articles where rodzaj = ? and nazwa = ?");
	$stmt->bind_param('ss',$_POST["rodzaj"],$_POST["nazwa"]); 
	$stmt->execute();

  //$sql = sprintf("SELECT id from articles where rodzaj = '%s' and nazwa = '%s'",$_POST["rodzaj"],$_POST["nazwa"]);
  //$result = mysql_query($sql);
  $stmt->bind_result($id);
  
  $beg = "<articles>";
  $end = "</articles>";
  echo "$beg\r\n\t";
  $stmt->fetch();
  echo '<id>';
  echo $id;
  echo '</id>';
  echo "\r\n";
  echo $end;

  mysqli_close($link);
?>