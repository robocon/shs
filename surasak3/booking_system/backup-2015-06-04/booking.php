<? session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ใบจองเตียง</title>
<link type="text/css" href="css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	
</head>

<style>
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}

</style>
<body>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('datepicker-th-2'));

};

</script>
<!--<script type="text/javascript">
		  $(function () {
		    // Datepicker
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);
		    $("#datepicker-th-2").datepicker({ changeMonth: true, changeYear: true, dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
		      dayNamesMin: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
		      monthNames: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
		      monthNamesShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
		    });
		  });
		</script>-->
<script>
function ch_null(){
	if(document.f1.hn.value==""){
		alert("กรุณาระบุ HN ด้วยครับ");
		return false;
	}
}

function fncSubmit()
{
	if(document.f2.ptname.value=="")
	{
		alert('กรุณาใส่ชื่อผู้ป่วย');
		document.f2.ptname.focus();
		return false;
	}
	if(document.f2.doctor.selectedIndex==0) {
		alert("กรุณาเลือกแพทย์") ;
		document.f2.doctor.focus() ;
		return false ;
	}		

	if(document.f2.ward.selectedIndex==0)
	{
		alert('กรุณาเลือกหอผู้ป่วย');
		document.f2.ward.focus();		
		return false;
	}
	if(document.f2.bed.selectedIndex==0)
	{
		alert('กรุณาเลือก เตียง/ห้อง');
		document.f2.bed.focus();		
		return false;
	}	
	
	document.f2.submit();
}

</script>




<form name="f1" method="post" action="" onsubmit="JavaScript:return ch_null();">
<table border="1" class="forntsarabun" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td colspan="4" align="center" bgcolor="#CC6699"><strong>โปรแกรมจองเตียงผู้ป่วยใน</strong></td>
  </tr>
  <tr>
    <td>HN : 
      <input type="text" name="hn"  class="forntsarabun" value="<?=trim($_POST['hn']);?>"/></td>
    <td><input type="submit" name="button" value="ตกลง" class="forntsarabun" /></td>
    <td> <input name="btnButton" type="button" value="ย้อนกลับ" onClick="JavaScript:history.back();" class="forntsarabun">
     </td>
    <td> <a href='../../nindex.htm' class='forntsarabun'>กลับเมนูหลัก</a></td>
  </tr>
</table>
</form>
<br />

<? 
if($_POST['button']){
	include("../Connections/connect.inc.php"); 
	
	function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}
	
	$hn=trim($_POST['hn']);
	
	$sql="SELECT * FROM  opcard WHERE  hn ='".$hn."' ";
    $query = mysql_query($sql); 
	$dbarr=mysql_fetch_array($query);
	$row=mysql_num_rows($query);
	
	if($row){
	
	
	$ptname=$dbarr['yot'].''.$dbarr['name'].' '.$dbarr['surname'];
	
?>

<form name="f2" method="post" action="booking.php?do=save" onsubmit="JavaScript:return fncSubmit();">
 <table  border="0" class="forntsarabun">
  <tr>
    <td colspan="7" align="center" bgcolor="#CCCCCC">ใบจองเตียงผู้ป่วยใน</td>
   </tr>
  <tr>
    <td>ชื่อ-สกุล</td>
    <td><label for="ptname"></label>
      <input name="ptname" type="text" class="forntsarabun" id="ptname" value="<?=$ptname;?>"/></td>
    <td>อายุ</td>
    <td colspan="3"><label for="age"></label>
      <input name="age" type="text" class="forntsarabun" id="age"  value="<?=calcage($dbarr['dbirth']);?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>HN</td>
    <td><input name="hn" type="text" class="forntsarabun" id="hn" value="<?=$dbarr['hn'];?>"/></td>
    <td>วันที่ Admit</td>
    <td colspan="3">
    <input name="date_in" type="text" class="forntsarabun" id="datepicker-th-2" value=""/> <td>ex.22/04/2013</td>
 
</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>DX</td>
    <td><input name="diag" type="text" class="forntsarabun" id="diag" /></td>
    <td>สิทธิรักษา</td>
    <td colspan="3">&nbsp;<span class="fonthead">
    <input name="ptright" type="text" class="forntsarabun" id="ptright" value="<?=$dbarr['ptright']?>"/>
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>เตียง/ห้อง</td>
    <td><select name="bed" id="bed" class="forntsarabun">
      <option value="">---เลือกเตียง/ห้อง---</option>
      <option value="ธรรมดา">ธรรมดา</option>
      <option value="พิเศษ1000">พิเศษ1000</option>
      <option value="พิเศษ1200">พิเศษ1200</option>
      <option value="พิเศษ1600">พิเศษ1600</option>
      <option value="sleeptest1000">sleeptest1000</option>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>แพทย์</td>
    <td><select name="doctor"  id="doctor">
      <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while($dbarr2= mysql_fetch_array($result)){

		echo "<option value='".$dbarr2['name']."' >".$dbarr2['name']."</option>";
		}
		?>
    </select></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>หอผู้ป่วย</td>
    <td><select name="ward" id="ward" class="forntsarabun">
      <option value="">---เลือกหอผู้ป่วย---</option>
      <option value="หอผู้ป่วยรวม">หอผู้ป่วยรวม</option>
      <option value="หอผู้ป่วยหนัก(icu)">หอผู้ป่วยหนัก(icu)</option>
      <option value="หอผู้ป่วยพิเศษ">หอผู้ป่วยพิเศษ</option>
      <option value="หอผู้ป่วยสูตินรี">หอผู้ป่วยสูตินรี</option>
    </select></td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="center">
    <td colspan="7"><input name="b2" type="submit" class="forntsarabun" id="button" value="ส่งใบจองเตียง" />
    <a href='booking_chk.php' class='forntsarabun'>ย้อนกลับ</a>
      <a href='../../nindex.htm' class='forntsarabun'>กลับเมนูหลัก</a>
      <input type="hidden" name="bdate" value="<?=$dbarr['dbirth'];?>" />
      </td>
    </tr>
 </table>
  </form> 
    
<?
	}else{
		echo "<div class=\"forntsarabun\">ไม่พบ HN </div>";
	}
}


