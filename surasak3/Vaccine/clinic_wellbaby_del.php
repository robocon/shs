<html>
<head>
<title>DELETE RECORD</title>
</head>
<body>
<?
include("Connections/connect.inc.php"); 
$strSQL = "DELETE FROM  well_baby ";
$strSQL .="WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "Record Deleted.";
	echo"<meta http-equiv='refresh' content='2;url=Report_clinic_wellbaby.php'>";
}
else
{
	echo "Error Delete [".$strSQL."]";
	echo"<meta http-equiv='refresh' content='2;url=Report_clinic_wellbaby.php'>";
}
mysql_close($objConnect);
?>
</body>
</html>