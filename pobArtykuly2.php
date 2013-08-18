<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=ISO-8859-1');
/*  echo '<article>';  uzywane w indeks.php*/
 /* echo '<node/>';*/
/*  echo '</article>';*/
  echo '<?xml version="1.0"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

  $query = "SELECT * from articles";
  $result = mysqli_query($link,$query);
 
  $beg='<articles nazwa="root">';
  $end='</articles>';
  echo $beg;
  while($row = mysqli_fetch_assoc($result))
  {
	  echo '<node ';
	  echo 'id="';
	  echo $row["id"];
	  echo '" ';
	  echo 'nazwa="';
	  echo str_replace("&", "&amp;", $row["nazwa"]);
	 /* echo $row["nazwa"];*/
	  echo '" ';
	  echo 'adres="';
	  echo $row["adres"];
	  echo '" ';
	  echo 'rodzaj="';
	  echo $row["rodzaj"];
	  echo '" >';
	  
	  if($row["podstrony"] != '')
	  {
		$idList = explode("a", $row["podstrony"]);
		$rozmiar = sizeof($idList);
	  }
	  else
	  {
		$rozmiar = 0;
	  }
	  for($i = 0, $size = $rozmiar; $i < $size; $i++)
	  {
		echo '<podstrona id="';
		echo $idList[$i];
		echo '" />';
	  }
	  echo '</node>';
  }
  echo $end;
  //mysql_free_result($result);
  mysqli_close($link);
?>