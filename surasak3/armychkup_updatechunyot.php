<title>�������Ѻ��ا�����Ū����</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<p align="center" style="font-weight:bold;">�������Ѻ��ا�����Ū���Ȣͧ���ѧ�ŷ���Ǩ�آ�Ҿ��Шӻ�</p>
<?
include("connect.inc");
if($_POST["act"]=="edit"){
	$yearcheck=$_POST["year"];  //������Ѻ���ҧ condxofyear_so ��Ŵ� yearcheck
	
	$sql="select * from chkup_solider where yearchkup='$yearcheck'";
	$query=mysql_query($sql) or die("Query chkup_solider Error");
	while($rows=mysql_fetch_array($query)){
		$chksql="select * from armychkup where hn='$rows[hn]' and yearchkup='$yearcheck'";
		$result=mysql_query($chksql)  or die("Query armychkup Error");
		$num=mysql_num_rows($result);
		$row=mysql_fetch_array($result);
		if(!empty($num)){
			$edit="update armychkup set chunyot='$rows[chunyot]' where hn='$row[hn]' and yearchkup='$yearcheck'";
			mysql_query($edit);
		}
	}
		echo "<script>alert('��Ѻ��ا���������º��������');</script>";	
}
?>
<form name="form1" method="post" action="armychkup_updatechunyot.php" >
<input name="act" type="hidden" value="edit">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="49%" align="right">�� �.�. (�է�����ҳ)</td>
      <td width="51%"><label>
        <select name="year" id="year">
          <option value="60" selected>2560</option>
        </select>
        <input type="submit" name="button" id="button" value="��Ѻ��ا������">
      </label></td>
    </tr>
  </table>
</form>
