<? 
session_start();
?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
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
<table class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#CCCCCC"><span class="forntsarabun">ระบบแจ้ง เพิ่มแก้ไข/ปรับปรุง เพิ่มเติม โปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><--------- ไปเมนู</a></span></td>
    </tr>
  <tr>
    <td width="80">แผนก</td>
    <td width="100"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
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
    <td>หัวข้อ</td>
    <td colspan="3"><input name="head" id="head" type="text" class="forntsarabun" size="40">  
    <font color="#FF0000">*** ระบุเมนูที่มีปัญหาหรือเมนูที่ต้องการแก้ไขด้วยครับ ***</font></td>
    </tr>
  <tr>
    <td valign="top">รายละเอียด</td>
    <td colspan="3"><TEXTAREA NAME="detail" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA></td>
    </tr>
  <tr>
    <td>ผู้แจ้ง</td>
    <td><input name="user" type="text" class="forntsarabun" size="20" value="<?=$sOfficer;?>"></td>
    <td width="96">โทรศัพท์ภายใน</td>
    <td width="518"><input name="phone" id="phone" type="text" class="forntsarabun" size="20"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input name="B1" type="submit" class="forntsarabun" value="ตกลง" onClick="JavaScript:return fncSubmit()">
      <input name="B2" type="reset" class="forntsarabun" value="ลบทิ้ง"></td>
    </tr>
</table>
</form>

</body>

