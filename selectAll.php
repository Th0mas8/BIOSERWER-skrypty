<?php
//SQL Connection Info - update with your database, username & password
include("parametry.php");

$link = mysqli_connect("$host", "$user", "$password","$database") or die ('cannot reach database');

if (!$link) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

	$jezykZap = $link->prepare("SET NAMES utf8");
  	$jezykZap->execute();

//Change this query as you wish for single or multiple records
//$query="SELECT * FROM people order by id";
$query="SELECT * FROM people order by FIELD(position, 'Associate Professor','Assistant Professor','Research Assistant', 'PhD Student'), SUBSTRING_INDEX(name,' ',-1)";
$result = mysqli_query($link,$query);

//Get the number of rows
$num_row = mysqli_num_rows($result);

//Start the output of XML
echo '<?xml version="1.0" encoding="utf-8"?>';
echo "<data>";
echo '<num>' .$num_row. '</num>';
if (!$result) {
   die('Query failed: ' . mysqli_error());
}    
/* get column metadata - column name -------------------------------------------------*/
        $i = 0;
        while ($i < mysqli_num_fields($result)) {
              $meta = mysqli_fetch_field_direct($result, $i);
            $ColumnNames[] = $meta->name;                      //place col name into array
            $i++;
        }
$specialchar = array("&",">","<");                                         //special characters
$specialcharReplace = array("&amp;","&gt;","&lt;");            //replacement
/* query & convert table data and column names to xml ---------------------------*/

$w = 0;    
while ($line = mysqli_fetch_array($result, MYSQL_ASSOC)) {
   echo "<row>";
    foreach ($line as $col_value){
        echo '<'.$ColumnNames[$w].'>';
        $col_value_strip = str_replace($specialchar, $specialcharReplace, $col_value);        
        echo $col_value_strip;
        echo '</'.$ColumnNames[$w].'>';
        if($w == ($i - 1)) { $w = 0; }
        else { $w++; }
       }
    echo "</row>";
}

echo "</data>";
//mysql_free_result($result);
mysqli_close($link);
?>