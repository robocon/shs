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
      <td align="center">��� : NCDSCREEN</td>
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
	$sql = "select * from opcard where hn='".$_POST['chn']."'";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	if($result['name']==""){
		echo "��辺������ HN ����";	
	}else{
		echo "<table border=1><tr><td>HN</td><td>����-ʡ��</td><td>�ѹ������Ѻ��ԡ��</td></tr>";
		$sql3 = "select * from opday where hn = '".$_POST['chn']."' order by thidate desc";
		$rows3 = mysql_query($sql3);
		while($result3 = mysql_fetch_array($rows3)){
			$d = substr($result3['thidate'],8,2);
			$m = substr($result3['thidate'],5,2);
			$y = substr($result3['thidate'],0,4);
			$t = substr($result3['thidate'],11);
		?>
		<tr><td><?=$result3['hn']?></td><td><?=$result3['ptname']?></td><td><a href="ncdscreen.php?show=<?=$result3['row_id']?>"><?="$d-$m-$y $t"?></a></td></tr>
		<?
		}
		echo "</table>";
	}
}elseif(isset($_POST['conbtn'])){
	$thidate= date("YmdHis");
	$sql2 = "insert into ncdscreen ( `hn` , `seq` , `dateexam` , `place` , `smoke` , `alcohol` , `dmfamily` , `htfamily` , `weight` , `height` , `waist` , `bph1` , `bpl1` , `bph2` , `bpl2` , `bslevel` , `bstest` , `d_update` , `cid`  ) values('".$_POST['nHn']."','".$_POST['seq']."','".$_POST['dserv']."','".$_POST['pdeath']."','".$_POST['cig']."','".$_POST['alco']."','".$_POST['pask1']."','".$_POST['pask2']."','".$_POST['weight']."','".$_POST['height']."','".$_POST['waist']."','".$_POST['pask3']."','".$_POST['pask4']."','".$_POST['pask5']."','".$_POST['pask6']."','".$_POST['pask7']."','".$_POST['pask8']."','".$thidate."','".$_POST['idcard']."')";	
	
	 $result = mysql_query($sql2);
	 if($result){
	 	echo "�������������º��������";
		echo "<meta http-equiv='refresh' content='2 url=ncdscreen.php';>";
	 }
}elseif(isset($_GET['show'])){
	$sql = "select * from opday where row_id = '".$_GET['show']."' ";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	
	$sql2 = "select * from opcard where hn='".$result['hn']."' ";
	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);
?>
<center>
  ��سҡ�͡������㹪�ͧ��ҹ��ҧ ��� NCDSCREEN
</center>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath2">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td colspan="2">HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
���� : <?=$result['ptname']?> <br />
�Ţ���ѵû��. : <input name="idcard" type="text" value="<?=$result2['idcard']?>" /></td>
  </tr>
  <? 
			$d = substr($result['thidate'],8,2);
			$m = substr($result['thidate'],5,2);
			$y = substr($result['thidate'],0,4)-543;
			$seq = "$y$m$d".$result['vn'];
	?>
  <tr>
    <td>�ӴѺ��� :</td>
    <td><input name="seq" type="text" id="seq" value="<?=$seq?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td width="30%">�ѹ����Ǩ :</td>
    <td width="70%"><input name="dserv" type="text" id="dserv" value="<?="$y$m$d"?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>ʶҹ��ԡ�� :</td>
    <td><select name="pdeath">
      <option value="1">�ʶҹ��ԡ��</option>
      <option value="2">�͡ʶҹ��ԡ��</option>
    </select></td>
  </tr>
  <tr>
    <td>����ٺ������ :</td>
    <td><select name="cig">
    <option value="1">����ٺ</option>
    <option value="2">�ٺ�ҹ����</option>
    <option value="3">�ٺ�繤��駤���</option>
    <option value="4">�ٺ�繻�Ш�</option>
    <option value="9">����Һ</option>
    </select></td>
  </tr>
  <tr>
    <td>��ô�������ͧ������š����� : </td>
    <td><select name="alco">
      <option value="1">������</option>
      <option value="2">�����ҹ����</option>
      <option value="3">�����繤��駤���</option>
      <option value="4">�����繻�Ш�</option>
      <option value="9">����Һ</option>
    </select></td>
  </tr>
  <tr>
    <td>����ҹ㹭ҵ���µç : </td>
    <td><select name="pask1">
      <option value="1">�ջ���ѵ�����ҹ㹭ҵ���µç</option>
      <option value="2">�����</option>
      <option value="9">����Һ</option>
    </select></td>
  </tr>
  <tr>
    <td>�����ѹ�٧㹭ҵ���µç : </td>
    <td><select name="pask2">
      <option value="1">�ջ���ѵԤ����ѹ���Ե�٧㹭ҵ���µç</option>
      <option value="2">�����</option>
      <option value="9">����Һ</option>
    </select></td>
  </tr>
  <tr>
    <td>���˹ѡ</td>
    <td><input name="weight" type="text" id="weight" value="0.00"/>
      ��.</td>
  </tr>
  <tr>
    <td>��ǹ�٧</td>
    <td><input name="height" type="text" id="height" value="0.00"/>
      ��.</td>
  </tr>
  <tr>
    <td>����ͺ���</td>
    <td><input name="waist" type="text" id="height2" value="0"/>
      ��.</td>
  </tr>
  <tr>
    <td>�����ѹ���Ե �����ԡ ���駷�� 1</td>
    <td><input name="pask3" type="text" id="pask3" value="0"/></td>
  </tr>
  <tr>
    <td>�����ѹ���Ե ������ԡ ���駷�� 1</td>
    <td><input name="pask4" type="text" id="pask4" value="0"/></td>
  </tr>
  <tr>
    <td>�����ѹ���Ե �����ԡ ���駷�� 2</td>
    <td><input name="pask5" type="text" id="pask5" value="0"/></td>
  </tr>
  <tr>
    <td>�����ѹ���Ե ������ԡ ���駷�� 2</td>
    <td><input name="pask6" type="text" id="pask6" value="0"/></td>
  </tr>
  <tr>
    <td>�дѺ��ӵ������ʹ</td>
    <td><input name="pask7" type="text" id="pask7" value="0"/></td>
  </tr>
  <tr>
    <td>�Ըա�õ�Ǩ��ӵ������ʹ</td>
    <td><select name="pask8">
      <option value="1">��Ǩ��ӵ������ʹ �ҡ��ʹ���ʹ�� ��ѧʹ�����</option>
      <option value="2">��Ǩ��ӵ������ʹ �ҡ��ʹ���ʹ�� �����ʹ�����</option>
      <option value="3">��Ǩ��ӵ������ʹ �ҡ������ʹ��� ��ѧʹ�����</option>
      <option value="4">��Ǩ��ӵ������ʹ �ҡ������ʹ��� �����ʹ�����</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="conbtn" type="submit" value=" �׹�ѹ������ " /></td>
  </tr>
</table>
</form>
<?
	
}
	?>

</body>
</html>