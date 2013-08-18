<?php
//trzeba bedzie umieszczac w bazie danych plain text po tym przeszukiwac
error_reporting(-1);
include("parametry.php");
  header('Content-type: text/xml; charset=utf-8');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  
$link = mysqli_connect("$host", "$user", "$password","$database");
if (!$link)
{
	$message =  "<result><status>BAD</status><message>Couldn't connect to DB</message></result>";
	echo $message;
	die ("Couldn't connect to DB");
}

	$param1 = $_POST["searchText"];

	$tok = strtok($param1,' ');
	//echo $tok.'<br/>';

	$conditionAND = " opis LIKE '%".$tok."%'";
	$conditionOR = " opis LIKE '%".$tok."%'";
	$case = "(case when locate('".$tok."',opis)>0 then substring(opis,if(locate('".$tok."',opis)-200<5,1,locate('".$tok."',opis)-200),400)";
	while($tok = strtok(' '))
	{
		$conditionAND .= " AND opis LIKE '%".$tok."%'";
		$conditionOR .= " OR opis LIKE '%".$tok."%'";
		$case .= " when locate('".$tok."',opis)>0 then substring(opis,if( locate( '".$tok."', opis ) -200 <5, 1, locate( '".$tok."', opis ) -200),400)";
		//echo $tok.'<br/>';
	}
	$case .= " END)"; 

	//echo $conditionAND.'<br/>';
	//echo $conditionOR.'<br/>';
	
	//	(case when substring(opis,locate ('research',opis),100)=="" then substring(opis,locate ('research',opis),100)
	//when substring(opis,locate ('dna',opis),100)=="" then substring(opis,locate ('dna',opis),100) END;)
	
	$query="SELECT DISTINCT articleid, nazwa,".$case.", e.id FROM elements e INNER JOIN articles a ON e.articleid = a.id WHERE ".$conditionAND;
	//echo $query.'<br/>';

	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();

  	$stmt = $link->prepare($query);
	$stmt->execute();
	$stmt->bind_result($articleid,$articlename,$loc,$elementid);

	
	echo "<articles>";
	while ($stmt->fetch()){		
		echo "<article>";
		echo "<articleid>".$articleid."</articleid>";
		echo "<elementid>".$elementid."</elementid>";
		echo "<articlename>".$articlename."</articlename>";
		//if ($loc=="") echo "<result>tede</result>";	
		//else 
		echo "<result>".$loc."</result>";	
		echo "<searchText>".$_POST["searchText"]."</searchText>";
		echo "</article>";
	}
	echo "</articles>";
				

mysqli_close($link);
?>