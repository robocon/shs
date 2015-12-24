<html>
<head>
<title>โปรแกรมให้รหัส Internet</title>
</head>
<body>
<?
	 include("../connect.inc");
	
$thidate=(date("Y")+543).'-'.date("m-d H:i:s");
$type_net=$_POST['type_net'];

		for($i=1;$i<=(int)($_POST["hdnMaxLine"]);$i++)
		{
			if($_POST['user_'.$i] !='' && $_POST['pass_'.$i]){
	$strSQL = "INSERT INTO `internet` ( `register` , `type_net` , `user` , `pass`)
VALUES ('".$thidate."', '".$type_net."', '".$_POST['user_'.$i]."', '".$_POST['pass_'.$i]."');";
	$strQuery=mysql_query($strSQL);
					
		}
		}
	echo "<div class='font2'>บันทึกข้อมูลเรียบร้อยแล้ว.......</div>";
	echo"<meta http-equiv='refresh' content='2;URL=internet_from.php'>";
		mysql_close();
	?>
</body>
</html>