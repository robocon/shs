<title>�������Ѻ��ا�������ѧ�Ѵ</title>
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
	$yearcheck="25".$_POST["year"];  //������Ѻ���ҧ condxofyear_so ��Ŵ� yearcheck
	
	$sql="select * from chkup_solider where  	yearchkup='$_POST[year]'";
	$query=mysql_query($sql) or die("Query chkup_solider Error");
	while($rows=mysql_fetch_array($query)){
		$chksql="select * from condxofyear_so where hn='$rows[hn]' and yearcheck='$yearcheck'";
		$result=mysql_query($chksql)  or die("Query condxofyear_so Error");
		$num=mysql_num_rows($result);
		$row=mysql_fetch_array($result);
		if(!empty($num)){
			$edit="update condxofyear_so set chunyot1='$rows[chunyot]' where hn='$row[hn]' and yearcheck='$yearcheck'";
			mysql_query($edit);
		}
	}
		echo "<script>alert('��Ѻ��ا���������º��������');window.location='reportchunyot_chkuparmy.php';</script>";	
}
?>
<form name="form1" method="post" action="updatechunyot_chkuparmy.php" >
<input name="act" type="hidden" value="edit">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">�� �.�. (�է�����ҳ)
        <label>
        <select name="year" id="year">
          <option value="58">2558</option>
          <option value="59">2559</option>
          <option value="60">2560</option>
          <option value="61">2561</option>
          <option value="62">2562</option>          
        </select>
        <input type="submit" name="button" id="button" value="��Ѻ��ا������">
        </label></td>
    </tr>
  </table>
</form>
