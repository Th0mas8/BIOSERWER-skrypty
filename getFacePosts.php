<?php 
require 'php/facebook.php';
include("parametry.php");

  $link = mysqli_connect("$host", "$user", "$password","$database");
  //$link = mysqli_connect("localhost","scott","tiger","test");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}


function parsujAdres($adres){
 $pocz = strpos($adres,"src");
 $rez = substr($adres,$pocz+4);
 $rez = str_replace("%3A",":",$rez);
 $rez = str_replace("%2F","/",$rez);
 $rez = str_replace("%7E","~",$rez);
 echo $rez;
}

function wypiszArticleId($id){
if (!$link){
 $link = mysqli_connect("localhost","scott","tiger","test");
}
 $stmt = $link->prepare("select articleId from posts where id=?");
 $stmt->bind_param('s',$id);
 $stmt->execute();
 $stmt->bind_result($rez);
 echo $rez;
}

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(  'appId'  => '174689805883588',  'secret' => 'e4e81d9a7623fb721b7b08575ecabbd3',  'cookie' => true,));
// We may or may not have this data based on a $_GET or $_COOKIE based session.//
// If we get a session here, it means we found a correctly signed session using// 
//the Application Secret only Facebook and the Application know. We dont know// 
//if it is still valid until we make an API call using the session. A session// 
//can become invalid if it has already expired (should not be getting the// 
//session back in this case) or if the user logged out of Facebook.
$session = $facebook->getSession();
$me = null;
// Session based API call.
if ($session) {  
try {    
	$uid = $facebook->getUser();
    $me = $facebook->api('/100001981492774');
	} 
catch (FacebookApiException $e) {
    error_log($e);
	}}

if ($me) {
  $logoutUrl = $facebook->getLogoutUrl();}
  else {  
	$loginUrl = $facebook->getLoginUrl();}
	
	$result = $facebook->api('/100001981492774/feed?access_token='.$access_token);
	//print_r ($result);
	$i=0;
	echo "<root>";
	while ($rez=$result["data"][$i]){
		echo "\n";
		echo "<post>";
		echo "\n\t";
		echo "<id>";
		echo $rez["id"];
		echo "</id>";
		echo "\n\t";
		echo "<message>";
		echo $rez["message"];
		echo "</message>";
		echo "\n\t";
		echo "<name>";
		echo $rez["name"];
		echo "</name>";
		echo "\n\t";
		echo "<link>";
		echo $rez["link"];
		echo "</link>";
		echo "\n\t";
		echo "<description>";
		echo $rez["description"];
		echo "</description>";
		echo "\n\t";
		echo "<picture>";
		parsujAdres($rez["picture"]);
		echo "</picture>";
		echo "\n\t";
				
		$stmt = $link->prepare("select articleId from posts where id=?");
		$stmt->bind_param('s',$rez["id"]);
		$stmt->execute();
		$stmt->bind_result($result);
		echo $result;
				
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
	 echo "\t <articleId> </articleId>\n";
	 echo "</post>";
	}
	echo "\n";
	echo "</root>";
mysqli_close($link);
?>
