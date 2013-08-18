<?php 
include("parametry.php");

  $link = mysqli_connect("$host", "$user", "$password","$database");
  //$link = mysqli_connect("localhost","scott","tiger","test");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
  $stmt = $link->prepare("delete from posts where id=?");
  $stmt->bind_param('d',$_POST["id"]);
  $stmt->execute();
?>