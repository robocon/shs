<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
-->
</style></head>
<? include("../connect.inc"); ?>
<body>
<form id="form1" name="form1" method="post" action="report_chkopd.php">
<input name="act" type="hidden" value="search" />
  <table width="100%" border="0">
    <tr>
      <td width="30%">จำนวนปี : 
        <input type="text" name="numdate" id="numdate" value="" />
        ประเภทการรับบริการ : 
       <select name="type" id="type">
           <option value="0">ตรวจทั่วไป</option>
           <option value="1">สมัครจ่ายตรง</option>
           <option value="2">ตรวจสุขภาพ</option>
           <option value="3">นอกเวลาราชการ</option>
           <option value="4">ฉุกเฉิน</option>
         </select>
         <input type="submit" name="button" id="button" value="ค้นหาข้อมูล" />
		</td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="search"){
	if($_POST["numdate"]==""){
	echo "<script>alert('ยังไม่ได้ระบุจำนวนปี');window.location='report_chkopd.php;</script>";		
	}
/*	}else if($_POST["numdate"]=="1"){
	$sql="select hn from opday where ";
	}else if($_POST["numdate"]=="2"){
	
	}else if($_POST["numdate"]=="3"){
	
	}else{
		echo "<script>alert('ระบุปีย้อนหลังได้สูงสุด 3 ปีเท่านั้น');window.location='report_chkopd.php;</script>";		
	}*/
	
$numdate = trim($_POST["numdate"]);
$stringlastyear=mktime(0,0,0,date("m"),date("d"),date("y")-$numdate);
$datelastyear=(date("Y",$stringlastyear)+543).date("-m-d H:i:s",$stringlastyear);


if($_POST["type"]=="0"){
	$type ="EX01";  //รักษาโรคทั่วไปในเวลาราชการ
	$typename ="รักษาโรคทั่วไปในเวลาราชการ";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="1"){
	$type ="EX03";  //สมัครโครงการจ่ายตรง
	$typename ="สมัครโครงการจ่ายตรง";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="2"){
	$type ="EX16";  // ตรวจสุขภาพ
	$typename ="ตรวจสุขภาพ";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="3"){
	$type ="EX11";  //รักษาโรคนอกเวลาราชการ
	$typename ="รักษาโรคนอกเวลาราชการ";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}else if($_POST["type"]=="4"){
	$type ="EX02";  // ผู้ป่วยฉุกเฉิน
	$typename ="ผู้ป่วยฉุกเฉิน";
	$sql="select * from opcard left join opday on opcard.hn=opday.hn where opday.an IS NULL and opcard.lastupdate < '$datelastyear' and opcard.lastupdate !='00-00-00 00:00:00' and opday.toborow like '%$type%' group by opday.hn";
}

//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
//echo "--->".$num;
?>
<p>จำนวนผู้ป่วยที่เข้ารับการรักษาในโรงพยาบาล <? echo "กลุ่ม $typename ระยะเวลา $numdate ปีย้อนหลัง มีทั้งหมด $num คน";?></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><strong>ลำดับ</strong></td>
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>ชื่อ-นามสกุล</strong></td>
    <td align="center"><strong>วันที่มาล่าสุด</strong></td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td width="7%" align="center"><?=$i;?></td>
    <td width="21%"><?=$rows["hn"];?></td>
    <td width="35%"><?=$rows["ptname"];?></td>
    <td width="37%"><?=$rows["lastupdate"];?></td>
  </tr>
<?
}
?>  
</table>
<?
}
?>
</body>
</html>
