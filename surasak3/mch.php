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
      <td align="center">แฟ้ม : MCH</td>
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
<center>กรุณากรอกข้อมูลในช่องด้านล่าง แฟ้ม MCH</center>
<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath2">
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td colspan="2">HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
ชื่อ : <?=$result['yot']." ".$result['name']." ".$result['surname']?> <br />
เลขที่บัตรปชช. : <input name="idcard" type="text" value="<?=$result['idcard']?>" />
  </tr>
  <tr>
    <td width="35%">ครรภ์ที่ :</td>
    <td width="65%"><input type="text" name="grav" id="grav" /></td>
  </tr>
  <tr>
    <td>วันแรกของการมีประจำเดือนครั้งสุดท้าย :</td>
    <td><input type="text" name="lmp" id="lmp" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>วันที่กำหนดคลอด :</td>
    <td><input type="text" name="edc" id="edc" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>ผลการตรวจ VDRL_RS :</td>
    <td><select name="vdrlrs">
      <option value="1">ปกติ</option>
      <option value="2">ผิดปกติ</option>
      <option value="8">ไม่ตรวจ</option>
      <option value="9">รอผลตรวจ</option>
    </select></td>
  </tr>
  <tr>
    <td>ผลการตรวจ HB_RS:</td>
    <td><select name="hbrs">
      <option value="1">ปกติ</option>
      <option value="2">ผิดปกติ</option>
      <option value="8">ไม่ตรวจ</option>
      <option value="9">รอผลตรวจ</option>
    </select></td>
  </tr>
  <tr>
    <td>ผลการตรวจ HIV_RS : </td>
    <td><select name="hivrs">
      <option value="1">ปกติ</option>
      <option value="2">ผิดปกติ</option>
      <option value="8">ไม่ตรวจ</option>
      <option value="9">รอผลตรวจ</option>
    </select></td>
  </tr>
  <tr>
    <td>วันที่ตรวจ HCT  :</td>
    <td><input type="text" name="dhct" id="dhct" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>ผลการตรวจ HCT  :</td>
    <td><input type="text" name="hctrs" id="hctrs" /></td>
  </tr>
  <tr>
    <td>ผลการตรวจ THALASSAEMIA :</td>
    <td><select name="thalass">
      <option value="1">ปกติ</option>
      <option value="2">ผิดปกติ</option>
      <option value="8">ไม่ตรวจ</option>
      <option value="9">รอผลตรวจ</option>
    </select></td>
  </tr>
  <tr>
    <td>ตรวจสุขภาพฟันและแนะนำ (หรือไม่) :</td>
    <td><select name="denrs">
      <option value="0">ไม่ตรวจ</option>
      <option value="1">ตรวจ</option>
      <option value="9">ไม่ทราบ</option>
    </select></td>
  </tr>
  <tr>
    <td>ฝันผุ (จำนวน) :</td>
    <td><input type="text" name="tcaries" id="tcaries" /></td>
  </tr>
  <tr>
    <td>หินน้ำลาย (มีหรือไม่) :</td>
    <td><select name="tartar">
      <option value="0">ไม่มี</option>
      <option value="1">มี</option>
      <option value="8">ไม่ตรวจ</option>
      <option value="9">ไม่ทราบ</option>
    </select></td>
  </tr>
  <tr>
    <td>เหงือกอักเสบ (มีหรือไม่) :</td>
    <td><select name="guminf">
      <option value="0">ไม่มี</option>
      <option value="1">มี</option>
      <option value="8">ไม่ตรวจ</option>
      <option value="9">ไม่ทราบ</option>
    </select></td>
  </tr>
  <tr>
    <td>วันคลอด / วันสิ้นสุดการตั้งครรภ์ :</td>
    <td><input type="text" name="bdate" id="bdate" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>ผลสิ้นสุดการตั้งครรภ์ : </td>
    <td><input type="text" name="bresult" id="bresult" /></td>
  </tr>
  <tr>
    <td>สถานที่คลอด :</td>
    <td><select name="bplace">
      <option value="1">โรงพยาบาล</option>
      <option value="2">สถานีอนามัย</option>
      <option value="3">บ้าน</option>
      <option value="4">ระหว่างทาง</option>
      <option value="5">อื่นๆ</option>
    </select></td>
  </tr>
  <tr>
    <td>วิธีการคลอด / สิ้นสุดการตั้งครรภ์ :</td>
    <td><select name="btype">
      <option value="1">NORMAL</option>
      <option value="2">CESAREAN</option>
      <option value="3">VACUUM</option>
      <option value="4">FORCEPS</option>
      <option value="5">ท่าก้น</option>
      <option value="6">ABORTION</option>
    </select></td>
  </tr>
  <tr>
    <td>ประเภทของผู้ทำคลอด :</td>
    <td><select name="bdoctor">
      <option value="1">แพทย์</option>
      <option value="2">พยาบาล</option>
      <option value="3">จนท สส.</option>
      <option value="4">ผด.โบราณ</option>
      <option value="5">คลองเอง</option>
    </select></td>
  </tr>
  <tr>
    <td>จำนวนเกิดมีชีพ :</td>
    <td><input type="text" name="lborn" id="lborn" /></td>
  </tr>
  <tr>
    <td>จำนวนตายคลอด :</td>
    <td><input type="text" name="sborn" id="sborn" /></td>
  </tr>
  <tr>
    <td>วันที่ดูแลแม่ครั้งที่ 1 :</td>
    <td><input type="text" name="pcare1" id="pcare1" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>วันที่ดูแลแม่ครั้งที่ 2 :</td>
    <td><input type="text" name="pcare2" id="pcare2" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>วันที่ดูแลแม่ครั้งที่ 3 :</td>
    <td><input type="text" name="pcare3" id="pcare3" />(2012/01/01)->20120101</td>
  </tr>
  <tr>
    <td>ผลการตรวจมารดาหลังคลอด :</td>
    <td><input type="radio" name="pres" value="1" /> ปกติ<input type="radio" name="pres" value="2" /> ผิดปกติ <input type="radio" name="pres" value="9" /> ไม่ทราบ</td>
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
	$sql2 = "insert into mch (  `hn` , `gravida` , `lmp` , `edc` , `vdrl_rs` , `hb_rs` , `hiv_rs` , `datehct` , `htc_rs` , `thalass` , `dental` , `tcaries` , `tartar` , `guminf` , `bdate` , `bresult` , `bplace` , `bhosp` , `btype` , `bdoctor` , `lborn` , `sborn` , `ppcare1` , `ppcare2` , `ppcare3` , `ppres` , `d_update` , `cid` ) values('".$_POST['nHn']."','".$_POST['grav']."','".$_POST['lmp']."','".$_POST['edc']."','".$_POST['vdrlrs']."','".$_POST['hbrs']."','".$_POST['hivrs']."','".$_POST['dhct']."','".$_POST['hctrs']."','".$_POST['thalass']."','".$_POST['denrs']."','".$_POST['tcaries']."','".$_POST['tartar']."','".$_POST['guminf']."','".$_POST['bdate']."','".$_POST['bresult']."','".$_POST['bplace']."','11512','".$_POST['btype']."','".$_POST['bdoctor']."','".$_POST['lborn']."','".$_POST['sborn']."','".$_POST['pcare1']."','".$_POST['pcare2']."','".$_POST['pcare3']."','".$_POST['pres']."','".$thidate."','".$_POST['idcard']."')";	
	
	$result = mysql_query($sql2);
	 if($result){
	 	echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
		echo "<meta http-equiv='refresh' content='2 url=mch.php';>";
	 }
}
	?>

</body>
</html>