<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<a target=_top  href="../nindex.htm"><< ไปเมนู </a><br />
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath1">
<table width="50%" border="1" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">แฟ้ม : WOMEN</td>
    </tr>
    <tr>
      <td height="41" align="center">HN : 
          <input type="text" name="chn" id="chn" /></td>
    </tr>
    <tr>
      <td height="37" align="center">
        <input name="ok" type="submit" value="ตกลง" /></td>
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
		echo "ไม่พบผู้ป่วย HN นี้คะ";	
	}else{
?>
<center>กรุณากรอกข้อมูลในช่องด้านล่าง แฟ้ม WOMEN</center>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath2">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td colspan="2">HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
ชื่อ : <?=$result['yot']." ".$result['name']." ".$result['surname']?> <br />
เลขที่บัตรปชช. : <input name="idcard" type="text" value="<?=$result['idcard']?>" />
  </tr>
  <tr>
    <td width="23%">วิธีการคุมกำเนิดปัจจุบัน</td>
    <td width="77%">
    <? if($result['sex']=="ช"){?>
    <select name="fptype">
      <option value="0">ไม่ได้คุม</option>
      <option value="1">ยาเม็ด</option>
      <option value="2">ยาฉีด</option>
      <option value="3">ห่วงอนามัย</option>
      <option value="4">ยาฝัง</option>
      <option value="5">ถุงยางอนามัย</option>
      <option value="6">หมันชาย</option>
      <option value="7">หมันหญิง</option>
    </select>
    <? }elseif($result['sex']=="ญ"){?>
	<select name="fptype">
      <option value="0">ไม่ได้คุม</option>
      <option value="1">ยาเม็ด</option>
      <option value="2">ยาฉีด</option>
      <option value="3">ห่วงอนามัย</option>
      <option value="4">ยาฝัง</option>
      <option value="5">ถุงยางอนามัย</option>
      <option value="6">หมันชาย</option>
      <option value="7">หมันหญิง</option>
    </select>
	<? }?>
    </td>
  </tr>
  <tr>
    <td>สาเหตุที่ไม่คุมกำเนิด</td>
    <td><select name="nofp">
      <option value="1">ต้องการบุตร</option>
      <option value="2">หมันธรรมชาติ</option>
      <option value="3">อื่นๆ</option>
    </select></td>
  </tr>
  <tr>
    <td>จำนวนบุตรที่มีชีวิต</td>
    <td><input type="text" name="child" id="child" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="conbtn" type="submit" value=" ยืนยันข้อมูล " /></td>
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
	 	echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
		echo "<meta http-equiv='refresh' content='2 url=women.php';>";
	 }
}
	?>

</body>
</html>