<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");

  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
  $query = "SELECT first_name from employees";
  $result = mysqli_query($link,$query);
  $beg = '<employees>';
  $end = '</employees>';
  $begemployee = '<employee>';
  $endemployee = '</employee>';
  echo "$beg\r\n";
  while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)){
	echo "\t$begemployee\r\n";
	
	foreach($row as $fieldname=>$fieldvalue) {
		$begpole = '<'+$fieldname+'>';
		$endpole = '</'+$fieldname+'>';
		echo"\t\t$begpole$fieldvalue$endpole\r\n";
		}
	echo "\t$endemployee\r\n";
	}
  echo "$end\r\n";
  mysqli_close($link);
?>