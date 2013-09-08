<?php
  include("parametry.php");
  //byc moze trzeba bedzie zakomentowac header
  header('Content-type: text/xml; charset=utf-8');
  $link = mysqli_connect("$host", "$user", "$password","$database");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();

  $query="SELECT * FROM logo";
  $result = mysqli_query($link,$query);
  $num_row = mysqli_num_rows($result); // to bierzemy jako pozcyje nowego loga, z racji tego ze numerujemy od 0 to nie trzeba dodawac 1

  $stmt = $link->prepare("INSERT INTO logo (URL , location , position) VALUES (?,?,?)");
  $stmt->bind_param('ssd',$_POST["URL"],$_POST["location"],$num_row); 
  $stmt->execute();
  
  //$stmt->close();
  mysqli_close($link);

 // $sql = sprintf("INSERT INTO people VALUES ('%s', '%s', '%s', '%s' ,'%s','%s')",$_POST["name"],$_POST["position"],$_POST["researchInterests"],$_POST["email"],$_POST["webPage"],$_POST["photo"]);
  //$result = mysql_query($sql);
  //mysql_free_result($result);
  //mysql_close($link);
?>