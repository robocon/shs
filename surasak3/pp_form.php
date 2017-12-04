<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table border="1">
    <tr>
      <td>รหัสสถานบริการ</td>
      <td><label for="pcucode"></label>
      <input name="pcucode" type="text" id="pcucode" value="11512" /></td>
    </tr>
    <tr>
      <td>ทะเบียนบุคคล(เด็ก)</td>
      <td><input type="text" name="pid" id="pid" /></td>
    </tr>
    <tr>
      <td>ทะเบียนบุคคล(แม่)</td>
      <td><input type="text" name="mpid" id="mpid" /></td>
    </tr>
    <tr>
      <td>ครรภ์ที่</td>
      <td><input type="text" name="gravida" id="gravida" /></td>
    </tr>
    <tr>
      <td>วันที่คลอด</td>
      <td><input type="text" name="bdate" id="bdate" /></td>
    </tr>
    <tr>
      <td>สถานที่คลอด</td>
      <td><select name="bplace">
      <option value="1">โรงพยาบาล</option>
      <option value="2">สถานีอนามัย</option>
      <option value="3">บ้าน</option>
      <option value="4">ระหว่างทาง</option>
      <option value="5">อื่นๆ</option>
      </select>
      
    </tr>
    <tr>
      <td>รหัสสถานพยาบาลที่คลอด</td>
      <td><input type="text" name="bhosp" id="bhosp" /></td>
    </tr>
    <tr>
      <td>วิธีการคลอด</td>
      <td><select name="btype">
      <option value="1">NORMAL</option>
      <option value="2">CESAREAN</option>
      <option value="3">VACUUM</option>
      <option value="4">FORCEPS</option>
      <option value="5">ท่าก้น</option>
      </select>
    </td>
    </tr>
    <tr>
      <td>ประเภทของผู้ทำคลอด</td>
      <td><select name="bdoctor">
      <option value="1">แพทย์</option>
      <option value="2">พยาบาล</option>
      <option value="3">จนท สส.</option>
      <option value="4">ผด.โบราณ</option>
      <option value="5">คลอดเอง(ตามใบสูติบัตร)</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>น้ำหนักแรกคลอด(กรัม)</td>
      <td>
      <input type="text" name="bweight" id="bweight" /></td>
    </tr>
    <tr>
      <td>ภาวการณ์ขาดออกซิเจน</td>
      <td><select name="asphyxia">
      <option value="0">ไม่ขาด</option>
      <option value="1">ขาด</option>
      <option value="9">ไม่ทราบ</option>
      
      </select></td>
    </tr>
    <tr>
      <td>ได้รับ VIT K หรือไม่</td>
      <td><select name="vitk">
      <option value="0">ไม่ได้รับ</option>
      <option value="1">ได้รับ</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>วันที่ดูแลลูกครั้งที่1</td>
      <td><input type="text" name="bcare1" id="bcare1" /></td>
    </tr>
    <tr>
      <td>วันที่ดูแลลูกครั้งที่2</td>
      <td><input type="text" name="bcare2" id="bcare2" /></td>
    </tr>
    <tr>
      <td>วันที่ดูแลลูกครั้งที่3</td>
      <td><input type="text" name="bcare3" id="bcare3" /></td>
    </tr>
    <tr>
      <td>ผลการตรวจทารกหลังคลอด</td>
      <td><select name="bcres">
      <option value="1">ปกติ</option>
      <option value="2">ผิดปกติ</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>วันเดือนปีที่ปรับปรุง</td>
      <td><input type="text" name="d_update" id="d_update" /></td>
    </tr>
    <tr>
      <td>เลขที่บัตรประชาชน</td>
      <td><input type="text" name="cid" id="cid" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="b1" id="b1" value="บันทึก" /></td>
    </tr>
  </table>
</form>

<? 
if(isset($_POST['b1'])){
	
	include("connect.inc");
	
	$d_update=date("Y-m-d H:i:s");
	
$sql="INSERT INTO `pp` (  `pcucode` , `ref_pid` , `ref_hn` , `gravida` , `bdate` , `bplace` , `bhost` , `btype` , `bdoctor` , `bweight` , `asphyxia` , `vitk` , `bcare1` , `bcare2` , `bcare3` , `bcres` , `d_update` , `cid` )
VALUES ('".$_POST['pcucode']."', '".$_POST['pid']."', '".$_POST['mpid']."', '".$_POST['gravida']."', '".$_POST['bdate']."', '".$_POST['bplace']."', '".$_POST['bhost']."', '".$_POST['btype']."', '".$_POST['bdoctor']."', '".$_POST['bweight']."', '".$_POST['asphyxia']."', '".$_POST['vitk']."', '".$_POST['bcare1']."', '".$_POST['bcare2']."', '".$_POST['bcare3']."','".$_POST['bcres']."', '".$d_update."', '".$_POST['cid']."')";
$result=mysql_query($sql) or die (mysql_error());




if($result){
	
	echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
	
}else{
	
	echo "ไม่สามารถเพิ่มข้อมูลได้";
}
	
	
	
}


?>




</body>
</html>