<html>
<head>
<title>ลบข้อมูลเอกสาร</title>
</head>
<body>
<?

include("connect.inc");

$sql="SELECT * FROM document_file WHERE doc_id = '".$_GET["doc_id"]."'";	
$objQuery = mysql_query($sql);
while($objResult = mysql_fetch_array($objQuery)){

$strSQL2  ="DELETE  FROM document_file ";
$strSQL2 .="WHERE doc_id='".$objResult["doc_id"]."' ";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());

$structure = 'document_file/'.$objResult['file_name'];


@unlink($structure);

}

$strSQL1 = "DELETE FROM document ";
$strSQL1 .="WHERE doc_id = '".$_GET["doc_id"]."' ";
$objQuery1 = mysql_query($strSQL1);



if($objQuery1)
{
	echo "ระบบทำการ ลบ ข้อมูลเรียบร้อยแล้วครับ";
	echo "<meta http-equiv=refresh content=4;URL=document_list.php>";
}
else
{
	echo "Error Delete [".$strSQL1."]";
}
?>
</body>
</html>