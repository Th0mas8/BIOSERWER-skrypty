<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=ISO-8859-1');
  
  echo '<?xml version="1.0"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

  $query = "SELECT * from logo ORDER BY position;";
  $result = mysqli_query($link,$query);
 
  $beg='<logos nazwa="root">';
  $end='</logos>';
  echo $beg;
  while($row = mysqli_fetch_assoc($result))
  {
	  echo '<logo ';
	  echo 'id="';
	  echo $row["id"];
	  echo '" ';
	  echo 'location="';
	  echo $row["location"];
	  echo '" ';
	  echo ' URL="';
	  echo $row["URL"];
	  echo '" ';
	  echo 'position="';
	  echo $row["position"];
	  echo '" ';
	  echo 'isselected="';
	  echo $row["isselected"];
	  echo '" ';
	  echo '/>';
}
  echo $end;
  //mysql_free_result($result);
  mysqli_close($link);
?>