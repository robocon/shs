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
      <td align="center">��� : FP</td>
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
		<tr><td><?=$result3['hn']?></td><td><?=$result3['ptname']?></td><td><a href="fp.php?show=<?=$result3['row_id']?>"><?="$d-$m-$y $t"?></a></td></tr>
		<?
		}
		echo "</table>";
	}
}elseif(isset($_POST['conbtn'])){
	$thidate= date("YmdHis");
	$sql2 = "insert into fp (  `hn` , `seq` , `date_serv` , `fptype` , `did` , `amount` , `fpplace` , `d_update` , `cid` ) values('".$_POST['nHn']."','".$_POST['seq']."','".$_POST['dserv']."','".$_POST['fptype']."','".$_POST['did']."','".$_POST['amount']."','11512','".$thidate."','".$_POST['idcard']."')";	
	
	 $result = mysql_query($sql2);
	 if($result){
	 	echo "�������������º��������";
		echo "<meta http-equiv='refresh' content='2 url=fp.php';>";
	 }
}elseif(isset($_GET['show'])){
	$sql = "select * from opday where row_id = '".$_GET['show']."' ";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	
	$sql2 = "select * from opcard where hn='".$result['hn']."' ";
	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);
?>
<center>��سҡ�͡������㹪�ͧ��ҹ��ҧ ��� FP</center>
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
    <td width="23%">�ѹ����Ѻ��ԡ�� :</td>
    <td width="77%"><input name="dserv" type="text" id="dserv" value="<?="$y$m$d"?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>�Ըա�ä�����Դ :</td>
    <td><select name="fptype">
      <option value="0">�������</option>
      <option value="1">�����</option>
      <option value="2">�ҩմ</option>
      <option value="3">��ǧ͹����</option>
      <option value="4">�ҽѧ</option>
      <option value="5">�ا�ҧ͹����</option>
      <option value="6">��ѹ���</option>
      <option value="7">��ѹ˭ԧ</option>
    </select>
    </td>
  </tr>
  <tr>
    <td>��Դ�ͧ��,�Ǫ�ѳ�� :</td>
    <td><input type="text" name="did" id="did" /></td>
  </tr>
  <tr>
    <td>�ӹǹ�Ǫ�ѳ�� : </td>
    <td><input type="text" name="amount" id="amount" /></td>
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