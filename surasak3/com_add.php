<?php
session_start();
if(!isset($sOfficer)) {
	echo "กรุณาเข้าสู่ระบบใหม่ <br>";
	echo "<a href='../sm3.php'>กดที่นี่เพื่อ Login อีกครั้ง</a>";
	exit();
}
?>
<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 24px;
	font-weight: bold;
	color: #FFFFFF;
}

a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
ol{
	margin: 0;
	padding; 0;
}
ol li{
	margin-bottom: 12px;
}
#closeBtn:hover{
	cursor: pointer;
	text-decoration: underline;
}
</style>
<script language="javascript">
////// เช็คค่าว่าง
function fncSubmit()
{
	
	var fn = document.f1;
	if(fn.depart.value=="0")
	{
		alert('กรุณาเลือกแผนก');
		fn.depart.focus();
		return false;
	}
	
	if(fn.jobtype.value=="0")
	{
		alert('กรุณาเลือกประเภทงาน');
		fn.jobtype.focus();
		return false;
	}	
	
	if(fn.head.value=="")
	{
		alert('กรุณากรอกหัวข้อ');
		fn.head.focus();
		return false;
	}
	
	if(document.all.detail.value.length <1){
	alert("กรอกรายละเอียดงานด้วยครับ");
	document.all.detail.focus();
	return false;
	}
	
	if(fn.phone.value=="")
	{
		alert('กรุณากรอกเบอร์โทรศัพท์ภายใน');
		fn.phone.focus();
		return false;
	}
		
	fn.submit();
}
</script>

<body bgcolor="#FFFFFF" >

<div id="notiContainer" class="" style="position:absolute; background-color:white; border:2px solid #66CCCC; padding:4px; box-shadow: 4px 4px 8px; width: 1024px;">
<div style="position:relative;">
    <div class="style2" style="background-color: #0099CC; padding: 2px 4px; color:white;"> <span>คำแนะนำก่อนการแจ้งซ่อม</span> <span style="float:right;" onclick="closeBtn()" id="closeBtn">[ปิด]</span></div>
    <div class="forntsarabun">
        <ol>
			<li>
				<div style="font-weight:bold;"><u style="color:red;">การแจ้งลบ</u> ใบตรวจโรคอิเล็กทรอนิกส์ </div>
				<div>กรุณาให้เหตุผลในการลบข้อมูลด้วยทุกครั้ง</div>
			</li>
			<li>
				<div style="font-weight:bold;">แผนกไตเทียม หากต้องการ<u style="color:red;">ลบ/แก้ไข</u> ค่าใช้จ่าย</div>
				<div>กรุณาให้เหตุผลด้วยทุกครั้ง และประสานกอง/แผนกที่เกี่ยวข้องก่อนให้โปรแกรมเมอร์แก้ไขข้อมูล ขอบคุณครับ</div>
			</li>
		</ol>
    </div>
</div>
</div>
<script>
	function closeBtn(){
		document.getElementById('notiContainer').style.display = 'none';
	}
</script>

<?php

print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_support.php'><font size='4' class='forntsarabun'>ดูข้อมูลแจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";
print "<hr>";
?>
<form method="POST" action="comadd1.php" name="f1" id="f1">
<input name="act" type="hidden" value="add">
<table width="1053" align="center" bgcolor="#66CCCC" class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#0099CC"><span class="style2">ระบบแจ้งซ่อมระบบคอมพิวเตอร์ ปรับปรุงและพัฒนาโปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี</span></td>
    </tr>
  <tr>
    <td width="146" bgcolor="#66CCCC"><strong>แผนก</strong></td>
    <td width="160" bgcolor="#66CCCC"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
    <select name="depart" id="depart" class="forntsarabun">
	<option value="0">เลือกแผนก</option>
<?php
include("connect.inc");
		$sql="select  *  from   departments where status='y' order by id asc";
		$result=mysql_query($sql);
			while($arr=mysql_fetch_array($result)) {
    		echo '<option value="'.$arr['name'].'">'.$arr['name'].' </option>';
		}
	  ?>
      </select></td>
    </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>ประเภทงาน</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><select name="jobtype" id="jobtype" class="forntsarabun">
      <option value="0" selected>เลือกงาน</option>
      <option value="hardware">งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย</option>
      <option value="software">งานแก้ไขโปรแกรม/พัฒนาระบบสารสนเทศ</option>
        </select></td>
  </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>เรื่องที่จะแจ้ง</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><input name="head" id="head" type="text" class="forntsarabun" size="60">
      <font color="#FF0000">*** ระบุปัญหาหรืออาการที่ต้องการแก้ไขด้วยครับ ***</font></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#66CCCC"><strong>รายละเอียดงาน</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><TEXTAREA NAME="detail" id="detail" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#66CCCC"><strong>หมายเหตุ</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><font color="#FF0000" size='4'>กรณีที่ ต้องการแจ้งแก้ไขปรับปรุงโปรแกรมมากกว่า 1 เรื่อง ให้แยกใบงาน เนื่องจากใช้ระยะเวลาดำเนินการที่แตกต่างกัน ใบงานของท่านอาจจะค้างในระบบเป็นเวลานาน</font></td>
    </tr>	
  <tr>
    <td bgcolor="#66CCCC"><strong>ชื่อ - นามสกุล<br>
      (ผู้แจ้งเรื่อง)</strong></td>
    <td bgcolor="#66CCCC"><input name="user" type="text" class="forntsarabun" size="20" value="<?=$sOfficer;?>"></td>
    <td width="144" bgcolor="#66CCCC">โทรศัพท์ภายใน</td>
    <td width="583" bgcolor="#66CCCC"><input name="phone" id="phone" type="text" class="forntsarabun" size="20"></td>
  </tr>
  <tr>
    <td bgcolor="#0099CC">&nbsp;</td>
    <td colspan="3" bgcolor="#0099CC"><input name="B1" type="submit" class="forntsarabun" value="บันทึกข้อมูล" onClick="JavaScript:return fncSubmit()">&nbsp; &nbsp;&nbsp;
      <input name="B2" type="reset" class="forntsarabun" value="เคลียร์ข้อมูล"></td>
    </tr>
</table>
</form>

</body>

