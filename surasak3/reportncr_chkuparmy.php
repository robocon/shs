<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ���������§���ѧ�� ��.</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.sarabun {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>

<body>

<form action="reportncr_chkuparmy.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
<p><strong>���͡��Ǣ�ͷ���ͧ��ô٢����� :</strong> 
<select name="selncr" class="sarabun" id="selncr">
  <option value="���������">���������</option>
  <option value="���������§">���������§</option>
  <option value="��������ä">��������ä</option>
</select>
 <label>
 &nbsp;&nbsp;
 <input name="button" type="submit" class="sarabun" id="button" value="�٢�����" />  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ������ѡ</a>
 </label>
</p>
</form>
<?
if($_POST["act"]=="show"){
 	include("connect.inc");
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$showyear="25".$nPrefix;
	
	$sql="select distinct camp1 from condxofyear_so where yearcheck ='$showyear' and camp1 !='' order by camp1";
	//echo $sql;
	$query=mysql_query($sql);
	
	echo "<p><strong>��ª���˹��§ҹ�����ѧ���ѧ�Ѵ ����� : <span style='color:blue'>$_POST[selncr]</span> ��Шӻ� $showyear</strong></p>";
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	if($_POST["selncr"]=="���������"){
	$sql1="select count(row_id) from condxofyear_so where yearcheck ='$showyear' and camp1='$rows[camp1]' and sum1='���� (��辺��������§)'";	
	}else if($_POST["selncr"]=="���������§"){
	$sql1="select count(row_id) from condxofyear_so where yearcheck ='$showyear' and camp1='$rows[camp1]' and sum2='����������§���ͧ�鹵���ä'";	
	}else if($_POST["selncr"]=="��������ä"){
	$sql1="select count(row_id) from condxofyear_so where yearcheck ='$showyear' and camp1='$rows[camp1]' and sum5='���´����ä������ѧ'";		
	}
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($count)=mysql_fetch_array($query1);
	
		echo "<div>$i) <a href='reportncr1_chkuparmy.php?camp=$rows[camp1]&ncr=$_POST[selncr]&yearcheck=$showyear' target='_blank'>$rows[camp1] ($count)</a></div>";
	}
?>

<?
}
?>
</body>
</html>
