<html>
<head>
<title>�Ѿ��Ŵ textfile ��Сѹ�ѧ��</title>
</head>
<body>
<?

if($_FILES["filUpload"]["name"]=='cscddata.txt'){

if(copy($_FILES["filUpload"]["tmp_name"],"dataupdate/".$_FILES["filUpload"]["name"]))
{
	echo "�Ѿ��Ŵ������º�������� ��س����ѡ����....";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=truncatecscd.php'>";	
}else{
	echo "�������ö�Ѿ��Ŵ��";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=filecscd1.php'>";	
}

}else{
	
	echo "���͹حҵ�����Ѿ��Ŵ�����";
	echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=filecscd1.php'>";	
}

?>
</body>
</html>