<html>
<head>

</head>
<body>
<?
include("connect.inc");

	$strSQL = "UPDATE clinic_vip  SET ";
	$strSQL .="hn = '".$_POST["thn"]."' ";
	$strSQL .=",ptname = '".$_POST["tptname"]."' ";
	$strSQL .=",an = '".$_POST["ttan"]."' ";
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