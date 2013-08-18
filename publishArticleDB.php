<?php 
include("parametry.php");

  $link = mysqli_connect("$host", "$user", "$password","$database");
 // $link = mysqli_connect("localhost","scott","tiger","test");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
if (strlen($_POST["id"])>0){
  $stmt = $link->prepare("delete from posts where id=?");
  $stmt->bind_param('d',$_POST["id"]);
  $stmt->execute();
}
$stmt = $link->prepare("insert into posts(id_post,message,name,description,link,picture,articleId) values (?,?,?,?,?,?,?)");
	$stmt->bind_param('ssssssd',$_POST["id"],$_POST["message"],$_POST["name"],$_POST["description"],$_POST["link"],$_POST["picture"],$_POST["articleId"]); 
	$stmt->execute();
mysqli_close($link);
?>
