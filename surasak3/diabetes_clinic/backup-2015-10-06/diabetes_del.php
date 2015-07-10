<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
include("../connect.php");


$strSQL = " DELETE FROM diabetes_clinic ";
$strSQL .=" WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");	

$strSQL2 = " DELETE FROM  diabetes_lab ";
$strSQL2 .=" WHERE dm_no = '".$_GET["dm_no"]."' ";
$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");


if($objQuery)
{
	echo "Record Deleted.";
	echo "<meta http-equiv=refresh content=2;URL=diabetes_list.php>";
}
else
{
	echo "Error Delete [".$strSQL."]";
	echo "<meta http-equiv=refresh content=2;URL=diabetes_list.php>";
}

?>
</body>
</html>