if($_POST['b2']){
if($_REQUEST['do']=="save"){
include("../Connections/connect.inc.php"); 

if($_POST['date_in']==""){
	echo "ไม่ได้กรอกวันที่ Admit กรุณาทำรายการใหม่ค่ะ";
	exit();
}
	$y=date('Y')+543;
	$m=date('m');
	$d=date('d');
	$datetime=$y.'-'.$m.'-'.$d.' '.date('H:i:s');
	///////////////////////////////
	$strdate=explode("/",$_POST['date_in']);
	$stryear=$strdate[2]+543;
	$date_in=$stryear.'-'.$strdate[1].'-'.$strdate[0];

	
$sqlin="INSERT INTO  booking (`hn`,`ptname`,`bdate`,`age`,`diag`,`doctor`,`bed`,`ward`,`date_in`,`date_regis`,`ptright`) 
VALUES ('".$_POST['hn']."','".$_POST['ptname']."','".$_POST['bdate']."','".$_POST['age']."','".$_POST['diag']."','".$_POST['doctor']."','".$_POST['bed']."','".$_POST['ward']."','".$date_in."','".$datetime."','".$_POST['ptright']."')";
$queryin=mysql_query($sqlin);

$max="select MAX(row_id)as max From booking";
$q1=mysql_query($max);
$fetch=mysql_fetch_array($q1);

if($queryin){
echo "<div class=\"forntsarabun\">ส่งใบจองเตียงเรียบร้อยแล้ว</div><br /><br />";	

echo "<a href=\"booking_print.php?row_id=$fetch[max]\" class='forntsarabun' target=\"_blank\">พิมพ์ใบจองเตียง</a>       <a href='../../nindex.htm' class='forntsarabun'>กลับเมนูหลัก</a>       ";	
//echo "<meta http-equiv='refresh' content='2; url=booking_chk.php'>" ;

	$sql1="SELECT * FROM  booking  WHERE  row_id ='".$fetch[max]."' ";
    $query1 = mysql_query($sql1); 
	$dbarr1=mysql_fetch_array($query1);
	
	//$age1=calcage($dbarr1['bdate']);

?>


<table  border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse" bordercolor="#000000" class="forntsarabun">
  <tr>
    <td colspan="6" align="center" bgcolor="#FF9999">ใบจองเตียง</td>
  </tr>
  <tr>
    <td>ชื่อ</td>
    <td><?=$dbarr1['ptname'];?></td>
    <td>อายุ</td>
    <td><?=$dbarr1['age'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>HN</td>
    <td><?=$_POST['hn']?></td>
    <td>รับป่วยเมื่อ</td>
    <td colspan="3"><?=$dbarr1['date_in'];?></td>
  </tr>
  <tr>
    <td>DX</td>
    <td><?=$dbarr1['diag'];?></td>
    <td>แพทย์</td>
    <td><?=$dbarr1['doctor'];?></td>
    <td>หอผู้ป่วย</td>
    <td><?=$dbarr1['ward'];?></td>
  </tr>
  <tr>
    <td>เตียง/ห้อง</td>
    <td><?=$dbarr1['bed'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">ผู้จอง.........................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">ผู้รับจอง......................</td>
  </tr>
</table>

<?
}else{
	
	echo "ไม่สามารถเพิ่มข้อมูลจองได้";
}

}
}
?>
</body>
</html>