<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=ISO-8859-1');
  
  echo '<?xml version="1.0"?>';
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

  $query = "SELECT * from login ORDER BY loginid;";
  $result = mysqli_query($link,$query);
 
  $beg='<persons nazwa="root">';
  $end='</persons>';
  echo $beg;
  while($row = mysqli_fetch_assoc($result))
  {
	  echo '<person ';
	  echo 'id="';
	  echo $row["loginid"];
	  echo '" ';
	  echo 'username="';
	  echo $row["username"];
	  echo '" ';
	  echo ' email="';
	  echo $row["email"];
	  echo '" ';
	  echo ' admin="';
	  echo $row["admin"];
	  echo '" ';
	  echo ' rulesadmin="';
	  echo $row["rulesadmin"];
	  echo '" ';
	  echo '/>';
}
  echo $end;
  //mysql_free_result($result);
  mysqli_close($link);
?>