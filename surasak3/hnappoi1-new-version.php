<?php
session_start();
unset($_SESSION['cHn']);
unset($_SESSION['cPtname']);
unset($_SESSION['cAge']);
unset($_SESSION['cptright']);
unset($_SESSION['capptime']);
unset($_SESSION['cnote']);
unset($_SESSION['cidguard']);
?>
<form method="post" action="">
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�͡㺹Ѵ������</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN :&nbsp;
		<input type="text" name="hn" size="12" id="aLink">
	</p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="  ��ŧ  " name="B1">
	&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm">&lt;&lt; ����</a>&nbsp&nbsp;&nbsp<a target=_self  href='appoilst.php'>����ª��ͼ����¹Ѵ</a></p>
	����͹  .....  ����͡㺹Ѵ ��س��������ѡ�÷�������� (  , "  '  �繵�)   �Ҩ�����������������ö�ѹ�֡ŧ㹤���������
</form>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>

<table>
	<tr>
		<th bgcolor=CD853F>�͡㺹Ѵ</th>
		<th bgcolor=CD853F>��</th>
		<th bgcolor=CD853F>��Ǩ�Ѵ</th>
		<th bgcolor=CD853F>ʡ��</th>
		<th bgcolor=CD853F>�Է��</th>
		<th bgcolor=CD853F>�����˵�</th>
	</tr>
<?php
$hn = $_POST['hn'];
If (!empty($hn)){
	
	include("connect.inc");
	
	$query = "SELECT hn,yot,name,surname,dbirth,ptright,note,idguard FROM opcard WHERE hn = '$hn'";
	$result = mysql_query($query)
	or die("Query failed");

	while (list ($hn,$yot,$name,$surname,$dbirth,$ptright,$note,$idguard) = mysql_fetch_row ($result)) {
		print (" <tr>\n".
		"  <td BGCOLOR=F5DEB3><a   href=\"preappoi1.php?cHn=$hn&cYot=$yot&cName=$name&cSurname=$surname&Age=$dbirth&ptright=$ptright&note=$note&idguard=$idguard\">$hn</a></td>\n".
		"  <td BGCOLOR=F5DEB3>$yot</td>\n".
		"  <td BGCOLOR=F5DEB3><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">$name</td>\n".
		"  <td BGCOLOR=F5DEB3>$surname</td>\n".
		"  <td BGCOLOR=F5DEB3>$ptright</td>\n".
		"  <td BGCOLOR=F5DEB3>$idguard</td>\n".
		" </tr>\n");
	}
	include("unconnect.inc");
}
?>
</table>
