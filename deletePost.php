<?php 
require 'php/facebook.php';
include("parametry.php");

  $link = mysqli_connect("$host", "$user", "$password","$database");
  //$link = mysqli_connect("localhost","scott","tiger","test");
  if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
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

  $stmt = $link->prepare("select id_post from posts where id=?");
  $stmt->bind_param('d',$_POST["id"]);
  $stmt->execute();
  $stmt->bind_result($rezId);
  while ($stmt->fetch());
  echo "\r\narticle id artykulu:";
  echo $rezId;
  $facebook->api('/'.$rezId.'?access_token='.$access_token,'DELETE');
  
  $stmt = $link->prepare("delete from posts where id=?");
  $stmt->bind_param('d',$_POST["id"]);
  $stmt->execute();
 
 mysqli_close($link);
?>