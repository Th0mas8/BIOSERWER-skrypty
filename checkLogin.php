
      <?php
	include("parametry.php");
	//zakomenac?
	//header('Content-type: text/xml; charset=utf-8');
	$link = mysqli_connect("$host", "$user", "$password", "$database");
	if (!$link) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
		$seed="0dAfghRqSTgx";
    //Now let us look for the user in the database.

	$stmt = $link->prepare("SELECT loginid, admin, rulesadmin FROM login WHERE username = ? AND password = ? LIMIT 1;");
	$zm=$_POST['u'];
	$zm2=sha1($_POST['p'].$seed);
	$stmt->bind_param('ss', $zm, $zm2); 
  	$stmt->execute();
	
	$stmt->bind_result($id,$admin,$rulesadmin);
	
	$result = 0;
    while($stmt->fetch())
	{
		$result++;
	}
	
	
  //  $stmt->store_result();
    // If the database returns a 0 as result we know the login information is incorrect.
    // If the database returns a 1 as result we know  the login was correct and we proceed.
    // If the database returns a result > 1 there are multple users
    // with the same username and password, so the login will fail.

  //  if ($stmt->num_rows != 1)
    if ($result != 1)
    {
//!success
        echo "<status>ERROR</status>";
    } else
    {
//success
	session_start();
	$_SESSION['username']=$_POST['u'];
	echo "<status>OK</status>";
	
	
	echo "<id>".$id."</id>";
	echo "<rulesadmin>".$rulesadmin."</rulesadmin>";
	echo "<admin>".$admin."</admin>";
    }
mysqli_close($link);
?>