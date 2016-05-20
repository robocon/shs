<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
.forntsarabun {	
	font-family: "TH SarabunPSK";
	font-size: 14pt;
}
.forntsarabun2 {	
	font-family: "TH SarabunPSK";
	font-size: 18pt;
	font-weight:bold;
}
.forntsarabun3 {	
	font-family: "TH SarabunPSK";
	font-size: 16pt;
}
</style>
<body onload="window.print();">
<? 
include("connect.inc");
$cHn=$_GET['cHn'];

$sql="SELECT concat(yot,name,' ',surname)as ptname ,idcard,hn,dbirth  FROM opcard WHERE hn='$cHn' ";
$result = mysql_query($sql)or die("Query failed opcard");
$arr=mysql_fetch_array($result);


Function calcage($birth){

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

$cAge=calcage($arr['dbirth']);
?>
<table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%" border="0">
      <tr>
        <td align="center" class="forntsarabun">กอง/แผนก/ส่วน ศูนย์ผู้ป่วยใน  เอกสารหมายเลข FR-IPC-001/8  แก้ไขครั้งที่ 02  วันที่มีผลบังคับใช้ 01,01,52</td>
        </tr>
      <tr class="forntsarabun2">
        <td align="center">แบบการรับนอนรักษาต่อ รพ.ค่ายสุรศักดิ์มนตรี</td>
        </tr>
      <tr >
        <td align="right" class="forntsarabun3">วันที่...................................เดือน..................................ปี...............................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">ชื่อ-สกุลผู้ป่วย...<?=$arr['ptname']?>...อายุ..<?=$cAge?>&nbsp;โรค..............................................................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">แพทย์ผู้รักษา...........................................................................สิทธิการักษา.....<span class="forntsarabun31">
          <?=$arr['ptright']?>
        </span></td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">รับนอนที่หอผู้ป่วย............................................ห้อง/เตียง................................ว/ด/ป................................เวลา..................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">กรุณาส่งอาการผู้ป่วยทางโทรศัพท์ที่พยาบาลหอผู้ป่วย โทร.0-5483-9305-6 ต่อ.....................................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">หากจำหน่ายผู้ป่วยกลับบ้าน กรุณาแจ้งญาติให้ติดต่อแผนกทะเบียน โทร.0-5483-9305-6 ต่อ 1120</td> 
      </tr>
      <tr >
        <td align="right" class="forntsarabun3">ผู้รับเรื่อง......................................................................</td>
      </tr>
      <tr >
        <td align="right" class="forntsarabun3">ตำแหน่ง......................................................................</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>