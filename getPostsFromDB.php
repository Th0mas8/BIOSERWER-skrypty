<?php 
include("parametry.php");

  $link = mysqli_connect("$host", "$user", "$password","$database");
  //$link = mysqli_connect("localhost","scott","tiger","test");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
$stmt = $link->prepare("select id,message,name,link,description,picture from posts order by id desc");
$stmt->execute();
$rez=null;
$i=0;
if ($stmt){
	$stmt->bind_result($rezId,$rezMess,$rezName,$rezLink,$rezDesc,$rezPict);
	echo "<root>";
	print_r($rez);
	while ($stmt->fetch()){
		echo "\n";
		echo "<post>";
		echo "\n\t";
		echo "<id>";
		echo $rezId;
		echo "</id>";
		echo "\n\t";
		echo "<message>";
		echo $rezMess;
		echo "</message>";
		echo "\n\t";
		echo "<name>";
		echo $rezName;
		echo "</name>";
		echo "\n\t";
		echo "<link>";
		echo $rezLink;
		echo "</link>";
		echo "\n\t";
		echo "<description>";
		echo $rezDesc;
		echo "</description>";
		echo "\n\t";
		echo "<picture>";
		echo $rezPict;
		echo "</picture>";
		echo "\n";
		echo "</post>";
		$i=$i+1;
	}
	
	if ($i==1){
		echo "<post>\n";
		echo "\t <id> </id>\n";
		echo "\t <message> </message>\n";
		echo "\t <name> </name>\n";
		echo "\t <link> </link>\n";
		echo "\t <description> </description>\n";
		echo "\t <picture> </picture>\n";
		echo "</post>";
	}
  else if ($i==0){
  	//GDY BAZA JEST PUSTA
		echo "<post>\n";
		echo "\t <id> </id>\n";
		echo "\t <message> </message>\n";
		echo "\t <name> </name>\n";
		echo "\t <link> </link>\n";
		echo "\t <description> </description>\n";
		echo "\t <picture> </picture>\n";
		echo "</post>";
		
		echo "<post>\n";
		echo "\t <id> </id>\n";
		echo "\t <message> </message>\n";
		echo "\t <name> </name>\n";
		echo "\t <link> </link>\n";
		echo "\t <description> </description>\n";
		echo "\t <picture> </picture>\n";
		echo "</post>";
 }
 echo "</root>";
 }
mysqli_close($link);
?>
