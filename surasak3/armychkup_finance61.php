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
FROM  `opday` 
WHERE 1 AND  `thidate` 
LIKE  '2560-11-27%' AND  `toborow` 
LIKE  'EX26%' order by  row_id asc";
//echo $sql;
$query=mysql_query($sql)or die (mysql_error());
$i=0;
while($arr=mysql_fetch_array($query)){
$hn=$arr["hn"];
$ptname=$arr["ptname"];
$vn=$arr["vn"];


$sql1="select * from chkup_solider where hn='$hn' and yearchkup='61' and active=''";
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
$result=mysql_fetch_array($query1);
if($num1 < 1){	//
	echo "$hn) ".$ptname."<br>";
}else{
	$i++;
	$getdate=date("Y-m-d H:i:s");
	$row_id=$result["row_id"];
	$edit="update chkup_solider set active='y', finance_date='$getdate', vn='$vn' where row_id='$row_id';";
	$query1=mysql_query($edit);
	echo $edit." Save Complete !!!<br>";
}

}
?>
</body>
</html>
