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
      <td align="center">แฟ้ม : NCDSCREEN</td>
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
	$sql = "select * from opcard where hn='".$_POST['chn']."'";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	if($result['name']==""){
		echo "ไม่พบผู้ป่วย HN นี้คะ";	
	}else{
		echo "<table border=1><tr><td>HN</td><td>ชื่อ-สกุล</td><td>วันที่มารับบริการ</td></tr>";
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
	 	echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
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
  กรุณากรอกข้อมูลในช่องด้านล่าง แฟ้ม NCDSCREEN
</center>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath2">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td colspan="2">HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
ชื่อ : <?=$result['ptname']?> <br />
เลขที่บัตรปชช. : <input name="idcard" type="text" value="<?=$result2['idcard']?>" /></td>
  </tr>
  <? 
			$d = substr($result['thidate'],8,2);
			$m = substr($result['thidate'],5,2);
			$y = substr($result['thidate'],0,4)-543;
			$seq = "$y$m$d".$result['vn'];
	?>
  <tr>
    <td>ลำดับที่ :</td>
    <td><input name="seq" type="text" id="seq" value="<?=$seq?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td width="30%">วันที่ตรวจ :</td>
    <td width="70%"><input name="dserv" type="text" id="dserv" value="<?="$y$m$d"?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>สถานบริการ :</td>
    <td><select name="pdeath">
      <option value="1">ในสถานบริการ</option>
      <option value="2">นอกสถานบริการ</option>
    </select></td>
  </tr>
  <tr>
    <td>การสูบบุหรี่ :</td>
    <td><select name="cig">
    <option value="1">ไม่สูบ</option>
    <option value="2">สูบนานๆครั้ง</option>
    <option value="3">สูบเป็นครั้งคราว</option>
    <option value="4">สูบเป็นประจำ</option>
    <option value="9">ไม่ทราบ</option>
    </select></td>
  </tr>
  <tr>
    <td>การดื่มเครื่องดื่มแอลกอฮอล์ : </td>
    <td><select name="alco">
      <option value="1">ไม่ดื่ม</option>
      <option value="2">ดื่มนานๆครั้ง</option>
      <option value="3">ดื่มเป็นครั้งคราว</option>
      <option value="4">ดื่มเป็นประจำ</option>
      <option value="9">ไม่ทราบ</option>
    </select></td>
  </tr>
  <tr>
    <td>เบาหวานในญาติสายตรง : </td>
    <td><select name="pask1">
      <option value="1">มีประวัติเบาหวานในญาติสายตรง</option>
      <option value="2">ไม่มี</option>
      <option value="9">ไม่ทราบ</option>
    </select></td>
  </tr>
  <tr>
    <td>ความดันสูงในญาติสายตรง : </td>
    <td><select name="pask2">
      <option value="1">มีประวัติความดันโลหิตสูงในญาติสายตรง</option>
      <option value="2">ไม่มี</option>
      <option value="9">ไม่ทราบ</option>
    </select></td>
  </tr>
  <tr>
    <td>น้ำหนัก</td>
    <td><input name="weight" type="text" id="weight" value="0.00"/>
      กก.</td>
  </tr>
  <tr>
    <td>ส่วนสูง</td>
    <td><input name="height" type="text" id="height" value="0.00"/>
      ซม.</td>
  </tr>
  <tr>
    <td>เส้นรอบเอว</td>
    <td><input name="waist" type="text" id="height2" value="0"/>
      ซม.</td>
  </tr>
  <tr>
    <td>ความดันโลหิต ซิสโตลิก ครั้งที่ 1</td>
    <td><input name="pask3" type="text" id="pask3" value="0"/></td>
  </tr>
  <tr>
    <td>ความดันโลหิต ไดแอสโตลิก ครั้งที่ 1</td>
    <td><input name="pask4" type="text" id="pask4" value="0"/></td>
  </tr>
  <tr>
    <td>ความดันโลหิต ซิสโตลิก ครั้งที่ 2</td>
    <td><input name="pask5" type="text" id="pask5" value="0"/></td>
  </tr>
  <tr>
    <td>ความดันโลหิต ไดแอสโตลิก ครั้งที่ 2</td>
    <td><input name="pask6" type="text" id="pask6" value="0"/></td>
  </tr>
  <tr>
    <td>ระดับน้ำตาลในเลือด</td>
    <td><input name="pask7" type="text" id="pask7" value="0"/></td>
  </tr>
  <tr>
    <td>วิธีการตรวจน้ำตาลในเลือด</td>
    <td><select name="pask8">
      <option value="1">ตรวจน้ำตาลในเลือด จากหลอดเลือดดำ หลังอดอาหาร</option>
      <option value="2">ตรวจน้ำตาลในเลือด จากหลอดเลือดดำ โดยไม่อดอาหาร</option>
      <option value="3">ตรวจน้ำตาลในเลือด จากเส้นเลือดฝอย หลังอดอาหาร</option>
      <option value="4">ตรวจน้ำตาลในเลือด จากเส้นเลือดฝอย โดยไม่อดอาหาร</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="conbtn" type="submit" value=" ยืนยันข้อมูล " /></td>
  </tr>
</table>
</form>
<?
	
}
	?>

</body>
</html>