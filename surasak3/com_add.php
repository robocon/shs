<? 
session_start();
?>
<style type="text/css">
<!--
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
-->
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

<form method="POST" action="comadd1.php" name="f1" id="f1">
<table align="center" bgcolor="#66CCCC" class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#0099CC"><span class="style2">ระบบแจ้งซ่อม เพิ่มแก้ไข/ปรับปรุง เพิ่มเติม โปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี</span></td>
    </tr>
  <tr>
    <td width="103" bgcolor="#66CCCC"><strong>แผนก</strong></td>
    <td width="160" bgcolor="#66CCCC"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
    <select name="depart" id="depart" class="forntsarabun">
	<option value="0">เลือกแผนก</option>
<?
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
      <option value="software">งานแก้ไข/พัฒนาโปรแกมโรงพยาบาล</option>
        </select></td>
  </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>หัวข้อ</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><input name="head" id="head" type="text" class="forntsarabun" size="40">  
    <font color="#FF0000">*** ระบุเมนูที่มีปัญหาหรือเมนูที่ต้องการแก้ไขด้วยครับ ***</font></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#66CCCC"><strong>รายละเอียด</strong></td>
    <td colspan="3" bgcolor="#66CCCC"><TEXTAREA NAME="detail" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA></td>
    </tr>
  <tr>
    <td bgcolor="#66CCCC"><strong>ผู้แจ้ง</strong></td>
    <td bgcolor="#66CCCC"><input name="user" type="text" class="forntsarabun" size="20" value="<?=$sOfficer;?>"></td>
    <td width="125" bgcolor="#66CCCC">โทรศัพท์ภายใน</td>
    <td width="506" bgcolor="#66CCCC"><input name="phone" id="phone" type="text" class="forntsarabun" size="20"></td>
  </tr>
  <tr>
    <td bgcolor="#0099CC">&nbsp;</td>
    <td colspan="3" bgcolor="#0099CC"><input name="B1" type="submit" class="forntsarabun" value="ตกลง" onClick="JavaScript:return fncSubmit()">
      <input name="B2" type="reset" class="forntsarabun" value="ลบทิ้ง">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<<ไปเมนู</a></td>
    </tr>
</table>
</form>

</body>

