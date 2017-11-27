<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<? 
include("connect.inc");

$sql="SELECT *
FROM chkup_solider where (yearchkup='61' and active='' and camp = 'D01 Ã¾.¤èÒÂÊØÃÈÑ¡´ÔìÁ¹µÃÕ') order by  row_id asc";
//echo $sql;
$query=mysql_query($sql)or die (mysql_error());
$i=300;
while($arr=mysql_fetch_array($query)){
$i++;

$no=sprintf("%03d",$i);

$runno=$i;
$labno="171206".$no;
$orderdate="2017-12-06";
$ptname=$arr["yot"]." ".$arr["ptname"];
$camp=$arr["camp"];
$row_id=$arr["row_id"];


$labno1=$labno."01";
$labno2=$labno."02";
$labno3=$labno."03";

$edit="update chkup_solider set lab='$labno',qlab='$runno' where row_id='$row_id';";
//$query1=mysql_query($edit);
echo $edit." Save Complete !!!<br>";
}
?>
</body>
</html>
