<html>
<head>
<title>ź�������͡���</title>
</head>
<body>
<?

include("connect.inc");

$sql="SELECT * FROM km_file WHERE doc_id = '".$_GET["doc_id"]."'";	
$objQuery = mysql_query($sql);
while($objResult = mysql_fetch_array($objQuery)){

$strSQL2  ="DELETE  FROM km_file ";
$strSQL2 .="WHERE doc_id='".$objResult["doc_id"]."' ";
$objQuery2 = mysql_query($strSQL2) or die (mysql_error());

$structure = 'km_file/'.$objResult['file_name'];


@unlink($structure);

}

$strSQL1 = "DELETE FROM km ";
$strSQL1 .="WHERE doc_id = '".$_GET["doc_id"]."' ";
$objQuery1 = mysql_query($strSQL1);



if($objQuery1)
{
	echo "�к��ӡ�� ź ���������º�������Ǥ�Ѻ";
	echo "<meta http-equiv=refresh content=1;URL=km_index.php>";
}
else
{
	echo "Error Delete [".$strSQL1."]";
}
?>
</body>
</html>