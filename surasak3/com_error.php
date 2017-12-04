<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<link type="text/css" href="datepicker/css/ui-lightness/jquery-ui-timepicker-addon.css" rel="stylesheet" />
</head>
        <script type="text/javascript" src="datepicker/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-1.8.16.custom.min.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="datepicker/js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay =  d.getDate() + '/' + (d.getMonth() + 1) + '/' +  (d.getFullYear());
			

		    $('#com_date').datetimepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});


			});
		</script>
<body>
<a href="com_error_report.php">รายงาน</a>

<fieldset><legend>บันทึกความผิดพลาดจากระบบคอมพิวเตอร์</legend>
<form name="f1" method="post" action="">

<table border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td align="right" valign="top" bgcolor="#99CCFF">วันเวลา :</td>
    <td bgcolor="#99CCFF"><label for="com_date"></label>
      <input type="text" name="com_date" id="com_date" /></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#99CCFF">อาการ :</td>
    <td bgcolor="#99CCFF"><input name="symptoms" type="text" id="symptoms" size="50" /></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#99CCFF">สาเหตุ :</td>
    <td bgcolor="#99CCFF"><label for="cause"></label>
      <textarea name="cause" id="cause" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#99CCFF">การแก้ไข :</td>
    <td bgcolor="#99CCFF"><label for="correction"></label>
      <textarea name="correction" id="correction" cols="45" rows="5"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#99CCFF">ผู้รับผิดชอบ :</td>
    <td bgcolor="#99CCFF"><input type="text" name="staff" id="staff" /></td>
  </tr>
  <tr>
    <td align="right" valign="top" bgcolor="#99CCFF">ระดับความรุนแรง :</td>
    <td bgcolor="#99CCFF"><label for="level"></label>
      <select name="level" id="level">
        <option value="1">ระดับที่ 1</option>
        <option value="2">ระดับที่ 2</option>
        <option value="3">ระดับที่ 3</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#99CCFF"><input type="submit" name="button" id="button" value="Submit" /></td>
    </tr>
</table>

</form>
</fieldset>

<?php

if($_POST['button']){
include("connect.inc");


$d1=substr($_POST['com_date'],0,10);
$d2=substr($_POST['com_date'],11);
$datexp=explode("/",$d1);
$date=(($datexp[2])+543).'-'.$datexp[1].'-'.$datexp[0].' '.$d2;

$regisdate=(date("Y")+543).'-'.date("m-d").' '.date("H:i:s");

$sql="INSERT INTO `com_error` (`com_date` , `symptoms` , `cause` , `correction` , `staff` , `level` , `regisdate` ) 
VALUES ('".$date."', '".$_POST['symptoms']."', '".$_POST['cause']."', '".$_POST['correction']."', '".$_POST['staff']."', '".$_POST['level']."', '".$regisdate."');
";
$result=mysql_query($sql) or die (mysql_error());



if($result){
echo "บันทึกข้อมูลเรียบร้อยแล้ว";	
echo "<meta http-equiv='refresh' content='1' />";
}else{
echo "ไม่สามารถบันทึกได้";	
echo "<meta http-equiv='refresh' content='1' />";
}

}
?>

</body>
</html>