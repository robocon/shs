<title>�������Ѻ��ا������HN</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<p align="center" style="font-weight:bold;">�������Ѻ��ا������HN�ͧ���ѧ�ŷ���Ǩ�آ�Ҿ��Шӻ�</p>
<?
include("connect.inc");
if($_POST["act"]=="edit"){
	$yearcheck=$_POST["year"];  //������Ѻ���ҧ condxofyear_so ��Ŵ� yearcheck
	
	$sql="select row_id, idcard from chkup_solider where yearchkup='$_POST[year]' and idcard !=''";
	$query=mysql_query($sql) or die("Query chkup_solider Error");
	while($rows=mysql_fetch_array($query)){
		$chksql="select dbirth from opcard where idcard='$rows[idcard]'";
		$result=mysql_query($chksql)  or die("Query condxofyear_so Error");
		$num=mysql_num_rows($result);
		$row=mysql_fetch_array($result);
		if(!empty($num)){
			$edit="update chkup_solider set birthday='$row[dbirth]' where row_id='$rows[row_id]'";
			echo $edit."<br>";
			mysql_query($edit);
		}
	}
		echo "<script>alert('��Ѻ��ا���������º��������');window.location='reporthn_chkuparmy.php';</script>";	
}
?>
<form name="form1" method="post" action="updatehn_chkuparmy.php" >
<input name="act" type="hidden" value="edit">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="49%" align="right">�� �.�. (�է�����ҳ)</td>
      <td width="51%"><label>
        <select name="year" id="year">
          <option value="62">2562</option>
        </select>
        <input type="submit" name="button" id="button" value="��Ѻ��ا������">
      </label></td>
    </tr>
  </table>
</form>
