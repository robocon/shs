<html>
<head>
<title>อัพโหลด textfile ประกันสังคม</title>
</head>
<body>
<?

if($_FILES["filUpload"]["name"]=='h1252002.txt' ||$_FILES["filUpload"]["name"]=='ssotest992022.txt'){

if(copy($_FILES["filUpload"]["tmp_name"],"dataupdate/".$_FILES["filUpload"]["name"]))
{
	echo "อัพโหลดไฟล์เรียบร้อยแล้ว กรุณารอสักครู่....";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=truncatesso11.php'>";	
}else{
	echo "ไม่สามารถอัพโหลดได้";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=filesso11.php'>";	
}

}else{
	
	echo "ไม่อนุญาติให้อัพโหลดไฟล์นี้";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=filesso11.php'>";	
}

?>
</body>
</html>