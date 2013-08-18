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
  	$stmt = $link->prepare("SELECT tresc from elements where id = ?");
	$stmt->bind_param('d',$_POST['idTabeli']); 
	$stmt->execute();
	
  //$sql = sprintf("SELECT tresc from elements where id = '%d'",$_POST['idTabeli']);
  //$result = mysql_query($sql);
  $beg = '<table>';
  $end = '</table>';
  echo "$beg\r\n";
  echo "\t";
  $i=0;
  if ($stmt){
	$stmt->bind_result($tresc);
	while ($stmt->fetch()){
		$i = $i+1;
		echo $tresc;
	}
	if ($i==1){
		echo '<row></row>';
	}
  } else if ($i==0){
  echo '<row></row>';
 }  
  echo "\r\n";
  echo $end;

  mysqli_close($link);
?>