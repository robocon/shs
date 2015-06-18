<html>
<head>

</head>
<body>
<?
include("connect.inc");

	$strSQL = "UPDATE  drug_fail_2  SET status_row ='N'";
	$strSQL .="WHERE  row_id= '".$_GET["row_id"]."' ";
	$objQuery = mysql_query($strSQL);
	if($objQuery)
	{
		echo "<center>ลบข้อมูลเรียบร้อยแล้ว.</center>";
		
	?>
    <script language="javascript">
	window.opener.location.reload();
    window.open('','_self');
	self.close();
	</script>
    <?
	}
	else
{
	echo "Error Delete [".$strSQL."]";
	?>
    <script language="javascript">
	window.opener.location.reload();
    window.open('','_self');
	self.close();
	</script>
    <?
}

?>

?>
</body>
</html>