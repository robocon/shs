<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<?
$time=date("H:i:s");

/*if($time>="08:00:00" and $time <="15:59:59"){
	$cktime= "selected";
	
}else*/ 
	if($time<='07:59:59' || $time >='16:00:00'){
	$cktime='selected';
}

echo $cktime;

print "  &nbsp;&nbsp;&nbsp;ออก OPD CARD โดย&nbsp; ";
print " <select  id='case1' name='case'>";
//print " <OPTION value='$case'>";
print " <option value='EX01&nbsp;รักษาโรคทั่วไปในเวลาราชการ' >EX01&nbsp;รักษาโรคทั่วไปในเวลาราชการ</option>";
print " <option value='EX02&nbsp;ผู้ป่วยฉุกเฉิน' >EX02&nbsp;ผู้ป่วยฉุกเฉิน</option>";
print " <option value='EX03&nbsp;สมัครโครงการจ่ายตรง' >EX03&nbsp;สมัครโครงการจ่ายตรง</option>";
print " <option value='EX04&nbsp;ผู้ป่วยนัด' >EX04&nbsp;ผู้ป่วยนัด</option>";
print " <option value='EX05&nbsp;ยืม' >EX05&nbsp;ยืม</option>";
print " <option value='EX05&nbsp;ยืมไม่เอาใบสั่งยา' >EX05&nbsp;ยืมไม่เอาใบสั่งยา</option>";
print " <option value='EX06&nbsp;คัดกรองแพ้ยา' >EX06&nbsp;คัดกรองแพ้ยา</option>";
print " <option value='EX07&nbsp;ทันตกรรม' >EX07&nbsp;ทันตกรรม</option>";
print " <option value='EX08&nbsp;สูติ' >EX08&nbsp;สูติ</option>";
print " <option value='EX09&nbsp;ผ่าตัด' >EX09&nbsp;ผ่าตัด</option>";
print " <option value='EX10&nbsp;ไตเทียม' >EX10&nbsp;ไตเทียม</option>";
print " <option value='EX11&nbsp;รักษาโรคนอกเวลาราชการ'  $cktime>EX11&nbsp;รักษาโรคนอกเวลาราชการ</option>";
print " <option value='EX12&nbsp;นอนโรงพยาบาล' >EX12&nbsp;นอนโรงพยาบาล</option>";
print " <option value='EX13&nbsp;เลื่อนนัด' >EX13&nbsp;เลื่อนนัด</option>";
print " <option value='EX14&nbsp;อัลตร้าซาวด์' >EX14&nbsp;อัลตร้าซาวด์</option>";
print " <option value='EX15&nbsp;ออก VN' >EX15&nbsp;ออก VN</option>";
print " <option value='EX16&nbsp;ตรวจสุขภาพ' >EX16&nbsp;ตรวจสุขภาพ</option>";
print " <option value='EX17&nbsp;กายภาพบำบัด' >EX17&nbsp;กายภาพบำบัด</option>";
print " <option value='EX18&nbsp;ออกใบแทน' >EX18&nbsp;ออกใบแทน</option>";

print " <option value='EX20&nbsp;นวดแผนไทย' >EX20&nbsp;นวดแผนไทย</option>";
print " <option value='EX21&nbsp;dripยา' >EX21&nbsp;dripยา</option>";
print " <option value='EX92&nbsp;ฝังเข็ม' >EX 92&nbsp;ฝังเข็ม</option>";

print " <option value='EX23&nbsp;นัดฉีดยาต่อเนื่อง' >EX23&nbsp;นัดฉีดยาต่อเนื่อง</option>";
print " <option value='EX24&nbsp;คลีนิกพิเศษ' >EX24&nbsp;คลีนิกพิเศษ</option>";
print " <option value='EX25&nbsp;จักษุ' >EX25&nbsp;จักษุ</option>";
print " <option value='EX19&nbsp;ออก VN ทำแผล' >EX19&nbsp;ออก VN ทำแผล</option>";
print " <option value='EX22&nbsp;ตรวจมวลกระดูก' >EX22&nbsp;ตรวจมวลกระดูก</option>";
print " <option value='EX26&nbsp;ตรวจสุขภาพประจำปี' >EX26&nbsp;ตรวจสุขภาพประจำปี</option>";
print " <option value='EX27&nbsp;วัคซีนเด็ก' >EX27&nbsp;วัคซีนเด็ก</option>";
print " <option value='EX28&nbsp;สุ่มตรวจเวชระเบียน' >EX28&nbsp;สุ่มตรวจเวชระเบียน</option>";
print " <option value='EX29&nbsp;รับยาค้างจ่าย' >EX29&nbsp;รับยาค้างจ่าย</option>";
print " <option value='EX30&nbsp;ขอใบรับรองงดเกณฑ์ทหาร' >EX30&nbsp;ขอใบรับรองงดเกณฑ์ทหาร</option>";


print "   </select>";
?>
</body>
</html>