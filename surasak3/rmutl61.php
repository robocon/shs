<?php
include("connect.inc");

$part = "rmutl61";

$sql = "SELECT * FROM `opcardchk` 
WHERE `part` = '$part' 
ORDER BY `row`";
$query = mysql_query($sql) or die (mysql_error());
$i = 301;


while($arr = mysql_fetch_array($query)){

	$hn = $arr["HN"];

    $fullname = $arr["name"].' '.$arr["surname"];
    
    $last3digi = substr($hn, -3);

    
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$fullname</b></center></font>";
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$hn</b></center></font>";
	print "<font  style='line-height:23px;' face='Angsana New' size='5'><center><b>$last3digi</b></center></font>";
    print "<div style=\"page-break-before: always;\"></div>";
    

}
