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
      <td>เลขที่บัตรประชาชน</td>
      <td><input type="text" name="cid" id="cid" /></td>
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
      <td>วันที่ตรวจ</td>
      <td><input type="text" name="date_serv" id="date_serv" /></td>
    </tr>
    <tr>
      <td>รหัสการวินิจฉัย</td>
      <td><input type="text" name="diagcode" id="diagcode" /></td>
    </tr>
    <tr>
      <td>รหัส 506</td>
      <td><input type="text" name="code506" id="code506" /></td>
    </tr>
    <tr>
      <td>วันที่เริ่มป่วย</td>
      <td><input type="text" name="illdate" id="illdate" /></td>
    </tr>
    <tr>
      <td>บ้านเลขที่ (ขณะป่วย)</td>
      <td><input type="text" name="illhouse" id="illhouse" /></td>
    </tr>
    <tr>
      <td>รหัสหมู่บ้าน (ขณะป่วย)</td>
      <td><input type="text" name="illvill" id="illvill" /></td>
    </tr>
    <tr>
      <td>รหัสตำบล (ขณะป่วย)</td>
      <td><input type="text" name="illtamb" id="illtamb" /></td>
    </tr>
    <tr>
      <td>รหัสอำเภอ (ขณะป่วย)</td>
      <td><input type="text" name="illampu" id="illampu" /></td>
    </tr>
    <tr>
      <td>รหัสจังหวัด (ขณะป่วย)</td>
      <td><input type="text" name="illchan" id="illchan" /></td>
    </tr>
    <tr>
      <td>สภาพผู้ป่วย</td>
      <td><input type="text" name="ptstat" id="ptstat" /></td>
    </tr>
    <tr>
      <td>วันที่ตาย</td>
      <td><input type="text" name="date_death" id="date_death" /></td>
    </tr>
    <tr>
      <td>สาเหตุการป่วย</td>
      <td><input type="text" name="complica" id="complica" /></td>
    </tr>
    <tr>
      <td>ชนิดของเชื้อโรค</td>
      <td><input type="text" name="organism" id="organism" /></td>
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
	
$sql="INSERT INTO `serviel` (  `pcucode` , `cid` , `hn` , `seq` , `date_serv` , `diagcode` , `code506` , `illdate` , `illhouse` , `illvill` , `illtamb` , `illampu` , `illchan` , `ptstat` , `date_death` , `complica` , `organism` , `d_update` )
VALUES ('".$_POST['pcucode']."',  '".$_POST['cid']."',  '".$_POST['hn']."',  '".$_POST['seq']."' ,  '".$_POST['date_serv']."', '".$_POST['diagcode']."', '".$_POST['code506']."', '".$_POST['illdate']."', '".$_POST['illhouse']."', '".$_POST['illvill']."', '".$_POST['illtamb']."', '".$_POST['illampu']."', '".$_POST['illchan']."', '".$_POST['ptstat']."', '".$_POST['date_death']."', '".$_POST['complica']."', '".$_POST['organism']."', '".$d_update."')";
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