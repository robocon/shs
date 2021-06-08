<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>พิมพ์สติกเกอร์ข้อมูลผู้ป่วยนอก</title>
</head>
<body>

<form id="form1" name="form1" method="post" action="stickergward.php"  target="show">
  <table  border="0" align="center">
    <tr>
      <td colspan="2" align="center">พิมพ์สติกเกอร์ข้อมูลผู้ป่วยนอก</td>
    </tr>
    <tr>
      <td align="right">HN :</td>
      <td><label for="hn"></label>
      <input type="text" name="hn" id="hn" /></td>
    </tr>
    <tr>
      <td align="right">จำนวน Copy : </td>
      <td><input type="text" name="copy" id="copy" value="3"></td>
    </tr>
    <tr>
      <td align="right">ตั้งค่ากระดาษ : </td>
      <td>
        <span><input type="radio" name="paper_size" id="paper_size" value="80x50" checked="checked" onclick="clear_custom()">80x50 mm.</span>
        <span><input type="radio" name="paper_size" id="paper_size" value="50x30" onclick="clear_custom()">50x30 mm.</span><br>
      </td>
    </tr>
	<tr valign="top">
		<td align="right">หรือเลือกขนาดกระดาษเอง : </td>
		<td>
			width : <input type="text" name="paper_width" id="paper_width"> มม.<br>
			height : <input type="text" name="paper_height" id="paper_height"> มม.
		</td>
	</tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" id="submit" value="Submit" /> <a target="_self"  href='../nindex.htm'>ไปเมนู</a></td>
    </tr>
  </table>
</form>
<script type="text/javascript">
function clear_custom(){
	document.getElementById("paper_width").value = "";
	document.getElementById("paper_height").value = "";
}
</script>

<div align="center">

  <iframe name="show" id="show" width="600" height="500" frameborder="0" scrolling="no"></iframe>

</div>
</body>
</html>