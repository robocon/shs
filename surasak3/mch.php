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
      <td align="center">��� : MCH</td>
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
<center>��سҡ�͡������㹪�ͧ��ҹ��ҧ ��� MCH</center>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath2">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td colspan="2">HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
���� : <?=$result['yot']." ".$result['name']." ".$result['surname']?> <br />
�Ţ���ѵû��. : <input name="idcard" type="text" value="<?=$result['idcard']?>" />
  </tr>
  <tr>
    <td width="35%">������� :</td>
    <td width="65%"><input type="text" name="grav" id="grav" /></td>
  </tr>
  <tr>
    <td>�ѹ�á�ͧ����ջ�Ш���͹�����ش���� :</td>
    <td><input type="text" name="lmp" id="lmp" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>�ѹ����˹���ʹ :</td>
    <td><input type="text" name="edc" id="edc" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>�š�õ�Ǩ VDRL_RS :</td>
    <td><select name="vdrlrs">
      <option value="1">����</option>
      <option value="2">�Դ����</option>
      <option value="8">����Ǩ</option>
      <option value="9">�ͼŵ�Ǩ</option>
    </select></td>
  </tr>
  <tr>
    <td>�š�õ�Ǩ HB_RS:</td>
    <td><select name="hbrs">
      <option value="1">����</option>
      <option value="2">�Դ����</option>
      <option value="8">����Ǩ</option>
      <option value="9">�ͼŵ�Ǩ</option>
    </select></td>
  </tr>
  <tr>
    <td>�š�õ�Ǩ HIV_RS : </td>
    <td><select name="hivrs">
      <option value="1">����</option>
      <option value="2">�Դ����</option>
      <option value="8">����Ǩ</option>
      <option value="9">�ͼŵ�Ǩ</option>
    </select></td>
  </tr>
  <tr>
    <td>�ѹ����Ǩ HCT  :</td>
    <td><input type="text" name="dhct" id="dhct" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>�š�õ�Ǩ HCT  :</td>
    <td><input type="text" name="hctrs" id="hctrs" /></td>
  </tr>
  <tr>
    <td>�š�õ�Ǩ THALASSAEMIA :</td>
    <td><select name="thalass">
      <option value="1">����</option>
      <option value="2">�Դ����</option>
      <option value="8">����Ǩ</option>
      <option value="9">�ͼŵ�Ǩ</option>
    </select></td>
  </tr>
  <tr>
    <td>��Ǩ�آ�Ҿ�ѹ����й� (�������) :</td>
    <td><select name="denrs">
      <option value="0">����Ǩ</option>
      <option value="1">��Ǩ</option>
      <option value="9">����Һ</option>
    </select></td>
  </tr>
  <tr>
    <td>�ѹ�� (�ӹǹ) :</td>
    <td><input type="text" name="tcaries" id="tcaries" /></td>
  </tr>
  <tr>
    <td>�Թ������ (���������) :</td>
    <td><select name="tartar">
      <option value="0">�����</option>
      <option value="1">��</option>
      <option value="8">����Ǩ</option>
      <option value="9">����Һ</option>
    </select></td>
  </tr>
  <tr>
    <td>�˧�͡�ѡ�ʺ (���������) :</td>
    <td><select name="guminf">
      <option value="0">�����</option>
      <option value="1">��</option>
      <option value="8">����Ǩ</option>
      <option value="9">����Һ</option>
    </select></td>
  </tr>
  <tr>
    <td>�ѹ��ʹ / �ѹ����ش��õ�駤���� :</td>
    <td><input type="text" name="bdate" id="bdate" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>������ش��õ�駤���� : </td>
    <td><input type="text" name="bresult" id="bresult" /></td>
  </tr>
  <tr>
    <td>ʶҹ����ʹ :</td>
    <td><select name="bplace">
      <option value="1">�ç��Һ��</option>
      <option value="2">ʶҹ�͹����</option>
      <option value="3">��ҹ</option>
      <option value="4">�����ҧ�ҧ</option>
      <option value="5">����</option>
    </select></td>
  </tr>
  <tr>
    <td>�Ըա�ä�ʹ / ����ش��õ�駤���� :</td>
    <td><select name="btype">
      <option value="1">NORMAL</option>
      <option value="2">CESAREAN</option>
      <option value="3">VACUUM</option>
      <option value="4">FORCEPS</option>
      <option value="5">��ҡ�</option>
      <option value="6">ABORTION</option>
    </select></td>
  </tr>
  <tr>
    <td>�������ͧ���Ӥ�ʹ :</td>
    <td><select name="bdoctor">
      <option value="1">ᾷ��</option>
      <option value="2">��Һ��</option>
      <option value="3">��� ��.</option>
      <option value="4">��.��ҳ</option>
      <option value="5">��ͧ�ͧ</option>
    </select></td>
  </tr>
  <tr>
    <td>�ӹǹ�Դ�ժվ :</td>
    <td><input type="text" name="lborn" id="lborn" /></td>
  </tr>
  <tr>
    <td>�ӹǹ��¤�ʹ :</td>
    <td><input type="text" name="sborn" id="sborn" /></td>
  </tr>
  <tr>
    <td>�ѹ�����������駷�� 1 :</td>
    <td><input type="text" name="pcare1" id="pcare1" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>�ѹ�����������駷�� 2 :</td>
    <td><input type="text" name="pcare2" id="pcare2" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>�ѹ�����������駷�� 3 :</td>
    <td><input type="text" name="pcare3" id="pcare3" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>�š�õ�Ǩ��ô���ѧ��ʹ :</td>
    <td><input type="radio" name="pres" value="1" /> ����<input type="radio" name="pres" value="2" /> �Դ���� <input type="radio" name="pres" value="9" /> ����Һ</td>
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
	$sql2 = "insert into mch (  `hn` , `gravida` , `lmp` , `edc` , `vdrl_rs` , `hb_rs` , `hiv_rs` , `datehct` , `htc_rs` , `thalass` , `dental` , `tcaries` , `tartar` , `guminf` , `bdate` , `bresult` , `bplace` , `bhosp` , `btype` , `bdoctor` , `lborn` , `sborn` , `ppcare1` , `ppcare2` , `ppcare3` , `ppres` , `d_update` , `cid` ) values('".$_POST['nHn']."','".$_POST['grav']."','".$_POST['lmp']."','".$_POST['edc']."','".$_POST['vdrlrs']."','".$_POST['hbrs']."','".$_POST['hivrs']."','".$_POST['dhct']."','".$_POST['hctrs']."','".$_POST['thalass']."','".$_POST['denrs']."','".$_POST['tcaries']."','".$_POST['tartar']."','".$_POST['guminf']."','".$_POST['bdate']."','".$_POST['bresult']."','".$_POST['bplace']."','11512','".$_POST['btype']."','".$_POST['bdoctor']."','".$_POST['lborn']."','".$_POST['sborn']."','".$_POST['pcare1']."','".$_POST['pcare2']."','".$_POST['pcare3']."','".$_POST['pres']."','".$thidate."','".$_POST['idcard']."')";	
	
	$result = mysql_query($sql2);
	 if($result){
	 	echo "�������������º��������";
		echo "<meta http-equiv='refresh' content='2 url=mch.php';>";
	 }
}
	?>

</body>
</html>