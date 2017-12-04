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
      <td>ทะเบียนบุคคล</td>
      <td><input type="text" name="hn" id="hn" /></td>
    </tr>
    <tr>
      <td>ลำดับที่</td>
      <td><input type="text" name="seq" id="seq" /></td>
    </tr>
    <tr>
      <td>วันที่</td>
      <td><input type="text" name="date_serv" id="date_serv" /></td>
    </tr>
    <tr>
      <td>อายุขณะชั่งน้ำหนัก</td>
      <td><input type="text" name="agemonth" id="agemonth" /></td>
    </tr>
    <tr>
      <td>น้ำหนัก</td>
      <td><input type="text" name="weight" id="weight" /></td>
    </tr>
    <tr>
      <td>ส่วนสูง</td>
      <td><input type="text" name="height" id="height" /></td>
    </tr>
    <tr>
      <td>ระดับโภชนการ</td>
      <td>
      <select name="nlevel">
      <option value="0"  selected="selected">กรุณาเลือก</option>
      <option value="1">ต่ำกว่าเกณฑ์</option>
      <option value="2">ค่อนข้างต่ำ</option>
      <option value="3">ปกติ</option>
      <option value="4">ค่อนข้างสูง</option>
      <option value="5">สูงกว่าเกณฑ์</option>
        <option value="6">สูงก55555กณฑ์</option>
      
      </select>
      </td>
    </tr>
    <tr>
      <td>เลขที่บัตรประชาชน</td>
      <td><input type="text" name="cid" id="cid" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
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
	
$sql="INSERT INTO `nutri` (`pcucode` , `ref_hn` , `seq` , `date_serv` , `agemonth` , `weight` , `height` , `nlevel` , `d_update` , `cid` )
VALUES ( '".$_POST['pcucode']."', '".$_POST['hn']."','".$_POST['seq']."', '".$_POST['date_serv']."', '".$_POST['agemonth']."', '".$_POST['weight']."', '".$_POST['height']."', '".$_POST['nlevel']."', '".$d_update."', '".$_POST['cid']."');";
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