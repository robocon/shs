<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>กรอก HN เพื่อออกใบเสร็จ</title>
	<script type="text/javascript">
		function IsNumeric(sText,obj)<!--เช็คตัวเลข-->
		{
		var ValidChars = "0123456789.";
		var IsNumber=true;
		var Char;
		for (i = 0; i < sText.length && IsNumber == true; i++) 
			{ 
			Char = sText.charAt(i); 
			if (ValidChars.indexOf(Char) == -1) 
				{
				IsNumber = false;
				}
			}
			if(IsNumber==false){
				alert("กรอกข้อมูลได้เฉพาะตัวเลขเท่านั้น");
				obj.value=sText.substr(0,sText.length-1);
			}
		}
	</script>
	<style type="text/css">
		body,td,th {
			font-family: TH SarabunPSK;
			font-size: 24px;
		}
		.forminput {
			font-family: TH SarabunPSK;
			font-size: 18px;
		}
		body {
			background-image: url();
			background-color: #339999;
		}
	</style>
</head>
<body>
	<div align="center">
		<div align="center"><img src="images/shs.png" width="129" height="101" border="0" /></div>
	<div><strong>โปรแกรมออกใบเสร็จรับเงิน<br />
		ตรวจสุขภาพตำรวจ 2563</strong></div>
		<br /> 
		<form id="form1" name="form1" method="post" action="slip.php" target="_blank">
			<table width="50%" border="0">
				<tr>
					<td align="right"><label><strong>กรอก HN :</strong></label></td>
					<td><input name="hn" type="text" class="forminput" id="hn" maxlength="7" autocomplete="off" autofocus="autofocus" value="630" /></td>
				</tr>
				<tr>
					<td align="right"><label><strong>จำนวนเงินที่รับ :</strong></label></td>
					<td>
						<input name="cash" type="text" class="forminput" id="cash" maxlength="4" onkeyup="IsNumeric(this.value,this)" value="60" readonly/>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input name="button" type="submit" class="forminput" id="button" value="ออกใบเสร็จรับเงิน" /></td>
				</tr>
			</table>
		</form>
		<p>&nbsp;</p>
	</div>
</body>
</html>
