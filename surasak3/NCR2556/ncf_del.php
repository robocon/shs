<html>
<head>
<title>ลบข้อมูลใบรายงานเหตุการณ์</title>
</head>
<body>
<?
include("connect.inc");

$strSQL = "DELETE FROM ncr2556  ";
$strSQL .="WHERE nonconf_id ='".$_GET['id']."' ";
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