<html>
<head>
<title>�Ѿ��Ŵ textfile ͻ�.</title>
</head>
<body>
<?

if($_FILES["filUpload"]["name"]=='optdata.txt'){

if(copy($_FILES["filUpload"]["tmp_name"],"dataupdate/".$_FILES["filUpload"]["name"]))
{
	echo "�Ѿ��Ŵ������º�������� ��س����ѡ����....";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=truncateopt.php'>";	
}else{
	echo "�������ö�Ѿ��Ŵ��";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=fileopt1.php'>";	
}

}else{
	
	echo "���͹حҵ�����Ѿ��Ŵ�����";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=fileopt1.php'>";	
}

?>
</body>
</html>