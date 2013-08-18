<?php
include("parametry.php");

$par = $_POST['isfile'];
//przefiltrowac pliki we flexie
//przeslac za pomoca posta wszystkie parametry i wstawic je razem z plikiem
//tzn najpierw 1polacz, 
//pozniej 2.odczyt sekwencji, 
// 3.copy file, 
// 4.insert do bazy danych wszystkiego
//jezeli sie wykrzaczy pkt <2.5 to wyswietlamy komunikat ze pizda
// jezeli wykrzaczy sie w 3.5 to usuwamy wstawiony plik i wyswietlamy ze pizda
//po 4 jest OK:)

	//1	
$link = mysqli_connect("$host", "$user", "$password","$database");
if (!$link)
{
	$message =  "<result><status>BAD</status><message>Couldn't connect to DB</message></result>";
	echo $message;
	die ("Couldn't connect to DB");
}

	//2
$query = "UPDATE sequence SET id=LAST_INSERT_ID(id+1)";
$status = mysqli_query($link,$query);

if (!$status)
{
	$message =  "<result><status>BAD</status><message>cannot update sequence</message></result>";
	echo $message;
	die("cannot update sequence");
}

$query="SELECT LAST_INSERT_ID()";
$wynik = mysqli_query($link,$query);
if (!$wynik)
{
	$message =  "<result><status>BAD</status><message>cannot get last-insert-id from sequence</message></result>";
	echo $message;
	die("cannot get last-insert-id from sequence");
}

	//3
$tempFile = $_FILES['Filedata']['tmp_name'];
$filename = $_FILES['Filedata']['name'];
$fileSize = $_FILES['Filedata']['size'];
	
	
while($row = mysqli_fetch_array($wynik,MYSQLI_NUM)) 
{
	$nameoffile = $filename."_".$row[0]."".getFileExtension($filename);
}
$result  = move_uploaded_file($tempFile, "../pdf/" . $nameoffile);

if ($result) 
{
	$stmt = $link->prepare("INSERT INTO pdfs(path,uploadTime,included,elementid) VALUES (?,curdate(),false,?)");
	$stmt->bind_param('sd',$nameoffile,$_POST['elementID']); 
	$stmt->execute();
	
	if (!$stmt)
	{
		$message =  "<result><status>BAD</status><message>cannot insert into pdfs</message></result>";
		echo $message;
		unlink($nameoffile);
		die("cannot insert into pdfs");
	}
	$message =  "<result><status>OK</status><message>$par File has been uploaded succesfully. Name $nameoffile, originally $filename.</message><filename>$nameoffile</filename></result>";
}
else
{
	$message = "<result><status>Error</status><message>$par Something is wrong with uploading a file named $nameoffile, originally $filename.</message><filename></filename></result>";
}

echo $message;
mysqli_close($link);

function getFileExtension($filename){
  return substr($filename, strrpos($filename, '.'));
}
?>