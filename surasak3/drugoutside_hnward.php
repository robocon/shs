<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บันทึกค่าใช้จ่ายนอกโรงพยาบาล ผู้ป่วยใน ระบุ AN</title>
<style type="text/css">
.font1 {
	font-family:"TH SarabunPSK";
	font-size:24px;
}
</style>
</head>
<script language="javascript">
function fncSubmit(){
	if(document.form1.cAn.value==""){
		
		alert("กรุณาระบุ AN ด้วยครับ");
		document.form1.cAn.focus();
		return false;
	}
	document.form1.submit();
}
</script>

<body>


<fieldset class="font1" style="width:50%">
  <legend>บันทึกค่าใช้จ่ายนอกโรงพยาบาล ผู้ป่วยใน ระบุ AN</legend><form id="form1" name="form1" method="post"  onSubmit="JavaScript:return fncSubmit();" action="drugoutside_ward.php">
  <table border="0" align="center">
    <tr>
      <td>AN:</td>
      <td>
      <input name="cAn" type="text" class="font1" id="cAn" value="<?=$_POST['cAn'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font1" id="button" value="     ตกลง     " /><a target=_self  href='../nindex.htm'> ไปเมนู</a></td>
    </tr>
  </table>
</form>
</fieldset>
</body>
</html>