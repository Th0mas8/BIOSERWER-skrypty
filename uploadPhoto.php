<?php

$tempFile = $_FILES['Filedata']['tmp_name'];
$fileName = $_FILES['Filedata']['name'];
$fileSize = $_FILES['Filedata']['size'];

$result  = move_uploaded_file($tempFile, "../assets/" . $fileName);

if ($result) 
{
	$message =  "<result><status>OK</status><message>$par File has been uploaded succesfully. Name $fileName, originally $filename.</message><filename>$fileName</filename></result>";
}
else
{
	$message = "<result><status>Error</status><message>$par Something is wrong with uploading a file named $fileName $tempFile $fileSize.</message><filename></filename></result>";
}
echo $message;
?>