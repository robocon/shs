<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<a target=_top  href="../nindex.htm"><< ����� </a><br />
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath1">
<table width="50%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">��� : WOMEN</td>
    </tr>
    <tr>
      <td height="41" align="center">HN : 
          <input type="text" name="chn" id="chn" /></td>
    </tr>
    <tr>
      <td height="37" align="center">
        <input name="ok" type="submit" value="��ŧ" /></td>
    </tr>
  </table>
</form><br />
<hr />
<br />

<?
include("connect.inc");
if(isset($_POST['chn'])){
	$sql = "select * from opcard where hn='".$_POST['chn']."' ";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	if($result['name']==""){
		echo "��辺������ HN ����";	
	}else{
?>
<center>��سҡ�͡������㹪�ͧ��ҹ��ҧ ��� WOMEN</center>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath2">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td colspan="2">HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
���� : <?=$result['yot']." ".$result['name']." ".$result['surname']?> <br />
�Ţ���ѵû��. : <input name="idcard" type="text" value="<?=$result['idcard']?>" />
  </tr>
  <tr>
    <td width="23%">�Ըա�ä�����Դ�Ѩ�غѹ</td>
    <td width="77%">
    <? if($result['sex']=="�"){?>
    <select name="fptype">
      <option value="0">�������</option>
      <option value="1">�����</option>
      <option value="2">�ҩմ</option>
      <option value="3">��ǧ͹����</option>
      <option value="4">�ҽѧ</option>
      <option value="5">�ا�ҧ͹����</option>
      <option value="6">��ѹ���</option>
      <option value="7">��ѹ˭ԧ</option>
    </select>
    <? }elseif($result['sex']=="�"){?>
	<select name="fptype">
      <option value="0">�������</option>
      <option value="1">�����</option>
      <option value="2">�ҩմ</option>
      <option value="3">��ǧ͹����</option>
      <option value="4">�ҽѧ</option>
      <option value="5">�ا�ҧ͹����</option>
      <option value="6">��ѹ���</option>
      <option value="7">��ѹ˭ԧ</option>
    </select>
	<? }?>
    </td>
  </tr>
  <tr>
    <td>���˵ط����������Դ</td>
    <td><select name="nofp">
      <option value="1">��ͧ��úص�</option>
      <option value="2">��ѹ�����ҵ�</option>
      <option value="3">����</option>
    </select></td>
  </tr>
  <tr>
    <td>�ӹǹ�ص÷���ժ��Ե</td>
    <td><input type="text" name="child" id="child" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="conbtn" type="submit" value=" �׹�ѹ������ " /></td>
  </tr>
</table>
</form>
<?
	}
}elseif(isset($_POST['conbtn'])){
	$thidate= date("YmdHis");
	$sql2 = "insert into women ( `hn` , `fptype` , `nofp` , `numson` , `d_update` , `cid` ) values('".$_POST['nHn']."','".$_POST['fptype']."','".$_POST['nofp']."','".$_POST['child']."','".$thidate."','".$_POST['idcard']."')";	
	
	 $result = mysql_query($sql2);
	 if($result){
	 	echo "�������������º��������";
		echo "<meta http-equiv='refresh' content='2 url=women.php';>";
	 }
}
	?>

</body>
</html>