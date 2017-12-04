<html>
<head>

</head>
<body>
<?
include("connect.inc");

	$strSQL = "UPDATE certificate SET ";
	$strSQL .="bookid = '".$_POST["bookid"]."' ";
	$strSQL .=",noid = '".$_POST["noid"]."' ";
	$strSQL .=",hn = '".$_POST["hn"]."' ";
	$strSQL .=",doctor = '".$_POST["doctor"]."' ";
	$strSQL .=",diag = '".$_POST["diag"]."' ";
	$strSQL .=",comment = '".$_POST["comment"]."' ";
	$strSQL .=",thaidate = '".$_POST["thaidate"]."' ";
	$strSQL .="WHERE row_id = '".$_GET["row_id"]."' ";
	$objQuery = mysql_query($strSQL);
	if($objQuery)
	{
		echo "<center>บันทึกสำเร็จ.</center>";
	}
	else
	{
		echo "<center>Error Save [".$strSQL."]</center>";
	}

?>
</body>
</html>