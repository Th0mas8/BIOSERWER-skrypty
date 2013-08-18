<?php
  include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysql_connect_error());
  exit();
}
  $stmt = $link->prepare("INSERT INTO elements (rodzaj, articleid,nrporzadkowy) VALUES(?,?,?)");
  $stmt->bind_param('sss',$_POST["rodzaj"],$_POST["articleid"],$_POST["nrporzadkowy"] ); 
  $stmt->execute();
  
  $stmt->close();
  mysqli_close($link);
?>