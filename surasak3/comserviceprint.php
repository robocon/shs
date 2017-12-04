<?
include("connect.inc");
$sql="select * from comservice where row_id='$_GET[id]'";
//echo $sql;
$query=mysql_query($sql); 
$num=mysql_num_rows($query);         
$rows=mysql_fetch_array($query);  
	$ited_request1=$rows["datework"];
	list($y,$m,$d)=explode("-",$ited_request1);
	$y=$y+543;
	$newdate="$d/$m/$y";	
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
<div align="center">
<div class="style1">ใบขอแก้ไข/เพิ่มเติมโปรแกรมในระบบคอมพิวเตอร์เครือข่าย</div>
<div>กอง/แผนก ศูนย์บริการคอมพิวเตอร์ เอกสารหมายเลข FR-COM-001/1 แก้ไขครั้งที่ 04 วันที่มีผลบังคับใช้ 15 เม.ย. 46</div>
<div>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:#000000 solid 1px;">
  <tr>
    <td width="50%" valign="top"><p align="center"><strong>รายละเอียดข้อมูลที่ขอแก้ไข/เพิ่มเติม</strong><strong> </strong></p></td>
    <td width="25%" valign="top"><p align="center"><strong>ผู้ร้องขอ</strong><strong> </strong></p></td>
    <td width="25%" valign="top"><p align="center"><strong>ผู้รับงาน</strong></p></td>
  </tr>
  <tr>
    <td valign="top"><div style="margin-top: 10px; margin-bottom: 100px; margin-left:5px;"><?=$rows["detail"];?></div><br /><br /><br /><br /><br /><br /><br /></td>
    <td align="center" valign="top"><div style="margin-top: 10px;">........................................<br />
      (<?=$rows["personal"];?>)<br /><?=$newdate;?></div></td>
    <td align="center" valign="top"><div style="margin-top: 10px;">........................................<br />
      (<?=$rows["personal"];?>)<br /><?=$newdate;?></div></td>
  </tr>
  <tr>
    <td colspan="3"><strong style="margin-left: 280px;">ผลการปฏิบัติงาน/ปัญหา</strong></td>
    </tr>
  <tr>
    <td valign="top"><div style="margin-top: 10px; margin-bottom: 100px; margin-left: 5px;">
      <? echo "ดำเนินการเรียบร้อย";?>
    </div><br /><br /><br /></td>
    <td colspan="2" align="center" valign="top"><div style="margin-top: 10px;">........................................<br />(<?=$rows["user"];?>)<br />ผู้พัฒนาโปรแกรม<br /><?=$newdate;?></div></td>
    </tr>
</table>
</div>
<div style="margin-top:50px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45%"><div style="margin-left:10px;"><p>- อนุมัติ <br />
      <span style="margin-left: 35px;">พ.อ......................................................</span><br />
      <span style="margin-left: 85px;">(ณัฐนนท์  ภุคุกะ)</span><br />
      <span style="margin-left: 95px;">ผอ. รพ.ค่ายฯ</span><br />
     <span style="margin-left: 45px;"> ............./................../..................</span></p></div></td>
    <td width="10%">&nbsp;</td>
    <td width="45%"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ลงชื่อ).................................................................... <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...................................................................) <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ตำแหน่ง)................................................................. </p></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;"><p>- เรียน ผอ.รพ.ค่ายฯ<br />
      พิจารณาแล้วเห็นสมควรจัดลำดับความเร่งด่วน  อยู่ลำดับที่......... <br />
      ระยะดำเนินการ  วันที่.........../.........../..............<br />
      ถึงวันที่.........../.........../..............   <br />
      <br />
      <span style="margin-left: 35px;">(ลงชื่อ)..................................................................</span><br />
      <span style="margin-left: 65px;">(.................................................................)</span><br />
      <span style="margin-left: 25px;">ประธานคณะกรรมการสารสนเทศและเวชระเบียน รพ.ค่ายฯ</span></p>
      <span style="margin-left: 75px;">............./................../..................</span></div></td>
    <td>&nbsp;</td>
    <td><p>- เรียน ผอ.รพ.ค่ายฯ  (ผ่านคณะกรรมการสารสนเทศ) <br />
      ............................................................................................ <br />
      ............................................................................................ <br />
      ............................................................................................ <br />
      ............................................................................................ <br />
      ............................................................................................<br /> 
      <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;พ.ต................................................................................ <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(สมเพชร  แสงศรีจันทร์)<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หน.ศูนย์บริการคอมพิวเตอร์  รพ.ค่ายฯ <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;............./................../..................</p></td>
  </tr>
</table>

</div>
</div>
