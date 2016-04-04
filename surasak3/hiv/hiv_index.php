<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ทะเบียนผู้ป่วย HIV</title>
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:24px;
}
.fontbutton{
	font-family:"TH SarabunPSK";
	font-size:26px;
	color:#000;
	background-color:#9FF;
}
.fontbutton1{
	font-family:"TH SarabunPSK";
	font-size:26px;
	color:#000;
	background-color:#BAA8F7;
}
.fontbutton2{
	font-family:"TH SarabunPSK";
	font-size:26px;
	color:#000;
	background:#CCC;
}
	
</style>
<body>
<a href="hiv_index.php?do=add" class="font1">ลงทะเบียนผู้ป่วย HIV</a>   ||  <a href="hiv_index.php?do=edit" class="font1">แก้ไขข้อมูลผู้ป่วย HIV</a>   ||  <a href="hiv_index.php?do=show" class="font1">รายชื่อผู้ป่วย HIV</a>  || <a href ="../../nindex.htm"  class="forntsarabun1"><----- ไปหน้าแรกสุด</a>
<? if($_GET['do']=='add'){ ?>

<table  border="0" cellspacing="2" cellpadding="2" class="font1">
  <tr>
    <td><input type="button" value="สิทธิเบิกทั่วไป" class="fontbutton" onclick="window.location='hiv_vo_form.php'" /></td>
    <td><input type="button" value="สิทธิประกันสังคม" class="fontbutton" onclick="window.location='hiv_vp_form.php'" /></td>
    <td><input type="button" value="สิทธิ สปสช." class="fontbutton" onclick="window.location='hiv_nhso_form.php'" /></td>
  </tr>
</table>
<? }else if($_GET['do']=='edit'){ ?>
<table  border="0" cellspacing="2" cellpadding="2" class="font1">
  <tr>
    <td><input type="button" value="สิทธิเบิกทั่วไป" class="fontbutton1" onclick="window.location='hiv_vo_edit.php'" /></td>
    <td><input type="button" value="สิทธิประกันสังคม" class="fontbutton1" onclick="window.location='hiv_vp_edit.php'" /></td>
    <td><input type="button" value="สิทธิ สปสช." class="fontbutton1" onclick="window.location='hiv_nhso_edit.php'" /></td>
  </tr>
</table>

<? }else if($_GET['do']=='show'){ ?>
<table  border="0" cellspacing="2" cellpadding="2" class="font1">
  <tr>
    <td><input type="button" value="สิทธิเบิกทั่วไป" class="fontbutton2" onclick="window.location='hiv_vo_show.php'" /></td>
    <td><input type="button" value="สิทธิประกันสังคม" class="fontbutton2" onclick="window.location='hiv_vp_show.php'" /></td>
    <td><input type="button" value="สิทธิ สปสช." class="fontbutton2" onclick="window.location='hiv_nhso_show.php'" /></td>
  </tr>
</table>

<? } ?>
</body>
</html>