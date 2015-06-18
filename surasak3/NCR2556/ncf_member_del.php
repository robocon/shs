<html>
<head>
<title>ลบข้อมูลผู้ใช้ในระบบ</title>
</head>
<body>
<?
include("connect.inc");

$strSQL = "DELETE FROM member ";
$strSQL .="WHERE member_id ='".$_GET['id']."' ";
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