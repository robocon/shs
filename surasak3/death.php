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
      <td align="center">��� : DEATH</td>
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
<center>��سҡ�͡������㹪�ͧ��ҹ��ҧ ��� DEATH</center>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath2">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td colspan="2">HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
���� : <?=$result['yot']." ".$result['name']." ".$result['surname']?> <br />
�Ţ���ѵû��. : <input name="idcard" type="text" value="<?=$result['idcard']?>" />

    
    </td>
  </tr>
  <tr>
    <td width="29%">�ѹ����� :</td>
    <td width="71%"><input type="text" name="ddeath" id="ddeath" />(20120101)</td>
  </tr>
  <tr>
    <td>�ä��������˵ء�õ�� :</td>
    <td><input type="text" name="deatha" id="deatha" /></td>
  </tr>
  <tr>
    <td>�ä��������˵ء�õ�� :</td>
    <td><input type="text" name="deathb" id="deathb" /></td>
  </tr>
  <tr>
    <td>�ä��������˵ء�õ�� :</td>
    <td><input type="text" name="deathc" id="deathc" /></td>
  </tr>
  <tr>
    <td>�ä��������˵ء�õ�� :</td>
    <td><input type="text" name="deathd" id="deathd" /></td>
  </tr>
  <tr>
    <td>�ä����������蹷�����˵�˹ع : </td>
    <td><input type="text" name="odi" id="odi" /></td>
  </tr>
  <tr>
    <td>���˵ء�õ�� :</td>
    <td><input type="text" name="cdeath" id="cdeath" /></td>
  </tr>
  <tr>
    <td>ʶҹ����� :</td>
    <td><select name="pdeath">
      <option value="1">�ʶҹ��Һ��</option>
      <option value="2">�͡ʶҹ��Һ��</option>
    </select></td>
  </tr>
  <tr>
    <td>ʶҹС�õ�駤���� :</td>
    <td><select name="dstatus">
      <option value="1">���ª��Ե�����ҧ��駤����</option>
      <option value="2">���ª��Ե�����ҧ��ʹ������ѧ��ʹ���� 42 �ѹ</option>
      <option value="9">����Һ</option>
      <option value="">�óռ����</option>
    </select></td>
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
	$sql2 = "insert into death ( `cid` , `hn` , `ddeath` , `cdeath_a` , `cdeath_b` , `cdeath_c` , `cdeath_d` , `odisease` , `cdeath` , `pdeath` , `d_update` , `pregnancy` ) values('".$_POST['idcard']."','".$_POST['nHn']."','".$_POST['ddeath']."','".$_POST['deatha']."','".$_POST['deathb']."','".$_POST['deathc']."','".$_POST['deathd']."','".$_POST['odi']."','".$_POST['cdeath']."','".$_POST['pdeath']."','".$thidate."','".$_POST['dstatus']."')";	
	 $result = mysql_query($sql2);
	 if($result){
	 	echo "�������������º��������";
		echo "<meta http-equiv='refresh' content='2 url=death.php';>";
	 }
}
	?>

</body>
</html>