<?  session_start(); ?>
<html>
<head>
<style type="text/css">
			body {
			padding: 0px; 
			margin: 0px;
			}
			.boxreg2{
			font-size:1pt;
			border: 1px  solid;
			width: 2.7in;
			top:8.48in;
			left:4.1in;
			height:0.697in;			
			}
			.boxreg{
			font-size:1pt;
			border: 1px  solid;
			width: 2.7in;
			top:7.614in;
			left:3.9in;
			height:0.697in;			
			}
			div{
			font-family: Tahoma;
			font-size: 11pt;
			border: 0px none;
			left:0.120in;
			color:#000000;
			background-color:transparent;
			position: absolute;
			}
			.line{
			position:absolute;font-size:1pt;
			border: 1px  solid #808080;
			left: 0.052in;
			width: 7.058in;
			height: 1px;
			}
			.BoxForNote{
			position: absolute ;
			font-size:1pt;
			border: 1.5px  solid;
			width: 2.9in;
			left: 0.045in;
			top:3.1in;
			height:0.735in;
			}
			.BoxBenf{
			position: absolute ;
			font-size:1pt;
			border: 1.5px  solid;
			width: 2in;
			left: 4.15in;
			top:1.5in;
			height:0.735in;
			}
			.3of9B{
			font-family: 3 of 9 Barcode;
			font-size: 16pt;
			background-color:transparent;
			}
		</style>
<? 
include("connect.inc");
$cHn=$_GET['cHn'];

$sql="SELECT concat(yot,name,' ',surname)as ptname ,idcard,hn,dbirth  FROM opcard WHERE hn='$cHn' ";
$result = mysql_query($sql)or die("Query failed opcard");
$arr=mysql_fetch_array($result);
?>

<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
</head><body><div style="width:100%;top:0in;page-break-after:always;page-break-inside:avoid;"><div style="top:0.25in;">โรงพยาบาล: ร.พ.ค่ายสุรศักดิ์(11512)</div><hr style="top:0.45in;" class="line"><div style="top:0.5in;">HN: <?=$arr['hn']?></div><div style="top:0.5in; left:4.108in;">เลขที่อนุมัติ</div>
  <div style="text-align: center; width: 1.020in; left: 4.854in; top: 0.5in; font-weight: bold; background-color: #FFFF00;">_ _ _ _ _ _ _ </div><div style="top:0.75in;left:0.5in;" class="3of9B">*<?=$arr['hn']?>*</div><div style="top:1in; left:3.5in;">เลขประจำตัวประชาชน <?=$arr['idcard']?></div><div style="top:1.25in;left:4.15in;" class="3of9B">*<?=$arr['idcard']?>*</div><div class="BoxBenf"></div><hr style="top:1.75in; left:4.15in; width:2in" class="line"><div style="top:1.5in; left:4.17in;">สิทธิสวัสดิการรักษาพยาบาล :</div><div style="top:1.75in; left:4.2in;">องค์การปกครองส่วนท้องถิ่น</div><div style="top:0in; left:2.3in; font-weight: bold;">สมัครโครงการจ่ายตรงสิทธิองค์การปกครองส่วนท้องถิ่น</div><div style="top:2in;">ใช้สำหรับลงทะเบียนผู้ป่วยนอกรักษาต่อเนื่อง</div><div style="top:2.25in;"><i>**ต้องใช้ในวันเดียวกัน * ให้ขอเลขใหม่ถ้าใช้ข้ามวัน</i></div><div style="top:1in;">ชื่อ-สกุล: <?=$arr['ptname'];?></div><div style="top:1.5in; font-size: 11pt;"><i></i></div><div style="top:2.635in;">ออกให้วันที่  <?=date("d/m/").(date("Y")+543);?></div><div style="top:2.635in; left:2in;">เวลา  <?=date("H:i:s");?></div><div style="top:2.885in;">ใช้ได้ถึงวันที่ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</div><div class="BoxForNote"></div><div style="top:3.105in; left:4.060in;">เจ้าหน้าที่ผู้ดำเนินการ</div><div style="top:3.4in; left:3.164in;">ลงชื่อ  _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</div><div style="top:3.664in; left:2.997in;">ตำแหน่ง _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</div><div style="top:3.105in;">หมายเหตุสำหรับ ร.พ.</div><hr style="top:3.916in; border: 1px  dotted;" class="line"><div style="top:4.120in; left:2.237in; font-weight: bold;">แบบใบสมัครเข้าร่วมโครงการ ฯ</div><div style="top:4.360in; left:0.6in;">โครงการเบิกจ่ายตรงเงินสวัสดิการเกี่ยวกับการรักษาพยาบาลในสถานพยาบาลของทางราชการ</div><div style="top:4.631in; font-weight: bold;">ข้อมูลผู้สมัคร</div><div style="top:4.939in; left:1.125in; ">ข้าพเจ้า  <u><?=$arr['ptname']?></u></div><div style="top:5.179in;">เลขประจำตัวผู้ป่วย <u><?=$arr['hn']?></u></div><div style="top:5.179in; left:2.05in;">เลขประจำตัว  <u><?=$arr['idcard']?></u></div><div style="top:5.179in; left:4.05in;">วัน-เดือน-ปี เกิด <?=$arr['dbirth'];?></div><div style="top:5.42in; font-size:10pt;"> ซึ่งเป็นผู้มีสิทธิที่มีรายชื่อปรากฏอยู่ในฐานข้อมูลผู้มีสิทธิได้รับเงินค่ารักษาพยาบาล มีความประสงค์สมัครเข้า </div><div style="top:5.6in; font-size:10pt;"><span style="top:5.42in; font-size:10pt;">ร่วมโครงการการเบิกจ่ายตรงเงินสวัสดิการเกี่ยวกับการรักษาพยาบาลในสถานพยาบาลของทางราชการ ตาม</span></div><div style="top:5.78in; font-size:10pt;">พระราชกฤษฏีกาเงินสวัสดิการเกี่ยวกับการรักษาพยาบาล พ.ศ.2553 และที่แก้ไขเพิ่มเติม</div><div style="top:6.1in; left:0.966in;">ข้าพเจ้ายินดีจะปฏิบัติตามระเบียบที่ได้กำหนดไว้ทุกประการ</div><div style="top:6.6in; left:0.347in;">ลงชื่อ ................................... ผู้รับยาแทน (ถ้ามี)</div><div style="top:6.893in; left:0.74in;">(...................................)</div><div style="top:7.143in; left:1.03in;">....../....../.............</div><div style="top:6.6in; left:4in;">ลงชื่อ ...................................... ผู้ป่วย</div>
  <div style="top:6.883in; left:4.6in;">(<?=$arr['ptname']?>)</div><div style="top:7.143in; left:4.7in;">....../....../.............</div><div style="top:7.677in; left:0.347in;">ลงชื่อ  ................................... ผู้รับยาแทน (ถ้ามี)</div><div style="top:7.937in; left:0.74in;">(...................................)</div><div style="top:8.187in; left:1.03in;">....../....../.............</div><div class="boxreg"></div><div style="top:7.687in; left:4in;">สำหรับเจ้าหน้าที่</div>
  <div style="top:7.958in; left:4in;">วันที่สมัคร ................... เวลา ........</div></div></body></html>