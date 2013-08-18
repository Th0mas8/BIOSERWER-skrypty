<?php
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  echo "\r\n";
  $count = $_POST['count'];
  if ($count==1){
	$count = $count + 1;
  }
  $i=0;
  echo '<root>';
  while ($i<$count){
	echo '<row>';
	$string = $_POST['attributes'];
	$arrayOfAttributes = strtok($string,",");
  	while ($arrayOfAttributes!=false){
			echo '<';
			echo $arrayOfAttributes;
			echo '> </';
			echo $arrayOfAttributes;
			echo '>';
			$arrayOfAttributes = strtok(",");
		}
		$i = $i+1;
		echo "</row>";
	}
   echo '</root>';
?>