<html>
<head>
<title>ลบข้อมูลอุปกรณ์</title>
</head>
<body>
<?
include("../connect.inc");

$strSQL = "DELETE FROM cms ";
$strSQL .="WHERE row_id ='".$_GET['row_id']."' ";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	echo "Record Deleted.";
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
</body>
</html>