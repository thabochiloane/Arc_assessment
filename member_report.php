<?php
$servername = "localhost";
$username = "easyghnv_arc";
$password = "+5I*rm!.ag@u";
$dbname = "easyghnv_exportcsv";

## Script for dumping tables from a MySQL database into an excel spreadsheet
$exceldate   = (date ("FYD"));
$header = ""; 
$data ="First Name\Last Name\Password\ID Number\Email\Mobile\t\n";
{
mysql_connect($servername, $username, $password) or die ("No connection");
mysql_select_db($dbname);

$result = mysql_query("SELECT
firstName,
lastName,
password,
IDNumber,
Email,
Mobile FROM adminUser") or die ("Gotta Database jhjhb
Error");
if (!$result) {print "No results could be exported";}
$count = mysql_num_fields($result); 

for ($i = 0; $i < $count; $i++){ 
$header .= mysql_field_name($result, $i)."\t"; 
} 
while($row = mysql_fetch_row($result)){         
	$line = ''; 
    foreach($row as $value){ 
        if(!isset($value)){ 
            $line .= " \t"; 
        } 
        elseif ($value != ''){ 
            $line .= $value."\t"; 
        } 
        else{ 
            $line .= " \t"; //nessecary?! 
        } 
    } 
    $data .= trim($line)."\t \n"; 
 }
//print more than one header per line? 
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$exceldate.xls"); 
print $data;
}
?>