<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
  //mysql_select_db("$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
  //$sql = sprintf("SELECT id,articleid,nrporzadkowy,tresc,rodzaj, opis from elements where articleid = '%s' order by nrporzadkowy",$_POST["id"]);
  //$result = mysql_query($sql);
	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();
  	$stmt = $link->prepare("SELECT id,articleid,nrporzadkowy,tresc,rodzaj, opis from elements where articleid = ? order by nrporzadkowy");
	$stmt->bind_param('d',$_POST["id"]); 
	$stmt->execute();
  
	$stmt->bind_result($id, $articleid,$nrporzadkowy,$tresc,$rodzaj, $opis);
  $beg = '<articles>';
  $end = '</articles>';
  echo "$beg";
  while($stmt->fetch())
  {
	  echo '<node>';
	  echo '<id>';
	  echo $id;
	  echo '</id>';
	  echo '<articleid>';
	  echo $articleid;
	  echo '</articleid>';
	  echo '<nrporzadkowy>';
	  echo $nrporzadkowy;
	  echo '</nrporzadkowy>';
	  echo '<tresc>';
	  echo $tresc;
	  echo '</tresc>';
	  echo '<opis>';
	  echo $opis;
	  echo '</opis>';
	  echo '<rodzaj>';
	  echo $rodzaj;
	  echo '</rodzaj>'; 
	  echo '</node>';
  }
  echo $end;
  mysqli_close($link);
?>
