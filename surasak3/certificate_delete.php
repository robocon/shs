<html>
<head>

</head>
<body>
<?
include("connect.inc");

	$strSQL = "UPDATE certificate  SET status ='N'";
	$strSQL .="WHERE  row_id= '".$_GET["row_id"]."' ";
	$objQuery = mysql_query($strSQL);
	if($objQuery)
	{
		echo "<center>ลบข้อมูลเรียบร้อยแล้ว.</center>";
	}
	else
	{
		echo "<center>Error Delete [".$strSQL."]</center>";
	}

?>
</body>
</html>