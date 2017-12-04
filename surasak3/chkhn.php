<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>กรอก HN เพื่อออกใบเสร็จ</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 24px;
}
.forminput {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>

<body>
<div align="center">
  <p><strong>โปรแกรมออกใบเสร็จรับเงิน<br />
  ตรวจสุขภาพตำรวจ 2558</strong></p>
  <form id="form1" name="form1" method="post" action="slip.php" target="_blank">
     
    <label><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN :</strong></label>
    
    <label>
    <input name="hn" type="text" class="forminput" id="hn" maxlength="6" />
    </label>
    <br />
    <label><strong>จำนวนเงินที่รับ :</strong></label>
    <label>
    <input name="cash" type="text" class="forminput" id="cash" maxlength="6" />
    </label>
    <br />    
    <label> <br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="button" type="submit" class="forminput" id="button" value="ออกใบเสร็จ" />
    </label>
  </form>
  <p>&nbsp;</p>
</div>
</body>
</html>
