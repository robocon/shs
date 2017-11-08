<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ให้รหัสโรคด้วย AN</title>
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


<fieldset style="width:50%"><legend>ให้รหัสโรค  ระบุ AN</legend>
  <form id="form1" name="form1" method="get" action="dxipedit.php" onSubmit="JavaScript:return fncSubmit();">
  <table border="0" align="center">
    <tr>
      <td>AN:</td>
      <td>
      <input type="text" name="cAn" id="cAn" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="ตกลง" /><a target=_self  href='../nindex.htm'> ไปเมนู</a></td>
    </tr>
  </table>
</form>
</fieldset>
</body>
</html>